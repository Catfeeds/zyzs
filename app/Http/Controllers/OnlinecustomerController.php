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

class OnlinecustomerController extends Controller
{
    public function __construct()
    {
        $this->getuid();
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

    public function init()
    {
        //dd(Hash::make('admin888@'));
        $customerid = $this->getuid();
        $chatid = md5(time().rand(1,99999999));
        Cookie::queue('chatid',$chatid,60*24*30*12*20);
        return view('front.other.chat',compact('customerid','chatid'));
    }

    public function checkserver()
    {
        //需要做判断....
        $time = time()-45;
        $servers = Onlineserver::where('online','>',$time)->get();
        $onlineservers = "";
        if($servers->count()>0){
            foreach ($servers as $server) {
                if (Cache::has('server'.$server->id)) {
                    $onlineservers[] = $server;
                }
            }
        } else {
            $onlineservers = "empty";
        }
        return $onlineservers;
    }

    public function callserver($id)
    {
        //通知客服端
        $customerid = $this->getuid();
        $checklist = Onlinelist::where('customerid',$customerid)->first();
        if ($checklist) {
            $checklist->serverid = $id;
            $checklist->notice = '1';
            $checklist->autoback = '0';
            $checklist->save();
        } else {
            $callserver =array('serverid' =>$id ,'customerid' => $customerid,'notice' =>'1' ,'autoback' =>'0');
            Onlinelist::create($callserver);
        }
    }

    public function noticeserver()
    {
        $customerid = $this->getuid();
        $serverid = Cookie::get('serverid');
        $checklist = Onlinelist::where('customerid',$customerid)->where('serverid',$serverid)->first();
        if ($checklist) {
            $checklist->notice = '1';
            $checklist->save();
        }
    }

    public function sentmessage(Request $request)
    {
        $serverid = Cookie::get('serverid');
        $customerid = $this->getuid();
        $content = $request->input('sentmessage');
        $sentmessage = array('to' =>$serverid ,'from' => $customerid,'nickname' =>'' ,'content' => $content,'msgType' => 'text','send' =>'0');
        Onlinechat::create($sentmessage);
        $returnmsg = '<div class="popo"><div class="popo-right"><div class="ico-right "></div><div class="popo-body popo-yellow right radius"><strong>我</strong>：'.htmlspecialchars($content).
                    '</div></div></div>';
        // $returnmsg = $returnmsg.'<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left"><strong>紫业001</strong>： 您好，我现在不在电脑前…您可在此留言，我会尽快回复…</div></div></div>';
        $this->noticeserver();//通知
        $this->online($request);
        return $returnmsg;
    }

    public function getmsg(Request $request)
    {
        $customerid = $this->getuid();
        $newmessage = Onlinechat::where('to',$customerid)->where('send',0)->first();
        $chatid = Cookie::get('chatid');
        $customerchatid = $request->input('chatid');
        $serverid = Cookie::get('serverid');
        if (Cache::has('server'.$serverid)) {
        if($customerchatid==$chatid) {
            if ($newmessage) {
                if($newmessage->from=="system") {
                $returnmsg = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left popo-green"><strong>'.$newmessage->nickname."</strong>： ".htmlspecialchars($newmessage->content).
                        '</div></div></div>';
                } else {
                    $echocontent = str_replace("\n", "<br>",htmlspecialchars($newmessage->content));
                    if ($newmessage->msgType=="text") {
                        $returnmsg = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left"><strong>'.$newmessage->nickname."</strong>： ".$echocontent.'</div></div></div>';
                    } else {
                        $returnmsg = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left"><strong>'.$newmessage->nickname.'</strong>： <br><img src="'.$newmessage->img.'" alt=""></div></div></div>';
                    }
                }
                $newmessage->send = "1";
                $newmessage->save();
                return $returnmsg;
            } else {
                $imagemessage = Onlinechat::where('from',$customerid)->where('msgType','image')->where('content','noback')->first();
                if ($imagemessage) {
                    $returnmsg = '<div class="popo"><div class="popo-right"><div class="ico-right "></div><div class="popo-body popo-yellow right radius"><strong>我</strong>：<br><img src="'.$imagemessage->img.'"></div></div></div>';
                    $imagemessage->content = 'succeed';
                    $imagemessage->save();
                    return $returnmsg;
                }
                return "";
            }
        } else {
            return "other";
        }
        } else {
            return "serveroff";
        }
    }

    public function uploadfile(Request $request)
    {
        $serverid = Cookie::get('serverid');
        $customerid = $this->getuid();
        if($request->hasFile('customerimage')){
            $file = $request->file('customerimage');
            if($file->isValid()){
                if($file->getClientOriginalExtension() == "jpg" || $file->getClientOriginalExtension() == "png" || $file->getClientOriginalExtension() == "gif" || $file->getClientOriginalExtension() == "bmp" || $file->getClientOriginalExtension() == "webp") {
                    $destPath = realpath(public_path('chat/customer'));
                    $filename = time().rand(1,999999).".".$file->getClientOriginalExtension();
                    $file->move($destPath,$filename);
                    $content = 'noback';
                    $sentmessage = array('to' =>$serverid ,'from' => $customerid,'nickname' =>'' ,'content' => $content,'msgType' => 'image','img'=>'/chat/customer/'.$filename,'send' =>'0');
                    Onlinechat::create($sentmessage);
                } else {
                    $content = '文件上传出错！不支持的格式！仅支持jpg|gif|png|bmp|webp等图片格式';
                    $sentmessage = array('to' =>$customerid ,'from' =>'system','nickname' =>'系统' ,'content' => $content,'msgType' => 'text','send' =>'0');
                    Onlinechat::create($sentmessage);
                }
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

    public function history(Request $request)
    {
        $customerid = $this->getuid();
        $historys = Onlinechat::where('to',$customerid)->orWhere('from',$customerid)->orderby('id','desc')->get();
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
                    if ($history->from=="system") {
                        $returnmsg = ''.$returnmsg;
                    } else {
                        $returnmsg = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left"><strong>'.$history->nickname."</strong>： ".$content.
                    '</div></div></div>'.$returnmsg;
                    }
                } else {
                    $returnmsg = '<div class="popo"><div class="popo-right"><div class="ico-right "></div><div class="popo-body popo-yellow right radius"><strong>我</strong>：'.$content.
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

    public function online(Request $request)
    {
        $customerid = $this->getuid();
        $online = Onlinelist::where('customerid',$customerid)->first();
        $online->online = time();
        $online->save();
    }

    public function chooseserver(Request $request)
    {
        $customerid = $this->getuid();
        $servers = $this->checkserver();
        if ($servers!=="empty") {
            if(Cookie::has('serverid')) {
                $serverid = Cookie::get('serverid');
                $time = time()-45;
                $server = Onlineserver::where('id',$serverid)->where('online','>',$time)->first();
                if ($server && Cache::has('server'.$server->id)) {
                    $oserver = "on";
                } else {
                    $oserver = "off";
                }
            } else {
                $oserver = "off";
            }


            if ($oserver = "off") {
                $count = count($servers);
                if ($count=="1") {
                    $selectid = 0;
                } else {
                    $randid = rand(1,$count);
                    $selectid = $randid-1;
                }
                $server = $servers[$selectid];
                Cookie::queue('serverid',$server->id,60*24*30*12*20);
            }

            $serverinfo = $server->nickname;
            $returnmsg = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left popo-green">系统：接入成功，'.$serverinfo.' 为您服务…</div></div></div>';
            $this->callserver($server->id);
        } else {
            $returnmsg ="empty";
        }

        return $returnmsg;
    }
}
