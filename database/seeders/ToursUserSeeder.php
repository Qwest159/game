<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Models\ToursUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToursUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //   $table->foreignId('user_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('caract_tour_id')->constrained();
        ToursUser::factory()->create([
            "user_id" => 1,
            "caract_tour_id" => 5,
            "hp_restant" => 5,
        ]);
        ToursUser::factory()->create([
            "user_id" => 1,
            "caract_tour_id" => 1,
            "hp_restant" => 3,
        ]);
        ToursUser::factory()->create([
            "user_id" => 1,
            "caract_tour_id" => 9,
            "hp_restant" => 8,
        ]);
    }
}
