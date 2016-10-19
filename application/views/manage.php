<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理页面</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/manage.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
</head>


<body>
    <!--首部-->
    <div id="head">
        <img src="<?php echo base_url('image/logo.png'); ?>" class="logo">
        <div class="title">
            <div class="title-big">篮球场智能管理系统</div>
            <div class="title-small">BASKETBALL MANAGEMENT SYSTEM</div>
        </div>
    </div>

    <!--选项卡-->
    <div id="tab">
        <ul>
            <?php foreach ($module1 as $row): ?>
                <li class="tab-li" id=<?php strtolower($row['identity']) ?>><?php echo $row['module_name'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    

    <!--操作区域-->
    <div class="operate" id="operate">
        <iframe src="iframe/IframeHome" id="iframeSlect" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
    </div>


    <script>
        //修改iframe宽度
        function apdateIframe() {
            $('#operate').width($(window).width() - $('#nav').width()) - 100;
            $('#iframeSlect').width($('#operate').width());
        }

        $(window).load(function(){
            apdateIframe();

            //改变iframe地址
            $('.tab-li').each(function () {
                $(this).click(function () {
                    var url = 'iframe/Iframe' + $(this).attr('id');
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