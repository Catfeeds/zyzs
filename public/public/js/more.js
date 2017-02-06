function loadmore(dataurl,datatoken){
        $(".loadmore").addClass("ajaxlocked").html("<span class='icon-spinner rotate'></span> 玩命加载中...");
        $.post(dataurl, {"page": $(".loadmore").attr("data-page"),"_token":datatoken},
         function(msg) {
          $(".loadmore").attr("data-page",$(".loadmore").attr("data-page")*1+1);
          if (msg.report!=="empty") {
          $(".article-fixed-items").append(msg.report);
          $('.article-fixed-items').imagesLoaded( function() {
                $('.article-fixed-items').masonry("reload");
                if (msg.hasempty=="empty") {
                $(".loadmore").remove();
                } else {
                $(".loadmore").removeClass("ajaxlocked");
                };
          });
          } else {
                $(".loadmore").remove();
          };
       });
    }
$(function(){
    $(window).scroll(function() {
       windowHeight = $(this).scrollTop()+$(window).height();
       loadmoreHeight = $(".loadmore").offset().top;
       if(loadmoreHeight-windowHeight<100){
       if ($(".loadmore").hasClass("ajaxlocked")) {
       } else {
        dataurl = $(".loadmore").attr('data-url');
        datatoken = $('meta[name="csrf-token"]').attr('content');
        loadmore(dataurl,datatoken);
       };
       }
    })
})