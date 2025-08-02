<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Region;

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $userIds = User::pluck('id')->toArray();
        $regionIds = Region::pluck('id')->toArray();
        $kategoriList = ['Gaji', 'Transportasi', 'Makanan', 'Belanja', 'Hiburan', 'Investasi', 'Tagihan', 'Donasi', 'Lainnya'];

        for ($i = 0; $i < 500; $i++) {
            DB::table('keuangan')->insert([
                'region_id'   => $faker->optional()->randomElement($regionIds),
                'user_id'     => $faker->randomElement($userIds),
                'jenis'       => $faker->randomElement(['pemasukan', 'pengeluaran']),
                'kategori'    => $faker->randomElement($kategoriList),
                'jumlah'      => $faker->randomFloat(2, 10000, 10000000), // antara 10rb - 10jt
                'tanggal'     => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'keterangan'  => $faker->optional()->sentence(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
