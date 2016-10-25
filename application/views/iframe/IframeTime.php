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
            <th width="20%">开始时间</th>
            <th width="20%">结束时间</th>
            <th width="13%">价格</th>
            <th width="10%">球场数量</th>
            <th width="8%">状态</th>
            <th width="29%" colspan="3">操作</th>
        </tr>

        <tr id="tab1">
            <form action=''  method=''>
                <td><input id="form_datetime_s1" type="text" name = 'start' disabled="disabled" value="14:45" readonly></td>
                <td><input id="form_datetime_e1" type="text" name = 'end' disabled="disabled" value="16:45" readonly></td>
                <td><input id="price1" type='text' name='price' disabled="disabled" value="100"/></td>
                <td><input id="court_num1" type='text' name='court_num' disabled="disabled" value="1"/></td>
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

        //添加列表背景色
        var changebgc = function() {
            $('#form').find('tr').each(function () {
                if ($(this).index() % 2 == 0) {
                    $(this).css('background-color', '#fff');
                }
                else {
                    $(this).css('background-color', '#F6F6F6');
                }
            });
        }

        changebgc();

        $("input[id^='form_datetime']").datetimepicker({
            format: 'HH:ii',
            autoclose: true,
            startDate: "2016-11-01 01:00",
            minuteStep: 5
        });
        //确认时段
        $(document).delegate("button[id^='check']",'click',function () {
            var checkId = $(this).attr('id');
            var num = checkId.substring(5);
            $(this).attr('id','edit' + num);
            $(this).text('修改');
            $(this).parent().siblings().children('input').attr("disabled",'false').css('border','none');
            //提交修改后的表单信息
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '',
                data: {
                    start: $('#form_datetime_s' + num).val(),
                    end: $('#form_datetime_e' + num).val(),
                    price: $('#price' + num).val(),
                    court_num: $('#court_num' + num).val(),
                    status: $('#state' + num).text()
                },
                success: function (data) {
                    if(data.success){
                        alert('success' + data.start);
                    }
                },
                error: function (data) {
//                    alert('error' + data.start);
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
            editId.text('确认')
            editId.attr('id','check' + editNum);
            editInput.datetimepicker({
                format: 'HH:ii',
                autoclose: true,
                startDate: "2016-11-01 01:00",
                minuteStep: 5

            });
        });

        //状态切换
        $(document).delegate("button[id^='stop']",'click',function () {
            var stopId = $(this).attr('id');
            var stopNum = stopId.substring(4);
            var text = $('#state' + stopNum).text();
            if(text == '启用'){$('#state' + stopNum).text('停用');}
            else {$('#state' + stopNum).text('启用');}

            //提交状态修改后的表单信息
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '',
                data: {
                    status: $('#state' + num).text()
                },
                success: function (data) {
                    if(data.success){
                        alert('success' + data.status);
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
                $('#tab' + deleteNum).remove();
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '',
                data: {
                    delete_form: true
                },
                success: function (data) {
                    if(data.success){
                        alert('success' + data.delete_form);
                    }
                },
                error: function (data) {
                    alert('error');
                }
            });

            changebgc();
        });

        var id = 1;
        $('#add').click(function (e) {
            e.preventDefault();
            var length = ++id;
            //添加时段
            var tr = $("<tr id="+ 'tab' + length +">" +
                "<form action='' method=''>" +
                "<td>" + "<input id=" + 'form_datetime_s' + length +" type='text' name = 'start' value='00:00' readonly>" + "</td>" +
                "<td>" + "<input id=" + 'form_datetime_e' + length +" type='text' name = 'end' value='00:00' readonly>" + "</td>" +
                "<td>" + "<input id=" + 'price' + length +" type='text' name='price'/>" + "</td>" +
                "<td>" + "<input id=" + 'court_num' + length +" type='text' name='court_num'/>" + "</td>" +
                "<td id="+ 'state' + length +">" + '启用' + "</td>" +
                "<td style='padding: 0'>" + "<button id="+ 'check' + length +" type='button'>" + '确 认' + "</button>" + "</td>" +
                "<td style='padding: 0'>" + "<button type='button' id="+ 'stop' + length +">" + '状态切换' + "</button>" + "</td>" +
                "<td style='padding: 0'>" + "<button type='button' id="+ 'delete' + length +">" + '删 除' + "</button>" + "</td>" +
                "</form>" +
                "</tr>");
            $('#form').append(tr);
//            $('#check' + length).css('background-color','#000');
            $('#tab' + length).find('input').css('border','1px solid #ddd');
            $('#form_datetime_s'+ length).datetimepicker({
                format: 'HH:ii',
                autoclose: true,
                startDate: "2016-11-01 01:00",
                minuteStep: 5
            });
            $('#form_datetime_e'+ length).datetimepicker({
                format: 'HH:ii',
                autoclose: true,
                startDate: "2016-11-01 01:00",
                minuteStep: 5
            });
            changebgc();

        });
    });


</script>
</body>
</html>