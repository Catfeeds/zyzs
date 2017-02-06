<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indexcase extends Model
{
    protected $table = "indexcase";

    public function getcase()
    {
    	return $this->hasOne('App\Cases','id','case_id');
    }
}
