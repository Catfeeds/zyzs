@extends('manage.base')

@section('main')
<div>
<div class="container">
    <div class="margin-large-top margin-large-bottom clearfix">
        <div class="xb4 xm4 xb4-move xm4-move xs12 xl12 padding-large border bg-white margin-large-top">
        <form method="post" action="{{ url('/login') }}">
        <div class="form-group padding-large-bottom">
            <div class="label"><label for="email">登录账号</label></div>
            <div class="field"><input type="email" class="input" id="email" name="email" data-validate="required:必填" value="@if(count(old('email'))>0){{ old('email') }}@endif" placeholder="登录账号" /></div>
            <div class="text-gray text-small"></div>
            @if($errors->has('email'))
            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="form-group padding-large-bottom">
            <div class="label"><label for="password">密码</label></div>
            <div class="field"><input type="password" class="input" id="password" name="password" data-validate="required:必填" value="@if(count(old('password'))>0){{ old('password') }}@endif" placeholder="密码" /></div>
            <div class="text-gray text-small"></div>
            @if($errors->has('password'))
            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('password') }}</div>
            @endif
        </div>

        <div class="form-group padding-large-bottom">
            <div class="field"><input type="checkbox" id="remember" name="remember" /><label for="remember"> 记住登录状态</label></div>
        </div>

        <div >
            <div class="x6 text-left"><button class="button bg-gray button-big win-refresh icon-refresh" type="button"> 重新载入</button></div>
            <div class="x6 text-right"><button class="button bg-green button-big icon-save" type="submit"> 登录后台</button></div>
        </div>


        {!! csrf_field() !!}
        </form>
        </div>
    </div>
    
</div>
</div>
@endsection