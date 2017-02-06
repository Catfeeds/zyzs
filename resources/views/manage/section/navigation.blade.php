@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">

		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav">导航管理</a></li>
				    <li>侧边栏设置</li>
				</ul>
			</div>
			<div class="x2 text-right">
				<a href="/manage/sitenav" class="button icon-mail-reply bg-black"> 返回</a>
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-little-bottom"><h1><span class="icon-edit"> </span>正在修改导航 “<span class="text-main">{{ $navigation->name }}</span>” 的侧边栏</h1></div>
			</div>
			<button class="button button-normal bg-main select-section-button" type="button">选择侧边栏</button>
			<div class="padding-large-bottom border-bottom margin-little-bottom">
				<table class="table table-striped  select-section" >
				<tr align="center">
					<td>侧边栏标题</td>
					<td>操作</td>
				</tr>
				@foreach($sections as $section)
				<tr align="center">
					<td>
						{{$section->title}}
					</td>
					<td>
						<a class="button button-little bg-yellow" href="/manage/sitenav/{{$navigation->id}}/section/{{$section->id}}">选择</a>
					</td>
				</tr>
				@endforeach
			</table>
			</div>
			
			@if($navigation->sectionid==0||empty($navigation->section->id))
				<div class="x12 padding-large-bottom margin-large-bottom">
					
								
								
						

				</div>
			@else

				<div class="x12 padding-large-bottom margin-large-bottom">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="60"></td><td align="center" width="200">侧边栏名称</td><td align="center" width="100">添加板块</td><td align="center" width="80">删除</td><td align="center" width="80">修改</td></tr>

               <tr align="center" class="bg-yellow-light">
                <td>
               	
                </td>
                <td align="center">
                {{$navigation->section->title}}
                </td>
                <td align="center">
                   <button class="button button-little bg-green" type="button"> <span class=""> 添加板块</span></button>
                
                </td>
                <td align="center"><a onclick="{if(confirm('删除侧边栏不会删除侧边栏的数据，您可以在选择侧边栏中恢复')){return true;}return false;}" href="/manage/sitenav/{{$navigation->id}}/section/0" class="button button-little bg-main"> <span class="icon-trash-o"> 删除</span></a></td>
                <td align="center"><a href="" class="button button-little bg-yellow"> <span class="icon-edit"> 修改</span></a></td>

                </tr></table></div></div>
				
         	@endif
                
                
		</div>

		

		
	</div>
</div>
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