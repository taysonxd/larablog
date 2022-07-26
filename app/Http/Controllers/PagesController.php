<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PagesController extends Controller
{
    public function home() {

    	$posts = Post::published()->get();
    	$categories = Category::all();

        $posts->load('photos');
        
    	return view('welcome', compact('posts', 'categories'));
    }

    public function about() {
        
        $categories = Category::all();

        return view('about', compact('categories'));
    }

    public function archive() {

        $categories = Category::all();

        return view('archive', compact('categories'));
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
