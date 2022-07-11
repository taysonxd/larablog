<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function index() {

    	$posts = Post::get();

    	return view('admin.posts.index', compact('posts'));
    }

    public function create() {

    	$categories = Category::all();
    	$tags = Tag::all();

    	return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request) {
    	
        $post = Post::create($request->all());

        $post->syncTags($request->input('tags'));

        return redirect()->route('admin.posts.edit', $post)->with('flash', "Tu publicación ha sido creada");
    }

    public function edit(Post $post) {

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post, StorePostRequest $request) {

        $post->update($request->all());

        $post->syncTags($request->input('tags'));

        return redirect()->route('admin.posts.edit', $post)->with('flash', "La publicación ha sido guardada");
    }

    public function destroy(Post $post) {

        $post->delete();

        return redirect()->route('admin.posts.index')->with('flash', "La publicación ha sido eliminada");
    }
}
