<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marker;

class MarkerSeeder extends Seeder {
    public function run(): void {
        Marker::create([
            'vehicle_code' => 'A2',
            'message' => 'Van pengangkut personil',
            'x' => 200,
            'y' => 300,
        ]);
    }
    
}