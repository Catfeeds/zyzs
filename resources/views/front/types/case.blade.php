
<div class="cases-category">
    <a href="/{{$navigation->parent->nickname}}/{{$navigation->nickname}}">
        <span @if($current_fengge=='empty') class="active" @endif>所有风格</span> 
    </a>
    @foreach($fengge as $key)
    <a href="/{{$navigation->parent->nickname}}/{{$navigation->nickname}}/{{$key->nickname}}">
        <span @if($current_fengge==$key->nickname) class="active" @endif>{{$key->title}}</span>
    </a>
    @endforeach
    <a href="/{{$navigation->parent->nickname}}/{{$navigation->nickname}}/other">
    <span @if(!empty($case_other)) class="active" @endif>其他</span>
    </a>
</div>

@if($cases->count()>0)
<?php if($navigation->layout=="3"){
        $xwidth = "3";
    } else {
        $xwidth = "4";
    }?>
<div class="inside-cases line-big padding-big-top clearfix">
@foreach($cases as $case)
    <div class="xb{{$xwidth}} xm{{$xwidth}} xl6 xs6">
        <div class="inside-case">
            <div class="inside-case-cover">
                <a href="/case-view-{{$case->id}}.html" title=""><img src="{{$case->photo}}" alt=""></a>
                
                @foreach($case->getstyles as $key => $style)
                @if($key==0)
                <a href="/style-view-{{$style->id}}.html">
                    <span>{{$style->title}}</span>
                </a>
                @endif
                @endforeach
                
            </div>
            <p><a href="/case-view-{{$case->id}}.html" title="{{$case->title}}">{{$case->title}}</a></p>
        </div>
    </div>
@endforeach
<div class="x12">
    {!! $cases->links() !!}
</div>
</div>

@else
<div class="nodata">
    <p><span class="icon-unlink"></span></p>
    <p>暂无数据，可能是管理员偷懒了</p>
    <p><a href="/feedback/sent" class="button border-main icon-legal" title=""> 投诉管理员</a></p>
</div>
@endif