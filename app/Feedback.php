<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
	protected $dates=['published_at','created_at','updated_at'];
	protected $fillable=['id','parent_id','customerid','ip','name','contact','content','filePath','hasreply','haslook','reply','showsnot','keywords','description','published_at'];
	protected $hidden = ['created_at','updated_at'];
}