<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // panggil seeder lain, misal AdminSeeder
        $this->call([
            AdminSeeder::class,
        ]);
    }
}
