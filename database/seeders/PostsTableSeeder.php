<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Photo;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	Post::truncate();
    	Category::truncate();
        Tag::truncate();
        Photo::truncate();

    	$category = new Category;
    	$category->name = 'Categoria 1';
    	$category->save();

        $category = new Category;
        $category->name = 'Categoria 2';
        $category->save();

        $category = new Category;
        $category->name = 'Categoria 3';
        $category->save();

        $Tag = new Tag;
        $Tag->name = 'etiqueta 1';
        $Tag->save();

        $Tag = new Tag;
        $Tag->name = 'etiqueta 2';
        $Tag->save();

        $Tag = new Tag;
        $Tag->name = 'etiqueta 3';
        $Tag->save();


        $post = new Post;
        $post->title = 'Mi primer post';
        $post->url = Str::slug($post->title);
        $post->excerpt = 'Extracto del primer post';
        $post->body = '<p>Contenido del primer post</p>';
        $post->published_at = Carbon::now()->subDays(2);
        $post->user_id = 1;
        $post->category_id = $category->id;
        $post->save();

        $post->tags()->attach(['1', '2', '3']);

        $post = new Post;
        $post->title = 'Mi segundo post';
        $post->url = Str::slug($post->title);
        $post->excerpt = 'Extracto del segundo post';
        $post->body = '<p>Contenido del segundo post</p>';
        $post->published_at = Carbon::now()->subDays(4);
        $post->user_id = 1;
        $post->category_id = $category->id;
        $post->save();

        $post->tags()->attach(['1', '2']);

        $post = new Post;
        $post->title = 'Mi tercer post';
        $post->url = Str::slug($post->title);
        $post->excerpt = 'Extracto del tercer post';
        $post->body = '<p>Contenido del tercer post</p>';
        $post->published_at = Carbon::now()->subDays(6);
        $post->user_id = 2;
        $post->category_id = $category->id;
        $post->save();

        $post->tags()->attach(['1']);

        $post = new Post;
        $post->title = 'Mi cuarto post';
        $post->url = Str::slug($post->title);
        $post->excerpt = 'Extracto del cuarto post';
        $post->body = '<p>Contenido del cuarto post</p>';
        $post->published_at = Carbon::now()->subDays(6);
        $post->user_id = 2;
        $post->category_id = $category->id;
        $post->save();

        $post->tags()->attach(['1']);
    }
}
