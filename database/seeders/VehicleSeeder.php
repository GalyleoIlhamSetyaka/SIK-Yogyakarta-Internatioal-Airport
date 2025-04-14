<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        $vehicles = [
            [
                'name' => 'Ambulans 1',
                'code' => 'A1',
                'image' => 'A1.png'
            ],
            [
                'name' => 'Ambulans 2',
                'code' => 'A2',
                'image' => 'A2.png'
            ],
            [
                'name' => 'Ambulans 3',
                'code' => 'A3',
                'image' => 'A3.png'
            ],
            [
                'name' => 'Kendaraan Komando',
                'code' => 'C',
                'image' => 'C.png'
            ],
            [
                'name' => 'Pemadam Kebakaran 1',
                'code' => 'F1',
                'image' => 'F1.png'
            ],
            [
                'name' => 'Pemadam Kebakaran 2',
                'code' => 'F2',
                'image' => 'F2.png'
            ],
            [
                'name' => 'Pemadam Kebakaran 3',
                'code' => 'F3',
                'image' => 'F3.png'
            ],
            [
                'name' => 'Kendaraan Tangki',
                'code' => 'NT',
                'image' => 'NT.png'
            ],
            [
                'name' => 'Kendaraan Patroli',
                'code' => 'P',
                'image' => 'P.png'
            ],
            [
                'name' => 'Kendaraan Taktis',
                'code' => 'T',
                'image' => 'T.png'
            ],
            [
                'name' => 'Kendaraan Utilitas',
                'code' => 'U',
                'image' => 'U.png'
            ]
        ];

        DB::table('vehicles')->insert($vehicles);
    }
}