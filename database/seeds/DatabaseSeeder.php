<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(VariantSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(IngredientSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(ItemDetailSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderDetailSeeder::class);
    }
}
