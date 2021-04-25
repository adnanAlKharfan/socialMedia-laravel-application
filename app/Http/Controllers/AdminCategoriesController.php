<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class AdminCategoriesController extends Controller
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
            $categories = Category::all();


            return view('admin.categories.index', compact('categories'));
        }
        abort(404);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Auth::check() && Auth::user()->isAdmin()) {
            Category::create($request->all());


            return redirect('/admin/categories');
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
            $category = Category::findOrFail($id);


            return view('admin.categories.edit', compact('category'));
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
        if (Auth::check() && Auth::user()->isAdmin()) {

            $category = Category::findOrFail($id);

            $category->update($request->all());

            return redirect('/admin/categories');
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
        //
        if (Auth::check() && Auth::user()->isAdmin()) {
            Category::findOrFail($id)->delete();


            return redirect('/admin/categories');
        }
        abort(404);
    }
}
