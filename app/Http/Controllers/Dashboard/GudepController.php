<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class GudepController extends Controller
{
    public function gudepDashboard()
    {
        return view('dashboard.gudep.index');
    }

    public function anggotaIndex()
    {
        $anggota = Anggota::where('region_id', Auth::user()->region_id)->get();
        return view('dashboard.gudep.anggota.index', compact('anggota'));
    }

    public function anggotaCreate()
    {
        return view('dashboard.gudep.anggota.create');
    }

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

        return redirect('/gudep/anggota')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function anggotaEdit($id)
    {
        $anggota = Anggota::where('id', $id)
            ->where('region_id', Auth::user()->region_id)
            ->firstOrFail();

        return view('dashboard.gudep.anggota.edit', compact('anggota'));
    }

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

        return redirect('/gudep/anggota')->with('success', 'Data anggota berhasil diperbarui');
    }

    public function anggotaDestroy($id)
    {
        $anggota = Anggota::where('id', $id)
            ->where('region_id', Auth::user()->region_id)
            ->firstOrFail();

        if ($anggota->foto) {
            Storage::delete($anggota->foto);
        }

        $anggota->delete();

        return redirect('/gudep/anggota')->with('success', 'Anggota berhasil dihapus');
    }

    public function anggotaShow($id)
    {
        $anggota = Anggota::where('id', $id)
            ->where('region_id', Auth::user()->region_id)
            ->firstOrFail();

        return view('dashboard.gudep.anggota.show', compact('anggota'));
    }

    // profil owner
    public function profilIndex()
    {
        $user = Auth::user();
        return view('dashboard.gudep.profil.index', compact('user'));
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

    // keuangan
    public function keuanganIndex()
    {
        return view('dashboard.gudep.keuangan.index');
    }

    // tentang
    public function tentangIndex()
    {
        return view('dashboard.gudep.tentang.index');
    }

}
