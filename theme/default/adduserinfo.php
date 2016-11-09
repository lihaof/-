<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户完善信息</title>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">
<!--    <link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">-->
    <style>

        body{
            text-align: center;
        }

        .add-form{
            width: 100%;
            margin-top: 30px;
            text-align: center;
        }

        .add-form input{
            margin-bottom: 15px;
            width: 120px;
            height: 20px;
            border-radius: 3px;
            border: 1px solid #ddd;
            margin-left: -80px;
        }

        .add-form span{
            margin-left: 60px;
            font-size: 16px;
            color: #3a3a3a;
            float: left;
        }

        .add-form select{
            width: 130px;
            height: 30px;
            margin-left: -50px;
        }

        .btn-check{
            width: 100px;
            height: 30px;
            background-color: #01ba60;
            border: 1px solid #ececec;
            padding: 0 10px;
            margin-top: 20px;
            border-radius: 3px;
            color: #fff;
        }

    </style>
</head>
<body>
<!--微信自带顶部栏-->
<div class="topbar-default">
    <span>完善信息</span>
</div>

  <!-- 用户完善信息的表单 -->
  <form class="add-form" action="<?php echo site_url('User/addUser'); ?>" method="POST">
      <span>体重(kg): </span><input type="number" min="40" max="100" value="70" name="weight"><br>
      <span>身高(cm): </span><input type="number" min="150" max="200" value="175" name="height"><br>
      <span>场位: </span>
      <select name="position">
           <option value="1">控球后卫PG</option>
           <option value="2">等分后卫SG</option>>
           <option value="3">小前锋SF</option>>
           <option value="4">大前锋PF</option>>
           <option value="5">中锋C</option>>
      </select>
       <br>
       <button class="btn-check" type="submit">提 交</button>
  </form>

</body>
</html>