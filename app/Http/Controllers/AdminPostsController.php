<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::User()->isAdmin()) {

            $posts = Post::paginate(2);



            return view('admin.posts.index', compact('posts'));
        } elseif (Auth::check()) {
            $posts = Auth::User()->posts()->paginate(2);



            return view('admin.posts.index', compact('posts'));
        }

        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if (Auth::check()) {
            $categories = Category::pluck('name', 'id')->all();


            return view('admin.posts.create', compact('categories'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        if (Auth::check()) {
            $input = $request->all();


            $user = Auth::user();


            if ($file = $request->file('photo_id')) {


                $name = time() . $file->getClientOriginalName();


                $file->move('images', $name);

                $photo = Photo::create(['file' => $name]);


                $input['photo_id'] = $photo->id;
            }




            $user->posts()->create($input);




            return redirect('/admin');
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (Auth::check() && Auth::user()->isAdmin()) {
            $post = Post::find($id);
            if ($post) {
                $categories = Category::pluck('name', 'id')->all();

                return view('admin.posts.edit', compact('post', 'categories'));
            }
            abort(404);
        } elseif (Auth::check()) {
            $post = Post::where('user_id', '=', Auth::User()->id, "and", 'id', '=', $id)->first();
            if ($post) {
                $categories = Category::pluck('name', 'id')->all();

                return view('admin.posts.edit', compact('post', 'categories'));
            }
            abort(404);
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        if (Auth::check()) {
            $input = $request->all();



            if ($file = $request->file('photo_id')) {


                $name = time() . $file->getClientOriginalName();


                $file->move('images', $name);

                $photo = Photo::create(['file' => $name]);


                $input['photo_id'] = $photo->id;
            }


            Auth::user()->posts()->whereId($id)->first()->update($input);


            return redirect('/admin');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (Auth::check() && Auth::user()->isAdmin()) {
            $post = Post::find($id);
            if ($post) {
                unlink(public_path() . explode("http://sql308.epizy.com", $post->photo->file)[1]);

                $post->delete();

                return redirect('/admin');
            }
            abort(404);
        } else     if (Auth::check()) {
            $post = Post::find($id)->where('user_id', Auth::user()->id)->first();
            if ($post) {
                unlink(public_path() . explode("http://sql308.epizy.com", $post->photo->file)[1]);

                $post->delete();

                return redirect('/admin');
            }
            abort(404);
        }
        abort(404);
    }


    public function post($id)
    {


        $post = Post::find($id);
        if ($post) {
            $comments = $post->comments()->get();
            $cat = Category::all();

            return view('post', compact('post', 'comments', 'cat'));
        }
        abort(404);
    }
}
