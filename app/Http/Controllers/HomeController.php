<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        $cat = Category::all();
        return view('home', compact('posts', 'cat'));
    }
    public function index_cat($id)
    {
        $posts = Post::where('category_id', $id)->paginate(5);
        $cat = Category::all();
        return view('home', compact('posts', 'cat'));
    }
    public function show($id)
    {
        $post = Post::find($id);
        $comments = $post->comments()->get();
        $cat = Category::all();
        return view('blog-post', compact('post', 'comments', 'cat'));
    }
}
