<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;
use Carbon\Carbon;
use Redirect;
use App\Sitenav;
use App\Navtype;
use App\Article;
use Auth;
use App\Articleview;
use App\Product;
use App\Album;
use App\Albumview;
use App\Job;
use App\Feedback;
use App\Feedbacktype;
use App\Common;
use App\Siteset;
use App\Indexbanner;
use App\user;
use App\Cases;
use Hash;
use App;

class ManageController extends Controller
{
    public function index()
    {
        return view('manage.main');
    }

    public function friendlinks()
    {
        $friendlinks = App\Friendlinks::orderBy('weihao','desc')->get();
        view()->share('friendlinks',$friendlinks);
        return view('manage.friendlinks.index');
    }

    public function friendlinkscreate()
    {
        $friendlink = new App\Friendlinks;
        $friendlink->title = '请设置标题';
        $friendlink->links ="#";
        $friendlink->weihao = 500;
        $friendlink->save();
        return redirect()->back();
    }

    public function friendliknsstore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $tmp = App\Friendlinks::find($value);
            $tmp->title = $input['title'][$key];
            $tmp->links = $input['links'][$key];
            $tmp->weihao = $input['weihao'][$key];
            $tmp->save();
        }
        return redirect()->back();
    }


    public function friendlinksdelete($id)
    {
        App\Friendlinks::destroy($id);
        return redirect()->back();
    }

    public function indexline()
    {
        $indexlines = App\Indexline::orderBy('weihao','desc')->get();
        view()->share('indexline',$indexlines);
        return view('manage.indexline.index');
    }




    public function indexlinecreate()
    {
        $indexline = new App\Indexline;
        $indexline->title = '请设置标题';
        $indexline->img = '';
        $indexline->weihao = 500;
        $indexline->save();
        return redirect()->back();
    }

    public function indexlinestore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $tmp = App\Indexline::find($value);
            $tmp->title = $input['title'][$key];
            $tmp->img = $input['img'][$key];
            $tmp->weihao = $input['weihao'][$key];
            $tmp->save();
        }

        return redirect()->back();
    }

    public function indexlinedelete($id)
    {
        App\Indexline::destroy($id);
        return redirect()->back();
    }


    public function formsindex()
    {
        $forms = App\Forms::paginate(10);
        view()->share('forms',$forms);


        return view('manage.forms.index');
    }

    public function formscreate()
    {
        $form = new App\Forms;
        $form->title = "新建表单";
        $form->save();

        return redirect()->back();
    }

    public function formsedit($id)
    {
        $form = App\Forms::find($id);
        view()->share('form',$form);

        return view('manage.forms.edit');
    }

    public function formseditpost(Request $request,$id)
    {
        $data = $request->input("colum");
        $data = json_encode($data);
        
        $form = App\Forms::find($id);
        $form->columns = $data;
        $form->save();
        return redirect()->back();
    }


    public function formsindexpost(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $tmp = App\Forms::find($value);
            $tmp->title = $input['title'][$key];
            $tmp->save();
        }

        return redirect()->back();
    }

    public function formsmanage($id)
    {
        $form = App\Forms::find($id);
        view()->share('form',$form);
        $formsdata = App\Formsdata::where('forms_id','=',$form->id)->get();
        view()->share('formsdata',$formsdata);
        return view('manage.forms.manage');
    }


    public function fengge()
    {
        $fengge = App\Fengge::orderBy('index','desc')->get();
        view()->share('fengge',$fengge);

        return view('manage.fengge.index');

    }

    public function fenggestore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $fengge = App\Fengge::find($value);
            $fengge->title = $input['title'][$key];
            $fengge->nickname = $input['nickname'][$key];
            $fengge->index = $input['index'][$key];
            $fengge->save();
        }

        return redirect()->back();
    }

    public function fenggecreate()
    {
        $fengge = new App\Fengge;
        $fengge->title = "新建风格";
        $fengge->index = 500;
        $fengge->save();
        $fengge->nickname ="style".$fengge->id;
        $fengge->save();
        return redirect()->back();
    }
    public function fenggecreatestore(Request $request)
    {
        $fengge = new App\Fengge;
        $fengge->title = $request->input('title');
        $fengge->nickname = $request->input('nickname');
        $fengge->index = $request->input('index');
        $fengge->save();
        return redirect()->back();
    }
    public function fenggedelete($id)
    {
        App\Fengge::destroy($id);
        return redirect()->back();
    }


    public function indexcase()
    {
        $indexcase = App\Indexcase::orderBy('index','desc')->get();
        view()->share('indexcase',$indexcase);
        return view('manage.indexcase.index');
    }

    public function indexcaseselect()
    {
        $cases = App\Cases::orderBy('order','desc')->paginate(15);
        view()->share('cases',$cases);
        return view('manage.indexcase.selects');

    }

    public function indexcaseselectstore(Request $request)
    {
        foreach ($request->input('selectid') as $key => $value) {
            if(App\Indexcase::where('case_id','=',$value)->first())
            {

            }else
            {
                $tmp = new App\Indexcase;
                $tmp->case_id = $value;
                $tmp->index = 500;
                $tmp->save();
            }
        }

        return redirect("/manage/indexcase");
    }

    public function indexcasedelete($id)
    {
        App\Indexcase::destroy($id);
        return redirect()->back();
    }

    public function course3()
    {
        $course3 = App\Course3::orderBy('index','desc')->get();
        view()->share('course3',$course3);
        return view('manage.course3.index');
    }

    public function course3store(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $tmp = App\Course3::find($value);
            $tmp->title = $input['title'][$key];
            $tmp->img = $input['img'][$key];
            $tmp->url = $input['url'][$key];
            $tmp->index = $input['index'][$key];
            $tmp->tag = $input['tag'][$key];
            $tmp->save();
        }
        return redirect()->back();
    }

    public function course3delete($id)
    {
        App\Course3::delete($id);
        return redirect()->back();
    }
    public function course3create()
    {
            $tmp = new App\Course3;
            $tmp->title = '请设置标题';
            $tmp->img = '';
            $tmp->url = '#';
            $tmp->index = 500;
            $tmp->tag = '标签';
            $tmp->save();
            return redirect()->back();
    }

    public function course()
    {
        $course = App\Course::find(1);
        if(empty($course))
        {
            $course = new App\Course;
            $course->save();
        }

        $navigations = App\Sitenav::where('type','=','article')->get();
        view()->share('navigations',$navigations);

        view()->share('course',$course);
        return view('manage.course.index');

    }

    public function coursestore(Request $request)
    {
        $course = App\Course::find(1);
        if(empty($course))
        {
            $course = new App\Course;
            $course->save();
        }

        $course->l1title = $request->input('l1title');
        $course->l1url = $request->input('l1url');
        $course->l2title = $request->input('l2title');
        $course->l2url = $request->input('l2url');
        $course->r1nav = $request->input('r1nav');
        $course->r2nav = $request->input('r2nav');
        $course->save();
        return redirect()->back();
    }

    public function three()
    {
        $three = App\Three::orderBy('index','desc')->get();
        view()->share("three",$three);
        return view("manage.three.index");
    }

    public function threeedit($id)
    {
        $th = App\Three::find($id);
        view()->share('three',$th);
        return view('manage.three.edit');
    }

    public function threeeditstore(Request $request,$id)
    {
        $th = App\Three::find($id);
        $th->content = $request->input('content');
        $th->save();
        return redirect()->back();
    }

    public function threecreate()
    {
        $th = new App\Three;
        $th->title = "新增图文推荐";
        $th->index = 500;
        $th->content = "";
        $th->img = "";
        $th->url = "";
        $th->mtitle = "";
        $th->save();
        return redirect()->back();
    }

    public function threestore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $th  =  App\Three::find($value);
            $th->title = $input['title'][$key];
            $th->index = $input['index'][$key];
            $th->img = $input['img'][$key];
            $th->url = $input['url'][$key];
            $th->mtitle = $input['mtitle'][$key];
            $th->content = $input['content'][$key];
            $th->save();
        }
        return redirect()->back();
    }

    public function threeeditdelete($id)
    {
        App\Three::destroy($id);
        return redirect()->back();
    }

    public function indeximg()
    {
        $indeximg = App\Indeximg::orderBy('index','desc')->get();
        view()->share('indeximg',$indeximg);

        return view('manage.indeximg.index');
    }

    public function indeximgcreate()
    {
        $indeximg = new App\Indeximg;
        $indeximg->title = "新建大背景图";
        $indeximg->img = "";
        $indeximg->index = 500;
        $indeximg->save();
        return redirect()->back();
    }

    public function indeximgremove($id)
    {
        App\Indeximg::destroy($id);
        return redirect()->back();
    }

    public function indeximgstore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $tmp = App\Indeximg::find($value);
            $tmp->title = $input['title'][$key];
            $tmp->img = $input['img'][$key];
            $tmp->index = $input['index'][$key];
            $tmp->en = $input['en'][$key];
            $tmp->save();
        }
        return redirect()->back();
    }


    public function bottomurl()
    {
        $bottomurl = App\Bottomurl::orderBy('index','dexc')->get();
        view()->share('bottomurl',$bottomurl);
        return view('bottomurl.index');
    }
    public function bottomurlcreate()
    {
        $bottomurl = new App\Bottomurl;
        $bottomurl->title = "请输入标题";
        $bottomurl->index = 500;
        $bottomurl->url = "#";
        $bottomurl->save();
        return redirect()->back();
    }

    public function bottomurlstore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $tmp = App\Bottomurl::find($value);
            $tmp->title = $input['title'][$key];
            $tmp->url = $input['url'][$key];
            $tmp->index = $input['index'][$key];
            $tmp->save();
        }
        return redirect()->back();
    }

    public function bottomurldelete($id)
    {
        App\Bottomurl::destroy($id);
        return reidrect()->back();
    }

    //侧边栏管理页面
    public function sections()
    {
        $sections = App\Sections::all();



        view()->share([
                'sections'=>$sections,

            ]);

     

        return view('manage.section.index');
    }

    public function indexeight()
    {
        $indexeight = App\Indexeight::orderBy('index','desc')->get();
        view()->share('indexeight',$indexeight);
        return view('manage.indexeight.index');
    }

    public function indexeightcreate()
    {
        $data = new App\Indexeight;
        $data->title = "请输入标题";
        $data->img = "";
        $data->url = "#";
        $data->index = 500;
        $data->save();
        return redirect()->back();
    }

    public function indexeightstrore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $tmp = App\Indexeight::find($value);
            $tmp->title = $input['title'][$key];
            $tmp->img = $input['img'][$key];
            $tmp->url = $input['url'][$key];
            $tmp->icon = $input['icon'][$key];
            $tmp->index = $input['index'][$key];
            $tmp->save();
        }
        return redirect()->back();
    }

    public function indexeightdelete($id)
    {
        App\Indexeight::destroy($id);
        return redirect()->back();
    }

    public function sectionsadd()
    {
        $section = new App\Sections;
        $section->title = "新建侧边栏";
        $section->save();
        return redirect("/manage/sitenav/sections/".$section->id);
    }

    public function sectiondelete($id)
    {
        App\Sections::destroy($id);
        return redirect()->back()->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function sectionsstore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $section = App\Sections::find($input['id'][$key]);
            $section->title = $input['title'][$key];
            $section->save();
        }

        return redirect()->back()->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');

    }

    public function yuyue()
    {
        $yuyues = App\Yuyue::orderBy('status','asc')->orderBy('id','desc')->orderby('name','asc')->paginate(20);


        return view('manage.yuyue.index',compact('yuyues'));
    }


    public function yuyueyidu($id)
    {
        $yuyue = App\Yuyue::find($id);
        $yuyue->status = 1;
        $yuyue->save();
        return redirect()->back();
    }

    public function yuyuedelete($id)
    {
        App\Yuyue::destroy($id);
        return redirect()->back();
    }


    public function casesectionAdd($section_id)
    {
        $sections_case = new App\Sections_case;
        $sections_case->section_id = $section_id;
        $sections_case->title = '新建案例侧边栏';
        $sections_case->order = 1000;
        $sections_case->save();
        return redirect()->back();

    }

    public function casesectiondelete($id)
    {
        App\Sections_case::destroy($id);
        return redirect()->back();
    }
    public function sections_bk($id)
    {
        $section = App\Sections::find($id);

        $orderkey = App\SectionsArticleUtil::getOrderKeys();
        $orderValue = App\SectionsArticleUtil::getOrderValues();



        view()->share([
                'section'=>$section,
                'articlesSections'=>$section->articlesSections,
                'caseSections'=>$section->caseSections,
                'orderkey'=>$orderkey,
                'orderValue'=>$orderValue,

            ]);
        return view('manage.section.show');
    }

    public function casebatchmove(Request $request)
    {
        $input = $request->all();
        $selectids = $request->input('selectid');
        if(count($selectids)>0){
            $resivenav = Sitenav::where('type','case')->get();
            if ($resivenav->count()>1) {
                $movecases = Cases::whereIn('id',$selectids)->orderby('id','desc')->get();
                $parentid = $selectids[0];
                $moveacasesparentid = Cases::find($parentid);
                $nav = Sitenav::find($moveacasesparentid->nav_id);
                return view('manage.cases.batchmove',compact('selectids','moveacasesparentid','nav','resivenav','movecases'));
            } else {
                return Redirect::back()->with('returnmsg','<span class=\'icon-exclamation-triangle\'></span> 转移失败：找不到可以接受数据导航、子菜单');
            }
        } else {
            return Redirect::back()->with('returnmsg','<span class=\'icon-exclamation-triangle\'></span> 转移失败：请选择要转移的对象');
        }
    }

    public function casebatchmovestore(Request $request)
    {
        $input = $request->all();
        $selectids = $request->input('id');
        $selectnavid = $request->input('nav_id');
        $returnid = $request->input('returnid');
        if (!empty($selectnavid) && count($selectids)>0) {
            $checkreturn  = Sitenav::find($returnid);
            $checknav = Sitenav::where('id',$selectnavid)->first();
            $checkcase = Cases::whereIn('id',$selectids)->get();
            if ($checknav && $checkreturn) {
                if ($checkcase->count()==count($selectids)) {
                    foreach($checkcase as $selectid){
                        $thissave = Cases::find($selectid->id);
                        $thissave->nav_id = $checknav->id;
                        $thissave->save();
                    }
                    $this->cacheupdate();
                    return Redirect::to('/manage/case/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 转移成功、缓存已更新');
                } else {
                    return view('errors.404');
                }
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function sections_bk_store(Request $request)
    {
        //保存版块信息

        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            if($input['type'][$key]=="articles")
            {
                //文章类别的
                $articleSection = App\SectionsArticle::find($input['id'][$key]);
                
                $articleSection->orderkey = $input['orderkey'][$key];
                $articleSection->ordervalue = $input['ordervalue'][$key];
                $articleSection->count = $input['count'][$key];
                $articleSection->order = $input['order'][$key];
                $articleSection->title = $input['title'][$key];

                $articleSection->save();
                //文章类别的
                // echo($input['id'][$key]);
                // echo$input['orderkey'][$key];
                // echo$input['ordervalue'][$key];
                // echo$input['count'][$key];
                // echo "<br>";

            }
            if($input['type'][$key]=="case")
            {
                $caseSection = App\Sections_case::find($input['id'][$key]);
                $caseSection->title = $input['title'][$key];
                $caseSection->order = $input['order'][$key];
                $caseSection->save();

            }
        } 

        return redirect()->back()->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');

    }

    public function casesectionmanager($id)
    {
        $sections_case = App\Sections_case::find($id);

        $cases = $this->getcases(0);
        view()->share('cases',$cases);

        view()->share('sections_case',$sections_case);
        

        return view('manage.section.casesectionlist');
    }
    //移除案例板块中的案例
    public function casesectioncasedelete($id,$case_id)
    {
        App\Sections_case_contents::where('section_case_id','=',$id)->where('case_id','=',$case_id)->delete();
        return redirect()->back();
    }
    //给案例板块增加案例
    public function casesectioncaseadd($id,$case_id)
    {
        App\Sections_case_contents::where('section_case_id','=',$id)->where('case_id','=',$case_id)->delete();
        $contents = new App\Sections_case_contents;
        $contents->section_case_id = $id;
        $contents->case_id = $case_id;
        $contents->save();
        $case = App\Cases::find($case_id);
        return $case;
    }

    public function getcases($page=0)
    {
        if(!isset($_GET))
        $_GET['page'] = $page;
        $cases = App\Cases::paginate(6);
        return $cases;
    }

    public function teams($id)
    {

        $teams = App\Teams::where('nav_id','=',$id)->first();

        if(!$teams){
            $this->teams_add($id);
            return redirect("/manage/teams/".$id);
        }else
        {
            return redirect("/manage/teams/".$teams->id."/edit");
        }

        // $navigation = App\Sitenav::find($id);

        // view()->share([
        //         'teams'=>$teams,
        //         'navigation'=>$navigation,


        //     ]);
        // return view('manage.teams.index');



    }

    public function teams_delete($teamid)
    {
        App\Teams::destroy($teamid);
        return redirect()->back();
    }

    public function teams_add($nav_id)
    {
        $navigation = App\Sitenav::find($nav_id);
        $team = new App\Teams;
        $team->title = $navigation->name;
        $team->order = 1000;
        $team->nav_id = $nav_id;
        $team->save();
        return redirect("/manage/teams/".$nav_id);

    }


    public function teams_edit($teamid)
    {
        $team = App\Teams::find($teamid);
        view()->share([
                'team'=>$team,

            ]);



        return view('manage.teams.edit');


    }

    public function teams_edit_post($teamid,Request $request)
    {
        $input = $request->all();

        $team = App\Teams::find($teamid);
        $team->introduce = $input['introduce'];
        $team->save();

        $id = $input['id'];
        foreach ($id as $key => $value) {
            $member = App\TeamsMember::find($value);
            $member->order = $input['order'][$key];
            $member->save();

        }

        return redirect()->back();

    }

    public function team_create($teamid)
    {
        $member = new App\TeamsMember;
        $member->name = "新建成员";
        $member->zhiwu = "请设置职务";
        $member->introduce = "";
        $member->order = 1000;
        $member->type = $teamid;
        $member->indexshow = 0;
        $member->save();

        return redirect("/manage/teams/member/".$member->id."/edit");
    }

    public function memeber_delete($memberid)
    {
        App\TeamsMember::destroy($memberid);
        return redirect()->back();
    }

    public function member_edit($memberid)
    {
        $member = App\TeamsMember::find($memberid);
        $teams = App\TeamsMember::find($member->type);

        $selects = App\Teams::all();

        view()->share([
                'member'=>$member,
                'teams'=>$teams,
                'selects'=>$selects,


            ]);
        return view('manage.teams.member_edit');
    }

    public function memberremovemany(Request $request)
    {
        foreach ($request->input('selectid') as $key => $value) {
            App\TeamsMember::destroy($value);
        }
        return redirect()->back();
    }

    public function member_edit_post($memberid,Request $request)
    {
        $member = App\TeamsMember::find($memberid);
        $member->name = $request->input('name');
        $member->zhiwu = $request->input('zhiwu');
        $member->type = $request->input('type');
        $member->introduce = $request->input('introduce');
        $member->order = $request->input('order');
        $member->indexshow = $request->input('indexshow');
        $member->photo = $request->input('photo');
        $member->keywords = $request->input('keywords');
        $member->description = $request->input('description');
        $member->save();


        return redirect("/manage/teams/".$member->team->id."/edit");



    }



    public function albums($navid)
    {
        $navigation = App\Sitenav::find($navid);
        $albums = App\Album::orderBy('weihao','desc')->where('nav_id','=',$navid)->paginate(20);

        return view('manage.albums.list',compact('navigation','albums'));
    }

    public function albuminsert($nav_id) 
    {
        $album = new App\Album;
        $album->nav_id = $nav_id;
        $album->name = '新建相册';
        $album->cover = '';
        $album->weihao = 1000;

        $album->save();

        $views = new App\Albumview;
        $views->weihao = rand(10,9999);
        $views->album_id = $album->id;
        $views->save();
        //这里借用一个表，views的weihao是浏览量。。。。。。。切记
        return redirect('/manage/albums/'.$nav_id);
    }

    public function albumremove($id)
    {
        App\Album::destroy($id);
        App\Albumview::where('album_id',$id)->delete();
        return redirect()->back();
    }

    //管理相册
    public function albumspost($navid,Request $request)
    {
        $input = $request->all();
        // dd($input);

        $id = $input['id'];
        foreach ($id as $key => $value) {
            // echo $value;
            $album = App\Album::find($value);
            $album->name = $input['name'][$key];
            $album->cover = $input['cover'][$key];
            $album->weihao = $input['weihao'][$key];

            $albumview = App\Albumview::where('album_id','=',$album->id)->first();
            $albumview->weihao = $input['fangwen'][$key];
            $albumview->save();

            $album->save();
        }
        return redirect()->back()->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    // 管理相册内的图片
    public function albumupdate($album_id)
    {
        $album = App\Album::find($album_id);
        $pics = App\Albumpic::where("album_id",'=',$album_id)->get();
        return view('manage.albums.pics',compact('album','pics'));
    }



    public function albumpicadd($album_id)
    {
        $pic = new App\Albumpic;
        $pic->img = "";
        $pic->small="";
        $pic->album_id = $album_id;
        $pic->save();
        return redirect()->back();
    }


    public function albumupdatestore($album_id,Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $pic = App\Albumpic::find($value);
            $pic->img = $input['img'][$key];
            $pic->small = $input['small'][$key];
            $pic->save();
        }
        return redirect()->back()->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');

    }



    public function cases($id)
    {
        $navigation = App\Sitenav::find($id);
        $cases = App\Cases::where('nav_id','=',$navigation->id)->orderBy('order','desc')->paginate($navigation->articount);




        return view('manage.cases.index',compact('navigation','cases'));
        

    }

    public function casesstore($id,Request $request)
    { 
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $case = App\Cases::find($value);
            $case->order = $input['order'][$key];
            $case->title = $input['title'][$key];
            $case->indexshow = $input['indexshow'][$key];
            $case->save();
        }

        return redirect()->back();
    }


    public function caseedit($id)
    {
        $case = App\Cases::find($id);
        $navigation = App\Sitenav::find($case->nav_id);

        $members = App\TeamsMember::where('type','=',1)->get();
        view()->share('members',$members);

        $fengge = App\Fengge::orderBy('index','desc')->get();
        view()->share('fengge',$fengge);
        return view('manage.cases.edit',compact('case','navigation'));
    }

    public function caseeditstore($id,Request $request)
    { 
        $case = App\Cases::find($id);
        $case->title = $request->input('title');
        $case->photo = $request->input('photo');
        $case->star = $request->input('star');
        $case->order = $request->input('order');
        $case->nav_id = $request->input('nav_id');
        $case->huxing = $request->input('huxing');
        $case->details = $request->input('details');
        $case->fangxing = $request->input('fangxing');
        $case->mianji = $request->input('mianji');
        $case->fengge = $request->input('fengge');
        $case->leixing = $request->input('leixing');
        $case->keywords = $request->input('keywords');
        $case->description = $request->input('description');

        // dd($request->input('shejishi'));
        App\Case2member::where('case_id','=',$id)->delete();
        $newcase2member = new App\Case2member;
        $newcase2member->case_id = $id;
        $newcase2member->member_id = $request->input('shejishi');
        $newcase2member->save();
        

        $case->indexshow = $request->input('indexshow');
        $case->subtitle = $request->input('subtitle');
        $case->indexcover = $request->input('indexcover');
        $case->save();
        return redirect("/manage/case/".$case->nav_id);
  //       "title" => "文章"
  // "photo" => "/fdafadfa.fda.jpg"
  // "star" => "4"
  // "order" => "1000"
  // "nav_id" => "15"
  // "huxing" => "精装小户型"
  // "details" => "详情"
  // "keywords" => "关键词,kye"
  // "description" => "描述描述"
    }

    public function caseinsert($id)
    {
        $navigation = App\Sitenav::find($id);
        $members = App\TeamsMember::where('type','=',1)->get();
        view()->share('members',$members);

        $fengge = App\Fengge::orderBy('index','desc')->get();
        view()->share('fengge',$fengge);

        view()->share('navigation',$navigation);
        return view('manage.cases.insert');
    }

    public function caseinsertstore($id,Request $request)
    { 
        $case = new App\Cases;
        $case->title = $request->input('title');
        $case->photo = $request->input('photo');
        $case->star = $request->input('star');
        $case->order = $request->input('order');
        $case->nav_id = $request->input('nav_id');
        $case->huxing = $request->input('huxing');
        $case->details = $request->input('details');
        $case->keywords = $request->input('keywords');
        $case->description = $request->input('description');
        $case->fangxing = $request->input('fangxing');
        $case->mianji = $request->input('mianji');
        $case->fengge = $request->input('fengge');
        $case->leixing = $request->input('leixing');


        $case->indexshow = $request->input('indexshow');
        $case->subtitle = $request->input('subtitle');
        $case->indexcover = $request->input('indexcover');
        $case->save();

        App\Case2member::where('case_id','=',$case->id)->delete();
        $newcase2member = new App\Case2member;
        $newcase2member->case_id = $case->id;
        $newcase2member->member_id = $request->input('shejishi');
        $newcase2member->save();


        return redirect("/manage/case/".$id);
  //       "title" => "文章"
  // "photo" => "/fdafadfa.fda.jpg"
  // "star" => "4"
  // "order" => "1000"
  // "nav_id" => "15"
  // "huxing" => "精装小户型"
  // "details" => "详情"
  // "keywords" => "关键词,kye"
  // "description" => "描述描述"
    }


    public function recruit($id)
    {
        $jobs = App\Job::where('nav_id','=',$id)->orderBy('weihao','desc')->get();
        view()->share('jobs',$jobs);
        $navigation  = App\Sitenav::find($id);
        view()->share('navigation',$navigation);

        return view('manage.job.list');


    }
    
    public function recruitinsert($id)
    {
        $navigation = App\Sitenav::find($id);
        view()->share('navigation',$navigation);

        return view('manage.job.insert');
    }

    public function recruitinsertstore(Request $request,$id)
    {
        $job = new App\Job;
        $job->nav_id = $id;
        $job->jobname = $request->input('jobname');
        $job->jobcount = $request->input('jobcount');
        $job->jobplace = $request->input('jobplace');
        $job->keywords = $request->input('keywords');
        $job->description = $request->input('description');
        $job->details = $request->input('details');
        $job->weihao = $request->input('weihao');
        $job->showsnot = $request->input('showsnot');
        $job->published_at = $request->input('published_at');
        $job->save();
        return redirect()->back();
    }

    public function recruitedit($id)
    {
        $job = App\Job::find($id);
        view()->share('job',$job);
        $navigation = App\Sitenav::find($job->nav_id);
        view()->share('navigation',$navigation);
        return view('manage.job.update');
    }

    public function recruiteditpost(Request $request,$id)
    {
        $job = App\Job::find($id);
        $job->jobname = $request->input('jobname');
        $job->jobcount = $request->input('jobcount');
        $job->jobplace = $request->input('jobplace');
        $job->keywords = $request->input('keywords');
        $job->description = $request->input('description');
        $job->details = $request->input('details');
        $job->weihao = $request->input('weihao');
        $job->showsnot = $request->input('showsnot');
        $job->published_at = $request->input('published_at');
        $job->save();
        return redirect()->back();
    }

     public function recruitdelete($id)
     {
        App\Job::destroy($id);
        return redirect()->back();
     }


     public function recruitstore($id,Request $request)
     {
        $input = $request->all();
        $id = $input['id'];
        foreach ($id as $key => $value) {
            $job = App\Job::find($value);
            // $job->jobname = $input['jobname'][$key];
            $job->jobcount = $input['jobcount'][$key];
            $job->jobplace = $input['jobplace'][$key];
            $job->weihao = $input['weihao'][$key];
            $job->showsnot = $input['showsnot'][$key];
            $job->save();
        }
        return redirect()->back();
     }


    public function casedelete($id)
    {
        App\Cases::destroy($id);
        return redirect()->back();
    }

    public function articleSectionDelete($id)
    {

        //删除文章版块id
        App\SectionsArticle::destroy($id);
        return redirect()->back();
    }
    public function articlesectionAdd($id)
    {
        $articleSection = new App\SectionsArticle;
        $articleSection->section_id = $id;
        $articleSection->order = 1000;
        $articleSection->count = 0;
        $articleSection->navid = 0;
        $articleSection->title = "请输入标题";
        $articleSection->save();
        return redirect()->back()->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function sitenav_section($id)
    {
        //给导航$id 设置侧边栏
        $navigation = Sitenav::find($id);
        $sections = App\Sections::all();

        //获取article板快
        if(!empty($navigation->section->id))
        {
            $sections_article = App\SectionsArticle::where('section_id','=',$navigation->section->id)->get();
            // $sections_case = App\Sections_case::where('section_id','=',$navigation->section->id)->get();

        }

        view()->share([
            'navigation'=>$navigation,
            'sections'=>$sections
            
            ]);



        return view('manage.section.navigation');
    }

    public function sitenav_section_select($navid,$sectionid)
    {
        //给导航navie设置新边侧栏sectionid
        $navigation = App\Sitenav::find($navid);
        $navigation->sectionid = $sectionid;
        $navigation->save();
        return redirect('/manage/sitenav/'.$navid.'/section');
    }

    public function sitenav()
    {
        $navigations = Sitenav::where('hierarchy','1')->orderBy('weihao','desc')->get();
        
        

        $sections = App\Sections::all();
        view()->share('sections',$sections);

        $types = App\Navtype::getType();

        return view('manage.sitenav.index',compact('navigations','types'));
    }

    public function sitenavstore(Requests\UpdateSitenavRequest $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach($id as $k=>$v){
            $sitenav = Sitenav::find($input['id'][$k]);
            $sitenav->showsnot = $input['showsnot'][$k];
            $sitenav->layout = $input['layout'][$k];
            $sitenav->weihao = $input['weihao'][$k];
            $sitenav->sectionid = $input['sectionid'][$k];
            $sitenav->save();
        }
        $this->cacheupdate();
        return Redirect::to('/manage/sitenav')->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function sitenavinsert()
    {
        $maxweihao = Sitenav::where('hierarchy','1')->max('weihao');
        if ($maxweihao) {
            $maxweihao = $maxweihao*1+100;
        } else {
            $maxweihao = 100;
        }
        $menutypes = Navtype::getType();
        $sections = App\Sections::all();
        return view('manage.sitenav.insert',compact('maxweihao','menutypes','sections'));
    }

    public function checkstyle(Request $request)
    {
        $this->validate($request,[
            'type'=>'required|in:mainmenu,menudetails,alonepage,article,recruit,case,team,album',
        ]);
        $type = $request->input('type');
        switch ($type) {
            case 'mainmenu':
            return "empty";
            break;
            case 'menudetails':
            return "empty";
            break;
            case 'alonepage':
            return "empty";
            break;
            case 'article':
            $return = array('bytitle' =>'标题排列样式', 'bydesc' => '富文本样式','byhorizon'=>'横向图文样式','bycover'=>'横向封面样式');
            return $return;
            break;
            case 'recruit':
            return "empty";
            break;
            case 'case':
            return "empty";
            break;
            case 'team':
            return "empty";
            break;
            case 'album':
            return "empty";
            break;
        }
    }

    public function sitenavinserts(Requests\CreateSitenavRequest $request)
    {
        $input = $request->all();
        $input['type'] = $request->input('type');
        $input['type_id'] = 1;
        $input['hierarchy'] = "1";
        $input['published_at'] = Carbon::now();
        $input['sectionid']=1;
        Sitenav::create($input);
        $this->cacheupdate();
        return Redirect::to('/manage/sitenav')->with('returnmsg','<span class=\'icon-check\'></span> 添加成功、缓存已更新');
    }

    public function sitenavedit($sitenav_id)
    {
        $editdata = Sitenav::where('id',$sitenav_id)->first();
        $menutypes = Navtype::getType();
        $sections = App\Sections::all();
        return view('manage.sitenav.edit',compact('menutypes','editdata','sections'));
    }

    public function sitenavedits(Requests\StoreSitenavRequest $request,$sitenav_id)
    {
        $sitenav = Sitenav::findOrFail($sitenav_id);
        $sitenav->update($request->all());
        $sections = App\Sections::all();
        $this->cacheupdate();
        return Redirect::to('/manage/sitenav')->with('returnmsg','<span class=\'icon-check\'></span> 导航更新成功、缓存已更新');
    }

    public function sitenavdelete($sitenav_id)
    {
        App\Sitenav::destroy($sitenav_id);
            return Redirect::to('/manage/sitenav')->with('returnmsg','<span class=\'icon-check\'></span> 已删除、缓存已更新');
        
    }

    public function sitenavsubinsert($sitenav_id)
    {
        $maxweihao = Sitenav::where('parentid',$sitenav_id)->max('weihao');
        if ($maxweihao) {
            $maxweihao = $maxweihao*1+100;
        } else {
            $maxweihao = 100;
        }
        $menutypes = Navtype::getType();
        $parentnav = Sitenav::find($sitenav_id);
        $sections = App\Sections::all();
        if ($parentnav) {
            return view('manage.sitenav.subinsert',compact('maxweihao','menutypes','parentnav','sections'));
        } else {
            return view('errors.404');
        }
    }

    public function sitenavsubinserts(Request $request,$sitenav_id)
    {
        $this->validate($request,[
            'type'=>'required|in:alonepage,article,recruit,case,team,album',
            'showsnot'=>'required|integer',
            'layout' => 'required|integer',
            'name' => 'required|alpha_num',
            'nickname' => 'required|alpha_dash|unique:sitenavs|not_in:manage,admin,article,sub,contactus,feedback,support,album,product,products,albums,feedbacks,pubajax,articles,contact,service,server,user,auth',
            'weihao' => 'required|integer',
            'keywords' => 'required',
            'description' => 'required'
        ]);
        $checknav = Sitenav::where('id',$sitenav_id)->where('hierarchy','1')->where('showsnot','!=','3')->first();
        $input = $request->all();
        $input['parentid']=$sitenav_id;
        $input['hierarchy'] = "2";
        $input['published_at'] = Carbon::now();
        $input['sectionid']=1;
        $input['type_id'] = 1;
        if ($checknav) {
            Sitenav::create($input);
            $this->cacheupdate();
            return Redirect::to('/manage/sitenav')->with('returnmsg','<span class=\'icon-check\'></span> 添加成功、缓存已更新');
        } else {
            return view('errors.404'); 
        }
    }

    public function sitenavsubedit($sitenav_id)
    {
        $editdata = Sitenav::where('showsnot','!=','3')->where('id',$sitenav_id)
        ->first();
        $menutypes = Navtype::getType();
        $sections = App\Sections::all();
        if ($editdata) {
            return view('manage.sitenav.subedit',compact('editdata','menutypes','sections'));
        } else {
            return view('errors.404'); 
        }
    }

    public function sitenavsubedits(Requests\StoreSitenavRequest $request,$sitenav_id)
    {
        $sitenav = Sitenav::findOrFail($sitenav_id);
        $sitenav->update($request->all());
        $this->cacheupdate();
        return Redirect::to('/manage/sitenav')->with('returnmsg','<span class=\'icon-check\'></span> 子菜单更新成功、缓存已更新');
    }

    public function sitenavdeleted()
    {
        $deletednav = Sitenav::where('showsnot','3')->get(); 
        if (count($deletednav)>0) {
            # code...
        } else {
            $deletednav = "empty";
        }
        return view('manage.sitenav.deleted',compact('deletednav'));
    }

    public function sitenavclear()
    {
        $deletednav = Sitenav::where('showsnot','3')->get();
        if ($deletednav->count()>0) {
            foreach ($deletednav as $deleted) {
                $deletenav = Sitenav::find($deleted->id);
                if ($deletenav) {
                    $deletenav->delete();
                }
            }
            return Redirect::to('/manage/sitenav')->with('returnmsg','<span class=\'icon-check\'></span> 回收站已清空、缓存已更新');

        } else {
            return view('errors.404'); 
        }
    }

    public function sitenavrecover($sitenav_id)
    {
        $recover = Sitenav::where('showsnot','3')->where('id',$sitenav_id)->first();
        if ($recover) {
            $recover->showsnot = '1';
            $recover->save();
            return Redirect::to('/manage/sitenav/deleted')->with('returnmsg','<span class=\'icon-check\'></span> 恢复成功、缓存已更新');
        } else {
            return view('errors.404'); 
        }
    }

    public function sitenavarticle($sitenav_id){
        $navigation = Sitenav::find($sitenav_id);
        if($navigation->articount>0)
        {
            $count = $navigation->articount;
        }else{
            $count = 15;
        }
        $articles = App\Article::where('nav_id','=',$navigation->id)->orderBy('id','desc')->paginate($count);
        


        return view('manage.article.list',compact('articles','navigation'));
            
    }

    public function sitenavarticleupdate(Requests\UpdatebatchAticleRequest $request)
    {
        $input = $request->all();
        $id = $input['id'];
        $returnid = Article::where('id',$id[0])->first();
        $returnid = $returnid->nav_id;
        foreach($id as $k=>$v){
            $article = Article::find($input['id'][$k]);
            $article->showsnot = $input['showsnot'][$k];
            $article->weihao = $input['weihao'][$k];
            $article->save();
            Cache::forget('showarticle'.$input['id'][$k]);
        }
        $this->cacheupdate();
        return Redirect::to('/manage/sitenav/article/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function articleupdate($article_id)
    {
        $parentid = Article::where('id',$article_id)->first()->nav;
        $editdata = Article::where('id',$article_id)->first();
        $views = $editdata->getview()->first();
        $editdata['views']=$views->views;
        $editdata['praise']=$views->praise;
        return view('manage.article.update',compact('editdata','parentid'));
    }

    public function articleupdatestore(Request $request,$article_id)
    {
        $this->validate($request,[
            'title'=>'required|min:5',
            'showsnot'=>'required|integer|in:1,0',
            'comment' =>'integer|in:1,0',
            'weihao' =>'integer|min:1|max:99999999999',
            'keywords' =>'min:1,max:100',
            'description' =>'min:1,max:200',
            'views'=>'integer|min:1|max:99999999999',
            'praise'=>'integer|min:1|max:99999999999'
            ]);
 
        $article = Article::findOrFail($article_id);
        $article->update($request->all());
        $articleview = $article->getview()->first();
        $articleview->update($request->all());
        $parentid = Sitenav::where('id',$article->nav_id)->first();
        Cache::forget('showarticle'.$article_id);
        return redirect('/manage/sitenav/article/'.$parentid->id)->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function articleremove($sitenav_id)
    {
        $removearticle = Article::find($sitenav_id);
        if($removearticle){
            $parentid = Sitenav::find($removearticle->nav_id);
            if ($parentid) {
                $removearticle->delete();
                return Redirect::to('/manage/sitenav/article/'.$parentid->id)->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
            }
            } else {
            return view('errors.404');
        }
    }

    public function articlebatchmove(Request $request){
        $input = $request->all();
        $selectids = $request->input('selectid');
        if(count($selectids)>0){
            $movearticles = Article::whereIn('id',$selectids)->orderby('weihao','desc')->get();
            if($movearticles->count()==count($selectids)){
                $parentid = $selectids[0];
                $movearticlesparentid = Article::find($parentid);
                $movearticlesparentid = $movearticlesparentid->nav_id;
                $choosemenu = Sitenav::where('id','<>',$movearticlesparentid)->whereIn('type',array('article'))->orderby('weihao','desc')->get();
                if($choosemenu->count()>0){
                    return view('manage.article.batchmove',compact('movearticles','movearticlesparentid','choosemenu'));
                } else {
                    return Redirect::back()->with('returnmsg','<span class=\'icon-exclamation-triangle\'></span> 转移失败：找不到可以接受数据导航、子菜单');
                }
                
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function articlebatchmovestore(Request $request)
    {
        $input = $request->all();
        $selectids = $request->input('id');
        $selectnavid = $request->input('nav_id');
        $returnid = $request->input('returnid');
        if (!empty($selectnavid) && count($selectids)>0) {
            $checkreturn  = Sitenav::find($returnid);
            $checknav = Sitenav::where('id',$selectnavid)->first();
            $checkarticle = Article::whereIn('id',$selectids)->get();
            if ($checknav && $checkreturn) {
                if ($checkarticle->count()==count($selectids)) {
                    foreach($checkarticle as $selectid){
                        $thissave = Article::find($selectid->id);
                        $thissave->nav_id = $checknav->id;
                        $thissave->save();
                    }
                    $this->cacheupdate();
                    return Redirect::to('/manage/sitenav/article/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 转移成功、缓存已更新');
                } else {
                    return view('errors.404');
                }
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function articlebatchremove(Request $request){
        $input = $request->all();
        $selectids = $request->input('selectid');
        if(count($selectids)>0){
            $removearticles = Article::whereIn('id',$selectids)->orderby('weihao','desc')->get();
            $returnid = $removearticles[0]->nav_id;
            if($removearticles->count()==count($selectids)){
                foreach ($selectids as $selectid) {
                    $removearticle = Article::find($selectid);
                    $removearticle->delete();
                }
                return Redirect::to('/manage/sitenav/article/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function articleinsert($sitenav_id)
    {


        $parentid = Sitenav::find($sitenav_id);
        $maxweihao = 1500;
        return view('manage.article.insert',compact('parentid','maxweihao'));
        
    }

    public function articleinsertstore(Requests\CreateAticleRequest $request,$sitenav_id)
    {
        $checksitenav = Sitenav::find($sitenav_id);
        if ($checksitenav) {
            if($checksitenav->type == 'article'){
                $input = $request->all();
                $input['nav_id'] = $checksitenav->id;
                $input['tags'] = '1,2,3,4';
                $input['whose'] = Auth::user()->name;
                $articleid = Article::create($input)->id;
                $input['article_id'] = $articleid;
                Articleview::create($input);
                return Redirect::to('/manage/sitenav/article/'.$checksitenav->id)->with('returnmsg','<span class=\'icon-check\'></span> 添加成功、缓存已更新');
            } else {
                return view('errors.404'); 
            }
        } else {
            return view('errors.404'); 
        }
    }

    public function productlists($sitenav_id){
        $checknav = Sitenav::find($sitenav_id);
        if ($checknav) {
            $chacktype = Navtype::find($checknav->type_id);
            if ($chacktype && $chacktype->type=="product") {
                $manageproduct = Product::where('nav_id',$checknav->id)
                ->orderby('weihao','desc')
                ->get();
                if ($manageproduct->count()>0) {
                } else {
                    $manageproduct = "empty";
                }
                return view('manage.product.list',compact('manageproduct','checknav'));
            } else {
                return view('errors.404'); 
            }
        } else {
            return view('errors.404'); 
        }
    }

    public function productlistsupdate(Requests\UpdatebatchProductRequest $request)
    {
        $input = $request->all();
        $id = $input['id'];
        $returnid = Product::where('id',$id[0])->first();
        $returnid = $returnid->nav_id;
        foreach($id as $k=>$v){
            $Product = Product::find($input['id'][$k]);
            $Product->showsnot = $input['showsnot'][$k];
            $Product->weihao = $input['weihao'][$k];
            $Product->save();
            Cache::forget('showproduct'.$input['id'][$k]);
        }
        $this->cacheupdate();
        return Redirect::to('/manage/sitenav/products/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function productinsert($sitenav_id)
    {
        $parentid = Sitenav::find($sitenav_id);
        if ($parentid ) {
            if($parentid->type_id=="9"){
                $maxweihao = Product::where('nav_id',$sitenav_id)->max('weihao');
                $maxweihao = $maxweihao*1+10;
                return view('manage.product.insert',compact('parentid','maxweihao'));
            } else{
                return view('errors.404');
            }
        } else {
           return view('errors.404'); 
        }
    }

    public function productinsertstore(Request $request,$sitenav_id)
    {
        $this->validate($request,[
            'name'=>'required',
            'showsnot'=>'required|integer|in:1,0',
            'weihao' =>'integer|min:1|max:99999999999',
            'keywords' =>'min:1,max:100',
            'description' =>'min:1,max:200',
            ]);
        $checksitenav = Sitenav::find($sitenav_id);
        if ($checksitenav) {
            if($checksitenav->type_id=="9"){
                $input = $request->all();
                $input['nav_id'] = $checksitenav->id;
                $articleid = Product::create($input);
                return Redirect::to('/manage/sitenav/products/'.$checksitenav->id)->with('returnmsg','<span class=\'icon-check\'></span> 添加成功、缓存已更新');
            } else {
                return view('errors.404'); 
            }
        } else {
            return view('errors.404'); 
        }
    }

    public function productupdate($product_id)
    {
        $parentid = Product::where('id',$product_id)->first()->nav;
        $editdata = Product::where('id',$product_id)->first();
        return view('manage.product.update',compact('editdata','parentid'));
    }

    public function productupdatestore(Request $request,$product_id)
    {
        $this->validate($request,[
            'name'=>'required',
            'showsnot'=>'required|integer|in:1,0',
            'weihao' =>'integer|min:1|max:99999999999',
            'keywords' =>'min:1,max:100',
            'description' =>'min:1,max:200',
            ]);
 
        $product = Product::findOrFail($product_id);
        $product->update($request->all());
        $parentid = Sitenav::where('id',$product->nav_id)->first();
        Cache::forget('showproduct'.$product_id);
        return redirect('/manage/sitenav/products/'.$parentid->id)->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function productremove($product_id)
    {
        $chackthis = Product::find($product_id);
        if ($chackthis) {
            $returnid = $chackthis->nav_id;
            $chackthis->delete();
            return redirect('/manage/sitenav/products/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
        } else {
            return view('errors.404');
        }
    }

    public function productbatchremove(Request $request)
    {
        $input = $request->all();
        $selectids = $request->input('selectid');
        if(count($selectids)>0){
            $removearticles = product::whereIn('id',$selectids)->orderby('weihao','desc')->get();
            $returnid = $removearticles[0]->nav_id;
            if($removearticles->count()==count($selectids)){
                foreach ($selectids as $selectid) {
                    $removearticle = Product::find($selectid);
                    $removearticle->delete();
                }
                return Redirect::to('/manage/sitenav/products/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    // public function albumlists($sitenav_id)
    // {
    //     $checknav = Sitenav::find($sitenav_id);
    //     if ($checknav && $checknav->type_id=="10") {
    //         $albumlists = Album::where('nav_id',$checknav->id)->orderby('weihao','desc')->get();
    //         if ($albumlists->count()>0) {
    //         } else {
    //             $albumlists="empty";
    //         }
    //         return view('manage.album.list',compact('albumlists','checknav'));
    //     }
    // }

    // public function albumlistsupdate(Request $request)
    // {
    //     $input = $request->all();
    //     $id = $input['id'];
    //     $returnid = Album::where('id',$id[0])->first();
    //     $returnid = $returnid->nav_id;
    //     foreach($id as $k=>$v){
    //         $article = Album::find($input['id'][$k]);
    //         $article->showsnot = $input['showsnot'][$k];
    //         $article->weihao = $input['weihao'][$k];
    //         $article->save();
    //     }
    //     $this->cacheupdate();
    //     return Redirect::to('/manage/sitenav/albums/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    // }

    // public function albumupdate($album_id)
    // {
    //     $parentid = Album::where('id',$album_id)->first()->nav;
    //     $editdata = Album::where('id',$album_id)->first();
    //     return view('manage.album.update',compact('editdata','parentid'));
    // }

    // public function albumupdatestore(Request $request,$album_id)
    // {
    //     $album = Album::findOrFail($album_id);
    //     $input = $request->all();
    //     $title = $input['title'];
    //         foreach($title as $k=>$v){
    //             $view[] = array('title'=>$input['title'][$k],'filepath'=>$input['filepath'][$k],'weihao'=>$input['weihaos'][$k], 'showsnot'=>'1');
    //         }
    //     $album->options = json_encode($view);
    //     $album->update($request->all());

    //     $parentid = Sitenav::where('id',$album->nav_id)->first();
    //     return redirect('/manage/sitenav/albums/'.$parentid->id)->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    // }

    // public function albuminsert($sitenav_id)
    // {
    //     $parentid = Sitenav::findOrFail($sitenav_id);
    //     if ($parentid && $parentid->type_id=="10") {
    //         $maxweihao = Album::where('nav_id',$sitenav_id)->max('weihao');
    //         $maxweihao = $maxweihao*1+10;
    //         $nextid = Album::orderby('id','desc')->first();
    //         $nextid = $nextid->id+1;
    //         return view('manage.album.insert',compact('parentid','maxweihao','nextid'));
    //     } else {
    //         return view('errors.404'); 
    //     }
    // }

    // public function albuminsertstore(request $request,$sitenav_id)
    // {
    //     $checksitenav = Sitenav::find($sitenav_id);
    //     if ($checksitenav) {
    //         if($checksitenav->type_id=="10"){
    //             $input = $request->all();
    //             $input['nav_id'] = $checksitenav->id;
    //             $title = $input['title'];
    //                 foreach($title as $k=>$v){
    //                     $view[] = array('title'=>$input['title'][$k],'filepath'=>$input['filepath'][$k],'weihao'=>$input['weihaos'][$k], 'showsnot'=>'1');
    //                 }
    //                 $input['options'] = json_encode($view);
    //             Album::create($input);
    //             return Redirect::to('/manage/sitenav/albums/'.$checksitenav->id)->with('returnmsg','<span class=\'icon-check\'></span> 添加成功、缓存已更新');
    //         } else {
    //             return view('errors.404'); 
    //         }
    //     } else {
    //         return view('errors.404'); 
    //     }

    // }

    // public function albumremove($album_id)
    // {
    //     $chackthis = Album::find($album_id);
    //     if ($chackthis) {
    //         $returnid = $chackthis->nav_id;
    //         $chackthis->delete();
    //         return redirect('/manage/sitenav/albums/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
    //     } else {
    //         return view('errors.404');
    //     }
    // }

    // public function albumbatchremove(Request $request)
    // {
    //     $input = $request->all();
    //     $selectids = $request->input('selectid');
    //     if(count($selectids)>0){
    //         $removearticles = Album::whereIn('id',$selectids)->orderby('weihao','desc')->get();
    //         $returnid = $removearticles[0]->nav_id;
    //         if($removearticles->count()==count($selectids)){
    //             foreach ($selectids as $selectid) {
    //                 $removearticle = Album::find($selectid);
    //                 $removearticle->delete();
    //             }
    //             return Redirect::to('/manage/sitenav/albums/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
    //         } else {
    //             return view('errors.404');
    //         }
    //     } else {
    //         return view('errors.404');
    //     }
    // }

    public function joblists($sitenav_id)
    {
        $checknav = Sitenav::find($sitenav_id);
        if ($checknav && $checknav->type_id=="8") {
            $joblists = Job::where('nav_id',$checknav->id)->orderby('weihao','desc')->get();
            if ($joblists->count()>0) {
            } else {
                $joblists="empty";
            }
            return view('manage.job.list',compact('joblists','checknav'));
        }
    }

    public function joblistsupdate(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        $returnid = Job::where('id',$id[0])->first();
        $returnid = $returnid->nav_id;
        foreach($id as $k=>$v){
            $job = Job::find($input['id'][$k]);
            $job->showsnot = $input['showsnot'][$k];
            $job->weihao = $input['weihao'][$k];
            $job->jobcount = $input['jobcount'][$k];
            $job->jobplace = $input['jobplace'][$k];
            $job->save();
        }
        $this->cacheupdate();
        return Redirect::to('/manage/sitenav/jobs/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function jobinsert($sitenav_id)
    {
        $parentid = Sitenav::find($sitenav_id);
        if ($parentid ) {
            if($parentid->type_id=="8"){
                $maxweihao = Job::where('nav_id',$sitenav_id)->max('weihao');
                $maxweihao = $maxweihao*1+10;
                return view('manage.job.insert',compact('parentid','maxweihao'));
            } else{
                return view('errors.404');
            }
        } else {
           return view('errors.404'); 
        }
    }

    public function jobinsertstore(Request $request,$sitenav_id)
    {
        $checksitenav = Sitenav::find($sitenav_id);
        if ($checksitenav) {
            if($checksitenav->type_id=="8"){
                $input = $request->all();
                $input['nav_id'] = $checksitenav->id;
                Job::create($input);
                return Redirect::to('/manage/sitenav/jobs/'.$checksitenav->id)->with('returnmsg','<span class=\'icon-check\'></span> 添加成功、缓存已更新');
            } else {
                return view('errors.404'); 
            }
        } else {
            return view('errors.404'); 
        }
    }

    public function jobupdate($job_id)
    {
        $parentid = Job::where('id',$job_id)->first()->nav;
        $editdata = Job::where('id',$job_id)->first();
        return view('manage.job.update',compact('editdata','parentid'));
    }

    public function jobupdatestore(Request $request,$job_id)
    {
        $job = Job::findOrFail($job_id);
        $job->update($request->all());
        $parentid = Sitenav::where('id',$job->nav_id)->first();
        return redirect('/manage/sitenav/jobs/'.$parentid->id)->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function jobremove($job_id)
    {
        $chackthis = Job::find($job_id);
        if ($chackthis) {
            $returnid = $chackthis->nav_id;
            $chackthis->delete();
            return redirect('/manage/sitenav/jobs/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
        } else {
            return view('errors.404');
        }
    }

    public function jobbatchremove(Request $request)
    {
        $input = $request->all();
        $selectids = $request->input('selectid');
        if(count($selectids)>0){
            $removearticles = Job::whereIn('id',$selectids)->orderby('weihao','desc')->get();
            $returnid = $removearticles[0]->nav_id;
            if($removearticles->count()==count($selectids)){
                foreach ($selectids as $selectid) {
                    $removearticle = Job::find($selectid);
                    $removearticle->delete();
                }
                return Redirect::to('/manage/sitenav/jobs/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function feedbacklist()
    {
        $lists = Feedback::orderby('id','desc')->get();
        if ($lists->count()>0) {
        } else {
            $lists="empty";
        }
        return view('manage.feedback.list',compact('lists'));
    }

    public function feedbackview($feedback_id)
    {
        $feedback = Feedback::find($feedback_id);
        if ($feedback) {
            return view('manage.feedback.view',compact('feedback'));
        } else{
            return view('errors.404');
        }
    }

    public function feedbackreply(Request $request,$feedback_id)
    {
        $feedback = Feedback::find($feedback_id);
        if ($feedback) {
            $input = $request->all();
            $feedback->content = $input['content'];
            $feedback->reply = $input['reply'];
            $feedback->showsnot = $input['showsnot'];
            $feedback->save();
            return Redirect::to('/manage/feedback/list')->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
        } else {
            return view('errors.404'); 
        }
    }

    public function feedbacktslist($feedback_id)
    {
        $tslist = Common::published()->get();
        if ($tslist->count()>0) {
            $feedback = Feedback::find($feedback_id);
            if ($feedback) {
                return view('manage.feedback.tslist',compact('tslist','feedback'));
            } else {
                return view('errors.404'); 
            }            
        } else {
            return view('manage.feedback.commonlistempty'); 
        }
    }

    public function feedbacktsstore(Request $request,$feedback_id)
    {
        $input = $request->all();
        $feedback = Feedback::find($feedback_id);
        if ($feedback) {
            $feedback->ts = "1";
            $feedback->ts_id = $input['ts_id'];
            $feedback->content = $input['content'];
            $feedback->reply = $input['reply'];
            $feedback->keywords = $input['keywords'];
            $feedback->description = $input['description'];
            $feedback->y = $input['y'];
            $feedback->n = $input['n'];
            $feedback->weihao = $input['weihao'];
            $feedback->save();
            return Redirect::to('/manage/feedback/list')->with('returnmsg','<span class=\'icon-check\'></span> 推送成功、缓存已更新');
        }
    }

    public function feedbackremove($feedback_id)
    {
        $feedback = Feedback::find($feedback_id);
        if ($feedback) {
            $feedback->delete();
            return redirect('/manage/feedback/list')->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
        } else {
            return view('errors.404');
        }
    }

    public function feedbackbatchremove(Request $request)
    {
        $input = $request->all();
        $selectids = $request->input('selectid');
        if(count($selectids)>0){
            $removearticles = Feedback::whereIn('id',$selectids)->orderby('weihao','desc')->get();
            $returnid = $removearticles[0]->nav_id;
            if($removearticles->count()==count($selectids)){
                foreach ($selectids as $selectid) {
                    $removearticle = Feedback::find($selectid);
                    $removearticle->delete();
                }
                return Redirect::to('/manage/feedback/list')->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function feedbackmenu()
    {
        $menu = Feedbacktype::published()->orderby('weihao','desc')->get();
        if ($menu->count()>0) {
            # code...
        } else {
            $menu ="empty";
        }
        return view('manage.feedback.menu',compact('menu'));
    }

    public function feedbackmenustore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach($id as $k=>$v){
            $feedback = Feedbacktype::find($input['id'][$k]);
            $feedback->name = $input['name'][$k];
            $feedback->published_at = $input['published_at'][$k];
            $feedback->weihao = $input['weihao'][$k];
            $feedback->showsnot = $input['showsnot'][$k];
            $feedback->save();
        }
        return Redirect::to('/manage/feedback/menu')->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function feedbackmenuremove($feedbacktype_id)
    {
        $common = Feedbacktype::find($feedbacktype_id);
        if ($common) {
            $common->delete();
            return redirect('/manage/feedback/menu')->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
        } else {
            return view('errors.404');
        }
    }

    public function feedbackmenuinsert()
    {
        $maxweihao = Feedbacktype::max('weihao');
        return view('manage.feedback.menuinsert',compact('maxweihao'));
    }

    public function feedbackmenuinsertstore(Request $request)
    {
        $input = $request->all();
        Feedbacktype::create($input);
        return Redirect::to('/manage/feedback/menu')->with('returnmsg','<span class=\'icon-check\'></span> 添加成功、缓存已更新');
    }

    public function feedbackmenubatchremove(Request $request)
    {
        $input = $request->all();
        $selectids = $request->input('selectid');
        if(count($selectids)>0){
            $removearticles = Feedbacktype::whereIn('id',$selectids)->orderby('weihao','desc')->get();
            $returnid = $removearticles[0]->nav_id;
            if($removearticles->count()==count($selectids)){
                foreach ($selectids as $selectid) {
                    $removearticle = Feedbacktype::find($selectid);
                    $removearticle->delete();
                }
                return Redirect::to('/manage/feedback/menu')->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function commonlist($common_id='')
    {
        $commonlist = Common::published()->orderby('weihao','desc')->get();
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

        return view('manage.common.list',compact('commonlist','common','views'));
    }

    public function commonlistupdate(Request $request,$common_id='')
    {
        $input = $request->all();
        $id = $input['id'];
        $returnid = Feedback::where('id',$id[0])->first();
        $returnid = $returnid->ts_id;
        foreach($id as $k=>$v){
            $feedback = Feedback::find($input['id'][$k]);
            $feedback->weihao = $input['weihao'][$k];
            $feedback->save();
        }
        $this->cacheupdate();
        return Redirect::to('/manage/common/list/'.$returnid)->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function commonremove($common_id)
    {
        $common = Feedback::find($common_id);
        if ($common) {
            $common->delete();
            return redirect('/manage/common/list')->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
        } else {
            return view('errors.404');
        }
    }

    public function commonbatchremove(Request $request)
    {
        $input = $request->all();
        $selectids = $request->input('selectid');
        if(count($selectids)>0){
            $removearticles = Feedback::whereIn('id',$selectids)->orderby('weihao','desc')->get();
            $returnid = $removearticles[0]->nav_id;
            if($removearticles->count()==count($selectids)){
                foreach ($selectids as $selectid) {
                    $removearticle = Feedback::find($selectid);
                    $removearticle->delete();
                }
                return Redirect::to('/manage/common/list')->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function commonedit($common_id)
    {
        $tslist = Common::published()->get();
        if ($tslist->count()>0) {
            $common = Feedback::find($common_id);
            if ($common) {
                return view('manage.common.edit',compact('tslist','common'));
            } else {
                return view('errors.404'); 
            }            
        } else {
            return view('manage.feedback.commonlistempty'); 
        }
    }

    public function commoneditstore(Request $request,$common_id)
    {
        $input = $request->all();
        $feedback = Feedback::find($common_id);
        if ($feedback) {
            $feedback->ts = "1";
            $feedback->ts_id = $input['ts_id'];
            $feedback->content = $input['content'];
            $feedback->reply = $input['reply'];
            $feedback->keywords = $input['keywords'];
            $feedback->description = $input['description'];
            $feedback->y = $input['y'];
            $feedback->n = $input['n'];
            $feedback->weihao = $input['weihao'];
            $feedback->save();
            return Redirect::to('/manage/common/list')->with('returnmsg','<span class=\'icon-check\'></span> 推送成功、缓存已更新');
        }
    }

    public function commoninsert()
    {
        $tslist = Common::published()->get();
        if ($tslist->count()>0) {
            return view('manage.feedback.commonlistempty');
                return view('manage.common.insert',compact('tslist'));
        } else {
            return view('manage.feedback.commonlistempty'); 
        }
    }

    public function commoninsertstore(Request $request)
    {
        $input = $request->all();
        $parentid = Common::find($input['ts_id']);
        if ($parentid ) {
            $input['showsnot'] = '1';
            $input['ts'] = '1';
            Feedback::create($input);
            return Redirect::to('/manage/common/list/'.$input['ts_id'])->with('returnmsg','<span class=\'icon-check\'></span> 添加成功、缓存已更新');
           
        } else {
           return view('errors.404'); 
        }
    }

    public function commonmenu()
    {
        $menu = Common::where('published_at','<=',Carbon::now())->orderby('weihao','desc')->get();
        if ($menu) {
        } else {
            $menu = "empty";
        }

        return view('manage.common.menulist',compact('menu'));
    }

    public function commonmenustore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach($id as $k=>$v){
            $feedback = Common::find($input['id'][$k]);
            $feedback->name = $input['name'][$k];
            $feedback->published_at = $input['published_at'][$k];
            $feedback->weihao = $input['weihao'][$k];
            $feedback->showsnot = $input['showsnot'][$k];
            $feedback->save();
        }
        return Redirect::to('/manage/common/menu')->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function commonmenuinsert()
    {
        $maxweihao = Common::max('weihao');
        return view('manage.common.menuinsert',compact('maxweihao'));
    }

    public function commonmenuinsertstore(Request $request)
    {
        $input = $request->all();
        Common::create($input);
        return Redirect::to('/manage/common/menu')->with('returnmsg','<span class=\'icon-check\'></span> 添加成功、缓存已更新');
    }

    public function commonmenuremove($common_id)
    {
        $common = Common::find($common_id);
        if ($common) {
            $common->delete();
            return redirect('/manage/common/menu')->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
        } else {
            return view('errors.404');
        }
    }

    public function commonmenubatchremove(Request $request)
    {
        $input = $request->all();
        $selectids = $request->input('selectid');
        if(count($selectids)>0){
            $removearticles = Common::whereIn('id',$selectids)->orderby('weihao','desc')->get();
            $returnid = $removearticles[0]->nav_id;
            if($removearticles->count()==count($selectids)){
                foreach ($selectids as $selectid) {
                    $removearticle = Common::find($selectid);
                    $removearticle->delete();
                }
                return Redirect::to('/manage/common/menu')->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function footerlist()
    {
        $firstnavs = Sitenav::Manageparentnav()
        ->leftJoin('navtypes','sitenavs.type_id','=','navtypes.id')
        ->select('sitenavs.*','navtypes.type','navtypes.subtype','navtypes.typename')
        ->orderby('weihao','desc')->get();
        if ($firstnavs->count()==0) {
            $managesitenav = "empty";
        } else {
        foreach ($firstnavs as $firstnav) {
            $subnav = Sitenav::where('parentid',$firstnav->id)->Managesubnav()
            ->leftJoin('navtypes','sitenavs.type_id','=','navtypes.id')
            ->select('sitenavs.*','navtypes.type','navtypes.subtype','navtypes.typename')
            ->orderby('weihao','desc')->get();
            if ($subnav->count()==0) {
                $subnav = "empty";
            }
            $managesitenav[]= array('first' =>$firstnav ,'sub'=>$subnav );
        }
        }
        return view('manage.footer.index',compact('managesitenav'));
    }

    public function footerliststore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach($id as $k=>$v){
            $sitenav = Sitenav::find($input['id'][$k]);
            $sitenav->footershow = $input['footershow'][$k];
            $sitenav->save();
        }
        $this->cacheupdate();
        return Redirect::to('/manage/footer')->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function siteset()
    {
        $editdata=Siteset::find(1);
        return view('manage.siteset.index',compact('editdata'));
    }

    public function sitesetstore(Request $request)
    {
        $editdate = Siteset::find(1);
        $input = $request->input();
        $editdate->update($input);
        Cache::forget('siteinfo');
        return Redirect::to('/manage/siteset')->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function indexbanner()
    {
        $bannerlist = Indexbanner::published()->get();
        if ($bannerlist->count()>0) {
            # code...
        } else {
            $bannerlist ="empty";
        }
        return view('manage.banner.index',compact('bannerlist'));
    }

    public function indexbannerstore(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        foreach($id as $k=>$v){
            $feedback = Indexbanner::find($input['id'][$k]);
            $feedback->weihao = $input['weihao'][$k];
            $feedback->showsnot = $input['showsnot'][$k];
            if (empty($input['alink'][$k])) {
                $feedback->alink = "#";
            } else {
                $feedback->alink = $input['alink'][$k];
            }
            $feedback->save();
        }
        Cache::forget('indexbanner');
        return Redirect::to('/manage/banner')->with('returnmsg','<span class=\'icon-check\'></span> 修改成功、缓存已更新');
    }

    public function indexbannerinsert()
    {
        $maxweihao = Indexbanner::max('weihao');
        $maxweihao =  $maxweihao*1+100;
        return view('manage.banner.insert',compact('maxweihao'));
    }

    public function indexbannerinsertstore(Request $request)
    {
        $input = $request->all();
        if(empty($input['alink'])){
            $input['alink']='#';
        }
        $input['published_at']=date("Y-m-d H:i:s");
        Indexbanner::create($input);
        Cache::forget('indexbanner');
        return Redirect::to('/manage/banner')->with('returnmsg','<span class=\'icon-check\'></span> 添加成功、缓存已更新');
    }

    public function indexbannerremove($banner_id)
    {
        $indexbanner = Indexbanner::find($banner_id);
        if ($indexbanner) {
            $indexbanner->delete();
            Cache::forget('indexbanner');
            return redirect('/manage/banner')->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
        } else {
            return view('errors.404');
        }
    }

    public function indexbannerbatchremove(Request $request)
    {
        $input = $request->all();
        $selectids = $request->input('selectid');
        if(count($selectids)>0){
            $removearticles = Indexbanner::whereIn('id',$selectids)->orderby('weihao','desc')->get();
            $returnid = $removearticles[0]->nav_id;
            if($removearticles->count()==count($selectids)){
                foreach ($selectids as $selectid) {
                    $removearticle = Indexbanner::find($selectid);
                    $removearticle->delete();
                }
                Cache::forget('indexbanner');
                return Redirect::to('/manage/banner')->with('returnmsg','<span class=\'icon-check\'></span> 删除成功、缓存已更新');
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function password()
    {
        return view('manage.password');
    }

    public function passwordstore(Request $request)
    {
        $this->validate($request,[
            'password'=>'required|confirmed'
            ]);
        $input = $request->all();
        $password = $input['password'];
        $user = Auth::user();
        $user->password = Hash::make($password);
        $user->save();
        return Redirect::to('/manage/main')->with('returnmsg','<span class=\'icon-check\'></span> 修改成功');
    }

    public function cacheupdate()
    {
        Cache::forget('sitenav');
        $sitenavs = Sitenav::where('hierarchy','1')->get();
        foreach ($sitenavs as $sitenav) {
           if(Cache::has('aside'.$sitenav->nickname)){
                Cache::forget('aside'.$sitenav->nickname);
           }
        }
    }
}