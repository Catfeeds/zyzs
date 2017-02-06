@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<div class="line-big margin-large-bottom">
			<div class="x10">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>后台首页</li>
				</ul>
			</div>
			<div class="x2 text-right">
			</div>
		</div>

		<div class="x12 margin-large-bottom bg-yellow-light text-center" style='min-height:500px;'><span style="line-height:500px;font-size:100px;"><img src="/imgs/admin.png" alt=""></span></div>
	</div>
</div>
@stop

@section('extrajs')

@stop