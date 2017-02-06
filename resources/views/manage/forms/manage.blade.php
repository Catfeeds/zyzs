@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
  <div class="padding-large">
    <form method="POST">
    <div class="line-big margin-large-bottom">
      <div class="x6">
        <ul class="bread">
            <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
            <li><a href="/manage/forms">自定义表单</a></li>
            <li>{{$form->title}}</li>
        </ul>
      </div>
      <div class="x6 text-right">
        <a href="/manage/main" class="button icon-mail-reply bg-black margin-right"> 返回</a>
        <!-- <a href="/manage/forms/create" class="button bg-little-yellow "> 新增表单</a> -->

      </div>
    </div>

    <div class="x12">
      <h1 class="padding-large-bottom border-bottom margin-large-bottom">
      <span class="icon-thumb-tack"> </span>自定义表单</h1>

      

      <div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr><?php $count = 0; ?>
                @foreach (json_decode($form->columns) as $key=>$value)
                  <td align="center" width="50">{{$value}}</td>
                  <?php $count++; ?>
                @endforeach
                </tr>
                @if($formsdata->count()>0)

                @foreach($formsdata as $key => $value)
                <tr>
                  @foreach(json_decode($value->data) as $k => $v)
                  <td>{{$v}}</td>
                  @endforeach
                </tr>
                @endforeach

                @else
                <tr><td colspan="{{$count}}" align="center">没有内容请添加</td></tr>
                @endif
            </table>
            </div>
    </div>

    <div class="x12 margin-large-bottom padding-large-bottom">
            <div class="x4 x2-move text-center"></div>
            <div class="x4 text-center"></div>
        </div>
    {!! csrf_field() !!}
    </form>

  </div>
</div>
@stop

@section('extrajs')


@stop