@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>预约管理</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/main" class="button icon-mail-reply bg-black margin-right"> 返回</a>
			</div>
		</div>

		<div class="x12">
			<h1 class="padding-large-bottom border-bottom margin-large-bottom">全部预约</h1>

			

			<div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr align="center">
                  <td>
                    服务类型
                  </td>
                  <td>
                    称呼
                  </td>
                  <td>
                    联系方式
                  </td>
                  <td>
                    小区
                  </td>
                  <td>
                    住房面积
                  </td>
                  <td>
                    留言内容
                  </td>
                  <td>
                    状态
                  </td>
                  <td>
                    操作
                  </td>
                </tr>

                @foreach($yuyues as $yuyue)
                <tr align="center">
                  <td>{{$yuyue->service}}</td>
                  <td>{{$yuyue->name}}</td>
                  <td>{{$yuyue->phone}}</td>
                  <td>{{$yuyue->xiaoqu}}</td>
                  <td>
                    {{$yuyue->mianji}}
                  </td>
                  <td>
                    @if(strlen($yuyue->content)>0)
                    <button class="button button-small bg-main dialogs" data-toggle="click" data-target="#mydialog{{$yuyue->id}}" data-mask="1" data-width="50%">
  查看</button>
                    @else
                    <span >无</span>
                    @endif
                  </td>
                  <td>
                    @if($yuyue->status==0)
                    <a href="/manage/yuyue/{{$yuyue->id}}/yidu" class="button button-small bg-blue">标为已读</a>
                    @else
                    <span class="text-green">已读</span>
                    @endif
                  </td>
                  <td align="center"><a href="/manage/yuyue/{{$yuyue->id}}/delete" class="button button-xs bg-little-blue delete">删除</a></td>
                </tr>
                @endforeach
            </table>
            </div>
            <div class="x12">
              {{$yuyues->links()}}
            </div>
            <div class="x12">
              <br><br>
            </div>
		</div>
	

	</div>
</div>
@foreach($yuyues as $yuyue)
<div id="mydialog{{$yuyue->id}}">
  <div class="dialog">
    <div class="dialog-head">
      <span class="close rotate-hover"></span><strong>留言内容</strong>
    </div>
    <div class="dialog-body">
      {{$yuyue->content}}</div>
    <div class="dialog-foot">
      <button class="button dialog-close">
        关闭</button>
    </div>
  </div>
</div>
@endforeach
@stop

@section('extrajs')

@stop