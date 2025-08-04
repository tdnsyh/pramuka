<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Kegiatan;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        $data = [
            [
                'judul' => 'Kegiatan Bakti Sosial',
                'slug' => Str::slug('Kegiatan Bakti Sosial'),
                'deskripsi_pendek' => 'Kegiatan sosial bersama masyarakat sekitar.',
                'deskripsi' => 'Kami mengadakan kegiatan bakti sosial di desa terpencil untuk membantu warga yang membutuhkan.',
                'tanggal' => Carbon::parse('2025-07-10'),
                'lokasi' => 'Desa Cibadak',
                'region_id' => 1, // Pastikan ID ini sesuai dengan data di tabel region
            ],
            [
                'judul' => 'Pelatihan Kepemimpinan',
                'slug' => Str::slug('Pelatihan Kepemimpinan'),
                'deskripsi_pendek' => 'Melatih jiwa kepemimpinan anggota pramuka.',
                'deskripsi' => 'Pelatihan ini diadakan untuk membentuk karakter kepemimpinan generasi muda.',
                'tanggal' => Carbon::parse('2025-08-15'),
                'lokasi' => 'Gedung Pramuka Kota',
                'region_id' => 2,
            ],
            [
                'judul' => 'Camping dan Outbound',
                'slug' => Str::slug('Camping dan Outbound'),
                'deskripsi_pendek' => 'Kegiatan alam terbuka untuk melatih kerjasama dan kemandirian.',
                'deskripsi' => 'Kegiatan di alam terbuka yang menyenangkan dan penuh tantangan.',
                'tanggal' => Carbon::parse('2025-08-20'),
                'lokasi' => 'Bumi Perkemahan Cikole',
                'region_id' => 1,
            ],
        ];

        foreach ($data as $item) {
            Kegiatan::create($item);
        }
    }
}
