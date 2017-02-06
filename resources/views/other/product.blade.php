@extends('layouts.site')

@section('main')
<div class="hidden-b hidden-m padding-small-top"></div>
<div class="layout bg-white margin-bottom">
<div class="container padding-big-top">
<div class="line-big">
<div class="padding-responsive">
	<div class="clearfix">
	<div class="xb6 xm6 xs12 xl12 text-center padding-bottom">
	<img src="{{$showdata->filepath}}" alt="" class="img-responsive">
	</div>
	<div class="xb6 xm6 xs12 xl12 padding-bottom parameter-box">
		<h1> {{$showdata->name}} </h1>
		<div class="hidden-s hidden-l">
			<div class="text-main text-plus padding-big-bottom padding-big-top">{{$showdata->title}}</div>
		</div>
		<div class="hidden-m hidden-b">
			<div class="text-main text-plus padding-big-bottom padding-top" style="font-size: 24px;">{{$showdata->title}}</div>
		</div>
		<div class="line-height">{!!$showdata->parameter!!}</div>
	</div>
	</div>
	<div class="x12 padding-bottom">
	<hr>
	</div>
	<div class="x12 mainshows line-height">
		{!!$showdata->details!!}
	</div>
</div>
</div>
</div>
</div>
@stop
@section('extrameta')

@stop
@section('extrajs')

@stop

@section('seo')
<title>{{$showdata->name}}_{{$showproductparent->name}}_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $showdata->keywords}}" />
<meta name="description" content="{{ $showdata->description }}" />
@stop