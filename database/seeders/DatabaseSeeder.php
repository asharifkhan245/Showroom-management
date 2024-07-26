<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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

        User::insert([
            ['name' => 'Test User 1', 'email' => 'test1@example.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now(), 'email_verified_at' => now(), 'remember_token' => Str::random(10)],
            ['name' => 'Test User 2', 'email' => 'test2@example.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now(), 'email_verified_at' => now(), 'remember_token' => Str::random(10)],
            ['name' => 'Test User 3', 'email' => 'test3@example.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now(), 'email_verified_at' => now(), 'remember_token' => Str::random(10)],
        ]);

    }
}
