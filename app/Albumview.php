<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Albumview extends Model
{
    protected $table = "albumviews";
    public function album()
    {
    	return $this->belongsTo('App\Album');
    }
}
