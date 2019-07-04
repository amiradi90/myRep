<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocRemain extends Model
{
    protected $table = 'DocRemain';
    protected $fillable = ['type', 'stock', 'pickdate', 'pickdateday', 'creator', 'updater', 'status'];


    public function stockRemain()
    {
        return $this->hasMany('App\StockRemain');
    }
}
