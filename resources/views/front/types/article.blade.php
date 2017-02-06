@if($articles->count()>0)
<?php switch ($navigation->style) { case 'bytitle': ?>
<div class="article-header-list">
    <ul>
        @foreach ($articles as $article)
        <li><a href="/article-view-{{$article->id}}.html" title="{{$article->title}}" class="clearfix"><strong>{{$article->title}}</strong> <span>{{$article->published_at->diffForHumans()}}</span></a></li>
        @endforeach
    </ul>
</div>
<div>
{!! $articles->links() !!}
</div>
<?php break; case 'bydesc': ?>
<div class="article-desc-list">
    <ul>
        @foreach ($articles as $article)
        <li class="clearfix"><a href="/article-view-{{$article->id}}.html" title="{{$article->title}}" >
            <div class="article-desc-list-cover">
                <img src="{{$article->filepath}}" alt="{{$article->title}}">
            </div>
            <div class="article-desc-list-content">
                <div class="article-desc-list-title"><strong>{{$article->title}}</strong></div>
                <div class="article-desc-list-info">发布时间：{{$article->published_at->diffForHumans()}}</div>
                <div class="article-desc-list-desc">{{$article->description}}</div>
                <div class="article-desc-list-ft">
                    详情 <span class="icon-angle-double-right"></span>
                </div>
            </div>
        </a></li>
        @endforeach
    </ul>
</div>
<div>
{!! $articles->links() !!}
</div>
<?php break; case 'byhorizon' ?>
<div class="article-horizon line-big padding-big-top">
    @foreach ($articles as $article)
    <div class="xm4 xb4 xl6 xs6">
        <div class="index-tutorial-item inside-item">
        <a href="/article-view-{{$article->id}}.html" title="{{$article->title}}">
            <div class="index-tutorial-item-cover">
                <img src="{{$article->filepath}}" alt="{{$article->title}}">
            </div>
            <div class="index-tutorial-item-title">
                {{$article->title}}
            </div>
            <div class="index-tutorial-item-views clearfix">
                <span><i class="icon-eye"></i> {{$article->getview->views}}</span> <span><i class="icon-thumbs-up"></i> {{$article->getview->praise}}</span> <span class="float-right hidden-l hidden-s">{{$article->published_at->diffForHumans()}}</span>
            </div>
        </a>
        </div>
    </div>
    @endforeach
</div>
<?php break; case 'bycover' ?>
<div class="article-cover-list line-big padding-large-top">
    @foreach ($articles as $article)
    <div class="xm4 xb4 xl6 xs6">
        <a href="/article-view-{{$article->id}}.html" title="{{$article->title}}">
            <div class="article-cover-cover">
                <img src="{{$article->filepath}}" alt="{{$article->title}}">
                <div>
                    <p>{{$article->title}}</p>
                    <p class="clearfix"><span><i class="icon-eye"></i> {{$article->getview->views}}</span> <span class="padding-left"><i class="icon-thumbs-up"></i> {{$article->getview->praise}}</span> <span class="float-right hidden-l hidden-s">{{$article->published_at->diffForHumans()}}</span></p>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
<?php break; }?>
@else 
<div class="nodata">
    <p><span class="icon-unlink"></span></p>
    <p>暂无数据，可能是管理员偷懒了</p>
    <p><a href="/feedback/sent" class="button border-main icon-legal" title=""> 投诉管理员</a></p>
</div>
@endif