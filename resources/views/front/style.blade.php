@extends('layouts.front.app')
@section('seo')

<title>{{$style->title}}</title>
<meta name="keywords" content="{{ $style->keywords }}" />
<meta name="description" content="{{ $style->description }}" />
@stop

@section('content')
<div class="inside-banner hidden-l hidden-s">
    <img src="{{$navigation->banner}}" class="img-responsive" style="margin:0 auto" alt="">
</div>



<div class="layout inside-content">
    <div class="inside-header-submenu">
        <div class="inside-header-submenu-header">
            <p>{{$style->title}}</p>
            <span>style</span>
        </div>
        
        	<div class="submenu-responsive">
            <ul>
        	@foreach($styles as $key)
        		@if($key->id == $style->id)
                <li class="active"><a href="/style-view-{{$key->id}}.html" title="">{{$key->title}}</a></li>
            	@else
            	<li><a href="/style-view-{{$key->id}}.html" title="">{{$key->title}}</a></li>
            	@endif
            @endforeach
            </ul>
            </div>
      
       
    </div>

<div class="container">
<div class="line-big padding-large-top padding-large-bottom">

<div class="xm12 xl12  xl12 xs12 clearfix">
<div class="inside-main">
    <div class="inside-main-title clearfix">
        <h4>{{$style->title}}</h4>
        <div class="hidden-s hidden-l"><a href="" title="" class="icon-home"> 首页</a> <span class="icon-angle-double-right"></span> 
       
         <span class="inside-main-bread">{{$style->title}}</span></div>
    </div>
    


@if($cases->count()>0)
<?php if($navigation->layout=="3"){
        $xwidth = "3";
    } else {
        $xwidth = "4";
    }?>
<div class="inside-cases line-big padding-big-top clearfix">
@foreach($cases as $case)
    <div class="xb{{$xwidth}} xm{{$xwidth}} xl6 xs6">
        <div class="inside-case">
            <div class="inside-case-cover">
                <a href="/case-view-{{$case->id}}.html" title=""><img src="{{$case->photo}}" alt=""></a>
                {{--
                @foreach($case->getstyles as $key => $style)
                @if($key==0)
                <a href="/style-view-{{$style->id}}.html">
                    <span>{{$style->title}}</span>
                </a>
                @endif
                @endforeach
                --}}
            </div>
            <p><a href="/case-view-{{$case->id}}.html" title="{{$case->title}}">{{$case->title}}</a></p>
        </div>
    </div>
@endforeach
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
</div>
</div>
@stop

@section('extrajs')
<script type="text/javascript">
    $(function(){
        $('.article-horizon').imagesLoaded( function() {
            $(".article-horizon").masonry({ columnWidth: 0 });
            $(".article-horizon").masonry("reload");
        });
        $('.article-cover-list').imagesLoaded( function() {
            $(".article-cover-list").masonry({ columnWidth: 0 });
            $(".article-cover-list").masonry("reload");
        });
        $(".inside-cases").imagesLoaded( function() {
            $(".inside-cases").masonry({ columnWidth: 0});
            $(".inside-cases").masonry("reload");
        });
    })
   
</script>
@stop