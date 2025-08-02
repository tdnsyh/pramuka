<?php

namespace App\Imports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AnggotaImport implements ToCollection, WithHeadingRow
{
    protected $region_id;

    public function __construct($region_id)
    {
        $this->region_id = $region_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Anggota::create([
                'name' => $row['name'],
                'nta' => $row['nta'],
                'pangkalan' => $row['pangkalan'],
                'golongan' => $row['golongan'],
                'jabatan' => $row['jabatan'],
                'foto' => $row['foto'],
                'status' => $row['status'],
                'region_id' => $this->region_id,
            ]);
        }
    }
}
