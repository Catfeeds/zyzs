@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
	<form method="POST" action="/manage/job/update/{{ $job->id }}">
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav">导航管理</a></li>
				    <li><a href="/manage/sitenav/jobs/{{ $navigation->id }}">{{ $navigation->name }}</a></li>
				    <li>职位管理</li>
				</ul>
			</div>
			<div class="x2 text-right">
				<a href="/manage/sitenav/jobs/{{ $navigation->id }}" class="button icon-mail-reply bg-black"> 返回</a>
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-large-bottom">
				<h1><span class="icon-edit"> </span>正在编辑职位 “<span class="text-main">{{ $job->jobname }}</span>”</h1>
				</div>
			</div>

			<div class="x12">
				@if(count(old('showsnot'))>0)
				<?php $showsnotvalue = old('showsnot');?>
				@else
				<?php $showsnotvalue = $job->showsnot;?>
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
				    <div class="label"><label for="jobname">职位名称</label></div>
				    <div class="field"><input type="text" class="input" id="jobname" name="jobname" data-validate="required:必填" value="@if(count(old('jobname'))>0){{ old('jobname') }}@else{{$job->jobname}}@endif" placeholder="职位名称" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('jobname'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('jobname') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="weihao">排序</label></div>
				    <div class="field"><input type="number" class="input" id="weihao" name="weihao" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" value="@if(count(old('weihao'))>0){{ old('weihao')}}@else{{ $job->weihao }}@endif" placeholder="排序" /></div>
				    <div class="text-gray text-small padding-little-top">* 数字类型：只能填写整数，数值越大排名越靠前，如：10000</div>
				    @if($errors->has('weihao'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('weihao') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="jobcount">招聘人数</label></div>
				    <div class="field"><input type="number" class="input" id="jobcount" name="jobcount" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" value="@if(count(old('jobcount'))>0){{ old('jobcount') }}@else{{$job->jobcount}}@endif" placeholder="访问量" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('jobcount'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('jobcount') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="jobplace">工作地点</label></div>
				    <div class="field"><input type="text" class="input" id="jobplace" name="jobplace" data-validate="required:必填" value="@if(count(old('jobplace'))>0){{ old('jobplace') }}@else{{$job->jobplace}}@endif" placeholder="工作地点" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('jobplace'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('jobplace') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="published_at">发布时间</label></div>
				    <div class="field"><input type="text" class="input" id="published_at" name="published_at" data-validate="required:必填" value="@if(count(old('published_at'))>0){{ old('published_at') }}@else{{$job->published_at}}@endif" placeholder="发布时间" /></div>
				    <div class="text-gray text-small padding-little-top">相当于定时功能，职位会在此时间进行发布</div>
				    @if($errors->has('published_at'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('published_at') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
					<div class="label"><label for="keywords">关键词</label></div>
					<div class="field"><input type="text" class="input" id="keywords" name="keywords" data-validate="required:必填,keywords:错误：只能为中文、英文、数字，用英文小写逗号隔开,length#<=100:长度必须小于100个字符" placeholder="关键词1,关键词2,关键词3" value="@if(count(old('keywords'))>0){{ old('keywords') }}@else{{$job->keywords}}@endif" /></div>
					<span class="text-gray text-small">用于SEO优化，请填写与本导航相关的关键词，多个关键词请使用<strong>英文小写逗号</strong>隔开，一般不超过100个字符，如：紫业 或 紫业,策划,设计</span>
					@if($errors->has('keywords'))
					<div class="text-red icon-exclamation-triangle"> {{ $errors->first('keywords') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
					<div class="label"><label for="description">页面描述</label></div>
					<div class="field"><textarea rows="5" class="input" id="description" name="description" placeholder="不超过200个字符，尽量包含关键词" data-validate="required:必填,length#<=800:长度必须小于200个字符">@if(count(old('description'))>0){{ old('description') }}@else{{$job->description}}@endif</textarea></div>
					<span class="text-gray text-small">用于SEO优化，请填写与本页面的描述，一般不超过200个字符，如：紫业装饰设计公司是一家xxxxxx</span>
					@if($errors->has('description'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('description') }}</div>
					@endif
				</div>
			</div>

			<div class="x12">
				<div class="form-group detailsedit">
				    <div class="label"><label for="details">详细内容</label></div>
				    <div class="field">
				      <textarea name="details" cols="50" class="input ckeditor" id="editor1">@if(count(old('details'))>0){!! old('details')!!}@else{!!$job->details!!}@endif</textarea>
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