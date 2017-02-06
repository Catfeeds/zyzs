<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albumpic extends Model
{
    protected $table = "albumpic";
    public function album()
    {
    	return $this->belongsTo('App\Album','album_id');
    }
}
