<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap-datetimepicker.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/form.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/manage.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/iframe.js'); ?>"></script>
</head>
<body>
<div class="iframe-all">
    <!--侧面栏-->
    <div id="nav">
        <ul>
            <li class="module module2">子模块4<img class="module-img" src="<?php echo base_url('image/in.png'); ?>"></li>
            <li class="module">子模块5<img class="module-img" src="<?php echo base_url('image/in.png'); ?>"></li>
            <li class="module">子模块6<img class="module-img" src="<?php echo base_url('image/in.png'); ?>"></li>
        </ul>
    </div>



    <!--表格-->
    <table id="form" class="form-style">
        <tr>
            <th width="22%">开始时间</th>
            <th width="22%">结束时间</th>
            <th width="16%">价格</th>
            <th width="12%">状态</th>
            <th width="28%" colspan="3">操作</th>
        </tr>

        <tr id="tab1">
            <form action=''  method=''>
                <td><input id="form_datetime_s1" type="text" name = 'start' disabled="disabled" value="2016-11-15 14:45" readonly></td>
                <td><input id="form_datetime_e1" type="text" name = 'end' disabled="disabled" value="2016-11-15 16:45" readonly></td>
                <td><input id="price1" type='text' name='price' disabled="disabled" value="100"/></td>
                <td id="state1">启用</td>
                <td style="padding: 0"><button id="edit1" type="button">修 改</button></td>
                <td style="padding: 0"><button id="stop1" type="button">状态切换</button></td>
                <td style="padding: 0"><button id="delete1" type="button">删 除</button></td>
            </form>
        </tr>
    </table>

    <div class="add-box"><button class="add" id="add">添加</button></div>
</div>



<script type="text/javascript" src="<?php echo base_url('js/iframe.js'); ?>"></script>
<script>
    $(document).ready(function () {

        $("input[id^='form_datetime']").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
        //确认时段
        $(document).delegate("button[id^='check']",'click',function () {
            var checkId = $(this).attr('id');
            var num = checkId.substring(5);
            $(this).attr('id','edit' + num);
            $(this).css('background','#51bb65').text('修改');
            $(this).parent().siblings().children('input').attr("disabled",'false').css('border','none');
            //提交表单信息
            $.ajax({
                type: 'POST',
                url:  '',
                dataType: 'json',
                data: {
                    startTime: $('#form_datetime_s' + num).val(),
                    endTime: $('#form_datetime_e' + num).val(),
                    price: $('#price' + num).val(),
                    state: $('#state' + num).text()
                },
                success: function (data) {
                    if(data.success){
                        alert('success' + data.startTime);
                    }
                },
                error: function (data) {
//                    alert('error' + data.startTime);
                }
            });
        });

        //修改时段
        $(document).delegate("button[id^='edit']",'click',function () {
            var editId = $(this).attr('id');
            var editNum = editId.substring(4);
            editId = $('#' + editId);
            var editInput = editId.parent().siblings().children('input')
            editInput.removeAttr('disabled').css('border','1px solid #ddd');
            editId.text('确认').css('background','#000');
            editId.attr('id','check' + editNum);
            editInput.datetimepicker({format: 'yyyy-mm-dd hh:ii'});
        });

        //状态切换
        $(document).delegate("button[id^='stop']",'click',function () {
            var stopId = $(this).attr('id');
            var stopNum = stopId.substring(4);
            var text = $('#state' + stopNum).text();
            if(text == '启用'){$('#state' + stopNum).text('停用');}
            else {$('#state' + stopNum).text('启用');}
        });

        //删除时段
        $(document).delegate("button[id^='delete']",'click',function () {
            var deleteId = $(this).attr('id');
            var deleteNum = deleteId.substring(6);
            var  c = window.confirm("确认删除改时段吗？");
            if (c) {
                $('#tab' + deleteNum).remove();
            }
        });

        var id = 1;
        $('#add').click(function (e) {
            e.preventDefault();
            var length = ++id;
            //添加时段
            var tr = $("<tr id="+ 'tab' + length +">" +
                "<form action='' method=''>" +
                "<td>" + "<input id=" + 'form_datetime_s' + length +" type='text' name = 'start' value='2016-11-15 14:45' readonly>" + "</td>" +
                "<td>" + "<input id=" + 'form_datetime_e' + length +" type='text' name = 'end' value='2016-11-15 14:45' readonly>" + "</td>" +
                "<td>" + "<input id=" + 'price' + length +" type='text' name='price'/>" + "</td>" +
                "<td id="+ 'state' + length +">" + '启用' + "</td>" +
                "<td style='padding: 0'>" + "<button id="+ 'check' + length +" type='button'>" + '确 认' + "</button>" + "</td>" +
                "<td style='padding: 0'>" + "<button type='button' id="+ 'stop' + length +">" + '状态切换' + "</button>" + "</td>" +
                "<td style='padding: 0'>" + "<button type='button' id="+ 'delete' + length +">" + '删 除' + "</button>" + "</td>" +
                "</form>" +
                "</tr>");
            $('#form').append(tr);
            $('#check' + length).css('background-color','#000');
            $('#tab' + length).find('input').css('border','1px solid #ddd');
            $('#form_datetime_s'+ length).datetimepicker({format: 'yyyy-mm-dd hh:ii'});
            $('#form_datetime_e'+ length).datetimepicker({format: 'yyyy-mm-dd hh:ii'});
        });
    });


</script>
</body>
</html>