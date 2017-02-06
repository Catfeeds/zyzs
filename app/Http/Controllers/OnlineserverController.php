<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Onlinechat;
use App\Onlineserver;
use App\Onlinelist;
use App\Onlinecustomer;
use Cookie;
use Cache;
use Hash;
use Redirect;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
class OnlineserverController extends Controller
{

    public function login()
    {
        if (Cookie::has('serverusername') && Cookie::has('serverkey')) {
            $serverusername = Cookie::get('serverusername');
            $serverkey = Cookie::get('serverkey');
            if (!empty($serverusername) && !empty($serverkey)) {
                $server = Onlineserver::where('id',$serverusername)->where('permission',4)->where('key',$serverkey)->first();
                if ($server) {
                    return Redirect::to('/online/server/reception');
                }
            }   
        }
        return view('front.other.login');
    }

    public function loginstore(Request $request)
    {
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required',
            'captcha'=>'required|in:'.Session::get('milkcaptcha','default'),
        ]);
        //dd(Session::get('milkcaptcha','default'));
            $check = Onlineserver::where('username',$request->input('username'))->first();
            if ($check) {
                if (Hash::check($request->input('password'), $check->password)) {
                    $key = md5(time().rand(1,9999999999999));
                    Cookie::queue('serverusername',$check->id,60*24*7);
                    Cookie::queue('serverkey',$key,60*24*7);
                    $check->key = $key;
                    $check->online = time();
                    $check->save();
                    Cache::put('server'.$check->id, 'online',1); 
                    return Redirect::to('/online/server/reception');
                }else{
                    return redirect()->back();
                }
            } else {
                return redirect()->back();
            }
    }

    public function logout()
    {
        $id = Cookie::get('serverusername');
        Cookie::queue('serverusername','',-60*24*7);
        Cookie::queue('serverkey','',-60*24*7);
        Cache::forget('server'.$id);
        return Redirect::to('/server/login');
    }

    public function receptions()
    {
        $serverid = Cookie::get('serverusername');
        return view('front.other.server');
    }

    public function online(Request $request)
    {
        $serverid = Cookie::get('serverusername');
        //判断cookie 重新登录
        $serverinfo = Onlineserver::where('id',$serverid)->first();
        $serverinfo->online = time();
        $serverinfo->save();
        Cache::put('server'.$serverid, 'online',1); 
    }

    public function cancelnotice(Request $request)
    {
        $customerid = $request->input('customerid');
        $serverid = Cookie::get('serverusername');
        $onlinelist = Onlinelist::where('serverid',$serverid)->where('customerid',$customerid)->first();
        if($onlinelist){
            $onlinelist->notice=0;
            $onlinelist->save();
        }
    }

    public function getcustomers(Request $request)
    {
        $serverid = Cookie::get('serverusername');
        $lastime = time()-60;
        $starttime = time()-86400;
        $servercustomers = Onlinelist::where('serverid',$serverid)->where('online','>=',$lastime)->get();
        $offservercustomers = Onlinelist::where('serverid',$serverid)->where('online','<',$lastime)->where('online','>=',$starttime)->get();
        if ($servercustomers->count()>0 || $offservercustomers->count()>0) {
            $return = array('status' =>'succeed','data'=>$servercustomers,'off'=>$offservercustomers);
            return $return;
        } else {
            $return = array('status' =>'empty');
            return $return;
        }
    }

    public function history(Request $request)
    {
        $serverid = Cookie::get('serverusername');
        $customerid = $request->input('customerid');

        $historys = Onlinechat::where('to',$customerid)->where('from',$serverid)
                    ->orWhere(function ($query) use ($customerid,$serverid) {
                        $query->where('from',$customerid)->where('to',$serverid);
                     })
                    ->orderby('id','desc')->get();
        if ($historys->count()<=0) {
            return "empty";
        } else {
            $returnmsg = '<div class="content-history">以上为历史消息</div>';
            foreach ($historys as $history) {
                if($history->msgType=="text"){
                    $content = str_replace("\n", "<br>",htmlspecialchars($history->content));
                } else {
                    $content = '<br><img src="'.$history->img.'" alt="">';
                }
                if ($history->to == $customerid) {
                    $returnmsg = '<div class="popo"><div class="popo-right"><div class="ico-right "></div><div class="popo-body popo-yellow right radius"><strong>我</strong>：'.$content.
                    '</div></div></div>'.$returnmsg; 
                } else {
                    $returnmsg = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body popo-blue radius box-shadow-small left"><strong>'."访客".substr($history->customerid,1,5)."</strong>： ".$content.
                    '</div></div></div>'.$returnmsg;
                }
                if ($history->send=="0") {
                    $history->send="1";
                    $history->save();
                }
            }
            return $returnmsg;
        }
    }

    public function sentmessage(Request $request)
    {
        $serverid = Cookie::get('serverusername');
        $customerid = $request->input('customerid');
        $content = $request->input('sentmessage');
        $serverinfo = Onlineserver::where('id',$serverid)->first();
        $sentmessage = array('to' =>$customerid ,'from' => $serverid,'nickname' =>$serverinfo->nickname ,'content' => $content,'msgType' => 'text','send' =>'0');
        Onlinechat::create($sentmessage);
        $returnmsg = '<div class="popo"><div class="popo-right"><div class="ico-right "></div><div class="popo-body popo-yellow right radius"><strong>我</strong>：'.htmlspecialchars($content).
                    '</div></div></div>';
        return $returnmsg;
    }

    public function getmsg(Request $request)
    {
        $serverid = Cookie::get('serverusername');
        $customerid = $request->input('customerid');
        $newmessage = Onlinechat::where('from',$customerid)->where('to',$serverid)->where('send',0)->first();
        if ($newmessage) {
            if($newmessage->from=="system") {
            $returnmsg = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left popo-green"><strong>'.$newmessage->nickname."</strong>： ".htmlspecialchars($newmessage->content).
                    '</div></div></div>';
            } else {
                $echocontent = str_replace("\n", "<br>",htmlspecialchars($newmessage->content));
                if ($newmessage->msgType=="text") {
                    $returnmsg = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left"><strong>用户</strong>：'.$echocontent.
                    '</div></div></div>';
                } else {
                    $returnmsg = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left"><strong>用户</strong>： <br><img src="'.$newmessage->img.'" alt=""></div></div></div>';
                }
            }
            $newmessage->send = "1";
            $newmessage->save();
            return $returnmsg;
        } else {
            $imagemessage = Onlinechat::where('from',$serverid)->where('to',$customerid)->where('msgType','image')->where('content','noback')->first();
            if ($imagemessage) {
                $returnmsg = '<div class="popo"><div class="popo-right"><div class="ico-right "></div><div class="popo-body popo-yellow right radius"><strong>我</strong>：<br><img src="'.$imagemessage->img.'"></div></div></div>';
                $imagemessage->content = 'succeed';
                $imagemessage->save();
                return $returnmsg;
            }
            return "";
        }
    }

    public function uploadfile(Request $request)
    {
        $this->validate($request,[
            'customerimage'=>'required|image',
            'customerid'=>'required',
        ]);
        $serverid = Cookie::get('serverusername');
        $customerid = $request->input('customerid');
        $serverinfo = Onlineserver::where('id',$serverid)->first();
        if($request->hasFile('customerimage')){
            $file = $request->file('customerimage');
            if($file->isValid()){
                $destPath = realpath(public_path('chat/server'));
                $filename = time().rand(1,999999).".".$file->getClientOriginalExtension();
                $file->move($destPath,$filename);
                $content = 'noback';
                $sentmessage = array('to' =>$customerid ,'from' => $serverid,'nickname' =>$serverinfo->nickname ,'content' => $content,'msgType' => 'image','img'=>'/chat/server/'.$filename,'send' =>'0');
                Onlinechat::create($sentmessage);
            } else {
                $content = '文件上传出错！';
                $sentmessage = array('to' =>$customerid ,'from' =>'system','nickname' =>'系统' ,'content' => $content,'msgType' => 'text','send' =>'0');
                Onlinechat::create($sentmessage);
            }
        } else {
            $content = '上传文件为空！';
            $sentmessage = array('to' =>$customerid ,'from' =>'system','nickname' =>'系统' ,'content' => $content,'msgType' => 'text','send' =>'0');
            Onlinechat::create($sentmessage);
        }
    }

    public function captcha(Request $request)
    {
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 150, $height = 60, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::put('milkcaptcha', $phrase);
        //Cookie::queue('milkcaptcha',$phrase,60);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    public function reception($customerid)
    {
        $customerid = $customerid;
        $serverid = Cookie::get('serverusername');
        $onlinelist = Onlinelist::where('customerid',$customerid)->where('serverid',$serverid)->first();
        if ($onlinelist->autoback=="0") {
            $serverinfo = Onlineserver::where('id',$serverid)->first();
            if(!empty($serverinfo)){
                $content = $serverinfo->autoback;
            } else {
                $content = '您好！我是客服'.$serverinfo->nickname.'，请问有什么可以帮您？';
            }
            $sentmessage = array('to' =>$customerid ,'from' => $serverid,'nickname' =>$serverinfo->nickname ,'content' => $content,'msgType' => 'text','send' =>'0');
            Onlinechat::create($sentmessage);
            $onlinelist->autoback="1";
            $onlinelist->save();
        }
        return view('front.other.serverview',compact('customerid'));
    }

}