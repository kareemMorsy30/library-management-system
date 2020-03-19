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

    public function users_borrows()
    {
        return $this->belongsToMany('App\User','borrows','book_id','user_id')->withPivot('return_back','id')->whereNull('borrows.deleted_at')->withTimestamps();
    }

    public function rate()
    {
        return $this->belongsToMany('App\User','rates','book_id','user_id')
        ->withPivot('id','rate', 'comment','created_at','user_id');
    }
    
}
