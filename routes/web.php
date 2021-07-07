<?php

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

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/hello', function () {
    return view('welcome');
});

Route::get('/post/{id}', function ($id) {
    //return view('welcome');
    return 'This is post no: '.$id;
});

Route::get('/post/{id}/{name}', function ($id, $name) {
    //return view('welcome');
    return 'This is post no: '.$id.' '.$name;
});

Route::get('/home/admin/posts', array('as' =>'admin.posts', function(){
    $url = route('admin.posts');
    return $url; 
}));*/

// Route::resource('posts', 'PostController');

Route::get('/posts', 'PostController@index');
Route::get('/posts/{id}', 'PostController@show');
