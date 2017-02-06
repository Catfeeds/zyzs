<div class="footer layout bg-white padding-large-top hidden-l hidden-s text-big">
     <div class="container">
       <div class="padding-top clearfix">
          <div class="x9">
             <ul class="footer-nav clearfix">
            @foreach($sitenav as $sitenavs)
		    <?php $parentnav = $sitenavs['parentnav']; //一级菜单 ?>
		        @if($parentnav->footershow=="1")
		        <li><a href="/{{ $parentnav->nickname }}" title="{{$parentnav->name}}">{{$parentnav->name}}</a>
		            @if($sitenavs['subnav']!=="empty")
		                <ul>
		                    @foreach($sitenavs['subnav'] as $subnavs)
		                    @if($subnavs->footershow=="1")
		                    <li><a href="/{{ $parentnav->nickname }}/{{$subnavs->nickname}}" title="{{ $subnavs->name }}">{{ $subnavs->name }}</a></li>
		                    @endif
		                    @endforeach
		                </ul>
		            @endif
		        </li>
		        @endif
		    @endforeach
				<li><a href="/support">服务支持</a>
				    <ul class="clearfix">
					    <li><a href="/support/dealers" title="销售网络">销售网络</a></li>
					    <li><a href="/support/common" title="常见问题">常见问题</a></li>
					    <li><a href="/support/feedback" title="在线反馈">在线反馈</a></li>
					    <li><a href="/contactus" title="联系我们">联系我们</a></li>
				    </ul>
				</li>
			</ul>
          </div>
          <div class="x3 text-center">
          	<div class="text-large"><span style="height:50px;line-height:50px;color:#efd000"><strong>{{$siteinfo->companyphone}}</strong></span></div>
          	<div class="text-white text-default">周一至周六 9:00-18:00 </div>
          	<div class="padding-top"><img src="/public/imgs/location-small.png" alt=""></div>
          	<div class="x8 x2-move padding-top text-white text-default height-big">{{$siteinfo->companyaddress}}</div>
          </div>
        </div>
		<div class="footer-copyright border-top border-white text-center text-white text-small padding-large hidden-l hidden-s margin-large-top">© {{$siteinfo->siteurl}}  | <a href="http://www.miitbeian.gov.cn/" title="备案信息查询" class="text-white" target="_blank">{{$siteinfo->sitebeian}}</a> | 公安机关备案号（44011302000455） | Powerd by <a href="http://{{$siteinfo->siteurl}}" class="text-white" title="伊碧仕电蚊纱窗" target="_blank">{{$siteinfo->sitename}}</a> 
		</div>
     </div>
</div>

<div class="hidden-m hidden-s hidden-b hidden-l">
		{!!$siteinfo->statistical!!}
</div>

<div class="hidden-m hidden-b margin-top padding text-center text-gray text-little">--- 已到达最底部了 ---</div>
<div class="footer-m hidden-m hidden-b text-center text-gray text-small padding bg-white">
© {{$siteinfo->siteurl}} All Rights Reserved
</div>
<div class="returntop">
	<img src="/public/imgs/returntop.png" alt="返回顶部">
</div>