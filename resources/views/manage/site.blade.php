<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>后台管理</title>
@include('manage.pubcss')
@yield('extracss')
</head>
<body>

@include('manage.header')
@yield('main')
@include('manage.footer')

@include('manage.pubjs')
@yield('extrajs')
<script type="text/javascript">
<?php $s = Session::get('returnmsg') ?>
    @if(!empty($s))
    alerts("<?php echo $s ?>",2000);
    @endif
	@if (count($errors) > 0)
    alerts("<span class='icon-exclamation-triangle text-main'> </span>保存失败：{{ $errors->first() }}请重新配置！",5000); 
    @endif
</script>
</body>
</html>