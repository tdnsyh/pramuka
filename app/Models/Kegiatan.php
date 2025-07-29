<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'deskripsi_pendek',
        'tanggal',
        'lokasi',
        'gambar',
        'region_id'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(KegiatanPendaftaran::class);
    }

    public function galeri()
    {
        return $this->hasMany(KegiatanGaleri::class);
    }
}
