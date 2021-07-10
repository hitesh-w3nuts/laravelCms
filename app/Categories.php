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

}
