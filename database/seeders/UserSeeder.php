<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Liamtseva\Cinema\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(20)->create();
    }
}
