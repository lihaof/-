<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/manage.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/form.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
</head>
<body>
<button id="btn">get</button>
<script>
    $(document).ready(function(){
        $("#btn").click(function(){
            console.log('111');
            $.getJSON("tt.js",function(result){console.log('222');
                $.each(result, function(i, field){
                    $("p").append(field + " ");
                });
            });
        });
    });
</script>
</body>
</html>