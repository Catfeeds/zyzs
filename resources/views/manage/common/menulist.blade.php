@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="/manage/common/menu">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>分类管理</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/main" class="button icon-mail-reply bg-black margin-right"> 返回</a>
        <a href="/manage/common/menu/insert" class="button bg-yellow icon-file-o margin-right" title=""> 新增分类</a>
        <button class="button bg-green icon-save" type="submit"> 保存修改</button>
			</div>
		</div>

		<div class="x12">

			@if($menu!=="empty")
			<div class="padding-large-bottom border-bottom margin-large-bottom">
  			<button type="button" class="button margin-right icon-check-square-o checkselectall"> 全选</button>
  			<button type="button" class="button margin-right icon-square-o checkunselectall"> 全不选</button>
  			<button type="button" class="button margin-right icon-check-square checkunselect"> 反选</button>
  			<button type="button" class="button icon-trash-o bg-main checkselectremove"> 删除选中</button>
			</div>
			@endif

			<div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="50">选择</td><td align="center">名称</td><td align="center" width="160">日期</td><td align="center" width="80">位号</td><td align="center" width="120">是否显示</td><td align="center" width="100">删除</td><td align="center" width="100">管理</td></tr>
                @if($menu!=="empty")
                @foreach ($menu as $mt)
                <tr>
                <td align="center">
                <input class="icheckbox" name="selectid[]" type="checkbox" value="{{ $mt->id }}">
                </td>
                <td><input name="name[]" value="{{ $mt->name }}" class="input input-small"><input name="id[]" type="hidden" value="{{ $mt->id }}"></td>
                <td><input name="published_at[]" value="{{ $mt->published_at }}" class="input input-small published_at"></td>
                <td align="center">
                <input name="weihao[]" value="{{ $mt->weihao }}" class="input input-small">
                </td> 
                <td align="center">
                  <input type="hidden" name="showsnot[]" value="{{ $mt->showsnot }}">
                  <div class="button-group button-group-little border-blue radio viewradio">
                        <label class="button @if($mt->showsnot=='1') active @endif ">
                            <input name="showsnots[]" value="1" @if($mt->showsnot=='1') checked="checked" @endif type="radio"> 显示
                        </label>
                        <label class="button @if($mt->showsnot=='0') active @endif ">
                            <input name="showsnots[]" value="0" @if($mt->showsnot=='0') checked="checked" @endif type="radio"> 隐藏
                        </label>
                    </div>
                </td> 
                <td align="center"><a href="/manage/common/menu/remove/{{ $mt->id }}" class="button button-little bg-main icon-trash-o" onclick="{if(confirm('删除本条数据后不可恢复，请确认：')){return true;}return false;}"> 删除</a></td>
                <td align="center"><a href="/manage/common/list/{{ $mt->id }}" class="button button-little bg-yellow icon-eye"> 内容管理</a></td>
                </tr>
                @endforeach
                @else
                <tr><td colspan="7" align="center">暂无分类 </td></tr>
                @endif
            </table>
            </div>

        <div class="x12 margin-large-bottom padding-large-bottom border-top padding-large-top margin-large-top border-dashed">
          <div class="x4 x2-move text-center"><button class="button bg-gray button-big win-refresh icon-refresh" type="button"> 重新载入</button></div>
          <div class="x4 text-center"><button class="button bg-green button-big icon-save" type="submit"> 提交数据</button></div>
        </div>
		</div>
		{!! csrf_field() !!}
		</form>

	</div>
</div>
@stop

@section('extrajs')
<script type="text/javascript">
function chooseamenu(ids){
	$('form').attr('action','/manage/sitenav/productbatchmove');
	$('form').submit();
}

function chooseremove(ids)
{
	$('form').attr('action','/manage/common/menu/batchremove');
	$('form').submit();
}

$(function(){
    $('.published_at').datetimepicker({
      lang:'ch',
      format:'Y-m-d H:i:00',
      formatDate:'Y-m-d'
    });
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