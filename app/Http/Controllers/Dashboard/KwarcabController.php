<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Region;
use Illuminate\Support\Facades\Hash;

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
}
