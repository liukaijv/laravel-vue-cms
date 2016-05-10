<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \App\User::create([
            'name' => 'mengmeng',
            'email' => '89016230@qq.com',
            'image' => $faker->imageUrl(100, 100),
            'password' => Hash::make('123456')
        ]);

        foreach (range(1, 10) as $index) {
            \App\User::create([
                'name' => $faker->userName(),
                'email' => 'user' . $index . '@qq.com',
                'image' => $faker->imageUrl(100, 100),
                'password' => Hash::make('123456')
            ]);
        }

    }
}
