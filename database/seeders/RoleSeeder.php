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
            'upgrade' => 'Chevalier',
            'niveau_requis' => 5,
        ]);

        Role::factory()->create([
            'role' => 'Magicien',
            'upgrade' => 'Savant',
            'niveau_requis' => 10,
        ]);
        Role::factory()->create([
            'role' => 'Chevalier',
            'upgrade' => 'Paladin',
            'niveau_requis' => 5,
        ]);
        Role::factory()->create([
            'role' => 'Savant',
            'upgrade' => 'Alchimiste',
            'niveau_requis' => 10,
        ]);
    }
}
