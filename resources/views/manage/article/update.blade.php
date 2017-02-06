@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
	<form method="POST" action="/manage/article/update/{{ $editdata->id }}">
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav">导航管理</a></li>
				    <li><a href="/manage/sitenav/article/{{ $parentid->id }}">{{ $parentid->name }}</a></li>
				    <li>文章管理</li>
				</ul>
			</div>
			<div class="x2 text-right">
				<a href="/manage/sitenav/article/{{ $parentid->id }}" class="button icon-mail-reply bg-black"> 返回</a>
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-large-bottom">
				<h1><span class="icon-edit"> </span>正在编辑文章 “<span class="text-main">{{ $editdata->title }}</span>”</h1>
				</div>
			</div>

			<div class="x12">
				@if(count(old('showsnot'))>0)
				<?php $showsnotvalue = old('showsnot');?>
				@else
				<?php $showsnotvalue = $editdata->showsnot;?>
				@endif
				<div class="form-group padding-large-bottom">
					<div class="label"><label for="showsnot">是否显示</label></div>
					<div class="button-group border-yellow radio">
					    <label class="button @if($showsnotvalue=="1")active @endif">
					        <input name="showsnot" value="1" @if($showsnotvalue=="1")checked="checked" @endif type="radio"> 显示
					    </label>
					    <label class="button @if($showsnotvalue=="0")active @endif">
					        <input name="showsnot" value="0" @if($showsnotvalue=="0")checked="checked" @endif type="radio"> 隐藏
					    </label>
					</div>
				</div>
			</div>

			<div class="x7">
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="title">文章标题</label></div>
				    <div class="field"><input type="text" class="input" id="title" name="title" data-validate="required:必填" value="@if(count(old('title'))>0){{ old('title') }}@else{{$editdata->title}}@endif" placeholder="文章标题" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('title'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('title') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="zz">文章作者</label></div>
				    <div class="field"><input type="text" class="input" id="zz" name="zz" data-validate="required:必填" value="@if(count(old('zz'))>0){{ old('zz') }}@else{{$editdata->zz}}@endif" placeholder="文章作者" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('zz'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('zz') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="weihao">排序</label></div>
				    <div class="field"><input type="number" class="input" id="weihao" name="weihao" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" value="@if(count(old('weihao'))>0){{ old('weihao')}}@else{{ $editdata->weihao }}@endif" placeholder="排序" /></div>
				    <div class="text-gray text-small padding-little-top">* 数字类型：只能填写整数，数值越大排名越靠前，如：10000</div>
				    @if($errors->has('weihao'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('weihao') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="views">访问量</label></div>
				    <div class="field"><input type="number" class="input" id="views" name="views" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" value="@if(count(old('views'))>0){{ old('views') }}@else{{$editdata->views}}@endif" placeholder="访问量" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('views'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('views') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="praise">点赞人数</label></div>
				    <div class="field"><input type="number" class="input" id="praise" name="praise" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" value="@if(count(old('praise'))>0){{ old('praise') }}@else{{$editdata->praise}}@endif" placeholder="点赞人数" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('praise'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('praise') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="published_at">发布时间</label></div>
				    <div class="field"><input type="text" class="input" id="published_at" name="published_at" data-validate="required:必填" value="@if(count(old('published_at'))>0){{ old('published_at') }}@else{{$editdata->published_at}}@endif" placeholder="发布时间" /></div>
				    <div class="text-gray text-small padding-little-top">相当于定时功能，文章会在此时间进行发布</div>
				    @if($errors->has('published_at'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('published_at') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
					<div class="label"><label for="keywords">关键词</label></div>
					<div class="field"><input type="text" class="input" id="keywords" name="keywords" data-validate="required:必填,keywords:错误：只能为中文、英文、数字，用英文小写逗号隔开" placeholder="关键词1,关键词2,关键词3" value="@if(count(old('keywords'))>0){{ old('keywords') }}@else{{$editdata->keywords}}@endif" /></div>
					<span class="text-gray text-small">用于SEO优化，请填写与本导航相关的关键词，多个关键词请使用<strong>英文小写逗号</strong>隔开，一般不超过100个字符，如：紫业 或 紫业,策划,设计</span>
					@if($errors->has('keywords'))
					<div class="text-red icon-exclamation-triangle"> {{ $errors->first('keywords') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
					<div class="label"><label for="description">页面描述</label></div>
					<div class="field"><textarea rows="5" class="input" id="description" name="description" placeholder="不超过200个字符，尽量包含关键词" data-validate="required:必填,length#<=800:长度必须小于200个字符">@if(count(old('description'))>0){{ old('description') }}@else{{$editdata->description}}@endif</textarea></div>
					<span class="text-gray text-small">用于SEO优化，请填写与本页面的描述，一般不超过200个字符，如：紫业装饰设计公司是一家xxxxxx</span>
					@if($errors->has('description'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('description') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom @if($parentid->pagestyle=="2" || $parentid->pagestyle=="3") hide @endif">
				    <div class="label"><label for="filepath">预览图</label></div>
				    <div class="field clearfix"><div class="x9"><input type="filepath" class="input" id="xFilePath" name="filepath"  placeholder="预览图" value="@if(count(old('filepath'))>0){{ old('filepath') }}@else{{$editdata->filepath}}@endif" /></div><div class="x2 x1-move text-right"><button type="button" class="button bg-yellow" onclick="BrowseServer( 'Images:/', 'xFilePath' );">选择图片</button></div></div>
				    <span class="text-gray text-small"></span>
				    @if($errors->has('filepath'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('filepath') }}</div>
					@endif
				</div>
				
			</div>

			<div class="x12">
				<div class="form-group detailsedit">
				    <div class="label"><label for="details">详细内容</label></div>
				    <div class="field">
				      <textarea name="details" cols="50" class="input ckeditor" id="editor1">@if(count(old('details'))>0){!! old('details')!!}@else{!!$editdata->details!!}@endif</textarea>
				    </div>
				    @if($errors->has('details'))
						<div class="text-red icon-exclamation-triangle"> {{$errors->first('details') }}</div>
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
<script type="text/javascript" src="/manage/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/manage/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
function BrowseServer( startupPath, functionData ){
	var finder = new CKFinder();
	finder.basePath = '/manage';
	finder.startupPath = startupPath;
	finder.selectActionFunction = SetFileField;
	finder.selectActionData = functionData;
	finder.selectThumbnailActionFunction = ShowThumbnails;
	finder.popup();
	}

	function SetFileField( fileUrl, data ){
	document.getElementById( data["selectActionData"] ).value = fileUrl;
	document.getElementById( data["selectActionData"] ).focus();
	document.getElementById( data["selectActionData"] ).blur();
	var postfix = data["fileUrl"].match(/^(.*)(\.)(.{1,8})$/)[3].toLowerCase();
	}

	function ShowThumbnails( fileUrl, data ){
	var sFileName = this.getSelectedFile().name;
	document.getElementById( 'thumbnails' ).innerHTML +=
			'<div class="thumb">' +
				'<img src="' + fileUrl + '" />' +
				'<div class="caption">' +
					'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
				'</div>' +
			'</div>';

	document.getElementById( 'preview' ).style.display = "";
	// It is not required to return any value.
	// When false is returned, CKFinder will not close automatically.
	return false;
}
function hidecomment(){
	$(".commentedit").hide();
}
function showcomment(){
	$(".commentedit").show();
}
function hidedetails(){
	$(".detailsedit").hide();
}
function showdetails(){
	$(".detailsedit").show();
}
$(function(){
	$('#published_at').datetimepicker({
	lang:'ch',
	format:'Y-m-d H:i:00',
	formatDate:'Y-m-d'
	});	
})
	CKEDITOR.replace( 'editor1', { 
	filebrowserBrowseUrl: '/manage/ckfinder/ckfinder.html', 
	filebrowserImageBrowseUrl: '/manage/ckfinder/ckfinder.html?Type=Images',
	filebrowserFlashBrowseUrl: '/manage/ckfinder/ckfinder.html?Type=Flash',
	filebrowserUploadUrl: '/manage/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	filebrowserImageUploadUrl: '/manage/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	filebrowserFlashUploadUrl: '/manage/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	allowedContent: true
	}); 
</script>
@stop