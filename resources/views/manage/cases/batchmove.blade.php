@extends('manage.site')

@section('main')
<div class="container bg-white margin-large-top">
    <div class="padding-large">
        <div class="line-big margin-large-bottom">
            <div class="x10">
                <ul class="bread">
                    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
                    <li><a href="/manage/sitenav"> 导航管理</a> </li>
                    <li>数据批量转移</li>
                </ul>
            </div>
            <div class="x2 text-right">
                <a href="/manage/case/{{ $moveacasesparentid->nav_id }}" class="button icon-mail-reply bg-black"> 返回重选</a>
            </div>
        </div>

        <div class="x12">
            <h1 class="padding-large-bottom border-bottom margin-large-bottom">
            <span class="icon-thumb-tack"> </span>您希望将以下数据转移到哪里？请选择:</h1>

            @if(count($resivenav)>0)
            <div class="padding-large-bottom clearfix">
            <form method="POST" action="/manage/sitenav/casebatchmove/store">
                <div class="button-group border-blue radio viewradio">
                    <?php $si = 1; ?>
                    @foreach($resivenav as $choosemenus)
                    <label class="button @if($si=="1") active @endif">
                        <input name="nav_id" value="{{ $choosemenus->id }}" @if($si=="1")checked="checked" @endif type="radio"> @if($choosemenus->hierarchy=="1") <span class="icon-bars"> </span> @elseif($choosemenus->hierarchy=="2") ├ @endif {{ $choosemenus->name }}
                    </label>
                    <?php $si++; ?>
                    @endforeach
                </div>              
                <div class="padding-large-top">
                <button class="button bg-blue icon-random" type="submit"> 开始转移</button>
                </div>
                <?php $movecasesd=$movecases; ?>
                @foreach($movecasesd as $move)
                <input name="id[]" type="hidden" value="{{ $move->id }}">
                @endforeach
                <input name="returnid" type="hidden" value="{{ $moveacasesparentid->nav_id }}">
            {!! csrf_field() !!}
            </form>
            </div>
            @endif


            <h1 class="padding-large-bottom border-bottom margin-large-bottom">
            <span class="icon-thumb-tack"> </span>以下是您选中的案例：</h1>

            <div class="table-responsive padding-large-bottom articletable">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="100">序号</td><td align="center">标题</td><td align="center" width="180">类目</td></tr>
                <?php $s2=1; ?>
                @if($movecases!=="empty")
                @foreach ($movecases as $mt)
                <tr>
                <td align="center">{{ $s2 }}</td>
                <td>{{ $mt->title }}</td>
                <td align="center">{{ $nav->name }}</td>
                </tr>
                <?php $s2++; ?>
                @endforeach
                @else
                <tr><td colspan="12">暂无</td></tr>
                @endif
            </table>
            </div>

        </div>

    </div>
</div>
@stop