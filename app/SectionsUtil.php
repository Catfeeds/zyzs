<?php
namespace App;

class SectionsUtil{

	public static function getSection($sectionid)
	{
		$section = Sections::find($sectionid);
		// $section->title; 侧边栏标题

		$data = array();
		$order = array();


		foreach ($section->articlesSections as $key) {

			// $key->id; z这个文章板块的id
			// $data = SectionsArticleUtil::getArticles($key->id); 这个板块的内容
			while (in_array($key->order, $order)) {
				$key->order++;
			}

			$data[$key->order]['section'] = $key;
			$data[$key->order]['datas'] = SectionsArticleUtil::getArticles($key->id);
			$data[$key->order]['type'] = 'articles';
			$order[]=$key->order;

		}

		foreach ($section->caseSections as $key) {
			while (in_array($key->order, $order)) {
				$key->order++;
			}

			$data[$key->order]['section'] = $key;
			$data[$key->order]['datas'] = $key->contents;
			$data[$key->order]['type'] = 'case';
			$order[]=$key->order;

		}

		foreach ($data as $k) {
          $order1[] = $k['section']->order;
        }
        if($data)
        array_multisort($order1, SORT_DESC, $data);
		return $data;

	}

}