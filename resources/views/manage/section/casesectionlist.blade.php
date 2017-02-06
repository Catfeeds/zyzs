@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">

		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav/sections">侧边栏管理</a></li>
				    <li><a href="/manage/sitenav/sections/{{$sections_case->section->id}}">{{$sections_case->section->title}}</a></li>
				    <li>{{$sections_case->title}}</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/sitenav/sections/{{$sections_case->section->id}}" class="button icon-mail-reply bg-black margin-right"> 返回</a>
				<button class="button bg-main dialogs addcase" type="button" data-toggle="click" data-target="#mydialog" data-mask="1" data-width="50%">
					添加案例		
				</button>
			</div>
		</div>

		<div id="mydialog">
			<div class="dialog">
				<div class="dialog-head">
					<span class="close rotate-hover"></span><strong>添加案例</strong>
				</div>
				<div class="dialog-body">
					<table class="table-responsive table table-bordered casetable" >
						<tr align="center">
							<td>案例名称</td>
							<td>选择</td>
						</tr>
						@foreach($cases as $case)
						<tr align="center">
							<td>{{$case->title}}</td>
							<td><button class="button button-little bg-yellow addthiscase" data-id="{{$case->id}}">添加</button></td>
						</tr>
						@endforeach

						
					</table>	
							<div class="padding-little-top text-center" >
								<button class="button prepage margin-big-top">上一页</button>
								<button class="button nextpage margin-big-top">下一页</button>
							</div>
				</div>
				<div class="dialog-foot">
					<button class="button dialog-close">
						关闭</button>
				</div>
			</div>
		</div>


		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-little-bottom"><h1><span class="icon-edit"> </span>侧边栏管理 {{$sections_case->title}}</h1></div>
			</div>
			
			
		

				<div class="x12 padding-large-bottom margin-large-bottom">
        <div class="table-responsive">
            <table class="table table-striped table-bordered casedatas">
                <tr>
                	<td align="center">案例标题</td>
                	<td align="center"></td>
                </tr>

@foreach($sections_case->contents as $case)
               <tr align="center" id="casedata{{$case->id}}">
                <td>{{$case->title}}</td>

                <td align="center"><a onclick="{if(confirm('删除侧边栏可能会影响很多导航的使用请慎重操作?')){return true;}return false;}" href="/manage/sitenav/sections/caseSection/{{$sections_case->id}}/case/{{$case->id}}" class="button button-little bg-main"> <span class="icon-trash-o"> 移除</span></a></td>

                </tr>
@endforeach
           </table></div></div>
			
                
                
		</div>

		

		
	</div>
</div>
@stop

@section('extrajs')
<script>

	
	var page = 1;
	$(function(){


		$(".addcase").click(function(){
			
			$(".addthiscase").click(function(){
				var id = $(this).attr("data-id");
				$.ajax({
					url:"/manage/sitenav/sections/caseSection/{{$sections_case->id}}/case/"+id+"/add",
					type:"get",
					dataType:"json",
					success:function(msg){
						$("#casedata"+msg.id).remove();
						html = "<tr align=\"center\" id=\"casedata"+msg.id+"\">"+
                "<td>"+msg.title+"</td>"+
                "<td align=\"center\"><a onclick=\"{if(confirm('删除侧边栏可能会影响很多导航的使用请慎重操作?')){return true;}return false;}\""+
                "href=\"\/manage\/sitenav\/sections\/caseSection\/{{$sections_case->id}}\/case\/"+msg.id+"\" class=\"button button-little bg-main\"> <span class=\"icon-trash-o\"> 移除</span></a></td>"+
                "</tr>";
						$(".casedatas").append(html);
					},error:function(err){
						console.log(err);
					}
				})
			})


			$(".nextpage").click(function(){
				page++
				$.ajax({
			url:"/manage/sitenav/sections/caseSection/getcases/s?page="+page,
			type:"get",
			dataType:"json",
			success:function(msg){
				if(msg.last_page<=page)
				{
					$(".nextpage").hide();
					$(".prepage").show();
					return false;
				}else{
					$(".nextpage").show();
					$(".prepage").show();
				}
				html = "<tr align=\"center\">"+
							"<td>案例名称</td>"+
							"<td>选择</td>"+
						"</tr>";
				$(".casetable").html(html);
				$.each(msg.data,function(i,item){
					$(".casetable").append("<tr align=\"center\"><td>"+item.title+"</td><td><button class=\"addthiscase button button-little bg-yellow\" data-id=\""+item.id+"\">添加</button></td></tr>");
				})

				$(".addthiscase").click(function(){
				var id = $(this).attr("data-id");
				$.ajax({
					url:"/manage/sitenav/sections/caseSection/{{$sections_case->id}}/case/"+id+"/add",
					type:"get",
					dataType:"json",
					success:function(msg){
						$("#casedata"+msg.id).remove();
						html = "<tr align=\"center\" id=\"casedata"+msg.id+"\">"+
                "<td>"+msg.title+"</td>"+
                "<td align=\"center\"><a onclick=\"{if(confirm('删除侧边栏可能会影响很多导航的使用请慎重操作?')){return true;}return false;}\""+
                "href=\"\/manage\/sitenav\/sections\/caseSection\/{{$sections_case->id}}\/case\/"+msg.id+"\" class=\"button button-little bg-main\"> <span class=\"icon-trash-o\"> 移除</span></a></td>"+
                "</tr>";
						$(".casedatas").append(html);
					},error:function(err){
						console.log(err);
					}
				})
			})

				// $(".casetable").html(html);

			}
			,error:function(err)
			{
				console.log(err);
			}
		})

			})


		


		$(".prepage").click(function(){
				page--;
				$.ajax({
			url:"/manage/sitenav/sections/caseSection/getcases/s?page="+page,
			type:"get",
			dataType:"json",
			success:function(msg){
				if(msg.last_page<=1)
				{
					$(".prepage").hide();
					$(".nextpage").show();
					return false;
				}else{
					$(".prepage").show();
					$(".nextpage").show();
				}
				html = "<tr align=\"center\">"+
							"<td>案例名称</td>"+
							"<td>选择</td>"+
						"</tr>";
				$(".casetable").html(html);
				$.each(msg.data,function(i,item){
					$(".casetable").append("<tr align=\"center\"><td>"+item.title+"</td><td><button class=\"addthiscase button button-little bg-yellow\" data-id=\""+item.id+"\">添加</button></td></tr>");
				})

				// $(".casetable").html(html);
				$(".addthiscase").click(function(){
				var id = $(this).attr("data-id");
				$.ajax({
					url:"/manage/sitenav/sections/caseSection/{{$sections_case->id}}/case/"+id+"/add",
					type:"get",
					dataType:"json",
					success:function(msg){
						$("#casedata"+msg.id).remove();
						html = "<tr align=\"center\" id=\"casedata"+msg.id+"\">"+
                "<td>"+msg.title+"</td>"+
                "<td align=\"center\"><a onclick=\"{if(confirm('删除侧边栏可能会影响很多导航的使用请慎重操作?')){return true;}return false;}\""+
                "href=\"\/manage\/sitenav\/sections\/caseSection\/{{$sections_case->id}}\/case\/"+msg.id+"\" class=\"button button-little bg-main\"> <span class=\"icon-trash-o\"> 移除</span></a></td>"+
                "</tr>";
						$(".casedatas").append(html);
					},error:function(err){
						console.log(err);
					}
				})
			})

			}
			,error:function(err)
			{
				console.log(err);
			}
		})

			})


		})


		



	})
</script>
@stop