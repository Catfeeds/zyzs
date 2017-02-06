<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamsMember extends Model
{
    protected $table = "teams_member";


    public function team()
    {
    	return $this->belongsTo('App\Teams','type','id');
    }

    public function scopeIndex($query)
    {
    	return $query->where('indexshow','=',1)->orderBy('order','desc');
    }

    public function getcases()
    {
    	return $this->belongsToMany('App\Cases','case2member','member_id','case_id');
    }


}
