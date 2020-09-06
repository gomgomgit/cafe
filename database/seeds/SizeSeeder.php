<?php

use App\Model\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::truncate();

        Size::create([
            'name' => 'One Size',
        ]);

        Size::create([
            'name' => 'Small',
        ]);

        Size::create([
            'name' => 'Medium',
        ]);

        Size::create([
            'name' => 'Large',
        ]);
    }
}
