<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fengge extends Model
{
    protected $table = "fengge";

    public function getcases()
    {
    	return $this->hasMany('App\Cases','fengge_id');
    }
    
}
