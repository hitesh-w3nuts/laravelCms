<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Categories extends Model
{
    //
    use softDeletes;
        protected $dates = ['deleted_at'];
        protected $fillable = [
            'name',
            'parentID',
        ];


    public function post(){
        return $this->hasOne('App\Post', 'categoryID'); //Retrive first ones
        // return $this->hasMany('App\Post', 'categoryID');
    }

    public function posts(){
        // return $this->hasOne('App\Post', 'categoryID');Retrive first ones
        return $this->hasMany('App\Post', 'categoryID');
    }


    public static function get_cat_with_child($postTypeID = 0){
        $cates = array();
        $getCats = Categories::where('post_type_id', $postTypeID)->where('parent_id', 0)->get();
        if(count($getCats) > 0){
            $i=0;
            foreach ($getCats as $cat) {
                $cates[$i] = array(
                    'term_id' => $cat->id,
                    'name' => $cat->name,
                );

                /*get child*/
                $childCat = Categories::get_child_cat($cat->id);
                if(!empty($childCat)){
                    $cates[$i]['child'] = $childCat;
                }
                /*get child*/
                $i++;
            }
        }
        return $cates;
    }


    public static function get_child_cat($pID){
        $cates = array();
        $getCats = Categories::where('parent_id', $pID)->get();
        if(count($getCats) > 0){
            $i=0;
            foreach ($getCats as $cat) {
                $cates[$i] = array(
                    'term_id' => $cat->id,
                    'name' => $cat->name,
                );

                /*get child*/

                /*get child*/

                $i++;
            }
        }
        return $cates;
    }
}
