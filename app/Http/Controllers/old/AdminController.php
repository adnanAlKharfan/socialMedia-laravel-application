<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;


class AdminController extends Controller
{
    //
    public function update_user($id, Request $request)
    {
        if (Auth::check() && Auth::User()->hasRole()) {
            $user = User::find($id);
            if ($user->username != $request->username) {
                if ($user->email != $request->email) {
                    $this->validate($request, [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'username' => ['required', 'string', 'unique:users'],
                        'file' => ['file']
                    ]);
                } else {
                    $this->validate($request, [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'username' => ['required', 'string', 'unique:users'],
                        'file' => ['file']
                    ]);
                }
            } else {
                if ($user->email != $request->email) {
                    $this->validate($request, [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'username' => ['required', 'string'],
                        'file' => ['file']
                    ]);
                } else {
                    $this->validate($request, [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'username' => ['required', 'string'],
                        'file' => ['file']
                    ]);
                }
            }

            $path = $user->avatar;
            if (request('file')) {
                if ($path != null) {
                    unlink(public_path() . $path);
                }
                $p = $request->file('file');
                $path = $p->move('user');
            }
            $user->update(['name' => $request->name, 'email' => $request->email, 'username' => $request->username, 'password' => bcrypt($request->password, ['rounds' => 4]), 'avatar' => $path]);
            return redirect('all_user');
        }
        abort(404);
    }
    public function edit_user($id)
    {
        if (Auth::check() && Auth::User()->hasRole()) {
            $user = User::find($id);
            $post = Role::paginate(5);
            return view('edit_user_form', compact('user', 'post'));
        }
        abort(404);
    }
    public function index()
    {
        if (Auth::check()) {
            return view('admin.index');
        }
        abort(404);
    }
    public function profile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('profile', compact('user'));
        }
        abort(404);
    }
    public function edit(Request $request)
    {
        if (Auth::check()) {
            $users = User::find(Auth::user()->id);
            if ($users->username != $request->username) {
                if ($users->email != $request->email) {
                    $this->validate($request, [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'username' => ['required', 'string', 'unique:users'],
                        'file' => ['file']
                    ]);
                } else {
                    $this->validate($request, [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'username' => ['required', 'string', 'unique:users'],
                        'file' => ['file']
                    ]);
                }
            } else {
                if ($users->email != $request->email) {
                    $this->validate($request, [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'username' => ['required', 'string'],
                        'file' => ['file']
                    ]);
                } else {
                    $this->validate($request, [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'username' => ['required', 'string'],
                        'file' => ['file']
                    ]);
                }
            }

            $path = $users->avatar;

            if (request('file')) {
                if ($path != null) {
                    unlink(public_path() . $path);
                }
                $p = $request->file('file');
                $path = $p->move('user');
            }
            $users->update(['name' => $request->name, 'email' => $request->email, 'username' => $request->username, 'password' => bcrypt($request->password, ['rounds' => 4]), 'avatar' => $path]);
            return redirect('profile');
        }
        abort(404);
    }
    public function delete(Request $request)
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            if ($user->avatar != null) {
                unlink(public_path() . $user->avatar);
            }
            $user->delete();


            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect('/');
        }
        abort(404);
    }
    public function delete_user($id, Request $request)
    {
        if (Auth::check() && Auth::User()->hasRole()) {
            $user = User::find($id);
            if ($user->avatar != null) {
                unlink(public_path() . $user->avatar);
            }
            $user->delete();



            return redirect('/all_user');
        }
        abort(404);
    }
    public function all_user()
    {
        if (Auth::check() && Auth::User()->hasRole()) {

            $post = User::paginate(10);


            return view('all_user', compact('post'));
        }
        abort(404);
    }
    public function attach_dettach_user(Request $request, $user_id, $role_id)
    {
        if (Auth::check() && Auth::User()->hasRole()) {

            if ($request->has('attach')) {
                $user = User::find($user_id);

                $user->Role()->attach($role_id);
            } else if ($request->has('dettach')) {
                $user = User::find($user_id);
                $user->Role()->dettach($role_id);
            }
            return back();
        }
        abort(404);
    }
}
