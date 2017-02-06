@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="/manage/common/menu/insert">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/common/menu" title=""> 分类管理</a></li>
            <li>新增分类</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/common/menu" class="button icon-mail-reply bg-black margin-right"> 返回</a>
			</div>
		</div>

		<div class="x12">
			<div class="table-responsive padding-large-bottom">
        <div class="form-group padding-large-bottom">
        <div class="label"><label for="showsnot">是否显示</label></div>
        <div class="button-group border-yellow radio">
            <label class="button @if(count(old('showsnot'))<=0 || old('showsnot')=="1")active @endif">
                <input name="showsnot" value="1" @if(count(old('showsnot'))<=0 || old('showsnot')=="1")checked="checked" @endif type="radio"> 显示
            </label>
            <label class="button @if(old('showsnot')=="0")active @endif">
                <input name="showsnot" value="0" @if(old('showsnot')=="0")checked="checked" @endif type="radio"> 隐藏
            </label>
        </div>
      </div>
      
        <div class="form-group padding-large-bottom">
            <div class="label"><label for="name">名称</label></div>
            <div class="field"><input type="text" class="input" id="name" name="name" data-validate="required:必填" value="@if(count(old('name'))>0){{ old('name') }}@endif" placeholder="名称" /></div>
            <div class="text-gray text-small"></div>
            @if($errors->has('name'))
            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="form-group padding-large-bottom">
            <div class="label"><label for="weihao">排序</label></div>
            <div class="field"><input type="number" class="input" id="weihao" name="weihao" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" value="@if(count(old('weihao'))>0){{ old('weihao')}}@endif" placeholder="排序" /></div>
            <div class="text-gray text-small padding-little-top">* 数字类型：只能填写整数，数值越大排名越靠前，如：10000</div>
            @if($errors->has('weihao'))
            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('weihao') }}</div>
          @endif
        </div>

        <div class="form-group padding-large-bottom">
            <div class="label"><label for="published_at">发布时间</label></div>
            <div class="field"><input type="text" class="input" id="published_at" name="published_at" data-validate="required:必填" value="@if(count(old('published_at'))>0){{ old('published_at') }}@else{{ date("Y-m-d H:i:s") }}@endif" placeholder="发布时间" /></div>
            <div class="text-gray text-small padding-little-top">相当于定时功能，文章会在此时间进行发布</div>
            @if($errors->has('published_at'))
            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('published_at') }}</div>
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