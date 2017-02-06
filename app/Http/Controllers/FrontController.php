<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cache;
use Auth;
use App;
use Carbon\Carbon;

class FrontController extends Controller
{
    //@ route "/"
	public function index()
	{
		//前台首页控制器
		//在provider里头
		$indexbanner = $this->getindexbanner();
        $favicon = '/favicon.ico';

        view()->share([
        		'indexbanner'=>$indexbanner

        	]);



		return view('index');
	}


	public function getindexbanner(){
        if (!Cache::has('indexbanner')) {
            $indexbanner =App\Indexbanner::where('showsnot','1')->where('published_at','<=',Carbon::now())->get();
            Cache::put('indexbanner', $indexbanner,60); 
        } else {
            $indexbanner = Cache::get('indexbanner');
        }
        return $indexbanner;
    }

}
