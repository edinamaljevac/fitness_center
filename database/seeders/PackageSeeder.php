<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\MonthlyPackage;

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

        MonthlyPackage::create([
            'package_id' => $package->id,
            'broj_dolazaka' => 20,
            'ukljucuje_grupne' => true,
        ]);
    }
}
