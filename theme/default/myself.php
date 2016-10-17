<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>预约</title>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: "Microsoft Yahei", sans-serif;
        }

        body{
            background: #f4f4f4;
        }

        .topbar-default{
            width: 100%;
            height: 130px;
            background-color: #474747;
            line-height: 130px;
            font-size: 40px;
            color: #fff;
            text-align: center;
        }

        .default-topbar span{

        }

        .top-style{
            width: 100%;
            height: 310px;
            background-color: #758EFC;
        }

        .img-portrait{
            width: 130px;
            height: 130px;
            margin-top: 85px;
            margin-left: 50px;
            border-radius: 50%;
            float: left;
        }

        .top-style p{
            color: #fff;
            font-size: 50px;
            float: left;
            line-height: 310px;
            margin-left: 60px;
        }

        .btn-in{
            width: 80px;
            height: 80px;
            margin-top: 115px;
            margin-right: 20px;
            float: right;
        }

        .level{
            width: 100%;
            height: 120px;
            font-size: 25px;
            color: #fff;
            background-color: #6980E3;
            line-height: 120px;
        }

        .level img{
            width: 70px;
            height: 70px;
            margin-top: 25px;
            margin-left: 87px;
            float: left;
        }

        .level span{
            color: #fff;
            font-size: 37px;
            margin-left: 30px;
        }

        .reserve-message{
            width: 100%;
            height: 150px;
            background-color: #fff;
            margin-top: 30px;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            line-height: 150px;
        }

        .img-default{
            width: 90px;
            height: 90px;
            margin-top: 30px;
            margin-left: 50px;
            float: left;
        }

        .reserve-message span{
            color: #000;
            font-size: 40px;
            margin-left: 40px;
            display: block;
            float: left;
        }

        .btn-in2{
            width: 60px;
            height: 60px;
            margin-top: 40px;
            margin-right: 45px;
            float: right;
        }

        .box-left{
            width: 50%;
            height: 200px;
            float: left;
            background-color: #fff;
            text-align: center;
        }

        .box-right{
            width: 50%;
            height: 200px;
            float: right;
            background-color: #fff;
            text-align: center;
        }

        .box-all{
            width: 100%;
            height: 180px;
            background-color: #fff;
            padding: 20px 0;
            margin-top: 5px;
            margin-bottom: 35px;
        }

        .line{
            height: 180px;
            width: 5px;
            background-color: #f4f4f4;
            float: left;
        }

        .box-num{
            margin-top: 45px;
            font-size: 55px;
            color: #000;
        }

        .box-text{
            margin-top: 20px;
            font-size: 30px;
            color: #343434;
        }

        .list{
            width: 100%;
            height: 120px;
            background-color: #fff;
            margin-top: 3px;
            line-height: 120px;
        }

        .list span{
            display: block;
            float: left;
            font-size: 40px;
            color: #3a3a3a;
        }

        .list-img{
            width: 80px;
            height: 80px;
            margin-top: 20px;
            margin-left: 50px;
            /*float: left;*/
        }

        .img-border{
            width: 180px;
            height: 120px;
            background-color: #fff;
            float: left;
            border-bottom: 3px solid #fff;
        }

        .btn-in3{
            width: 50px;
            height: 50px;
            margin-top: 35px;
            margin-right: 30px;
            float: right;
        }

        .bottom{
            width: 100%;
            height: 150px;
            background: #fff;
            position: fixed;
            bottom: 0;

        }

        .bottom div{
            width: 25%;
            float: left;
            text-align: center;
            margin-top: 25px;
        }

        .bottom img{
            width: 68px;
            height: 68px;
            margin-bottom: 13px;
        }

        .p-normal{
            font-size: 23px;
            color: #c7c7c7;
        }

        .p-pressed{
            font-size: 23px;
            color: #52dd5f;
        }

        .btn-normal{
            background-color: #ddd;
        }

        .btn-pressed{
            background-color: #52dd5f;
        }


    </style>
</head>
<body>
    <!--微信自带顶部栏-->
    <div class="topbar-default">
        <span>微信</span>
    </div>
    <!--顶部信息-->
    <div class="top-style">
        <img class="img-portrait" src="{:base_url('image/fruit.png')}">
        <p>Vonlion</p>
        <img class="btn-in" src="{:base_url('image/in-white.png')}">
    </div>

    <!--会员等级-->
    <div class="level">
        <img src="{:base_url('image/vip.png')}">
        <span>初级会员</span>
    </div>

    <!--预约信息-->
    <div class="reserve-message">
        <img class="img-default" src="{:base_url('image/reserve_message.png')}">
        <span>预约信息</span>
        <img class="btn-in2" src="{:base_url('image/in.png')}">
    </div>

    <!--余额和积分-->
    <div class="box-all">
        <div class="box-left">
            <p class="box-num">¥0.00</p>
            <p class="box-text">账户余额</p>
        </div>
        <div class="line"></div>
        <div class="box-right">
            <p class="box-num">12345</p>
            <p class="box-text">可用积分</p>
        </div>
    </div>

    <!--购买的物品-->
    <div class="list">
        <div class="img-border"><img class="list-img" src="{:base_url('image/cart.png')}"></div>
        <span>购买的物品</span>
        <img class="btn-in3" src="{:base_url('image/in.png')}">
    </div>

    <!--我的信息-->
    <div class="list">
        <div class="img-border"><img class="list-img" src="{:base_url('image/message.png')}"></div>
        <span>我的信息</span>
        <img class="btn-in3" src="{:base_url('image/in.png')}">
    </div>

    <!--团队战绩-->
    <div class="list">
        <div class="img-border"> <img class="list-img" src="{:base_url('image/grade.png')}"></div>
        <span>团队战绩</span>
        <img class="btn-in3" src="{:base_url('image/in.png')}">
    </div>

    <!--客服与反馈-->
    <div class="list">
        <div class="img-border" style="border: none"><img class="list-img" src="{:base_url('image/service.png')}"></div>
        <span>客服与反馈</span>
        <img class="btn-in3" src="{:base_url('image/in.png')}">
    </div>

    <!--底部栏-->
    <div class="bottom">
        <div><img class="btn-normal" src="{:base_url('image/reserve.png')}"><p class="p-normal">预约</p></div>
        <div><img class="btn-normal" src="{:base_url('image/match.png')}"><p class="p-normal">约战</p></div>
        <div><img class="btn-normal" src="{:base_url('image/find.png')}"><p class="p-normal">发现</p></div>
        <div><img class="btn-normal btn-pressed" src="{:base_url('image/myself.png')}"><p class="p-normal p-pressed">我</p></div>
    </div>

    <script>
        $(document).ready(function () {
            $('.bottom div').each(function () {
                $(this).click(function () {
                    $('.btn-normal').removeClass('btn-pressed');
                    $('.p-normal').removeClass('p-pressed');
                    $(this).children('img').addClass('btn-pressed');
                    $(this).children('p').addClass('p-pressed');
                })

            });

            $('.box-left').width($('.box-left').width()-2.5);
            $('.box-right').width($('.box-right').width()-2.5);
        });
    </script>
</body>
</html>