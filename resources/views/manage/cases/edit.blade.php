@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
	<form method="POST" >
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav">导航管理</a></li>
				    <li><a href="/manage/case/{{$navigation->id}}">{{$navigation->name}}</a></li>
				    <li>{{$case->title}}</li>
				</ul>
			</div>
			<div class="x2 text-right">
				<a href="/manage/case/{{$navigation->id}}" class="button icon-mail-reply bg-black"> 返回</a>
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-large-bottom">
				<h1><span class="icon-edit"> </span>正在修改 “{{$case->title}}” 案例</h1>
				</div>
			</div>
		</div>

		<div class="line-big">
			

			<div class="x6">
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="title">案例标题</label></div>
				    <div class="field"><input type="text" class="input" id="title" name="title" data-validate="required:必填" value="{{$case->title}}" placeholder="案例标题" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('title'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('title') }}</div>
					@endif
				</div>

				

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="star">案例评级</label></div>
				    <div class="field">
				    <select class="input" name="star">
				    	<option value="1" @if($case->star=="1") selected="selected" @endif>一星</option>
				    	<option value="2" @if($case->star=="2") selected="selected" @endif>二星</option>
				    	<option value="3" @if($case->star=="3") selected="selected" @endif>三星</option>
				    	<option value="4" @if($case->star=="4") selected="selected" @endif>四星</option>
				    	<option value="5" @if($case->star=="5") selected="selected" @endif>五星</option>
				    </select>
				    </div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('star'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('star') }}</div>
					@endif
				</div>


				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="order">排序</label></div>
				    <div class="field"><input type="number" class="input" id="order" name="order" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" value="{{$case->order}}" placeholder="排序" /></div>
				    <div class="text-gray text-small padding-little-top">* 数字类型：只能填写整数，数值越大排名越靠前，如：10000</div>
				    @if($errors->has('order'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('order') }}</div>
					@endif
				</div>
				<input type="hidden" name="nav_id" value="{{$navigation->id}}">
				

				<div class="form-group padding-large-bottom">
					<div class="label">楼盘名称</div>
					<div class="field">
						<input type="text" name="subtitle" class="input input-small" value="{{$case->subtitle}}">
					</div>
				</div>

				<!-- <div class="form-group padding-large-bottom">
					<div class="label">首页覆盖图</div>
					<div class="field">
						<input type="text" id="indexcover" name="indexcover" class="input input-small" onclick="BrowseServer( 'Images:/', 'indexcover' );">
					</div>
				</div> -->
				<input type="hidden" name="indexcover">

				<div class="form-group padding-large-bottom">
					<div class="label"><label>户型</label></div>
					<div class="field">
						<input class="input" name="huxing" value="{{$case->huxing}}"></input>
					</div>
					<span class="text-gray text-small">如：别墅、三房两厅、小户型等</span>
				</div>

				<div class="form-group padding-large-bottom">
					<div class="label">面积</div>
					<div class="field">
						<input type="text" name="mianji"  class="input" value="{{$case->mianji}}">
					</div>
					<span class="text-gray text-small">案例面积：填写示例 100㎡</span>
				</div>

				<!-- <div class="form-group padding-large-bottom">
					<div class="label">风格</div>
					<div class="field">
						<input type="text" name="fengge" value="{{$case->fengge}}" class="input">
					</div>
					<span class="text-gray text-small">案例风格：填写示例 地中海</span>
					<p><a href="/manage/fengge" class="button button-little bg-main">风格管理</a></p>
				</div> -->
				<?php
				if(empty($case->getfengge->id))
				{
					$casefengge = 0;
				}else{
					$casefengge = $case->getfengge->id;
				}
				?>
				<div class="form-group padding-large-bottom">
					<div class="label">风格</div>
					<div class="field">
						<select class="input" name="fengge_id">
							@foreach($fengge as $key)
							<option value="{{$key->id}}" @if($casefengge == $key->id) selected="selected" @endif>{{$key->title}}</option>
							@endforeach
						</select>
					</div>
					<span class="text-gray text-small">案例风格：填写示例 地中海</span>
					<p><a href="/manage/fengge" target="_blank" class="button button-little bg-main">风格管理</a></p>
				</div>

				<div class="form-group padding-large-bottom">
					<div class="label">类型</div>
					<div class="field">
						<input type="text" name="leixing" value="{{$case->leixing}}" class="input">
					</div>
					<span class="text-gray text-small">案例类型：填写示例 公寓装修</span>
				</div>

			</div>
			<div class="x4 x2-move">
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="photo">请选择案例封面图</label></div>
				    <div class="field"><input type="text" class="input" id="photo" name="photo" data-validate="required:必填" value="{{$case->photo}}" placeholder="" onclick="BrowseServer( 'Images:/', 'photo' );" /></div>
				    <div class="text-gray text-small"></div>
				    <!-- 这里的Images是选择图片， photo是返回的id -->
				    @if($errors->has('photo'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('photo') }}</div>
					@endif
				</div>
				<?php
				if(empty($case->getmembers[0]->name))
					$casemember = 0;
				else
					$casemember = $case->getmembers[0]->id;
				?>
				<div class="form-group padding-large-bottom">
					<div class="label">
						请选择设计师
					</div>
					<div class="field">
						<select name="shejishi" class="input">
						@foreach($members as $member)
							<option value="{{$member->id}}" @if($casemember == $member->id) selected="selected" @endif> {{$member->name}}</option>
						@endforeach
						</select>
					</div>
				</div>

				<div class="form-group padding-large-bottom">
					<div class="label"><label for="indexshow">是否在显示在首页</label></div>
					<div class="button-group border-yellow radio">
					    <label class="button @if($case->indexshow=="0")active @endif">
					        <input name="indexshow" value="0" @if($case->indexshow=="0")checked="checked" @endif type="radio"> 不显示
					    </label>
					    <label class="button @if($case->indexshow=="1")active @endif">
					        <input name="indexshow" value="1" @if($case->indexshow=="1")checked="checked" @endif type="radio"> 显示
					    </label>
					</div>
					<div class="text-gray text-small padding-little-top"></div>
				</div>

				<div class="form-group padding-large-bottom">
					<div class="label"><label for="keywords">关键词</label></div>
					<div class="field"><input type="text" class="input" id="keywords" name="keywords" data-validate="required:必填,keywords:错误：只能为中文、英文、数字，用英文小写逗号隔开" placeholder="关键词1,关键词2,关键词3" value="{{ $case->keywords }}" /></div>
					<span class="text-gray text-small">用于SEO优化，请填写与本导航相关的关键词，多个关键词请使用<strong>英文小写逗号</strong>隔开，一般不超过100个字符，如：紫业 或 紫业,策划,设计</span>
					@if($errors->has('keywords'))
					<div class="text-red icon-exclamation-triangle"> {{ $errors->first('keywords') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
					<div class="label"><label for="description">页面描述</label></div>
					<div class="field"><textarea rows="5" class="input" id="description" name="description" placeholder="不超过200个字符，尽量包含关键词" data-validate="required:必填">{{ $case->description }}</textarea></div>
					<span class="text-gray text-small">用于SEO优化，请填写与本页面的描述，一般不超过200个字符，如：紫业装饰设计公司是一家xxxxxx</span>
					@if($errors->has('description'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('description') }}</div>
					@endif
				</div>
				
			</div>

			<div class="x12">
				<div class="form-group padding-large-bottom">
					<div class="label">详情</div>
					<div class="field">
						<textarea id="editor1" class="input" name="details">{{$case->details}}</textarea>
					</div>
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
@stop