@extends('layouts.site')

@section('main')
@include('sub.insidebanner')
<div class="container margin-big-top">
<div class="line-big">
<div class="xm9 xs12 xl12">
@include('sub.main')
</div>
<div class="xm3 xs12 hidden-l hidden-s site-aside">
@include('sub.aside')
</div>

</div>
</div>
@stop