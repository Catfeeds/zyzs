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
            <h4>留言反馈</h4>
            <div class="hidden-s hidden-l"><a href="" title="" class="icon-home"> 首页</a> <span class="icon-angle-double-right"></span> <a href="/feedback" title="留言反馈">留言反馈</a> </div>
        </div>

        <div class="feedbacklist-content">
            @if($feedbacklists!=="empty")
            <div class="collapse">
                <?php $count=1 ?> 
                @foreach($feedbacklists as $feedbacklist)
                <div class="panel @if($count=="1") active @endif">
                    <div class="panel-head ">
                        <p class="panel-head-title">{{$feedbacklist->content}}</p>
                    </div>
                    <div class="panel-body feedback-reply">
                        <p class="text-gray">本留言由 访客 于{{$feedbacklist->published_at->diffForHumans()}}提交：</p>
                        <p>{{$feedbacklist->content}}</p>
                        <p class="text-yellow margin-large-top">管理员回复：</p>
                        <p>{!!$feedbacklist->reply!!}</p>
                    </div>
                </div>
                <?php $count++; ?> 
                @endforeach
            </div>
            @else
            <div class="nodata">
                <p><span class="icon-unlink"></span></p>
                <p>暂无留言反馈</p>
                <p><a href="/feedback/sent" class="button border-main icon-legal" title=""> 我要反馈</a></p>
            </div>
            @endif
        </div>
   </div>
   </div>
   <div class="xm3 xb3 xl12 xs12 view-aside">
        <div class="inside-aside-submenu">
            <div class="inside-aside-submenu-header">
                温馨提示
            </div>
            <div class="inside-aside-contact">
                <div class="inside-aside-contact-details">
                    <p>　　您好！欢迎来到紫业国际设计，为了更好地提升服务质量与用户体验，我们设置了留言反馈功能。请随时告诉我们您的想法，我们会认证对待每一份宝贵的反馈。</p>
                    <p class="feedback-button"><a href="/feedback/sent" class="button bg-main icon-pencil-square-o" title="留言反抗"> 我要反馈</a></p>
                </div>
            </div>
        </div>

        <div class="inside-aside-submenu">
            <div class="inside-aside-submenu-header">
                我的留言
            </div>
            <div class="inside-aside-contact">
                @if($myfeedbacks=="empty")
                <div class="inside-aside-contact-details">
                    <p class="aside-empty">您未提交过留言</p>
                </div>
                @else
                <ul>
                    @foreach($myfeedbacks as $myfeedback)
                    <li><a href="/feedback/my/{{$myfeedback->id}}" title=""><span class="icon-history text-gray"> </span>{{$myfeedback->published_at->diffForHumans()}} 的留言 @if($myfeedback->hasreply=="1")<span class="float-right text-yellow">已回复</span>@else <span class="float-right text-gray">暂无回复</span>@endif</a></li>
                    @endforeach
                </ul>
                @endif
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