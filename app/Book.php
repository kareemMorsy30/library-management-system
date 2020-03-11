<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;

class Book extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
