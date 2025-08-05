<?php

namespace Database\Seeders;

use App\Models\ToursLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToursLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // 15,18,21
    public function run(): void
    {
        ToursLevel::factory()->create([
            'niveau' => 1,
            'hp' => 3,
            'att' => 8,
            'def' => 4,
            'gold_requis' => 500,
            'tour_id' => 1,
        ]);
        ToursLevel::factory()->create([
            'niveau' => 2,
            'hp' => 3,
            'att' => 10,
            'def' => 5,
            'gold_requis' => 600,
            'tour_id' => 1,
        ]);
        ToursLevel::factory()->create([
            'niveau' => 3,
            'hp' => 4,
            'att' => 12,
            'def' => 5,
            'gold_requis' => 800,
            'tour_id' => 1,
        ]);


        ToursLevel::factory()->create([
            'niveau' => 1,
            'hp' => 5,
            'att' => 3,
            'def' => 7,
            'gold_requis' => 500,
            'tour_id' => 2,
        ]);
        ToursLevel::factory()->create([
            'niveau' => 2,
            'hp' => 5,
            'att' => 4,
            'def' => 9,
            'gold_requis' => 600,
            'tour_id' => 2,
        ]);
        ToursLevel::factory()->create([
            'niveau' => 3,
            'hp' => 5,
            'att' => 5,
            'def' => 11,
            'gold_requis' => 800,
            'tour_id' => 2,
        ]);

        ToursLevel::factory()->create([
            'niveau' => 1,
            'hp' => 8,
            'att' => 2,
            'def' => 5,
            'gold_requis' => 500,
            'tour_id' => 3,
        ]);
        ToursLevel::factory()->create([
            'niveau' => 2,
            'hp' => 10,
            'att' => 3,
            'def' => 5,
            'gold_requis' => 600,
            'tour_id' => 3,
        ]);
        ToursLevel::factory()->create([
            'niveau' => 3,
            'hp' => 12,
            'att' => 4,
            'def' => 5,
            'gold_requis' => 800,
            'tour_id' => 3,
        ]);


        ToursLevel::factory()->create([
            'niveau' => 1,
            'hp' => 5,
            'att' => 5,
            'def' => 5,
            'gold_requis' => 500,
            'tour_id' => 4,
        ]);
        ToursLevel::factory()->create([
            'niveau' => 2,
            'hp' => 6,
            'att' => 6,
            'def' => 6,
            'gold_requis' => 600,
            'tour_id' => 4,
        ]);
        ToursLevel::factory()->create([
            'niveau' => 3,
            'hp' => 7,
            'att' => 7,
            'def' => 7,
            'gold_requis' => 800,
            'tour_id' => 4,
        ]);


        ToursLevel::factory()->create([
            'niveau' => 1,
            'hp' => 3,
            'att' => 2,
            'def' => 10,
            'gold_requis' => 500,
            'tour_id' => 5,
        ]);
        ToursLevel::factory()->create([
            'niveau' => 2,
            'hp' => 4,
            'att' => 2,
            'def' => 12,
            'gold_requis' => 600,
            'tour_id' => 5,
        ]);
        ToursLevel::factory()->create([
            'niveau' => 3,
            'hp' => 4,
            'att' => 3,
            'def' => 14,
            'gold_requis' => 800,
            'tour_id' => 5,
        ]);
    }
}
