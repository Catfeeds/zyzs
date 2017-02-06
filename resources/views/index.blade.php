@extends('layouts.front.app')
@section('seo')
<title>{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $siteinfo->sitekeywords }}" />
<meta name="description" content="{{ $siteinfo->sitedescription }}" />
@stop
@section('content')
<div class="layout hidden-s hidden-l" style="position:relative">
    <div class="flexslider">
        <ul class="slides">
        @foreach($indexbanner as $ibr)
            <li class="banner-item" style="width:100%;height:600px;background-image: url('{{$ibr->filepath}}');background-repeat: no-repeat;background-position: center;background-size: auto 600px;"><a href="{{$ibr->alink}}" style="display: block;width: 100%;height: 600px;"></a></li>
        @endforeach
        </ul>
        {{-- <div class="banner-appointment">
            <div class="container clearfix">
                <div class="banner-appointment-box">
                    <form method="post" action="/appointment/make">
                        <div class="banner-appointment-box-content">
                            <div class="banner-appointment-box-bg">
                                <div class="banner-appointment-box-main">
                                    <div class="banner-appointment-header">
                                        免费预约
                                    </div>
                                    <div class="banner-appointment-content">
                                        <div class="form-group margin-large-bottom">
                                            <div class="field">
                                                <select name="service" class="input">
                                                @foreach($yuyuetypes as $yuyuetype)
                                                <option value="{{$yuyuetype->name}}">{{$yuyuetype->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="text-gray text-small"></div>
                                            @if($errors->has('type'))
                                            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('type') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group margin-large-bottom">
                                            <div class="field"><input type="text" class="input" id="name" name="name" data-validate="required:必填" value="@if(count(old('name'))>0){{ old('name') }}@endif" placeholder="我们如何称呼您" /></div>
                                            <div class="text-gray text-small"></div>
                                            @if($errors->has('name'))
                                            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('name') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group margin-large-bottom">
                                            <div class="field"><input type="text" class="input" id="phone" name="phone" data-validate="required:必填,mobile:手机号码格式不正确" value="@if(count(old('phone'))>0){{ old('phone') }}@endif" placeholder="请填写手机号码" /></div>
                                            <div class="text-gray text-small"></div>
                                            @if($errors->has('phone'))
                                            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('phone') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group margin-large-bottom">
                                            <div class="field"><input type="text" class="input" id="xiaoqu" name="xiaoqu" data-validate="required:必填" value="@if(count(old('xiaoqu'))>0){{ old('xiaoqu') }}@endif" placeholder="请填写您的小区" /></div>
                                            <div class="text-gray text-small"></div>
                                            @if($errors->has('xiaoqu'))
                                            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('xiaoqu') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group margin-large-bottom">
                                            <div class="field"><input type="text" class="input" id="mianji" name="mianji" data-validate="required:必填" value="@if(count(old('mianji'))>0){{ old('mianji') }}@endif" placeholder="请填写您的房屋建筑面积" /></div>
                                            <div class="text-gray text-small"></div>
                                            @if($errors->has('mianji'))
                                            <div class="text-red icon-exclamation-triangle"> {{ $errors->first('mianji') }}</div>
                                            @endif
                                        </div>
                                        <input type="hidden" name="content" value="">

                                        <button type="submit" class="button layout appointment-button button-big">点击预约</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! csrf_field() !!}
                    </form>
                </div>   
            </div>       
        </div> --}}
    </div>
</div>

<div class="layout hidden-m hidden-b" style="position:relative">
    <div class="flexslider">
        <ul class="slides">
        @foreach($indexbanner as $ibr)
            <li class="banner-item"><a href="{{$ibr->alink}}"><img src="{{$ibr->mfilepath}}" width="100%"></a></li>
        @endforeach
        </ul>
    </div>
</div>



{{-- <div class="index-sub-banner margin-large-top">
    @if(!empty($indeximg[0]->img))
    <div class="index-sub-banner-cover hidden-l hidden-s" style="background-image:url('{{$indeximg[1]->img}}');background-position: 0px 0%"></div>
    <div class="index-sub-banner-cover-m hidden-b hidden-m" style="background-image:url('{{$indeximg[1]->img}}');"></div>
    <div class="index-sub-banner-content">
        <p>{{$indeximg[0]->title}}</p>
        <p>{{$indeximg[0]->en}}</p>
        <p><span class="icon-sort-desc"></span></p>
    </div>

    @else
    <div class="index-sub-banner-cover hidden-l hidden-s" style="background-image:url('/imgs/index-owner-banner.jpg');background-position: 0px 0%"></div>
    <div class="index-sub-banner-cover-m hidden-b hidden-m" style="background-image:url('/imgs/index-owner-banner.jpg');"></div>
    <div class="index-sub-banner-content">
        <p>八大创新工艺</p>
        <p>8 innovation technique</p>
        <p><span class="icon-sort-desc"></span></p>
    </div>
    @endif
    
</div> --}}

<div class="layout eight-innovation">
    <div class="container">
    @if(!empty($indexline[0]->img))
        <div class="eight-innovation-header">
            <p>{{$indexline[0]->title}}</p>
            <div class="eight-innovation-header-main">
                <img src="{{$indexline[0]->img}}" alt="">
            </div>
        </div>
    @endif
        <div class="hoverstyles line-big">
        @foreach($eight as $e)
            <div class="xm3 xb3 xl6 xs6">
                <a href="{{$e->url}}" title="{{$e->title}}">
                    <div class="hoverstyle" style="background-image: url('{{$e->img}}')"></div>
                </a>
                <p class="text-center padding-small-top text-big hidden-s hidden-l"><span>{{$e->title}}</span></p>
                <p class="text-center padding-small-top hidden-b hidden-m"><span>{{$e->title}}</span></p>
            </div>
        @endforeach
            
        </div>
        <div class="x12 text-center">
            <a href="" title="" class="button bg-dot margin-top">了解详情 <span class="icon-angle-double-right"></span></a>
        </div>
    </div>
</div>

{{-- <div class="index-case">
    <div class="index-case-cover">
    </div>
    <div class="index-case-content">
        <p>案例鉴赏</p>
        <p>case appreciate</p>
        <p><span class="icon-sort-desc"></span></p>
    </div>
</div> --}}

<div class="index-sub-banner">
    @if(!empty($indeximg[1]->img))
    <div class="index-sub-banner-cover hidden-l hidden-s" style="background-image:url('{{$indeximg[1]->img}}');background-position: 0px 0%"></div>
    <div class="index-sub-banner-cover-m hidden-b hidden-m" style="background-image:url('{{$indeximg[1]->img}}');"></div>
    
    <div class="index-sub-banner-content">
        <p>{{$indeximg[1]->title}}</p>
        <p>{{$indeximg[1]->en}}</p>
        <p><span class="icon-sort-desc"></span></p>
    </div>
    @else
    <!-- <div class="index-sub-banner-cover hidden-l hidden-s" style="background-image:url('/imgs/index-case-banner.jpg');background-position: 0px 0%"></div> -->
    <!-- <div class="index-sub-banner-cover-m hidden-b hidden-m" style="background-image:url('/imgs/index-case-banner.jpg');"></div> -->
    @endif
</div>

<div class="index-case-lists">
    @if(!empty($indexline[1]->img))
        <div class="eight-innovation-header">
            <p>{{$indexline[1]->title}}</p>
            <div class="eight-innovation-header-main">
                <img src="{{$indexline[1]->img}}" alt="">
            </div>
        </div>
    @endif
    <div class="container">
        <div class="line-big">
            @foreach($indexcases as $case)
            <div class="xm4 xb4 xl12 xs12 margin-big-bottom">
                <div class="index-case-list clearfix">
                    <div class="index-case-list-cover">
                        <img src="{{$case->getcase->photo}}" alt="{{$case->getcase->title}}">
                        <div><p><a href="/case-view-{{$case->getcase->id}}.html" title=""><span class="animated zoomIn afaster">查看案例</span></a></p></div>
                    </div>
                    @if(!empty($case->getcase->getmembers[0]))
                    <div class="index-case-list-info">
                       <div><img src="{{$case->getcase->getmembers[0]->photo}}" alt=""></div> 
                        {{$case->getcase->getmembers[0]->name}} <span>{{$case->getcase->getmembers[0]->zhiwu}}</span>
                    </div>
                    @endif
                    <div class="index-case-list-title">
                        {{$case->getcase->title}}
                    </div>
                </div>
            </div>
            @endforeach
            <div class="x12 text-center">
                <a href="/case" title="" class="button bg-dot margin-top">更多案例 <span class="icon-angle-double-right"></span></a>
            </div>
        </div>
    </div>
</div>

{{-- <div class="index-cases">
    <div class="container">
        <div class="line-big">
            <div class="xm4 xb4 xs6 xl6">
            @foreach($indexcases as $k => $v)
                <div class="index-case-box"><img src="{{$v->photo}}" alt="" class="img-responsive">
                    <div class="index-case-box-content">
                        <img src="{{$v->indexcover}}" class="img-responsive" alt="">
                        <p>{{$v->subtitle}} {{$k}}</p>
                        <a href="/" class="animated zoomIn afaster"> 查看案例 </a>
                    </div>
                </div>

            @if($k == 0)
            </div>
            <div class="xm4 xb4 xs6 xl6">
            @endif
            @if($k==2)
            </div>
            <div class="xm4 xb4 xs12 xl12">
            @endif
            @endforeach
            </div>

            <div class="x12 text-center">
                <a href="" title="" class="button bg-main margin-top">更多案例 <span class="icon-angle-double-right"></span></a>
            </div>

        </div>
    </div>
</div> --}}

{{-- <div class="layout index-teams">
    <div class="container">
        <div class="eight-innovation-header">
            <p>DESIGN TEAMS</p>
            
            <div class="eight-innovation-header-main">
                <span><img src="/imgs/left-leaf.png" alt=""></span><strong>设计团队</strong><span><img src="/imgs/right-leaf.png" alt="">
            </div>
            
        </div>
        <div class="line-big index-teams-list">
            <div class="xm9 xb9 xs12 xl12">
            @foreach($teamsMember as $key)
                <div class="xm3 xb3 xs6 xl6">
                    <div class="index-teams-infos">
                        <img src="{{$key->photo}}" alt="" >
                        <div class="index-teams-details animated fadeInDown afast">
                            <div>
                                <p>{{$key->name}}</p>
                                <p>{{$key->zhiwu}}</p>
                                <a href="#{{$key->id}}" title="">预约</a>
                            </div>
                        </div>
                        <div class="index-teams-info">
                            <p>{{$key->name}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            
                
            </div>

            <div class="xm3 xb3 xs12 xl12 team-right-form">
                <div class="team-appointment">
                    <div class="team-header">
                        免费预约
                    </div>
                    <div class="team-content">
                        <p class="icon-volume-up"> 免费咨询、免费量房、免费方案；量房后，3天出具3套可选方案；</p>
                        <div class="form-group">
                            <div class="field">
                                <div class="input-group">
                                    <span class="addon"> 称呼</span>
                                    <input type="text" class="input" id="money" name="money" size="20" placeholder="如何称呼您" data-validate="required:" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="field">
                                <div class="input-group">
                                    <span class="addon"> 电话</span>
                                    <input type="text" class="input" id="money" name="money" size="20" placeholder="如何联系您" data-validate="required:" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="field">
                                <div class="input-group">
                                    <span class="addon"> 小区</span>
                                    <input type="text" class="input" id="money" name="money" size="20" placeholder="您的小区名" data-validate="required:" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="field">
                                <div class="input-group">
                                    <span class="addon"> 面积</span>
                                    <input type="text" class="input" id="money" name="money" size="20" placeholder="您的房屋建筑面积" data-validate="required:" />
                                </div>
                            </div>
                        </div>

                        <div><button type="button" class="button button-block bg-main">立即预约</button></div>

                    </div>
                </div>

            </div>
            <div class="x12 text-center">
                <a href="" title="" class="button border-main margin-top">查看更多 <span class="icon-angle-double-right"></span></a>
            </div>
        </div>
    </div>
</div> --}}
{{-- 
<div class="index-evaluation-header">
    <div class="index-evaluation-header-cover">
    </div>
    <div class="index-evaluation-content">
        <p>业主眼中的紫业</p>
        <p>EVALUATIONS</p>
        <p><span class="icon-sort-desc"></span></p>
    </div>
</div> --}}
<div class="index-sub-banner">
    @if(!empty($indeximg[2]->img))
    <div class="index-sub-banner-cover hidden-l hidden-s" style="background-image:url('{{$indeximg[2]->img}}');background-position: 0px 0%"></div>
    <div class="index-sub-banner-cover-m hidden-b hidden-m" style="background-image:url('{{$indeximg[2]->img}}');"></div>
    <div class="index-sub-banner-content">
        <p>{{$indeximg[2]->title}}</p>
        <p>{{$indeximg[2]->en}}</p>
        <p><span class="icon-sort-desc"></span></p>
    </div>
    @else
    <div class="index-sub-banner-cover hidden-l hidden-s" style="background-image:url('/imgs/index-owner-banner.jpg');background-position: 0px 0%"></div>
    <div class="index-sub-banner-cover-m hidden-b hidden-m" style="background-image:url('/imgs/index-owner-banner.jpg');"></div>
    <div class="index-sub-banner-content">
        <p>业主眼中的紫业</p>
        <p>EVALUATIONS</p>
        <p><span class="icon-sort-desc"></span></p>
    </div>
    @endif
    
</div>

<div class="layout index-evaluation-box">
    <div class="container">
        <div class="line-big ">
        @foreach($three as $key)
            <div class="xm4 xb4 xs12 xl12"> 
                <div class="index-evaluation">
                <a href="{{$key->url}}" title="{{$key->mtitle}}">
                    <div class="index-evaluation-cover">
                        <img src="{{$key->img}}">
                        <p>{{$key->mtitle}}</p>
                    </div>
                    <div class="index-evaluation-title">
                        {{$key->title}}
                    </div>
                    <div class="index-evaluation-desc">
                        {!!$key->content!!}
                    </div>
                </a>
                </div>                
            </div>
        @endforeach
        </div>
    </div>
</div>

{{-- <div class="index-tutorial layout">
    <div class="container">
    <div class="line-big">
        <div class="eight-innovation-header">
            <p>TREND OF US</p>
            <div class="eight-innovation-header-main">
                <span><img src="/imgs/left-leaf.png" alt=""></span><strong>紫业动态</strong><span><img src="/imgs/right-leaf.png" alt="">
            </div>
        </div>
        <div class="x12">
        <div class="tab border-main">
            <div class="tab-head">
                <ul class="tab-nav">
                    <li class="active"><a href="#tab-1">常见问题</a> </li>
                    <li><a href="#tab-2">紫业动态</a> </li>
                    <li><a href="#tab-3">热装楼盘</a> </li>
                </ul>
            </div>
            <div class="tab-body">
                <div class="tab-panel animated fadeIn active line-big" id="tab-1">
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                这样装修，简洁舒适又温馨！
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial-2.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                香山工法：以爱之名，传承香山匠心文化
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial-3.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                小白领设计的书房，既节省了空间又好看！
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial-4.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                没有电视机的客厅那还叫客厅吗？
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="x12 text-center">
                        <a href="" title="" class="button border-main margin-top">更多常见问题 <span class="icon-angle-double-right"></span></a>
                    </div>
                </div>
                <div class="tab-panel animated fadeIn line-big" id="tab-2">
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial-3.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                这样装修，简洁舒适又温馨！这样装修，简洁舒适又温馨！
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                这样装修，简洁舒适又温馨！这样装修，简洁舒适又温馨！
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                这样装修，简洁舒适又温馨！这样装修，简洁舒适又温馨！
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                这样装修，简洁舒适又温馨！这样装修，简洁舒适又温馨！
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="x12 text-center">
                        <a href="" title="" class="button border-main margin-top">更多紫业动态 <span class="icon-angle-double-right"></span></a>
                    </div>
                </div>
                <div class="tab-panel animated fadeIn line-big" id="tab-3">
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                这样装修，简洁舒适又温馨！这样装修，简洁舒适又温馨！
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                这样装修，简洁舒适又温馨！这样装修，简洁舒适又温馨！
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                这样装修，简洁舒适又温馨！这样装修，简洁舒适又温馨！
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="xm3 xb3 xl6 xs6">
                        <div class="index-tutorial-item">
                        <a href="" title="">
                            <div class="index-tutorial-item-cover">
                                <img src="/imgs/tutorial.jpg">
                            </div>
                            <div class="index-tutorial-item-title">
                                这样装修，简洁舒适又温馨！这样装修，简洁舒适又温馨！
                            </div>
                            <div class="index-tutorial-item-views clearfix">
                                <span><i class="icon-eye"></i> 3551</span> <span><i class="icon-thumbs-up"></i> 251</span> <span class="float-right">2天前</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="x12 text-center">
                        <a href="" title="" class="button border-main margin-top">更多热装楼盘 <span class="icon-angle-double-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div> --}}

<div class="layout decoration-school">
    <div class="container">
        @if(!empty($indexline[2]->img))
        <div class="eight-innovation-header">
            <p>{{$indexline[2]->title}}</p>
            <div class="eight-innovation-header-main">
                <img src="{{$indexline[2]->img}}" alt="">
            </div>
        </div>
    @endif
        <div class="line-big decoration-school-content">
            <div class="xm3 xb3 xl12 xs12">
                <div class="company-news">
                    <div>
                    <a href="{{$course->l1url}}" title="">
                        <h4>{{$course->l1title}}</h4>
                        <p>查看更多 <span class="icon-chevron-right"></span></p>
                    </a>
                    </div>
                </div>
            </div>
            @foreach($course3 as $key)
            <div class="xm3 xb3 xl12 xs12">
                <div class="decoration-school-cover-box">
                    <a href="{{$key->url}}" title="{{$key->title}}">
                        <img src="{{$key->img}}" alt="{{$key->title}}">
                        <p class="clearfix"><span class="leftspan">{{$key->title}} </span><span class="rightspan">{{$key->tag}}</span></p>
                    </a>
                </div>
            </div>
            @endforeach
            

            <div class="xm3 xb3 xl12 xs12">
                <div class="decoration-news">
                    <div>
                    <a href="{{$course->l2url}}" title="">
                        <h4>{{$course->l2title}}</h4>
                        <p>查看更多 <span class="icon-chevron-right"></span></p>
                    </a>
                    </div>
                </div>
            </div>

            <div class="xm4 xb4 xl12 xs12" style="margin-bottom:0px;">
                <div class="decoration-news-list">
                @foreach($course1 as $article)
                    <a href="/article-view-{{$article->id}}.html" title="">
                        <p><span class="left-span"><i class="icon-angle-right"></i> {{$article->title}}</span>  <span class="decoration-news-list-time">[{{$article->published_at->diffForHumans()}}]</span></p>
                    </a>
                @endforeach  
                    </div>
            </div>

            <div class="xm1 xb1 hidden-s hidden-l text-center">
                <img src="/imgs/class.png" style="margin:0 auto">
            </div>

            <div class="xm4 xb4 xl12 xs12">
                <div class="decoration-news-list">
                    <div>
                    @foreach($course2 as $article)
                    <a href="/article-view-{{$article->id}}.html" title="">
                        <p><span class="left-span"><i class="icon-angle-right"></i> {{$article->title}}</span>  <span class="decoration-news-list-time">[{{$article->published_at->diffForHumans()}}]</span></p>
                    </a>
                    @endforeach  
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="index-service">
    <div class="container" style="cursor: pointer;" onclick="javascript:window.location.href='/serv/service-1'">
        <div class="index-service-content-first">
            <h4>服务流程</h4>
            <p>SERVICE PROCESS</p>
        </div>

        <div class="index-service-middle hidden-s hidden-l">
            <span class="icon-angle-right"></span>
        </div>

        <div class="index-service-content">
            <h4 class="icon-desktop"></h4>
            <p>预约量房</p>
        </div>

        <div class="index-service-middle hidden-s hidden-l">
            <span class="icon-angle-right"></span>
        </div>

        <div class="index-service-content">
            <h4 class="icon-pencil"></h4>
            <p>初步预案</p>
        </div>

        <div class="index-service-middle hidden-s hidden-l">
            <span class="icon-angle-right"></span>
        </div>

        <div class="index-service-content">
            <h4 class="icon-file-text-o"></h4>
            <p>设计报价</p>
        </div>

        <div class="index-service-middle hidden-s hidden-l">
            <span class="icon-angle-right"></span>
        </div>

        <div class="index-service-content">
            <h4 class="icon-magic"></h4>
            <p>现场施工</p>
        </div>

        <div class="index-service-middle hidden-s hidden-l">
            <span class="icon-angle-right"></span>
        </div>

        <div class="index-service-content">
            <h4 class="icon-leaf"></h4>
            <p>保洁软装</p>
        </div>

        <div class="index-service-middle hidden-s hidden-l">
            <span class="icon-angle-right"></span>
        </div>

        <div class="index-service-content">
            <h4 class="icon-check-square-o"></h4>
            <p>验收交房</p>
        </div>

    </div>
    <div class="index-service-main">
        <h2>预约量房 · 设计团队多对一整装服务</h2>
        <h1 class="hidden-s hidden-l"><span class="icon-phone"></span> 4006-011-371</h1>
        <h4 class="hidden-m hidden-b"><a href="tel:4006011371" class="button button-big"><span class="icon-phone"></span> 4006-011-371</a></h4>
    </div>
</div>

<div class="index-links hidden-l hidden-s">
    <div class="container">
        <div class="index-links-header">
            友情链接 <span>LINKS</span>
        </div>
        <div class="line-big index-link">
        @foreach($friendlinks as $key)
            <div class="x2">
                <a href="{{$key->links}}" target="_blank" title="{{$key->title}}">{{$key->title}}</a>
            </div>
        @endforeach
        </div>
    </div>
</div>

<div class="online-server-container">
<div class="online-server">
    <div class="notice">
        <div class="notice-content">
            <div class="notice-content-header">
                客服邀请
            </div>
            <div class="notice-content-main">
                您好！欢迎访问紫业国际设计，请问有什么可以帮您？
            </div>
            <div class="notice-content-footer">
                <button type="" class="button bg-gray margin-right close-server">稍后再说</button>
                <button type="" class="button bg-main margin-left open-server">现在咨询</button>
            </div>
        </div>
    </div>
</div>
</div>
@stop

@section('extrameta')

@stop

@section('extracss')
<link rel="stylesheet" type="text/css" href="/css/slider.css">
@stop

@section('extrajs')
<script src="/js/slider.js" type="text/javascript"></script>
<script>
    function parallax(){
        wintop = $(window).scrollTop();
        winheight = $(window).height();
        winposition = wintop+winheight;
        $(".index-sub-banner").each(function(){
            thistop = $(this).position().top;
            thisheight = $(this).height();
            if(thistop-winposition<0) {
                thisposition = (winposition-thistop)/winheight;
                if(thisposition>1){
                    thisposition =1;
                }
                $(this).find(".index-sub-banner-cover").css('backgroundPosition','0px '+thisposition*100+'%');
            }
        });
    }


    $(function(){
        $('.flexslider').flexslider({
            directionNav: true,
            animation: "fade",
            controlNav: true,
            slideshowSpeed:3000,
            animationSpeed: 500,
            pauseOnAction: false,
            keyboardNav: true,
            animationLoop:true
        });

        $(window).scroll(function() {
           parallax();
        })
        
        $("body").imagesLoaded( function() {
            parallax();
        })

        window.setTimeout(showserver,30000); 
    })
</script>
@stop