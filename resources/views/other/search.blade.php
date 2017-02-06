@extends('layouts.site')
@section('seo')
<title>全站搜索_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $siteinfo->sitekeywords }}" />
<meta name="description" content="{{ $siteinfo->sitedescription }}" />
@stop

@section('main')
<div class="inside_banner">
    <img src="/public/imgs/inside-contact.jpg">
</div>

<div class="container margin-top margin-bottom">
  <div class="bg-white">
      <div class="padding-responsive">
        <h1>关于 “{{$keywords}}” 的搜索结果:</h1>
        <div class="margin-large-top">
        @if($searcharticle=="empty" && $searchcommon=="empty")
          <div class="text-center bg-white padding-large" style="padding:50px 0px;">
            <h2 class="icon-warning text-gray padding-large-bottom"> 抱歉，什么都没有找到</h2>
            <p><a href="/feedback" class="button border-gray">咨询管理员</a></p>
          </div>
        @else
          @if($searcharticle!=="empty")
          @foreach($searcharticle as $article)
          <div class="panel margin-large-bottom">
            <div class="panel-head"><a href="/articles-view-{{$article->id}}.html">{{$article->title}}</a></div>
            <div class="panel-body">{{$article->description}}</div>
          </div>
          @endforeach
          @else
          @endif

          @if($searchcommon!=="empty")
          @foreach($searchcommon as $common)
          <div class="panel margin-large-bottom">
            <div class="panel-head"><a href="/support/common/view/{{$common->id}}">{{strip_tags($common->content)}}</a></div>
            <div class="panel-body">{{strip_tags($common->reply)}}</div>
          </div>
          @endforeach
          @else
          @endif

        @endif
        </div>
      </div>      
  </div>
</div>

@stop

@section('extrameta')

@stop

@section('extracss')

@stop

@section('extrajs')
@stop