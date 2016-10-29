<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>预约</title>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/top-bar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/tab-bar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reserve.css'); ?>">
</head>
<body>
<!--微信自带顶部栏-->
<div class="topbar-default">
    <img class="back" src="<?php echo base_url('image/back_white.png'); ?>">
    <span>预约</span>
</div>

<!--底部栏-->
<div class="bottom">
    <div><img class="btn-normal btn-pressed" src="<?php echo base_url('image/reserve.png'); ?>"><p class="p-normal p-pressed">预约</p></div>
    <div><img class="btn-normal" src="<?php echo base_url('image/match.png'); ?>"><p class="p-normal">约战</p></div>
    <div><img class="btn-normal" src="<?php echo base_url('image/find.png'); ?>"><p class="p-normal">发现</p></div>
    <div><img class="btn-normal" src="<?php echo base_url('image/myself.png'); ?>"><p class="p-normal">我</p></div>
</div>

<!--选择周数-->
<div class="week-select">
    <?php 
    $week=array("日","一","二","三","四","五","六");
    for($i=0;$i<7;$i++) {
        echo '<div class="week">';
        echo '<span>'.date('j',time()+86400*$i).'号</span>';
        echo '<p><a href="'.site_url('Reserve/index/'.date('Y/m/d/',time()+86400*$i)).'">周'.$week[date("w",time()+86400*$i)].'</a></p></div>';
    }
    ?>
</div>
<!--滑动条-->
<div class="slide" id="slide"></div>

<!--预约项目-->
<div id="reserve0">
    <?php foreach($list as $key => $val): ?>
    <div class="box-reserve">
    <span class="box-reserve-date"><?php echo $val['date']; ?></span>
    <button class="box-reserve-btn"><a href="<?php echo site_url('Order/add/'.$val['list_id']); ?>">立即预约</a></button>
    <p class="box-reserve-time"><?php echo $val['start']; ?> - <?php echo $val['end']; ?></p>
    <div class="box-reserve-line"></div>
    <span class="box-reserve-court">场馆余量: </span><span class="box-reserve-court-num"><?php echo $val['surplus_num']; ?></span>
    <span class="box-reserve-court">场馆总量: </span><span class="box-reserve-court-num"><?php echo $val['court_num']; ?></span>
    <span class="box-reserve-cost">¥<?php echo $val['price']; ?></span>
    </div>
    <?php endforeach; ?>
</div>

 <script type="text/javascript" src="<?php echo base_url('js/reserve.js'); ?>"></script>
</body>
</html>