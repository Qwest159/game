<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        Role::factory()->create([
            'role' => 'Guerrier',
            'role_precedent' => NULL,
            'niveau_requis' => 1,
        ]);
        Role::factory()->create([
            'role' => 'Magicien',
            'role_precedent' => NULL,
            'niveau_requis' => 1,
        ]);








        // ----Guerrier----
        Role::factory()->create([
            'role' => 'Chevalier',
            'role_precedent' => 'Guerrier',
            'niveau_requis' => 5,
        ]);
        Role::factory()->create([
            'role' => 'Paladin',
            'role_precedent' => 'Chevalier',
            'niveau_requis' => 10,
        ]);
        // ----MAGICIEN----

        Role::factory()->create([
            'role' => 'Savant',
            'role_precedent' => 'Magicien',
            'niveau_requis' => 5,
        ]);
        Role::factory()->create([
            'role' => 'Alchimiste',
            'role_precedent' => 'Savant',
            'niveau_requis' => 10,
        ]);
    }
}
