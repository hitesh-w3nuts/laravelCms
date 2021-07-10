<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    /*protected $table = 'posts';

    protected $primaryKey = 'id';*/

    public $coustomPostTypes = array();
    protected $fillable = ['name', 'content', 'type', 'categoryID'];
    public function category(){
        return $this->belongsTo('App\Categories', 'categoryID');
    }
}
