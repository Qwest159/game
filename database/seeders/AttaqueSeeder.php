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
            'nom' => 'Lamo',
            'type' => 'eau',
            'role_id' => 1,
            'niveau' => 1,
            'att' => 2,
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
            'att' => 4,
        ]);
        Attaque::factory()->create([
            'nom' => "Épée d'éclair",
            'type' => 'électrique',
            'role_id' => 1,
            'niveau' => 1,
            'att' => 2,
        ]);

        // ------ LEVEL UP ------
        Attaque::factory()->create([
            'nom' => "Épée d'eau",
            'type' => 'eau',
            'role_id' => 1,
            'niveau' => 2,
            'att' => 4,
        ]);
        Attaque::factory()->create([
            'nom' => "Sainteplan",
            'type' => 'plante',
            'role_id' => 1,
            'niveau' => 3,
            'att' => 3,
        ]);
        Attaque::factory()->create([
            'nom' => "Attaque surprise",
            'type' => 'normal',
            'role_id' => 1,
            'niveau' => 4,
            'att' => 5,
        ]);




        // -------MAGICIEN-----

        Attaque::factory()->create([
            'nom' => 'Baguette simple',
            'type' => 'normal',
            'role_id' => 3,
            'niveau' => 1,
            'att' => 3,
        ]);
        Attaque::factory()->create([
            'nom' => 'KawaO',
            'type' => 'eau',
            'role_id' => 3,
            'niveau' => 1,
            'att' => 2,
        ]);
        Attaque::factory()->create([
            'nom' => 'Flamme',
            'type' => 'feu',
            'role_id' => 3,
            'niveau' => 1,
            'att' => 2,
        ]);
        Attaque::factory()->create([
            'nom' => "Flower",
            'type' => 'plante',
            'role_id' => 3,
            'niveau' => 1,
            'att' => 2,
        ]);

        // ------ LEVEL UP ------
        Attaque::factory()->create([
            'nom' => "Herbe",
            'type' => 'plante',
            'role_id' => 3,
            'niveau' => 3,
            'att' => 3,
        ]);
        Attaque::factory()->create([
            'nom' => "Feu follet",
            'type' => 'feu',
            'role_id' => 3,
            'niveau' => 3,
            'att' => 4,
        ]);
        Attaque::factory()->create([
            'nom' => "Baguette magique",
            'type' => 'normal',
            'role_id' => 3,
            'niveau' => 4,
            'att' => 5,
        ]);
    }
}
