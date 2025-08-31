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

        // attention ID role_id (= role à upgrade)

        CaractHero::factory()->create([
            'niveau' => 1,
            'hp' => 8,
            'att' => 5,
            'def' => 5,
            'exp_requis' => 500,
            'role_id' => 1,
        ]);
        CaractHero::factory()->create([
            'niveau' => 2,
            'hp' => 9,
            'att' => 5,
            'def' => 7,
            'exp_requis' => 600,
            'role_id' => 1,
        ]);
        CaractHero::factory()->create([
            'niveau' => 3,
            'hp' => 9,
            'att' => 6,
            'def' => 9,
            'exp_requis' => 800,
            'role_id' => 1,
        ]);
        CaractHero::factory()->create([
            'niveau' => 4,
            'hp' => 10,
            'att' => 7,
            'def' => 10,
            'exp_requis' => 1000,
            'role_id' => 1,
        ]);
        CaractHero::factory()->create([
            'niveau' => 5,
            'hp' => 12,
            'att' => 8,
            'def' => 12,
            'exp_requis' => 1000,
            'role_id' => 3,
        ]);




        CaractHero::factory()->create([
            'niveau' => 1,
            'hp' => 6,
            'att' => 7,
            'def' => 4,
            'exp_requis' => 500,
            'role_id' => 2,
        ]);
        CaractHero::factory()->create([
            'niveau' => 2,
            'hp' => 8,
            'att' => 8,
            'def' => 4,
            'exp_requis' => 600,
            'role_id' => 2,
        ]);
        CaractHero::factory()->create([
            'niveau' => 3,
            'hp' => 9,
            'att' => 9,
            'def' => 5,
            'exp_requis' => 800,
            'role_id' => 2,
        ]);
        CaractHero::factory()->create([
            'niveau' => 4,
            'hp' => 9,
            'att' => 10,
            'def' => 6,
            'exp_requis' => 1000,
            'role_id' => 2,
        ]);
        CaractHero::factory()->create([
            'niveau' => 5,
            'hp' => 10,
            'att' => 12,
            'def' => 7,
            'exp_requis' => 1000,
            'role_id' => 4,
        ]);
    }
}
