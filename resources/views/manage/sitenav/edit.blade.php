@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="/manage/sitenav/edit/{{ $editdata->id }}">
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav">导航管理</a></li>
				    <li>编辑导航</li>
				</ul>
			</div>
			<div class="x2 text-right">
				<a href ="/manage/sitenav" class="button icon-mail-reply bg-black"> 取消返回</a>
			</div>
		</div>

		<div class="x12">
			@if(count(old('type'))>0)
			    <?php $typevalue = old('type');?>
			@else
			    <?php $typevalue = $editdata->type;?>
			@endif
			<div class="form-group padding-large-bottom">
				<div class="label"><label for="type_id">请选择页面形式</label></div>
				<div class="button-group border-yellow radio pagestylechoose">
					@foreach($menutypes as $key => $value)
					<label class="button @if($key == $typevalue) active @endif"> 
					<input name="type" value="{{$key}}" data-type="{{$key}}" @if($key == $typevalue) checked="checked" @endif type="radio"> {{$value}} </label>
					@endforeach
				</div>
			</div>

			@if(count(old('style'))>0)
			    <?php $stylevalue = old('style');?>
			@else
			    <?php $stylevalue = $editdata->style;?>
			@endif
			<div class="form-group padding-large-bottom choosearticlestyle" style="width:200px;">
				<label class="label"><strong>请选择样式</strong></label>
			    <select name="style" class="input appendhtmls">
			    	<option value="default">默认样式</option>
			    </select>
			</div>

			@if(count(old('showsnot'))>0)
				<?php $showsnotvalue = old('showsnot');?>
			@else
				<?php $showsnotvalue = $editdata->showsnot;?>
			@endif
			<div class="form-group padding-large-bottom">
				<div class="label"><label for="showsnot">立即显示</label></div>
				<div class="button-group border-yellow radio">
					<label class="button @if($showsnotvalue == "1")active @endif">
					    <input name="showsnot" value="1" @if($showsnotvalue == "1")checked="checked" @endif type="radio"> 立即显示
					</label>
					<label class="button  @if($showsnotvalue == "0")active @endif">
					    <input name="showsnot" value="0" @if($showsnotvalue == "0")checked="checked" @endif type="radio"> 暂时隐藏
					</label>
				</div>
				<div class="text-gray text-small padding-little-top"></div>
			</div>

			@if(count(old('layout'))>0)
			    <?php $layoutvalue = old('layout');?>
			@else
			    <?php $layoutvalue = $editdata->layout;?>
			@endif
			<div class="form-group padding-large-bottom">
				<div class="label"><label for="layout">侧边栏显示位置</label></div>
				<div class="button-group border-yellow radio">
				    <label class="button @if($layoutvalue==1)active @endif">
				        <input name="layout" value="1" @if($layoutvalue==1)checked="checked" @endif type="radio"> 显示在左侧
				    </label>
				    <label class="button @if($layoutvalue==3)active @endif">
				        <input name="layout" value="3" @if($layoutvalue==3)checked="checked" @endif type="radio"> 不显示
				    </label>
				    <label class="button @if($layoutvalue==2)active @endif">
				        <input name="layout" value="2" @if($layoutvalue==2)checked="checked" @endif type="radio"> 显示在右侧
				    </label>
				</div>
			</div>

			<div class="from-group padding-large-bottom">
				<div class="label"><label for="layout">侧边栏选择</label></div>
				<div class="button-group border-yellow ">
					<select name="sectionid" class="input ">
						@foreach($sections as $section)
						<option value="{{$section->id}}" @if($section->id == $editdata->section->id) selected="selected" @endif>{{$section->title}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="x7">
				@if(count(old('name'))>0)
				    <?php $namevalue = old('name');?>
				@else
				    <?php $namevalue = $editdata->name;?>
				@endif
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="name">导航名称</label></div>
				    <div class="field"><input type="text" class="input" id="name" name="name" data-validate="required:必填,cnen:只能为中文或英文" placeholder="导航名称" value="{{$namevalue}}" /></div>
				    <span class="text-gray text-small">* 如：公司信息，产品展示</span>
				    @if($errors->has('name'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('name') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="navpic">导航图片</label></div>
				    <div class="field"><input type="text" class="input" id="navpic" name="navpic"  placeholder="导航图片" value="{{$editdata->navpic}}" onclick="BrowseServer( 'Images:/', 'navpic' );"></div>
				    <span class="text-gray text-small">选填:导航子菜单图片</span>
				    @if($errors->has('navpic'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('navpic') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="navinfo">导航说明</label></div>
				    <div class="field"><input type="text" class="input" id="navinfo" name="navinfo"  placeholder="导航说明" value="{{$editdata->navinfo}}" /></div>
				    <span class="text-gray text-small">* 如：【定制设计】省钱、放心、品质保证！</span>
				    @if($errors->has('navinfo'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('navinfo') }}</div>
					@endif
				</div>

				@if(count(old('nickname'))>0)
				    <?php $nicknamevalue = old('nickname');?>
				@else
				    <?php $nicknamevalue = $editdata->nickname;?>
				@endif
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="nickname">url参数</label></div>
				    <div class="field"><input type="text" class="input" id="nickname" name="nickname" data-validate="required:必填" placeholder="url参数" value="{{ $nicknamevalue }}" /></div>
				    <span class="text-gray text-small">* 用于url别名，请勿填写符号和空格，多个英文请使用-隔开，如：ziye 或 ziye-conpany</span>
				    @if($errors->has('nickname'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('nickname') }}</div>
					@endif
				</div>

				@if(count(old('articount'))>0)
				    <?php $articountvalue = old('articount');?>
				@else
				    <?php $articountvalue = $editdata->articount;?>
				@endif
				<div class="form-group padding-large-bottom articountbox @if($typevalue=="mainmenu" || $typevalue==="menudetails" || $typevalue=="alonepage" ) hide @endif" >
				    <div class="label"><label for="articount">每页显示的数量</label></div>
				    <div class="field"><input type="number" class="input" id="articount" name="articount" data-validate="required:必填" value="{{$articountvalue}}" placeholder="每页显示的数量" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('articount'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('articount') }}</div>
				    @endif
				</div>

				@if(count(old('weihao'))>0)
				    <?php $weihaovalue = old('weihao');?>
				@else
				    <?php $weihaovalue = $editdata->weihao;?>
				@endif

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="weihao">排序</label></div>
				    <div class="field"><input type="text" class="input" id="weihao" name="weihao" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" placeholder="排序" value="{{$weihaovalue}}"/></div>
				    <span class="text-gray text-small">* 数字类型：只能填写整数，数值越大排名越靠前，如：10000</span>
				    @if($errors->has('weihao'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('weihao') }}</div>
					@endif
				</div>

				@if(count(old('keywords'))>0)
				    <?php $keywordsvalue = old('keywords');?>
				@else
				    <?php $keywordsvalue = $editdata->keywords;?>
				@endif
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="keywords">关键词</label></div>
				    <div class="field"><input type="text" class="input" id="keywords" name="keywords" data-validate="required:必填,keywords:错误：只能为中文、英文、数字，用英文小写逗号隔开" placeholder="关键词1,关键词2,关键词3" value="{{ $keywordsvalue }}" /></div>
				    <span class="text-gray text-small">用于SEO优化，请填写与本导航相关的关键词，多个关键词请使用<strong>英文小写逗号</strong>隔开，一般不超过100个字符，如：紫业 或 紫业,策划,设计</span>
				    @if($errors->has('keywords'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('keywords') }}</div>
					@endif
				</div>

				@if(count(old('description'))>0)
				    <?php $descriptionvalue = old('description');?>
				@else
				    <?php $descriptionvalue = $editdata->description;?>
				@endif
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="description">页面描述</label></div>
				    <div class="field"><textarea rows="5" class="input" id="description" name="description" placeholder="不超过200个字符，尽量包含关键词" data-validate="required:必填">{{ $descriptionvalue }}</textarea></div>
				    <span class="text-gray text-small">用于SEO优化，请填写与本页面的描述，一般不超过200个字符</span>
				    @if($errors->has('description'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('description') }}</div>
					@endif
				</div>

				@if(count(old('banner'))>0)
				    <?php $bannervalue = old('banner');?>
				@else
				    <?php $bannervalue = $editdata->banner;?>
				@endif
				<div class="form-group padding-large-bottom clearfix menubanner" @if($typevalue=="mainmenu") style="display: none;" @endif>
				    <div class="label"><label for="banner">Banner 图</label></div>
				    <div class="field x9"><input type="text" class="input" id="xFilePath" name="banner" data-validate="required:必填,img:文件格式不支持" placeholder="Banner" value="{{ $bannervalue }}" /></div>
				    <div class="x2 x1-move text-right"><button type="button" class="button bg-yellow" onclick="BrowseServer( 'Images:/', 'xFilePath' );">选择图片</button></div>
				    <span class="text-gray text-small"></span>
				    @if($errors->has('banner'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('banner') }}</div>
					@endif
				</div>
			</div>
		</div>

		<div class="x12">
			@if(count(old('showdetails'))>0)
			    <?php $showdetailsvalue = old('showdetails');?>
			@else
			    <?php $showdetailsvalue = $editdata->showdetails;?>
			@endif
			<div class="form-group padding-large-bottom showdetailschoose @if($typevalue=="mainmenu" || $typevalue=="menudetails" || $typevalue=="alonepage") hide @endif">
				<div class="label"><label for="showdetails">是否显示详情</label></div>
				<div class="button-group border-yellow radio">
				    <label class="button @if($showdetailsvalue=="1")active @endif">
				        <input name="showdetails" value="1" @if($showdetailsvalue=="1") checked="checked" @endif type="radio"> 显示
				    </label>
				    <label class="button @if($showdetailsvalue=="0")active @endif">
				        <input name="showdetails" value="0" @if($showdetailsvalue=="0") checked="checked" @endif type="radio"> 不显示
				    </label>
				</div>
				<div class="text-gray text-small padding-little-top"></div>
			</div>

			@if(count(old('detailsposition'))>0)
			    <?php $detailspositionvalue = old('detailsposition');?>
			@else
			    <?php $detailspositionvalue = $editdata->detailsposition;?>
			@endif
			{{--$typevalue--}}
			<div class="form-group padding-large-bottom detailspositionchoose @if($typevalue=="mainmenu" || $typevalue=="menudetails" || $typevalue=="alonepage") hide @endif @if($typevalue!=="menudetails" && $typevalue!=="alonepage" && $showdetailsvalue=="0") hide @endif">
				<div class="label"><label for="detailsposition">详情显示的位置</label></div>
				<div class="button-group border-yellow radio">
				    <label class="button @if($detailspositionvalue=="1")active @endif">
				        <input name="detailsposition" value="1" @if($detailspositionvalue=="1")checked="checked" @endif type="radio"> 正文上方
				    </label>
				    <label class="button @if($detailspositionvalue=="2")active @endif">
				        <input name="detailsposition" value="2" @if($detailspositionvalue=="2")checked="checked" @endif type="radio"> 正文下方
				    </label>
				</div>
				<div class="text-gray text-small padding-little-top"></div>
			</div>

			@if(count(old('details'))>0)
			    <?php $detailsvalue = old('details');?>
			@else
			    <?php $detailsvalue = $editdata->details;?>
			@endif
			<div class="form-group detailsedit @if($typevalue=="mainmenu") hide @endif @if($typevalue!=="menudetails" && $typevalue!=="alonepage" && $showdetailsvalue=="0") hide @endif">
			    <div class="label"><label for="details">内容</label></div>
			    <div class="field">
			      <textarea name="details" cols="50" class="input ckeditor" id="editor1">{{ $detailsvalue }}</textarea>
			    </div>
			    @if($errors->has('details'))
					<div class="text-red icon-exclamation-triangle"> {{ $errors->first('details') }}</div>
				@endif
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
	return false;
}
function hidedetails(){
	$(".showdetailschoose").hide();
	$(".detailspositionchoose").hide();
	$(".detailsedit").hide();
}
function showdetails(){
	$(".showdetailschoose").show();
	showsnot = $(".showdetailschoose div input:checked").val();
	if (showsnot==1) {
		$(".detailspositionchoose").show();
		$(".detailsedit").show();
	} else {
		$(".detailspositionchoose").hide();
		$(".detailsedit").hide();
	};
}

function getstyle(thisvalue,style){
	token = $('input[name="_token"]').val();
	$.ajax({
		url: '/manage/checkstyle',
		type: 'post',
		data: {"_token": token,"type":thisvalue},
		success: function(msg){
			$(".appendhtmls").html("");
			if (msg!=="empty") {
				appendhtmls = "";
				for(var o in msg) {
					appendhtmls+= '<option value="'+o+'">'+msg[o]+'</option>';
				}
			} else {
				appendhtmls= '<option value="default">默认样式</option>';
			}
			$(".appendhtmls").append(appendhtmls);
			if (style !== 'none') {
				$(".appendhtmls option[value="+style+"]").attr("selected", true);
			}
		},
		error: function (){
			alert("链接失败，请稍后再试");
		}
	})
	
}

function hidebanner() {
	$(".menubanner").hide();
}

$(function(){
	$('.showdetailschoose input').click(function(){
		if ($(this).val()==1) {
			$(".detailspositionchoose").show();
			$(".detailsedit").show();
		} else {
			$(".detailspositionchoose").hide();
			$(".detailsedit").hide();
		};
	});
	$('.pagestylechoose input').click(function(){
		thisvalue = $(this).val();
		thistype = $(this).attr("data-type");
		$(".menubanner").show();
		$(".articountbox").hide();
		switch(thistype){
			case "mainmenu":
				hidedetails();
				hidebanner();
			break
			case "menudetails":
				hidedetails();
				$(".detailsedit").show();
			break;
			case "alonepage":
				hidedetails();
				$(".detailsedit").show();
			break;
			case "article":
				showdetails();
				$(".articountbox").show();
			break;
			case "recruit":
				showdetails();
				$(".articountbox").show();
			break;
			case "case":
				showdetails();
				$(".articountbox").show();
			break;
			case "team":
				showdetails();
				$(".articountbox").show();
			break;
			case "album":
				showdetails();
				$(".articountbox").show();
			break;
		}
		getstyle(thisvalue,'none');
	})

	getstyle("{{$typevalue}}",'{{$stylevalue}}');

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