<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggota;
use App\Models\Region;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil hanya region dengan type 'gudep'
        $regionGudepIds = Region::where('type', 'gudep')->pluck('id');

        if ($regionGudepIds->isEmpty()) {
            $this->command->warn('Tidak ada region dengan type "gudep". Seeder tidak dijalankan.');
            return;
        }

        $golonganList = ['siaga', 'penggalang', 'penegak', 'pandega'];
        $jabatanList = ['Ketua', 'Wakil', 'Sekretaris', 'Bendahara', null];

        foreach (range(1, 500) as $i) {
            Anggota::create([
                'name' => fake('id_ID')->name(),
                'nta' => 'NTA' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'pangkalan' => 'SMPN ' . fake()->numberBetween(1, 5) . ' Padakembang',
                'golongan' => fake()->randomElement($golonganList),
                'jabatan' => fake()->randomElement($jabatanList),
                'foto' => null,
                'status' => fake()->randomElement(['aktif', 'nonaktif']),
                'region_id' => fake()->randomElement($regionGudepIds),
            ]);
        }

        $this->command->info('Seeder anggota untuk region bertipe gudep berhasil dijalankan.');
    }
}
