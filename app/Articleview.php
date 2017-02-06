<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articleview extends Model
{
	protected $dates=['created_at','updated_at'];
    protected $fillable=['id','article_id','views','praise','whose'];
    protected $hidden = ['created_at','updated_at'];
    public function article()
    {
    	return $this->belongsTo('App\Article');
    }
}
