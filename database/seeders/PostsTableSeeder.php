<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category1 = Category::create([
            'name' => 'News'
        ]);

        $category2 = Category::create([
            'name' => 'Sports'
        ]);

        $category3 = Category::create([
            'name' => 'Movies'
        ]);

        $category4 = Category::create([
            'name' => 'Technology'
        ]);


        $user1 = User::create([
            'name' => 'Rohit',
            'email' => 'rohit@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $user2 = User::create([
            'name' => 'Root',
            'email' => 'root@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $user3 = User::create([
            'name' => 'Virat',
            'email' => 'virat@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $user4 = User::create([
            'name' => 'Ben',
            'email' => 'ben@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $post1 = Post::create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec volutpat libero non velit tincidunt lacinia. Morbi porttitor ligula mauris, et scelerisque risus varius at. Nunc vel augue felis. Pellentesque non lorem ut sem aliquet maximus vel a lacus. Duis pulvinar magna ut turpis accumsan sagittis. Aliquam condimentum quam eget orci luctus, eu vehicula nulla mattis. Vestibulum quis rhoncus augue, nec pulvinar orci.',
            'image' => 'posts/1.jpg',
            'category_id' => $category1->id,
            'user_id' => $user1->id
        ]);

        $post2 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec volutpat libero non velit tincidunt lacinia. Morbi porttitor ligula mauris, et scelerisque risus varius at. Nunc vel augue felis. Pellentesque non lorem ut sem aliquet maximus vel a lacus. Duis pulvinar magna ut turpis accumsan sagittis. Aliquam condimentum quam eget orci luctus, eu vehicula nulla mattis. Vestibulum quis rhoncus augue, nec pulvinar orci.',
            'image' => 'posts/2.jpg',
            'category_id' => $category2->id,
            'user_id' => $user2->id

        ]);

        $post3 = Post::create([
            'title' => 'New published books to read by a product designer',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec volutpat libero non velit tincidunt lacinia. Morbi porttitor ligula mauris, et scelerisque risus varius at. Nunc vel augue felis. Pellentesque non lorem ut sem aliquet maximus vel a lacus. Duis pulvinar magna ut turpis accumsan sagittis. Aliquam condimentum quam eget orci luctus, eu vehicula nulla mattis. Vestibulum quis rhoncus augue, nec pulvinar orci.',
            'image' => 'posts/3.jpg',
            'category_id' => $category3->id,
            'user_id' => $user3->id

        ]);

        $post4 = Post::create([
            'title' => 'This is why its time to ditch dress codes at work',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec volutpat libero non velit tincidunt lacinia. Morbi porttitor ligula mauris, et scelerisque risus varius at. Nunc vel augue felis. Pellentesque non lorem ut sem aliquet maximus vel a lacus. Duis pulvinar magna ut turpis accumsan sagittis. Aliquam condimentum quam eget orci luctus, eu vehicula nulla mattis. Vestibulum quis rhoncus augue, nec pulvinar orci.',
            'image' => 'posts/4.jpg',
            'category_id' => $category4->id,
            'user_id' => $user4->id

        ]);


        $tag1 = Tag::create([
            'name' => 'news'
        ]);

        $tag2 = Tag::create([
            'name' => 'politics'
        ]);

        $tag3 = Tag::create([
            'name' => 'latest'
        ]);

        $tag4 = Tag::create([
            'name' => 'tech'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag3->id, $tag4->id]);
        $post3->tags()->attach([$tag2->id, $tag1->id]);
        $post4->tags()->attach([$tag4->id, $tag2->id, $tag3->id]);

    }
}
