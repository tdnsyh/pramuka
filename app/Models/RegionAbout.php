<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegionAbout extends Model
{
    use HasFactory;

    protected $table = 'region_about';

    protected $fillable = [
        'region_id',
        'isi',
        'logo',
        'foto',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
