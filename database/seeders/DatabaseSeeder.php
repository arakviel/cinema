<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            StudioSeeder::class,
            MovieSeeder::class,
            //SelectionSeeder::class, // допилити
        ]);
    }
}
