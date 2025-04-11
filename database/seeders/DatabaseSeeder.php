<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'last_name' => 'dela Cruz',
            'first_name' => 'Juan',
            'phone' => '123456789',
            'designation' => 'Contractor',
            'email' => 'test@example.com',
            'password' => bcrypt('aa')
        ]);

        $this->call(ProductSeeder::class);
    }
}
