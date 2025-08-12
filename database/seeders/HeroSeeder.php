<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Hero::factory()->create([
            'img_path' => '/hero/guerrier1.png',
            'role' => 'Guerrier',
            'portrait' => '/hero/portrait_guerrier1.png',
            'niveau' => 1,
            'hp_restant' => 5,
            'exp_restant' => 200,
            'caract_hero_id' => 1,
            'user_id' => 1,
        ]);
    }
}
