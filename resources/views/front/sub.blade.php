@extends('layouts.front.app')
@section('seo')
@if($navigation->hierarchy=="1")
<title>{{$navigation->name}}_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
@else
<title>{{$navigation->name}}_{{$navigation->parent->name}}_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
@endif
<meta name="keywords" content="{{ $navigation->keywords }}" />
<meta name="description" content="{{ $navigation->description }}" />
@stop

@section('content')
<div class="inside-banner hidden-l hidden-s">
    <img src="{{$navigation->banner}}" class="img-responsive" style="margin:0 auto" alt="">
</div>

<div class="layout inside-content">
    <div class="inside-header-submenu">
        <div class="inside-header-submenu-header">
            <p>{{$navigation->name}}</p>
            <span>{{$navigation->nickname}}</span>
        </div>
        @if($navigation->hierarchy == 1)
            @if($navigation->type=="mainmenu")
            <div class="submenu-responsive">
            <ul>
            @foreach($navigation->children as $subnav)
                <li><a href="/{{$navigation->nickname}}/{{$subnav->nickname}}" title="">{{$subnav->name}}</a></li>
            @endforeach
            </ul>
             </div>
            @endif
        @elseif($navigation->hierarchy == 2)
        	<div class="submenu-responsive">
            <ul>
        	@foreach($navigation->brothers()->where('showsnot','1')->get() as $bronav)
        		@if($bronav->id == $navigation->id)
                <li class="active"><a href="/{{$navigation->parent->nickname}}/{{$bronav->nickname}}" title="">{{$bronav->name}}</a></li>
            	@else
            	<li><a href="/{{$navigation->parent->nickname}}/{{$bronav->nickname}}" title="">{{$bronav->name}}</a></li>
            	@endif
            @endforeach
            </ul>
            </div>
        @endif
       
    </div>

<div class="container">
<div class="line-big padding-large-top padding-large-bottom">
@if($navigation->layout=="1")
@include('front.aside')
@endif
<div class="@if($navigation->layout=="3")xm12 xl12 @else xm9 xb9 @endif xl12 xs12 clearfix">
<div class="inside-main">
    <div class="inside-main-title clearfix">
        <h4>{{$navigation->name}}</h4>
        <div class="hidden-s hidden-l"><a href="" title="" class="icon-home"> 首页</a> <span class="icon-angle-double-right"></span> @if($navigation->hierarchy=="2") <a href="/{{$navigation->parent->nickname}}" title="">{{$navigation->parent->name}}</a> <span class="icon-angle-double-right"></span> @endif <span class="inside-main-bread">{{$navigation->name}}</span></div>
    </div>
    
    @if($navigation->type== "menudetails" || $navigation->type=="alonepage")
        <div class="showdetails">
            {!! $navigation->details !!}
        </div>
    @else
        @if($navigation->showdetails=="1" && $navigation->detailsposition=="1")
        <div class="showdetails">
        {!!$navigation->details!!}
        </div>
        @endif
        @include('front.types.'.$navigation->type)
        @if($navigation->showdetails=="1" && $navigation->detailsposition=="2")
        <div class="showdetails">
        {{$navigation->details!!}
        </div>
        @endif
    @endif
    
</div>
</div>
@if($navigation->layout=="2")
@include('front.aside')
@endif
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