@extends('layouts.site')
@section('seo')
<title>留言反馈_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $siteinfo->sitekeywords }}" />
<meta name="description" content="{{ $siteinfo->sitedescription }}" />
@stop

@section('main')
<div class="inside_banner">
    <img src="/public/imgs/inside-support.jpg">
</div>
<div class="container margin-big-top">
    <div class="line-big padding-bottom">
        <div class="xm3 xs12 hidden-l hidden-s site-aside">
            <div class="bg-white margin-bottom">
                <div class="site-aside-header">服务与支持</div>
                @include('other.support.aside')
            </div>
            @include('sub.aside')
        </div>
        <div class="xm9 xs12 xl12 ">
            <div class="bg-white">
                <div class="main-header padding-responsive-leftright margin-big-bottom">
                    <div class="border-bottom border-main clearfix">    
                        <div class="float-left"><h1 class="text-main"> 在线反馈<span class="text-gray"> FEEDBACK</span></h1></div>
                        <div class="float-right text-right hidden-l hidden-s"><a href="/" title="" class="icon-mail-reply"> 返回</a></div>
                    </div>
                </div>
           <div class="padding-responsive-leftright padding-responsive-bottom clearfix">
               <form method="post" action="/support/feedback">
                <div class="xm6 xb6 xs12 xl12">

                    @if(count(old('type_id'))>0)
                        <?php $thisvalue = old('type_id');?>
                    @else
                        <?php $thisvalue = $feedbacklists[0]->id;?>
                    @endif
                    <div class="form-group padding-large-bottom">
                        <div class="label"><label for="type_id">请选择留言类型：</label></div>
                        <div class="button-group border-main radio">
                        @foreach($feedbacklists as $feedbacklist)
                            <label class="button @if($thisvalue== $feedbacklist->id )active @endif">
                                <input name="type_id" value="{{$feedbacklist->id}}" @if($thisvalue== $feedbacklist->id )checked="checked" @endif type="radio"> {{$feedbacklist->name}}
                            </label>
                        @endforeach
                        </div>
                        <div class="text-gray text-small padding-little-top"></div>
                        @if($errors->has('type_id'))
                        <div class="text-red icon-exclamation-triangle"> {{ $errors->first('type_id') }}</div>
                        @endif
                    </div>
                
                    <div class="form-group padding-large-bottom">
                        <div class="label"><label for="name">我们如何称呼您？</label></div>
                        <div class="field"><input type="text" class="input" id="name" name="name" data-validate="required:必填" value="@if(count(old('name'))>0){{ old('name') }}@endif" placeholder="如：王先生" /></div>
                        <div class="text-gray text-small"></div>
                        @if($errors->has('name'))
                        <div class="text-red icon-exclamation-triangle"> {{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="form-group padding-large-bottom">
                        <div class="label"><label for="contact">我们如何联系您？</label></div>
                        <div class="field"><input type="text" class="input" id="contact" name="contact" data-validate="required:必填" value="@if(count(old('contact'))>0){{ old('contact') }}@endif" placeholder="手机或邮箱" /></div>
                        <div class="text-gray text-small"></div>
                        @if($errors->has('contact'))
                        <div class="text-red icon-exclamation-triangle"> {{ $errors->first('contact') }}</div>
                        @endif
                    </div>
                </div>

                <div class="x12">
                    <div class="form-group padding-large-bottom">
                        <div class="label"><label for="content">请描述您的问题：</label></div>
                        <div class="field"><textarea type="text" class="input" id="content" name="content" data-validate="required:必填" rows="5" placeholder="请尽量详细描述，我们会尽快回复！" />@if(count(old('content'))>0){{ old('content') }}@endif</textarea></div>
                        <div class="text-gray text-small"></div>
                        @if($errors->has('content'))
                        <div class="text-red icon-exclamation-triangle"> {{ $errors->first('content') }}</div>
                        @endif
                    </div>
                </div>

                <div class="xm6 xb6 xs12 xl12">
                    <div class="form-group padding-large-bottom">
                        <div class="label"><label for="captcha">验证码</label></div>
                        <div class="field"><input type="text" class="input" id="captcha" name="captcha" data-validate="required:必填" placeholder="验证码" /></div>
                        @if($errors->has('captcha'))
                            <span class="text-red icon-exclamation-triangle"> {{$errors->first('captcha') }}</span>
                        @endif
                    </div>
                    <img src="{{ url('/captcha') }}" class="captcha" title="点击切换验证码"/>
                </div>

                <div class="x12 margin-large-bottom padding-large-bottom margin-large-top">
                    <div class="x5 x1-move text-center"><button class="button bg-gray win-refresh icon-refresh" type="button"> 重新载入</button></div>
                    <div class="x5 text-center"><button class="button bg-main icon-save" type="submit"> 提交数据</button></div>
                </div>

                <div class="x12 margin-large-bottom border-top padding-large-top border-dashed">
                   <div class="padding-large-bottom">
                       <h1><span class="icon-comment-o"> </span> FAQ：</h1>
                   </div>
                   <div class="text-main text-big padding-bottom">1. 提交留言后多久会回复？</div>
                   <div class="text-indent padding-big-bottom">答：一般在10分钟至12小时以内，法定节假日除外。</div>
                   <div class="text-main text-big padding-bottom">2. 为什么我没有收到回复？</div>
                   <div class="text-indent padding-big-bottom">答：我们会认真对待每一份留言，如果没有收到回复很有可能是由于您的联系方式填写错误，请重新提交留言。</div>
                   <div class="text-main text-big padding-bottom">3. 投诉是否会受到隐私保护？</div>
                   <div class="text-indent padding-big-bottom">答：在线投诉是由专员负责收集与回复，我们会严格保密。</div>
                </div>

               {!! csrf_field() !!}
               </form>

           </div>
           </div>
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
$(function(){
    $(".captcha").click(function(){
        $(this).attr('src','/captcha?.s='+Math.random());
    })
})
</script>
@stop