<div class="xm3 xb3 hidden-s hidden-l clearfix">
<div class="inside-aside">


@if($sections == "empty")

@else
@foreach($sections as $key=>$value)


@if($value['type']=='articles')
<div class="inside-aside-submenu">
    <div class="inside-aside-submenu-header">
        {{$value['section']->title}}
    </div>
    <ul>
    @foreach($value['datas'] as $data)
        <li><a href="/article-view-{{$data->id}}.html" title=""><i class="icon-angle-double-right"> </i>{{$data->title}} </a></li>
    @endforeach
    </ul>
</div>
@endif

@if($value['type']=='case')
<div class="inside-aside-submenu">
    <div class="inside-aside-submenu-header">
        {{$value['section']->title}}
    </div>
    @foreach($value['datas'] as $key)
    <div class="inside-aside-cases clearfix">
    <a href="/case-view-{{$key->id}}.html" title="">
        <div class="inside-aside-cases-left" style="background-image:url('{{$key->photo}}');"></div>
        <div class="inside-aside-cases-right">
            <p>楼盘：{{$key->title}}</p>
            <p>面积：{{$key->mianji}}</p>
            <p>风格：{{$key->fengge}}</p>
        </div>
    </a>
    </div>
    @endforeach

</div>
@endif





@endforeach

@endif





{{--$value['type']--}}
	

	 
	





</div>
</div>