<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>预约</title>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/tab-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/myself.css')}">
    <style>
        .back{ width: 1.7rem; height: 1.7rem; margin-top: 0.65rem; position: absolute; left: 0.7rem; }
        .reserve-message{ width: 100%; height: 2.6rem; background-color: #fff; margin-top: 0.5rem; border-top: 0.01rem solid #ddd; border-bottom: 0.01rem solid #ddd; line-height: 2.6rem; }
    </style>
</head>
<body>
<!--微信自带顶部栏-->
<div class="topbar-default">
    <img class="back" src="{:base_url('image/back_white.png')}">
    <span>用户信息</span>
</div>
<!--顶部信息-->
<div class="top-style">
    <img class="img-portrait" src="{:base_url('image/fruit.png')}">
    <p>Vonlion</p>
<!--    <img class="btn-in" src="{:base_url('image/in-white.png')}">-->
</div>

<!--会员等级-->
<div class="level">
    <img src="{:base_url('image/vip.png')}">
    <span>初级会员</span>
</div>

<br>

<!--昵称-->
<div class="reserve-message">
    <span>昵称</span>
</div>

<!--体重-->
<div class="reserve-message">
    <span>体重</span>
    <img class="btn-in2" src="{:base_url('image/in.png')}">
</div>

<!--身高-->
<div class="reserve-message">
    <span>身高</span>
    <img class="btn-in2" src="{:base_url('image/in.png')}">
</div>

<!--场位-->
<div class="reserve-message">
    <span>场位</span>
    <img class="btn-in2" src="{:base_url('image/in.png')}">
</div>

<!--积分-->
<div class="reserve-message">
    <span>积分</span>
</div>

<!--球队-->
<div class="reserve-message">
    <span>球队</span>
</div>

</body>
</html>