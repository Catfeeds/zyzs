@extends('manage.site')
@section('main')
<div class="container bg-white margin-large-top">
	<div class="padding-large">
		<form method="POST" action="/manage/sitenav/jobs/{{ $navigation->id }}">
		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav"></a>导航管理</li>
				    <li>内容管理</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/sitenav" class="button icon-mail-reply bg-black margin-right"> 返回</a>
				<a href="/manage/job/insert/{{ $navigation->id }}" class="button icon-file-o bg-yellow margin-right"> 新增职位</a>
        <button class="button bg-green icon-save" type="submit"> 保存修改</button>
			</div>
		</div>

		<div class="x12">
			<h1 class="padding-large-bottom border-bottom margin-large-bottom">
			<span class="icon-thumb-tack"> </span>“{{ $navigation->name }}” 中的所有职位：</h1>



			<div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="50">选择</td><td align="center">职位名称</td><td align="center" width="120">日期</td><td align="center" width="120">招聘人数</td><td align="center" width="120">工作地点</td><td align="center" width="120">排序</td><td align="center" width="90">是否显示</td><td align="center" width="70">删除</td><td align="center" width="70">修改</td></tr>
                @if($jobs->count()>0)
                @foreach ($jobs as $mt)
                <tr>
                <td align="center">
                <input class="icheckbox" name="selectid[]" type="checkbox" value="{{ $mt->id }}">
                </td>
                <td title="职位名称：" content="{{ $mt->jobname }}" class="tips" data-toggle="hover" data-place="top">{{ $mt->jobname }}<input name="id[]" type="hidden" value="{{ $mt->id }}"></td>
                <td>{{mb_substr($mt->published_at,0,10,'utf-8')}}</td>
                <td align="center"><input name="jobcount[]" value="{{$mt->jobcount}}" class="input input-small"></td>
                <td align="center"><input name="jobplace[]" value="{{$mt->jobplace}}" class="input input-small"></td>
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
                <td align="center"><a href="/manage/job/remove/{{ $mt->id }}" class="button button-little bg-main icon-trash-o" onclick="{if(confirm('删除本条数据，相关的评论、阅读量、赞等数据都将一同被删除，不会恢复请确认：')){return true;}return false;}"> 删除</a></td>
                <td align="center"><a href="/manage/job/update/{{ $mt->id }}" class="button button-little bg-yellow icon-edit"> 修改</a></td>
                </tr>
                @endforeach
                @else
                <tr><td colspan="9" align="center">没有找到职位，请添加</td></tr>
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
	$('form').attr('action','/manage/sitenav/jobbatchmove');
	$('form').submit();
}

function chooseremove(ids)
{
	$('form').attr('action','/manage/sitenav/jobbatchremove');
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