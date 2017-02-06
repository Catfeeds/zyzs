@extends('manage.site')

@section('main')
<form method="post">
<div class="container bg-white margin-large-top">
	<div class="padding-large">

		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>侧边栏管理</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/main" class="button icon-mail-reply bg-black margin-right"> 返回</a>
				<a href="/manage/sitenav/sections/add"  class="button bg-green margin-right">添加新侧边栏</a>
				<button type="submit"  class="button bg-yellow">保存修改</button>
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-little-bottom"><h1><span class="icon-edit"> </span>侧边栏管理</h1></div>
			</div>
			
			
		

				<div class="x12 padding-large-bottom margin-large-bottom">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="80"></td><td align="center">侧边栏名称</td>{{-- <td align="center" width="100">添加板块</td> --}}{{-- <td align="center" width="80">删除</td> --}}<td align="center" width="100">修改</td><td align="center" width="100">删除</td></tr>

@foreach($sections as $section)
               <tr align="center">
                <td>
               	{{$section->id}}<input type="hidden" name="id[]" value="{{$section->id}}">
                </td>
                <td align="center">
                <input type="text" name="title[]" value="{{$section->title}}" class="input input-small">
                {{csrf_field()}}
                </td>
                {{-- <td align="center">
                   <button class="button button-little bg-green" type="button"> <span class=""> 添加板块</span></button>
                
                </td> --}}
                {{-- <td align="center"><a onclick="{if(confirm('删除侧边栏不会删除侧边栏的数据，您可以在选择侧边栏中恢复')){return true;}return false;}" href="/manage/sitenav/{{$section->id}}/section/0" class="button button-little bg-main"> <span class="icon-trash-o"> 删除</span></a></td> --}}
                <td align="center"><a href="/manage/sitenav/sections/{{$section->id}}" class="button button-little bg-yellow"> <span class="icon-edit"> 修改</span></a></td>

                <td align="center"><a onclick="{if(confirm('删除侧边栏可能会影响很多导航的使用请慎重操作?')){return true;}return false;}" href="/manage/sitenav/sections/{{$section->id}}/delete" class="button button-little bg-main"> <span class="icon-trash-o"> 删除</span></a></td>

                </tr>
@endforeach
           </table></div></div>
			
                
                
		</div>

		

		
	</div>
</div>
</form>
@stop

@section('extrajs')
<script type="text/javascript">
$(function(){
	$(".select-section").hide();
	$(".select-section-button").click(function(){
		$(".select-section").toggle();
	})
})
</script>
@stop