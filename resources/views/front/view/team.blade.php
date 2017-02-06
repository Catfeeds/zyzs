@extends('layouts.front.app')
@section('seo')
<title>{{$member->name}}_{{$navigation->name}}<?php if (!empty($navigation->parent->name)) {
    echo "_".$navigation->parent->name;
} ?>_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{$member->keywords}}" />
<meta name="description" content="{{$member->description}}" />
@stop
@section('content')
<div class="view-content">
    <div class="container">
        <div class="line-big">
            <div class="xm9 xb9 xl12 xs12">
                <div class="team-view">
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

                    <div class="team-view-details clearfix">
                        <div class="team-view-left">
                            <img src="{{$member->photo}}" alt="{{$member->name}}">
                            <div>
                                <button class="button bg-sub icon-pencil-square-o dialogs hidden-s hidden-l" data-toggle="click" data-target="#feedbackdialog" data-mask="1" data-width="500px" type="button"> 留言咨询</button>
                                <button class="button bg-sub icon-pencil-square-o dialogs hidden-b hidden-m" data-toggle="click" data-target="#feedbackdialog" data-mask="1" data-width="90%" type="button"> 留言咨询</button>
                            </div>
                        </div>
                        <div class="team-view-right">
                            <h4>{{$member->zhiwu}}：{{$member->name}}</h4>
                            <p class="clearfix"><strong>设计费用：</strong><span>{{$member->fee}}</span></p>
                            <p class="clearfix"><strong>设计理念：</strong><span>{{$member->linian}}</span></p>
                            <p class="clearfix"><strong>设计资质：</strong><span>{{$member->zizhi}}</span></p>
                            <p class="clearfix"><strong>擅长风格：</strong><span>{{$member->introduce}}</span></p>
                            <p class="clearfix"><strong>主要作品：</strong><span>{{$member->zuopin}}</span></p>
                        </div>
                    </div>

                    <div class="team-case">
                        相关作品
{{--                         <p><span class="active">全部</span>@foreach($styles as $style)<span>{{$style->title}}</span>@endforeach</p> --}}
                    </div>
                    <div class="inside-cases line-big padding-big-top clearfix">
                        @foreach($member->getcases as $case)
                        <div class="xb4 xm4 xl6 xs6">
                            <div class="inside-case">
                                <div class="inside-case-cover">
                                    <a href="/case-view-{{$case->id}}.html" title=""><img src="{{$case->photo}}" alt=""></a>
                                    @if($case->getstyles->count()>0)<a href="" title=""><span>{{$case->getstyles[0]->title}}</span></a>@endif
                                </div>
                                <p><a href="/case-view-{{$case->id}}.html" title="">{{$case->title}} {{$case->huxing}}</a></p>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <div class="xm3 xb3 xl12 xs12 view-aside">
                <div class="inside-aside-submenu">
                    <div class="inside-aside-submenu-header">
                        预约装修
                    </div>
                    <div class="view-aside-from">
                    <form method="post" action="/appointment/sent/fast">
                    <div class="form-group margin-big-bottom">
                        <div class="field"><input type="text" class="input" id="name" name="name" data-validate="required:必填" value="@if(count(old('name'))>0){{ old('name') }}@endif" placeholder="请填写您的称呼" /></div>
                        <div class="text-gray text-small"></div>
                        @if($errors->has('name'))
                        <div class="text-red icon-exclamation-triangle"> {{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="form-group margin-big-bottom">
                        <div class="field" style="overflow:hidden"><input type="text" class="input" id="phone" name="phone" data-validate="required:必填" value="@if(count(old('phone'))>0){{ old('phone') }}@endif" placeholder="请填写您的手机电话" /></div>
                        <div class="text-gray text-small"></div>
                        @if($errors->has('phone'))
                        <div class="text-red icon-exclamation-triangle"> {{ $errors->first('phone') }}</div>
                        @endif
                    </div>

                    <button type="submit" class="button layout bg-main icon-clock-o"> 立即预约</button>
                    {!! csrf_field() !!}
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div id="feedbackdialog">
    <div class="dialog">
        <div class="dialog-head">
            <span class="close rotate-hover"></span><strong>请填写留言</strong>
        </div>
        <form method="post" action="/feedback/team/sent">        
        <div class="dialog-body">
            <div class="form-group padding-large-bottom">
                <div class="label"><label for="name">您的称呼</label></div>
                <div class="field"><input type="text" class="input" id="name" name="name" data-validate="required:必填" value="@if(count(old('name'))>0){{ old('name') }}@endif" placeholder="您的称呼" /></div>
                <div class="text-gray text-small"></div>
                @if($errors->has('name'))
                <div class="text-red icon-exclamation-triangle"> {{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group padding-large-bottom">
                <div class="label"><label for="contact">联系方式</label></div>
                <div class="field"><input type="text" class="input" id="contact" name="contact" data-validate="required:必填" value="@if(count(old('contact'))>0){{ old('contact') }}@endif" placeholder="联系方式" /></div>
                <div class="text-gray text-small"></div>
                @if($errors->has('contact'))
                <div class="text-red icon-exclamation-triangle"> {{ $errors->first('contact') }}</div>
                @endif
            </div>
            <div class="form-group">
                <div class="label"><label for="content">留言内容</label></div>
                <div class="field"><textarea rows="3" class="input" id="content" name="content" placeholder="留言内容" data-validate="required:必填">{{ old('content') }}</textarea></div>
                <span class="text-gray text-small"></span>
                @if($errors->has('content'))
                    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('content') }}</div>
                @endif
            </div>
            <input type="hidden" name="teamid" value="">


        </div>
        <div class="dialog-foot">
            <button class="button dialog-close" type="button">
                取消</button>
            <button class="button bg-main" type="submit">
                确认</button>
        </div>
        {!! csrf_field() !!}
        </form>
    </div>
</div>
@stop

@section('extrameta')

@stop

@section('extracss')
@stop
@section('extrajs')
<script type="text/javascript">
$(function(){
    $(".inside-cases").imagesLoaded( function() {
        $(".inside-cases").masonry({ columnWidth: 0});
        $(".inside-cases").masonry("reload");
    }); 
})

</script>
@stop