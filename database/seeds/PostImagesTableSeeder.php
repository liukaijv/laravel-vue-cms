<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $postIds = \App\Post::lists('id')->toArray();

        foreach (range(1, 20) as $index) {
            \App\PostImage::create([
                'post_id' => $faker->randomElement($postIds),
                'url' => $faker->imageUrl()
            ]);
        }

    }
}
