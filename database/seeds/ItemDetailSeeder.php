<?php

use App\Model\Item;
use App\Model\ItemDetail;
use Illuminate\Database\Seeder;

class ItemDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemDetail::truncate();

        $item = Item::count();
        for ($i = 1; $i <= $item; $i++) {

            for ($j = 2; $j <= 3; $j++) {

                $detailId = ItemDetail::create([
                    'item_id' => $i,
                    'variant_id' => $j,
                    'size_id' => 1,
                    'price' => 10000 * $j + $i,
                ]);

                $detailId->ingredients()->sync([1 => ["amount_ingredient" => 7], 2 => ["amount_ingredient" => 120]]);
            }

        }

    }
}
