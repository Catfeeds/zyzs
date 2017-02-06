@extends('layouts.site')

@section('main')
<div class="container padding-big-top margin-bottom">
<div class="line-big">
<div class="xm9 xs12 xl12 mainshows">
<div class="padding-responsive bg-white">
<div class="margin-big-top"><h1>{{$showarticle->title}}</h1></div>
<div class="text-gray clearfix line-none">
<div class="margin-big-top xm6 xs12 xl12">By：{{$showarticle->zz}}　<time datetime="{{$showarticle->published_at}}"> {{$showarticle->published_at->diffForHumans()}}</time></div>
<div class="margin-big-top xm6 hidden-l hidden-s text-right articlemeta"><span class="icon-eye"> {{$showarticleview->views}}</span><span class="icon-thumbs-o-up padding-large-left @if($articlepraisecookie=='praiseable') win-praise-extra @endif "> {{$showarticleview->praise}}</span></div></div>
<div class="margin-large-top text-big padding-responsive show-article-main">
<div class="line-height">
{!!$showarticle->details!!}
</div>
<div class="margin-large-top padding-large-top padding-large-bottom text-gray text-default">
版权声明：本文系原文作者授权本站发布，如需转载请联系原文作者，并保留文章在本站的完整链接，谢谢!
</div>

<div class="@if($articlepraisecookie=='praiseable')praiseable @else praised @endif">
<div @if($articlepraisecookie=='praiseable') class="win-praise" data-url="/pubajax/praise/{{$showarticle->id}}" data-article="{{$showarticle->id}}" @endif><div><span class="icon-thumbs-o-up"></span></div></div>
<p class="text-gray text-default padding-top">
<span class="haspraise">@if($articlepraisecookie!=='praiseable') 您已经点赞了， @endif</span>
 已有 <span class="text-main count-praise">{{$showarticleview->praise}}</span> 人赞过
</p>
</div>

</div>
</div>
</div>

</div>
</div>
@stop

@section('extrameta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('extrajs')
<script type="text/javascript" src="/public/js/comments.js"></script>
@stop

@section('seo')
<title>{{$showarticle->title}}_{{ $showarticleparent->name}}_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $showarticle->keywords}}" />
<meta name="description" content="{{ $showarticle->description }}" />
@stop