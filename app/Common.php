<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    protected $dates=['published_at','created_at','updated_at'];
    protected $fillable=['id','name','showsnot','weihao','published_at'];
    protected $hidden = ['created_at','updated_at'];
    
    public function scopePublished($query)
    {
        $query->where('showsnot','1')->where('published_at','<=',Carbon::now());
    }
}
