<div class="hidden-l hidden-s bg-white">
<div class="container">
    <div class="x6">
        <a href="/" title="伊碧仕电蚊纱窗"><img class="sitelogo" src="/public/imgs/logo.png" alt="Ebliss"></a>
    </div>
    <div class="x6 text-right">
        <div class="x12 site-right-list"><a href="/" title="">微信</a> <a href="/" title="">微博</a> <a href="/joinin" title="">招商</a></div>
        <div class="x12">
            <div class="x7-move x5">
            <form method="post" action="/search">
            <div class="form-group">
            <div class="field">
            <div class="input-group">
                <input type="text" class="input" name="keywords" size="50" placeholder="关键词" /><span class="addbtn">
            <button type="submit" class="button bg-main"><span class="icon-search"></span></button></span>
            </div>
        </div>
    </div>
            {!! csrf_field() !!}
            </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="sitemenu">
    <div class="container">
    <div class="sitemenu-aside hidden-l hidden-s">
        
    </div>
    <div class="mmenu hidden-m hidden-b"><span class="icon-navicon win-shownav"></span></div>
    <div class="returnhome hidden-m hidden-b"><a href="/" class="home"><span class="icon-home"> </span></a></div>
    <div class="sitename hidden-m hidden-b">{{$siteinfo->sitename}}</div>
    <ul>
    <li><a href="/" title="电蚊纱窗">伊碧仕首页</a></li>
    @foreach($sitenav as $sitenavs)
    <?php $parentnav = $sitenavs['parentnav']; ?>
        <li><a href="/{{ $parentnav->nickname }}" title="{{$parentnav->name}}">{{$parentnav->name}}</a>
            @if($sitenavs['subnav']!=="empty")
                <ul>
                    @foreach($sitenavs['subnav'] as $subnavs)
                    <li><a href="/{{ $parentnav->nickname }}/{{$subnavs->nickname}}" title="{{ $subnavs->name }}">{{ $subnavs->name }}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
    <li><a href="/support" title="">服务支持</a>
        <ul>
            <li><a href="/support/dealers" title="">销售网络</a></li>
            <li><a href="/support/common" title="">常见问题</a></li>
            <li><a href="/support/feedback" title="">在线反馈</a></li>
        </ul>
    </li>
    <li><a href="/contactus" title="">联系我们</a></li>
    </ul>
    </div>
</div>