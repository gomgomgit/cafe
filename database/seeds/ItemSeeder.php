<?php

use App\Model\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::truncate();

        Item::create([
            'category_id' => 2,
            'name' => 'Americano',
            'image' => 'coffee.jpg',
            'description' => 'coffee',
        ]);
        Item::create([
            'category_id' => 2,
            'name' => 'Cappuccino',
            'image' => 'coffee.jpg',
            'description' => 'coffee',
        ]);
        Item::create([
            'category_id' => 2,
            'name' => 'Mochaccino',
            'image' => 'coffee.jpg',
            'description' => 'coffee',
        ]);
        Item::create([
            'category_id' => 2,
            'name' => 'Macchiato',
            'image' => 'coffee.jpg',
            'description' => 'coffee',
        ]);
        Item::create([
            'category_id' => 3,
            'name' => 'V60',
            'image' => 'coffee.jpg',
            'description' => 'coffee',
        ]);
        Item::create([
            'category_id' => 3,
            'name' => 'Aeropress',
            'image' => 'coffee.jpg',
            'description' => 'coffee',
        ]);
        Item::create([
            'category_id' => 3,
            'name' => 'Shypon',
            'image' => 'coffee.jpg',
            'description' => 'coffee',
        ]);
        Item::create([
            'category_id' => 3,
            'name' => 'Vietnam Drip',
            'image' => 'coffee.jpg',
            'description' => 'coffee',
        ]);
    }
}
