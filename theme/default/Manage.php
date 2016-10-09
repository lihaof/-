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
            <div class="title-big">篮球场智能管理系统</div><br>
            <div class="title-small">BASKETBALL MANAGEMENT SYSTEM</div>
        </div>
    </div>

    <!--选项卡-->
    <div id="tab">
        <ul>
            <li class="tab-li tab-li2" id="home">首页</li>
            <li class="tab-li" id="time">时段管理</li>
            <li class="tab-li" id="reserve">预约管理</li>
            <li class="tab-li" id="system">系统管理</li>
        </ul>
    </div>

    <!--侧面栏-->
    <div id="nav">
        <ul>
            <li class="module">子模块1<span class="arrow">></span></li>
            <li class="module">子模块2<span class="arrow">></span></li>
            <li class="module">子模块3<span class="arrow">></span></li>
        </ul>
    </div>

    <!--操作区域-->
    <div class="operate" id="operate">
        <iframe src="iframe/iframe_home.php" id="iframeSlect" width="" height="100%" frameborder="0" scrolling="no"></iframe>
    </div>


    <script>
        //修改iframe宽度
        function apdateIframe() {
            $('#operate').width($(window).width() - $('#nav').width());
            $('#iframeSlect').width($('#operate').width());
        }

        $(window).load(function(){
            apdateIframe();

            //改变iframe地址
            $('.tab-li').each(function () {
                $(this).click(function () {
                    var url = 'iframe/iframe_' + $(this).attr('id') + '.html';
                    $('#iframeSlect').fadeOut(100).attr('src',url).fadeIn(400);

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

        //选项卡点击效果
        $('.tab-li').each(function (){
            $(this).click(function(){
                $('.tab-li').removeClass('tab-li2');
                $(this).addClass('tab-li2');
            });
        });

        $('home').click(function(){
            $.get("demo_test.asp",function(data,status){
                alert("Data: " + data + "\nStatus: " + status);
            });
        });




    </script>
</body>
</html>