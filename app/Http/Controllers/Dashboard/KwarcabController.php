<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Region;
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\KegiatanGaleri;

class KwarcabController extends Controller
{
    // dashboard
    public function kwarcabDashboard()
    {
        return view('dashboard.kwarcab.index');
    }

    // pengguna
    public function penggunaIndex()
    {
        $users = User::with(['role', 'region'])->get();
        return view('dashboard.kwarcab.pengguna.index', compact('users'));
    }

    // tambah pengguna
    public function penggunaTambah()
    {
        $roles = Role::whereIn('name', ['Kwarcab', 'Kwarran', 'Gudep'])->get();
        $regions = Region::all();
        return view('dashboard.kwarcab.pengguna.create', compact('roles', 'regions'));
    }

    // simpan pengguna
    public function penggunaSimpan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'role_id' => 'required|exists:role,id',
            'region_id' => 'nullable|exists:region,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'region_id' => $request->region_id,
        ]);

        return redirect()->route('kwarcab.pengguna.index')->with('success', 'User berhasil ditambahkan!');
    }

    // wilayah atau region
    public function regionIndex()
    {
        $regions = Region::with('parent')->get();
        return view('dashboard.kwarcab.wilayah.index', compact('regions'));
    }

    // tambah wilayah
    public function regionCreate()
    {
        $parents = Region::all();
        return view('dashboard.kwarcab.wilayah.create', compact('parents'));
    }

    // simpan wilayah
    public function regionStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:kwarcab,kwarran,gudep',
            'parent_id' => 'nullable|exists:region,id',
        ]);

        Region::create($request->all());
        return redirect()->route('kwarcab.wilayah.index')->with('success', 'Region berhasil ditambahkan.');
    }

    // edit wilayah
    public function regionEdit(Region $region)
    {
        $parents = Region::where('id', '!=', $region->id)->get();
        return view('dashboard.kwarcab.wilayah.edit', compact('region', 'parents'));
    }

    // update wilayah
    public function regionUpdate(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:kwarcab,kwarran,gudep',
            'parent_id' => 'nullable|exists:region,id',
        ]);

        $region->update($request->all());
        return redirect()->route('kwarcab.wilayah.index')->with('success', 'Region berhasil diperbarui.');
    }

    // hapus wilayah
    public function regionDestroy(Region $region)
    {
        $region->delete();
        return redirect()->route('kwarcab.wilayah.index')->with('success', 'Region berhasil dihapus.');
    }

    // daftar anggota pramuka
    public function anggotaIndex()
    {
        $childRegionIds = Region::where('parent_id', Auth::user()->region_id)->pluck('id');
        $grandChildIds = Region::whereIn('parent_id', $childRegionIds)->pluck('id');
        $allRegionIds = $childRegionIds->merge($grandChildIds)->push(Auth::user()->region_id);

        $anggota = Anggota::whereIn('region_id', $allRegionIds)->latest()->get();

        return view('dashboard.kwarcab.anggota.index', compact('anggota'));
    }

    // form tambah anggota
    public function anggotaCreate()
    {
        $kwarranIds = Region::where('parent_id', Auth::user()->region_id)
                            ->where('type', 'kwarran')
                            ->pluck('id');

        $regions = Region::whereIn('parent_id', $kwarranIds)
                        ->where('type', 'gudep')
                        ->get();

        return view('dashboard.kwarcab.anggota.create', compact('regions'));
    }

    // logika simpan anggota
    public function anggotaStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nta' => 'required|unique:anggota',
            'region_id' => 'required|exists:region,id',
            'golongan' => 'required',
            'pangkalan' => 'required',
            'jabatan' => 'required',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        Anggota::create($data);

        return redirect()->route('kwarcab.anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    // form edit anggota
    public function anggotaEdit(Anggota $anggota)
    {
        $regions = Region::whereIn('parent_id', function ($query) {
            $query->select('id')->from('region')->where('parent_id', Auth::user()->region_id);
        })->orWhere('parent_id', Auth::user()->region_id)->get();

        return view('dashboard.kwarcab.anggota.edit', compact('anggota', 'regions'));
    }

    // logika update anggota
    public function anggotaUpdate(Request $request, Anggota $anggota)
    {
        $request->validate([
            'name' => 'required',
            'nta' => 'required|unique:anggota,nta,' . $anggota->id,
            'region_id' => 'required|exists:region,id',
            'golongan' => 'required',
            'jabatan' => 'required',
            'pangkalan' => 'required',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        $anggota->update($data);

        return redirect()->route('kwarcab.anggota.index')->with('success', 'Data anggota diperbarui.');
    }

    // detail anggota
    public function anggotaShow(Anggota $anggota)
    {
        return view('dashboard.kwarcab.anggota.show', compact('anggota'));
    }

    // hapus anggota
    public function anggotaDestroy(Anggota $anggota)
    {
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }

        $anggota->delete();

        return redirect()->route('kwarcab.anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }

    // profil akun
    public function profilIndex()
    {
        $user = Auth::user();
        return view('dashboard.kwarcab.profil.index', compact('user'));
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

    // Keuangan
    public function keuanganIndex()
    {
        return view('dashboard.kwarcab.keuangan.index');
    }

    // tentang
    public function tentangIndex()
    {
        return view('dashboard.kwarcab.tentang.index');
    }

    // kegiatan
    public function kegiatanIndex()
    {
        $kegiatan = Kegiatan::with('region')
                            ->latest()
                            ->paginate(10);

        return view('dashboard.kwarcab.kegiatan.index', compact('kegiatan'));
    }

    // form tambah kegiatan
    public function kegiatanCreate()
    {
        return view('dashboard.kwarcab.kegiatan.form');
    }

    // logika simpan kegiatan
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

        return redirect()->route('kwarcab.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    // form edit kegiatan
    public function kegiatanEdit(Kegiatan $kegiatan)
    {
        return view('dashboard.kwarcab.kegiatan.form', compact('kegiatan'));
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

        return redirect()->route('kwarcab.kegiatan.index')->with('success', 'kegiatan berhasil diupdate.');
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

    // detail kegiatan
    public function kegiatanShow(Kegiatan $kegiatan)
    {
        return view('dashboard.kwarcab.kegiatan.show', compact('kegiatan'));
    }

    // logika simpan galeri kegiatan
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

}
