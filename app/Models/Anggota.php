<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'name', 'nta', 'pangkalan', 'golongan', 'jabatan',
        'foto', 'status', 'region_id',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
