<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casestyle extends Model
{
    protected $table = "casestyle";
    public function getcases()
    {
    	return $this->belongsToMany('App\Cases','casestyle4case','style_id','case_id');
    }
}
