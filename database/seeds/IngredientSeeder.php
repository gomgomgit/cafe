<?php

use App\Model\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::truncate();

        Ingredient::create([
            'name' => 'Other',
            'stock' => '9900000',
        ]);

        Ingredient::create([
            'name' => 'Coffee',
            'stock' => '50000',
        ]);

        Ingredient::create([
            'name' => 'Milk',
            'stock' => '10000',
        ]);

        Ingredient::create([
            'name' => 'Cream',
            'stock' => '3000',
        ]);

        Ingredient::create([
            'name' => 'Ice',
            'stock' => '7500',
        ]);
    }
}
