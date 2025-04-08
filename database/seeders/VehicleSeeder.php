<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $path = public_path('img/kendaraan');
        $files = File::files($path);

        foreach ($files as $file) {
            $filename = $file->getFilename();

            // Abaikan file non-gambar atau file gridmap
            if (!preg_match('/\.(jpg|jpeg|png|gif)$/i', $filename)) continue;
            if (strtolower(pathinfo($filename, PATHINFO_FILENAME)) === 'gridmap') continue;

            $name = pathinfo($filename, PATHINFO_FILENAME); // contoh: A1, F2, NT
            $code = strtoupper($name);

            Vehicle::updateOrCreate(
                ['code' => $code],
                [
                    'name' => 'Kendaraan ' . $code,
                    'code' => $code,
                    'image' => $filename,
                ]
            );
        }
    }
}
