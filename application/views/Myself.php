<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=yes">
    <title>我的主页</title>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/top-bar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/tab-bar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/myself.css'); ?>">
</head>
<body>

    <!--顶部信息-->
    <div class="top-style" onclick="window.location='<?php echo site_url("User/showUser"); ?>';">
        <img class="img-portrait" src="<?php echo base_url('image/fruit.png'); ?>">
        <p>Vonlion</p>
        <img class="btn-in" src="<?php echo base_url('image/in-white.png'); ?>">
    </div>

    <!--会员等级-->
    <div class="level">
        <img src="<?php echo base_url('image/vip.png'); ?>">
        <span>初级会员</span>
    </div>

    <!--预约信息-->
    <div class="reserve-message" onclick="window.location='<?php echo site_url("Order/showOrderList"); ?>';">
        <img class="img-default" src="<?php echo base_url('image/reserve_message.png'); ?>">
        <span>预约信息</span>
        <img class="btn-in2" src="<?php echo base_url('image/in.png'); ?>">
    </div>

    <!--余额和积分-->
    <div class="box-all">
        <div class="box-left">
            <p class="box-num">¥0.00</p>
            <p class="box-text">账户余额</p>
        </div>
        <div class="line"></div>
        <div class="box-right">
            <p class="box-num">12345</p>
            <p class="box-text">可用积分</p>
        </div>
    </div>

    <!--购买的物品-->
    <div class="list">
        <div class="img-border"><img class="list-img" src="<?php echo base_url('image/cart.png'); ?>"></div>
        <span>购买的物品</span>
        <img class="btn-in3" src="<?php echo base_url('image/in.png'); ?>">
    </div>

    <!--我的信息-->
    <div class="list" onclick="window.location='<?php echo site_url("User/showUser"); ?>';">
        <div class="img-border"><img class="list-img" src="<?php echo base_url('image/message.png'); ?>"></div>
        <span>我的信息</span>
        <img class="btn-in3" src="<?php echo base_url('image/in.png'); ?>">
    </div>

    <!--团队战绩-->
    <div class="list">
        <div class="img-border"> <img class="list-img" src="<?php echo base_url('image/grade.png'); ?>"></div>
        <span>团队战绩</span>
        <img class="btn-in3" src="<?php echo base_url('image/in.png'); ?>">
    </div>

    <!--客服与反馈-->
    <div class="list">
        <div class="img-border" style="border: none"><img class="list-img" src="<?php echo base_url('image/service.png'); ?>"></div>
        <span>客服与反馈</span>
        <img class="btn-in3" src="<?php echo base_url('image/in.png'); ?>">
    </div>

    <!--底部栏-->
    <div class="bottom">
        <div onclick="window.location='<?php echo base_url("index.php/reserve"); ?>';"><img class="btn-normal" src="<?php echo base_url('image/reserve.png'); ?>"><p class="p-normal">预约</p></div>
        <div onclick="window.location='<?php echo base_url("index.php/team"); ?>';"><img class="btn-normal" src="<?php echo base_url('image/match.png'); ?>"><p class="p-normal">球队</p></div>
        <div><img class="btn-normal" src="<?php echo base_url('image/find.png'); ?>"><p class="p-normal">发现</p></div>
        <div><img class="btn-normal btn-pressed" src="<?php echo base_url('image/myself.png'); ?>"><p class="p-normal p-pressed">我</p></div>
    </div>

    <script>
        $(document).ready(function () {
            $('.bottom div').each(function () {
                $(this).click(function () {
                    $('.btn-normal').removeClass('btn-pressed');
                    $('.p-normal').removeClass('p-pressed');
                    $(this).children('img').addClass('btn-pressed');
                    $(this).children('p').addClass('p-pressed');
                })

            });
            
        });


    </script>
</body>
</html>