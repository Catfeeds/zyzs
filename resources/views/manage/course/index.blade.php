@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" >
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>装修课堂</li>
				</ul>
			</div>
			<div class="x2 text-right">
				<a href ="/manage/main" class="button icon-mail-reply bg-black"> 取消返回</a>
			</div>
		</div>

		<div class="x12">
			
			<div class="form-group padding-large-bottom">
				<div class="label"><label for="type_id">左上链接标题</label></div>
				<div class="field">
					<input type="text" name="l1title" class="input" value="{{$course->l1title}}">
				</div>
				<span class="text-gray text-small">左上角黄色方块链接的文字标题</span>
			</div>
			<div class="form-group padding-large-bottom">
				<div class="label"><label for="type_id">左上链接跳转地址</label></div>
				<div class="field">
					<input type="text" name="l1url" class="input" value="{{$course->l1url}}">
				</div>
				<span class="text-gray text-small">左上角黄色方块链接跳转的目标的URL地址</span>
			</div>


			<div class="form-group padding-large-bottom">
				<div class="label"><label for="type_id">左下链接标题</label></div>
				<div class="field">
					<input type="text" name="l2title" class="input" value="{{$course->l2title}}">
				</div>
				<span class="text-gray text-small">左下角蓝色方块链接的文字标题</span>
			</div>
			<div class="form-group padding-large-bottom">
				<div class="label"><label for="type_id">左下链接跳转地址</label></div>
				<div class="field">
					<input type="text" name="l2url" class="input" value="{{$course->l2url}}">
				</div>
				<span class="text-gray text-small">左下角蓝色方块链接的跳转目标URL地址</span>
			</div>

			
			<div class="form-group padding-large-bottom choosearticlestyle" style="width:200px;">
				<label class="label"><strong>请选择右下方左侧分栏的文章内容</strong></label>
			    <select name="r1nav" class="input ">
			    @foreach($navigations as $navigation)
			    	<option value="{{$navigation->id}}" @if($navigation->id==$course->r1nav) selected="selected" @endif>{{$navigation->name}}</option>
			    @endforeach
			    </select>
			</div>

			<div class="form-group padding-large-bottom choosearticlestyle" style="width:200px;">
				<label class="label"><strong>请选择右下方右侧分栏的文章内容</strong></label>
			    <select name="r2nav" class="input ">
			    	@foreach($navigations as $navigation)
			    	<option value="{{$navigation->id}}" @if($navigation->id==$course->r2nav) selected="selected" @endif>{{$navigation->name}}</option>
			    @endforeach
			    </select>
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