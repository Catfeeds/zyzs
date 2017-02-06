<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('extrameta')
@if(!empty($favicon))<link rel="shortcut icon" href="/favicon.ico" />
@endif
@yield('seo')
@include('layouts.front.pubcss')
@yield('extracss')
</head>
<body>
<div class="body">
@include('layouts.front.header')
@yield('content')

@include('layouts.front.footer')

</div>
@include('layouts.front.pubjs')
@yield('extrajs')
</body>
</html>