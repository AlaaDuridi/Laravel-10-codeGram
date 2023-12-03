<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Jhon Doe',
            'email' => 'jhon.doe@example.com',
            'password' => 'jhondoe123',
        ]);
        User::create([
            'name' => 'Mark Lee',
            'email' => 'mark.lee@example.com',
            'password' => 'marklee123',
        ]);
    }
}
