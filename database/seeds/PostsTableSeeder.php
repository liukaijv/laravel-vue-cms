<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $categoryIds = \App\Category::lists('id')->toArray();
        $tagIds = \App\Tag::lists('id')->toArray();

        foreach (range(1, 30) as $index) {

            $post = \App\Post::create([
                'title' => $faker->title(),
                'description' => $faker->sentence(),
                'category_id' => $faker->randomElement($categoryIds),
                'content' => $faker->paragraph()
            ]);

            $tags = $faker->randomElements($tagIds, 3);

            $post->tags()->sync($tags);

        }
    }
}
