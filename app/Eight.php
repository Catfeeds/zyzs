<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eight extends Model
{
    protected $table = "eight";
    //字段 id,title,icon,img,nav_id,

    public function navigation()
    {
    	return $this->hasOne('App\Sitenav','id','nav_id');
    }
}
