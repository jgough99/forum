<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //One user profile belongs to one user
    public function users() 
    {
        return $this->belongsTo('App\User');
    }
}
