@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="/manage/banner ">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li>首页Banner管理</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/main" class="button icon-mail-reply bg-black margin-right"> 返回</a>
				<a href="/manage/banner/insert" class="button icon-file-o bg-yellow margin-right"> 新增Banner</a>
        <button class="button bg-green icon-save" type="submit"> 保存修改</button>
			</div>
		</div>

		<div class="x12">
			<h1 class="padding-large-bottom border-bottom margin-large-bottom">
			<span class="icon-thumb-tack"> </span>首页Banner：</h1>

			@if($bannerlist!=="empty")
			<div class="padding-large-bottom border-bottom margin-large-bottom">
			<button type="button" class="button margin-right icon-check-square-o checkselectall"> 全选</button>
			<button type="button" class="button margin-right icon-square-o checkunselectall"> 全不选</button>
			<button type="button" class="button margin-right icon-check-square checkunselect"> 反选</button>
			<button type="button" class="button icon-trash-o bg-main checkselectremove"> 删除选中</button>
			</div>
			@endif

			<div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="50">选择</td><td align="center" width="120">预览</td><td>
                  移动端小图
                </td><td align="center">链接</td><td align="center" width="120">日期</td><td align="center" width="120">排序</td><td align="center" width="120">是否显示</td><td align="center" width="70">删除</td></tr>
                @if($bannerlist!=="empty")
                @foreach ($bannerlist as $mt)
                <tr>
                <td align="center">
                  <input class="icheckbox" name="selectid[]" type="checkbox" value="{{ $mt->id }}">
                </td>
                <td class="text-center" align="center">
                  <img src="{{ $mt->filepath }}" style="max-height:45px;padding:10px;margin: 0 auto;">
                  <input name="id[]" type="hidden" value="{{ $mt->id }}">
                </td>
                <td>
                  <img src="{{ $mt->mfilepath }}" style="max-height:45px;padding:10px;margin:0 auto;">
                </td>
                <td><input name="alink[]" value="{{$mt->alink}}" class="input input-small"></td>
                <td title="发布日期：" content="{{ $mt->published_at }}<br>{{ $mt->published_at->diffForHumans() }}" class="tips" data-toggle="hover" data-place="top" align="center">{{ $mt->published_at->diffForHumans() }}</td>
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
                <td align="center"><a href="/manage/banner/remove/{{ $mt->id }}" class="button button-little bg-main icon-trash-o" onclick="{if(confirm('删除后不可恢复：')){return true;}return false;}"> 删除</a></td>
                
                </tr>
                @endforeach
                @else
                <tr><td colspan="8" align="center">没有首页banner图片</td></tr>
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
<script type="text/javascript">
function chooseamenu(ids){
	$('form').attr('action','/manage/bannerbatchmove');
	$('form').submit();
}

function chooseremove(ids)
{
	$('form').attr('action','/manage/bannerbatchremove');
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