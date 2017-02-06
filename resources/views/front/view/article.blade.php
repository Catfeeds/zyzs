@extends('layouts.front.app')
@section('seo')
<title>{{$article->title}}_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{$article->keywords}}" />
<meta name="description" content="{{$article->description}}" />
@stop
@section('content')
<div class="view-content">
    <div class="container">
        <div class="line-big">
            <div class="xm9 xb9 xl12 xs12">
                <div class="article-view">
                    <div class="inside-bread-nav hidden-s hidden-l clearfix">
                        <div class="inside-bread-nav-left">
                            <a href="/" title="" class="icon-home"> 首页</a> <span class="icon-angle-double-right"></span> 
                            @if(!empty($navigation->parent->name))
                            <a href="/{{$navigation->parent->nickname}}" title="/{{$navigation->parent->nickname}}">{{$navigation->parent->name}}</a> <span class="icon-angle-double-right"></span> <span class="inside-main-bread">
                            @endif
                            <a href="/{{$navigation->parent->nickname}}/{{$navigation->nickname}}" title="">{{$navigation->name}}</a></span> <span class="icon-angle-double-right"></span> 
                            <span class="inside-main-bread">正文</span>
                        </div>
                        <div class="inside-bread-nav-right">
                            <a href="/{{$navigation->parent->nickname}}/{{$navigation->nickname}}" title="" class="icon-angle-double-left"> 返回</a>
                        </div>
                    </div>
                    <div class="article-view-content">
                        <div class="article-view-title">
                            <h1>{{$article->title}}</h1>
                        </div>
                        <div class="article-view-info clearfix">
                            <div class="article-left-div"><span>撰文</span> <strong>{{$article->zz}}</strong> {{$article->published_at}}</div>
                            <div class="article-right-div hidden-s hidden-l"><span class="icon-eye"> {{$article->getview->views}}</span> <span class="icon-thumbs-o-up"> {{$article->getview->praise}}</span></div>
                        </div>
                        <div class="article-view-desc">
                            {!!$article->details!!}
                           
                        </div>
                        <div class="">
                            <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_mshare" data-cmd="mshare" title="分享到一键分享"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_youdao" data-cmd="youdao" title="分享到有道云笔记"></a><a href="#" class="bds_copy" data-cmd="copy" title="分享到复制网址"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                        </div>
                        <div class="article-view-copyright">
                            版权声明：本文系紫业装饰原创内容，如需转载请注明出处，并保留完整链接，谢谢！
                        </div>
                        @if($haspraise == 0)
                        <div class="article-view-praise">
                            <div>
                                <span class="icon-thumbs-o-up"></span>
                            </div>
                            <p class="zan">{{$article->getview->praise}}人赞过</p>
                        </div>
                        @else
                        <div class="article-view-praise praised">
                            <div>
                                <span >Thanks</span>
                            </div>
                            <p class="zan">{{$article->getview->praise}}人赞过</p>
                        </div>
                        @endif
                        <div class="article-view-footer hidden-b hidden-m clearfix">
                            <span class="footer-left-span">阅读 {{$article->getview->views}}</span> <span class="footer-right-span icon-angle-double-left"><a href="/" title=""> 返回</a></span>
                        </div>
                    </div>
                    
               </div>
            </div>

            <div class="xm3 xb3 xl12 xs12 view-aside">
                <div class="inside-aside-submenu">
                    <div class="inside-aside-submenu-header">
                        相关文章
                    </div>
                    <div class="inside-aside-contact">
                        <ul>
                        @foreach($xiangguan as $key)
                            <li><a href="/article-view-{{$key->id}}.html" title=""><i class="icon-angle-double-right"> </i> {{$key->title}} </a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>

                <div class="inside-aside-submenu">
                    <div class="inside-aside-submenu-header">
                        关注我们
                    </div>
                    <div class="inside-aside-wechat">
                        <img src="/imgs/1.png" alt="">
                        <h4>紫业国际设计</h4>
                        <p>扫一扫，关注我们</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('extrameta')

@stop

@section('extracss')


@section('extrajs')
@if($haspraise == 0)
<script>
function loadpraised(){
    $(".article-view-praise").find('span').removeClass('icon-thumbs-o-up').addClass('icon-spinner');
}
function parised(){
    $(".article-view-praise").addClass('praised');
    $(".article-view-praise").find('span').removeClass('icon-spinner').html('Thanks');
}
    $(function(){
        $(".icon-thumbs-o-up").click(function(){
            loadpraised();
            $.ajax({
                url:'/api/articles/{{$article->id}}/zan',
                type:'get',
                dataType:'text',
                success:function(msg)
                {
                    if(msg!==0){
                        $('.zan').text(msg+"人赞过");
                        parised();
                    }
                }
            })


        })
    })
</script>
@endif
@stop