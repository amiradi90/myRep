<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Middleware\Authenticate;

class DocPart extends Model
{
//    protected $table = 'AMM.DocPart';
    protected $table = 'docParts';
    protected $fillable = [
        'barcode', 'partcode', 'name', 'cnt', 'grp', 'price', 'seq', 'doc_id', 'creator', 'updater',
    ];

    public $timestamps = false;

//    public function setCreatedAtAttribute()
//    {
//        $this->attributes['created_at'] = \Carbon\Carbon::now();
//    }

//    public function setUpdatedAtAttribute()
//    {
//        $this->attributes['updated_at'] = \Carbon\Carbon::now();
//    }

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function doc()
    {
//        return $this->belongsTo('App\Doc', 'doc_id');
        return $this->belongsTo('App\Doc', 'doc_id');

    }
}
