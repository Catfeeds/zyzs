<div class="layout site-header hidden-s hidden-l clearfix">
    <div class="container">
        <div class="float-left left-tel site-location">
            <p><span class="icon-map-marker text-yellow"></span> <span class="location-city">获取中</span> <span class="padding-left text-main pointer change-location">切换 <i class="icon-caret-square-o-down"></i></span></p>
            <div class="text-center">
                <span>上海</span> <span>苏州</span> <span>杭州</span> <span>南京</span>
            </div>
        </div>
        <div class="float-right text-right">
            <ul class="clearfix"><li class="showtooltip"><a title=""><span class="icon-mobile" style="font-size:16px;"> </span>手机访问</a><ul class="animated fadeIn afast"><li><img src="/imgs/1.png" style="width:150px;height:150px;"><p>扫一扫，开始访问</p></li></ul></li><li class="showtooltip"><a title=""><span class="icon-wechat"> </span>微信</a><ul class="animated fadeIn afast"><li><img src="{{ $siteinfo->sitewxqcrode }}" style="width:150px;height:150px;"><p>扫一扫，关注我们</p></li></ul></li><li class="showtooltip"><a href="{{ $siteinfo->weibourl }}" title=""><span class="icon-weibo"> </span>微博</a><ul class="animated fadeIn afast"><li><img src="{{ $siteinfo->weiboqcrode }}" style="width:150px;height:150px;"><p>扫一扫，关注我们</p><p><a style="display: block;width:90px;margin: 0 auto;" href="{{ $siteinfo->weibourl }}" class="button button-little bg-yellow" target="_blank">进入 <i class="icon-external-link"></i></a></p></li></ul></li><li class="win-favorite"><a href="" title=""><span class="icon-star"> </span>收藏</a></li><li><a href="/feedback" title=""><span class="icon-pencil"> </span>留言</a></li></ul>
        </div>
    </div>
</div>

<div class="container hidden-s hidden-l clearfix header-brand">
    <form method="post" action="/search">
    <div class="line">
        <div class="x6">
            <img src="/imgs/logo.jpg" class="logo">
        </div>
        <div class="x6 text-right">
            <div class="search-box clearfix">
                <button type="submit"></button><input type="text" name="keyword" placeholder="北欧风格">
            </div>
        </div>
    </div>
    {!! csrf_field() !!}
    </form>
</div>

<div class="navcontent">
<div class="layout sitenav">
    <div class="container">
        <div class="hidden-b hidden-m line clearfix">
            <div class="x7 nav-home">
                <a href="/" title="" class=""><img src="/imgs/logo.jpg" style="height:45px;"></a>
            </div>
            {{-- <div class="x7 text-right nav-search">
            <form method="post" action="/search">
                <div class="search-content clearfix">
                   <input type="text" id="mkeywords" name="keyword" placeholder="关键词" /><span class="search-button icon-search"></span>
                </div>
            {!! csrf_field() !!}
            </form>
            </div> --}}
            <div class="x3 text-right">
                <span class="sitenav-location icon-map-marker header-m-bars"></span>
            </div>
            <div class="x2 text-right">
                <span class="sitenav-bars icon-bars header-m-bars"></span>
            </div>
        </div>
        <div class="choose-location animated fadeInLeft clearfix">
            <div>
                <span>上海</span>
            </div>
            <div>
                <span>苏州</span>
            </div>
            <div>
                <span>杭州</span>
            </div>
            <div>
                <span>南京</span>
            </div>
        </div>
        <ul class="menu-ul">
            <li class="hidden-b hidden-m text-right padding-right"><a class="close-nav text-gray text-small"><span class="icon-times"> close</span></a></li>
            <li><a href="/" title=""><span class="icon-home"> 首页</span></a></li>
            <li class="hidden-m hidden-b open-server"><a title=""><span class="icon-comments"> 在线客服</span></a></li>
            <li class="hidden-m hidden-b"><a href="http://p.qiao.baidu.com/cps2/chatIndex?reqParam=%7B%22from%22%3A0%2C%22sid%22%3A%22-100%22%2C%22tid%22%3A%22-1%22%2C%22ttype%22%3A1%2C%22siteId%22%3A%222187273%22%2C%22userId%22%3A%225801086%22%7D" title="" target="_blank"><span class="icon-comment-o"> 装修顾问</span></a></li>
            <?php $countnav=1;?>
            @foreach($sitenavs as $key)
            <li><a href="/{{$key->nickname}}" title="">{{$key->name}} @if($key->children != '[]')<span class="hidden-b hidden-m icon-angle-right float-right"></span>@endif</a>
                @if($key->children != '[]')
                <ul @if($countnav>3) class="left-subnav" @endif>
                    {{-- <div class="navpic hidden-s hidden-l"><img src="{{$key->navpic}}" alt=""></div> --}}
                    @foreach($key->children()->where('showsnot','1')->get() as $child)
                    <li><a href="/{{$key->nickname}}/{{$child->nickname}}" title="">{{$child->name}}</a></li>
                    @endforeach
                    {{-- <p class="navinfo hidden-s hidden-l">{{$key->navinfo}}</p> --}}
                </ul>
                @endif
            </li>
            <?php $countnav++;?>
            @endforeach
        </ul>
    </div>
</div>
</div>