<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onlineserver extends Model
{
    protected $dates=['created_at','updated_at'];
    protected $fillable=['id','username','nickname','password','permission','key','online','autoback'];
    protected $hidden = ['created_at','updated_at'];
}
