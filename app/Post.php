<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Many posts belong to one thread
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    //Many posts belong to one user
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }
}
