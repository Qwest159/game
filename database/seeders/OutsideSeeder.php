<?php

namespace Database\Seeders;

use App\Models\Outside;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutsideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Outside::factory()->create([
            'img_path' => '/outside/plaine.png',
        ]);
        Outside::factory()->create([
            'img_path' => '/outside/montagne.png',
        ]);



        // A EFFACER
        Outside::factory()->create([
            'img_path' => '/outside/plaine.png',
        ]);
        Outside::factory()->create([
            'img_path' => '/outside/montagne.png',
        ]);
        Outside::factory()->create([
            'img_path' => '/outside/plaine.png',
        ]);
        Outside::factory()->create([
            'img_path' => '/outside/montagne.png',
        ]);
        Outside::factory()->create([
            'img_path' => '/outside/plaine.png',
        ]);
        Outside::factory()->create([
            'img_path' => '/outside/montagne.png',
        ]);
        Outside::factory()->create([
            'img_path' => '/outside/plaine.png',
        ]);
        Outside::factory()->create([
            'img_path' => '/outside/montagne.png',
        ]);
        Outside::factory()->create([
            'img_path' => '/outside/plaine.png',
        ]);
        Outside::factory()->create([
            'img_path' => '/outside/montagne.png',
        ]);
    }
}
