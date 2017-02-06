<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
@yield('extrameta')
@yield('seo')
@include('manage.pubcss')
@yield('extracss')
</head>
<body>
@yield('main')
@include('manage.pubjs')
@yield('extrajs')
</body>
</html>