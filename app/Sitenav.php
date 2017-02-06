<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitenav extends Model
{
	protected $dates=['published_at','created_at','updated_at'];
    protected $fillable=['id','type_id','parentid','articount','nickname','mbanner','name','navinfo','navpic','hierarchy','layout','weihao','keywords','description','banner','showsnot','type','style','showdetails','detailsposition','details','footershow','sectionid','published_at'];
    protected $hidden = ['created_at','updated_at'];
    
    //一级菜单
    public function scopeParentnav($query)
    {
        $query->where('showsnot','1')->where('hierarchy','1')->orderBy('weihao','desc');
    }

    public function scopeManageparentnav($query)
    {
        $query->where('showsnot','!=','3')->where('hierarchy','1');
    }

    //侧边栏
    public function section()
    {
        return $this->hasOne('App\Sections','id','sectionid');
    }

    public function children()
    {
        return $this->hasMany('App\Sitenav','parentid','id')->orderBy('weihao','desc');
    }

    public function brothers()
    {
        return $this->hasMany('App\Sitenav','parentid','parentid')->orderBy('weihao','desc');
    }

    public function parent()
    {
        return $this->belongsTo('App\Sitenav','parentid','id');
    }

    public function scopeFooter($query)
    {
        return $query->where('footershow','=',1);
    }
   
    //子菜单
    public function scopeSubnav($query)
    {
        $query->where('showsnot','1')->where('hierarchy','2');
    }
    public function scopeManagesubnav($query)
    {
        $query->where('showsnot','!=','3')->where('hierarchy','2');
    }
    //回收站中的一级菜单
    public function scopeDeletedparentnav($query)
    {
        $query->where('showsnot','3')->where('hierarchy','1');
    }
    //回收站中的子菜单
    public function scopeDeletedsubnav($query)
    {
        $query->where('showsnot','3')->where('hierarchy','2');
    }

    public function article()
    {
    	return $this->hasMany('App\Article','nav_id');
    }

    public function job()
    {
    	return $this->hasMany('App\Job','nav_id');
    }

    public function product()
    {
        return $this->hasMany('App\Product','nav_id');
    }
    public function album()
    {
        return $this->hasMany('App\Album','nav_id');
    }
}
