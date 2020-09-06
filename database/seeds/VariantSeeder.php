<?php

use App\Model\Variant;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Variant::truncate();

        Variant::create([
            'name' => 'None',
        ]);
        Variant::create([
            'name' => 'Hot',
        ]);
        Variant::create([
            'name' => 'Iced',
        ]);
    }
}
