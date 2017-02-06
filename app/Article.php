<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //公共配置
    protected $dates=['published_at','created_at','updated_at'];
    protected $fillable=['id','nav_id','title','zz','keywords','description','filepath','details','tags','weihao','showsnot','comment','published_at'];
    protected $hidden = ['created_at','updated_at'];
    
    //填充或修改时自动执行

    //公共调用
    public function scopePublished($query)
    {
        $query->where('showsnot','1')->where('published_at','<=',Carbon::now());
    }

    //关联关系
    public function getview()
    {
    	return $this->hasOne('App\Articleview','article_id');
    }

    public function getcomment()
    {
    	return $this->hasMany('App\Comment','article_id');
    }

    public function nav()
    {
    	return $this->belongsTo('App\Sitenav');
    }

    public function gettags()
    {
        return $this->belongsToMany('App\Tags','tags4article','article_id');
    }
}