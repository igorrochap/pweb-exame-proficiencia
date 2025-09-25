<?php

namespace Database\Seeders;

use App\Models\Product\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Category::query()->count() === 0) {
            Category::query()->insert([
                ['name' => 'Electronics'],
                ['name' => 'Computers'],
                ['name' => 'Laptops'],
                ['name' => 'Tablets'],
                ['name' => 'Smartphones'],
                ['name' => 'Cameras'],
                ['name' => 'Headphones'],
                ['name' => 'Speakers'],
                ['name' => 'Wearables'],
                ['name' => 'Televisions'],
                ['name' => 'Home Appliances'],
                ['name' => 'Refrigerators'],
                ['name' => 'Washing Machines'],
                ['name' => 'Microwaves'],
                ['name' => 'Air Conditioners'],
                ['name' => 'Furniture'],
                ['name' => 'Sofas'],
                ['name' => 'Beds'],
                ['name' => 'Dining Tables'],
                ['name' => 'Chairs'],
                ['name' => 'Clothing'],
                ['name' => "Men's Clothing"],
                ['name' => "Women's Clothing"],
                ['name' => "Kids' Clothing"],
                ['name' => 'Shoes'],
                ['name' => 'Bags'],
                ['name' => 'Accessories'],
                ['name' => 'Beauty'],
                ['name' => 'Skincare'],
                ['name' => 'Makeup'],
                ['name' => 'Hair Care'],
                ['name' => 'Fragrances'],
                ['name' => 'Sports'],
                ['name' => 'Fitness Equipment'],
                ['name' => 'Bicycles'],
                ['name' => 'Outdoor Gear'],
                ['name' => 'Books'],
                ['name' => 'Magazines'],
                ['name' => 'Toys'],
                ['name' => 'Board Games'],
                ['name' => 'Video Games'],
                ['name' => 'Automotive'],
                ['name' => 'Car Accessories'],
                ['name' => 'Motorcycles'],
                ['name' => 'Groceries'],
                ['name' => 'Beverages'],
                ['name' => 'Snacks'],
                ['name' => 'Health & Wellness'],
                ['name' => 'Pet Supplies'],
                ['name' => 'Office Supplies'],
            ]);
        }
    }
}
