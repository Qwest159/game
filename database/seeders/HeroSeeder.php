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
            'niveau' => 1,
            'hp' => 5,
            'att' => 5,
            'def' => 5,
            'exp' => 500,
        ]);
        Hero::factory()->create([
            'niveau' => 2,
            'hp' => 6,
            'att' => 5,
            'def' => 7,
            'exp' => 600,
        ]);
        Hero::factory()->create([
            'niveau' => 3,
            'hp' => 6,
            'att' => 6,
            'def' => 9,
            'exp' => 800,
        ]);
        Hero::factory()->create([
            'niveau' => 4,
            'hp' => 7,
            'att' => 7,
            'def' => 10,
            'exp' => 1000,
        ]);


        Hero::factory()->create([
            'niveau' => 1,
            'hp' => 4,
            'att' => 7,
            'def' => 4,
            'exp' => 500,
        ]);
        Hero::factory()->create([
            'niveau' => 2,
            'hp' => 6,
            'att' => 8,
            'def' => 4,
            'exp' => 600,
        ]);
        Hero::factory()->create([
            'niveau' => 3,
            'hp' => 7,
            'att' => 9,
            'def' => 5,
            'exp' => 800,
        ]);
        Hero::factory()->create([
            'niveau' => 4,
            'hp' => 8,
            'att' => 10,
            'def' => 6,
            'exp' => 1000,
        ]);
    }
}
