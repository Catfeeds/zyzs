<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="/css/core.css">
<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
<div class="login-contaniner">
    <div class="login-content">
        
        <div class="login-form">
            <div class="login-header">
            客服登录
        </div>
            <form method="post" action="/server/login">
            <div class="form-group padding-large-bottom">
                <div class="field"><input type="text" class="input" id="username" name="username" data-validate="required:必填" value="@if(count(old('username'))>0){{ old('username') }}@endif" placeholder="用户名" /></div>
                <div class="text-gray text-small"></div>
                @if($errors->has('username'))
                <div class="text-red icon-exclamation-triangle"> {{ $errors->first('username') }}</div>
                @endif
            </div>
            <div class="form-group padding-large-bottom">
                <div class="field"><input type="password" class="input" id="password" name="password" data-validate="required:必填" value="@if(count(old('password'))>0){{ old('password') }}@endif" placeholder="密码" /></div>
                <div class="text-gray text-small"></div>
                @if($errors->has('password'))
                <div class="text-red icon-exclamation-triangle"> {{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="form-group padding-large-bottom">
                <div class="field"><input type="text" class="input" id="captcha" name="captcha" data-validate="required:必填" placeholder="验证码" /></div>
                @if($errors->has('captcha'))
                    <span class="text-red icon-exclamation-triangle"> {{$errors->first('captcha') }}</span>
                @endif
            </div>
            <img src="{{ url('/captcha') }}" class="captcha margin-large-bottom" title="点击切换验证码"/>
            
            <button type="submit" class="button bg-main layout">登录</button>
            {!! csrf_field() !!}
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/core.js"></script>
<script type="text/javascript">
    $(function(){
        $(".captcha").click(function(){
            $(this).attr('src','/captcha?.s='+Math.random());
        })
    })
</script>
</body>
</html>