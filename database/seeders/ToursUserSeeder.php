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
        //     $table->foreignId('tours_level_id')->constrained();
        ToursUser::factory()->create([
            "user_id" => 1,
            "tours_level_id" => 5,
        ]);
        ToursUser::factory()->create([
            "user_id" => 1,
            "tours_level_id" => 1,
        ]);
        ToursUser::factory()->create([
            "user_id" => 1,
            "tours_level_id" => 9,
        ]);
    }
}
