<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $table = "case";
    public function getstyles()
    {
    	return $this->belongsToMany('App\Casestyle','casestyle4case','case_id','style_id');
    }

    public function getmembers()
    {
    	return $this->belongsToMany('App\TeamsMember','case2member','case_id','member_id');
    }

    public function getfengge()
    {
    	return $this->belongsTo('App\Fengge','fengge_id');
    }
}
