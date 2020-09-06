<?php

use App\Model\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::create([
            'name' => 'Others',
        ]);
        Category::create([
            'name' => 'Espresso Based',
        ]);
        Category::create([
            'name' => 'Manual Brew',
        ]);
        Category::create([
            'name' => 'Iced Coffee',
        ]);
        Category::create([
            'name' => 'Coffee Dessert',
        ]);
        Category::create([
            'name' => 'Snack',
        ]);
    }
}
