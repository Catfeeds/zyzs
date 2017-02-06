@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
	<form method="POST" action="/manage/change/password">
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>修改密码</li>
				</ul>
			</div>
			<div class="x2 text-right">
				<a href="/manage/main" class="button icon-mail-reply bg-black"> 返回</a>
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-large-bottom">
				<h1><span class="icon-edit"> </span>正在修改登录密码</h1>
				</div>
			</div>

			<div class="x7">
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="password">请输入新密码</label></div>
				    <div class="field"><input type="password" class="input" id="password" name="password" data-validate="required:必填" value="@if(count(old('password'))>0){{ old('password') }}@endif" placeholder="请输入新密码" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('password'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('password') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="password_confirmation">请确认新密码</label></div>
				    <div class="field"><input type="password" class="input" id="password_confirmation" name="password_confirmation" data-validate="required:必填" value="@if(count(old('password_confirmation'))>0){{ old('password_confirmation') }}@endif" placeholder="请确认新密码" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('password_confirmation'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('password_confirmation') }}</div>
				    @endif
				</div>


			</div>

			<div class="x12 margin-large-bottom padding-large-bottom border-top padding-large-top margin-large-top border-dashed">
				<div class="x4 x2-move text-center"><button class="button bg-gray button-big win-refresh icon-refresh" type="button"> 重新载入</button></div>
				<div class="x4 text-center"><button class="button bg-green button-big icon-save" type="submit"> 提交数据</button></div>
			</div>
		</div>

	{!! csrf_field() !!}
	</form>
	</div>
</div>
@stop

@section('extrajs')
@stop