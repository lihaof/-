<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>预约</title>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/tab-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/myself.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/edit/editPosition.css')}">
</head>
<body>
<!--微信自带顶部栏-->
<div class="topbar-default">
    <img class="back" src="{:base_url('image/back_white.png')}">
    <span>修改身高</span>
    <button class="save">保存</button>
</div>

<!--场位-->
<div class="reserve-message">
    <form class="form-Position" action="<?php echo site_url('User/addPosition'); ?>" method="POST">
        <select name="position">
           <option value="1">控球后卫PG</option>
           <option value="2">等分后卫SG</option>>
           <option value="3">小前锋SF</option>>
           <option value="4">大前锋PF</option>>
           <option value="5">中锋C</option>>
        </select>
        <button class="save">保存</button>
    </form>
</div>

</body>
</html>