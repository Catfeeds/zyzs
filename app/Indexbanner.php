<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Indexbanner extends Model
{
    protected $dates=['published_at','created_at','updated_at'];
    protected $fillable=['filepath','weihao','showsnot','mfilepath','alink','published_at'];
    protected $hidden = ['created_at','updated_at'];
    
    //填充或修改时自动执行

    //公共调用
    public function scopePublished($query)
    {
        $query->where('showsnot','1')->where('published_at','<=',Carbon::now());
    }

}
