<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/manage.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/form.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/bootstrap.min.css')}">
    <script type="text/javascript" src="{:base_url('js/iframe.js')}"></script>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
</head>
<body>
<div class="iframe-all">
    <!--侧面栏-->
    <div id="nav">
        <ul>
            <li class="module module2">子模块10<img class="module-img" src="{:base_url('image/in.png')}"></li>
            <li class="module">子模块11<img class="module-img" src="{:base_url('image/in.png')}"></li>
            <li class="module">子模块12<img class="module-img" src="{:base_url('image/in.png')}"></li>
        </ul>
    </div>

    <!--表格-->
    <table id="form" class="form-style">
        <tr>
            <th>姓名</th>
            <th>年龄</th>
            <th>性别</th>
            <th>积分</th>
            <th>场次</th>
            <th>时间</th>
        </tr>

        <tr>
            <td>李明</td>
            <td>18</td>
            <td>男</td>
            <td>1000</td>
            <td>第三场</td>
            <td>2016-11-11</td>
        </tr>
    </table>
</div>

<script type="text/javascript" src="{:base_url('js/iframe.js')}"></script>
</body>
</html>