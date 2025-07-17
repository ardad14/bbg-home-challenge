<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Books',
            'Clothing',
            'Home & Kitchen',
            'Toys & Games',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
