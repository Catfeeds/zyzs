function loadmore(url,token,datastart,clock,prehtml){
    clock.addClass("ajaxlocked").html('<span class="icon-spinner rotate"></span> 玩命加载中...');
    $.post(url, {"_token":token,"datastart":datastart},
     function(msg) {
      clock.attr("data-start",clock.attr("data-start")*1+5);
        switch(msg.errmsg){
          case "err":
          alerts(msg.msg,2000);
          clock.remove();
          break;
          case "empty":
          appendtocomment(msg,clock,prehtml);
          clock.remove();
          break;
          case "yes":
          appendtocomment(msg,clock,prehtml);
          break;
        }
   },"json");
}

function gopraise(clock,clockextra,prehtml,prehtmlextra,url,token){
  clock.addClass("ajaxlocked").find("div").html('<span class="icon-spinner rotate"></span>');
  clockextra.html(' <span class="icon-spinner rotate"></span>');
  $.post(url,{"_token":token},
    function(msg){
      if (msg.errmsg=='succeed') {
        clock.find("div").html(prehtml)
        clock.parent("div").removeClass('praiseable').addClass('praised');
        clockextra.html(" "+msg.count);
        $(".count-praise").html(msg.count);
        $(".haspraise").html('您已经点赞了，');
        alerts('点赞成功',2000);
      };
      if (msg.errmsg=='has') {
        clock.find("div").html(prehtml)
        clock.parent("div").removeClass('praiseable').addClass('praised');
        clockextra.html(prehtmlextra);
        $(".haspraise").html('您已经点赞了，');
        alerts('您已经点过赞了',2000);
      };
      if (msg.errmsg=='error') {
        clock.find("div").html(prehtml)
        clock.parent("div").removeClass('praiseable').addClass('praised');
        clockextra.html(prehtmlextra);
        alert('服务连接失败');
      };
    },"json");
}

$(function(){
$('.loadmorebuttom').click(function(){
  if (!$(".loadmorebuttom").hasClass("ajaxlocked")) {
    clock = $(this);
    url = clock.attr("data-url");
    token = $('meta[name="csrf-token"]').attr('content');
    prehtml = clock.html();
    datastart = clock.attr("data-start");
    loadmore(url,token,datastart,clock,prehtml);
  };
})

$(".win-praise,.win-praise-extra").click(function(){
  clock = $(".win-praise");
  clockextra = $(".win-praise-extra");
  if(!clock.hasClass("ajaxlocked")){
  prehtml = clock.find("div").html();
  prehtmlextra = clockextra.html();
  url =clock.attr("data-url");
  token = $('meta[name="csrf-token"]').attr('content');
  gopraise(clock,clockextra,prehtml,prehtmlextra,url,token);
  }
})
})