<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders
        $this->call([
            RoleSeeder::class
        ]);

        // Call factories
        \App\Models\User::factory(10)->role('Customer')->create();

        \App\Models\User::factory(1)->role('Admin')->create();

        \App\Models\User::factory(5)->role('Realtor')->create();
    }
}
