function initialize()
    {
        appendhistory();
    }

    function lock(){
        $(".tools").hide();
        $(".edit").hide();
        $(".noserver").show();
        $(".content").css('bottom','50px');
    }

    function appendhistory(){
        token = $('meta[name="csrf-token"]').attr('content');
        $.post('/server/chat/history', {'_token': token}, function(msg) {
            if(msg=="empty"){} else {
                $(".content").append(msg);
                scrollheight();
            }
            chooseserver();
        });
    }

    function chooseserver()
    {
        token = $('meta[name="csrf-token"]').attr('content');
        $(".content").append('<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left popo-green">系统：正在为您接入客服，请稍候...</div></div></div>');
        scrollheight();
        $.post('/server/chat/chooseserver', {'_token': token}, function(msg) {
            if(msg=="empty"){
                appendmsgs = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left popo-red">系统：<br><br>所有客服已离线，请稍后再试，给您带来的不便敬请谅解！<br><br>客服工作时间：<br><br>周一至周六 <br> 9:00 至 21:00</div></div></div>';
                $(".content").append(appendmsgs);
                lock();
                scrollheight();
            } else {
                $(".content").append(msg);
                scrollheight();
                window.setInterval(getmsg,1000);
                window.setInterval(online,25000);
            }
            scrollheight();
        });
    }

    function scrollheight(){
        //div滚动到底部
        $(".content").scrollTop($(".content")[0].scrollHeight);
        $(".content").imagesLoaded( function() {
            $(".content").scrollTop($(".content")[0].scrollHeight);
        });
    }


    function getmsg(){
        chatid = $("#chatid").val();
        $.post('/server/chat/getmsg', {'chatid':chatid,'_token': token}, function(msg) {
            if(msg=="serveroff"){
                if ($(".content").hasClass('locked')) {
                    endtime = $(".countoff").html();
                    endtime = endtime*1-1;
                    if (endtime<=1) {
                        window.location.reload();
                    }
                    $(".countoff").html(endtime);
                } else{
                    appendmsgs = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left popo-red">系统：<br>客服已掉线，尝试重连中，<span class="countoff">60</span>秒后客服未上线将为您自动转接...</div></div></div>';
                    $(".content").append(appendmsgs);
                    $(".content").addClass('locked');
                    scrollheight();
                }
            }else{
                if (msg=="other") {
                    alert('已打开新窗口，本窗口已失效');
                    window.close();
                } else {
                    if ($(".content").hasClass('locked')) {
                        window.location.reload(); 
                    } else {
                        if (msg==""){
                        } else {
                            $(".content").append(msg);
                            scrollheight();
                        }
                    }
                }
            }
        });
    }

    function sentmessages(){
        sentmessage= $("#content").val();
        if(sentmessage.length>0){
            token = $('meta[name="csrf-token"]').attr('content');
            $.post('/server/chat/sentmessage', {'sentmessage':sentmessage,'_token': token}, function(msg) {
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
        if(keynum==13||keynum==10){
            sentmessages();
        }
    }

    function online()
    {
        $.post('/server/chat/online', {'_token': token}, function(msg) {});
    }

    $(function(){
        initialize();

        $(".sent-content").click(function(){
            sentmessages();
        });

        $("#customerimage").change(function(){
            imgurl = $("#customerimage").val();
            if (imgurl.length>0) {
                $("#uploadimages").submit();
                appendmsgs = '<div class="popo"><div class="popo-left"><div class="ico-left"></div><div class="popo-body left popo-green">系统：图片上传中，请稍候…</div></div></div>';
                $(".content").append(appendmsgs);
                scrollheight();
            }
        });

        $(".windowclose").click(function(){
            window.close();
        });
        $(".windowback").click(function(){
            window.location.href='/';
        });

        
    })
    String.prototype.replaceAll  = function(s1,s2){
        return this.replace(new RegExp(s1,"gm"),s2);
    }
    var isActive;

window.onfocus = function () { 
  isActive = true; 
}; 

window.onblur = function () { 
  isActive = false; 
}; 