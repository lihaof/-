<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/manage.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/form.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
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
            <li class="module module2">开放时段管理<img class="module-img" src="<?php echo base_url('image/in.png'); ?>"></li>
            <li class="module">具体时段管理<img class="module-img" src="<?php echo base_url('image/in.png'); ?>"></li>
        </ul>
    </div>

<<<<<<< HEAD
    <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
        <input type="text" class="form-control" value="13:14">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
    </div>
    <script type="text/javascript">
        $('.clockpicker').clockpicker();
    </script>



    <!--表格-->
    <table id="form" class="form-style">
=======
    <!--未审核-->
    <table class="form-style">
>>>>>>> 18d9eff68313fe7ad536ecccf130573e1500ebeb
        <tr>
            <th width="20%">开始时间</th>
            <th width="20%">结束时间</th>
            <th width="13%">价格</th>
            <th width="10%">球场数量</th>
            <th width="8%">状态</th>
            <th width="29%" colspan="3">操作</th>
        </tr>
        <?php

            $query = $this->db->get("open_time");
            $list = $query->result_array();
            $num_rows  = $query->num_rows();
        
?>
        <?php foreach($list as $key => $val): ?>
        <tr id="tab<?php echo $val['time_id']; ?>">
            <form action=''  method=''>        
                <td><input id="form_datetime_s<?php echo $val['time_id']; ?>" type="" name = 'start' disabled="disabled" value="<?php echo $val['start']; ?>" readonly></td>
                <td><input id="form_datetime_e<?php echo $val['time_id']; ?>" type="text" name = 'end' disabled="disabled" value="<?php echo $val['end']; ?>" readonly></td>
                <td><input id="price<?php echo $val['time_id']; ?>" type="text" name="price" disabled="disabled" value="<?php echo $val['price']; ?>"/></td>
                <td><input id="court_num<?php echo $val['time_id']; ?>" type="text" name="court_num" disabled="disabled" value="<?php echo $val['court_num']; ?>"/></td>
                <td id="state<?php echo $val['time_id']; ?>"><?php if($val['status']=='1'): ?>启用<?php elseif($val['status']=='2'): ?>停用<?php endif; ?></td>
                <td style="padding: 0"><button id="edit<?php echo $val['time_id']; ?>" type="button">修 改</button></td>
                <td style="padding: 0"><button id="stop<?php echo $val['time_id']; ?>" type="button">状态切换</button></td>
                <td style="padding: 0"><button id="delete<?php echo $val['time_id']; ?>" type="button">删 除</button></td>                
            </form>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="add-box"><button class="add" id="add">添加</button></div>

    <!--分页-->
    <nav class="pages">
        <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </nav>
</div>

    <!--通过审核-->
    <table id="agreed" class="form-style">
        <tr>
            <th width="20%">开始时间</th>
            <th width="20%">结束时间</th>
            <th width="13%">价格</th>
            <th width="9%">球场总数</th>
            <th width="9%">剩余总数</th>
            <th width="29%" colspan="3">操作</th>
        </tr>
        <?php

            $queryDate = array();
            for($i=0;$i<7;$i++) {
                $queryDate[] = date('Y-m-d',time()+86400*$i);
            }
            $query = $this->db->or_where_in('date',$queryDate)->order_by('date','asc')->get("time_list");
            $list = $query->result_array();
            $num_rows  = $query->num_rows();
        
?>
        <?php foreach($list as $key => $val): ?>
        <tr id="tab<?php echo $val['list_id']; ?>">
            <form action=''  method=''>        
                <td><input id="form_datetime_s<?php echo $val['list_id']; ?>" type="text" name = 'start' disabled="disabled" value="<?php echo $val['date']; ?> <?php echo $val['start']; ?>" readonly></td>
                <td><input id="form_datetime_e<?php echo $val['list_id']; ?>" type="text" name = 'end' disabled="disabled" value="<?php echo $val['date']; ?> <?php echo $val['end']; ?>" readonly></td>
                <td><input id="price<?php echo $val['list_id']; ?>" type="text" name="price" disabled="disabled" value="<?php echo $val['price']; ?>"/></td>
                <td><input id="court_num<?php echo $val['list_id']; ?>" type="text" name="court_num" disabled="disabled" value="<?php echo $val['court_num']; ?>"/></td>
                <td><input id="surplus_num<?php echo $val['list_id']; ?>" type="text" name="surplus_num" disabled="disabled" value="<?php echo $val['surplus_num']; ?>"/></td>
                <td style="padding: 0"><button id="state<?php echo $val['list_id']; ?>" type="button"><?php if($val['status']=='1'): ?>关闭预约<?php elseif($val['status']=='3'): ?>开放预约<?php endif; ?></button></td>
<!--                 <td style="padding: 0"><button id="stop<?php echo $val['list_id']; ?>" type="button">管理预约用户</button></td> -->
<!--                 <td style="padding: 0"><button id="delete<?php echo $val['list_id']; ?>" type="button">删 除</button></td>                
 -->            </form>
        </tr>
        <?php endforeach; ?>
    </table>



</div>
<script type="text/javascript" src="<?php echo base_url('js/iframe.js'); ?>"></script>
<script type="text/javascript">
    //状态切换
    $(document).delegate("button[id^='stop']",'click',function () {
        var stopId = $(this).attr('id');
        var stopNum = stopId.substring(4);
        var text = $('#state' + stopNum).text();
        //提交状态修改后的表单信息
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo site_url("Admin/OpenTime/changStatus/yes/"); ?>',
            data: {
                time_id: stopNum,
            },
            success: function (data) {
                if(data.success) {
                    alert(data.message);
                    if(text == '启用') {
                        $('#state' + stopNum).text('停用');
                    }
                    else {
                        $('#state' + stopNum).text('启用');
                    }
                } else {
                    alert(data.message);
                }

            },
            error: function (data) {
                alert('error');
            }
        });
    });

    //删除时段
    $(document).delegate("button[id^='delete']",'click',function () {
        var deleteId = $(this).attr('id');
        var deleteNum = deleteId.substring(6);
        var  c = window.confirm("确认删除改时段吗？");
        if (c) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo site_url("Admin/OpenTime/del/yes/"); ?>',
                data: {
                    time_id: deleteNum
                },
                success: function (data) {
                    if(data.success) {
                        alert(data.message);
                        $('#tab' + deleteNum).remove();
                    }
                },
                error: function (data) {
                    alert('error');
                }
            });
        }
        changebgc();
    });

        $('.clockpicker').clockpicker();
</script>
</body>
</html>