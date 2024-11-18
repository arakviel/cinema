<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Liamtseva\Cinema\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        /*        $movie = Movie::factory()->count(1)->make();
                dump($movie->toArray());*/

        Movie::factory()->count(10)->create();
    }
}
