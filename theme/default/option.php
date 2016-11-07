<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <title>设置页面</title>
</head>
<style>
    *{
        padding: 0;
        margin: 0;
        font-family: "Helvetica Neue", Helvetica, STHeiTi, sans-serif;
    }

    body{
        padding: 30px 0;
        background-color: #f6f6f3;
    }

    .main-box{
        width: 100%;
        height: auto;
        text-align: center;
    }

    .main-box-title{
        font-size: 25px;
    }

    .box{
        width: 700px;
        height: 100px;
        margin: 0 auto;
        margin-bottom: 10px;
    }

    .box-title{
        font-size: 16px;
        color: #656565;
        float: left;
    }

    .box-input{
        width: 700px;
        height: 30px;
        float: left;
        margin-top: 10px;
        border-radius: 3px;
        border: 1px solid #ddd;
        box-sizing: border-box;
        font-size: 16px;
        padding: 0 10px;
    }

    .box-hint{
        float: left;
        font-size: 14px;
        margin-top: 10px;
        color: #b6b6b6;
    }

    .box-radio-form{
        margin-top: 20px;
    }

    .box-radio{
        float: left;
        color: #5d5d5d;
    }

    .box-radio-text{
        float: left;
        margin-left: 10px;
        color: #363636;
        margin-right: 20px;
    }

    .box-checkbox-form{
        margin-top: 20px;
    }

    .box-checkbox{
        float: left;
        margin-top: 3px;

    }

    .box-checkbox-text{
        float: left;
        margin-left: 10px;
        color: #363636;
        margin-right: 10px;
    }

    .btn-check{
        width: 120px;
        height: 36px;
        border: 1px solid #f0f0f0;
        background-color: #fff;
        border-radius: 3px;
    }

    .box-select{
        width: 700px;
        height: 30px;
        float: left;
        margin-top: 10px;
        border-radius: 3px;
        border: 1px solid #ddd;
        box-sizing: border-box;
        background-color: #fff;
        font-size: 16px;
        padding: 0 10px;
    }




</style>
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