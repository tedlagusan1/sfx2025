<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user to associate with products
        $user = User::first();

        if (!$user) {
            // Create a default user if none exists
            $user = User::create([
                'last_name' => 'Admin',
                'first_name' => 'System',
                'phone' => '1234567890',
                'designation' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'email_validated_at' => now(),
            ]);
        }

        $products = [
            [
                'name' => 'Mixed Nuts Coffee',
                'description' => 'A astounding mix of high quality coffee, almond nuts, and other herbs',
                'price' => 450.75,
                'status' => 1, // Available
                'user_id' => $user->id
            ],
            [
                'name' => 'Barley Fine Wine',
                'description' => 'A beautiful blend of barley into a sophisticated wine.',
                'price' => 1450.80,
                'status' => 1, // Available
                'user_id' => $user->id
            ],
            [
                'name' => 'Organic Green Tea',
                'description' => 'Premium organic green tea from the finest tea gardens.',
                'price' => 320.50,
                'status' => 0, // Pending
                'user_id' => $user->id
            ],
            [
                'name' => 'Dark Chocolate Truffles',
                'description' => 'Handcrafted dark chocolate truffles with a rich, intense flavor.',
                'price' => 580.25,
                'status' => 2, // Reserved
                'user_id' => $user->id
            ],
            [
                'name' => 'Artisan Bread Selection',
                'description' => 'A selection of freshly baked artisan breads including sourdough, rye, and multigrain.',
                'price' => 275.00,
                'status' => 3, // Sold
                'user_id' => $user->id
            ]
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }
    }
}
