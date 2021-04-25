<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check() && Auth::user()->isAdmin()) {
            $comments = Comment::all();


            return view('admin.comments.index', compact('comments'));
        }
        abort(404);
    }
    public function mycomment()
    {
        //

        $comments = Comment::where('email', Auth::User()->email)->get();
        $c = Auth::User()->posts()->get();
        $temp = [];
        if (count($c->toArray()) > 0) {
            foreach ($c as $i) {
                $t = [];
                $ro = true;
                foreach ($i->comments()->get() as $j) {
                    $ro = true;
                    foreach ($comments as $r) {
                        if ($r->id == $j->id) {
                            $ro = false;
                        }
                    }
                    if ($ro == true) {
                        array_push($t, $j);
                    }
                }

                //if ($comments->id != $i->comments()->get()->id)
                $temp =   array_merge($temp, $t);
            }
            $comments = array_merge($temp, $comments->toArray());
        }



        return view('admin.comments.my', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request, $id)
    {
        //


        $user = Auth::user();




        $data = [

            'post_id' => $id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo ? $user->photo->file : 'http://placehold.it/400x400',
            'body' => $request->body


        ];





        Comment::create($data);

        $request->session()->flash('comment_message', 'Your message has been submitted and is waiting moderation');

        return redirect()->back();
    }
    public function store(Request $request)
    {
        //
        if (Auth::check()) {

            $user = Auth::user();




            $data = [

                'post_id' => $request->post_id,
                'author' => $user->name,
                'email' => $user->email,
                'photo' => $user->photo->file,
                'body' => $request->body


            ];





            Comment::create($data);

            $request->session()->flash('comment_message', 'Your message has been submitted and is waiting moderation');

            return redirect()->back();
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

        if (Auth::check()) {

            $post = Post::findOrFail($id);

            $comments = $post->comments;


            return view('admin.comments.show', compact('comments'));
        }
        abort(404);
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
            Comment::findOrFail($id)->update($request->all());

            return redirect('/admin/comments');
        }
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
        if (Auth::check()) {
            Comment::findOrFail($id)->delete();

            return redirect()->back();
        }
        abort(404);
    }
}
