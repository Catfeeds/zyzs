@extends('manage.site')

@section('main')
<form method="post">
<div class="container bg-white margin-large-top">
	<div class="padding-large">

		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>其他设置</li>
				    <li>团队管理</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/sitenav" class="button icon-mail-reply bg-black"> 返回</a>
				<a  class="button bg-yellow" href="/manage/teams/add/{{$navigation->id}}">新建团队</a>
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-little-bottom"><h1><span class="icon-edit"> </span>团队管理</h1></div>
			</div>
			
			
		

				<div class="x12 padding-large-bottom margin-large-bottom">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                	<td align="center" width="60"></td>
                	<td align="center" width="200">团队名称</td>
                	<td align="center " width="60">排序</td>
               		{{-- <td align="center" width="100">添加板块</td> --}}
               		{{-- <td align="center" width="80">删除</td> --}}
                	<td align="center" width="80">修改</td><td align="center" width="80">删除</td></tr>

@foreach($teams as $team)
               <tr align="center">
                <td>
               	{{$team->id}}<input type="hidden" name="id[]" value="{{$team->id}}">
                </td>
                <td align="center">
                {{$team->title}}
                
                </td>

                <td align="center">
                	<input type="number" name="order[]" value="{{$team->order}}" class="input input-small" readonly="readonly">
                </td>
                {{-- <td align="center">
                   <button class="button button-little bg-green" type="button"> <span class=""> 添加板块</span></button>
                
                </td> --}}
                {{-- <td align="center"><a onclick="{if(confirm('删除侧边栏不会删除侧边栏的数据，您可以在选择侧边栏中恢复')){return true;}return false;}" href="/manage/sitenav/{{$section->id}}/section/0" class="button button-little bg-main"> <span class="icon-trash-o"> 删除</span></a></td> --}}
                <td align="center"><a href="/manage/teams/{{$team->id}}/edit" class="button button-little bg-yellow"> <span class="icon-edit"> 修改</span></a></td>

                <td align="center"><a onclick="{if(confirm('非设计人员请勿操作此项?')){return true;}return false;}" href="/manage/teams/{{$team->id}}/delete" class="button button-little bg-main"> <span class="icon-trash-o"> 删除</span></a></td>

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