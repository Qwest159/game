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
            'img_path' => '/hero/guerrier1.png',
            'role' => 'Guerrier',
            'portrait' => '/hero/portrait_guerrier1.png',
            'hero_id' => 1
        ]);
        Role::factory()->create([
            'img_path' => '/hero/guerrier2.png',
            'role' => 'Guerrier',
            'portrait' => '/hero/portrait_guerrier1.png',
            'hero_id' => 1
        ]);
        Role::factory()->create([
            'img_path' => '/hero/magicien.png',
            'role' => 'Magicien',
            'portrait' => '/hero/portrait_magicien.png',
            'hero_id' => 5
        ]);
        Role::factory()->create([
            'img_path' => '/hero/magicien.png',
            'role' => 'Magicien',
            'portrait' => '/hero/portrait_magicien.png',
            'hero_id' => 5
        ]);
    }
}
