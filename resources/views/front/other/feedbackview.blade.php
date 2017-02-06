@extends('layouts.front.app')
@section('seo')
<title>{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $siteinfo->sitekeywords }}" />
<meta name="description" content="{{ $siteinfo->sitedescription }}" />
@stop
@section('content')
<div class="single-content">
<div class="container">
    <div class="line-big">
    <div class="xm9 xb9 xl12 xs12">
    <div class="feedbacklist">
        <div class="inside-main-title clearfix">
            <h4>我的留言</h4>
            <div class="hidden-s hidden-l"><a href="" title="" class="icon-home"> 首页</a> <span class="icon-angle-double-right"></span> <a href="/feedback" title="留言反馈">留言反馈</a> <span class="icon-angle-double-right"> 我的留言</div>
        </div>

        <div class="feedbacklist-content">
            <div class="collapse">
                <div class="panel active">
                    <div class="panel-body">
                        <p class="text-gray">本留言由 我 于 {{$feedback->published_at->diffForHumans()}} 提交：</p>
                        <p>{{$feedback->content}}</p>
                        @if($feedback->hasreply==1)
                        <p class="text-yellow margin-large-top">管理员回复：</p>
                        <p>{!!$feedback->reply!!}</p>
                        @else
                        <p class="text-yellow">暂无回复，请耐心等待</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
   </div>
   </div>
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