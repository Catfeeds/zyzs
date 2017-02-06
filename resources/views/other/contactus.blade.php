@extends('layouts.site')
@section('seo')
<title>联系我们_{{ $siteinfo->sitename }}_{{ $siteinfo->companyname}}</title>
<meta name="keywords" content="{{ $siteinfo->sitekeywords }}" />
<meta name="description" content="{{ $siteinfo->sitedescription }}" />
@stop

@section('main')
<div class="inside_banner">
    <img src="/public/imgs/inside-contact.jpg">
</div>

<div class="layout bg-white">
    <div class="container">
      <div class="contactlist clearfix">
        <div class="text-center xb3 xm3 xl6 xs6">
          <a href="tencent://message/?uin=1952028480" title="" target="_blank">
          <img src="/public/imgs/qicq.png" class="img-responsive" alt="腾讯QQ">
          <h3>腾讯QQ</h3>
          <p>点击咨询</p>
          </a>
        </div>
        <div class="text-center xb3 xm3 xl6 xs6">
          <a href="mailto:cs@ebliss.cn">
          <img src="/public/imgs/email.png" class="img-responsive" alt="企业邮箱">
          <h3>企业邮箱</h3>
          <p>cs@ebliss.cn</p>
          </a>
        </div>
        <div class="text-center xb3 xm3 xl6 xs6">
          <img src="/public/imgs/tel.png" class="img-responsive" alt="联系电话">
          <h3>联系电话</h3>
          <p>4006-572-576</p>
        </div>
        <div class="text-center xb3 xm3 xl6 xs6">
          <img src="/public/imgs/fax.png" class="img-responsive" alt="图文传真">
          <h3>图文传真</h3>
          <p>020-3113-0921</p>
        </div>
      </div>
    </div>
</div>

<div class="layout" style="background-color: #a6bcb0;">
    <div class="container">
      <div class="contact-location">
        <div class="text-center">
          <img src="/userfiles/images/20160707_163621.jpg" class="padding-big-bottom">
          <h3 class="text-main"><span class="icon-map-marker"> </span>公司地址</h3>
          <div class="padding-top text-big">
            {{$siteinfo->companyaddress}}
          </div>

          <div class="padding-large-top">
            <div id="container" style="width:100%;min-height:500px;"></div>
                <div id="info" style="margin-top: 10px;">
            </div>
          </div>

          <div class="padding-large-top">
              <div class="text-main">
                <p>广州伊碧仕实业有限责任公司 版权所有 并保留所有权利</p>
              </div>
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
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script>
var init = function() {
    var center = new qq.maps.LatLng(22.996881,113.430786);
    var map = new qq.maps.Map(document.getElementById('container'),{
        center: center,
        zoom: 16
    });
    var infoWin = new qq.maps.InfoWindow({
        map: map
    });
    infoWin.open();
    infoWin.setContent('<div style="width:300px;padding-top:10px;">'+
        '<h2 style="padding-bottom:20px;">{{$siteinfo->companyname}}</h2>'+
        '<p>联系电话：{{$siteinfo->companyphone}}</p></div>');
    infoWin.setPosition(center);
}
$(function(){
  init();
})

</script>
@stop