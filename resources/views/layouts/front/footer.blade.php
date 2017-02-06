<div class="index-server hidden-s hidden-l">
    <ul>
        <li><a class="open-server"><span class="icon-comments"></span><br>在线咨询</a></li>
        <li><a href="http://wpa.qq.com/msgrd?v=3&site=上海紫业装饰&menu=yes&uin=3552185716" target="_blank"><span class="icon-qq"></span><br>QQ咨询</a></li>
        <li><a href="http://p.qiao.baidu.com/cps2/chatIndex?reqParam=%7B%22from%22%3A0%2C%22sid%22%3A%22-100%22%2C%22tid%22%3A%22-1%22%2C%22ttype%22%3A1%2C%22siteId%22%3A%222187273%22%2C%22userId%22%3A%225801086%22%7D" target="_blank"><span class="icon-comment-o"></span><br>装修顾问</a></li>
        <li class="win-backtop animated fadeIn"><a><span class="icon-arrow-up"></span><br>返回顶部</a></li>
    </ul>
</div>

<div class="sitecover animated fadeIn"></div>
<div class="footer hidden-s hidden-l">
    <div class="container">
        <div class="footer-main line">
            <div class="xb4 xm4 xl12 xs12">
                <div class="footer-content-header">
                    比装修自己家还用心
                </div>
                <form method="post" action="/appointment/sent/fast">
                <div class="form-group footer-input" style="width:260px;">
                    <div class="field"><input type="text" class="input input-big no-radius" id="name" name="name" data-validate="required:必填" value="@if(count(old('name'))>0){{ old('name') }}@endif" placeholder="请填您的称呼" /></div>
                </div>
                <div class="form-group footer-input" style="width:260px;">
                    <div class="field"><input type="text" class="input input-big no-radius" id="phone" name="phone" data-validate="required:必填,mobile:手机号码格式不正确" value="@if(count(old('phone'))>0){{ old('phone') }}@endif" placeholder="请填写您的手机号码" /></div>
                </div>

                <div class="" style="width:260px;">
                    <button type="submit" class="button button-big layout bg-yellow no-radius">立即预约</button>
                </div>
                {!! csrf_field() !!}
                </form>
            </div>
            <div class="xb4 xm4 xl12 xs12">
                <div class="footer-content-header text-center">
                    紫业国际设计
                </div>
                <div class="footer-nav">
                    <ul>
                        <li><a href="" title="">门店预约</a></li>
                        <li><a href="" title="">关于紫业</a></li>
                        <li><a href="" title="">预约服务</a></li>
                        <li><a href="" title="">帮助中心</a></li>
                        <li><a href="" title="">售后服务</a></li>
                        <li><a href="" title="">客服服务</a></li>
                    </ul>
                </div>
            </div>
            <div class="xb4 xm4 xl12 xs12 text-right">
                <div class="footer-qcode clearfix">
                    <div class="footer-qcode-box">
                        <img src="{{ $siteinfo->sitewxqcrode }}" alt="">
                        <p class="text-center">扫描微信<br>获取紫业最新动态</p>
                    </div>
                    <div class="footer-qcode-box" style="float:rights">
                        <img src="{{ $siteinfo->weiboqcrode }}" alt="" style="">
                        <p class="text-center">扫描微博<br>加入实时互动</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-info">
        <span>{{$siteinfo->companyname}}</span> <span>@ziyehk.com 版权所有</span> <span>{{$siteinfo->sitebeian}}</span>
        <p><img src="/imgs/footer-logo.jpg" alt=""></p>
    </div>
</div>
<div class="footer-m hidden-m hidden-b">
    @紫业国际设计 版权所有
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?0c1daa2844b2671c4706f8aeb7e17942";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</div>
{{-- <div class="phonenav hidden-m hidden-b">
    <div class="phonenav-content">
        <ul>
            <li><a href="/" title=""><span class="icon-home"></span>首页</a></li>
            <li><a href="tel:{{$siteinfo->companyphone}}" title=""><span class="icon-phone"></span>拨号</a></li>
            <li><a href="/appointment/sent" title=""><span class="icon-history"></span>预约</a></li>
            <li><a href="/feedback/sent" title=""><span class="icon-edit"></span>留言</a></li>
            <li><a title="" class="sitenav-bars"><span class="icon-bars"></span>导航</a></li>
        </ul>
    </div>
</div> --}}
<div class="phone-appointments hidden-m hidden-b">
    <div class="phone-appointments-content">
        <img src="/imgs/phone-footer.png" class="phone-appointments-left">
        <div class="phone-appointments-top"><span>一键报名</span><strong>免费</strong>获取报价</div>
        <div class="phone-appointments-bottom">
            <form method="post" action="/appointment/sent/fast" class="clearfix">
            <input type="text" name="name" placeholder="您的称呼">
            <input type="tel" name="phone" placeholder="手机号码">
            <button type="submit">递交</button>
            {!! csrf_field() !!}
            </form>
        </div>
        <img src="/imgs/phone-footer-right.png" class="phone-appointments-right" onclick="window.location.href='tel:{{$siteinfo->companyphone}}'">
        <a class="phone-appointments-tel" href="tel:{{$siteinfo->companyphone}}" title="">一键拨号</a>
    </div>
</div>

<div class="hidden-m hidden-b phonenav">
    <span class="icon-bars"></span>
    <input type="hidden" id="bodyoffset">
</div>

<div class="site-appointments hidden-l hidden-s">
    <div class="site-appointments-content">
        <div class="container">
            
            <div class="line-big">
                <div class="x4">
                    <div class="site-appointments-left">
                        <div class="clearfix">
                        <div class="left-site">
                            <h3>仅需20秒</h3>
                            <p>免费获取报价</p>
                        </div>
                        <div class="right-site">
                            已累计有<span>{{$appointmentpeople}}</span><br>位业主获取报价
                        </div>
                        </div>
                    </div>
                </div>
                <div class="x6 site-appointments-center">
                    <form class="form-inline noback clearfix" method="post" action="/appointment/sent/fast">
                        <div class="form-group footer-input">
                            <div class="field"><input type="text" class="input input-big no-radius" id="name" name="name" data-validate="required:必填" value="@if(count(old('name'))>0){{ old('name') }}@endif" placeholder="请填您的称呼" /></div>
                        </div>
                        <div class="form-group footer-input">
                            <div class="field"><input type="text" class="input input-big no-radius" id="phone" name="phone" data-validate="required:必填,mobile:手机号码格式不正确" value="@if(count(old('phone'))>0){{ old('phone') }}@endif" placeholder="请填写您的手机号码" /></div>
                        </div>
                        <div class="form-group footer-input">
                        <button type="submit" type="buttom" class="button button-big bg-yellow no-radius" style="height:46px;">免费获取</button>
                        </div>
                        {!! csrf_field() !!}
                    </form>
                </div>
                <div class="x2 site-appointments-right" >
                    <h3>全国服务热线</h3>
                    <p>4006-011-371</p>
                </div>
            </div>
            
        </div>
        <div class="site-appointments-tools">
            <span class="icon-angle-double-left site-appointments-close"></span>
        </div>
    </div>
</div>