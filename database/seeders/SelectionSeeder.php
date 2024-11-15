<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Liamtseva\Cinema\Models\Selection;

class SelectionSeeder extends Seeder
{
    public function run(): void
    {
        Selection::factory()->count(100)->create();
    }
}
