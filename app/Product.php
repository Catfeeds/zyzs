<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
	protected $dates=['published_at','created_at','updated_at'];
    protected $fillable=['id','nav_id','name','title','parameter','filepath','details','weihao','showsnot','keywords','description','published_at'];
    protected $hidden = ['created_at','updated_at'];
    public function scopePublished($query)
    {
        $query->where('showsnot','1')->where('published_at','<=',Carbon::now());
    }
    public function nav()
    {
    	return $this->belongsTo('App\Sitenav');
    }
}
