<?php

namespace Database\Seeders;

use App\Models\CaractMonstre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaractMonstreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CaractMonstre::factory()->create([
            'niveau' => 1,
            'hp' => 3,
            'att' => 2,
            'def' => 2,
            'exp' => 100,
        ]);
        CaractMonstre::factory()->create([
            'niveau' => 2,
            'hp' => 5,
            'att' => 4,
            'def' => 4,
            'exp' => 200,
        ]);
        CaractMonstre::factory()->create([
            'niveau' => 3,
            'hp' => 7,
            'att' => 9,
            'def' => 5,
            'exp' => 300,
        ]);
        CaractMonstre::factory()->create([
            'niveau' => 4,
            'hp' => 8,
            'att' => 10,
            'def' => 6,
            'exp' => 400,
        ]);
    }
}
