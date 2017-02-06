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
<link rel="stylesheet" type="text/css" href="/css/online-server-receptionview.css">
</head>
<body onload="loaded()">
<div class="server">
    <div id="historycontent">
        <div id="scroller">
            <div class="content"></div>
            <ul id="srcollhere"><li></li></ul>
        </div>
    </div>
    <div class="tools">
        <a class="input-file" href="javascript:void(0);"><span class="icon-file-image-o"></span><form id='uploadimages' action='/server/chat/server/uploadfile' method='post' enctype='multipart/form-data' target='frameFile'><input size="100" type="file" name="customerimage" id="customerimage" /><input type="hidden" name="customerid" value="{{$customerid}}">{!! csrf_field() !!}</form></a><iframe id='frameFile' name='frameFile' style='display: none;'></iframe>
    </div>
    <div class="edit">
        <div class="edit-content"><textarea name="content" id="content" placeholder="请在这里输入消息..." onkeypress="capture(event,this)"></textarea></div>
        <div class="sent-content">
            <div class="hidden-ls">发送<br><span>Enter</span></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/core.js"></script>
<script type="text/javascript" src="/js/mason.js"></script>
<script type="text/javascript" src="/js/iscroll-lite.js"></script>
<script type="text/javascript" src="/js/online-server-reception-view.js"></script>
<script type="text/javascript">
    function initialize()
    {
        //初始化
        appendhistory();//执行历史记录

    }

    function appendhistory(){
        //查询历史记录，并写入
        token = $('meta[name="csrf-token"]').attr('content');
        $.post('/server/chat/server/history', {'customerid':'{{$customerid}}','_token': token}, function(msg) {
            if(msg=="empty"){} else {
                $(".content").append(msg);
                scrollheight();
            }
        });
    }

    function scrollheight(){
        //div滚动到底部
        myScroll.refresh();
        myScroll.scrollTo(0,myScroll.maxScrollY-1, 0);
        $(".content").imagesLoaded( function() {
            myScroll.refresh();
            myScroll.scrollTo(0,myScroll.maxScrollY-1, 0);
        });
    }

    function getmsg(){
        $.post('/server/chat/server/getmsg', {'customerid':'{{$customerid}}','_token': token}, function(msg) {
            if (msg==""){
            } else {
                $(".content").append(msg);
                scrollheight();
            }
        });
    }

    function sentmessages(){
        sentmessage= $("#content").val();
        if(sentmessage.length>0){
            token = $('meta[name="csrf-token"]').attr('content');
            $.post('/server/chat/server/sentmessage', {'customerid':'{{$customerid}}','sentmessage':sentmessage,'_token': token}, function(msg) {
                if (msg!=="error"){
                    $("#content").val("");
                    $(".content").append(msg.replaceAll('\n','<br/>'));
                    scrollheight();
                } else {
                    alert('发送失败，请重试…');
                }
                scrollheight();
            });
        } else {
            alert('不能发送空消息');
        }
    }

    function capture(event,o){
        var keynum;
        if(window.event){
            keynum=event.keyCode;
        } else {
            keynum=event.which;
        }
        event = event || window.event;
        if(event.ctrlKey&&(keynum==13||keynum==10)) {
            sentmessages();
        }
        if(keynum==13||keynum==10) {
            sentmessages();
        }
    }

    $(function(){
        initialize();

        $(".sent-content").click(function(){
            sentmessages();
        });

        $("#customerimage").change(function(){
            imgurl = $("#customerimage").val();
            if (imgurl.length>0) {
                console.log('1');
                $("#uploadimages").submit();
                appendmsgs = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left popo-green">系统：图片上传中，请稍候…</div></div></div>';
                $(".content").append(appendmsgs);
                scrollheight();
            }
        });

        window.setInterval(getmsg,1000);
    })
    String.prototype.replaceAll  = function(s1,s2){
        return this.replace(new RegExp(s1,"gm"),s2);
    }
</script>
</body>
</html>