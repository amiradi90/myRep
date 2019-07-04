<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drafts extends Model
{
    protected $fillable = ['seq','partref', 'partcode', 'partname', 'vchnum', 'vchtype', 'stockRef', 'opStockRef', 'qty', 'cnt', 'cntChecked',
        'grp', 'price', 'creator', 'updater', 'checked', 'confirmed', 'description', 'pDate'];
}
