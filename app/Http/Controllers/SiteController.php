<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sitenav;
use App\Indexbanner;
use Redirect;
use Cache;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use Carbon\Carbon;
use App\Feedbacktype;
use App\Feedback;
use App\Common;
use App\Article;
use App;
use Cookie;
use DB;

class SiteController extends Controller
{

    //侧边栏返回数据function
    //参数值   $sectionid 可以从Sitenav ->sectionid
    public function section($sectionid)
    {
        $section = App\Sections::find($sectionid);
        //echo "这里是侧边栏：".$section->title."<br>";
        $datas = App\SectionsUtil::getSection($section->id);


        // //开始遍历
        // foreach ($datas as $data=> $key) {
        //     //遍历
        //     //var_dump($key);
        //     echo '$data['.$data.']----';
        //     echo "板块:";
        //     echo $key['section']->title;
        //     echo '--板块类别:'.$key['type'];
        //     echo "--排序:".$key['section']->order;
        //     //遍历该板块的文章
        //     foreach ($key['datas'] as $child) {
        //         echo "<br>";
        //         echo "title:".$child->title;


        //     }
        // }

    }

    public function changelocation(Request $request)
    {
        $location = $request->input('location');
        Cookie::queue('clocation',$location,60*24*30*12*20);
        return 'succeed';
    }

    public function getlocation(Request $request)
    {
        if (Cookie::has('clocation')) {
            $location = Cookie::get('clocation');
        } else {
            $location = '上海';
        }
        return $location;
    }

    public function getuid()
    {
        if (Cookie::has('customerid')) {
            $customerid = Cookie::get('customerid');
        } else {
            $customerid = md5(time().rand(1,999999999999999));
            Cookie::queue('customerid',$customerid,60*24*30*12*20);
        }
        return $customerid;
    }


    public function casestyleviews($style_id)
    {
        $style = App\Casestyle::find($style_id);
        $navigation = App\Sitenav::where('type','=','case')->first();
        $styles = App\Casestyle::all();
        $cases = $style->getcases;
        return view('front.style',compact('cases','style','styles','navigation'));
    }


    public function yuyue(Request $request)
    {
        if (Cookie::has("yuyue")) {
            $errmsg = array('report'=>'error','errmsg'=>'提交失败，10分钟内只能提交一次','location'=>'/appointment/sent');
            return Redirect::to('/notice')->with('errmsg',$errmsg);
        } else {
            if (!empty($request->input('captcha'))) {
                $captcha = Session::get('milkcaptcha','default');
                $this->validate($request,[
                    'captcha'=>'required|in:'.$captcha,
                ]);
            }
            $yuyue = new App\Yuyue;
            $yuyue->service = $request->input('service');
            $yuyue->name = $request->input('name');
            $yuyue->phone = $request->input('phone');
            $yuyue->xiaoqu = $request->input('xiaoqu');
            $yuyue->mianji = $request->input('mianji');
            $yuyue->content = $request->input('content');
            $yuyue->status = 0;
            $yuyue->save();
            Cookie::queue('yuyue','true',10);
            $errmsg = array('report'=>'succeed','errmsg'=>'预约提交成功，我们会尽快安排专员与您取得联系','location'=>'/appointment/sent');
            return Redirect::to('/notice')->with('errmsg',$errmsg);
        }
        
    }

    public function yuyuefast(Request $request)
    {
        if (Cookie::has("yuyue")) {
            $errmsg = array('report'=>'error','errmsg'=>'提交失败，10分钟内只能提交一次','location'=>'/');
            return Redirect::to('/notice')->with('errmsg',$errmsg);
        } else {
            if (!empty($request->input('captcha'))) {
                $captcha = Session::get('milkcaptcha','default');
                $this->validate($request,[
                    'captcha'=>'required|in:'.$captcha,
                ]);
            }
            $yuyue = new App\Yuyue;
            $yuyue->service = "未指定";
            $yuyue->name = $request->input('name');
            $yuyue->phone = $request->input('phone');
            $yuyue->status = 0;
            $yuyue->save();
            Cookie::queue('yuyue','true',10);
            $errmsg = array('report'=>'succeed','errmsg'=>'预约提交成功，我们会尽快安排专员与您取得联系','location'=>'/');
            return Redirect::to('/notice')->with('errmsg',$errmsg);
        }
        
    }

