<?php

namespace Database\Seeders;

use App\Models\AttaqueUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttaqueUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttaqueUser::factory()->create([
            "user_id" => 1,
            "attaque_id" => 1,
        ]);
        AttaqueUser::factory()->create([
            "user_id" => 1,
            "attaque_id" => 2,
        ]);
        AttaqueUser::factory()->create([
            "user_id" => 1,
            "attaque_id" => 3,
        ]);
        AttaqueUser::factory()->create([
            "user_id" => 1,
            "attaque_id" => 4,
        ]);
    }
}
