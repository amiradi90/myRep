<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zino extends Model
{
    protected $fillable = [
        'zinoId', 'title', 'price', 'amount', 'barcode', 'date', 'image', 'groupTitle', 'groupId'
    ];
    public $groupIds =
           [1001, 1002, 1003, 1004, 1005,
            1010, 1011, 1012, 1013, 1014,
            1020, 1021, 1022, 1023, 1024,
            1025, 1026, 1104, 1105, 1106,
            1107, 1108, 1109, 1115, 1123,
            1124, 1127, 1129];

}
