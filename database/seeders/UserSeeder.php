<?php

namespace Database\Seeders;

// database/seeders/UserSeeder.php
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'usertype' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::factory()->count(9)->create();
    }
}
