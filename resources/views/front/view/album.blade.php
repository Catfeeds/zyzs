@extends('layouts.front.app')
@section('seo')
<title>{{$album->name}}_{{$navigation->name}}_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{$album->keywords}}" />
<meta name="description" content="{{$album->description}}" />
@stop
@section('content')
<div class="view-content">
    <div class="container">
        <div class="line-big">
            <div class="xm12 xb12 xl12 xs12">
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
                            <a href="/{{$navigation->parent->nickname}}/{{$navigation->nickname}}" title="" class="icon-angle-double-left"> 返回</a>
                        </div>
                    </div>

                    <div class="album-view-title">{{$album->name}}</div>
                    <div class="album-view-info"><span class="icon-eye"> {{$album->getviews->weihao}}</span> <span class="icon-file-image-o"> {{$album->getpics->count()}}</span></div>

                     <div class="demo">
                     {{-- 下方是大图 --}}
                        <div id="slider" class="flexslider">
                          <ul class="slides">
                          @foreach($album->getpics as $key)
                            <li><div><p><img src="{{$key->img}}" /></p></div></li>
                          @endforeach
                          </ul>
                        </div>
                        {{-- 下方是缩略图 --}}
                        <div id="carousel" class="flexslider">
                          <ul class="slides">
                          @foreach($album->getpics as $key)
                            <li><img src="{{$key->small}}" /></li>
                          @endforeach
                          </ul>
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
<link rel="stylesheet" type="text/css" href="/css/sliders.css">
@stop
@section('extrajs')
<script src="/js/sliders.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 100,
        itemMargin: 5,
        asNavFor: '#slider'
      });

      $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel"
      });
}); 
</script>
@stop