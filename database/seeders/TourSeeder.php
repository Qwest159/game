<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tour::factory()->create([
            'img_path' => '/tour/tour1.png',
        ]);
        Tour::factory()->create([
            'img_path' => '/tour/tour2.png',
        ]);
        Tour::factory()->create([
            'img_path' => '/tour/tour3.png',
        ]);
        Tour::factory()->create([
            'img_path' => '/tour/tour4.png',
        ]);
        Tour::factory()->create([
            'img_path' => '/tour/tour_bouclier.png',
        ]);
    }
}
