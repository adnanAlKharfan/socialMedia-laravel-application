<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommentRepliesController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminUsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




/*Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('show');
Route::middleware('auth')->group(function () {

    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/create', [App\Http\Controllers\PostController::class, 'create'])->name('create_post');
    Route::post('/store', [App\Http\Controllers\PostController::class, 'store']);
    Route::get('/all_post', [App\Http\Controllers\PostController::class, 'all'])->name('all_post');
    Route::get('/edit_post/{id}', [App\Http\Controllers\PostController::class, 'show_post'])->name('edit_post');
    Route::delete('/delete_post/{id}', [App\Http\Controllers\PostController::class, 'delete']);
    Route::put('/edit/{id}', [App\Http\Controllers\PostController::class, 'edit']);
    Route::get('/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('profile');
    Route::put('/edit', [App\Http\Controllers\AdminController::class, 'edit']);
    Route::delete('/delete', [App\Http\Controllers\AdminController::class, 'delete']);
    Route::delete('/delete_user/{id}', [App\Http\Controllers\AdminController::class, 'delete_user']);
    Route::get('/all_user', [App\Http\Controllers\AdminController::class, 'all_user'])->name('all_user');
    Route::get('/edit_user/{id}', [App\Http\Controllers\AdminController::class, 'edit_user'])->name('edit_user');
    Route::put('/update_user/{id}', [App\Http\Controllers\AdminController::class, 'update_user']);
    Route::put('/update_user/{user_id}/{role_id}', [App\Http\Controllers\AdminController::class, 'attach_dettach_user']);
});
*/

Auth::routes();


Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{id}/post', 'HomeController@show')->name('show');
Route::get('/category/{id}', 'HomeController@index_cat')->name('category');
Route::get('/', function () {
    return redirect('/home');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/admin', function () {
        $user = Auth::user();
        $userName = $user->name;

        return view('admin.index', ['name' => $userName]);
    })->name('admin');
    Route::post('/{id}/post', 'PostCommentsController@store2')->name('store_comment');
    Route::delete('/delete/user/{id}', 'AdminUsersController@delete_logout');
    Route::get('users/comments', [PostCommentsController::class, 'mycomment'])->name('admin.mycomments');
});

Route::resource('admin/users', 'AdminUsersController', ['names' => [


    'index' => 'admin.users.index',
    'create' => 'admin.users.create',
    'store' => 'admin.users.store',
    'edit' => 'admin.users.edit'






]]);


//Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'AdminPostsController@post']);

Route::resource('admin/posts', 'AdminPostsController', ['names' => [

    'index' => 'admin.posts.index',
    'create' => 'admin.posts.create',
    'store' => 'admin.posts.store',
    'edit' => 'admin.posts.edit'





]]);

Route::resource('admin/categories', 'AdminCategoriesController', ['names' => [


    'index' => 'admin.categories.index',
    'create' => 'admin.categories.create',
    'store' => 'admin.categories.store',
    'edit' => 'admin.categories.edit'


]]);




/*Route::resource('admin/media', 'AdminMediasController', ['names' => [

    'index' => 'admin.media.index',
    'create' => 'admin.media.create',
    'store' => 'admin.media.store',
    'edit' => 'admin.media.edit'




]]);

Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');*/

Route::resource('admin/comments', 'PostCommentsController', ['names' => [


    'index' => 'admin.comments.index',
    'create' => 'admin.comments.create',
    'store' => 'admin.comments.store',
    'edit' => 'admin.comments.edit',
    'show' => 'admin.comments.show'


]]);

/*
Route::resource('admin/comment/replies', 'CommentRepliesController', ['names' => [



    'index' => 'admin.replies.index',
    'create' => 'admin.replies.create',
    'store' => 'admin.replies.store',
    'edit' => 'admin.replies.edit'


]]);
*/
