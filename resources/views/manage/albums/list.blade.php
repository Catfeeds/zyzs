@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav"></a>导航管理</li>
				    <li>内容管理</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/sitenav" class="button icon-mail-reply bg-black margin-right"> 返回</a>
				<a href="/manage/album/insert/{{ $navigation->id }}" class="button icon-file-o bg-yellow margin-right"> 新增相册</a>
        <button class="button bg-green icon-save" type="submit"> 保存修改</button>
			</div>
		</div>

		<div class="x12">
			<h1 class="padding-large-bottom border-bottom margin-large-bottom">
			<span class="icon-thumb-tack"> </span>“{{ $navigation->name }}” 中的所有相册：</h1>

			{{--@if($albumlists!=="empty")
			<div class="padding-large-bottom border-bottom margin-large-bottom">
			<button type="button" class="button margin-right icon-check-square-o checkselectall"> 全选</button>
			<button type="button" class="button margin-right icon-square-o checkunselectall"> 全不选</button>
			<button type="button" class="button margin-right icon-check-square checkunselect"> 反选</button>
			<button type="button" class="button icon-trash-o bg-main checkselectremove"> 删除选中</button>
			</div>
			@endif
      --}}
			<div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="50">选择</td><td align="center">相册名称</td><td align="center" width="120">封面图片</td><td align="center" width="120">排序</td><td align="center" width="120">访问量</td><td align="center" width="70">浏览</td><td align="center" width="70">删除</td><td align="center" width="70">修改</td></tr>
                @if($albums->count()>0)
                @foreach ($albums as $mt)
                <tr>
                <td align="center">
                <input class="icheckbox" name="selectid[]" type="checkbox" value="{{ $mt->id }}">
                </td>

                <td><input type="hidden" name="id[]" value="{{$mt->id}}"><input type="text" name="name[]" class="input " value="{{$mt->name}}"></td>
                <td><input type="text" name="cover[]" class="input" id="cover{{$mt->id}}" value="{{$mt->cover}}" onclick="BrowseServer( 'Images:/', 'cover{{$mt->id}}' );"></td>
                <td><input type="number" name="weihao[]" class="input" value="{{$mt->weihao}}"></td>
                <td align="center"><input type="number" name="fangwen[]" value="{{$mt->getviews->weihao}}" class="input input-small">{{--这里是访问量借用个表--}}</td>

                <td align="center"><a href="/album-view-{{ $mt->id }}.html" class="button button-little bg-blue icon-file-text-o" target="_blank"> 浏览</a></td>
                <td align="center"><a href="/manage/album/remove/{{ $mt->id }}" class="button button-little bg-main icon-trash-o" onclick="{if(confirm('删除本条数据，相关的评论、阅读量、赞等数据都将一同被删除，不会恢复请确认：')){return true;}return false;}"> 删除</a></td>
                <td align="center"><a href="/manage/album/update/{{ $mt->id }}" class="button button-little bg-yellow icon-edit"> 管理</a></td>
                </tr>
                @endforeach
                @else
                <tr><td colspan="8" align="center">没有找到相册，请添加</td></tr>
                @endif
            </table>
            </div>
		</div>

		<div class="x12 margin-large-bottom padding-large-bottom">
            <div class="x4 x2-move text-center"><button class="button bg-gray button-big win-refresh icon-refresh" type="button"> 重新载入</button></div>
            <div class="x4 text-center"><button class="button bg-green button-big icon-save" type="submit"> 保存修改</button></div>
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