<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
//    protected $table = 'AMM.Doc';
    protected $table = 'docs';
    protected $fillable = ['type','creator','updater','status'];


    public function docparts()
    {
        return $this->hasMany('App\DocPart');
    }
}