    public function yuyueyidu($id)
    {
        $yuyue = App\Yuyue::find($id);
        $yuyue->status = 1;
        $yuyue->save();
        return redirect()->back();
    }

    public function sub($nickname,$subname="",$fengge="empty")
    {
        $navigation_url = "";
        if($subname=="")
        {
            $navigation_url = $nickname;
        }else{
            $navigation_url = $subname;
        }
        $navigation = App\Sitenav::where('nickname','=',$navigation_url)->first();
        if (!$navigation) {
            return view('errors.404'); 
        }
        if($navigation->type == "mainmenu")
        {

            return redirect($navigation->nickname."/".$navigation->children[0]->nickname);
        }


        if($navigation->sectionid!=0&&!empty($navigation->sectionid))
        {
            $sections = App\SectionsUtil::getSection($navigation->sectionid);
        }else
        {
            $sections = "empty";
        }
        
        
        if($navigation->articount>0)
        {
            $count = $navigation->articount;
        }else{
            $count = 15;
        }

        $articles = App\Article::where('nav_id','=',$navigation->id)->orderBy('id','desc')->paginate($count);
        //dd($articles);
        if($navigation->type == "team"){
            $team = App\Teams::where('nav_id','=',$navigation->id)->first();
            if($team){
                $teamsMember = App\TeamsMember::where('type','=',$team->id)->get();
                view()->share('teams',$teamsMember);
            }
            
        }

        if($navigation->type == 'case')
        {
            $current_fengge = App\Fengge::where('nickname','=',$fengge)->first();
            
            $fengges = App\Fengge::orderBy('index','desc')->get();
            view()->share('fengge',$fengges);



             if($fengge=="empty")
            {
                $cases = App\Cases::where('nav_id','=',$navigation->id)->orderBy('order','desc')->paginate($count);
            }else{
                if(empty($current_fengge->id)){
                    $searchid = null;
                    view()->share('case_other','1');
                }
                else
                    $searchid = $current_fengge->id;
                $cases = App\Cases::where('nav_id','=',$navigation->id)->where('fengge_id','=',$searchid)->orderBy('order','desc')->paginate($count);

            }
            view()->share('current_fengge',$fengge);
            view()->share('cases',$cases);
        }



        $albums = App\Album::where('nav_id','=',$navigation->id)->orderBy('weihao','desc')->paginate($count);
        
        $team = App\Teams::where('nav_id','=',$navigation->id)->first();

        $recruits = App\Job::where('nav_id','=',$navigation->id)->orderBy('weihao','desc')->paginate($count);
        // $members = $team->members;
        if($navigation->type == 'team')
        {
             $members = App\TeamsMember::where('type','=',$team->id)->get();
             view()->share('members',$members);
        }
        
        return view('front.sub',compact('navigation','sections','articles','albums','recruits'));

    }

    public function articles_page($nav_id)
    {
        $navigation = App\Sitenav::find($nav_id);

        if($navigation->articount>0)
        {
            $count = $navigation->articount;
        }else{
            $count = 15;
        }
        $articles = App\Article::where('nav_id','=',$nav_id)->orderBy('id','desc')->paginate($count);
        return $articles;

    }

    public function article($id)
    {



        $article = App\Article::find($id);

        $navigation = App\Sitenav::find($article->nav_id);
        if(Cookie::has('article'.$article->id))
        {
            $haspraise = 1;
        }else
        {
            $haspraise = 0;
        }
        $xiangguan = App\Article::where('id','<>',$article->id)->orderBy('id','desc')->take(8)->get();

        return view('front.view.article',compact('article','haspraise','navigation','xiangguan'));
    }

