<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>预约信息</title>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/top-bar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/tab-bar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reserve.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/ReserveMessage.css'); ?>">
</head>
<body>
<!--预约项目-->

<?php foreach($list as $val): ?>
    <?php if($val["status"]==1): ?>
        <div class="box-reserve">
            <span class="box-reserve-date"><?php echo $val["date"]; ?></span>
            <div class="box-reserve-status1">已预约</div>
            <span class="box-reserve-cost">¥<?php echo $val["price"]; ?></span>
            <p class="box-reserve-time"><?php echo $val["start"]; ?>-<?php echo $val["end"]; ?></p>
        </div>
    <?php elseif($val["status"]==2): ?>
        <div class="box-reserve">
            <span class="box-reserve-date"><?php echo $val["date"]; ?></span>
            <div class="box-reserve-status2">已取消</div>
            <span class="box-reserve-cost">¥<?php echo $val["price"]; ?></span>
            <p class="box-reserve-time"><?php echo $val["start"]; ?>-<?php echo $val["end"]; ?></p>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<script type="text/javascript" src="<?php echo base_url('js/reserve.js'); ?>"></script>
</body>
</html>