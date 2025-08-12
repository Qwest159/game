<?php

namespace Database\Seeders;

use App\Models\Personnage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonnageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Personnage::factory()->create([
            'img_path' => '/hero/guerrier1.png',
            'portrait' => '/hero/portrait_guerrier1.png',
        ]);
        Personnage::factory()->create([
            'img_path' => '/hero/guerrier2.png',
            'portrait' => '/hero/portrait_guerrier1.png',
        ]);
        Personnage::factory()->create([
            'img_path' => '/hero/magicien.png',
            'portrait' => '/hero/portrait_magicien.png',
        ]);
        Personnage::factory()->create([
            'img_path' => '/hero/magicien.png',
            'portrait' => '/hero/portrait_magicien.png',
        ]);
    }
}
