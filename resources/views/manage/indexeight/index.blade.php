@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
  <div class="padding-large">
    <form method="POST">
    <div class="line-big margin-large-bottom">
      <div class="x6">
        <ul class="bread">
            <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
            <li>首页八大工艺</li>
        </ul>
      </div>
      <div class="x6 text-right">
        <a href="/manage/main" class="button icon-mail-reply bg-black margin-right"> 返回</a>
        <a href="/manage/indexeight/create" class="button icon-file-o bg-yellow margin-right"> 新增</a>
        <button class="button bg-green icon-save" type="submit"> 保存修改</button>
      </div>
    </div>

    <div class="x12">
      <h1 class="padding-large-bottom border-bottom margin-large-bottom">
      <span class="icon-thumb-tack"> </span>首页八大工艺</h1>

      

      <div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr>
                  <td align="center" width="50">序号</td>
                  <td align="center" width="80">标题</td>
                  <td align="center" width="120">图片</td>
                  <td align="center" width="120">链接</td>
                  <td align="center" width="50">图标</td>
                  <td align="center" width="80">排序</td>
                  <td align="center" width="70">删除</td></tr>
                @if($indexeight->count()>0)
                @foreach ($indexeight as $key=>$value)
                <tr>
                <td align="center">
                  {{$key+1}}<input type="hidden" name="id[]" value="{{$value->id}}">
                </td>
                <td>
                  <input type="text" name="title[]" class="input input-small" value="{{$value->title}}">
                </td>
                <td class="text-center" align="center">
                  <input type="text" name="img[]" id="img{{$value->id}}" class="input input-small" value="{{$value->img}}" onclick="BrowseServer( 'Images:/', 'img{{$value->id}}' );" >
                </td>
                <td>
                  <input type="text" name="url[]" class="input input-small" value="{{$value->url}}">
                </td>
                <td>
                  <input type="number" name="index[]" class="input input-small" value="{{$value->index}}">
                </td>
                <td>
                  <select class="input input-small" name="icon[]">
                    <option value="icon-random" @if($value->icon == "icon-random") selected="selected" @endif>icon-random</option>
                    <option value="icon-anchor" @if($value->icon == "icon-anchor") selected="selected" @endif>icon-anchor</option>
                    <option value="icon-asterisk" @if($value->icon == "icon-asterisk") selected="selected" @endif>icon-asterisk</option>
                    <option value="icon-fire" @if($value->icon == "icon-fire") selected="selected" @endif>icon-fire</option>
                    <option value="icon-filter" @if($value->icon == "icon-filter") selected="selected" @endif>icon-filter</option>
                    <option value="icon-flask" @if($value->icon == "icon-flask") selected="selected" @endif>icon-flask</option>
                    <option value="icon-leaf" @if($value->icon == "icon-leaf") selected="selected" @endif>icon-leaf</option>
                    <option value="icon-recycle" @if($value->icon == "icon-recycle") selected="selected" @endif>icon-recycle</option>
                  </select>
                </td>
                <td align="center"><a href="/manage/indexeight/remove/{{ $value->id }}" class="button button-little bg-main icon-trash-o" onclick="{if(confirm('删除后不可恢复：')){return true;}return false;}"> 删除</a></td>
                
                </tr>
                @endforeach
                @else
                <tr><td colspan="8" align="center">没有内容请添加</td></tr>
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