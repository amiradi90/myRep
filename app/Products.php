<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model  {

    protected $table = 'products';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lName', 'price', 'oldPrice', 'weight', 'length', 'height', 'width', 'image', 'rate', 'type', 'priority', 'description', 'details', 'barcode', 'options', 'cDate', 'uDate', 'dDate', 'viewCount', 'sellCount', 'BahmanWeeklySold', 'BahmansellCount', 'stock', 'confirm', 'rejectDescription', 'discount', 'gBook_id', 'st_99_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['confirm' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['cDate', 'uDate', 'dDate'];
//    public $timestamps = false;

}