@extends('layouts.front.app')
@section('seo')
<title>{{$case->title}}_{{$navigation->name}}_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{$case->keywords}}" />
<meta name="description" content="{{$case->description}}" />
@stop
@section('content')
<div class="view-content">
    <div class="container">
        <div class="line-big">
            <div class="xm9 xb9 xl12 xs12">
                <div class="team-view">
                    <div class="inside-bread-nav hidden-s hidden-l clearfix">
                        <div class="inside-bread-nav-left">
                            <a href="/" title="" class="icon-home"> 首页</a> <span class="icon-angle-double-right"></span> 
                            @if(!empty($navigation->parent->name))
                            <a href="/{{$navigation->parent->nickname}}" title="">{{$navigation->parent->name}}</a> <span class="icon-angle-double-right"></span> <span class="inside-main-bread">
                            @endif
                            <a href="/{{$navigation->parent->nickname}}/{{$navigation->nickname}}" title="">{{$navigation->name}}</a></span> <span class="icon-angle-double-right"></span> 
                            <span class="inside-main-bread">正文</span>
                        </div>
                        <div class="inside-bread-nav-right">
                            <a href="/{{$navigation->parent->nickname}}/{{$navigation->nickname}}" title="" class="icon-angle-double-left"> 返回</a>
                        </div>
                    </div>

                    <div class="case-view clearfix">
                        <div class="case-view-cover">
                            <img src="{{$case->photo}}" alt="{{$case->title}}">
                        </div>
                        <div class="case-view-info">
                            <h4>{{$case->title}} {{$case->huxing}}</h4>
                            <p><strong>楼盘：</strong>{{$case->subtitle}}</p>
                            <p><strong>户型：</strong>{{$case->huxing}}</p>
                            <p><strong>面积：</strong>{{$case->mianji}}</p>
                            <p><strong>风格：</strong>{{$case->fengge}}</p>
                            @if($case->leixing !="") <p><strong>类型：</strong>{{$case->leixing}}</p>@endif
                        </div>
                    </div>
                    <div class="case-view-details">
                        <p>{!!$case->details!!}</p>
                        <p style="text-align:center"><img src="/imgs/case-view-1.png" alt=""></p>

                        <div class="article-view-copyright">
                            版权声明：本案例系紫业装饰原创内容，如需转载请注明出处，并保留完整链接，谢谢！
                        </div>
                        {{-- <div class="article-view-praise">
                            <div>
                                <span class="icon-thumbs-o-up"></span>
                            </div>
                            <p class="zan">{{$case->zan}} 人赞过</p>
                        </div> --}}
                    </div>
                </div>
            </div>

            @if(!empty($case->getmembers[0]))
            <div class="xm3 xb3 xl12 xs12 view-aside">
                <div class="inside-aside-submenu">
                    <div class="inside-aside-submenu-header">
                        设计师
                    </div>
                    <div class="inside-aside-team-view">
                        <img src="{{$case->getmembers[0]->photo}}" alt="">
                        <h4>{{$case->getmembers[0]->zhiwu}}:{{$case->getmembers[0]->name}}</h4>
                        <p>设计费用：{{$case->getmembers[0]->fee}}</p>
                        <p style="margin-bottom:0"><a href="/team-view-{{$case->getmembers[0]->id}}.html" title="" class="button bg-sub icon-eye"> 查看设计师</a></p>
                    </div>
                </div>

                <div class="inside-aside-submenu">
                    <div class="inside-aside-submenu-header">
                        设计师案例
                    </div>
                    <?php $countcases=1; ?>
                    @foreach($case->getmembers[0]->getcases as $key)
                    @if ($countcases<11)
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
                    @endif
                    <?php $countcases++; ?>
                    @endforeach
                    
                </div>
            </div>

            @endif
        </div>
    </div>
</div>
@stop

@section('extrameta')

@stop

@section('extracss')
@stop
@section('extrajs')
<script type="text/javascript">
</script>
@stop