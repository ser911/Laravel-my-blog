<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Comment;
use App\Post;


class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Selecting only published posts
        $posts = Post::where('published', 1)->get();
        // loop all posts
        foreach($posts as $post){
        //loop to create random comments
        for ($i=0; $i < rand(0,4) ; $i++) { 
            $newComment = new Comment();
            $newComment->post_id = $post->id;
            $newComment->name = $faker->name();
            $newComment->content = $faker->text();
            $newComment->save();
        } 

            
        }
    }

}
