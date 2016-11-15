<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
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
            margin-top: 10px;
            text-align: center;
            height: 45px;
            background: #fff;
            line-height: 45px;
            padding-left: 10px;
            box-sizing: border-box;
        }

        .add-form input{
            margin-bottom: 15px;
            width: 80%;
            height: 20px;
            border-radius: 3px;
            border: none;
            font-size: 20px;
            text-align: right;
            color: #464646;
            padding-right: 20px;
            box-sizing: border-box;
        }

        .add-form span{
            font-size: 16px;
            float: left;
            color: #9d9d9d;
        }

        .add-form select{
            width: 130px;
            height: 30px;
            float: right;
            border: none;
            margin-top: 7.5px;
            margin-right: 10px;
            text-align: right;
        }

        .btn-check{
            width: 70%;
            height: 40px;
            background-color: #01ba60;
            border: 1px solid #ececec;
            padding: 0 10px;
            margin-top: 28px;
            border-radius: 3px;
            color: #fff;
            font-size: 17px;
        }

    </style>
</head>
<body>
  <!-- 用户完善信息的表单 -->
  <form action="<?php echo site_url('User/addUser'); ?>" method="POST">
      <div class="add-form">
          <span>体重(kg): </span>
          <input type="number" min="40" max="100" value="70" name="weight">
      </div>
      <div class="add-form">
          <span>身高(cm): </span>
          <input type="number" min="150" max="200" value="175" name="height">
      </div>
      <div class="add-form">
          <span>场位: </span>
          <select name="position">
               <option value="1">控球后卫PG</option>
               <option value="2">等分后卫SG</option>
               <option value="3">小前锋SF</option>
               <option value="4">大前锋PF</option>
               <option value="5">中锋C</option>
          </select>
      </div>

       <button class="btn-check" type="submit">提 交</button>
  </form>

</body>
</html>