@extends('layouts.base')
@section('main')
<?php $s = Session::get('errmsg'); ?>
<?php 
if($s["report"]=="error")
{
	$reportimg = "icon-warning";
	$reportmsg = "操作失败：".$s["errmsg"];
	$reportcolor = "text-main";
	$reportlocation = $s["location"];
} elseif($s["report"]=="succeed") {
	$reportimg = "icon-check-square-o";
	$reportmsg = "操作成功：".$s["errmsg"];
	$reportcolor = "text-green";
	$reportlocation = $s["location"];
} else {
	$reportimg = "icon-chain-broken";
	$reportmsg = "反馈已阅读，本链接失效";
	$reportcolor = "text-gray";
	$reportlocation = "/";
}

?>
<div class="text-center bg-white <?php echo $reportcolor ?>" style="padding-top:50px;">
<div><span class="<?php echo $reportimg ?> " style="font-size:200px;"></span></div>
<h2><?php echo $reportmsg; ?> </h2>
</div>
<div class="text-center bg-white">
<div class="padding-top text-gray">页面将于 <span id="jumpTo">5</span> 秒后跳转</div>
<div class="padding-top"><a href="<?php echo $reportlocation ?>" class="button border-gray">立即跳转</a></div>
</div>
@stop
@section('extrajs')
<script type="text/javascript">
function countDown(secs,surl){     
 //alert(surl);     
 var jumpTo = document.getElementById('jumpTo');
 jumpTo.innerHTML=secs;  
 if(--secs>0){     
     setTimeout("countDown("+secs+",'"+surl+"')",1000);     
     }     
 else{       
     location.href=surl;     
     }     
 }
countDown(5,'<?php echo $reportlocation; ?>');
</script>
@stop
@section('extrameta')
<meta http-equiv="refresh" content="5;url=<?php echo $reportlocation; ?>" />
@stop