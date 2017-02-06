<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Album extends Model
{
    protected $table = "albums";

    public function getpics()
    {
        return $this->hasMany('App\Albumpic','album_id');
    }

    public function nav()
    {
    	return $this->belongsTo('App\Sitenav');
    }
    public function getviews()
    {
        return $this->hasOne('App\Albumview','album_id');
    }
}