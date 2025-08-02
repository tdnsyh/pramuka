<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KegiatanGaleri;
use App\Models\Region;
use App\Models\User;
use App\Models\Role;
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Imports\AnggotaImport;
use App\Exports\AnggotaExport;
use App\Models\Keuangan;
use App\Models\RegionAbout;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;

class KwarranController extends Controller
{
    // dashboard kwarran
    public function kwarranDashboard()
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

        return view('dashboard.kwarran.index', compact(
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

    // wilayah
    public function regionIndex()
    {
        $gudep = Region::where('type', 'gudep')
                    ->where('parent_id', Auth::user()->region_id)
                    ->get();

        return view('dashboard.kwarran.gudep.index', compact('gudep'));
    }

    // tambah wilayah
    public function regionCreate()
    {
        return view('dashboard.kwarran.gudep.create');
    }

    // simpan wilayah
    public function regionStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Region::create([
            'name' => $request->name,
            'type' => 'gudep',
            'parent_id' => Auth::user()->region_id,
        ]);

        return redirect()->route('kwarran.gudep.index')->with('success', 'Gudep berhasil ditambahkan');
    }

    // edit wilayah
    public function regionEdit($id)
    {
        $gudep = Region::where('id', $id)
                    ->where('parent_id', Auth::user()->region_id)
                    ->firstOrFail();

        return view('dashboard.kwarran.gudep.edit', compact('gudep'));
    }

    // update wilayah
    public function regionUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $gudep = Region::where('id', $id)
                    ->where('parent_id', Auth::user()->region_id)
                    ->firstOrFail();

        $gudep->update([
            'name' => $request->name,
        ]);

        return redirect()->route('kwarran.gudep.index')->with('success', 'Gudep berhasil diperbarui');
    }

    // hapus wilayah
    public function regionDestroy($id)
    {
        $gudep = Region::where('id', $id)
                    ->where('parent_id', Auth::user()->region_id)
                    ->firstOrFail();

        $gudep->delete();

        return redirect()->route('kwarran.gudep.index')->with('success', 'Gudep berhasil dihapus');
    }

    // akun pengguna
    public function penggunaIndex()
    {
        $gudepRoleId = Role::where('name', 'gudep')->value('id');

        $gudepIds = Region::where('parent_id', Auth::user()->region_id)->pluck('id');

        $users = User::where('role_id', $gudepRoleId)
                    ->whereIn('region_id', $gudepIds)
                    ->get();

        return view('dashboard.kwarran.pengguna.index', compact('users'));
    }

    // tambah pengguna
    public function penggunaCreate()
    {
        $regions = Region::where('type', 'gudep')
                    ->where('parent_id', Auth::user()->region_id)
                    ->get();

        return view('dashboard.kwarran.pengguna.create', compact('regions'));
    }

