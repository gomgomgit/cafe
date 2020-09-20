<?php

use App\Model\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::truncate();

        for ($i = 1; $i <= 10; $i++) {
            Order::create([
                'user_id' => rand(4, 15),
                'customer' => 'Customer ' . $i,
            ]);
        }
    }
}
