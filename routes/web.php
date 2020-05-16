<?php

use App\Hashtag;
use App\Post;
use App\User;
use App\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function ($Name=NULL) {
    $users = App\User::all();
    if(Auth::user()) {
        $Name = auth()->user()['name'];
    }
    return view('welcome', ['users' => $users]);
})->name('username');

Auth::routes();

Route::get('/logout', 'HomeController@index')->name('logout');

Route::get('/user', function () {
    return redirect()->route('other_username', auth()->user()->id);
})->name('user');

//Route::get('/{post}', function ($post_id) {
//    $Post = Post::find_id($post_id);
//    View::increments($post_id);
//    return view('post', ['Post' => $Post, 'users' => User::all()]);
//})->name('post');

Route::get('/hashtag/{hashtag_name}', function ($hashtag_id) {
    $hashtag = Hashtag::all()->where('id', $hashtag_id)->first();
    return view('hashtag', ['hashtag' => $hashtag]);
})->name('hashtag');

Route::get('/{name}', function ($id) {
    $all_users = User::all();
    $user = User::all()->where('id', $id)->first();
    if($user) {
        $user_posts = User::all()->where('id', $id)->first()->posts;
        return view('other_user', ['all_users' => $all_users, 'User' => $user, 'user_posts' => $user_posts]);
    } else return view('error');
})->name('other_username');

Route::get('/{name}/{post}', function ($user_id, $post_id) {
    $all_users = User::all();
    $User = User::all()->where('id', $user_id)->first();
    $user_post = Post::all()->where('id', $post_id)->first();
    if($User && $user_post) {
        View::increments(auth()->user(), $user_post);
        return view('other_user_post', ['all_users' => $all_users, 'User' => $User, 'user_post' => $user_post]);
    } else return view('error');
})->name('other_username_post');

Route::post('/', 'ModelsController@add_post')->name('add_post');
