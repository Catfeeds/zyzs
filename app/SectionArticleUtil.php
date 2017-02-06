<?php

namespace App;

class SectionArticleUtil
{

	public static function getArticles($sectionArticleId)
	{
		//获取该板块的内容 
		$thisSection = SectionsArticle::find($sectionArticleId);
		 

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





}


