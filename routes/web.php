<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\Categories;
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




Route::get('/admin', 'Admin_controller@index');

Route::get('/admin/{post_type}', 'Admin_controller@post_page');

Route::get('/admin/add-new/{post_type}', 'Admin_controller@post_add_new');
Route::get('/admin/edit/{post_type}/{id}', 'Admin_controller@post_edit');

Route::get('/', 'PostController@index');
Route::resource('posts', 'PostController');
if(!empty($customPostTypes)){
	foreach ($customPostTypes as $key => $type) {
		if($type['post_type'] == 'post'){
			continue;
		}
		$controller = 'PostController';
		if(isset($type['controller']) && !empty($type['controller'])){
			$controller = $type['controller'];
		}
		Route::get($type['post_slug'].'/{slug}', $controller.'@index');
	}
}