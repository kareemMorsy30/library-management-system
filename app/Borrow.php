<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    //
    use SoftDeletes;
    protected $table = 'borrows';
//    protected $dates = ['deleted_at'];
}
