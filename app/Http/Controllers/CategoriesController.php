<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category) {

    	$categories = Category::all();
    	$posts = $category->posts()->published()->paginate();

    	return view('welcome', [
    		'title' => "Publicaciones de la categoria '$category->name'",
    		'posts' => $posts,
    		'categories' => $categories
    	]);
    }

}
