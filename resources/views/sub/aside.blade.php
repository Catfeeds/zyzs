@if(!empty($asidenav) && $asidenav!=="empty")
	<div class="bg-white margin-bottom">
		<div class="site-aside-header">{{$parentnav->name}}</div>
		<ul class="aside-nav">
			@foreach($asidenav as $asidenavs)
			<li class="text-center"><a href="/{{$parentnav->nickname}}/{{$asidenavs->nickname}}" title="{{$asidenavs->name}}">{{$asidenavs->name}}</a></li>
			@endforeach
		</ul>
	</div>
@endif
	
@if($sitearticle!=="empty")
	<div class="bg-white margin-bottom">
	<div class="site-aside-header">近期动态</div>
		<ul class="aside-nav news-nav">
			@foreach($sitearticle as $sitearticle)
			<li><a href="/articles-view-{{$sitearticle->id}}.html" title="{{$sitearticle->title}}">{{$sitearticle->title}}</a></li>
			@endforeach
		</ul>
	</div>
@endif

	<div>
		<img src="/public/imgs/aside.jpg" alt="上下拉电蚊纱窗" class="img-responsive">		
	</div>