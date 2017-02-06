@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="/manage/banner/insert">
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/banner">首页Banner管理</a></li>
				    <li>新增Banner</li>
				</ul>
			</div>
			<div class="x2 text-right">
				<a href ="/manage/banner" class="button icon-mail-reply bg-black"> 取消返回</a>
			</div>
		</div>

		<div class="x12">
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

			<div class="x7">
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="weihao">排序</label></div>
				    <div class="field"><input type="text" class="input" id="weihao" name="weihao" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" placeholder="排序" value="@if(count(old('weihao'))>0){{ old('weihao') }}@else{{ $maxweihao }}@endif"/></div>
				    <span class="text-gray text-small">* 数字类型：只能填写整数，数值越大排名越靠前，如：10000</span>
				    @if($errors->has('weihao'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('weihao') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom clearfix">
				    <div class="label"><label for="filepath">Banner 图</label></div>
				    <div class="field x9"><input type="text" class="input" id="xFilePath" name="filepath" data-validate="required:必填,img:文件格式不支持" placeholder="请选择图片" value="{{ old('filepath') }}" /></div>
				    <div class="x2 x1-move text-right"><button type="button" class="button bg-yellow" onclick="BrowseServer( 'Images:/', 'xFilePath' );">选择图片</button></div>
				    <span class="text-gray text-small"></span>
				    @if($errors->has('filepath'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('filepath') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom clearfix">
				    <div class="label"><label for="mfilepath">Banner 图(移动端)</label></div>
				    <div class="field x9"><input type="text" class="input" id="xmfilepath" name="mfilepath" data-validate="required:必填,img:文件格式不支持" placeholder="请选择图片" value="{{ old('mfilepath') }}" /></div>
				    <div class="x2 x1-move text-right"><button type="button" class="button bg-yellow" onclick="BrowseServer( 'Images:/', 'xmfilepath' );">选择图片</button></div>
				    <span class="text-gray text-small"></span>
				    @if($errors->has('mfilepath'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('mfilepath') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="alink">链接</label></div>
				    <div class="field"><input type="text" class="input" id="alink" name="alink" value="@if(count(old('alink'))>0){{ old('alink') }}@endif" placeholder="链接" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('alink'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('alink') }}</div>
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
		switch(thistype){
			case "menu":
				if (thisvalue=="1") {
					hidedetails();
				} else {
					hidedetails();
					$(".detailsedit").show();
				};
			break;
			case "page":
				hidedetails();
				$(".detailsedit").show();
			break;
			case "article":
				showdetails();
			break;
			case "job":
				showdetails();
			break;
			case "product":
				showdetails();
			break;
		}
	})
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