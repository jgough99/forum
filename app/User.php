<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    //One user has many topics
    public function topics()
    {
        return $this->hasMany('App\Topic');
    }

    //One user has many threads
    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    //One user has many posts
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    //Many users belong to many liked topics
    public function likedTopics()
    {
        return $this->belongsToMany('App\Topic');
    }

    //One user has one user profile
    public function userProfile()
    {
        return $this->hasOne('App\UserProfile');
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
}
