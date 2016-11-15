<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height">
    <title>预约</title>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/tab-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/reserve.css')}">
</head>
<body style="padding-bottom: 100px">
<!--微信自带顶部栏-->
<!-- <div class="topbar-default">
    <img class="back" src="{:base_url('image/back_white.png')}">
    <span>预约</span>
</div> -->

<!--选择周数-->
<div class="week-select">
    <!--{execute}--> 
    $week=array("日","一","二","三","四","五","六");
    for($i=0;$i<7;$i++) {
        echo '<div class="week">';
        if($i > 0) {
            echo '<span>'.date('j',time()+86400*$i).'号</span>';
        } else {
            echo '<span>今天</span>';
        }
        echo '<p><a href="'.site_url('Reserve/index/'.date('Y/m/d/',time()+86400*$i)).'">周'.$week[date("w",time()+86400*$i)].'</a></p></div>';
    }
    <!--{/execute}-->
</div>
<!--滑动条-->

<!--{execute}-->
$num = floor((strtotime($date) - strtotime(date('Y-m-d',time()))) / (60*60*24)) * 100;
<!--{/execute}-->
<div class="slide" id="slide" style="left: calc({:$num}%/7)"></div>

<!--预约项目-->
<div id="reserve0">
    <!--{foreach $list $key $val}-->
    <div class="box-reserve">
    <span class="box-reserve-date">{:$val['date']}</span>
    <button class="box-reserve-btn"><a style="color: #fff" href="{:site_url('Order/add/'.$val['list_id'])}">立即预约</a></button>
    <p class="box-reserve-time">{:$val['start']} - {:$val['end']}</p>
    <div class="box-reserve-line"></div>
    <span class="box-reserve-court">场馆余量: </span><span class="box-reserve-court-num">{:$val['surplus_num']}</span>
    <span class="box-reserve-court">场馆总量: </span><span class="box-reserve-court-num">{:$val['court_num']}</span>
    <span class="box-reserve-cost">¥{:$val['price']}</span>
    </div>
    <!--{/foreach}-->
</div>

    <!-- <div class="box-reserve">
        <span class="box-reserve-date">2016-10-25</span>
        <button class="box-reserve-btn"><a href="">立即预约</a></button>
        <p class="box-reserve-time">8:00-10:00</p>
        <div class="box-reserve-line"></div>
        <span class="box-reserve-court">场馆余量: </span><span class="box-reserve-court-num">1</span>
        <span class="box-reserve-court">场馆总量: </span><span class="box-reserve-court-num">1</span>
        <span class="box-reserve-cost">¥49.99</span>
    </div> -->

<!--底部栏-->
<div class="bottom">
    <div><img class="btn-normal btn-pressed" src="{:base_url('image/reserve.png')}"><p class="p-normal p-pressed">预约</p></div>
    <div onclick="window.location='{:base_url("index.php/team")}';"><img class="btn-normal" src="{:base_url('image/match.png')}"><p class="p-normal">球队</p></div>
    <div><img class="btn-normal" src="{:base_url('image/find.png')}"><p class="p-normal">发现</p></div>
    <div onclick="window.location='{:base_url("index.php/myself")}';"><img class="btn-normal" src="{:base_url('image/myself.png')}"><p class="p-normal">我</p></div>
</div>

 <script type="text/javascript" src="{:base_url('js/reserve.js')}"></script>
</body>
</html>