<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password')
        ]);
        User::factory(10)->create();
        Todo::factory(20)->create();
    }
}
