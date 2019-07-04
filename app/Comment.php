<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
//    protected $connection = 'sqlsrv';
//    protected $table='AMM.comments';
    protected $table = 'comments';
    protected $fillable = ['title', 'text'];
    protected $guarded = ['post_id'];

    public function post()
    {
        return $this->belongsTo('App\Post','post_id');
    }
}
