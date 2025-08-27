<?php

namespace Database\Seeders;


use App\Models\CaractMonstre;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'gold' => 5600,
            'new' => true,
        ]);


        $this->call([
            // RolesTableSeeder::class,
            TourSeeder::class,
            CaractTourSeeder::class,
            ToursUserSeeder::class,
            HeroSeeder::class,
            RoleSeeder::class,
            CaractHeroSeeder::class,
            MonstreSeeder::class,
            CaractMonstreSeeder::class,
            OutsideSeeder::class,
            AttaqueSeeder::class,
            PersonnageSeeder::class,
            AttaqueUserSeeder::class,
        ]);
    }
}
