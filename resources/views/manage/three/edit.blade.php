@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST">
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/three">首页三块图文</a></li>
				    <li>{{$three->title}}</li>
				</ul>
			</div>
			<div class="x2 text-right">
				<a href ="/manage/three" class="button icon-mail-reply bg-black"> 取消返回</a>
			</div>
		</div>

		<div class="x12">

		

				<div class="margin-large-bottom ">
					<div class="form-group">
						<textarea id="editor1" name="content">{{$three->content}}</textarea>
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