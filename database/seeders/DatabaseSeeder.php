<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// database/seeders/DatabaseSeeder.php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoomSeeder::class,
            BookingSeeder::class,
            UserSeeder::class,
        ]);
    }
}
