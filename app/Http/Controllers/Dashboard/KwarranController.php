<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Anggota;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class KwarranController extends Controller
{
    /**
     * dashboard kwarran
     */
    public function kwarranDashboard()
    {
        return view('dashboard.kwarran.index');
    }

    /**
     * wilayah
     */
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

    /**
     * Pengguna
     */
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
        $this->authorizeUser($user);

        $regions = Region::where('type', 'gudep')
                    ->where('parent_id', Auth::user()->region_id)
                    ->get();

        return view('dashboard.kwarran.pengguna.edit', compact('user', 'regions'));
    }

    // update pengguna
    public function penggunaUpdate(Request $request, User $user)
    {
        $this->authorizeUser($user);

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
        $this->authorizeUser($user);
        $user->delete();

        return redirect()->route('kwarran.pengguna.index')->with('success', 'Akun berhasil dihapus');
    }

    protected function authorizeUser(User $user)
    {
        $allowedRegionIds = Region::where('parent_id', Auth::user()->region_id)->pluck('id');

        if (! $allowedRegionIds->contains($user->region_id)) {
            abort(403, 'Akses ditolak.');
        }
    }

    public function anggotaIndex()
    {
        $gudepIds = Region::where('parent_id', Auth::user()->region_id)->pluck('id');
        $anggota = Anggota::whereIn('region_id', $gudepIds)->get();

        return view('dashboard.kwarran.anggota.index', compact('anggota'));
    }

    public function anggotaCreate()
    {
        $regions = Region::where('parent_id', Auth::user()->region_id)->get();
        return view('dashboard.kwarran.anggota.create', compact('regions'));
    }

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

    public function anggotaEdit(Anggota $anggota)
    {
        $this->authorizeRegion($anggota->region_id);

        $regions = Region::where('parent_id', Auth::user()->region_id)->get();
        return view('dashboard.kwarran.anggota.edit', compact('anggota', 'regions'));
    }

    public function anggotaUpdate(Request $request, Anggota $anggota)
    {
        $this->authorizeRegion($anggota->region_id);

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

    public function anggotaShow(Anggota $anggota)
    {
        $this->authorizeRegion($anggota->region_id);

        return view('dashboard.kwarran.anggota.show', compact('anggota'));
    }

    public function anggotaDestroy(Anggota $anggota)
    {
        $this->authorizeRegion($anggota->region_id);

        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }

        $anggota->delete();

        return redirect()->route('kwarran.anggota.index')->with('success', 'Anggota berhasil dihapus');
    }

    private function authorizeRegion($region_id)
    {
        $gudepIds = Region::where('parent_id', Auth::user()->region_id)->pluck('id')->toArray();

        if (!in_array($region_id, $gudepIds)) {
            abort(403, 'Tidak diizinkan mengakses anggota ini.');
        }
    }

    // profil owner
    public function profilIndex()
    {
        $user = Auth::user();
        return view('dashboard.kwarran.profil.index', compact('user'));
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

        return back()->with('kwarran', 'Profil berhasil diperbarui.');
    }

    public function kegiatanIndex()
    {
        return view('dashboard.kwarran.kegiatan.index');
    }

    public function keuanganIndex()
    {
        return view('dashboard.kwarran.keuangan.index');
    }

    public function tentangIndex()
    {
        return view('dashboard.kwarran.tentang.index');
    }
}
