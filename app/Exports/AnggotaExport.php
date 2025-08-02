<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class AnggotaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Load relasi region agar tidak N+1 query
        return Anggota::with('region')->get();
    }

    public function map($anggota): array
    {
        return [
            $anggota->name,
            $anggota->nta,
            $anggota->pangkalan,
            $anggota->golongan,
            $anggota->jabatan,
            $anggota->foto,
            $anggota->status,
            optional($anggota->region)->name ?? 'Tidak ada', // tampilkan nama region
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'NTA',
            'Pangkalan',
            'Golongan',
            'Jabatan',
            'Foto',
            'Status',
            'Region',
        ];
    }
}
