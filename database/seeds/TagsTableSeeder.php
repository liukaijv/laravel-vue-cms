<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            \App\Tag::create([
                'name' => $faker->word
            ]);
        }
    }
}
