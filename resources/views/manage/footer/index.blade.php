@extends('manage.site')

@section('main')
<form method="POST" action="/manage/footer">
<div class="container bg-white margin-large-top">
    <div class="padding-large">
        <div class="line-big margin-large-bottom">
            <div class="x6">
                <ul class="bread">
                    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
                    <li>页脚设置</li>
                </ul>
            </div>
            <div class="x6 text-right">
                <a href="/manage/main" class="button icon-mail-reply bg-black margin-right"> 返回</a> 
            </div>
        </div>

        @if($managesitenav=="empty")
        <div class="x12 text-center padding-large"><span class="icon-info"> </span>没有导航数据，请点击右上角“新增导航”开始制作。</div>
        @else
        <?php $s=1; ?>
        @foreach($managesitenav as $sitenavs)
        <div class="x8 x2-move padding-large-bottom margin-large-bottom">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="60">序号</td><td align="center" width="200">导航名称</td><td align="center">页面形式</td><td align="center" width="200">是否在页脚显示</td></tr>

                <tr class="bg-yellow-light"><td align="center"><strong>{{ $s }}</strong><input type="hidden" name="id[]" value="{{ $sitenavs['first']['id'] }}"></td>
                <td>@if($sitenavs['first']['pagestyle']=="0") <span class="icon-bars text-gray"></span> @else <span class="icon-th-large text-gray"> </span> @endif <strong>{{ $sitenavs['first']['name'] }}</strong></td>
                
                <td>
                {{$sitenavs['first']['typename']}}
                </td>
                <td align="center">
                	<input type="hidden" name="footershow[]" value="{{ $sitenavs['first']['footershow'] }}">
                    <div class="button-group button-group-little border-blue radio viewradio">
                        <label class="button @if($sitenavs['first']['footershow']==1) active @endif">
                            <input name="footershows[]" value="1" @if($sitenavs['first']['footershow']==1) checked="checked" @endif type="radio"> 显示
                        </label>
                        <label class="button @if($sitenavs['first']['footershow']==0) active @endif">
                            <input name="footershows[]" value="0" @if($sitenavs['first']['footershow']==0) checked="checked" @endif type="radio"> 隐藏
                        </label>
                    </div>
                </td>
                </tr>
                
                @if($sitenavs['first']['type']=="menu")
                @if($sitenavs['sub']!=="empty")
                <?php $ss=1; ?>
                @foreach($sitenavs['sub'] as $subnav)
                <tr><td><input type="hidden" name="id[]" value="{{ $subnav['id'] }}"></td><td><span class="text-gray">├</span> {{ $subnav['name'] }}</td>
                <td>
                {{$subnav['typename']}}
                </td>
                <td align="center">
                	<input type="hidden" name="footershow[]" value="{{ $subnav['footershow'] }}">
                	<div class="button-group button-group-little border-blue radio viewradio">
                        <label class="button @if($subnav['footershow']==1) active @endif">
                            <input name="footershows[]" value="1" @if($subnav['footershow']==1) checked="checked" @endif type="radio"> 显示
                        </label>
                        <label class="button @if($subnav['footershow']==0) active @endif">
                            <input name="footershows[]" value="0" @if($subnav['footershow']==0) checked="checked" @endif type="radio"> 隐藏
                        </label>
                    </div>
                </td>
                </tr>
                <?php $ss++; ?>
                @endforeach
                @else
                <tr><td colspan="4" align="center"><span class="text-main icon-warning "> </span>无子菜单</td></tr>
                @endif
                @endif
            </table>
        </div>
        </div>
        <?php $s++; ?>
        @endforeach

        <div class="x12 margin-large-bottom padding-large-bottom">
            <div class="x4 x2-move text-center"><button class="button bg-gray button-big win-refresh icon-refresh" type="button"> 重新载入</button></div>
            <div class="x4 text-center"><button class="button bg-green button-big icon-save" type="submit"> 保存修改</button></div>
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