    public function album($id)
    {
        //zhanglinwei
        $album = App\Album::find($id);
        $navigation = App\Sitenav::find($album->nav_id);

        //xuzhong
        return view('front.view.album',compact('album','navigation'));
    }

    public function team($id)
    {
        $member = App\TeamsMember::find($id);
        // dd($member->team);
        $styles = App\Casestyle::orderBy('id','asc')->get();
        $navigation = App\Sitenav::find($member->team->nav_id);
        //xuzhong
        return view('front.view.team',compact('member','styles','navigation'));
    }

    public function caseview($id)
    {
        $case = App\Cases::find($id);
        $navigation = App\Sitenav::find($case->nav_id);
        //xuzhong
        return view('front.view.case',compact('case','navigation'));
    }

    public function recruit($id)
    {
        //xuzhong
        $jobs = App\Job::find($id);
        $others = App\Job::where('id','<>',$id)->orderBy('weihao','desc')->take(10)->get();
        $navigation = App\Sitenav::find($jobs->nav_id);
        return view('front.view.recruit',compact('jobs','navigation','others'));
    }

    public function dianzan($articleid)
    {
        if(Cookie::has('article'.$articleid))
        {
            return 0;
        }
        $articleview = App\Articleview::where('article_id','=',$articleid)->first();
        $articleview->praise ++;
        $articleview->save();
        Cookie::queue('article'.$articleid,'1');
        return $articleview->praise;
    }

    public function index(){

        //$this->section(1);

        $course = App\Course::find(1);
        view()->share('course',$course);

        if($course->r1nav == $course->r2nav)
        {
            //装修课堂两边选的一种文章
            $skip = 6;
        }
        else
        {
            $skip = 0;
        }
        $course1 = App\Article::orderBy('published_at','desc')->where('nav_id','=',$course->r1nav)->take(6)->get();
        $course2 = App\Article::orderBy('published_at','desc')->where('nav_id','=',$course->r2nav)->skip($skip)->take(6)->get();
        view()->share(['course1'=>$course1,'course2'=>$course2]);

        $course3 = App\Course3::orderBy('index','desc')->take(3)->get();
        view()->share('course3',$course3);

        $teamsMember = App\TeamsMember::Index()->get();//首页设计团队
        $indexbanner = $this->getindexbanner();
        $favicon = '/favicon.ico';
        $indexarticle = Article::published()->orderby('id','desc')->get();

        $indeximg = App\Indeximg::orderBy('index','desc')->get();
        view()->share('indeximg',$indeximg);
        $indexline = App\Indexline::orderBy('weihao','desc')->get();
        view()->share('indexline',$indexline);
        $friendlinks = App\Friendlinks::orderBy('weihao','desc')->get();
        view()->share('friendlinks',$friendlinks);

        $eight = App\Indexeight::orderBy('index','desc')->take(8)->get();
        $three = App\Three::orderBy('index','desc')->take(3)->get();
        view()->share('three',$three);
        $indexcases = App\Indexcase::orderBy('index','desc')->get();

        $yuyuetypes = App\Yuyuetype::orderBy('id','asc')->get();
        view()->share('yuyuetypes',$yuyuetypes);


        return view('index',compact('indexbanner','indexarticle','favicon','teamsMember','eight','indexcases'));
    }

    public function getindexbanner(){
        if (!Cache::has('indexbanner')) {
            $indexbanner =Indexbanner::where('showsnot','1')->where('published_at','<=',Carbon::now())->orderBy('weihao','desc')->get();
            Cache::put('indexbanner', $indexbanner,60); 
        } else {
            $indexbanner = Cache::get('indexbanner');
        }
        return $indexbanner;
    }

