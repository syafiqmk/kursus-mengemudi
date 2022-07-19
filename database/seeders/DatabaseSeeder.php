<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('passadmin'),
            'role' => 'admin',
        ]);

        Transmission::create([
            'name' => 'Automatic'
        ]);

        Transmission::create([
            'name' => 'Manual'
        ]);
    }
}
