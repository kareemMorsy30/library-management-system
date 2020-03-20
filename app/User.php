<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','phone','address','active','privilege'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favourites()
    {
        return $this->hasMany('App\Favourite');
    }

    public function books_borrows()
    {
        return $this->belongsToMany('App\Book','borrows','user_id','book_id')->withPivot('id')->whereNull('borrows.deleted_at')->withTimestamps();
    }

    public function rates()
    {
        return $this->belongsToMany('App\Book','rates','user_id','book_id')->withPivot('id','rate', 'comment','created_at','user_id');
    }
}
