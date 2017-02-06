@extends('layouts.site')
@section('seo')
<title>{{ strip_tags($view->content) }}_常见问题_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{$view->keywords }}" />
<meta name="description" content="{{ $view->description }}" />
@stop

@section('main')
<div class="inside_banner">
    <img src="/public/imgs/inside-support.jpg">
</div>
<div class="container margin-big-top">
    <div class="line-big padding-bottom">
        <div class="xm3 xs12 hidden-l hidden-s site-aside">
            <div class="bg-white margin-bottom">
                <div class="site-aside-header">服务与支持</div>
                @include('other.support.aside')
            </div>
            @include('sub.aside')
        </div>
        <div class="xm9 xs12 xl12">
            <div class="bg-white">
            <div class="main-header padding-responsive-leftright margin-big-bottom">
                <div class="border-bottom border-main clearfix">    
                    <div class="float-left"><h1 class="text-main"> 常见问题<span class="text-gray"> COMMON</span></h1></div>
                    <div class="float-right text-right hidden-l hidden-s"><a href="/support/common/{{$common->id}}" title="" class="icon-mail-reply"> 返回</a></div>
                </div>
            </div>
           <div class="padding-responsive-leftright padding-responsive-bottom">
                <div class="text-big height-big">
                    {!!$view->content!!}
                </div>

                <div class="padding-large-top margin-large-bottom">
                    <blockquote>
                    <p class="bold text-main icon-mail-forward "> 管理员回复：</p>
                    {!!$view->reply!!}
                    </blockquote>
                </div>

                <div class="padding-large-top padding-bottom">
                    <div class="text-center text-black text-big padding-small-bottom">该解决方案靠谱吗？</div>
                    <div class="text-gray text-center">（已有 <span class="total">{{$view->y+$view->n}}</span> 人投票）</div>
                    <div class="padding-big-top text-center feedchoose">
                        <button type="button" class="icon-thumbs-o-down button border-gray margin-right common-feed" data-type="n"> 不靠谱</button>
                        <button type="button" class="icon-thumbs-o-up button border-gray common-feed" data-type="y"> 靠谱</button>
                    </div>

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

@section('extracss')

@stop

@section('extrajs')
<script type="text/javascript">
    $(function(){
        $(".common-feed").click(function(){
            token = $('meta[name="csrf-token"]').attr('content');
            feedtype = $(this).attr('data-type');
            total = $('.total').html();
            $.post('/pubajax/common/{{$view->id}}', {"_token":token,"feedtype":feedtype},
            function(msg) {
                switch(msg.errmsg){
                    case "succeed":
                    $('.total').html(total*1+1);
                    alerts('反馈成功',3000);
                    break;
                    case "has":
                    if (msg.feedtype=="y") {
                        alerts('反馈失败：因为您已经反馈过了，您选择了“靠谱”。',3000);
                    } else {
                        alerts('反馈失败：因为您已经反馈过了，您选择了“不靠谱”。',3000);
                    }
                    break;                        
                }
            },"json");
        })
    })
</script>
@stop