@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav">导航管理</a></li>
				    <li>案例管理</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/sitenav" class="button icon-mail-reply bg-black margin-right"> 返回</a>
				<a href="/manage/case/{{ $navigation->id }}/insert" class="button icon-file-o bg-yellow margin-right"> 新增案例</a>
        <button class="button bg-green icon-save" type="submit"> 保存修改</button>
			</div>
		</div>

		<div class="x12">
			<h1 class="padding-large-bottom border-bottom margin-large-bottom">
			<span class="icon-thumb-tack"> </span>“{{ $navigation->name }}” 中的所有案例：</h1>

			@if($cases->count()>0)
			<div class="padding-large-bottom border-bottom margin-large-bottom">
			<button type="button" class="button margin-right icon-check-square-o checkselectall"> 全选</button>
			<button type="button" class="button margin-right icon-square-o checkunselectall"> 全不选</button>
			<button type="button" class="button margin-right icon-check-square checkunselect"> 反选</button>
			<button type="button" class="button margin-right icon-random bg-blue checkselectmove"> 转移选中</button>
			<button type="button" class="button icon-trash-o bg-main checkselectremove"> 删除选中</button>
			</div>
			@endif

			<div class="table-responsive padding-large-bottom casetable">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="50">选择</td><td align="center" width="100">标题</td><td align="center" width="80">户型</td><td align="center" width="80">排序</td>
                <td width="50">
                  首页显示
                </td><td align="center" width="70">浏览</td><td align="center" width="70">删除</td><td align="center" width="70">修改</td></tr>
                @if($cases->count()>0)
                @foreach ($cases as $case)
                <tr>
                <td align="center">
                <input class="icheckbox" name="selectid[]" type="checkbox" value="{{ $case->id }}">
                <input type="hidden" name="type" value="{{$case->type}}">
                </td>
                <td title="标题：" content="{{ $case->title }}" class="tips" data-toggle="hover" data-place="top">
                <input type="text" name="title[]" value="{{ $case->title }}" class="input input-small">
                <input name="id[]" type="hidden" value="{{ $case->id }}"></td>
                <td>{{ $case->huxing }}</td>
                <td align="center">
                <input name="order[]" value="{{ $case->order }}" class="input input-small">
                </td>
                <td>
                  <select name="indexshow[]" class="input input-small">
                      @if($case->indexshow == 1)
                      <option value="1">显示</option>
                      <option value="0">不显示</option>
                      @else
                      <option value="0">不显示</option>
                      <option value="1">显示</option>
                      @endif
                  </select>
                </td>
                
                <td align="center">@if(true)<a href="/case-view-{{ $case->id }}.html" class="button button-little bg-blue icon-file-text-o" target="_blank"> 浏览</a>@else<span class="icon-lock text-gray"> 隐藏</span>@endif</td>
                <td align="center"><a href="/manage/case/{{ $case->id }}/delete" class="button button-little bg-main icon-trash-o" onclick="{if(confirm('删除本条数据，相关的评论、阅读量、赞等数据都将一同被删除，不会恢复请确认：')){return true;}return false;}"> 删除</a></td>
                <td align="center"><a href="/manage/case/{{$case->id}}/edit" class="button button-little bg-yellow icon-edit"> 修改</a></td>
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
            <div class="x4 text-center"><button class="button bg-green button-big icon-save" type="submit"> 保存修改</button></div>
        </div>
		{!! csrf_field() !!}
		</form>

	</div>
</div>
@stop

@section('extrajs')
<script type="text/javascript">
function chooseamenu(ids){
	$('form').attr('action','/manage/sitenav/casebatchmove');
	$('form').submit();
}

function chooseremove(ids)
{
	$('form').attr('action','/manage/sitenav/casebatchremove');
	$('form').submit();
}

$(function(){
    $('.icheckbox').iCheck({
	    checkboxClass: 'icheckbox_flat-red',
	    radioClass: 'iradio_flat-red'
  	});

  	$('.checkselectall').click(function(){
  		$('.icheckbox').iCheck('check');
  	})

  	$('.checkunselectall').click(function(){
  		$('.icheckbox').iCheck('uncheck');
  	})

  	$('.checkunselect').click(function(){
  		$('.icheckbox').each(function(){
  			$(this).iCheck('toggle');
  		})
  	})

  	$('.checkselectmove').click(function(){
  		str = "";
  		ids = "";
  		$('.icheckbox').each(function(){
  			if(true == $(this).is(':checked')){
  				str+=$(this).val()+"|";
  			}
  		});
  		if(str.length>0){
		if(str.substr(str.length-1)== '|'){
		    ids = str.substr(0,str.length-1);
		}
		ids = ids.split("|");
  		chooseamenu(ids);
	  	} else {
	  		alerts('<span class=\'icon-exclamation-triangle\'> </span> 请先选择您要转移的数据！',5000);
	  	}
  	})

  	$('.checkselectremove').click(function(){
  		str = "";
  		ids = "";
  		$('.icheckbox').each(function(){
  			if(true == $(this).is(':checked')){
  				str+=$(this).val()+"|";
  			}
  		});
  		if(str.length>0){
		if(str.substr(str.length-1)== '|'){
		    ids = str.substr(0,str.length-1);
		}
		ids = ids.split("|");
		if(confirm('您确定要删除这些数据吗？删除后将无法恢复')){
			chooseremove(ids);
		} else {
			return false;
		}
	  	} else {
	  		alerts('<span class=\'icon-exclamation-triangle\'> </span> 请先选择您要删除的数据！',5000);
	  	}
  	})

  	$(".viewradio label input").click(function(){
        tthis = $(this);
        thisval = $(this).val();
        tthis.closest("div").prev().val(thisval);
    })
  	
  	<?php $s = Session::get('returnmsg') ?>
    @if(!empty($s))
    alerts("<?php echo $s ?>",5000);
    @endif

    @if (count($errors) > 0)
        alerts("<span class='icon-exclamation-triangle text-main'> </span>保存失败：{{ $errors->first() }}请重新配置！",5000); 
    @endif
})
</script>
@stop