<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/manage.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/form.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/bootstrap.min.css')}">
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
</head>
<body>
<div class="iframe-all">
    <!--开放时间段管理-->
    <table id="form" class="form-style">
        <tr>
            <th width="15%">用户组ID</th>
            <th width="15%">用户组名</th>
            <th width="15%">积分上线</th>
            <th width="15%">积分下线</th>
            <th width="40%" colspan="2">操作</th>
        </tr>

        <tr id="">
            <form action=''  method=''>
                <td><input id="" name = "userID" disabled="disabled" value="" readonly></td>
                <td><input id="" type="text" name = "userName" disabled="disabled" value="" readonly></td>
                <td><input id="" type="text" name="" disabled="disabled" value=""/></td>
                <td><input id="" type="text" name="" disabled="disabled" value=""/></td>
                <td style="padding: 0"><button id="" type="button">修 改</button></td>
                <td style="padding: 0"><button id="" type="button">删 除</button></td>
            </form>
        </tr>

    </table>
    <div class="add-box" onclick="addBtn()"><button class="add" id="add">添加</button></div>


</div>
<script type="text/javascript" src="{:base_url('js/iframe.js')}"></script>
<script type="text/javascript">

    var operate = $('.operate', window.parent.document);

    addBtn = function () {
        operate.height(operate.height() + 45);
    }

    $(window).load(function () {
        operate.height($('.iframe-all').height() + 150);
    });


    //确认时段
    $(document).delegate("button[id^='check']",'click',function () {
        var checkId = $(this).attr('id');
        var num = checkId.substring(5);
        if($(this).text()=='确认') {
            var u = '{:site_url("Admin/OpenTime/change/yes/")}';
        } else {
            var u = '{:site_url("Admin/OpenTime/add/yes/")}';
        }
        //提交修改后的表单信息

    });
    //删除时段
    $(document).delegate("button[id^='delete']",'click',function () {
        var deleteId = $(this).attr('id');
        var deleteNum = deleteId.substring(6);
        var  c = window.confirm("确认删除改时段吗？");
        if (c) {

        }
    });

    //修改时段
    $(document).delegate("button[id^='edit']",'click',function () {
        var editId = $(this).attr('id');
        var editNum = editId.substring(4);
        editId = $('#' + editId);
        var editInput = editId.parent().siblings().children('input')
        editInput.removeAttr('disabled').css('border','1px solid #ddd');
        editId.text('确认');
        editId.attr('id','check' + editNum);
        editInput = editId.parent().siblings().children('input:lt(2)');
        editInput.datetimepicker({
            format: 'HH:ii',
            autoclose: true
        });
    });

    var id = {:$tabMaxId}+1;
    $('#add').click(function (e) {
        e.preventDefault();
        var length = id++;
        //添加时段
        var tr = $("<tr id="+ 'tab' + length +">" +
            "<form action='' method=''>" +
            "<td>" + "<input id=" + 'form_datetime_s' + length +" type='text' class='clockpicker' name = 'start' value='00:00' readonly>" + "</td>" +
            "<td>" + "<input id=" + 'form_datetime_e' + length +" type='text' class='clockpicker' name = 'end' value='00:00' readonly>" + "</td>" +
            "<td>" + "<input id=" + 'price' + length +" type='text' name='price'/>" + "</td>" +
            "<td>" + "<input id=" + 'court_num' + length +" type='text' name='court_num'/>" + "</td>" +
            "<td id="+ 'state' + length +">" + '启用' + "</td>" +
            "<td style='padding: 0'>" + "<button id="+ 'check' + length +" type='button'>" + '添 加' + "</button>" + "</td>" +
            "<td style='padding: 0'>" + "<button type='button' id="+ 'stop' + length +">" + '状态切换' + "</button>" + "</td>" +
            "<td style='padding: 0'>" + "<button type='button' id="+ 'delete' + length +">" + '删 除' + "</button>" + "</td>" +
            "</form>" +
            "</tr>");
        $('#form').append(tr);
        $('#tab' + length).find('input').css('border','1px solid #ddd');
        $('.clockpicker').clockpicker();
    });
</script>
<script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
</body>
</html>