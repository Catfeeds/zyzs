function showmnav(){
	$(".win-shownav").addClass("win-closenav").removeClass("icon-navicon").addClass("icon-chevron-right");
	$(".body").animate({"margin-left":"-200px","margin-right":"200px"},800).addClass("clockbody");
	$(".body").append("<div class='sitemaincover'></div>");
	$(".sitemaincover").css("opacity","0.1");
	$(".sitemaincover").animate({"opacity":"0.5"},300);
	$(".sitemenu>div>ul").addClass("sitepanel").css("height",$("body").outerHeight(true)).css("right","0px");
	$(".sitemaincover").bind("click",function(){
		hidemnav();
	})
}

function hidemnav(){
	$(".win-shownav").removeClass("win-closenav").removeClass("icon-chevron-right").addClass("icon-navicon");
	$(".body").animate({"margin-left":"0","margin-right":"0"},300);
	$(".sitemaincover").remove();
	$(".sitemenu>div>ul").css("right","-200px");
	$(".sitemenu>div>ul").removeClass("sitepanel");
}

$(function(){
//导航
$(".sitemenu li").hover(function(){
	$(this).find("ul").show();
},function(){
	$(this).find("ul").hide();
})

$(".win-shownav").click(function(){
	if ($(this).hasClass("win-closenav")) {
	hidemnav();
	}else{
	showmnav();
	}
})

$(".win-go-comment").click(function(){
	$('html,body').stop(true, true).animate({scrollTop: $(".comment").offset().top}, 500);
})

$(".returntop").click(function(){
	if($('html,body').is(":animated") ){ 
	$('html,body').stop(true,true);
	} else {
	$('html,body').stop(true,true).animate({scrollTop: $("html").offset().top},1000);
	}
});

//滑动隐藏nav
var touchstart="0";
var touchend="0";
var touchnow="0";
$("body").bind("touchstart",function(e){
	var touch=e.originalEvent.targetTouches[0];
	touchstart=touch.pageX;
});
$("body").on("touchmove",function(e){
	var touch=e.originalEvent.targetTouches[0];
});
$("body").on("touchend",function(e){
	var touch=e.originalEvent.changedTouches[0];
	touchend=touch.pageX;
	touchchange=touchstart-touchend;
	if(touchchange<-20 && $(".win-shownav").hasClass("win-closenav")){
		hidemnav()
	}
});

//修复链接的title
$("a").each(function(){
	if ($(this).hasClass('button')) {
		$(this).removeAttr('title');
	};
});

$(".aside-nav a,.article-fixed-items a,.sitemenu a").each(function(){
	$(this).removeAttr('title');
})

$(".itemhover").sliphover()


$(".article-fixed-items").masonry({ columnWidth: 0 });
$('.article-fixed-items').imagesLoaded( function() {
  $(".article-fixed-items").masonry("reload");
});

$(".album-list").masonry({ columnWidth: 0 });
$('.album-list').imagesLoaded( function() {
  $(".album-list").masonry("reload");
});

$('.flexslider').flexslider({
		directionNav: true,
		animation: "fade",
		controlNav: true,
		slideshowSpeed: 120000,
		animationSpeed: 1000,
		pauseOnAction: false,
		keyboardNav: true,
		start: function(slider){
          $('body').removeClass('loading');
        }
	});
})