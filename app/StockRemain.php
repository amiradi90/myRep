<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockRemain extends Model
{
    protected $table = 'stockremain';
    protected $fillable = [
        'barcode', 'partcode', 'name', 'remain', 'grp', 'grpid', 'checked','publisher', 'stock', 'seq', 'docremain_id',
        'creator', 'updater', 'pickdate', 'pickdateday'
    ];
    public $timestamps = true;

    public function DocRemain()
    {
        return $this->belongsTo('App\DocRemain');
    }
}
