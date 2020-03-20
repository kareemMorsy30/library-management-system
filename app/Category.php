<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'categories';
    use SoftDeletes;

public function books()
{
    return $this->hasMany('App\Book');
}

}
