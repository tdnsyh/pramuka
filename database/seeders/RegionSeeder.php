<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
    {
        // Buat 20 kwarran
        $kwarrans = [];

        for ($i = 1; $i <= 20; $i++) {
            $kwarrans[] = Region::create([
                'name' => 'Kwarran ' . $i,
                'type' => 'kwarran',
                'parent_id' => null,
            ]);
        }

        // Buat 32 gudep dan sebar ke 20 kwarran (rata +/-)
        $gudepCount = 32;
        $gudepIndex = 1;

        while ($gudepIndex <= $gudepCount) {
            foreach ($kwarrans as $kwarran) {
                if ($gudepIndex > $gudepCount) break;

                Region::create([
                    'name' => 'Gudep ' . str_pad($gudepIndex, 3, '0', STR_PAD_LEFT),
                    'type' => 'gudep',
                    'parent_id' => $kwarran->id,
                ]);

                $gudepIndex++;
            }
        }
    }
}
