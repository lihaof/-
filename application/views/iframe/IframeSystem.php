<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/manage.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/form.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
</head>
<style>
    .box-search{
        height: 30px;
        line-height: 30px;
        float: right;
        margin: auto;
        margin-top: 20px;
    }

    .box-search-input{
        width: 80%;
        height: 100%;
        background-color: #fff;
        float: left;
        padding: 0 10px;
    }

    .box-search-btn{
        width: 20%;
        height: 100%;
        background-color: #54a9ff;
        float: left;
        color: #fff;
        padding: 0 5px;
        text-align: center;
        cursor: pointer;
    }
</style>
<body>
<div class="iframe-all">
    <!--侧面栏-->
    <div id="nav">
        <ul>
            <li class="module module2">未审核<img class="module-img" src="<?php echo base_url('image/in.png'); ?>"></li>
            <li class="module">已审核<img class="module-img" src="<?php echo base_url('image/in.png'); ?>"></li>
        </ul>
    </div>

    <div id="searchBtn" class="box-search">
        <input type="text" class="box-search-input" placeholder="关键词搜索">
        <div class="box-search-btn">搜 索</div>
    </div>

    <!--未审核-->
    <table class="form-style">
        <tr>
            <th>队伍ID</th>
            <th>球队头像</th>
            <th>球队名</th>
            <th>队长</th>
            <th>球队宣言</th>
            <th>审核状态</th>
            <th colspan="2" >操作</th>
        </tr>

        <tr>
            <td>1</td>
            <td style="padding: 0"><img class="team-img" src="<?php echo base_url('image/fruit.png'); ?>"></td>
            <td>球队1</td>
            <td>李明</td>
            <td style="overflow: hidden">一定要赢</td>
            <td class="status" style="color: #b63d3c">未审核</td>
            <td class="agree-btn"><button id="temp1" onclick="agree(this.id)">同意</button></td>
            <td class="agree-btn"><button id="temp2" onclick="refuse(this.id)" style="color: #ee716b">拒绝</button></td>
        </tr>
    </table>


    <!--通过审核-->
    <table id="agreed" class="form-style">
        <thead>
            <tr>
                <th>队伍ID</th>
                <th>球队头像</th>
                <th>球队名</th>
                <th>队长</th>
                <th>球队宣言</th>
                <th>审核状态</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>2</td>
                <td style="padding: 0"><img class="team-img" src="<?php echo base_url('image/fruit.png'); ?>"></td>
                <td>球队2</td>
                <td>张三</td>
                <td style="overflow: hidden">必胜</td>
                <td style="color: #2bb654">审核通过</td>
            </tr>
        </tbody>
    </table>



</div>

<script type="text/javascript" src="<?php echo base_url('js/iframe.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/iframeTeam.js'); ?>"></script>
</body>
</html>