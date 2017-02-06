@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="/manage/siteset">
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>站点设置</li>
				</ul>
			</div>
			<div class="x2 text-right">
				<a href="/manage/main" class="button icon-mail-reply bg-black"> 返回</a>
			</div>
		</div>

		<div class="clearfix">
			<div class="x7">
				<h1 class="padding-large-bottom text-main">公司信息类：</h1>
				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="companyname">公司名称</label></div>
				    <div class="field"><input type="text" class="input" id="companyname" name="companyname" data-validate="required:必填" value="@if(count(old('companyname'))>0){{ old('companyname') }}@else{{$editdata->companyname}}@endif" placeholder="公司名称" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('companyname'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('companyname') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="companyphone">联系电话</label></div>
				    <div class="field"><input type="text" class="input" id="companyphone" name="companyphone" data-validate="required:必填" value="@if(count(old('companyphone'))>0){{ old('companyphone') }}@else{{$editdata->companyphone}}@endif" placeholder="联系电话" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('companyphone'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('companyphone') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="companyfax">图文传真</label></div>
				    <div class="field"><input type="text" class="input" id="companyfax" name="companyfax" data-validate="required:必填" value="@if(count(old('companyfax'))>0){{ old('companyfax') }}@else{{$editdata->companyfax}}@endif" placeholder="图文传真" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('companyfax'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('companyfax') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="companyaddress">公司地址</label></div>
				    <div class="field"><input type="text" class="input" id="companyaddress" name="companyaddress" data-validate="required:必填" value="@if(count(old('companyaddress'))>0){{ old('companyaddress') }}@else{{$editdata->companyaddress}}@endif" placeholder="公司地址" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('companyaddress'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('companyaddress') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom clearfix">
				    <div class="label"><label for="companylogo">Logo</label></div>
				    <div class="field x9"><input type="text" class="input" id="xFilePaths" name="companylogo" data-validate="required:必填,img:文件格式不支持" placeholder="companylogo" value="@if(count(old('companylogo'))>0){{ old('companylogo') }}@else{{$editdata->companylogo}}@endif" /></div>
				    <div class="x2 x1-move text-right"><button type="button" class="button bg-yellow" onclick="BrowseServer( 'Images:/', 'xFilePaths' );">选择图片</button></div>
				    <span class="text-gray text-small"></span>
				    @if($errors->has('companylogo'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('companylogo') }}</div>
					@endif
				</div>

				<h1 class="padding-large-top padding-large-bottom text-main">网站信息类：</h1>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="sitename">网站名称</label></div>
				    <div class="field"><input type="text" class="input" id="sitename" name="sitename" data-validate="required:必填" value="@if(count(old('sitename'))>0){{ old('sitename') }}@else{{$editdata->sitename}}@endif" placeholder="网站名称" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('sitename'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('sitename') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="sitebeian">网站备案号</label></div>
				    <div class="field"><input type="text" class="input" id="sitebeian" name="sitebeian" data-validate="required:必填" value="@if(count(old('sitebeian'))>0){{ old('sitebeian') }}@else{{$editdata->sitebeian}}@endif" placeholder="网站备案号" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('sitebeian'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('sitebeian') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="sitekeywords">网站关键词</label></div>
				    <div class="field"><input type="text" class="input" id="sitekeywords" name="sitekeywords" data-validate="required:必填" value="@if(count(old('sitekeywords'))>0){{ old('sitekeywords') }}@else{{$editdata->sitekeywords}}@endif" placeholder="网站关键词" /></div>
				    <div class="text-gray text-small"></div>
				    @if($errors->has('sitekeywords'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('sitekeywords') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="sitedescription">网站描述</label></div>
				    <div class="field"><textarea rows="5" class="input" id="sitedescription" name="sitedescription" placeholder="网站描述" data-validate="required:必填">@if(count(old('sitedescription'))>0){{ old('sitedescription') }}@else{{$editdata->sitedescription}}@endif</textarea></div>
				    <span class="text-gray text-small"></span>
				    @if($errors->has('sitedescription'))
				        <div class="text-red icon-exclamation-triangle"> {{$errors->first('sitedescription') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="siteurl">网站链接</label></div>
				    <div class="field"><input type="text" class="input" id="siteurl" name="siteurl" data-validate="required:必填" value="@if(count(old('siteurl'))>0){{ old('siteurl') }}@else{{$editdata->siteurl}}@endif" placeholder="网站链接" /></div>
				    <div class="text-gray text-small">不带http://，请直接填写www.xxxx.com</div>
				    @if($errors->has('siteurl'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('siteurl') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom clearfix">
				    <div class="label"><label for="siteico">网站ICO</label></div>
				    <div class="field x9"><input type="text" class="input" id="xFilePath" name="siteico" data-validate="required:必填,img:文件格式不支持" placeholder="siteico" value="@if(count(old('siteico'))>0){{ old('siteico') }}@else{{$editdata->siteico}}@endif" /></div>
				    <div class="x2 x1-move text-right"><button type="button" class="button bg-yellow" onclick="BrowseServer( 'Images:/', 'xFilePath' );">选择图片</button></div>
				    <span class="text-gray text-small">如非必要请勿修改</span>
				    @if($errors->has('siteico'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('siteico') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom clearfix">
				    <div class="label"><label for="sitemqcrode">网站二维码</label></div>
				    <div class="field x9"><input type="text" class="input" id="xFilePath2" name="sitemqcrode" data-validate="required:必填,img:文件格式不支持" placeholder="网站二维码" value="@if(count(old('sitemqcrode'))>0){{ old('sitemqcrode') }}@else{{$editdata->sitemqcrode}}@endif" /></div>
				    <div class="x2 x1-move text-right"><button type="button" class="button bg-yellow" onclick="BrowseServer( 'Images:/', 'xFilePath2' );">选择图片</button></div>
				    @if($errors->has('sitemqcrode'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('sitemqcrode') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom clearfix">
				    <div class="label"><label for="sitewxqcrode">微信二维码</label></div>
				    <div class="field x9"><input type="text" class="input" id="xFilePath2" name="sitewxqcrode" data-validate="required:必填,img:文件格式不支持" placeholder="微信二维码图片" value="@if(count(old('sitewxqcrode'))>0){{ old('sitewxqcrode') }}@else{{$editdata->sitewxqcrode}}@endif" /></div>
				    <div class="x2 x1-move text-right"><button type="button" class="button bg-yellow" onclick="BrowseServer( 'Images:/', 'xFilePath2' );">选择图片</button></div>
				    @if($errors->has('sitewxqcrode'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('sitewxqcrode') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom clearfix">
				    <div class="label"><label for="weiboqcrode">微博二维码</label></div>
				    <div class="field x9"><input type="text" class="input" id="xFilePath3" name="weiboqcrode" data-validate="required:必填,img:文件格式不支持" placeholder="微博二维码图片" value="@if(count(old('weiboqcrode'))>0){{ old('weiboqcrode') }}@else{{$editdata->weiboqcrode}}@endif" /></div>
				    <div class="x2 x1-move text-right"><button type="button" class="button bg-yellow" onclick="BrowseServer( 'Images:/', 'xFilePath3' );">选择图片</button></div>
				    @if($errors->has('weiboqcrode'))
						<div class="text-red icon-exclamation-triangle"> {{ $errors->first('weiboqcrode') }}</div>
					@endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="weibourl">微博跳转链接</label></div>
				    <div class="field"><input type="text" class="input" id="weibourl" name="weibourl" data-validate="required:必填" value="@if(count(old('weibourl'))>0){{ old('weibourl') }}@else{{$editdata->weibourl}}@endif" placeholder="微博跳转链接" /></div>
				    @if($errors->has('weibourl'))
				    <div class="text-red icon-exclamation-triangle"> {{ $errors->first('weibourl') }}</div>
				    @endif
				</div>

				<div class="form-group padding-large-bottom">
				    <div class="label"><label for="statistical">网站访问统计代码、第三方插件代码</label></div>
				    <div class="field"><textarea rows="5" class="input" id="statistical" name="statistical" placeholder="网站统计代码">@if(count(old('statistical'))>0){{ old('statistical') }}@else{{$editdata->statistical}}@endif</textarea></div>
				    <span class="text-gray text-small">没有请留空，第三方访问统计建议：<a href="http://tongji.baidu.com" title="百度统计" target="_blank">百度统计</a> <a href="http://ta.qq.com/" title="腾讯分析" target="_blank">腾讯分析</a></span>
				    @if($errors->has('statistical'))
				        <div class="text-red icon-exclamation-triangle"> {{$errors->first('statistical') }}</div>
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