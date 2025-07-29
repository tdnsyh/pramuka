<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KegiatanGaleri extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_galeri';

    protected $fillable = [
        'gambar',
    ];
}
