<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Region;
use Illuminate\Support\Facades\Hash;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KwarcabController extends Controller
{
    /**
     * Dashboard Kwarcab
     */
    public function kwarcabDashboard()
    {
        return view('dashboard.kwarcab.index');
    }

    /**
     * pengguna sistem
     */
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

        return redirect('/kwarcab/pengguna')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * wilayah
     */
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
        return redirect('/kwarcab/wilayah')->with('success', 'Region berhasil ditambahkan.');
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
        return redirect('/kwarcab/wilayah')->with('success', 'Region berhasil diperbarui.');
    }

    // hapus wilayah
    public function regionDestroy(Region $region)
    {
        $region->delete();
        return redirect('/kwarcab/wilayah')->with('success', 'Region berhasil dihapus.');
    }


    public function anggotaIndex()
    {
        $childRegionIds = Region::where('parent_id', Auth::user()->region_id)->pluck('id');
        $grandChildIds = Region::whereIn('parent_id', $childRegionIds)->pluck('id');
        $allRegionIds = $childRegionIds->merge($grandChildIds)->push(Auth::user()->region_id);

        $anggota = Anggota::whereIn('region_id', $allRegionIds)->latest()->get();

        return view('dashboard.kwarcab.anggota.index', compact('anggota'));
    }

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

    public function anggotaEdit(Anggota $anggota)
    {
        $regions = Region::whereIn('parent_id', function ($query) {
            $query->select('id')->from('region')->where('parent_id', Auth::user()->region_id);
        })->orWhere('parent_id', Auth::user()->region_id)->get();

        return view('dashboard.kwarcab.anggota.edit', compact('anggota', 'regions'));
    }

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

    public function anggotaShow(Anggota $anggota)
    {
        return view('dashboard.kwarcab.anggota.show', compact('anggota'));
    }

    public function anggotaDestroy(Anggota $anggota)
    {
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }

        $anggota->delete();

        return redirect()->route('kwarcab.anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
