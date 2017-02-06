<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections_case extends Model
{
    protected $table = 'sections_case';
    public function contents()
    {
    	 return $this->belongsToMany('App\Cases','sections_case_contents','section_case_id','case_id');
    }

    public function section()
    {
    	return $this->belongsTo('App\Sections','section_id');
    }
}
