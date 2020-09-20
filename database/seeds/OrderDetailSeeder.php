<?php

use App\Model\ItemDetail;
use App\Model\Order;
use App\Model\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDetail::truncate();

        $orders = Order::pluck('id');
        $itemDetails = ItemDetail::pluck('price', 'id');

        // dd($itemDetails);

        foreach ($orders as $key => $order) {
            $total = 0;

            for ($i = 1; $i <= rand(1, 3); $i++) {

                $itemPick = rand(1, $itemDetails->count());
                $qty = rand(1, 5);
                $price = $itemDetails[$itemPick];
                $subtotal = $price * $qty;
                $total += $subtotal;

                OrderDetail::create([
                    'order_id' => $order,
                    'item_detail_id' => $itemPick,
                    'qty' => $qty,
                    'sub_total' => $subtotal,
                ]);
            }

            Order::find($order)->update([
                'total' => $total,
            ]);

        }

    }
}
