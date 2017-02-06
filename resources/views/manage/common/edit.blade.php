@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="/manage/common/edit/{{$common->id}}">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/common/list" title=""> 常见问题</a></li>
            <li>编辑</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/common/list" class="button icon-mail-reply bg-black margin-right"> 返回</a>
			</div>
		</div>

		<div class="x12">
			<div class="table-responsive padding-large-bottom">
          <div class="form-group padding-large-bottom">
            <div class="label"><label for="ts_id">将留言推送到哪个栏目？</label></div>
            <div class="button-group border-yellow radio">
                <?php $forlist = 1; ?>
                @foreach($tslist as $list)
                <label class="button @if(count(old('ts_id'))>0 && old('ts_id')==$list->id)active @elseif($forlist==1) active @endif">
                    <input name="ts_id" value="{{$list->id}}" @if(count(old('ts_id'))>0 && old('ts_id')==$list->id)checked="checked" @elseif($forlist==1) checked="checked" @endif type="radio"> {{$list->name}}
                </label>
                <?php $forlist++; ?>
                @endforeach
            </div>
            <div class="text-gray text-small padding-little-top"></div>
          </div>

          <div class="form-group padding-large-bottom">
              <div class="label"><label for="content">留言内容</label></div>
              <div class="field">
                <textarea name="content" cols="50" class="input ckeditor" id="editor1">@if(count(old('content'))>0){!! old('content')!!}@else{!!$common->content!!}@endif</textarea>
              </div>
              @if($errors->has('content'))
              <div class="text-red icon-exclamation-triangle"> {{ $errors->first('content') }}</div>
            @endif
          </div>

          <div class="form-group padding-large-bottom">
              <div class="label"><label for="reply">回复内容</label></div>
              <div class="field">
                <textarea name="reply" cols="50" class="input ckeditor" id="editor2">@if(count(old('reply'))>0){!! old('reply')!!}@else{!!$common->reply!!}@endif</textarea>
              </div>
              @if($errors->has('reply'))
              <div class="text-red icon-exclamation-triangle"> {{ $errors->first('reply') }}</div>
            @endif
          </div>

          <div class="form-group padding-large-bottom">
            <div class="label"><label for="keywords">关键词</label></div>
            <div class="field"><input type="text" class="input" id="keywords" name="keywords" data-validate="required:必填,keywords:错误：只能为中文、英文、数字，用英文小写逗号隔开,length#<=100:长度必须小于100个字符" placeholder="关键词1,关键词2,关键词3" value="@if(count(old('keywords'))>0){{ old('keywords') }}@else{{$common->keywords}}@endif" /></div>
            <span class="text-gray text-small">用于SEO优化，请填写与本导航相关的关键词，多个关键词请使用<strong>英文小写逗号</strong>隔开，一般不超过100个字符，如：紫业 或 紫业,策划,设计</span>
            @if($errors->has('keywords'))
            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('keywords') }}</div>
            @endif
          </div>

          <div class="form-group padding-large-bottom">
            <div class="label"><label for="description">页面描述</label></div>
            <div class="field"><textarea rows="5" class="input" id="description" name="description" placeholder="不超过200个字符，尽量包含关键词" data-validate="required:必填,length#<=800:长度必须小于200个字符">@if(count(old('description'))>0){{ old('description') }}@else{{$common->description}}@endif</textarea></div>
            <span class="text-gray text-small">用于SEO优化，请填写与本页面的描述，一般不超过200个字符，如：紫业装饰设计公司是一家xxxxxx</span>
            @if($errors->has('description'))
              <div class="text-red icon-exclamation-triangle"> {{ $errors->first('description') }}</div>
            @endif
          </div>

          <div class="form-group padding-large-bottom">
              <div class="label"><label for="y">支持人数</label></div>
              <div class="field"><input type="number" class="input" id="y" name="y" data-validate="required:必填" value="@if(count(old('y'))>0){{ old('y') }}@else{{$common->y}}@endif" placeholder="支持人数" /></div>
              <div class="text-gray text-small"></div>
              @if($errors->has('y'))
              <div class="text-red icon-exclamation-triangle"> {{ $errors->first('y') }}</div>
              @endif
          </div>

          <div class="form-group padding-large-bottom">
              <div class="label"><label for="n">反对人数</label></div>
              <div class="field"><input type="number" class="input" id="n" name="n" data-validate="required:必填" value="@if(count(old('n'))>0){{ old('n') }}@else{{$common->n}}@endif" placeholder="反对人数" /></div>
              <div class="text-gray text-small"></div>
              @if($errors->has('n'))
              <div class="text-red icon-exclamation-triangle"> {{ $errors->first('n') }}</div>
              @endif
          </div>

          <div class="form-group padding-large-bottom">
            <div class="label"><label for="weihao">排序</label></div>
            <div class="field"><input type="number" class="input" id="weihao" name="weihao" data-validate="required:必填,number:只能是数字,compare#>0:值不得小于1,compare#<99999999999:值不得大于99999999999,length#>=1:长度不能小于1个字符,length#<=11:长度不得大于11个字符" value="@if(count(old('weihao'))>0){{ old('weihao')}}@else{{ $common->weihao }}@endif" placeholder="排序" /></div>
            <div class="text-gray text-small padding-little-top">* 数字类型：只能填写整数，数值越大排名越靠前，如：10000</div>
            @if($errors->has('weihao'))
            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('weihao') }}</div>
          @endif
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
</script>
@stop