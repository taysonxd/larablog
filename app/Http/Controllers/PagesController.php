<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home() {

    	$archive = Post::published();
        
        if ( request()->has('month') )
            $archive->whereMonth('published_at', request('month'));

        if (request()->has('year') )
            $archive->whereYear('published_at', request('year'));

    	$categories = Category::all();

        $posts = $archive->get();
        
    	return view('welcome', compact('posts', 'categories'));
    }

    public function about() {
        
        $categories = Category::all();

        return view('about', compact('categories'));
    }

    public function archive() {

        \DB::statement("SET lc_time_names = 'es_ES'");

        $categories = Category::all();
        $archive = Post::ByMonthByYear()->get();

        return view('archive', [
            'categories' => $categories,
            'authors' => User::latest()->take(4)->get(),
            'posts' => Post::latest()->take(15)->get(),
            'archive' => $archive
        ]);
    }

    public function contact() {

        $categories = Category::all();

        return view('contact', compact('categories'));
    }

    public function postShow(Post $post) {
		
		$categories = Category::all();

        if($post->isPublished() || Auth()->check())
    	   return view('postShow', compact('post', 'categories') );

        abort(404);
    }
}
