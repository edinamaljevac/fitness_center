<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        Package::create([
            'naziv' => 'Mesečni paket',
            'opis' => 'Neograničen pristup teretani',
            'cena' => 3000,
            'trajanje_dana' => 30,
            'aktivan' => true,
            'tip' => 'M',
        ]);

        Package::create([
            'naziv' => 'Personal 8',
            'opis' => '8 personalnih treninga mesečno',
            'cena' => 12000,
            'trajanje_dana' => 30,
            'aktivan' => true,
            'tip' => 'T',
        ]);
    }
}