<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Daniel Núñez',
            'email' => 'danielnuso@gmail.com',
            'password' => bcrypt('demo94'),
        ]);
    }
}
