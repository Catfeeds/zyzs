<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
@yield('extrameta')
@if(!empty($favicon))<link rel="shortcut icon" href="/favicon.ico" />
@endif
@yield('seo')
@include('layouts.pubcss')
@yield('extracss')
</head>
<body>
<div class="body">
@include('layouts.header')
@yield('main')
</div>
@include('layouts.footer')
@include('layouts.pubjs')
@yield('extrajs')
</body>
</html>