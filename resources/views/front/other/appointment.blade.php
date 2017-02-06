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
                <h4>在线预约</h4>
                <div class="hidden-s hidden-l"><a href="" title="" class="icon-home"> 首页</a> <span class="icon-angle-double-right"></span> <a href="/appointment/sent" title="在线预约">在线预约</a> </div>
            </div>


            <form method="post" action="/appointment/make">
            <div class="line-big padding-big-top">
            <div class="x7">
                <div class="form-group padding-large-bottom">
                    <div class="label"><label for="service">装修服务</label></div>
                    <div class="field">
                        <select name="service" class="input">
                            @foreach($yuyuetypes as $yuyuetype)
                            <option value="{{$yuyuetype->name}}">{{$yuyuetype->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-gray text-small"></div>
                    @if($errors->has('service'))
                    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('service') }}</div>
                    @endif
                </div>

                <div class="form-group padding-large-bottom">
                    <div class="label"><label for="name">如何称呼您</label></div>
                    <div class="field"><input type="text" class="input" id="name" name="name" data-validate="required:必填" value="@if(count(old('name'))>0){{ old('name') }}@endif" placeholder="请填写您的称呼" /></div>
                    <div class="text-gray text-small"></div>
                    @if($errors->has('name'))
                    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="form-group padding-large-bottom">
                    <div class="label"><label for="phone">如何联系您</label></div>
                    <div class="field"><input type="text" class="input" id="phone" name="phone" data-validate="required:必填,mobile:手机号码格式不正确" value="@if(count(old('phone'))>0){{ old('phone') }}@endif" placeholder="请填写您的手机号码" /></div>
                    <div class="text-gray text-small"></div>
                    @if($errors->has('phone'))
                    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('phone') }}</div>
                    @endif
                </div>

                <div class="form-group padding-large-bottom">
                    <div class="label"><label for="xiaoqu">小区名称</label></div>
                    <div class="field"><input type="text" class="input" id="xiaoqu" name="xiaoqu" data-validate="required:必填" value="@if(count(old('xiaoqu'))>0){{ old('xiaoqu') }}@endif" placeholder="请填写您的小区名称" /></div>
                    <div class="text-gray text-small"></div>
                    @if($errors->has('xiaoqu'))
                    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('xiaoqu') }}</div>
                    @endif
                </div>

                <div class="form-group padding-large-bottom">
                    <div class="label"><label for="mianji">建筑面积</label></div>
                    <div class="field"><input type="text" class="input" id="mianji" name="mianji" data-validate="required:必填" value="@if(count(old('mianji'))>0){{ old('mianji') }}@endif" placeholder="请填写您的房屋建筑面积" /></div>
                    <div class="text-gray text-small"></div>
                    @if($errors->has('mianji'))
                    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('mianji') }}</div>
                    @endif
                </div>

            </div>

            <div class="x12">
                <div class="form-group padding-large-bottom">
                    <div class="label"><label for="content">其他要求</label></div>
                    <div class="field"><textarea rows="5" class="input" id="content" name="content" placeholder="其他要求" data-validate="required:必填">{{ old('content') }}</textarea></div>
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
                <p class="clearfix"><button type="submit" class="button bg-main icon-angle-double-right"> 提交预约</button><button type="button" class="button win-refresh float-right icon-refresh"> 重新载入</button></p>
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
                    <p>您好，我们会尽快安排专员与您去的联系，请保持您的手机畅通。</p>
                </div>
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