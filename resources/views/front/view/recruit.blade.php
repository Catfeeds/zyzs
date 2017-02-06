@extends('layouts.front.app')
@section('seo')
<title>{{$navigation->name}}_<?php if(!empty($navigation->parent->name)) echo $navigation->parent->name."_"; ?>{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{$jobs->keywords}}" />
<meta name="description" content="{{$jobs->description}}" />
@stop
@section('content')
<div class="view-content">
    <div class="container">
        <div class="line-big">
            <div class="xm9 xb9 xl12 xs12">
                <div class="album-view">
                    <div class="inside-bread-nav hidden-s hidden-l clearfix">
                        <div class="inside-bread-nav-left">
                            <a href="/" title="" class="icon-home"> 首页</a> <span class="icon-angle-double-right"></span>
                            
                            @if(!empty($navigation->parent->name))
                            <a href="/{{$navigation->parent->nickname}}" title="/{{$navigation->parent->nickname}}">{{$navigation->parent->name}}</a> <span class="icon-angle-double-right"></span> <span class="inside-main-bread">
                            @endif
                            
                            <a href="/{{$navigation->parent->nickname}}/{{$navigation->nickname}}" title="">{{$navigation->name}}</a></span> <span class="icon-angle-double-right"></span>
                            <span class="inside-main-bread">正文</span>
                        </div>
                        <div class="inside-bread-nav-right">
                            <a href="/{{$navigation->nickname}}" title="" class="icon-angle-double-left"> 返回</a>
                        </div>
                    </div>

                    <div class="recruit-header clearfix">
                        <div class="recruit-header-left">
                            <strong>职位名称：</strong>{{$jobs->jobname}}
                        </div>
                        <div class="recruit-header-right">
                            <strong>招聘人数：</strong>@if($jobs->jobcount == 0) 若干 @else {{$jobs->jobcount}} 名 @endif
                        </div>
                        <div class="recruit-header-left">
                            <strong>工作地点：</strong>{{$jobs->jobplace}}
                        </div>
                        <div class="recruit-header-right">
                            <strong>发布时间：</strong>{{mb_substr($jobs->published_at,0,10,'utf-8')}}
                        </div>
                    </div>
                    <div class="recruit-details">
                         {!!$jobs->details!!}

                    </div>
                </div>
            </div>
            <div class="xm3 xb3 xl12 xs12 view-aside">
            @if($others->count()>0)
                <div class="inside-aside-submenu">
                    <div class="inside-aside-submenu-header">
                        其他职位
                    </div>
                    <ul>
                    @foreach($others as $job)
                        <li><a href="/recruit-view-{{$job->id}}.html" title="" class="clearfix"><i class="icon-bookmark-o text-black"></i> {{$job->jobname}} <i class="icon-map-marker float-right padding-small-right">{{$job->jobplace}}</i></a></li>
                    @endforeach
                    </ul>
                </div>
            @endif
                <div class="inside-aside-submenu">
                    <div class="inside-aside-submenu-header">
                        关注我们
                    </div>
                    <div class="inside-aside-wechat">
                        <img src="/imgs/1.png" alt="">
                        <h4>紫业国际设计</h4>
                        <p>扫一扫，关注我们</p>
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

@stop
@section('extrajs')

@stop