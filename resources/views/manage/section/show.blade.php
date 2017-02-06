@extends('manage.site')

@section('main')
<form role="form" action="" method="post">
<div class="container bg-white margin-large-top">
	<div class="padding-large">

		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav/sections">侧边栏管理</a></li>
				    <li>{{$section->title}}</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/sitenav/sections" class="button icon-mail-reply bg-black margin-right"> 返回</a>
				
				<button type="submit" class="button  bg-green button-blue">保存修改</button>
				{{csrf_field()}}
			</div>
		</div>

        <div class="line-big margin-large-bottom">
            <div class="x12 text-left">
                <a href="/manage/sitenav/sections/{{$section->id}}/articleSection/add" class="button icon-file-o bg-yellow margin-right"> 
                    添加文章版块
                </a>
                <a href="/manage/sitenav/sections/{{$section->id}}/caseSection/add" class="button bg-yellow margin-right">
                    添加案例板块
                </a>
            </div>
        </div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-little-bottom"><h1><span class="icon-edit"> </span>侧边栏: {{$section->title}}</h1></div>
			</div>

		<div class="x12 padding-large-bottom margin-large-bottom">
        	<div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                	<td align="center" width="60">序号</td>
                	<td align="center" width="100">版块标题</td>
                	<td align="center" width="80">板块类别</td>
                	<td align="center" width="80">版块排序</td>
                	<td align="center" width="80">排序类别</td>
                	<td align="center" width="80">排序规则</td>
                	<td align="center" width="60">数量</td>
                	<td align="center" width="60">操作</td>
                </tr>

                @foreach($articlesSections as $key=>$articlesSection)
                <tr align="center">
                	<td>{{$key+1}}<input type="hidden" name="id[]" value="{{$articlesSection->id}}"></td>
                	<td><input type="text" name="title[]" value="{{$articlesSection->title}}" class="input input-small"></td>
                	<td>文章版块<input type="hidden" name="type[]" value="articles"></td>
                	<td><input type="number" name="order[]" value="{{$articlesSection->order}}" class="input input-small"></td>

                	<td>
                		
                		<select class="input input-small" name="orderkey[]">
                		@if(!empty($articlesSection->orderkey))
                			<option value="{{$articlesSection->orderkey}}">{{$orderkey[$articlesSection->orderkey]}}</option>
                		@endif
                			@foreach($orderkey as $k => $v)
                			<option value="{{$k}}">{{$v}}</option>
                			@endforeach
                		</select>
                	</td>
                	<td>

                	<select class="input input-small" name="ordervalue[]">
                		@if(!empty($articlesSection->ordervalue))
                			<option value="{{$articlesSection->ordervalue}}">{{$orderValue[$articlesSection->ordervalue]}}</option>

                		@endif
                			@foreach($orderValue as $k => $v)
                            @if($k != $articlesSection->ordervalue)
                			<option value="{{$k}}">{{$v}}</option>
                            @endif
                			@endforeach
                		</select>
                	</td>

                	<td>
                	@if($articlesSection->count==0)
                		<input type="number" name="count[]" value="5" class="input input-small">
                	@else
                		<input type="number" name="count[]" value="{{$articlesSection->count}}" class="input input-small">
                		
                	@endif
                	</td>
                	<td>
                		<a href="/manage/sitenav/sections/articleSection/{{$articlesSection->id}}/delete" class="button button-little bg-yellow"> <span class="icon-edit"> 删除</span></a>
                	</td>
                </tr>
                @endforeach
           </table>

           </div>
                
		</div>
        <div class="x12 padding-large-bottom margin-large-bottom">
             <table class="table table-striped table-bordered">
                 <tr align="center">
                     <td>
                         序号
                     </td>
                     <td>
                         标题
                     </td>
                     <td>
                         板块排序
                     </td>
                     <td>
                         操作
                     </td>

                 </tr>
                 @foreach($caseSections as $key => $value)
                 <tr align="center">
                     <td>
                         {{$key+1}}<input type="hidden" name="type[]" value="case"><input type="hidden" name="id[]" value="{{$value->id}}">
                     </td>
                     <td>
                         <input type="text" name="title[]" value="{{$value->title}}" class="input ">
                     </td>
                     <td>
                         <input type="number" name="order[]" value="{{$value->order}}" class="input">
                         <input type="hidden" name="orderkey[]">
                         <input type="hidden" name="ordervalue[]">
                         <input type="hidden" name="count[]">
                     </td>
                     <td>
                         <a class="button button-little bg-main" href="/manage/sitenav/sections/caseSection/{{$value->id}}/delete">删除</a>
                         &nbsp;
                         <a href="/manage/sitenav/sections/caseSection/list/{{$value->id}}" class="button button-little bg-yellow"> 管理</a>
                        
                     </td>
                 </tr>
                 @endforeach
             </table>
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