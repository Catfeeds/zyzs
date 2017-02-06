@extends('layouts.site')
@section('seo')
<title>{{ $common->name }}_常见问题_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $siteinfo->sitekeywords }}" />
<meta name="description" content="{{ $siteinfo->sitedescription }}" />
@stop

@section('main')
<div class="inside_banner">
    <img src="/public/imgs/inside-support.jpg">
</div>
<div class="container margin-big-top">
    <div class="line-big padding-bottom">
        <div class="xm3 xs12 hidden-l hidden-s site-aside">
            <div class="bg-white margin-bottom">
                <div class="site-aside-header">服务与支持</div>
                @include('other.support.aside')
            </div>
            @include('sub.aside')
        </div>
        <div class="xm9 xs12 xl12">
            <div class="bg-white">
            <div class="main-header padding-responsive-leftright margin-big-bottom">
                <div class="border-bottom border-main clearfix">    
                    <div class="float-left"><h1 class="text-main"> 常见问题<span class="text-gray"> COMMON</span></h1></div>
                    <div class="float-right text-right hidden-l hidden-s"><a href="/" title="" class="icon-mail-reply"> 返回</a></div>
                </div>
            </div>
           <div class="padding-responsive-leftright padding-responsive-bottom">
                
                @if($commonlist!=="empty")
                <div class="padding-large-bottom">
                @foreach($commonlist as $commonlists)
                <a href="/support/common/{{$commonlists->id}}" title="" class="margin-right button @if($commonlists->id ==$common->id)bg-blue @else border-blue @endif">{{$commonlists->name}}</a>
                @endforeach
                </div>

                @if($views!=="empty")
                <ol>
                @foreach($views as $commonview)
                <li>
                    <div class="padding-bottom text-big border-bottom margin-large-bottom">
                        <a href="/support/common/view/{{$commonview->id}}" title="">{!!$commonview->content!!}</a>
                    </div>
                </li>
                @endforeach
                </ol>

                <div class="margin-large-top">
                    {!! $views->render() !!}
                </div>
                @else
                <div class="text-center text-large text-gray" style="min-height: 1000px; padding-top:80px;">
                    <p class="padding-bottom">管理员正努力整理中，稍候将为您呈现！</p>
                    <a href="/support/feedback" class="button border-gray">咨询管理员</a>
                </div>
                @endif

                @else 
                <div class="text-center text-large text-gray" style="min-height: 1000px; padding-top:80px;">
                    <p class="padding-bottom">管理员正努力整理中，稍候将为您呈现！</p>
                    <a href="/support/feedback" class="button border-gray">咨询管理员</a>
                </div>
                @endif
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