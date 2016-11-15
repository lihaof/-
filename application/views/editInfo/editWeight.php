<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>预约</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">    <title>预约</title>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/top-bar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/tab-bar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/myself.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/edit/edit.css'); ?>">
</head>
<body>
<!--体重-->
<div class="reserve-message">
    <form class="form" action="<?php echo site_url('User/addWeight'); ?>" method="POST" >
        <input class="edit" type="number" name="weight" value = "<?php echo $weight;?>">
        <button class="save">保存</button>
    </form>

</div>

</body>
</html>