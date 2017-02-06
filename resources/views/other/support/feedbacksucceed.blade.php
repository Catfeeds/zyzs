@extends('layouts.site')
@section('seo')
<title>{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $siteinfo->sitekeywords }}" />
<meta name="description" content="{{ $siteinfo->sitedescription }}" />
@stop

@section('main')
<div class="inside_banner">
    <img src="/userfiles/images/banner/20160312_070348.jpg">
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
        <div class="xm9 xs12 xl12 ">
            <div class="bg-white">
                <div class="main-header padding-responsive-leftright margin-big-bottom">
                    <div class="border-bottom border-main clearfix">    
                        <div class="float-left"><h1 class="text-main"> 在线反馈<span class="text-gray"> FEEDBACK</span></h1></div>
                        <div class="float-right text-right hidden-l hidden-s"><a href="/" title="" class="icon-mail-reply"> 返回</a></div>
                    </div>
                </div>
           <div class="padding-responsive-leftright padding-responsive-bottom clearfix">
                <div class="">
                    
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
<script type="text/javascript">
$(function(){
    $(".captcha").click(function(){
        $(this).attr('src','/captcha?.s='+Math.random());
    })
})
</script>
@stop