    public function parent($nickname,$subname=''){
    	if (empty($subname)) {
    		$getthis = Sitenav::where('nickname',$nickname)->Parentnav()->leftJoin('navtypes','sitenavs.type_id','=','navtypes.id')->select('sitenavs.*','navtypes.type','navtypes.subtype')->first();
            if (!$getthis) {
               return view('errors.404');
            }
	        $parentnav = "empty";
	        //侧边栏菜单导航
	        if (!Cache::has('aside'.$nickname)) {
				$asidenav = Sitenav::where('parentid',$getthis->id)->subnav()->orderby('weihao','desc')->get();
				if ($asidenav->count()>0) {
					Cache::put('aside'.$nickname, $asidenav,60);
				} else {
					$asidenav = "empty";
				}
			} else {
				$asidenav = Cache::get('aside'.$nickname);
			}

    	} else {
    		$getthis = Sitenav::where('nickname',$subname)->Subnav()->leftJoin('navtypes','sitenavs.type_id','=','navtypes.id')  ->select('sitenavs.*','navtypes.type','navtypes.subtype')->first();
            if (!$getthis) {
               return view('errors.404'); 
            }
	        $parentnav = Sitenav::where('id',$getthis->parentid)->first();
	        
	        //侧边栏菜单导航
	        if (!Cache::has('aside'.$nickname)) {
				$asidenav = Sitenav::where('parentid',$getthis->parentid)->subnav()->orderby('weihao','desc')->get();
				if ($asidenav->count()>0) {
					Cache::put('aside'.$nickname, $asidenav,60);
				} else {
					$asidenav = "empty";
				}
			} else {
				$asidenav = Cache::get('aside'.$nickname);
			}
    	}

        if ($getthis) {
        	$showdata = $getthis;
            $views = $this->getviews($getthis->layout);
            switch ($getthis->type) {
    			case 'menu':
    				switch ($getthis->subtype) {
    					case '1':
    						$thisfirstsubnav = Sitenav::where('parentid',$getthis->id)->subnav()->orderby('weihao','desc')->first();
    						if ($thisfirstsubnav) {
    							return Redirect::to('/'.$nickname.'/'.$thisfirstsubnav->nickname);
    						} else {
    							return view('errors.404'); 
    						}
    						break;
    					case '2':
    						return view('sub.'.$views,compact('showdata','asidenav','parentnav'));
    						break;
    				}
    			break;

    			case 'page':
    			return view('sub.'.$views,compact('showdata','asidenav','parentnav'));
    			break;

    			case 'article':
    			$articles = $getthis->article()->published()->orderby('weihao','desc')
                ->leftJoin('articleviews','articles.id','=','articleviews.article_id')
                ->select('articles.*','articleviews.views','articleviews.praise')
                ->paginate(20);
                return view('sub.'.$views,compact('showdata','articles','asidenav','parentnav'));
    			break;

                case 'product':
                $products= $getthis->product()->published()->orderby('weihao','desc')->get();
                return view('sub.'.$views,compact('showdata','products','asidenav','parentnav'));
                break;
    			//其他类型
                case 'album':
                $albums = $getthis->album()->published()->orderby('weihao','desc')->get();
                return view('sub.'.$views,compact('showdata','albums','asidenav','parentnav'));
                break;

                case 'job';
                $jobs = $getthis->job()->published()->orderby('weihao','desc')->get();
                return view('sub.'.$views,compact('showdata','jobs','asidenav','parentnav'));
                break;
    			default:
    			return $getthis->type;
    			break;
    		}
    	} else {
    		return view('errors.404'); 
    	}
    }


    public function getviews($layout)
    {
        switch ($layout) {
            case '1':
                $views = "leftaside";
                break;
            case '2':
                $views = "rightaside";
                break;
            case '3':
                $views = "noaside";
                break;
            default:
                $views = "noaside";
            break;
        }
        return $views;
    }

    public function support()
    {
        return Redirect::to('/support/dealers');
    }

    public function dealers()
    {
        return view('other.support.dealers');
    }

