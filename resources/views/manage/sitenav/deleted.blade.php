@extends('manage.site')

@section('main')
<form method="POST" action="/manage/sitenav">
<div class="container bg-white margin-large-top">
    <div class="padding-large">
        <div class="line-big margin-large-bottom">
            <div class="x6">
                <ul class="bread">
                    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
                    <li>导航管理</li>
                </ul>
            </div>
            <div class="x6 text-right">
                <a href="/manage/sitenav" class="button icon-mail-reply bg-black margin-right"> 返回</a>
                <a href="/manage/sitenav/clear" class="button bg-blue icon-trash-o" title=""> 清空</a>
            </div>
        </div>

        @if($deletednav=="empty")
        <div class="x12 text-center padding-large"><span class="icon-info"> </span>回收站是空的。</div>
        @else
        <?php $s=1; ?>
        
        <div class="x12 padding-large-bottom margin-large-bottom">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <td align="center" width="60">序号</td>
                    <td align="center" width="*">名称</td>
                    <td align="center" width="150">导航类型</td>
                    <td align="center" width="100">恢复</td>
                </tr>
                @foreach($deletednav as $sitenavs)
                <tr class="bg-yellow-light">
                    <td align="center"><strong>{{ $s }}</strong><input type="hidden" name="id[]" value="{{ $sitenavs['first']['id'] }}"></td>
                    <td>{{$sitenavs->name}}</td>
                    <td align="center">@if($sitenavs->hierarchy=="1") <span class="icon-bars"> 菜单</span>@else <span class="icon-minus"> 子菜单</span> @endif</td>
                    <td align="center"><a href="/manage/sitenav/rcover/{{ $sitenavs->id }}" class="button button-little bg-yellow"> <span class="icon-edit"> 恢复</span></a></td>
                </tr>
                <?php $s++; ?>
                @endforeach
            </table>
        </div>
        </div>
        @endif

    </div>
</div>

{!! csrf_field() !!}
</form>

@stop

@section('extrajs')
<script type="text/javascript">
$(function(){
    $(".viewradio label input").click(function(){
        tthis = $(this);
        thisval = $(this).val();
        tthis.closest("div").prev().val(thisval);
    })
})
</script>
@stop