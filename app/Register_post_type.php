<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register_post_type extends Model
{
    
    protected $table = 'register_post_type';

    public static function resgiter_custom_post_type($args){

        $checkTypeAlreadyExists = Register_post_type::where('post_type', '=' ,$args['post_type'])->get();
        $checkSlugAlreadyExists = Register_post_type::where('slug', '=' ,$args['post_slug'])->get();
        if(!count($checkTypeAlreadyExists) && !count($checkSlugAlreadyExists)){
            $Type = new Register_post_type;
            $Type->post_type = $args['post_type'];
            $Type->slug = $args['post_slug'];
            $Type->settings = serialize($args);
            $Type->save();          
        }
    }

    public static function get_all_custom_post_type(){
        $data = Register_post_type::all();
        $types = array(
            array(
                'post_type' => 'post',
                'post_slug' => 'post',
                'post_icon' => '',
                'category' => array(
                    'type' => 'category',
                    'post_type' => 'post',
                ),
            )
        );
        foreach($data as $type){
            $types[] = unserialize($type->settings);
        }
        return $types;
    }

}
