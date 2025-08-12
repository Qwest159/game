<?php

namespace Database\Seeders;

use App\Models\Attaque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttaqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Attaque::factory()->create([
            'nom' => 'Attaque simple',
            'type' => 'normal',
            'role_id' => 1,
            'niveau' => 1,
            'att' => 1,
        ]);
        Attaque::factory()->create([
            'nom' => 'Kawashiri',
            'type' => 'feu',
            'role_id' => 1,
            'niveau' => 1,
            'att' => 2,
        ]);
        Attaque::factory()->create([
            'nom' => 'Coup de pied',
            'type' => 'normal',
            'role_id' => 1,
            'niveau' => 1,
            'att' => 3,
        ]);
        Attaque::factory()->create([
            'nom' => "Épée d'éclair",
            'type' => 'électrique',
            'role_id' => 1,
            'niveau' => 1,
            'att' => 1,
        ]);
    }
}
