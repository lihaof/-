<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>预约</title>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: "Microsoft Yahei", sans-serif;
        }

        body{
            background: #f4f4f4;
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

        .bottom p{
            font-size: 23px;
            color: #c7c7c7;
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
    <div class="bottom">
        <div><img class="btn-normal" src="<?php echo base_url('image/reserve.png'); ?>"><p>预约</p></div>
        <div><img class="btn-normal" src="<?php echo base_url('image/match.png'); ?>"><p>约战</p></div>
        <div><img class="btn-normal" src="<?php echo base_url('image/find.png'); ?>"><p>发现</p></div>
        <div><img class="btn-normal" src="<?php echo base_url('image/myself.png'); ?>"><p>我</p></div>
    </div>

    <script>
        $(document).ready(function () {
            $('.bottom div').each(function () {
                $(this).click(function () {
                    $('.btn-normal').removeClass('btn-pressed');
                    $('.bottom p').css('color','#c7c7c7');
                    $(this).children('img').addClass('btn-pressed');
                    $(this).children('p').css('color','#52dd5f');
                })

            })
        });
    </script>
</body>
</html>