    public function common($common_id='')
    {
        $commonlist  =  Common::published()->orderby('weihao','desc')->get();
        if ($commonlist->count()>0) {
            if(empty($common_id)){
                $common = Common::find($commonlist[0]->id);
            } else {
                $common = Common::find($common_id);
            };
            if ($common) {
                $views = Feedback::where('ts_id',$common->id)->orderby('weihao','desc')->paginate(10);
                if ($views->count()>0) {
                } else {
                    $views ="empty";
                }
            } else {
                $common = "empty";
            }
        } else {
            $commonlist = "empty";
        }
        return view('other.support.common',compact('commonlist','common','views'));
    }

    public function commonview($common_id)
    {
        $view = Feedback::find($common_id);
        if ($view) {
            $common = Common::where('id',$view->ts_id)->first();
            if ($common) {
                return view('other.support.commonview',compact('common','view'));
            } else {
                return view('errors.404'); 
            }
        } else {
            return view('errors.404'); 
        }
    }

    public function appointmentsent()
    {
        $yuyuetypes = App\Yuyuetype::orderBy('id','asc')->get();
        return view('front.other.appointment',compact('yuyuetypes'));
    }

    public function appointmentmake(Request $request)
    {
        $input = $request->input();
        $input['status']="0";
    }

    public function feedbacklist()
    {
        $customerid= $this->getuid();
        $myfeedbacks = Feedback::where('customerid',$customerid)->get();
        if ($myfeedbacks->count()<=0) {
            $myfeedbacks = "empty";
        }
        $feedbacklists= Feedback::where('showsnot','1')->orderby('id','desc')->get();
        if ($feedbacklists->count()<=0) {
            $feedbacklists = "empty";
        }
        return view('front.other.feedbacklist',compact('feedbacklists','myfeedbacks'));
    }

    public function feedback()
    {
        $customerid= $this->getuid();
        $myfeedbacks = Feedback::where('customerid',$customerid)->get();
        if ($myfeedbacks->count()<=0) {
            $myfeedbacks = "empty";
        }
        return view('front.other.feedback',compact('myfeedbacks'));
    }

    public function feedbackmy($id)
    {
        $feedback = Feedback::find($id);
        $customerid= $this->getuid();
        if ($feedback) {
            if ($feedback->customerid == $customerid) {
                return view('front.other.feedbackview',compact('feedback'));
            } else {
                $errmsg = array('report'=>'error','errmsg'=>'非法操作','location'=>'/feedback');
                return Redirect::to('/notice')->with('errmsg',$errmsg);
            }
        } else {
            $errmsg = array('report'=>'error','errmsg'=>'非法操作','location'=>'/feedback');
            return Redirect::to('/notice')->with('errmsg',$errmsg);
        }
    }

