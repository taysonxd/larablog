<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Category;

class TagsController extends Controller
{
    public function show(Tag $tag) {

    	$categories = Category::all();
    	$posts = $tag->posts()->paginate();

    	return view('welcome', [
    		'title' => "Publicaciones de la etiqueta '$tag->name'",
    		'posts' => $posts,
    		'categories' => $categories
    	]);
    }
}
