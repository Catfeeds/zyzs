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
        <a href="/manage/forms" class="button icon-mail-reply bg-black margin-right"> 返回</a>
        <button type="button" class="button margin-right bg-yellow createnew">新增列</button>
        <button class="button bg-green icon-save" type="submit"> 保存修改</button>
      </div>
    </div>

    <div class="x12">
      <h1 class="padding-large-bottom border-bottom margin-large-bottom">
      <span class="icon-thumb-tack"> </span>编辑: {{$form->title}}</h1>

      

      <div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr>
                  <td align="center" width="150">字段名</td>
                  <td align="center" width="70">删除</td></tr>
                @if($form->columns!=null&&$form->columns!="")
                @foreach (json_decode($form->columns) as $key=>$value)
                <tr>
                <td>
                  <input type="text" name="colum[]" value="{{$value}}" class="input input-small">
                </td>
                <td align="center"><a class="button button-little bg-main icon-trash-o deletecolumn"> 删除</a></td>
                
                </tr>
                @endforeach
                @else
                <tr class="nodata"><td colspan="2" align="center">没有内容请添加</td></tr>
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

@section('extrajs')
<script>
    

    $(".deletecolumn").click(function(){
              $(this).parents("tr").remove();
              return false;
            })

    $(function(){
        $(".createnew").click(function(){
            var html = "<tr>"+
                  "<td align=\"center\" width=\"150\"><input type=\"text\" name=\"colum[]\" value=\"\" class=\"input input-small\"></td>"+
                  "<td align=\"center\" width=\"70\"><a href=\"#\" class=\"button button-little bg-main icon-trash-o deletecolumn\"> 删除</a></td></tr>";
            $("table.table").append(html);
            $(".nodata").remove();
            $(".deletecolumn").click(function(){
              $(this).parents("tr").remove();
              return false;
            })
            return false;
        })
    })
</script>
@stop