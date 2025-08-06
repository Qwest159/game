<?php

namespace Database\Seeders;

use App\Models\Monstre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonstreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Monstre::factory()->create([
            'img_path' => '/monstre/monstre1.png',
            // 'role' => '',
        ]);
        Monstre::factory()->create([
            'img_path' => '/monstre/monstre2.png',
            // 'role' => '',
        ]);
        Monstre::factory()->create([
            'img_path' => '/monstre/monstre3.png',
            // 'role' => '',
        ]);
    }
}
