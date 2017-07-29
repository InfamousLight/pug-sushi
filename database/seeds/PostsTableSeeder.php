<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i = 0; $i < 10; $i++)
      {
        DB::table('posts')->insert([
            'user_id' => rand(1, 10),
            'title' => "Post Title: " . str_random(5),
            'body' => str_random(200) . ' ' . str_random(300) . ' ' . str_random(150),
        ]);
      }
    }
}
