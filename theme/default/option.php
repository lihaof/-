<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/option.css')}">
    <title>设置页面</title>
</head>

<body>
    <div class="main-box">
        <h class="main-box-title">基本设置</h>

        <!--输入框-->
        <div class="box">
            <p class="box-title">站点名称 :</p><br>
            <form action="">
                <input type="text" class="box-input">
                <p class="box-hint">一些提示一些提示一些提示一些提示一些提示一些提示</p>
            </form>
        </div>

        <!--单选框-->
        <div class="box">
            <p class="box-title">是否允许注册 :</p><br>
            <form class="box-radio-form" action="">
                <input class="box-radio" type="radio" name="sex" value="male"><span class="box-radio-text">不允许</span>
                <input class="box-radio" type="radio" name="sex" value="female"><span class="box-radio-text">允许</span>
            </form>
        </div>


        <!--时间选择-->
        <div class="box">
            <p class="box-title">时间 :</p><br>
            <form action="">
                <select class="box-select">
                    <option value="">2016-12-12 12:00-14:00</option>
                    <option value="">2016-12-12 12:00-14:00</option>
                    <option value="">2016-12-12 12:00-14:00</option>
                    <option value="">2016-12-12 12:00-14:00</option>
                </select>
            </form>
        </div>




        <!--时间选择-->
        <div class="box">
            <p class="box-title">允许上传的文件类型 :</p><br>
            <form class="box-checkbox-form" action="">
                <span class="box-checkbox-text">图片文件</span><input class="box-checkbox" type="checkbox"><br>
                <span class="box-checkbox-text">图片文件</span><input class="box-checkbox" type="checkbox"><br>
                <span class="box-checkbox-text">图片文件</span><input class="box-checkbox" type="checkbox"><br>
            </form>
        </div>

        <!--确认提交-->
        <button class="btn-check" type="submit">保存设置</button>

    </div>
</body>
</html>