<?php

namespace Database\Seeders;

use App\Models\CaractHero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaractHeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        CaractHero::factory()->create([
            'niveau' => 1,
            'hp' => 5,
            'att' => 5,
            'def' => 5,
            'exp_requis' => 500,
        ]);
        CaractHero::factory()->create([
            'niveau' => 2,
            'hp' => 6,
            'att' => 5,
            'def' => 7,
            'exp_requis' => 600,
        ]);
        CaractHero::factory()->create([
            'niveau' => 3,
            'hp' => 6,
            'att' => 6,
            'def' => 9,
            'exp_requis' => 800,
        ]);
        CaractHero::factory()->create([
            'niveau' => 4,
            'hp' => 7,
            'att' => 7,
            'def' => 10,
            'exp_requis' => 1000,
        ]);


        CaractHero::factory()->create([
            'niveau' => 1,
            'hp' => 4,
            'att' => 7,
            'def' => 4,
            'exp_requis' => 500,
        ]);
        CaractHero::factory()->create([
            'niveau' => 2,
            'hp' => 6,
            'att' => 8,
            'def' => 4,
            'exp_requis' => 600,
        ]);
        CaractHero::factory()->create([
            'niveau' => 3,
            'hp' => 7,
            'att' => 9,
            'def' => 5,
            'exp_requis' => 800,
        ]);
        CaractHero::factory()->create([
            'niveau' => 4,
            'hp' => 8,
            'att' => 10,
            'def' => 6,
            'exp_requis' => 1000,
        ]);
    }
}
