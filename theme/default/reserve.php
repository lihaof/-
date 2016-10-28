<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>预约</title>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/tab-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/reserve.css')}">
</head>
<body>
<!--微信自带顶部栏-->
<div class="topbar-default">
    <img class="back" src="{:base_url('image/back_white.png')}">
    <span>预约</span>
</div>

<!--底部栏-->
<div class="bottom">
    <div><img class="btn-normal btn-pressed" src="{:base_url('image/reserve.png')}"><p class="p-normal p-pressed">预约</p></div>
    <div><img class="btn-normal" src="{:base_url('image/match.png')}"><p class="p-normal">约战</p></div>
    <div><img class="btn-normal" src="{:base_url('image/find.png')}"><p class="p-normal">发现</p></div>
    <div><img class="btn-normal" src="{:base_url('image/myself.png')}"><p class="p-normal">我</p></div>
</div>

<!--选择周数-->
<div class="week-select">
    <div class="week week-border">
        <span>今天</span>
        <p>周二</p>
    </div>

    <div class="week">
        <span>明天</span>
        <p>周三</p>
    </div>

    <div class="week">
        <span>27日</span>
        <p>周四</p>
    </div>

    <div class="week">
        <span>28日</span>
        <p>周五</p>
    </div>

    <div class="week">
        <span>29日</span>
        <p>周六</p>
    </div>

    <div class="week">
        <span>30日</span>
        <p>周日</p>
    </div>

    <div class="week">
        <span>31日</span>
        <p>周一</p>
    </div>

    <div id="slide" class="slide"></div>
</div>

<!--预约项目-->
<div id="reserve0">
    <div class="box-reserve">
    <span class="box-reserve-date">2016年10月25日</span>
    <button class="box-reserve-btn">立即预约</button>
    <p class="box-reserve-time">8:00 - 10:00</p>
    <div class="box-reserve-line"></div>
    <span class="box-reserve-court">场馆余量: </span><span class="box-reserve-court-num">3</span>
    <span class="box-reserve-court">场馆总量: </span><span class="box-reserve-court-num">5</span>
    <span class="box-reserve-cost">¥49.99</span>
</div>
</div>

<div id="reserve1">
    <div class="box-reserve">
        <span class="box-reserve-date">2016年10月26日</span>
        <button class="box-reserve-btn">立即预约</button>
        <p class="box-reserve-time">8:00 - 10:00</p>
        <div class="box-reserve-line"></div>
        <span class="box-reserve-court">场馆余量: </span><span class="box-reserve-court-num">3</span>
        <span class="box-reserve-court">场馆总量: </span><span class="box-reserve-court-num">5</span>
        <span class="box-reserve-cost">¥49.99</span>
    </div>
</div>

<div id="reserve2">
    <div class="box-reserve">
        <span class="box-reserve-date">2016年10月27日</span>
        <button class="box-reserve-btn">立即预约</button>
        <p class="box-reserve-time">8:00 - 10:00</p>
        <div class="box-reserve-line"></div>
        <span class="box-reserve-court">场馆余量: </span><span class="box-reserve-court-num">3</span>
        <span class="box-reserve-court">场馆总量: </span><span class="box-reserve-court-num">5</span>
        <span class="box-reserve-cost">¥49.99</span>
    </div>
</div>

<div id="reserve3">
    <div class="box-reserve">
        <span class="box-reserve-date">2016年10月28日</span>
        <button class="box-reserve-btn">立即预约</button>
        <p class="box-reserve-time">8:00 - 10:00</p>
        <div class="box-reserve-line"></div>
        <span class="box-reserve-court">场馆余量: </span><span class="box-reserve-court-num">3</span>
        <span class="box-reserve-court">场馆总量: </span><span class="box-reserve-court-num">5</span>
        <span class="box-reserve-cost">¥49.99</span>
    </div>
</div>

<div id="reserve4">
    <div class="box-reserve">
        <span class="box-reserve-date">2016年10月29日</span>
        <button class="box-reserve-btn">立即预约</button>
        <p class="box-reserve-time">8:00 - 10:00</p>
        <div class="box-reserve-line"></div>
        <span class="box-reserve-court">场馆余量: </span><span class="box-reserve-court-num">3</span>
        <span class="box-reserve-court">场馆总量: </span><span class="box-reserve-court-num">5</span>
        <span class="box-reserve-cost">¥49.99</span>
    </div>
</div>

<div id="reserve5">
    <div class="box-reserve">
        <span class="box-reserve-date">2016年10月30日</span>
        <button class="box-reserve-btn">立即预约</button>
        <p class="box-reserve-time">8:00 - 10:00</p>
        <div class="box-reserve-line"></div>
        <span class="box-reserve-court">场馆余量: </span><span class="box-reserve-court-num">3</span>
        <span class="box-reserve-court">场馆总量: </span><span class="box-reserve-court-num">5</span>
        <span class="box-reserve-cost">¥49.99</span>
    </div>
</div>

<div id="reserve6">
    <div class="box-reserve">
        <span class="box-reserve-date">2016年10月31日</span>
        <button class="box-reserve-btn">立即预约</button>
        <p class="box-reserve-time">8:00 - 10:00</p>
        <div class="box-reserve-line"></div>
        <span class="box-reserve-court">场馆余量: </span><span class="box-reserve-court-num">3</span>
        <span class="box-reserve-court">场馆总量: </span><span class="box-reserve-court-num">5</span>
        <span class="box-reserve-cost">¥49.99</span>
    </div>
</div>

<script type="text/javascript" src="{:base_url('js/reserve.js')}"></script>
</body>
</html>