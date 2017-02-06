<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = "teams";

    public function members()
    {
    	return $this->hasMany('App\TeamsMember','type','id');
    }
}
