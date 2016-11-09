<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height">
    <title>预约信息</title>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/tab-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/reserve.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/ReserveMessage.css')}">
</head>
<body>
<!--微信自带顶部栏-->
<div class="topbar-default">
    <img class="back" src="{:base_url('image/back_white.png')}">
    <span>预约信息</span>
</div>


<!--预约项目-->

<!--{foreach $list $val}-->
    <!--{if $val["status"]==1}-->
        <div class="box-reserve">
            <span class="box-reserve-date">{:$val["date"]}</span>
            <div class="box-reserve-status1">已预约</div>
            <span class="box-reserve-cost">¥49.99</span>
            <p class="box-reserve-time">8:00-10:00</p>
        </div>
    <!--{elseif $val["status"]==2}-->
        <div class="box-reserve">
            <span class="box-reserve-date">{:$val["date"]}</span>
            <div class="box-reserve-status2">已取消</div>
            <span class="box-reserve-cost">¥{:$val["price"]}</span>
            <p class="box-reserve-time">{:$val["start"]}-{:$val["end"]}</p>
        </div>
    <!--{/if}-->
<!--{/foreach}-->
<!--底部栏-->
<div class="bottom">
    <div><img class="btn-normal btn-pressed" src="{:base_url('image/reserve.png')}"><p class="p-normal p-pressed">预约</p></div>
    <div><img class="btn-normal" src="{:base_url('image/match.png')}"><p class="p-normal">约战</p></div>
    <div><img class="btn-normal" src="{:base_url('image/find.png')}"><p class="p-normal">发现</p></div>
    <div><img class="btn-normal" src="{:base_url('image/myself.png')}"><p class="p-normal">我</p></div>
</div>

<script type="text/javascript" src="{:base_url('js/reserve.js')}"></script>
</body>
</html>