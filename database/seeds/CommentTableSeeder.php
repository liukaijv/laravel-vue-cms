<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CommentTableSeeder extends Seeder
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

        foreach (range(1, 30) as $index) {
            \App\Comment::create([
                'post_id' => $faker->randomElement($postIds),
                'content' => $faker->paragraph(),
                'name' => $faker->name(),
                'email' => $faker->email(),
                'website' => $faker->url()
            ]);
        }

    }
}
