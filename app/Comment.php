<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable=['article_id','name','icon','content','praise','ip_address','os','showsnot','whose','published_at'];
	protected $dates=['published_at'];
    
    // public function getPublishedAtAttribute($data)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s',$data)->diffForHumans();
    // }

    public function article()
    {
    	return $this->belongsTo('App\Article');
    }
}
