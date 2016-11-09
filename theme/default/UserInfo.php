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
        .reserve-message{ width: 100%; height: 3rem; background-color: #fff; margin-top: 0rem; border-top: 0.01rem solid #ddd; border-bottom: 0.00rem solid #ddd; line-height: 3rem; }

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
<<<<<<< HEAD
<div class="reserve-message">
    <span>昵称 </span> <?php echo "       ".$nickname ;?>
=======
<div class="reserve-message" style="border-top: none">
    <span class="message-title">昵称</span>
    <span class="message-value">vonlion</span>
>>>>>>> 3547300f9d4d16aba6c175492b14cae0b5cfd8ec
</div>

<!--体重-->
<div class="reserve-message">
<<<<<<< HEAD
    <span>体重</span><?php echo "       ".$weight ;?>
=======
    <span class="message-title">体重</span>
>>>>>>> 3547300f9d4d16aba6c175492b14cae0b5cfd8ec
    <img class="btn-in2" src="{:base_url('image/in.png')}">
    <span class="message-value">120 kg</span>
</div>

<!--身高-->
<div class="reserve-message">
<<<<<<< HEAD
    <span>身高</span><?php echo "       ".$height ;?>
=======
    <span class="message-title">身高</span>
>>>>>>> 3547300f9d4d16aba6c175492b14cae0b5cfd8ec
    <img class="btn-in2" src="{:base_url('image/in.png')}">
    <span class="message-value">180 cm</span>
</div>

<br>

<!--场位-->
<<<<<<< HEAD
<div class="reserve-message">
    <span>场位</span><?php echo "       ".$position ;?>
=======
<div class="reserve-message" style="border-top: none">
    <span class="message-title">场位</span>
>>>>>>> 3547300f9d4d16aba6c175492b14cae0b5cfd8ec
    <img class="btn-in2" src="{:base_url('image/in.png')}">
    <span class="message-value">小前锋</span>
</div>

<!--积分-->
<div class="reserve-message">
<<<<<<< HEAD
    <span>积分</span><?php echo "       ".$point ;?>
=======
    <span class="message-title">积分</span>
    <span class="message-value">120</span>
>>>>>>> 3547300f9d4d16aba6c175492b14cae0b5cfd8ec
</div>

<!--球队-->
<div class="reserve-message">
<<<<<<< HEAD
    <span>球队</span><?php echo "       ".$teamid ;?>
=======
    <span class="message-title">球队</span>
    <span class="message-value">win战队</span>
>>>>>>> 3547300f9d4d16aba6c175492b14cae0b5cfd8ec
</div>

</body>
</html>