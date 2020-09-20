<?php

use App\Model\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'admin',
            'password' => bcrypt('secret'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'operator',
            'password' => bcrypt('secret'),
            'role' => 'operator',
        ]);

        User::create([
            'name' => 'employee',
            'password' => bcrypt('secret'),
            'role' => 'employee',
        ]);

        $faker = Factory::create('id_ID');

        for ($i = 0; $i < 12; $i++) {
            User::create([
                'name' => $faker->name,
                'password' => bcrypt('secret'),
                'role' => 'employee',
            ]);
        }

    }
}