    // simpan pengguna
    public function penggunaStore(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8|confirmed',
            'region_id' => 'required|exists:region,id',
        ]);

        $region = Region::where('id', $request->region_id)
                        ->where('parent_id', Auth::user()->region_id)
                        ->firstOrFail();

        $gudepRoleId = Role::where('name', 'gudep')->value('id');

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_id'   => $gudepRoleId,
            'region_id' => $region->id,
        ]);

        return redirect()->route('kwarran.pengguna.index')->with('success', 'Akun Gudep berhasil dibuat');
    }

    // edit pengguna
    public function penggunaEdit(User $user)
    {
        $regions = Region::where('type', 'gudep')
                    ->where('parent_id', Auth::user()->region_id)
                    ->get();

        return view('dashboard.kwarran.pengguna.edit', compact('user', 'regions'));
    }

    // update pengguna
    public function penggunaUpdate(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'region_id' => 'required|exists:region,id',
            'password'  => 'nullable|min:8|confirmed',
        ]);

        $region = Region::where('id', $request->region_id)
                        ->where('parent_id', Auth::user()->region_id)
                        ->firstOrFail();

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'region_id' => $region->id,
            'password'  => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('kwarran.pengguna.index')->with('success', 'Akun berhasil diperbarui');
    }

    // hapus pengguna
    public function penggunaDestroy(User $user)
    {
        $user->delete();

        return redirect()->route('kwarran.pengguna.index')->with('success', 'Akun berhasil dihapus');
    }

    // data anggota
    public function anggotaIndex()
    {
        $gudepIds = Region::where('parent_id', Auth::user()->region_id)->pluck('id');
        $anggota = Anggota::whereIn('region_id', $gudepIds)->get();

        return view('dashboard.kwarran.anggota.index', compact('anggota'));
    }

    // tambah anggota
    public function anggotaCreate()
    {
        $regions = Region::where('parent_id', Auth::user()->region_id)->get();
        return view('dashboard.kwarran.anggota.create', compact('regions'));
    }

    // logika simpan anggota
    public function anggotaStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nta' => 'required|string|max:50|unique:anggota',
            'region_id' => 'required|exists:region,id',
            'golongan' => 'required|string',
            'jabatan' => 'nullable|string',
            'pangkalan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $region = Region::where('id', $request->region_id)
                        ->where('parent_id', Auth::user()->region_id)
                        ->firstOrFail();

        $data = $request->only(['name', 'nta', 'golongan', 'jabatan', 'pangkalan', 'status']);
        $data['region_id'] = $region->id;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        Anggota::create($data);

        return redirect()->route('kwarran.anggota.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    // form edit anggota
    public function anggotaEdit(Anggota $anggota)
    {
        $regions = Region::where('parent_id', Auth::user()->region_id)->get();

        return view('dashboard.kwarran.anggota.edit', compact('anggota', 'regions'));
    }

    // logika simpan anggota
    public function anggotaUpdate(Request $request, Anggota $anggota)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nta' => 'required|string|max:50|unique:anggota,nta,' . $anggota->id,
            'region_id' => 'required|exists:region,id',
            'golongan' => 'required|string',
            'jabatan' => 'nullable|string',
            'pangkalan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $region = Region::where('id', $request->region_id)
                        ->where('parent_id', Auth::user()->region_id)
                        ->firstOrFail();

        $anggota->fill($request->only(['name', 'nta', 'golongan', 'pangkalan', 'jabatan', 'status']));
        $anggota->region_id = $region->id;

        if ($request->hasFile('foto')) {
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $anggota->foto = $request->file('foto')->store('anggota', 'public');
        }

        $anggota->save();

        return redirect()->route('kwarran.anggota.index')->with('success', 'Anggota berhasil diperbarui');
    }

    // detail anggota
    public function anggotaShow(Anggota $anggota)
    {
        return view('dashboard.kwarran.anggota.show', compact('anggota'));
    }

    // hapus anggota
    public function anggotaDestroy(Anggota $anggota)
    {
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }

        $anggota->delete();

        return redirect()->route('kwarran.anggota.index')->with('success', 'Anggota berhasil dihapus');
    }

    // form import anggota
    public function anggotaImportForm()
    {
        $kwarcabId = Auth::user()->region_id;

        $regions = Region::where('parent_id', $kwarcabId)->get();

        return view('dashboard.kwarran.anggota.import', compact('regions'));
    }

    // logika import anggota
    public function anggotaImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
            'region_id' => 'required|exists:region,id',
        ]);

        Excel::import(new AnggotaImport($request->region_id), $request->file('file'));

        return redirect()->route('kwarran.anggota.index')->with('success', 'Data anggota berhasil diimport.');
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


        return view('dashboard.kwarran.profil.index', compact('user', 'about'));
    }

    // update tentang kwarran
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

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    // daftar kegiatan kwarran
    public function kegiatanIndex()
    {
        $regionId = Auth::user()->region_id;

        $kegiatan = Kegiatan::with('region')
                            ->where('region_id', $regionId)
                            ->latest()
                            ->paginate(10);

        return view('dashboard.kwarran.kegiatan.index', compact('kegiatan'));
    }

    // tambah kegiatan
    public function kegiatanCreate()
    {
        return view('dashboard.kwarran.kegiatan.form');
    }

    // simpan kegiatan
    public function kegiatanStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_pendek' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slug = Str::slug($request->judul);
        $originalSlug = $slug;
        $counter = 1;
        while (Kegiatan::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('agenda', 'public');
        }

        $regionId = Auth::user()->region_id ?? null;

        $data = [
            'judul' => $request->judul,
            'slug' => $slug,
            'gambar' => $gambar,
            'deskripsi_pendek' => $request->deskripsi_pendek,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
        ];

        if ($regionId !== null) {
            $data['region_id'] = $regionId;
        }

        Kegiatan::create($data);

        return redirect()->route('kwarran.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    // edit kegiatan
    public function kegiatanEdit(Kegiatan $kegiatan)
    {
        return view('dashboard.kwarran.kegiatan.form', compact('kegiatan'));
    }

    // logika update kegiatan
    public function kegiatanUpdate(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_pendek' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slug = Str::slug($request->judul);
        if ($slug !== $kegiatan->slug) {
            $originalSlug = $slug;
            $counter = 1;
            while (Kegiatan::where('slug', $slug)->where('id', '!=', $kegiatan->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
            $kegiatan->slug = $slug;
        }

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }

            $kegiatan->gambar = $request->file('gambar')->store('kegiatan', 'public');
        }

        $kegiatan->update([
            'judul' => $request->judul,
            'deskripsi_pendek' => $request->deskripsi_pendek,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
        ]);

        $kegiatan->save();

        return redirect()->route('kwarran.kegiatan.index')->with('success', 'kegiatan berhasil diupdate.');
    }

    // hapus kegiatan
    public function kegiatanDestroy(Kegiatan $kegiatan)
    {
        foreach ($kegiatan->galeri as $foto) {
            if ($foto->gambar && Storage::disk('public')->exists($foto->gambar)) {
                Storage::disk('public')->delete($foto->gambar);
            }
            $foto->delete();
        }

        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('kwarcab.kegiatan.index')->with('success', 'Kegiatan dan galeri berhasil dihapus.');
    }

    // simpan galeri kegiatan
    public function kegiatanGaleriStore(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'gambar.*' => 'required|image|max:2048',
        ]);

        foreach ($request->file('gambar') as $file) {
            $path = $file->store('galeri', 'public');

            $kegiatan->galeri()->create([
                'gambar' => $path,
            ]);
        }

        return back()->with('success', 'Gambar berhasil diunggah.');
    }

    // hapus galeri kegiatan
    public function kegiatanGaleriDestroy(Kegiatan $kegiatan, KegiatanGaleri $galeri)
    {
        Storage::disk('public')->delete($galeri->gambar);
        $galeri->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }

    // detail kegiatan
    public function kegiatanShow(Kegiatan $kegiatan)
    {
        return view('dashboard.kwarran.kegiatan.show', compact('kegiatan'));
    }

    // Tampilkan semua data keuangan untuk region user saat ini
    public function keuanganIndex()
    {
        $regionId = Auth::user()->region_id;

        $keuangan = Keuangan::where('region_id', $regionId)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('dashboard.kwarran.keuangan.index', compact('keuangan'));
    }

    // Form tambah data
    public function keuanganCreate()
    {
        return view('dashboard.kwarran.keuangan.create');
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

        return redirect()->route('kwarran.keuangan.index')->with('success', 'Data keuangan berhasil ditambahkan.');
    }

    // Form edit
    public function keuanganEdit(Keuangan $keuangan)
    {
        return view('dashboard.kwarran.keuangan.edit', compact('keuangan'));
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

        return redirect()->route('kwarran.keuangan.index')->with('success', 'Data keuangan berhasil diperbarui.');
    }

    // Hapus data
    public function keuanganDestroy(Keuangan $keuangan)
    {
        $keuangan->delete();

        return redirect()->route('kwarran.keuangan.index')->with('success', 'Data keuangan berhasil dihapus.');
    }
}
