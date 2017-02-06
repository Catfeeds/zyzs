@extends('manage.site')

@section('main')
<form method="post">
<div class="container bg-white margin-large-top">
	<div class="padding-large">

		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav">导航管理</a></li>
				    <li><a href="/manage/teams/{{$member->type}}/edit">{{$member->team->title}}</a></li>
				    <li>{{$member->name}}</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/teams/{{$member->type}}/edit" class="button icon-mail-reply bg-black"> 返回</a>
				
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-little-bottom"><h1><span class="icon-edit"> </span>团队成员管理 - {{$member->name}}</h1></div>
			</div>
			
		</div>
		<form action="" method="post">
		<div class="x6">
			<div class="form-group padding-large-bottom">
				<label class="label">姓名</label>
				<input type="text" name="name" value="{{$member->name}}" class="input">
			</div>
			
			<div class="form-group padding-large-bottom">
				<label class="label">职务</label>
				<input type="text" name="zhiwu" value="{{$member->zhiwu}}"  class="input ">
			</div>

			<div class="form-group padding-large-bottom">
				<label>设计费用</label>
				<input type="text" name="fee" value="{{$member->fee}}" class="input ">
			</div>

			<div class="form-group padding-large-bottom">
				<label>设计理念</label>
				<input type="text" name="linian" value="{{$member->linian}}" class="input ">
			</div>

			<div class="form-group padding-large-bottom">
				<label>设计资质</label>
				<input type="text" name="zizhi" value="{{$member->zizhi}}" class="input ">
			</div>

			<div class="form-group padding-large-bottom">
				<label>擅长领域</label>
				<input type="text" name="shanchang" value="{{$member->shanchang}}" class="input " required="required">
			</div>

			<div class="form-group padding-large-bottom">
				<label>主要作品</label>
				<input type="text" name="zuopin" value="{{$member->zuopin}}" class="input ">
			</div>

			<div class="form-group padding-large-bottom">
				<label class="label">照片</label>
				<input type="text" id="photo" name="photo" value="{{$member->photo}}" class="input"  onclick="BrowseServer( 'Images:/', 'photo' );">
			</div>
			<input type="hidden" name="type" value="{{$member->team->id}}">
				
			
			<div class="x7"><br><br></div>
			<p>&nbsp;{{csrf_field()}}</p>
		</div>

		<div class="x4 x2-move">
			@if(count(old('indexshow'))>0)
				<?php $indexshowvalue = old('indexshow');?>
			@else
				<?php $indexshowvalue = $member->indexshow;?>
			@endif	
			<div class="form-group padding-large-bottom">
				<div class="label"><label for="indexshow">是否在首页显示</label></div>
				<div class="button-group border-yellow radio">
				    <label class="button @if($indexshowvalue=="0")active @endif">
				        <input name="indexshow" value="0" @if($indexshowvalue=="0" || old('indexshow')=="0")checked="checked" @endif type="radio"> 不显示
				    </label>
				    <label class="button @if($indexshowvalue=="1")active @endif">
				        <input name="indexshow" value="1" @if($indexshowvalue=="1")checked="checked" @endif type="radio"> 显示
				    </label>
				</div>
				<div class="text-gray text-small padding-little-top"></div>
			</div>

			<div class="form-group padding-large-bottom">
				<label class="label">排序</label>
				<input type="number" name="order" value="{{$member->order}}"  class="input ">
			</div>

			<div class="form-group padding-large-bottom">
					<div class="label"><label for="keywords">关键词</label></div>
					<div class="field"><input type="text" class="input" id="keywords" name="keywords" data-validate="required:必填,keywords:错误：只能为中文、英文、数字，用英文小写逗号隔开,length#<=100:长度必须小于100个字符" placeholder="关键词1,关键词2,关键词3" value="{{$member->keywords}}" /></div>
					<span class="text-gray text-small">用于SEO优化，请填写与本导航相关的关键词，多个关键词请使用<strong>英文小写逗号</strong>隔开，一般不超过100个字符，如：紫业 或 紫业,策划,设计</span>
					@if($errors->has('keywords'))
					<div class="text-red icon-exclamation-triangle"> {{ $errors->first('keywords') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
					<div class="label"><label for="description">页面描述</label></div>
					<div class="field"><textarea rows="5" class="input" id="description" name="description" placeholder="不超过200个字符，尽量包含关键词" data-validate="required:必填">{{$member->description}}</textarea></div>
					<span class="text-gray text-small">用于SEO优化，请填写与本页面的描述，一般不超过200个字符，如：紫业装饰设计公司是一家xxxxxx</span>
					@if($errors->has('description'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('description') }}</div>
					@endif
				</div>
		</div>

		<div class="x12 margin-large-bottom padding-large-bottom border-top padding-large-top margin-large-top border-dashed">
				<div class="x4 x2-move text-center"><button class="button bg-gray button-big win-refresh icon-refresh" type="button"> 重新载入</button></div>
				<div class="x4 text-center"><button class="button bg-green button-big icon-save" type="submit"> 提交数据</button></div>
			</div>
		</form>
	</div>
</div>
</form>
@stop

@section('extrajs')
<script type="text/javascript" src="/manage/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/manage/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	//这个是选图片
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
	return false;
}
	//这个是编辑器
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
<script type="text/javascript">
$(function(){
	$(".select-section").hide();
	$(".select-section-button").click(function(){
		$(".select-section").toggle();
	})
})
</script>
@stop