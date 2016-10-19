<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>">
</head>
<body>

    <!--首部-->
    <div class="head">
        <img src="<?php echo base_url('image/logo.png'); ?>" class="logo">
        <div class="title">
            <div class="title-big">篮球场智能管理系统</div><br>
            <div class="title-small">BASKETBALL MANAGEMENT SYSTEM</div>
        </div>
    </div>

    <!--中部-->
    <div class="main">
        <div class="main-title">
            <div class="main-title-big"></div>
            <div class="main-title-small">一站式解决方案</div>
        </div>
        <div class="login-box">
            <div class="box-title">登录到管理台</div>
            <?php echo form_open('login/login_process'); ?>
            <!--输入账号-->
            <div class="box-input">
                <div class="box-input-title">账号</div>
                <input class="box-input-content" type="text" name="user">
            </div>
            <!--输入密码-->
            <div class="box-input">
                <div class="box-input-title">密码</div>
                <input class="box-input-content" type="password" name="password">
            </div>
            <!--输入验证码-->
            <div class="box-input">
                <div class="box-input-title">验证码</div>
                <input class="box-input-content" style="width: 170px" type="text" name="verify">
                <div class="verify"></div>
            </div>
            <!--登录按钮-->
            <div>
                <input class="login-btn" type="submit" value="登 录">
            </div>
        </div>
    </div>

    <!--尾部-->
    <footer>
        <p>(C)COPYRIGHT 某某篮球馆 2016 版权所有</p>
        <p>技术支持：西二在线工作室</p>
    </footer>

</body>
</html>