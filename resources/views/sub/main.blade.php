<div class="bg-white">
<div class="main-header padding-responsive-leftright margin-big-bottom">
    <div class="border-bottom border-main clearfix">    
    <div class="float-left">
         <h1 class="text-main"> {{$showdata->name}}</h1>
    </div>
    <div class="float-right text-right hidden-l hidden-s">            
        <a href="/" title="" class="icon-mail-reply"> 返回</a>
    </div>
    </div>
</div>

<div class="padding-responsive-leftright padding-responsive-bottom">

<?php 
switch ($showdata->type) {
    case 'menu':
        switch($showdata->subtype) {
            case '2': ?>
            <div class="line-height showcontent">
                {!!$showdata->details!!}
            </div>
        <?php break;
        }
    break;

    case 'page':?>
        <div class="line-height showcontent">
        {!!$showdata->details!!}
        </div>
    <?php break;

    case 'article':
        switch($showdata->subtype) {
            case '1':?>
            @if($articles->count()!==0)
            
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="1")
                <div class="padding-large-bottom line-height showcontent">
                    {!! $showdata->details!!}
                </div>
            @endif
            @foreach($articles as $article)
            <div class="border-bottom margin-large-bottom">
            <h1><a href="/articles-view-{{$article->id}}.html">{{$article->title}}</a></h1>
            <p class="padding-top text-gray">撰文：{{$article->zz}} <span class="padding-left gray"><time datetime="{{$article->published_at}}">发表于：{{$article->published_at->diffForHumans()}}</time></span></p>
            <div class="text-big height-big">{{$article->description}}</div>
            <div class="padding-big-top text-gray"><p><span class="icon-eye padding-large-right"> {{$article->views}}</span><span class="icon-thumbs-o-up padding-large-right"> {{$article->praise}}</span></p></div>
            </div>
            @endforeach
            <div class="text-center">
            {!! $articles->render() !!}
            </div>
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="2")
                <div class="padding-large-top line-height showcontent">
                    {!! $showdata->details!!}
                </div>
            @endif
            
            @else
            @include('sub.null')
            @endif
            <?php
            break;
            case '2':?>
            @if($articles->count()!==0)
            <div class="height-big text-big article-list-items">
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="1")
                <div class="x12 padding-large-bottom line-height showcontent">
                    {!! $showdata->details!!}
                </div>
            @endif
            <ul class="clearfix line-none">
            @foreach($articles as $article)
            <li class="clearfix"><div class="xm9 xl12 xs12"><a href="/articles-view-{{$article->id}}.html">{{$article->title}}</a></div><div class="xm3 hidden-l hidden-s text-right text-small text-gray"><span><time datetime="{{$article->published_at}}"> {{$article->published_at->diffForHumans()}}</time></span></div></li>
            @endforeach
            </ul>
            </div>
            <div class="text-center margin-big-top bg-white padding-large">
            {!! $articles->render() !!}
            </div>
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="2")
                <div class="x12 padding-large-top line-height showcontent">
                    {!! $showdata->details!!}
                </div>
            @endif
            @else
            @include('sub.null')
            @endif
            <?php 
            break;case '3':?>
            @if($articles->count()!==0)
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="1")
                <div class=" margin-large-bottom line-height showcontent">
                {!! $showdata->details!!}
                </div>
            @endif 
            <div class="line-big article-fixed-items clearfix">
            @foreach($articles as $article)
                <div class="@if($showdata->layout==3) xm3 @else xm4 @endif xl12 xs12 padding-large-bottom animated fadeIn clearfix">
                    <div class="bg-white">
                    <a href="/articles-view-{{$article->id}}.html" title="{{$article->title}}"><img src="{{$article->filepath}}" class="img-responsive" alt="{{$article->title}}"></a>
                    <div class="padding text-big height-big"><a href="/articles-view-{{$article->id}}.html" title="{{$article->title}}">{{$article->title}}</a></div>
                    <div class="padding text-gray"><span class="icon-eye padding-large-right"> {{$article->views}}</span><span class="icon-thumbs-o-up padding-large-right"> {{$article->praise}}</span></div>
                    </div>
                </div>
            @endforeach
            </div>
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="2")
                <div class="margin-large-top line-height showcontent">
                {!! $showdata->details!!}
                </div>
            @endif
            <div class="text-center text-gray text-large loadmore" data-page="2" data-url="/pubajax/content/{{$showdata->nickname}}"></div>
            @else
            @include('sub.null')
            @endif
            <?php 
            break;case '4':?>
            @if($articles->count()!==0)
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="1")
                <div class="bg-white padding-responsive margin-large-bottom line-height showcontent">
                {!! $showdata->details!!}
                </div>
            @endif            
            <div class="line-big article-fixed-items radius clearfix itemhover">
            @foreach($articles as $article)
            <div class="@if($showdata->layout==3) xm3 @else xm4 @endif xl12 xs12 padding-large-bottom animated fadeIn clearfix">
                <div class="bg-white">
                <a href="/articles-view-{{$article->id}}.html" title="{{$article->title}}"><img src="{{$article->filepath}}" title="{{$article->title}}"></a>
                <p class="hidden-m hidden-b padding-left padding-right">{{$article->title}}</p>
                </div>
            </div>
            @endforeach
            </div>
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="2")
                <div class="bg-white padding-responsive margin-large-top line-height showcontent">
                {!! $showdata->details!!}
                </div>
            @endif
            <div class="text-center text-gray text-large loadmore" data-page="2" data-url="/pubajax/content/{{$showdata->nickname}}"></div>
            @else
            @include('sub.null')
            @endif
            <?php 
            break;
        }
        break;
    
    case "product": ?>
        @if($products->count()!==0)
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="1")
                <div class="margin-large-bottom line-height showcontent">
                    {!! $showdata->details!!}
                </div>
            @endif
            <div class="line-big article-fixed-items clearfix">
            
            @foreach($products as $product)
                <div class="@if($showdata->layout==3) xm3 @else xm4 @endif xl12 xs12 padding-large-bottom animated fadeIn clearfix">
                    <div class="bg-white hover-gray-bg">
                    <a href="/products-view-{{$product->id}}.html" title="{{$product->name}}"><img src="{{$product->filepath}}" class="img-responsive" alt="{{$product->title}}"></a>
                    <div class="padding text-big height-big text-center overhidden"><a href="/products-view-{{$product->id}}.html" title="{{$product->name}}">{{$product->name}}<br>{{$product->title}}</a></div>
                    </div>
                </div>
            @endforeach
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="2")
                <div class="x12 padding-large-top line-height showcontent">
                    {!! $showdata->details!!}
                </div>
            @endif
            </div>
        <div class="text-center text-gray text-large loadmore" data-page="2" data-url="/pubajax/content/{{$showdata->nickname}}"></div>
        @else
        @include('sub.null')
        @endif
    <?php break;
    case "album": ?>
    @if($albums->count()!==0)
        @if($showdata->showdetails=="1" && $showdata->detailsposition=="1")
                <div class="bg-white padding-responsive margin-large-bottom line-height showcontent">
                {!! $showdata->details!!}
                </div>
        @endif  
        <div class="line-big article-fixed-items clearfix itemhover">
        @foreach($albums as $album)
        <div class="@if($showdata->layout==3) xm3 @else xm4 @endif xl12 xs12 padding-large-bottom animated fadeIn clearfix">
            <div class="bg-white">
            <a href="/albums-view-{{$album->id}}.html" title="{{$album->name}}"><img src="{{$album->cover}}" title="{{$album->name}}"></a>
            <p class="hidden-m hidden-b padding-left padding-right">{{$album->name}}</p>
            </div>
        </div>
        @endforeach
        </div>
        @if($showdata->showdetails=="1" && $showdata->detailsposition=="2")
                <div class="bg-white padding-responsive margin-large-top line-height showcontent">
                {!! $showdata->details!!}
                </div>
        @endif  
        <div class="text-center text-gray text-large loadmore" data-page="2" data-url="/pubajax/content/{{$showdata->nickname}}"></div>
        @else
        @include('sub.null')
        @endif
    <?php break;
    case "job":?>
        @if($jobs->count()!==0) 
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="1")
                <div class="margin-large-bottom padding-large-bottom line-height showcontent">
                {!! $showdata->details!!}
                </div>
            @endif
        @foreach($jobs as $job)
        <div class="margin-large-bottom padding-big-bottom">
            <div class="job-lists clearfix">
                <div class="border-bottom padding-bottom margin-bottom clearfix">
                    <div class="xm6 xb6 xl12 xs12">
                        <h3 class="bold text-main">职位：{{$job->jobname}}</h3>
                    </div>
                    <div class="xm6 xb6 xl12 xs12 text-right">
                        <span class="icon-user padding-right"> 招聘人数：{{$job->jobcount}}</span> <span class="icon-map-marker"> 工作地点：{{$job->jobplace}}</span>
                    </div>
                </div>
                <div class="x12 height-big">
                    {!!$job->details!!}                    
                </div>
            </div>
        </div>
        @endforeach
            @if($showdata->showdetails=="1" && $showdata->detailsposition=="2")
                <div class="bg-white padding-responsive margin-large-bottom line-height showcontent">
                {!! $showdata->details!!}
                </div>
            @endif
        @else
        @include('sub.null')
        @endif
    <?php default:
        # code...
    break;
}
?>
</div>
</div>
<?php 
if ($showdata->type =="article") {
switch($showdata->subtype) {
    case '3':
    case '4':
    ?>
@section('extrameta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop
<?php break;
}
} ?>

@section('seo')
<title>{{ $showdata->name}}_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $showdata->keywords}}" />
<meta name="description" content="{{ $showdata->description }}" />
@stop