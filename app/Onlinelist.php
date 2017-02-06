<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onlinelist extends Model
{
    protected $dates=['created_at','updated_at'];
    protected $fillable=['serverid','customerid','notice','autoback','online'];
    protected $hidden = ['created_at','updated_at'];
}

