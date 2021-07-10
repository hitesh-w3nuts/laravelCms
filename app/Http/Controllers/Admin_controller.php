<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Register_post_type;
use App\Post;
use App\Categories;

class Admin_controller extends Controller
{
    public function index(){
        $customPostTypes =  Register_post_type::resgiter_custom_post_type(array(
            'post_type' => 'media',
            'post_slug' => 'our_media',
            'post_icon' => '',
        )); 

        $type = Register_post_type::get_all_custom_post_type();
        $current = 'post';
        $posts = Post::where('type', $current)->get();
        $passData= array(
            'posts' => $posts,
            'type' => $type,
            'current' => $current,
        );
        return view('admin.posts.posts', )->with('passData', $passData);
    }

    public function post_page($type){
        $current = $type;
        $types = Register_post_type::get_all_custom_post_type();
        
        $posts = Post::where('type', $current)->get();

        $passData= array(
            'posts' => $posts,
            'type' => $types,
            'current' => $current,
        );
        return view('admin.posts.posts', )->with('passData', $passData);
    }

    public function post_add_new($type){
        $types = Register_post_type::get_all_custom_post_type();
        $passData= array(
            'type' => $types,
            'current' => $type,
        );
        return view('admin.posts.post_add', )->with('passData', $passData);
    }

}
