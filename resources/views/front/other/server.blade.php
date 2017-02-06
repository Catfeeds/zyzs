<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="/css/core.css">
<link rel="stylesheet" type="text/css" href="/css/online-server-reception.css">
</head>
<body onload="loaded()">
<div class="full-server">
<div class="header clearfix">
    <div class="cover">
        <img src="/imgs/logo.jpg" alt="">
    </div>
    <div class="setting">
{{--         <a href="/server/changepassword" title=""> <span class="button bg-black icon-lock"> 修改密码</span></a> --}}
        <a href="/server/logout" title=""> <span class="button bg-black icon-sign-out"> 退出</span></a>
    </div>
</div>
<div class="customer-panel">
    <span class="receptionpanel active icon-comment-o"> 接待</span><span class="historypanel icon-clock-o"> 记录</span>
</div>
<div class="customer" id="leftwrapper">
    <div id="scroller">
        <ul class="customerslist"></ul>
    </div>
</div>
<div class="customer" id="historywrapper" style="display:none">
    <div id="scroller">
        <ul class="historylist"></ul>
    </div>
</div>
<div class="server-show">
    <div class="server">
        <div class="target">
          请选择客户
        </div>
        <div class="main-content">
            {{-- <iframe id="iframe0898747c5c1461ea378582c23430da72" src="http://zyzs.zlinwei.com/online/server/reception/123"></iframe> --}}
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/core.js"></script>
<script type="text/javascript" src="/js/iscroll-lite.js"></script>
<script type="text/javascript" src="/js/online-server-reception.js"></script>

<script type="text/javascript">
    function initialize(){
        window.setInterval(getcustomers,2000);//用户列表
        window.setInterval(online,30000);//在线状态通知
    }

    function online(){
        token = $('meta[name="csrf-token"]').attr('content');
        $.post('/server/chat/server/online', {'_token': token}, function(msg) {});
    }

    function cancelnotice(id)
    {
        token = $('meta[name="csrf-token"]').attr('content');
        $.post('/server/chat/server/cancelnotice', {'customerid':id,'_token': token}, function(msg) {});
    }

    function bindopen(){
        $(".customerslist").find("li").bind("click",function(){
            $(".customerslist").find("li").removeClass('active');
            $(this).addClass('active');
            id = $(this).attr("id");
            $(".target").html("正在与《访客："+$(this).attr('data-name')+"》进行对话");
            $(".target").attr("active",id);
            $(this).removeClass('notice');
            cancelnotice(id);
            if($("#iframe"+id).length){
                $(".main-content").find('iframe').hide();
                $("#iframe"+id).show();
            } else {
                $(".main-content").find('iframe').hide();
                $(".main-content").append('<iframe id="iframe'+id+'" src="/online/server/reception/'+id+'"></iframe>');
            };
        })
        $(".historylist").find("li").bind("click",function(){
            $(".historylist").find("li").removeClass('active');
            $(this).addClass('active');
            id = $(this).attr("id");
            $(".target").html("正在查询《访客："+$(this).attr('data-name')+"》的对话记录");
            $(".target").attr("active",id);
            $(this).removeClass('notice');
            cancelnotice(id);
            if($("#iframe"+id).length){
                $(".main-content").find('iframe').hide();
                $("#iframe"+id).show();
            } else {
                $(".main-content").find('iframe').hide();
                $(".main-content").append('<iframe id="iframe'+id+'" src="/online/server/reception/'+id+'"></iframe>');
            };
        })
    }

    function getcustomers()
    {
        token = $('meta[name="csrf-token"]').attr('content');
        $.post('/server/chat/server/getcustomers', {'_token': token}, function(msg) {
            if (msg.status!=="auth") {
                if(msg.status!=="emtpy") {
                    appendmsgs = "";
                    for(var index in msg.data){
                        if(msg.data[index]['notice']=="1"){
                            if(msg.data[index]['customerid'] == $(".target").attr("active")){
                                notice = '';
                                cancelnotice(msg.data[index]['customerid']);
                            } else {
                                notice = ' class="notice"';
                            }
                        } else {
                            notice = '';
                        }
                        appendmsgs = appendmsgs+'<li id="'+msg.data[index]['customerid']+'" data-name="'+msg.data[index]['customerid'].substr(0, 5)+'"'+notice+'><span class="text-green">[在线] </span>访客：'+msg.data[index]['customerid'].substr(0, 5)+'</li>'
                    }
                    historymsgs = "";
                    for(var index in msg.off){
                        if(msg.off[index]['notice']=="1"){
                            if(msg.off[index]['customerid'] == $(".target").attr("active")){
                                notice = '';
                                cancelnotice(msg.off[index]['customerid']);
                            } else {
                                notice = ' class="notice"';
                            }
                        } else {
                            notice = '';
                        }
                        historymsgs = historymsgs+'<li id="'+msg.off[index]['customerid']+'" data-name="'+msg.off[index]['customerid'].substr(0, 5)+'"'+notice+'><span class="text-gray">[离线] </span>访客：'+msg.off[index]['customerid'].substr(0, 5)+'</li>'
                    }
                    $(".customerslist").html(appendmsgs);
                    $(".historylist").html(historymsgs);
                    $("#"+$(".target").attr("active")).addClass('active');
                    bindopen();
                    myScroll.refresh();
                } else {
                    appendmsgs = "暂无客户";
                    $(".customerslist").html('<li>'+appendmsgs+'</li>');
                }
            } else {
                alert('权限验证失败,请重新登录！');
                window.location.href='/server/login';
            }
        },"json");
    }

    $(function(){
        $(".receptionpanel").click(function(){
            $(".customer-panel").find('span').removeClass('active');
            $(".receptionpanel").addClass('active');
            $("#leftwrapper").show();
            $("#historywrapper").hide();
        });
        $(".historypanel").click(function(){
            $(".customer-panel").find('span').removeClass('active');
            $(".historypanel").addClass('active');
            $("#leftwrapper").hide();
            $("#historywrapper").show();
        });
        initialize();
        getcustomers();
    })
</script>
</body>
</html>