    public function feedbackteamstore(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'contact'=>'required',
            'content'=>'required',
        ]);


        $returnpath = '/team-view-'.$request->input('teamid').'.html';

        if (Cookie::has('feedback') && !empty(Cookie::get('feedback'))) {
            $errmsg = array('report'=>'error','errmsg'=>'短时间内请勿重复留言，谢谢！','location'=>$returnpath);
            return Redirect::to('/notice')->with('errmsg',$errmsg);
        } else {
            $input = $request->input();
            $input['ip']= $request->getClientIp();
            $input['hasreply'] = '0';
            $input['haslook']="0";
            $input['showsnot']="0";
            $input['published_at']=Carbon::now();
            $input['customerid'] =$this->getuid();
            Feedback::create($input);
            Cookie::queue('feedback','true',10);
            $errmsg = array('report'=>'succeed','errmsg'=>'感谢您的留言，我们将尽快回复！','location'=>$returnpath);
            return Redirect::to('/notice')->with('errmsg',$errmsg);
        }
    }

    public function feedbackstore(Request $request)
    {
        $captcha = Session::get('milkcaptcha','default');
        $this->validate($request,[
            'name'=>'required',
            'contact'=>'required',
            'content'=>'required',
            'captcha'=>'required|in:'.$captcha,
        ]);
        if (Cookie::has('feedback') && !empty(Cookie::get('feedback'))) {
            $errmsg = array('report'=>'error','errmsg'=>'短时间内请勿重复留言，谢谢！','location'=>'/feedback');
            return Redirect::to('/notice')->with('errmsg',$errmsg);
        } else {
            $input = $request->input();
            $input['ip']= $request->getClientIp();
            $input['hasreply'] = '0';
            $input['haslook']="0";
            $input['showsnot']="0";
            $input['published_at']=Carbon::now();
            $input['customerid'] =$this->getuid();
            Feedback::create($input);
            Cookie::queue('feedback','true',10);
            $errmsg = array('report'=>'succeed','errmsg'=>'感谢您的留言，我们将尽快回复！','location'=>'/feedback');
            return Redirect::to('/notice')->with('errmsg',$errmsg);
        }
    }

    public function feedbackreceive(Requests\UpdateFeedbackRequest $request)
    {
        $input = $request->input();
        $userInput = $request->input('captcha');
        $input['ip'] = $request->getClientIp();
        $input['haslook']="0";
        $input['showsnot']="1";
        $input['content'] = str_replace("\n","<br/>",$request->input('content'));
        $input['published_at'] = date('Y-m-d H:i:s');
        $thisid = Feedback::create($input)->id;
        $errmsg = array('report'=>'succeed','errmsg'=>'感谢您的留言，我们将尽快回复！','location'=>'/support/feedback');
        return Redirect::to('notice')->with('errmsg',$errmsg);
    }

    public function contactus()
    {
        return view('other.contactus');
    }

    public function notice(request $request)
    {
        return view('errors.notice');
    }

    public function search(request $request)
    {
        $source = $request->input('keyword');
        $ch = curl_init();
        $url = 'http://apis.baidu.com/apistore/pullword/words?source='.urlencode($source).'&param1=0.2s&param2=0';
        $header = array(
            'apikey: 4b87645cd369d77f85084c77c400bae9',
        );
        // 添加apikey到header
        curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch , CURLOPT_URL , $url);
        $res = curl_exec($ch);

        $words = explode("\n", $res);
        // var_dump($words);
        

        $where1 = "WHERE 1>1 ";
        $where2 = "WHERE 1>1 ";

        $articles = App\Article::orderBy('published_at','desc')->where('id','<',1);
        $cases = App\Cases::orderBy('id','desc')->where('id','<',1);


                $articles = $articles->orWhere('title','like','%'.trim($source).'%');
                $articles = $articles->orWhere('details','like','%'.trim($source).'%');

                $cases = $cases->orWhere('title','like','%'.trim($source).'%');
                $cases = $cases->orWhere('details','like','%'.trim($source).'%');


        foreach ($words as $key => $value) {
              $value = trim($value);


                

              if(!empty($value)&&!ctype_space($value)){
                // $where1 .= "OR `title` like '%".$value."%' OR `content` like '%".$value."%' ";
                // $where2 .= "OR `title` like '%".$value."%' OR `description` like '%".$value."%' ";
                $articles = $articles->orWhere('title','like','%'.$value.'%');
                $articles = $articles->orWhere('details','like','%'.$value.'%');

                $cases = $cases->orWhere('title','like','%'.$value.'%');
                $cases = $cases->orWhere('details','like','%'.$value.'%');


                
               }
        }
        //$articles = $articles->orWhere('title','like','%紫业%');
        $cases = $cases->paginate(18);
        // $articles = $articles->take(50);
        $articles = $articles->paginate(35-$cases->count());



        //dd($articles);

     //    $sql = "SELECT `articles`.`id` as id,`articles`.`title` as title FROM `articles` ".$where1." limit 0,45 union SELECT `case`.`id` as id, `case`.`title` as title FROM `case` ".$where2." order by `created_at` desc limit 0,45;";
     //    // echo $sql;
     // $result = DB::query($sql);
     // var_dump($result);
        // var_dump($result);
     //var_dump( $result);



        view()->share('articles',$articles);
        view()->share('cases',$cases);
         return view('front.other.search',compact('searcharticle','searchcommon','keywords'));

    }

    public function captcha()
    {
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 150, $height = 60, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    public function chat()
    {
        return view('front.other.chat');
    }

}
