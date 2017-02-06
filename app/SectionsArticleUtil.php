<?php

namespace App;



class SectionsArticleUtil
{

	public static function getArticles($sectionArticleId)
	{
		//获取该板块的内容 
		$thisSection = SectionsArticle::find($sectionArticleId);
		// $thisSection->orderkey
		// $thisSection->ordervalue
		// $thisSection->count
		// $thisSection->navid
		// $thisSection->order

		$articles = null;

		if(!empty($thisSection->orderkey)&&$thisSection->orderkey!='random')
		{
			//给ordervalue取个默认值
			if(empty($thisSection->ordervalue))
			{
				$thisSection->ordervalue = 'desc';
			}

			if(empty($thisSection->count)||$thisSection->count==0)
			{
				$thisSection->count = 5;
			}

			if($thisSection->navid == 0)
			{
				//导航条件没有的情况下取所有的类别的article
				$articles  = Article::Published()->orderBy($thisSection->orderkey,$thisSection->ordervalue)->take($thisSection->count)->get();

			}else{

				$articles  = Article::Published()->where('nav_id','=',$thisSection->navid)->orderBy($thisSection->orderkey,$thisSection->ordervalue)->take($thisSection->count)->get();
			}


			
			return $articles;


		}else
		{
			$articles = SectionsArticleUtil::getRandArticles($thisSection->count);
			return $articles;
		}

		

	}

	public static function getOrderKeys()
	{
		$data['random'] = '随机';
		$data['id'] = 'id';
		$data['published_at'] = '发布时间';
		return $data;
	}

	public static function getOrderValues()
	{
		$data['asc'] = '正序';
		$data['desc'] = '反序';

		return $data;
	}


	public static function getRandArticles($count)
    {
        
        $articles = Article::where('showsnot','1')->orderby('id','desc')->skip(0)->take($count*3)->get();
            
       	if($articles->count()<1)
       		return array([]);
        $tmp=array(); 
        while(count($tmp)<$count){ 
            $tmp[]=mt_rand(0,$articles->count()-1); 
            $tmp=array_unique($tmp); 
        }
        if ($articles!=="empty") {
            $post=array();
            foreach ($tmp as $tmps) {
                $post[]=$articles[$tmps];
            }
        return $post;
        } 


    }




}


