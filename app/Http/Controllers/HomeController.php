<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        header("Content-Type:text/html;charset=utf-8");
        echo "生成点赞和阅读量,<br>";

        $views = App\Articleview::all();
        foreach ($views as $key) {
            $key->praise = rand(51,200);
            $key->views = $key->praise*10+rand(1,1000);
            $key->save();
        }

    }


    public function generatedescription()
    {
        // for ($i=1; $i < 10; $i++) { 
        
        //     //从第一页到第九页
        //     //$html = file_get_contents("http://www.ziyehk.com/zyzsd-".$i.".html");


        // }
        // $data = $this->checkStr("地中海","欧美");
        header("Content-Type:text/html;charset=utf-8");
        $articles = App\Article::where('nav_id','=',58)->get();

        foreach ($articles as $key) {
            
            $data = strip_tags($key->details);
            $data = str_replace(array("\r\n", "\r", "\n"), "",$data);

            $key->description = mb_substr($this->generate($data,$key->title), 0,200,'utf-8')."...";
            $key->save();
        }



        
        

        // echo $this->generate($data);





    }

    public function checkStr($str1,$str2)
    {
        $ch = curl_init();
        $url = 'http://apis.baidu.com/showapi_open_bus/txt_like/txt_like?t1='.urlencode($str1).'&t2='.urlencode($str2);
        $header = array(
            'apikey: 4b87645cd369d77f85084c77c400bae9',
        );
        // 添加apikey到header
        curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch , CURLOPT_URL , $url);
        $res = curl_exec($ch);
        $res = json_decode($res,false);
        if(empty($res->showapi_res_body->like))
            return 0;
        return $res->showapi_res_body->like;
    }

    public function caseTypeRefactory()
    {
        $cases = App\Cases::orderBy('id','desc')->get();
        $fengges = App\Fengge::get();

        foreach ($cases as $case) {

            $xiangsidu = 0;
            $fengge_id = 0;
            foreach ($fengges as $fengge) {
                
                $str1 = str_replace("风格", "",$case->fengge);
                $str2 = $fengge->title;
                echo "比较 ".$str1." 和 ".$str2 ;
                echo " 结果";
                $res =  $this->checkStr($str1,$str2);
                echo $res."<br>";
                if($res>$xiangsidu){
                    $xiangsidu = $res;
                    $fengge_id = $fengge->id;
                }

            }
            $case->fengge_id = $fengge_id;
            $case->save();

        }
    }



    public function generate($text,$title)
    {
        $ch = curl_init();
        $url = 'http://apis.baidu.com/showapi_open_bus/show_summary/show_summ';
        $header = array(
            'Content-Type:application/x-www-form-urlencoded',
            'apikey: 4b87645cd369d77f85084c77c400bae9',
        );
        $data = "text=".$text."&num=15";
        // 添加apikey到header
        curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
        // 添加参数
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch , CURLOPT_URL , $url);
        $res = curl_exec($ch);
        $res = json_decode($res,false);

        $hehe = $title;


        if(empty($res->showapi_res_body->list))
            return $title;

        foreach($res->showapi_res_body->list as $key)
        {
            $hehe.=$key.'，';
        }
        //echo $hehe;
        return $hehe;
    }

    public function fillArticle()
    {
        echo "正在填充数据:";
        $navigations = App\Sitenav::all();
        foreach ($navigations as $key) {
            //给每个导航填充数据

            $tmp = new App\Article;

            $tmp->filepath = "/public/imgs/tl12.png";
            $tmp->title = "紫业看工地——水电验收篇";
            $tmp->nav_id = $key->id;
            $tmp->keywords  = "关键字,关键字,关键字";
            $tmp->description = "描述";
            $tmp->showsnot = 1;
            $tmp->published_at = "2016-08-24 23:03:40";
            $tmp->save();


             $tmp = new App\Article;

            $tmp->filepath = "/public/imgs/tl11.png";
            $tmp->title = "紫业看工地——交房验收篇";
            $tmp->nav_id = $key->id;
            $tmp->keywords  = "关键字,关键字,关键字";
            $tmp->description = "描述";
            $tmp->showsnot = 1;
            $tmp->published_at = "2016-08-24 23:03:40";
            $tmp->save();

             $tmp = new App\Article;

            $tmp->filepath = "/public/imgs/tl4.png";
            $tmp->title = "香山工法：以爱之名，传承香山匠心文化";
            $tmp->nav_id = $key->id;
            $tmp->keywords  = "关键字,关键字,关键字";
            $tmp->description = "描述";
            $tmp->showsnot = 1;
            $tmp->published_at = "2016-08-24 23:03:40";
            $tmp->save();

             $tmp = new App\Article;

            $tmp->filepath = "/public/imgs/tl5.png";
            $tmp->title = "房子这样装修，周围人都说好有格调！";
            $tmp->nav_id = $key->id;
            $tmp->keywords  = "关键字,关键字,关键字";
            $tmp->description = "描述";
            $tmp->showsnot = 1;
            $tmp->published_at = "2016-08-24 23:03:40";
            $tmp->save();


             $tmp = new App\Article;

            $tmp->filepath = "/public/imgs/tl7.png";
            $tmp->title = "紫业装饰：十分家装热爱 一份责任预算";
            $tmp->nav_id = $key->id;
            $tmp->keywords  = "关键字,关键字,关键字";
            $tmp->description = "描述";
            $tmp->showsnot = 1;
            $tmp->published_at = "2016-08-24 23:03:40";
            $tmp->save();


             $tmp = new App\Article;

            $tmp->filepath = "/public/imgs/tl13.png";
            $tmp->title = "哇！房子这样一改动，果真幸福感倍增！";
            $tmp->nav_id = $key->id;
            $tmp->keywords  = "关键字,关键字,关键字";
            $tmp->description = "描述";
            $tmp->showsnot = 1;
            $tmp->published_at = "2016-08-24 23:03:40";
            $tmp->save();



        }
    }
}
