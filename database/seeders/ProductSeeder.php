<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn("No categories found. Run CategorySeeder first.");
            return;
        }

        $sampleProducts = [
            ['Smartphone', 'High-end smartphone with 128GB storage', 699.99, 'Electronics'],
            ['Bluetooth Headphones', 'Wireless over-ear headphones', 89.99, 'Electronics'],
            ['LED Desk Lamp', 'Adjustable lamp with touch controls', 24.99, 'Home & Kitchen'],
            ['Cookware Set', 'Non-stick pots and pans', 119.99, 'Home & Kitchen'],
            ['T-shirt', 'Cotton T-shirt with print', 15.00, 'Clothing'],
            ['Jeans', 'Slim fit denim jeans', 45.00, 'Clothing'],
            ['Jacket', 'Waterproof winter jacket', 89.00, 'Clothing'],
            ['Notebook', '200-page college-ruled notebook', 3.50, 'Books'],
            ['Sci-Fi Novel', 'Best-selling science fiction story', 12.99, 'Books'],
            ['Puzzle Game', '1000-piece landscape puzzle', 14.99, 'Toys & Games'],
            ['Board Game', 'Family strategy board game', 39.99, 'Toys & Games'],
            ['Laptop Stand', 'Ergonomic adjustable laptop stand', 29.99, 'Electronics'],
            ['Water Bottle', 'Insulated stainless steel bottle', 19.99, 'Home & Kitchen'],
            ['Graphic Novel', 'Full-color graphic novel', 9.99, 'Books'],
            ['Toy Car', 'Die-cast model car for kids', 7.99, 'Toys & Games'],
        ];

        foreach ($sampleProducts as [$name, $description, $price, $categoryName]) {
            $category = $categories->where('name', $categoryName)->first();
            if ($category) {
                Product::create([
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'category_id' => $category->id,
                    'image_url' => 'https://placehold.co/300x200?text=Product+Image',
                ]);
            }
        }
    }
}

