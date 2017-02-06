@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/indexcase">首页案例</a></li>
				    <li>挑选首页案例</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/indexcase" class="button icon-mail-reply bg-black margin-right"> 返回</a>
        <button class="button bg-green icon-save" type="submit"> 添加</button>
			</div>
		</div>

		<div class="x12">
			<h1 class="padding-large-bottom border-bottom margin-large-bottom">
			<span class="icon-thumb-tack"> </span>可以选择到首页案例：</h1>

			

			<div class="table-responsive padding-large-bottom casetable">
            <table class="table table-striped table-bordered">
                <tr align="center"><td align="center" width="50">选择</td><td align="center" width="100">标题</td><td align="center" width="80">预览</td>
                </tr>
                @if($cases->count()>0)
                @foreach ($cases as $case)
                <tr align="center">
                <td align="center">
                <input class="icheckbox" name="selectid[]" type="checkbox" value="{{ $case->id }}">
                </td>
                <td align="center">{{$case->title}}</td>
                <td align="center"><a target="_blank" href="/case-view-{{$case->id}}.html" class="button button-little bg-main">预览</a></td>
                </tr>
                @endforeach
                @else
                <tr><td colspan="8" align="center">没有找到案例，请添加</td></tr>
                @endif
            </table>
            </div>
		</div>
    <div class="x12 margin-large-bottom text-center">
        {!!$cases->links()!!}
    </div>
		<div class="x12 margin-large-bottom padding-large-bottom">
            <div class="x4 x2-move text-center"><button class="button bg-gray button-big win-refresh icon-refresh" type="button"> 重新载入</button></div>
            <div class="x4 text-center"><button class="button bg-green button-big icon-save" type="submit"> 确认添加到首页</button></div>
        </div>
		{!! csrf_field() !!}
		</form>

	</div>
</div>
@stop

@section('extrajs')

@stop