@extends('layouts.front.app')
@section('seo')
<title>{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $siteinfo->sitekeywords }}" />
<meta name="description" content="{{ $siteinfo->sitedescription }}" />
@stop
@section('content')
<div class="single-content">
<div class="container">
    <div class="line-big">
        
    
   <div class="xm9 xb9 xl12 xs12">
       <div class="feedbacklist">
            <div class="inside-main-title clearfix">
                <h4>提交留言</h4>
                <div class="hidden-s hidden-l"><a href="" title="" class="icon-home"> 首页</a> <span class="icon-angle-double-right"></span> <a href="/feedback" title="留言反馈">留言反馈</a> <span class="icon-angle-double-right"></span> 提交留言</div>
            </div>


            <form method="post" action="/feedback/sent">
            <div class="line-big padding-big-top">
            <div class="x7">
                <div class="form-group padding-large-bottom">
                    <div class="label"><label for="name">如何称呼您</label></div>
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
            </div>

            <div class="x12">
                <div class="form-group padding-large-bottom">
                    <div class="label"><label for="content">留言内容</label></div>
                    <div class="field"><textarea rows="5" class="input" id="content" name="content" placeholder="留言内容" data-validate="required:必填">{{ old('content') }}</textarea></div>
                    <span class="text-gray text-small"></span>
                    @if($errors->has('content'))
                        <div class="text-red icon-exclamation-triangle"> {{ $errors->first('content') }}</div>
                    @endif
                </div>

                <div class="form-group padding-bottom">
                    <div class="label"><label for="captcha">验证码</label></div>
                    <div class="field"><input type="text" class="input" id="captcha" name="captcha" data-validate="required:必填" placeholder="验证码" style="width:150px;" /></div>
                    @if($errors->has('captcha'))
                        <span class="text-red icon-exclamation-triangle"> {{$errors->first('captcha') }}</span>
                    @endif
                </div>
                <img src="{{ url('/captcha') }}" class="captcha margin-large-bottom" title="点击切换验证码"/>
                <p class="clearfix"><button type="submit" class="button bg-main icon-angle-double-right"> 提交留言</button><button type="button" class="button win-refresh float-right icon-refresh"> 重新载入</button></p>
            </div>
            </div>
            {!! csrf_field() !!}
            </form>
       </div>
   </div>
   <div class="xm3 xb3 xl12 xs12 view-aside">
       <div class="inside-aside-submenu">
            <div class="inside-aside-submenu-header">
                温馨提示
            </div>
            <div class="inside-aside-contact">
                <div class="inside-aside-contact-details">
                    <p>您好，我们会在24小时内回复您的留言。留言反馈由专人处理，对于投诉类的留言我们会严格保密。</p>
                </div>
            </div>
        </div>

        <div class="inside-aside-submenu">
            <div class="inside-aside-submenu-header">
                我的留言
            </div>
            <div class="inside-aside-contact">
                @if($myfeedbacks=="empty")
                <div class="inside-aside-contact-details">
                    <p class="aside-empty">您未提交过留言</p>
                </div>
                @else
                <ul>
                    @foreach($myfeedbacks as $myfeedback)
                    <li><a href="/feedback/my/{{$myfeedback->id}}" title=""><span class="icon-history text-gray"> </span>{{$myfeedback->published_at->diffForHumans()}} 的留言 @if($myfeedback->hasreply=="1")<span class="float-right text-yellow">已回复</span>@else <span class="float-right text-gray">暂无回复</span>@endif</a></li>
                    @endforeach
                </ul>
                @endif
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
<link rel="stylesheet" type="text/css" href="/css/slider.css">
@stop

@section('extrajs')
@stop