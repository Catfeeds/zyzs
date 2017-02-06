<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $table = "sections";
    
    public function articlesSections()
    {
    	return $this->hasMany('App\SectionsArticle','section_id');
    }

    public function caseSections()
    {
    	return $this->hasMany('App\Sections_case','section_id');
    }
    
}
