<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the product_category table
        for ($i = 0; $i < 10; $i++) {
            DB::table('product_category')->insert([
                'name' => 'Category ' . $i,
                'desc' => 'Description for category ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed the product_inventory table
        for ($i = 0; $i < 10; $i++) {
            DB::table('product_inventory')->insert([
                'quantity' => rand(100, 500),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed the products table
        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'name' => 'Product ' . $i,
                'desc' => 'Description for product ' . $i,
                'SKU' => Str::random(10),
                'price' => rand(100, 500),
                'image' => 'Tralai.png',
                'category_id' => rand(1, 10),
                'inventory_id' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed the user table
        for ($i = 0; $i < 10; $i++) {
            DB::table('user')->insert([
                'username' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role' => ($i % 2 == 0) ? 'admin' : 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed the order_details table
        for ($i = 0; $i < 10; $i++) {
            DB::table('order_details')->insert([
                'status' => ($i % 2 == 0) ? 'completed' : 'pending',
                'total' => rand(1000, 5000),
                'user_id' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed the order_items table
        for ($i = 0; $i < 10; $i++) {
            DB::table('order_items')->insert([
                'order_detail_id' => rand(1, 10),
                'product_id' => rand(1, 10),
                'quantity' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
