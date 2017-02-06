<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siteset extends Model
{
    protected $dates=['created_at','updated_at'];
    protected $fillable=['companyname','companyphone','companyfax','companyaddress','companylogo','footershow','footericonshow','sitename','siteico','sitebeian','sitekeywords','sitedescription','siteurl','sitemqcrode','sitewxqcrode','statistical','weiboqcrode','weibourl'];
    protected $hidden = ['created_at','updated_at'];
}
