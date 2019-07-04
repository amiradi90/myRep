<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    protected $connection='mysql';
    protected $table = 'posts';
//    protected $table='AMM.posts';
    protected $fillable = ['name'];


    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
