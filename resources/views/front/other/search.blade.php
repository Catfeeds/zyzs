@extends('layouts.front.app')
@section('seo')
<title>{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $siteinfo->sitekeywords }}" />
<meta name="description" content="{{ $siteinfo->sitedescription }}" />
@stop
@section('content')
<div class="single-content">
<div class="container">
    <div class="seach-content">
    @if($articles->count()>0)
    <div class="article-header-list">
    <ul>
        <!-- @foreach ($articles as $article)
        <li style="padding:0 20px;"><a href="/article-view-{{$article->id}}.html" title="{{$article->title}}" class="clearfix"><strong>{{$article->title}}</strong> <span>{{$article->published_at->diffForHumans()}}</span></a></li>
        @endforeach -->

        <?php
        for ($i=0; $i < 35; $i++) { 
        	
        	if (!empty($articles[$i]->title)) {
        		?>

<li style="padding:0 20px;"><a href="/article-view-{{$articles[$i]->id}}.html" title="{{$articles[$i]->title}}" class="clearfix"><strong>{{$articles[$i]->title}}</strong> <span>{{$articles[$i]->published_at->diffForHumans()}}</span></a></li>


        		<?php
        	}

        	if (!empty($cases[$i]->title)) {
        		?>

<li style="padding:0 20px;"><a href="/case-view-{{$cases[$i]->id}}.html" title="{{$cases[$i]->title}}" class="clearfix"><strong>{{$cases[$i]->title}}</strong> <span>{{$cases[$i]->created_at->diffForHumans()}}</span></a></li>


        		<?php
        	}




        }
        ?>

    </ul>
</div>
<div>
<!-- {!! $articles->links() !!} -->
</div>
    @else
        <div class="nodata">
            <p><span class="icon-unlink"></span></p>
            <p>暂无数据，可能是管理员偷懒了</p>
            <p><a href="/feedback/sent" class="button border-main icon-legal" title=""> 投诉管理员</a></p>
        </div>
    @endif
    </div>
</div>
</div>
@stop

@section('extrameta')

@stop

@section('extracss')
<link rel="stylesheet" type="text/css" href="/css/slider.css">
@stop

@section('extrajs')
@stop