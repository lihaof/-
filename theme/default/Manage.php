<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理页面</title>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/manage.css')}">
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
</head>


<body>
<!--首部-->
<div id="head">
    <img src="{:base_url('image/logo.png')}" class="logo">
    <div class="title">
        <div class="title-big">篮球场智能管理系统</div>
        <div class="title-small">BASKETBALL MANAGEMENT SYSTEM</div>
    </div>
</div>

<!--选项卡-->
<div id="tab">
    <ul>
<!--{foreach $module1 $row}-->
        <li class="tab-li" id={:$row['identity']} >{:$row['module_name']}</li>
<!--{/foreach}-->
    </ul>
</div>



<!--操作区域-->
<div class="operate" id="operate">
    <iframe src="{:site_url('Manage')}/iframe/IframeTime" id="iframeSlect" width="100%" height="100%" frameborder="0" scrolling="no" style="min-height: 700px"></iframe>
</div>

<script>
    //修改iframe宽度
    function apdateIframe() {
        $('#operate').width($(window).width() - $('#nav').width()) - 100;
        $('#iframeSlect').width($('#operate').width());
    }

    $(window).load(function(){

        //iframe高度自适应
        var addBtn = $("#iframeSlect").contents().find('.add');
        addBtn.click(function () {
            $("#operate").height($("#operate").height() + 45);
        });

        apdateIframe();

        //改变iframe地址
        $('.tab-li').each(function () {
            $(this).click(function () {
                var url = "{:site_url('Manage')}/iframe/Iframe" + $(this).attr('id');
                $('#iframeSlect').fadeOut(100).attr('src',url).fadeIn(400);
                console.log(url);
            });

        });

        //点击子模块
        $('.module').each(function () {
            $(this).click(function () {
                $('.module').removeClass('module2');
                $(this).addClass('module2');
            });
        });
    });

    //改变窗口大小时自适应
    $(window).resize(function(){
        apdateIframe();
    });

    //时段管理区块(第一个)选项卡高亮
    $('.tab-li').eq(0).addClass('tab-li2');

    //选项卡点击效果
    $('.tab-li').each(function (){
        $(this).click(function(){
            $('.tab-li').removeClass('tab-li2');
            $(this).addClass('tab-li2');
        });
    });
</script>
</body>
</html>