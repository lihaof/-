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
    <link rel="stylesheet" type="text/css" href="{:base_url('css/edit/editWeight.css')}">
</head>
<body>
<!--微信自带顶部栏-->
<div class="topbar-default">
    <img class="back" src="{:base_url('image/back_white.png')}">
    <span>修改体重</span>
    <button class="save">保存</button>
</div>

<!--体重-->
<div class="reserve-message">
    <form class="form-weight" action="<?php echo site_url('User/addWeight'); ?>" method="POST" >
        <input class="edit-weight" type="number" min="40" max="100" name="weight" value = "<?php echo $weight;?>">
        <button class="save">保存</button>
    </form>

</div>

</body>
</html>