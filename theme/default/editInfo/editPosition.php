<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>修改场位</title>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/tab-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/myself.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/edit/edit.css')}">
</head>
<body>
<!--场位-->
<div class="reserve-message">
    <form class="form-Position" action="<?php echo site_url('User/addPosition'); ?>" method="POST">
        <select name="position" value="<?php echo $position; ?>">
           <option value="1">控球后卫PG</option>
           <option value="2">等分后卫SG</option>
           <option value="3">小前锋SF</option>
           <option value="4">大前锋PF</option>
           <option value="5">中锋C</option>
        </select>
        <button class="save">保存</button>
    </form>
</div>
<script>
    $('.edit').focus();
</script>
</body>
</html>