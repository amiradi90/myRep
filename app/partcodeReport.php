<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class partcodeReport extends Model
{
    protected $table = 'partcodeReports';

    protected $fillable = ['partcode', 'creator', 'name', 'grp', 'price',
    ];

}
