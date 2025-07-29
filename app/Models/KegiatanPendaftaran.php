<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KegiatanPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_pendaftaran';

    protected $fillable = [
        'kegiatan_id',
        'kode_registrasi',
        'nama',
        'asal',
        'asal_gudep',
        'kontak',
        'jenis_kelamin',
        'catatan',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
