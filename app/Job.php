<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = "jobs";

    public function setPublishedAtAttribute($data)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d H:i:s',$data);
    }

    public function scopePublished($query)
    {
        $query->where('showsnot','1')->where('published_at','<=',Carbon::now());
    }

    public function nav()
    {
    	return $this->belongsTo('App\Sitenav');
    }
}
