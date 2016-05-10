<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \App\Category::create([
            'name' => $faker->word()
        ]);

        foreach (range(1, 10) as $index) {
            $categoryIds = \App\Category::where('parent_id', 1)->lists('id')->toArray();
            \App\Category::create([
                'name' => $faker->word,
                'parent_id' => $faker->optional(0.5, '0')->randomElement($categoryIds)
            ]);
        }

    }
}
