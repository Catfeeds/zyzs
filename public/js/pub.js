function openWin() { 
    var url='/server/chat';                             //转向网页的地址; 
    var name='add';                            //网页名称，可为空; 
    var iWidth=720;                          //弹出窗口的宽度; 
    var iHeight=600;                         //弹出窗口的高度; 
    //获得窗口的垂直位置 
    var iTop = (window.screen.availHeight - 30 - iHeight) / 2; 
    //获得窗口的水平位置 
    var iLeft = (window.screen.availWidth - 10 - iWidth) / 2; 
    window.open(url, name, 'height=' + iHeight + ',,innerHeight=' + iHeight + ',width=' + iWidth + ',innerWidth=' + iWidth + ',top=' + iTop + ',left=' + iLeft + ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no'); 
      // window.open("AddScfj.aspx", "newWindows", 'height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no'); 
}

function showserver(){
    $(".online-server-container").show();
}; 
$(function(){
    token = $('meta[name="csrf-token"]').attr('content');
    $.post('/get/location/customer', {'_token':token}, function(msg) {
        $(".location-city").html(msg);
        $(".choose-location>div>span").each(function(){
            if ($(this).html()==msg) {
                $(this).addClass('active');
            }
        });
    });

    $(".change-location").click(function(){
        $(".site-location").find('div').show();

    })

    $(".showtooltip").hover(function(){
        $(this).find('ul').stop(true, true).show();
    },function(){
        $(this).find('ul').stop(true, true).hide();
    });

    $(".sitenav>div>ul>li").hover(function(){
        $(this).find('ul').stop(true, true).show('blind',100);
    },function(){
        $(this).find('ul').stop(true, true).hide();
    });

    $(".search-button").bind('touchstart',function(){
        if($(".nav-search").hasClass('active')){
            $(this).closest('form').submit();
        } else {
            $(".nav-search").addClass('active');
            $("#mkeywords").focus();
        }
    });

    $(".nav-bars a").click(function(){
        $(".sitecover").show();
        $(".body").addClass('srcoll');
    });

    $(".sitenav-bars").click(function(){
        $(".sitecover").show();
        $(".body").addClass('srcoll');
    });

    $(".phonenav").click(function(){
        $(".sitecover").show();
        $(".body").addClass('srcoll');
        $("#bodyoffset").val($(window).scrollTop()).addClass('return');
        $('body,html').animate({scrollTop: 0}, 1);
    });

    $(".sitecover").bind('touchstart',function(){
        $(".sitecover").hide();
        $(".body").removeClass('srcoll');
        if ($("#bodyoffset").hasClass('return')) {
            bodyheight = $("#bodyoffset").val();
            $('body,html').animate({scrollTop: bodyheight}, 1);
        }
    });

    $(".close-nav").bind('click',function(){
        $(".sitecover").hide();
        $(".body").removeClass('srcoll');
        if ($("#bodyoffset").hasClass('return')) {
            bodyheight = $("#bodyoffset").val();
            $('body,html').animate({scrollTop: bodyheight}, 1);
        }
    })

    $(window).scroll(function() {       
        if ($(this).scrollTop() > $(".navcontent").position().top) {
            $(".sitenav").addClass("navfixed");
            $(".win-backtop").show();
        } else {
            $(".sitenav").removeClass("navfixed");
            $(".win-backtop").hide();
        }

        if ($(this).scrollTop() > 60) {
            $(".phonenav").show();
        } else {
            $(".phonenav").hide();
        }
    });

    $("a").hover(function(){
        $(this).attr("title","");
    },function(){})

    $(".close-server").click(function(){
        $(".online-server").hide();
    })

    $(".open-server").click(function(){
        $(".online-server").hide();
        openWin();
    });

    $(".site-location>div>span").click(function(){
        val = $(this).html();
        token = $('meta[name="csrf-token"]').attr('content');
        $.post('/change/location/customer', {'location': val,'_token':token}, function(msg) {
            window.location.reload();
        });
    });

    $(".choose-location>div>span").click(function(){
        val = $(this).html();
        token = $('meta[name="csrf-token"]').attr('content');
        $.post('/change/location/customer', {'location': val,'_token':token}, function(msg) {
            window.location.reload();
        });
    });

    $(".sitenav-location").click(function(){
        if ($(".choose-location").is(':hidden')) {
            $(".choose-location").show();
        } else{
            $(".choose-location").hide();
        }
    });

    $(".site-appointments-close").click(function(){
        $(".site-appointments").addClass('animated slideLeft');
    });

})