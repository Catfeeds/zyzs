<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Album;
use App\Sitenav;
class AlbumsController extends Controller
{
    public function show($id)
    {
    	$showdata = Album::find($id);
    	if ($showdata && $showdata->showsnot =='1') {
    		$showalbumparent = Sitenav::where('id',$showdata->nav_id)->first();
    		return view('other.album',compact('showdata','showalbumparent'));
    	} else{
    		return view('errors.404'); 
    	}
    }
}
