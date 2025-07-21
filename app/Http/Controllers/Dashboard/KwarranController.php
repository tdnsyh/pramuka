<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class KwarranController extends Controller
{
    public function kwarranDashboard()
    {
        return view('dashboard.kwarran.index');
    }

    public function regionIndex()
    {
        $gudep = Region::where('type', 'gudep')
                    ->where('parent_id', Auth::user()->region_id)
                    ->get();

        return view('dashboard.kwarran.region.index', compact('gudep'));
    }

    public function regionCreate()
    {
        return view('dashboard.kwarran.region.create');
    }

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

        return redirect()->route('kwarran.region.index')->with('success', 'Gudep berhasil ditambahkan');
    }

    public function regionEdit($id)
    {
        $gudep = Region::where('id', $id)
                    ->where('parent_id', Auth::user()->region_id)
                    ->firstOrFail();

        return view('dashboard.kwarran.region.edit', compact('gudep'));
    }

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

        return redirect()->route('kwarran.region.index')->with('success', 'Gudep berhasil diperbarui');
    }

    public function regionDestroy($id)
    {
        $gudep = Region::where('id', $id)
                    ->where('parent_id', Auth::user()->region_id)
                    ->firstOrFail();

        $gudep->delete();

        return redirect()->route('kwarran.region.index')->with('success', 'Gudep berhasil dihapus');
    }


    public function penggunaIndex()
    {
        $gudepRoleId = Role::where('name', 'gudep')->value('id');

        $gudepIds = Region::where('parent_id', Auth::user()->region_id)->pluck('id');

        $users = User::where('role_id', $gudepRoleId)
                    ->whereIn('region_id', $gudepIds)
                    ->get();

        return view('dashboard.kwarran.pengguna.index', compact('users'));
    }

    public function penggunaCreate()
    {
        $regions = Region::where('type', 'gudep')
                    ->where('parent_id', Auth::user()->region_id)
                    ->get();

        return view('dashboard.kwarran.pengguna.create', compact('regions'));
    }

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

    public function penggunaEdit(User $user)
    {
        $this->authorizeUser($user);

        $regions = Region::where('type', 'gudep')
                    ->where('parent_id', Auth::user()->region_id)
                    ->get();

        return view('dashboard.kwarran.pengguna.edit', compact('user', 'regions'));
    }

    public function penggunaUpdate(Request $request, User $user)
    {
        $this->authorizeUser($user);

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'region_id' => 'required|exists:region,id',
            'password'  => 'nullable|min:8|confirmed',
        ]);

        // Pastikan region tersebut benar-benar milik kwarran yang login
        $region = Region::where('id', $request->region_id)
                        ->where('parent_id', Auth::user()->region_id)
                        ->firstOrFail();

        // Update user
        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'region_id' => $region->id,
            'password'  => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('kwarran.pengguna.index')->with('success', 'Akun berhasil diperbarui');
    }

    public function penggunaDestroy(User $user)
    {
        $this->authorizeUser($user);
        $user->delete();

        return redirect()->route('kwarran.pengguna.index')->with('success', 'Akun berhasil dihapus');
    }

    protected function authorizeUser(User $user)
    {
        // Hanya izinkan user yang berada di wilayah bawahannya (anak region)
        $allowedRegionIds = Region::where('parent_id', Auth::user()->region_id)->pluck('id');

        if (! $allowedRegionIds->contains($user->region_id)) {
            abort(403, 'Akses ditolak.');
        }
    }

}
