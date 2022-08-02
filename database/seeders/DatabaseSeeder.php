<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Brand;
use App\Models\Transmission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        //user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('passadmin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Syafiq Muhammad Kahfi',
            'email' => 'syafiq@mail.com',
            'password' => bcrypt('passsyafiq'),
            'role' => 'student',
        ]);

        User::create([
            'name' => 'Ken Block',
            'email' => 'block@mail.com',
            'password' => bcrypt('passblock'),
            'role' => 'instructor',
            'status' => 'ready'
        ]);

        //transmission
        Transmission::create([
            'name' => 'Automatic'
        ]);

        Transmission::create([
            'name' => 'Manual'
        ]);

        Transmission::create([
            'name' => 'Electric'
        ]);

        //brand
        Brand::create([
            'name' => 'Daihatsu'
        ]);
    }
}
