<div class="inside-teams line-big">
@if(isset($teams)&&$teams->count()>0)
@foreach($teams as $key)
    <div class="xb3 xm3 xs6 xl6">
        <a href="/team-view-{{$key->id}}.html" title="{{$key->name}}">
        <div class="inside-team">
            <div class="inside-team-cover">
                <img src="{{$key->photo}}" alt="">
            </div>
            <strong>{{$key->zhiwu}}：{{$key->name}}</strong>
            <p>擅长风格：{{$key->shanchang}}</p>
        </div>
        </a>
    </div>
@endforeach
@else
<div class="nodata">
    <p><span class="icon-unlink"></span></p>
    <p>暂无数据，可能是管理员偷懒了</p>
    <p><a href="/feedback/sent" class="button border-main icon-legal" title=""> 投诉管理员</a></p>
</div>
@endif

</div>
{{-- <div class="view-teams">
    <div class="view-teams-header clearfix">
        <div class="view-teams-cover">
            <img src="/imgs/teams.jpg" alt="">
        </div>
        <div class="view-teams-info">
            <p class="view-teams-title">设计总监：某某某</p>
            <p>设计费：200元/m²</p>
            <p>设计理念：沟通赢得理解，空间表达情感。</p>
            <p>资质：上海装饰协会设计师 软装设计师</p>
            <p>擅长风格：现代简约、欧式、现代中式、地中海、田园风格等。</p>
            <p>主要作品：恒盛鼎城、同润菲诗艾伦、春光家园、锦秋花园、中环家园、中环1号、康桥亲水湾等。</p>
        </div>
    </div>
</div> --}}