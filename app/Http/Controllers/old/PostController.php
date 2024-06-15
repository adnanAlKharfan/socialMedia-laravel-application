<?php

namespace App\Http\Controllers;

use App\Http\Requests\post as RequestsPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    //
    public function show($id)
    {
        $post = Post::find($id);

        return view('blog-post', compact('post'));
    }
    public function create()
    {

        return view('create_form');
    }
    public function store(RequestsPost $request)
    {
        $this->validate($request, ["file" => "required"]);
        $p = $request->file('file');
        $path = $p->move('image');
        $u = Auth::User();
        $u->Post()->save(new Post(['title' => $request->title, 'body' => $request->body, 'post_image' => $path]));
        return redirect('all_post');
    }
    public function all()
    { // $post = Post::where('user_id', "=", Auth::User()->id)->paginate(3);
        $post = Post::where('user_id', "=", Auth::User()->id)->paginate(10);
        return view('all-post', compact('post'));
    }
    public function edit(RequestsPost $request, $i)
    {
        $path = Post::find($i)->post_image;
        if (request('file')) {
            if ($path != null) {
                unlink(public_path() . $path);
            }
            $p = $request->file('file');
            $path = $p->move('image');
        }

        $post = Post::find($i);
        $this->authorize('update', $post);
        $post->update(['title' => $request->title, 'body' => $request->body, 'post_image' => $path]);

        return redirect('all_post');
    }
    public function show_post($i)
    {

        $post = Post::find($i);
        $this->authorize('view', $post);

        return view('edit_form', compact("post"));
    }
    public function delete($i)
    {
        $post = Post::find($i);
        if ($post->post_image != null) {
            unlink(public_path() . $post->post_image);
        }
        $post->delete();
        session()->flash('message', 'post was deleted');
        return redirect('all_post');
    }
}
