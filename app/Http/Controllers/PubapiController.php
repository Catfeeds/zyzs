<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use App\Album;
use App\Albumview;
use App\Feedback;
use Cookie;

class PubapiController extends Controller
{
    public function praiseapi($article_id)
    {
        $article = Article::find($article_id);
        if ($article) {
        if(Cookie::has('articlepraise'.$article_id)){
            $result = array('errmsg' =>'has' ,'count'=>Cookie::get('articlepraise'.$article_id));
            return $result;
        } else {
            $praise = $article->getview()->first();
            $praise->praise =  $praise->praise+1;
            $praise->save();
            $result = array('errmsg' =>'succeed' ,'count'=>$praise->praise);
            Cookie::queue('articlepraise'.$article_id,$praise->praise,60*24*30*12);
            return $result;
        }
        } else {
        $result = array('errmsg' =>'error');
        return $result;
        }
    }

    public function photosinsert (Request $request)
    {
        $id = $request->input('id');
        $maxweihao = Albumview::where('album_id',$id)->max('weihao');
        if ($maxweihao) {
            $maxweihao = $maxweihao*1+100;
        } else {
            $maxweihao = 100;
        }
        $input = $request->all();
        $input['title']='新增相片';
        $input['weihao']=$maxweihao;
        $input['showsnot']='1';
        $albumid = Albumview::create($input);
        return '123';
    }

    public function commonapi(Request $request,$feedback_id)
    {
        if(Cookie::has('common'.$feedback_id)){
            $result = array('errmsg' =>'has' ,'feedtype'=>Cookie::get('common'.$feedback_id));
        } else{
            $feedback = Feedback::find($feedback_id);
            $input = $request->all();
            if ($input['feedtype'] =="y") {
                $feedback->y = $feedback->y+1;
                $feedback->save();
                Cookie::queue('common'.$feedback_id,"y",60*24*30*12);
                $result = array('errmsg' =>'succeed','feedtype'=>'y');
            } else {
                $feedback->n = $feedback->n+1;
                $feedback->save();
                Cookie::queue('common'.$feedback_id,"n",60*24*30*12);
                $result = array('errmsg' =>'succeed','feedtype'=>'n');
            }
        }
        return $result;
    }
}
