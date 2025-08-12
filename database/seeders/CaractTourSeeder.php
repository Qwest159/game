<?php

namespace Database\Seeders;

use App\Models\CaractTour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaractTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CaractTour::factory()->create([
            'niveau' => 1,
            'hp' => 3,
            'att' => 8,
            'def' => 4,
            'gold_requis' => 500,
            'tour_id' => 1,
        ]);
        CaractTour::factory()->create([
            'niveau' => 2,
            'hp' => 3,
            'att' => 10,
            'def' => 5,
            'gold_requis' => 600,
            'tour_id' => 1,
        ]);
        CaractTour::factory()->create([
            'niveau' => 3,
            'hp' => 4,
            'att' => 12,
            'def' => 5,
            'gold_requis' => 800,
            'tour_id' => 1,
        ]);
        CaractTour::factory()->create([
            'niveau' => 4,
            'hp' => 5,
            'att' => 14,
            'def' => 5,
            'gold_requis' => 1000,
            'tour_id' => 1,
        ]);

        CaractTour::factory()->create([
            'niveau' => 1,
            'hp' => 5,
            'att' => 3,
            'def' => 7,
            'gold_requis' => 500,
            'tour_id' => 2,
        ]);
        CaractTour::factory()->create([
            'niveau' => 2,
            'hp' => 5,
            'att' => 4,
            'def' => 9,
            'gold_requis' => 600,
            'tour_id' => 2,
        ]);
        CaractTour::factory()->create([
            'niveau' => 3,
            'hp' => 5,
            'att' => 5,
            'def' => 11,
            'gold_requis' => 800,
            'tour_id' => 2,
        ]);
        CaractTour::factory()->create([
            'niveau' => 4,
            'hp' => 6,
            'att' => 5,
            'def' => 13,
            'gold_requis' => 1000,
            'tour_id' => 2,
        ]);

        CaractTour::factory()->create([
            'niveau' => 1,
            'hp' => 8,
            'att' => 2,
            'def' => 5,
            'gold_requis' => 500,
            'tour_id' => 3,
        ]);
        CaractTour::factory()->create([
            'niveau' => 2,
            'hp' => 10,
            'att' => 3,
            'def' => 5,
            'gold_requis' => 600,
            'tour_id' => 3,
        ]);
        CaractTour::factory()->create([
            'niveau' => 3,
            'hp' => 12,
            'att' => 4,
            'def' => 5,
            'gold_requis' => 800,
            'tour_id' => 3,
        ]);
        CaractTour::factory()->create([
            'niveau' => 4,
            'hp' => 14,
            'att' => 5,
            'def' => 5,
            'gold_requis' => 1000,
            'tour_id' => 3,
        ]);

        CaractTour::factory()->create([
            'niveau' => 1,
            'hp' => 5,
            'att' => 5,
            'def' => 5,
            'gold_requis' => 500,
            'tour_id' => 4,
        ]);
        CaractTour::factory()->create([
            'niveau' => 2,
            'hp' => 6,
            'att' => 6,
            'def' => 6,
            'gold_requis' => 600,
            'tour_id' => 4,
        ]);
        CaractTour::factory()->create([
            'niveau' => 3,
            'hp' => 7,
            'att' => 7,
            'def' => 7,
            'gold_requis' => 800,
            'tour_id' => 4,
        ]);
        CaractTour::factory()->create([
            'niveau' => 4,
            'hp' => 8,
            'att' => 8,
            'def' => 8,
            'gold_requis' => 1000,
            'tour_id' => 4,
        ]);

        CaractTour::factory()->create([
            'niveau' => 1,
            'hp' => 3,
            'att' => 2,
            'def' => 10,
            'gold_requis' => 500,
            'tour_id' => 5,
        ]);
        CaractTour::factory()->create([
            'niveau' => 2,
            'hp' => 4,
            'att' => 2,
            'def' => 12,
            'gold_requis' => 600,
            'tour_id' => 5,
        ]);
        CaractTour::factory()->create([
            'niveau' => 3,
            'hp' => 4,
            'att' => 3,
            'def' => 14,
            'gold_requis' => 800,
            'tour_id' => 5,
        ]);

        CaractTour::factory()->create([
            'niveau' => 4,
            'hp' => 5,
            'att' => 5,
            'def' => 14,
            'gold_requis' => 1000,
            'tour_id' => 5,
        ]);
    }
}
