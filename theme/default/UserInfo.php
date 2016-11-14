<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes">
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
    <img class="back" src="{:base_url('image/back_white.png')}" onclick="window.location='{:base_url("index.php/myself")}';">
    <span>用户信息</span>
</div>
<!--顶部信息-->
<div class="top-style">
    <!--<img class="img-portrait" src="{:$picture}">-->
    <img class="img-portrait" src="{:base_url('image/default-avatar.png')}">
    <p><?php echo $nickname;?></p>
<!--    <img class="btn-in" src="{:base_url('image/in-white.png')}">-->
</div>

<!--会员等级-->
<div class="level">
    <img src="{:base_url('image/vip.png')}">
    <span>
          <?php
               if($point<=1000) {
                  echo "初级会员";
               } else if($point<=3000) {
                  echo "中级会员";
               } else if($point<=5000) {
                  echo "高级会员";
               } else if($point<=10000) {
                  echo "超高级会员";
               } else {
                  echo "VIP会员";
               }
          ?>   
    </span>
</div>

<br>

<!--昵称-->
<div class="reserve-message" style="border-top: none">
    <span class="message-title">昵称</span>
    <span class="message-value"><?php echo $nickname;?></span>
</div>

<!--体重-->
<div class="reserve-message">
    <span class="message-title">体重</span>
    <a href = "{:site_url('User/editWeight')}"><img class="btn-in2" src="{:base_url('image/in.png')}"></a>
    <span class="message-value"><?php echo $weight; ?> kg</span>
</div>

<!--身高-->
<div class="reserve-message">
    <span class="message-title">身高</span>
    <a href = "{:site_url('User/editHeight')}"><img class="btn-in2" src="{:base_url('image/in.png')}"></a>
    <span class="message-value"><?php echo $height?> cm</span>
</div>

<br>

<!--场位-->
<div class="reserve-message" style="border-top: none">
    <span class="message-title">场位</span>
    <a href = "{:site_url('User/editPosition')}"><img class="btn-in2" src="{:base_url('image/in.png')}"></a>
    <span class="message-value">
       <?php 
            if($position = 1) {
                echo "控球后卫PG";
            } else if($position = 2) {
                echo "等分后卫SG";
            } else if($position = 3) {
                echo "小前锋SF";
            } else if($position = 4) {
                echo "大前锋PF";
            } else {
                echo "中锋C";
            }
       ?>
    </span>
</div>

<!--积分-->
<div class="reserve-message">
    <span class="message-title">积分</span>
    <span class="message-value"><?php echo $point; ?></span>
</div>

<!--球队-->
<div class="reserve-message">
    <span class="message-title">球队</span>
    <span class="message-value"><?php echo $team_name;?></span>
</div>

</body>
</html>