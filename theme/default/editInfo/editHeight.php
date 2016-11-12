<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>预约</title>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/tab-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/myself.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/edit/editHeight.css')}">
</head>
<body>
<!--微信自带顶部栏-->
<div class="topbar-default">
    <img class="back" src="{:base_url('image/back_white.png')}">
    <span>修改身高</span>
    <button class="save">保存</button>
</div>

<!--身高-->
<div class="reserve-message">
    <form class="form-height" action="<?php echo site_url('User/addHeight'); ?>" method="POST">
        <input class="edit-height" type="number" min="150" max="200" name="height" value="<?php echo $height;?>" >
        <button class="save">保存</button>
    </form>
</div>

</body>
</html>