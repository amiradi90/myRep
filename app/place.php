<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class place extends Model
{
    protected $fillable = ['partref','partcode','barcode','partname','grp','price','stock','shelf','creator','updater','active'];

//    public function setActiveAttribute($value)
//    {
//        $this->attributes['active'] = (int) $value;
//    }
}
