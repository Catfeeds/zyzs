<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cache;
use App\Siteset;
use App\Sitenav;
use App\Article;
use Cookie;
use App;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale('zh');
        $siteinfo = $this->getsiteset();
        $sitenavs  = $this->getSiteNavs();
        $footernav = $this->getFooter();
        view()->share('bottomurl',$this->getBottomurl());
        view()->share('footernav',$footernav);
        view()->share('siteinfo', $siteinfo);
        view()->share('sitenavs', $sitenavs);
        view()->share('appointmentpeople', $this->getpoople());
    }

    public function getpoople()
    {
        if (Cache::has('appointmentpeople')) {
            $appointmentpeople = Cache::get('appointmentpeople')*1+rand(1,4);
            if ($appointmentpeople > 50000) {
                $appointmentpeople ='10166';
            }
            Cache::put('appointmentpeople', $appointmentpeople,60*24*9999);
        } else {
            $appointmentpeople ='10166';
            Cache::put('appointmentpeople', $appointmentpeople,60*24*9999);
        }
        return $appointmentpeople;
    }

    public function getBottomurl()
    {
        $bottormurl = App\Bottomurl::orderBy('index','desc')->get();
        return $bottormurl;
    }

    public function getFooter()
    {
        $footernav = Sitenav::Footer()->orderBy('weihao','desc')->get();
        return $footernav;
    }

    public function getsiteset()
    {
        if (!Cache::has('siteinfo')) {
            $siteinfo = Siteset::where('id',1)->first();
            if ($siteinfo) {
                Cache::put('siteinfo', $siteinfo,60);
            } else {
                $siteinfo = 'empty';
            }
        } else {
            $siteinfo = Cache::get('siteinfo');
        }
        return $siteinfo;
    }

    public function getSiteNavs()
    {

        $sitenavs = Sitenav::Parentnav()->where('showsnot',1)->get();
        return $sitenavs;

    }

    public function getsitearticle()
    {
        if (!Cache::has('sitearticle')) {
            $articles = Article::where('showsnot','1')->orderby('id','desc')->skip(0)->take(15)->get();
            if ($articles) {
                if ($articles->count()>5) {
                    Cache::put('sitearticle', $articles,60);
                }              
            } else {
                $articles = 'empty';
            }
        } else {
            $articles = Cache::get('sitearticle');
        }
        $tmp=array(); 
        while(count($tmp)<5){ 
            $tmp[]=mt_rand(0,$articles->count()-1); 
            $tmp=array_unique($tmp); 
        }
        if ($articles!=="empty") {
            $post=array();
            foreach ($tmp as $tmps) {
                $post[]=$articles[$tmps];
            }
        return $post;
        } else {
            return "empty";
        }
    }

    public function register()
    {
        //
    }
}
