<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use App\Models\Role;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;

use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    //
    public function index()
    {
        //
        //
        if (Auth::check() && Auth::user()->isAdmin()) {

            $users = User::all();



            return view('admin.users.index', compact('users'));
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
        if (Auth::check() && Auth::user()->isAdmin()) {

            $roles = Role::pluck('name', 'id')->all();


            return view('admin.users.create', compact('roles'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //

        if (Auth::check() && Auth::user()->isAdmin()) {
            if (trim($request->password) == '') {

                $input = $request->except('password');
            } else {


                $input = $request->all();

                $input['password'] = bcrypt($request->password);
            }



            if ($file = $request->file('photo_id')) {


                $name = time() . $file->getClientOriginalName();


                $file->move('images', $name);

                $photo = Photo::create(['file' => $name]);


                $input['photo_id'] = $photo->id;
            }


            User::create($input);


            return redirect('/admin/users');
        }
        abort(404);


        //        return $request->all();





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

        return view('admin.uses.show');
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
            $user = User::findOrFail($id);

            $roles = Role::pluck('name', 'id')->all();


            return view('admin.users.edit', compact('user', 'roles'));
        } else if (Auth::check()) {
            $user = Auth::User();




            return view('admin.users.edit', compact('user'));
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
    public function update(UsersEditRequest $request, $id)
    {
        //
        if (Auth::check() && Auth::user()->isAdmin()) {
            $user = User::findOrFail($id);


            if (trim($request->password) == '') {

                $input = $request->except('password');
            } else {


                $input = $request->all();

                $input['password'] = bcrypt($request->password);
            }




            if ($file = $request->file('photo_id')) {


                $name = time() . $file->getClientOriginalName();

                $file->move('images', $name);

                $photo = Photo::create(['file' => $name]);


                $input['photo_id'] = $photo->id;
            }



            $user->update($input);


            return redirect('/admin/users');
        } elseif (Auth::check()) {
            $user = User::find(Auth::User()->id);


            if (trim($request->password) == '') {

                $input = $request->except('password');
            } else {


                $input = $request->all();

                $input['password'] = bcrypt($request->password);
            }




            if ($file = $request->file('photo_id')) {


                $name = time() . $file->getClientOriginalName();

                $file->move('images', $name);

                $photo = Photo::create(['file' => $name]);


                $input['photo_id'] = $photo->id;
            }



            $user->update($input);


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
    public function delete_logout(Request $request, $id)
    {
        //

        $user = user::find($id);

        if ($user->photo)
            unlink("http://course-peoject.herokuapp.com/images/" . $user->photo->file);



        $user->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/home');
    }
    public function destroy($id)
    {
        //
        if (Auth::check() && Auth::user()->isAdmin()) {
            $user = User::findOrFail($id);

            if ($user->photo)
                unlink("http://course-peoject.herokuapp.com/images/" . $user->photo->file);


            $user->delete();


            Session()->flash('deleted_user', 'The user has been deleted');


            return redirect('/admin/users');
        }
        abort(404);
    }
}
