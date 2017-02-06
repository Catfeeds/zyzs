@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="/manage/sitenav/insert">
		<input type="hidden" name="type_id" value="1">
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav">导航管理</a></li>
				    <li>新增导航</li>
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
			    <?php $typevalue = "mainmenu";?>
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

			<div class="form-group padding-large-bottom choosearticlestyle" style="width:200px;">
				<label class="label"><strong>请选择样式</strong></label>
			    <select name="style" class="input appendhtmls">
			    	<option value="default">默认样式</option>
			    </select>
			</div>


			
					<div class="form-group padding-large-bottom choosearticlestyle" style="width:300px;">
						<label class="label">导航图片</label>

						<input type="text" id="navpic" name="navpic" class="input input-small" onclick="BrowseServer( 'Images:/', 'navpic' );">
					</div>

					<div class="form-group padding-large-bottom choosearticlestyle" style="width:300px;">
						<label class="label">导航说明</label>

						<input type="text" name="navinfo" class="input input-small">
					</div>				
				



			
			<div class="form-group padding-large-bottom">
				<div class="label"><label for="showsnot">立即显示</label></div>
				<div class="button-group border-yellow radio">
				    <label class="button @if(count(old('showsnot'))<=0 || old('showsnot')==1)active @endif">
				        <input name="showsnot" value="1" @if(count(old('showsnot'))<=0 || old('showsnot')==1)checked="checked" @endif type="radio"> 立即显示
				    </label>
				    <label class="button  @if(old('showsnot')=="0")active @endif">
				        <input name="showsnot" value="0" @if(old('showsnot')=="0")checked="checked" @endif type="radio"> 暂时隐藏
				    </label>
				</div>
				<div class="text-gray text-small padding-little-top">选择显示，当提交后立即在前台展示给访客，选择隐藏不会立即发布。</div>
			</div>

			<div class="form-group padding-large-bottom">
				<div class="label"><label for="layout">侧边栏显示位置</label></div>
				<div class="button-group border-yellow radio layoutchoose">
				    <label class="button @if(count(old('layout'))<=0 || old('layout')==1)active @endif">
				        <input name="layout" value="1" @if(count(old('layout'))<=0 || old('layout')==1)checked="checked" @endif type="radio"> 显示在左侧
				    </label>
				    <label class="button @if(old('layout')==3)active @endif">
				        <input name="layout" value="3" @if(old('layout')==3)checked="checked" @endif type="radio"> 不显示
				    </label>
				    <label class="button @if(old('layout')==2)active @endif">
				        <input name="layout" value="2" @if(old('layout')==2)checked="checked" @endif type="radio"> 显示在右侧
				    </label>
				</div>
			</div>

			<div class="from-group padding-large-bottom">
				<div class="label"><label for="layout">侧边栏选择</label></div>
				<div class="button-group border-yellow ">
					<select name="sectionid" class="input ">
						@foreach($sections as $section)
						<option value="{{$section->id}}">{{$section->title}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group padding-large-bottom asidebox @if(count(old('layout'))>0 && old('layout')==3)hide @endif" style="width:200px;">
				<label class="label"><strong>侧边栏样式</strong></label>
				<select name="sectionid" class="input">
					@foreach($sections as $section)
			    	<option value="{{$section->id}}">{{$section->title}}</option>
			    	@endforeach
			    </select>
			</div>

			<div class="x7">
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="name">导航名称</label></div>
				    <div class="field"><input type="text" class="input" id="name" name="name" data-validate="required:必填,cnen:只能为中文或英文" placeholder="导航名称" value="{{ old('name') }}" /></div>
				    <span class="text-gray text-small">* 如：公司信息，产品展示</span>
				    @if($errors->has('name'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('name') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="nickname">url参数</label></div>
				    <div class="field"><input type="text" class="input" id="nickname" name="nickname" data-validate="required:必填" placeholder="url参数" value="{{ old('nickname') }}" /></div>
				    <span class="text-gray text-small">* 用于url别名，请勿填写符号和空格，多个英文请使用-隔开，如：hesheng 或 hesheng-conpany</span>
				    @if($errors->has('nickname'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('nickname') }}</div>
					@endif
				</div>

				@if(count(old('articount'))>0)
				    <?php $articountvalue = old('articount');?>
				@else
				    <?php $articountvalue = "15";?>
				@endif

				<div class="form-group padding-large-bottom articountbox @if(count(old('type'))<=0 || old('type')=="mainmenu" || old('type')=="menudetails" || old('type')=="alonepage" ) hide @endif" >
				    <div class="label"><label for="articount">每页显示的数量</label></div>
				    <div class="field"><input type="number" class="input" id="articount" name="articount" data-validate="required:必填" value="{{$articountvalue}}" placeholder="每页显示的数量" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('articount'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('articount') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="weihao">排序</label></div>
				    <div class="field"><input type="text" class="input" id="weihao" name="weihao" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" placeholder="排序" value="@if(count(old('weihao'))>0){{ old('weihao') }}@else{{ $maxweihao }}@endif"/></div>
				    <span class="text-gray text-small">* 数字类型：只能填写整数，数值越大排名越靠前，如：10000</span>
				    @if($errors->has('weihao'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('weihao') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="keywords">关键词</label></div>
				    <div class="field"><input type="text" class="input" id="keywords" name="keywords" data-validate="required:必填,keywords:错误：只能为中文、英文、数字，用英文小写逗号隔开,length#<=100:长度必须小于100个字符" placeholder="关键词1,关键词2,关键词3" value="{{ old('keywords') }}" /></div>
				    <span class="text-gray text-small">用于SEO优化，请填写与本导航相关的关键词，多个关键词请使用<strong>英文小写逗号</strong>隔开，一般不超过100个字符，如：紫业 或 紫业,策划,设计</span>
				    @if($errors->has('keywords'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('keywords') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="description">页面描述</label></div>
				    <div class="field"><textarea rows="5" class="input" id="description" name="description" placeholder="不超过200个字符，尽量包含关键词" data-validate="required:必填">{{ old('description') }}</textarea></div>
				    <span class="text-gray text-small">用于SEO优化，请填写与本页面的描述，一般不超过200个字符。</span>
				    @if($errors->has('description'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('description') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom clearfix menubanner" @if($typevalue=="mainmenu") style="display: none;" @endif>
				    <div class="label"><label for="banner">Banner 图</label></div>
				    <div class="field x9"><input type="text" class="input" id="xFilePath" name="banner" data-validate="required:必填,img:文件格式不支持" placeholder="Banner" value="{{ old('banner') }}" /></div>
				    <div class="x2 x1-move text-right"><button type="button" class="button bg-yellow" onclick="BrowseServer( 'Images:/', 'xFilePath' );">选择图片</button></div>
				    <span class="text-gray text-small"></span>
				    @if($errors->has('banner'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('banner') }}</div>
					@endif
				</div>
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom showdetailschoose @if(count(old('type'))<=0 || old('type')=="mainmenu") hide @endif">
				<div class="label"><label for="showdetails">是否显示详情</label></div>
				<div class="button-group border-yellow radio">
				    <label class="button @if(count(old('showdetails'))<=0 || old('showdetails')=="1")active @endif">
				        <input name="showdetails" value="1" @if(count(old('showdetails'))<=0 || old('showdetails')==1)checked="checked" @endif type="radio"> 显示
				    </label>
				    <label class="button @if(old('showdetails')=="0")active @endif">
				        <input name="showdetails" value="0" @if(old('showdetails')=="0")checked="checked" @endif type="radio"> 不显示
				    </label>
				</div>
				<div class="text-gray text-small padding-little-top"></div>
			</div>

			<div class="form-group padding-large-bottom detailspositionchoose @if(count(old('type'))<=0 || old('type')=="mainmenu") hide @endif @if(count(old('type'))>0 && old('showdetails')=="0") hide @endif">
				<div class="label"><label for="detailsposition">详情显示的位置</label></div>
				<div class="button-group border-yellow radio">
				    <label class="button @if(count(old('detailsposition'))<=0 || old('detailsposition')=="1")active @endif">
				        <input name="detailsposition" value="1" @if(count(old('detailsposition'))<=0 || old('detailsposition')==1)checked="checked" @endif type="radio"> 正文上方
				    </label>
				    <label class="button @if(old('detailsposition')=="2")active @endif">
				        <input name="detailsposition" value="2" @if(old('detailsposition')=="0")checked="checked" @endif type="radio"> 正文下方
				    </label>
				</div>
				<div class="text-gray text-small padding-little-top"></div>
			</div>

			<div class="form-group detailsedit @if(count(old('type'))<=0 || old('type')=="mainmenu") hide @endif @if(count(old('type'))>0 && old('showdetails')=="0") hide @endif">
			    <div class="label"><label for="details">内容</label></div>
			    <div class="field">
			      <textarea name="details" cols="50" class="input ckeditor" id="editor1">{{ old('details') }}</textarea>
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
		$(".articountbox").hide();
		$(".menubanner").show();
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

	$(".layoutchoose input").click(function(){
		thisvalue = $(this).val();
		if (thisvalue==1 || thisvalue==2) {
			$(".asidebox").show();
		} else {
			$(".asidebox").hide();
		}
	});

	@if(count(old('type'))>0)
	   	getstyle("{{old('type')}}",'{{old('style')}}');
	@endif

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