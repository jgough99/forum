<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    //Many threads belong to one user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    //Many threads belong to a topic
    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }

    //One thead has many posts 
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
