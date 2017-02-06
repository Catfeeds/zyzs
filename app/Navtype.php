<?php

namespace App;


class Navtype 
{
    public static function getType()
    {
    	$data['mainmenu'] = '主菜单';
    	$data['menudetails'] = '主菜单带内容';
    	$data['alonepage'] = '独立页面';
    	$data['article'] = '文章';
    	$data['recruit'] = '招聘形式';
    	$data['case'] = '案例';
    	$data['team'] = '团队介绍';
    	$data['album'] = '相册形式';
    	return $data;
    }

   
}
