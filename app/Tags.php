<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = "tags";
    public function getarticles()
    {
    	return $this->belongsToMany('App\Article','tags4article','tags_id');
    }
}
