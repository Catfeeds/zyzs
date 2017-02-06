@extends('manage.site')

@section('main')
<form method="post">
<div class="container bg-white margin-large-top">
	<div class="padding-large">

		<div class="line-big margin-large-bottom">
			<div class="x6">
				<ul class="bread">
				    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
				    <li><a href="/manage/sitenav">导航管理</a></li>
				    <li>{{$team->title}}</li>
				</ul>
			</div>
			<div class="x6 text-right">
				<a href="/manage/sitenav" class="button icon-mail-reply bg-black margin-right"> 返回</a>
				<button class="button bg-green icon-save" type="submit"> 保存</button>
			<a  class="button bg-yellow icon-file-o" href="/manage/teams/{{$team->id}}/create"> 新建成员</a>
			</div>
		</div>

		<div class="x12">
			<div class="form-group padding-large-bottom">
				<div class="padding-large-bottom border-bottom margin-little-bottom"><h1><span class="icon-edit"> </span>团队管理 - {{$team->title}}</h1></div>
			</div>

			@if($team->members->count()>0)
			<div class="padding-large-bottom border-bottom margin-large-bottom">
			<button type="button" class="button margin-right icon-check-square-o checkselectall"> 全选</button>
			<button type="button" class="button margin-right icon-square-o checkunselectall"> 全不选</button>
			<button type="button" class="button margin-right icon-check-square checkunselect"> 反选</button>
			<button type="button" class="button icon-trash-o bg-main margin-right checkselectremove"> 删除选中</button>
			
			</div>
			@endif
			
		</div>

		<div class="x12">
			
			
			<p>&nbsp;{{csrf_field()}}</p>
		
		

		<div class="x12 hide">
			<div class="form-group">
				<label for="introduce">团队介绍</label>
				<textarea class="input" name="introduce">--</textarea>
			</div>
		</div>

		<div class="x12 padding-large-bottom margin-large-bottom">
	        <div class="table-responsive">
	            <table class="table table-striped table-bordered">
	                <tr>
	                	<td align="center" width="60"></td>
	                	<td align="center" width="60">序号</td>
	                	<td align="center" width="200">姓名</td>
	                	<td align="center" width="80">职务</td>
	                	<td align="center" width="80">排序</td>
	                	<td align="center" width="60">修改</td>
	                	<td align="center" width="60">删除</td>
	                </tr>

	                @foreach($team->members as $xu => $key)
	                <tr align="center">
		                <td align="center">
		                  <input class="icheckbox" name="selectid[]" type="checkbox" value="{{ $key->id }}">
		                </td>
	                	<td>{{$xu+1}}<input type="hidden" class="input" name="id[]" value="{{$key->id}}"></td>
	                	<td>{{$key->name}}</td>
	                	<td>{{$key->zhiwu}}</td>
	                	<td><input type="number" name="order[]" class="input input-small" value="{{$key->order}}"></td>
	                	<td><a class="button bg-yellow button-little icon-edit" href="/manage/teams/member/{{$key->id}}/edit"> 修改</a></td>
	                	<td><a class="button bg-blue button-little icon-trash-o" href="/manage/teams/member/{{$key->id}}/delete"> 删除</a></td>

	                </tr>

	                @endforeach


	           </table>
	        </div>
        </div>
			
                
         

		

		
	</div>
</div>
</form>
@stop

@section('extrajs')
<script type="text/javascript">
function chooseamenu(ids){
	$('form').attr('action','');
	$('form').submit();
}

function chooseremove(ids)
{
	$('form').attr('action','/manage/memberremovemany');
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
<script type="text/javascript">
$(function(){
	$(".select-section").hide();
	$(".select-section-button").click(function(){
		$(".select-section").toggle();
	})
})
</script>
@stop