@extends('layouts.site')

@section('main')
<div class="hidden-b hidden-m padding-small-top"></div>
<div class="layout bg-white">
<div class="container padding-big-top">
<div class="padding-big-bottom">
	<h2>相册：{{$showdata->name}}</h2>
</div>
<div class="line-big">

@if(!empty($showdata->options))
<div class="album-list">
<?php $s = json_decode($showdata->options,true);
foreach ($s as $ss) {
?>
	<div class="xb2 xm2 xs12 xl12">
		<div>
			<a href="{{$ss['filepath']}}" title="{{$ss['title']}}"><img src="{{$ss['filepath']}}" class="img-responsive margin-auto"></a>
			<p>{{$ss['title']}}</p>
		</div>
	</div>
<?php } ?>
</div>
@else
@include('errors.404');
@endif
</div>
</div>
</div>
@stop
@section('extrameta')
<link rel="stylesheet" type="text/css" href="/public/css/touchTouch.css">
@stop
@section('extrajs')
<script src="/public/js/touchTouch.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
		$('.album-list a').touchTouch();
	});
</script>
@stop

@section('seo')
<title>{{$showdata->name}}_{{ $showalbumparent->name}}_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $showdata->keywords}}" />
<meta name="description" content="{{ $showdata->description }}" />
@stop