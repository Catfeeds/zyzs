@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
  <div class="padding-large">
    <form method="POST">
    <div class="line-big margin-large-bottom">
      <div class="x6">
        <ul class="bread">
            <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
            <li>案例风格管理</li>
        </ul>
      </div>
      <div class="x6 text-right">
        <a href="/manage/fengge/create" class="button icon-file-o bg-yellow margin-right"> 新建风格</a>
        <button class="button bg-green icon-save" type="submit"> 保存修改</button>
      </div>
    </div>

    <div class="x12">
      <h1 class="padding-large-bottom border-bottom margin-large-bottom">
      <span class="icon-thumb-tack"> </span>首页大背景图</h1>

      

      <div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr>
                  <td align="center" width="50">序号</td>
                  <td align="center" width="150">风格标题</td>
                  <td align="center" width="50">风格url</td>
                  <td align="center" width="50">排序</td>
                  <td align="center" width="70">删除</td></tr>
                @if($fengge->count()>0)
                @foreach ($fengge as $key=>$value)
                <tr>
                <td align="center">
                  {{$key+1}}<input type="hidden" name="id[]" value="{{$value->id}}">
                </td>
                <td>
                  <input type="text" name="title[]" class="input input-small" value="{{$value->title}}">
                </td>
                <td align="center">
                <input type="text" name="nickname[]" class="input input-small" value="{{$value->nickname}}">
                </td>
                <td>
                  <input type="number" name="index[]" class="input input-small" value="{{$value->index}}">
                </td>
                <td align="center"><a href="/manage/fengge/{{ $value->id }}/delete" class="button button-little bg-main icon-trash-o" onclick="{if(confirm('删除后不可恢复：')){return true;}return false;}"> 删除</a></td>
                
                </tr>
                @endforeach
                @else
                <tr><td colspan="5" align="center">没有内容请添加</td></tr>
                @endif
            </table>
            </div>
    </div>

    <div class="x12 margin-large-bottom padding-large-bottom">
            <div class="x4 x2-move text-center"><button class="button bg-gray button-big win-refresh icon-refresh" type="button"> 重新载入</button></div>
            <div class="x4 text-center"><button class="button bg-green button-big icon-save" type="submit"> 保存修改</button></div>
        </div>
    {!! csrf_field() !!}
    </form>

  </div>
</div>
@stop


