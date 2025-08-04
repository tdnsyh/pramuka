<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\KegiatanPendaftaran;
use App\Models\Kegiatan;
use App\Models\Region;
use Illuminate\Support\Carbon;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;
use App\Models\KegiatanGaleri;

class PublicController extends Controller
{
    // landing page
    public function publicIndex()
    {
        $kegiatan = Kegiatan::whereDate('tanggal', '<=', Carbon::today())->orderBy('tanggal', 'desc')->get();
        $agenda = Kegiatan::whereDate('tanggal', '>', Carbon::today())->orderBy('tanggal', 'asc')->get();

        $jumlahGudep = Region::where('type', 'gudep')->count();
        $jumlahKwarran = Region::where('type', 'kwarran')->count();

        $jumlahAnggotaAktif = Anggota::where('status', 'aktif')->count();
        $anggotaPerGolongan = Anggota::select('golongan', DB::raw('count(*) as total'))
                                    ->where('status', 'aktif')
                                    ->groupBy('golongan')
                                    ->pluck('total', 'golongan');

        $galeri = KegiatanGaleri::latest()->take(10)->get();

        return view('public.index', compact(
            'kegiatan',
            'agenda',
            'jumlahGudep',
            'jumlahKwarran',
            'jumlahAnggotaAktif',
            'anggotaPerGolongan',
            'galeri'
        ));
    }

    // daftar kegiatan
    public function kegiatanIndex()
    {
        $kegiatan = Kegiatan::with('region')
                    ->whereDate('tanggal', '<=', Carbon::today())
                    ->orderBy('tanggal', 'desc')
                    ->get();

        $agenda = Kegiatan::with('region')
                    ->whereDate('tanggal', '>', Carbon::today())
                    ->orderBy('tanggal', 'asc')
                    ->get();

        return view('public.kegiatan.index', compact(
            'kegiatan',
            'agenda',
        ));
    }

    // detail kegiatan
    public function kegiatanShow($slug)
    {
        $kegiatan = Kegiatan::with('region')
                            ->withCount('pendaftaran')
                            ->where('slug', $slug)->firstOrFail();

        return view('public.kegiatan.show', compact('kegiatan'));
    }

    // form daftar kegiatan
    public function kegiatanDaftar($slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();
        return view('public.kegiatan.formulir', compact('kegiatan'));
    }

    // berhasil daftar kegiatan, kembalikan ke view berhasl
    public function kegiatanBerhasil($slug, $kode)
    {
        $kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();

        $pendaftar = KegiatanPendaftaran::where('kode_registrasi', $kode)
            ->where('kegiatan_id', $kegiatan->id)
            ->firstOrFail();

        return view('public.kegiatan.berhasil', compact('kegiatan', 'pendaftar'));
    }

    // submit form pendaftaran kegiatan
    public function kegiatanSubmit(Request $request, $slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:255',
            'asal' => 'nullable|string|max:255',
            'asal_gudep' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
            'catatan' => 'nullable|string',
        ]);

        do {
            $kode = 'REG-' . strtoupper(Str::random(6));
        } while (KegiatanPendaftaran::where('kode_registrasi', $kode)->exists());

        $pendaftaran = KegiatanPendaftaran::create([
            'kegiatan_id' => $kegiatan->id,
            'kode_registrasi' => $kode,
            'nama' => $request->nama,
            'asal' => $request->asal,
            'asal_gudep' => $request->asal_gudep,
            'kontak' => $request->kontak,
            'jenis_kelamin' => $request->jenis_kelamin,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kegiatan.berhasil', [
            'slug' => $slug,
            'kode' => $kode,
        ]);
    }

    public function kwarranIndex()
    {
        $kwarrans = Region::where('type', 'kwarran')->get();
        return view('public.kwarran.index', compact('kwarrans'));
    }

    public function gudepIndex()
    {
        $gudeps = Region::where('type', 'gudep')->get();
        return view('public.gudep.index', compact('gudeps'));
    }

    public function kwarranShow(Region $kwarran)
    {
        abort_unless($kwarran->type === 'kwarran', 404);

        $about = $kwarran->about;
        $gudepList = Region::where('parent_id', $kwarran->id)
            ->where('type', 'gudep')
            ->get();

        return view('public.kwarran.show', compact('kwarran', 'about', 'gudepList'));
    }

    public function gudepShow(Region $gudep)
    {
        abort_unless($gudep->type === 'gudep', 404);

        $kwarran = $gudep->parent;
        $about = $gudep->about;

        return view('public.kwarran.gudep', compact('gudep', 'kwarran', 'about'));
    }

    public function tentangKwarcab()
    {
        return view('public.tentang.index');
    }

}
