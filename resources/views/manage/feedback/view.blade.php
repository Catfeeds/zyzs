@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large clearfix">
		<form method="POST" action="/manage/feedback/view/{{$feedback->id}}">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>留言管理</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/feedback/list" class="button icon-mail-reply bg-black margin-right"> 返回</a>
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
			   	<strong>留言人称呼：</strong> {{$feedback->name}}
			</div>

			<div class="form-group padding-large-bottom">
			   	<strong>联系方式：</strong> {{$feedback->contact}}
			</div>

			<div class="form-group padding-large-bottom">
			   	<strong>留言时间：</strong> {{$feedback->published_at->diffForHumans()}}
			</div>

			<div class="form-group padding-large-bottom">
			   	<strong>留言地址：</strong> {{$feedback->ip}}
			</div>

			@if(count(old('content'))>0)
				<?php $contentvalue = old('content');?>
			@else
				<?php $contentvalue = $feedback->content;?>
			@endif	

			<div class="form-group padding-large-bottom">
			    <div class="label"><label for="content">留言内容：</label></div>
			    <div class="field"><textarea rows="5" class="input" id="content" name="content" placeholder="留言内容" data-validate="required:必填">{{$contentvalue}}</textarea></div>
			    <span class="text-gray text-small"></span>
			    @if($errors->has('content'))
					<div class="text-red icon-exclamation-triangle"> {{ $errors->first('content') }}</div>
				@endif
			</div>

			@if(count(old('showsnot'))>0)
				<?php $showsnotvalue = old('showsnot');?>
			@else
				<?php $showsnotvalue = $feedback->showsnot;?>
			@endif	

			<div class="form-group padding-large-bottom">
				<div class="label"><label for="showsnot">是否在前台展示</label></div>
				<div class="button-group border-yellow radio">
				    <label class="button @if($showsnotvalue=="0")active @endif">
				        <input name="showsnot" value="0" @if($showsnotvalue=="0")checked="checked" @endif type="radio">不展示
				    </label>
				    <label class="button @if($showsnotvalue=="1")active @endif">
				        <input name="showsnot" value="1" @if($showsnotvalue=="1")checked="checked" @endif type="radio"> 展示
				    </label>
				</div>
				<div class="text-gray text-small padding-little-top"></div>
			</div>

			@if(count(old('reply'))>0)
				<?php $replyvalue = old('reply');?>
			@else
				<?php $replyvalue = $feedback->reply;?>
			@endif	

			<div class="x12">
				<div class="form-group detailsedit">
				    <div class="label"><label for="details">回复内容</label></div>
				    <div class="field">
				      <textarea name="reply" cols="50" class="input ckeditor" id="editor1">{{$replyvalue}}</textarea>
				    </div>
				    @if($errors->has('reply'))
						<div class="text-red icon-exclamation-triangle"> {{$errors->first('reply') }}</div>
					@endif
				</div>
			</div>
			
		</div>

		<div class="x12 margin-large-bottom padding-large-bottom border-top padding-large-top margin-large-top border-dashed">
			<div class="x4 x2-move text-center"><button class="button bg-gray button-big win-refresh icon-refresh" type="button"> 重新载入</button></div>
			<div class="x4 text-center"><button class="button bg-green button-big icon-save" type="submit"> 提交数据</button></div>
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