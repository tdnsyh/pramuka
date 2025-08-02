<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Imports\AnggotaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Exports\AnggotaExport;
use App\Models\Keuangan;
use App\Models\Region;
use App\Models\RegionAbout;

class GudepController extends Controller
{
    // dashboard
    public function gudepDashboard()
    {
        $user = Auth::user();
        $regionId = $user->region_id;

        $jumlahAnggota = Anggota::where('region_id', $regionId)->count();
        $anggotaAktif = Anggota::where('region_id', $regionId)->where('status', 'aktif')->count();
        $anggotaNonaktif = Anggota::where('region_id', $regionId)->where('status', 'nonaktif')->count();
        $totalPemasukan = Keuangan::where('region_id', $regionId)->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Keuangan::where('region_id', $regionId)->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;
        $riwayatKeuangan = Keuangan::where('region_id', $regionId)->orderBy('tanggal', 'desc')->take(5)->get();

        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->format('M');
        });

        $pemasukanBulanan = [];
        $pengeluaranBulanan = [];

        foreach (range(1, 12) as $month) {
            $pemasukan = Keuangan::where('region_id', $regionId)
                ->where('jenis', 'pemasukan')
                ->whereMonth('tanggal', $month)
                ->whereYear('tanggal', now()->year)
                ->sum('jumlah');

            $pengeluaran = Keuangan::where('region_id', $regionId)
                ->where('jenis', 'pengeluaran')
                ->whereMonth('tanggal', $month)
                ->whereYear('tanggal', now()->year)
                ->sum('jumlah');

            $pemasukanBulanan[] = $pemasukan;
            $pengeluaranBulanan[] = $pengeluaran;
        }

        return view('dashboard.gudep.index', compact(
            'jumlahAnggota',
            'anggotaAktif',
            'anggotaNonaktif',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'riwayatKeuangan',
            'months',
            'pemasukanBulanan',
            'pengeluaranBulanan'
        ));
    }

    // daftar anggota
    public function anggotaIndex()
    {
        $anggota = Anggota::where('region_id', Auth::user()->region_id)->get();
        return view('dashboard.gudep.anggota.index', compact('anggota'));
    }

    // form tambah anggota
    public function anggotaCreate()
    {
        return view('dashboard.gudep.anggota.create');
    }

    // logika simpan anggota
    public function anggotaStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nta' => 'required|unique:anggota',
            'pangkalan' => 'required',
            'golongan' => 'required|in:siaga,penggalang,penegak,pandega',
            'jabatan' => 'nullable',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['region_id'] = Auth::user()->region_id;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        Anggota::create($data);

        return redirect()->route('gudep.anggota.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    // form edit anggota
    public function anggotaEdit($id)
    {
        $anggota = Anggota::where('id', $id)
            ->where('region_id', Auth::user()->region_id)
            ->firstOrFail();

        return view('dashboard.gudep.anggota.edit', compact('anggota'));
    }

    // logika update anggota
    public function anggotaUpdate(Request $request, $id)
    {
        $anggota = Anggota::where('id', $id)
            ->where('region_id', Auth::user()->region_id)
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'nta' => 'required|string|max:100',
            'pangkalan' => 'required|string|max:255',
            'golongan' => 'required|in:siaga,penggalang,penegak,pandega',
            'jabatan' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|max:2048'
        ]);

        $anggota->name = $request->name;
        $anggota->nta = $request->nta;
        $anggota->pangkalan = $request->pangkalan;
        $anggota->golongan = $request->golongan;
        $anggota->jabatan = $request->jabatan;
        $anggota->status = $request->status;

        if ($request->hasFile('foto')) {
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }

            $anggota->foto = $request->file('foto')->store('anggota', 'public');
        }

        $anggota->save();

        return redirect()->route('gudep.anggota.index')->with('success', 'Data anggota berhasil diperbarui');
    }

    // logika hapus anggota
    public function anggotaDestroy($id)
    {
        $anggota = Anggota::where('id', $id)
            ->where('region_id', Auth::user()->region_id)
            ->firstOrFail();

        if ($anggota->foto) {
            Storage::delete($anggota->foto);
        }

        $anggota->delete();

        return redirect()->route('gudep.anggota.index')->with('success', 'Anggota berhasil dihapus');
    }

    // detail anggota
    public function anggotaShow($id)
    {
        $anggota = Anggota::where('id', $id)
            ->where('region_id', Auth::user()->region_id)
            ->firstOrFail();

        return view('dashboard.gudep.anggota.show', compact('anggota'));
    }

    // form import anggota
    public function anggotaImportForm()
    {
        $kwarcabId = Auth::user()->region_id;

        $regions = Region::where('parent_id', $kwarcabId)->get();

        return view('dashboard.gudep.anggota.import', compact('regions'));
    }

    // logika import anggota
    public function anggotaImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $regionId = Auth::user()->region_id;

        Excel::import(new AnggotaImport($regionId), $request->file('file'));

        return redirect()->route('gudep.anggota.index')->with('success', 'Anggota berhasil dihapus');
    }

    // logika export anggota
    public function anggotaExport()
    {
        return Excel::download(new AnggotaExport, 'data_anggota.xlsx');
    }


    // profil akun
    public function profilIndex()
    {
        $user = Auth::user();
        $about = RegionAbout::where('region_id', $user->region_id)->first();


        return view('dashboard.gudep.profil.index', compact('user', 'about'));
    }

    // update tentang gudep
    public function aboutUpdate(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'isi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'isi' => $validated['isi'] ?? null,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        RegionAbout::updateOrCreate(
            ['region_id' => $user->region_id],
            $data
        );

        return back()->with('success', 'Profil wilayah berhasil diperbarui.');
    }

    // update profil
    public function profilUpdate(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'updated_at' => now(),
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        DB::table('users')->where('id', $user->id)->update($data);

        return back()->with('gudep', 'Profil berhasil diperbarui.');
    }

    // Tampilkan semua data keuangan untuk region user saat ini
    public function keuanganIndex()
    {
        $regionId = Auth::user()->region_id;

        $keuangan = Keuangan::where('region_id', $regionId)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('dashboard.gudep.keuangan.index', compact('keuangan'));
    }

    // Form tambah data
    public function keuanganCreate()
    {
        return view('dashboard.gudep.keuangan.create');
    }

    // Simpan data baru
    public function keuanganStore(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Keuangan::create([
            'region_id' => Auth::user()->region_id,
            'user_id' => Auth::id(),
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('gudep.keuangan.index')->with('success', 'Data keuangan berhasil ditambahkan.');
    }

    // Form edit
    public function keuanganEdit(Keuangan $keuangan)
    {
        return view('dashboard.gudep.keuangan.edit', compact('keuangan'));
    }

    // Update data
    public function keuanganUpdate(Request $request, Keuangan $keuangan)
    {

        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $keuangan->update([
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('gudep.keuangan.index')->with('success', 'Data keuangan berhasil diperbarui.');
    }

    // Hapus data
    public function keuanganDestroy(Keuangan $keuangan)
    {
        $keuangan->delete();

        return redirect()->route('gudep.keuangan.index')->with('success', 'Data keuangan berhasil dihapus.');
    }

    // tentang
    public function tentangIndex()
    {
        return view('dashboard.gudep.tentang.index');
    }

}
