@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="/manage/feedback/list/">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>留言管理</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/main" class="button icon-mail-reply bg-black margin-right"> 返回</a>
			</div>
		</div>

		<div class="x12">
			<h1 class="padding-large-bottom border-bottom margin-large-bottom">全部留言</h1>

			@if($lists!=="empty")
			<div class="padding-large-bottom border-bottom margin-large-bottom">
			<button type="button" class="button margin-right icon-check-square-o checkselectall"> 全选</button>
			<button type="button" class="button margin-right icon-square-o checkunselectall"> 全不选</button>
			<button type="button" class="button margin-right icon-check-square checkunselect"> 反选</button>
			<button type="button" class="button icon-trash-o bg-main checkselectremove"> 删除选中</button>
			</div>
			@endif

			<div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="50">选择</td><td align="center" width="100">称呼</td><td align="center" width="150">联系方式</td><td align="center">留言内容</td><td align="center" width="100">日期</td><td align="center" width="100">展示</td><td align="center" width="70">删除</td><td align="center" width="70">查看</td></tr>
                @if($lists!=="empty")
                @foreach ($lists as $mt)
                <tr>
                <td align="center">
                <input class="icheckbox" name="selectid[]" type="checkbox" value="{{ $mt->id }}">
                </td>
                <td align="center">{{ $mt->name }}<input name="id[]" type="hidden" value="{{ $mt->id }}"></td>
                <td align="center">{{ $mt->contact}}</td>
                <td title="留言内容：" content="{{ $mt->content }}<br>{{ $mt->published_at->diffForHumans() }}" class="tips" data-toggle="hover" data-place="top"><div class="tdoverhideen">{{ strip_tags($mt->content) }}</div></td>
                <td title="发布日期：" content="{{ $mt->published_at }}<br>{{ $mt->published_at->diffForHumans() }}" class="tips" data-toggle="hover" data-place="top" align="center">{{ $mt->published_at->diffForHumans() }}</td>
                <td align="center">
                	@if($mt->showsnot=="1") <span class="icon-check text-green"> 展示中</span> @else 
                   未展示 @endif
                </td>                
                <td align="center"><a href="/manage/feedback/remove/{{ $mt->id }}" class="button button-little bg-main icon-trash-o" onclick="{if(confirm('删除本条数据后不可恢复，请确认：')){return true;}return false;}"> 删除</a></td>
                <td align="center"><a href="/manage/feedback/view/{{ $mt->id }}" class="button button-little bg-yellow icon-eye"> 查看</a></td>
                </tr>
                @endforeach
                @else
                <tr><td colspan="8" align="center">暂无留言</td></tr>
                @endif
            </table>
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
	$('form').attr('action','/manage/feedback/batchremove');
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