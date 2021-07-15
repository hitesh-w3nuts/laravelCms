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
        $posts = Post::where('type', $current)->orderBy('created_at', 'DESC')->get();
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
        
        $posts = Post::where('type', $current)->orderBy('created_at', 'DESC')->get();

        $passData= array(
            'posts' => $posts,
            'type' => $types,
            'current' => $current,
        );
        if(view()->exists('admin.posts.'.$current) && $current != 'post'){
            return view('admin.posts.'.$current)->with('passData', $passData);
        }else{
            return view('admin.posts.posts')->with('passData', $passData);
        }
    }

    public function post_add_new($type){
        $types = Register_post_type::get_all_custom_post_type();

        $postTypeID = 0;
        foreach ($types as $key => $value) {
            if($value['post_slug'] == $type){
                $postTypeID = $value['post_type_id'];
            }
        }
        $cats = Categories::get_cat_with_child($postTypeID);
        $passData= array(
            'type' => $types,
            'current' => $type,
            'cats' => $cats,
        );

        return view('admin.posts.post_add', )->with('passData', $passData);
    }

    public function post_edit($type, $id){
        $types = Register_post_type::get_all_custom_post_type();
        $editPost = Post::where('id', $id)->where('type', $type)->get();
        $postTypeID = 0;
        foreach ($types as $key => $value) {
            if($value['post_slug'] == $type){
                $postTypeID = $value['post_type_id'];
            }
        }
        $cats = Categories::get_cat_with_child($postTypeID);
        $passData= array(
            'type' => $types,
            'current' => $type,
            'cats' => $cats,
            'singlePost' => $editPost,
        );
        if(count($editPost) <= 0){
            return view('admin.posts.trashed')->with('passData', $passData);;
        }
        return view('admin.posts.post_add')->with('passData', $passData);
    }

}
