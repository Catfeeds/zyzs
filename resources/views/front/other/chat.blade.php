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
<link rel="stylesheet" type="text/css" href="/css/online-server.css">
<title>紫业在线客服</title>
</head>
<body>
<div class="server">
    
    <div class="header clearfix">
        <img src="/imgs/logo.jpg" alt="">
    </div>
    <div class="content"></div>
    <div class="tools">
        <a class="input-file" href="javascript:void(0);"><span class="icon-file-image-o"></span><form id='uploadimages' action='/server/chat/uploadfile' method='post' enctype='multipart/form-data' target='frameFile'><input size="100" type="file" name="customerimage" id="customerimage" />{!! csrf_field() !!}</form></a><iframe id='frameFile' name='frameFile' style='display: none;'></iframe>

    </div>
    <div class="edit">
        <div class="edit-content"><textarea name="content" id="content" placeholder="请在这里输入消息..." onkeypress="capture(event,this)"></textarea></div>
        <div class="sent-content">
            <div class="hidden-ls">发送<br><span>Enter</span></div>
            <div class="hidden-bm">发送</div>
        </div>
    </div>
    <div class="noserver">
        <span class="button bg-main icon-times windowclose"> 关闭窗口</span>
        <span class="button bg-main icon-angle-double-left windowback"> 返回</span>
    </div>
</div>
<input type="hidden" name="chatid" id="chatid" value="{{$chatid}}">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/core.js"></script>
<script type="text/javascript" src="/js/mason.js"></script>
<script type="text/javascript" src="/js/online-server.js"></script>
</body>
</html>