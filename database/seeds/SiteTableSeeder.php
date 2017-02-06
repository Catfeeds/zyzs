<?php

use Illuminate\Database\Seeder;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('sitesets')->insert([
        	'companyname'=> '广州伊碧仕实业有限责任公司',
            'companyphone'=> '020-31130902',
            'companyfax'=> '020-31130921',
            'companyaddress'=> '广东省广州市番禺区',
            'companylogo'=> '/public/imgs/logo.png',
            'footershow'=>'1',
            'footericonshow'=>'1',
            'sitename'=>'伊碧仕',
            'siteico'=>'/favicon.ico',
            'sitebeian'=>'粤ICP备 [2015666441]号',
            'sitekeywords'=>'纱窗,防蚊纱窗,电蚊纱窗,电子灭蚊纱窗',
            'sitedescription'=>'广州伊碧仕实业有限责任公司是一家专注于设计、研发、生产、销售伊碧仕® 电蚊纱窗系统的企业。我们从2009年开始专注研发电蚊纱窗产品，迄今为止，是市面上较先研发成功、并进行生产销售电蚊纱窗的企业。公司以科技创新为驱动，拥有多项电蚊纱窗专利，科研创新遥遥领先同行。',
            'siteurl'=>'www.e-bliss.com.cn',
            'sitemqcrode'=>'',
            'sitewxqcrode'=>'',
            'statistical'=>'',
            'comment'=>'0'
        ]);

        DB::table('navtypes')->insert([
            'type'=> 'menu',
            'typename'=> '主菜单',
            'subtype'=>'1'
        ]);
        DB::table('navtypes')->insert([
            'type'=> 'menu',
            'typename'=> '主菜单带内容',
            'subtype'=>'2'
        ]);
        DB::table('navtypes')->insert([
            'typename'=> '独立页面',
            'type'=> 'page',
            'subtype'=>''
        ]);
        DB::table('navtypes')->insert([
            'typename'=> '文章形式-标题布局',
            'type'=> 'article',
            'subtype'=>'1'
        ]);
        DB::table('navtypes')->insert([
            'typename'=> '文章形式-富文本布局',
            'type'=> 'article',
            'subtype'=>'2'
        ]);
        DB::table('navtypes')->insert([
            'typename'=> '文章形式-图文瀑布流',
            'type'=> 'article',
            'subtype'=>'3'
        ]);
        DB::table('navtypes')->insert([
            'typename'=> '文章形式-图片瀑布流',
            'type'=> 'article',
            'subtype'=>'4'
        ]);
        DB::table('navtypes')->insert([
            'typename'=> '招聘形式',
            'type'=> 'job',
            'subtype'=>'1'
        ]);
        DB::table('navtypes')->insert([
            'typename'=> '产品展示',
            'type'=> 'product',
            'subtype'=>'1'
        ]);

        for ($ib=1; $ib <4 ; $ib++) { 
        DB::table('indexbanners')->insert([
            'filepath'=> '/public/imgs/banner'.$ib.'.jpg',
            'weihao'=> $ib,
            'showsnot'=> '1',
            'alink'=> '/',
            'published_at'=> date("Y-m-d H:i:s"),
        ]);
        }
    	for ($i=1; $i <6 ; $i++) { 
    	if (rand(0,1)%2==0) {
    		$pagestyle = rand(1,2);
    	} else {
    		$pagestyle = rand(3,8);
    	}
        $thisId = DB::table('sitenavs')->insertGetId([
        	'type_id' =>$pagestyle,
        	'nickname'=>str_random(5),
            'name'=>str_random(5),
            'hierarchy'=>'1',
            'parentid'=>'',
            //'pagestyle'=>$pagestyle,
            'weihao'=>$i,
            'keywords'=>str_random(10),
            'description'=>str_random(50),
            'banner'=>'/public/imgs/banner'.rand(1,3).'.jpg',
            'showsnot'=>'1',
            'details'=>str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5),
            'layout'=>rand(1,3),
            'published_at'=>date("Y-m-d H:i:s"),
        ]);

        if($pagestyle>2){
            if ($pagestyle<8) {
               $this->insertarticle($thisId);
            } else {
               $this->insertjob($thisId);
            }
        }

        if($pagestyle==1 || $pagestyle==2){
        	for ($is=1; $is <5 ; $is++) { 
        	$subpagestyle = rand(3,8);
	        $subId = DB::table('sitenavs')->insertGetId([
	        	'type_id' =>$subpagestyle,
	        	'nickname'=>str_random(5),
	            'name'=>str_random(5),
	            'hierarchy'=>'2',
	            'parentid'=>$thisId,
	            //'pagestyle'=>$subpagestyle,
	            'weihao'=>$is,
	            'keywords'=>str_random(10),
	            'description'=>str_random(50),
	            'banner'=>'/public/imgs/banner'.rand(1,3).'.jpg',
	            'showsnot'=>'1',
	            'details'=>str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5).' '.str_random(5),
	            'layout'=>rand(1,3),
	            'published_at'=>date("Y-m-d H:i:s"),
	        ]);

	        if($subpagestyle>3){
                if($subpagestyle<8){
        		$this->insertarticle($subId);
                }else {
                $this->insertjob($subId);
                }
        	}
	        }
        }
        }
    }

    public function insertjob($id){
        for ($ijob=0; $ijob <5 ; $ijob++) { 
            DB::table('jobs')->insert([
            'nav_id'=> $id,
            'jobname'=> str_random(10),
            //'jobtype'=> str_random(3),
            'jobcount'=> rand(1,5),
            'jobplace'=> '深圳市',
            'keywords'=>str_random(10),
            'description'=>str_random(10),
            //'filepath'=>'/public/imgs/tl'.rand(1,13).'.png',
            'details'=>str_random(500),
            'weihao'=>$ijob,
            'showsnot'=>'1',
            'published_at' => date("Y-m-d H:i:s"),
        ]);
        }
    }
    public function insertarticle($id){
        $idf = rand(3,33);
    	for($i=0; $i < $idf; $i++){
    		$thisId=DB::table('articles')->insertGetId([
        	'nav_id'=>$id,
            'title' => str_random(10),
            'zz' => str_random(10).'@gmail.com',
            'keywords' => str_random(20),
            'description' => str_random(50),
            'filepath' => '/public/imgs/tl'.rand(1,13).'.png',
            'details' => str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5)." ".str_random(5),
            'tags' => $i,
            'weihao' => $i,
            'showsnot' => '1',
            'published_at' => date("Y-m-d H:i:s"),  
        ]);

        DB::table('articleviews')->insert([
        	'article_id'=>$thisId,
            'views' => rand(1000,99999),
            'praise' => rand(1,999),
            'whose' => str_random(3),
        ]);

        // $icdf = rand(3,26);
        // for ($ic=1; $ic <$icdf ; $ic++) { 
        // $iconrand = rand(1,734);
        // DB::table('comments')->insert([
        //     'article_id'=>$thisId,
        //     'name'=>str_random(10),
        //     'icon'=>'/public/imgs/user-icon/icon ('.$iconrand.').gif',
        //     'content'=>str_random(120),
        //     'praise'=>'0',
        //     'ip_address'=>'127.0.0.1',
        //     'os'=>'windows',
        //     'published_at'=>date('Y-m-d H:i:s'),
        // ]);
        // }
   		}
    }
}
