<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onlinechat extends Model
{
    protected $dates=['created_at','updated_at'];
    protected $fillable=['to','from','nickname','content','msgType','img','send'];
    protected $hidden = ['created_at','updated_at'];
}
