<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //Many topics belong to one user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    //One topic has many threads
    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    //Many topics belong to many user which like the topic
    public function likedByUsers()
    {
        return $this->belongsToMany('App\User');
    }
}
