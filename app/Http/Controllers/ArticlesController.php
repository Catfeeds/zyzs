<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Cookie;

class ArticlesController extends Controller
{
    public function show($id)
    {
    	$showarticle = Article::where('id','=',$id)->published()->first();
    	$showarticleparent = Article::where('id',$id)->first()->nav()->first();
    	$showarticleview = Article::where('id',$id)->first()->getview;
    	
    	if ($showarticle && $showarticleparent && $showarticleparent->showsnot=="1") {
    		//view+1
    		if (Cookie::has('articleviews'.$id)) {
	        	$articleviewscookie = Cookie::get('articleviews'.$id);
	        } else {
	        	Cookie::queue('articleviews'.$id,'visited',60*24*30*12);
	            $flight = Article::where('id','=',$id)->first()->getview()->first();
	            $flight->views = $flight->views*1+1;
	            $flight->save();
	            $articleviewscookie = "visitedable";
	        }
	        //parised
	        if(Cookie::has('articlepraise'.$id)){
            	$articlepraisecookie = Cookie::get('articlepraise'.$id);
	        } else {
	            $articlepraisecookie = "praiseable";
	        }


    		return view('other.article',compact('showarticle','showarticleparent','showarticleview','articlepraisecookie','articleviewscookie'));
    	} else {
    		return view('errors.404'); 
    	}
    }
}
