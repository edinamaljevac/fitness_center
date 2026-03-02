<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $package = Package::create([
            'naziv' => 'Mesečni paket',
            'opis' => 'Osnovni mesečni paket',
            'cena' => 3000,
            'trajanje_dana' => 30,
            'aktivan' => true,
            'tip' => 'M',
        ]);
    }
}
