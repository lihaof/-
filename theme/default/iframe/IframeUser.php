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
            <th width="17%">用户组ID</th>
            <th width="17%">用户组名</th>
            <th width="17%">积分上线</th>
            <th width="17%">积分下线</th>
            <th width="30%" colspan="2">操作</th>
        </tr>

        <tr id="tab0">
            <form action=''  method=''>
                <td><input id="" name = "userID" disabled="disabled" value="1" readonly></td>
                <td><input id="" type="text" name = "userName" disabled="disabled" value="初级会员"></td>
                <td><input id="" type="text" name="upperLimit" disabled="disabled" value="1"/></td>
                <td><input id="" type="text" name="lowerLimit" disabled="disabled" value="100"/></td>
                <td style="padding: 0"><button id="edit0" type="button">修 改</button></td>
                <td style="padding: 0"><button id="delete0" type="button">删 除</button></td>
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


    //确认用户组
    $(document).delegate("button[id^='check']",'click',function () {
        var checkId = $(this).attr('id');
        var num = checkId.substring(5);
//        if($(this).text()=='确认') {
//            var u = '{:site_url("Admin/OpenTime/change/yes/")}';
//        } else {
//            var u = '{:site_url("Admin/OpenTime/add/yes/")}';
//        }
//        //提交修改后的表单信息
//        $.ajax({
//            type: 'POST',
//            dataType: 'json',
//            url: u,
//            data: {
//                start: $('#form_datetime_s' + num).val(),
//                end: $('#form_datetime_e' + num).val(),
//                price: $('#price' + num).val(),
//                court_num: $('#court_num' + num).val(),
//                time_id: num,
//                status: $('#state' + num).text()
//            },
//            success: function (data) {
//                if(data.success) {
//                    alert(data.message);
//                    location.reload();
//                } else {
//                    alert(data.message);
//                }
//            },
//            error: function (data) {
//                alert('error');
//            }
//        });
    });


    //删除用户组
    $(document).delegate("button[id^='delete']",'click',function () {
        var deleteId = $(this).attr('id');
        var deleteNum = deleteId.substring(6);
        var  c = window.confirm("确认删除该用户组？");
        if (c) {
//            $.ajax({
//                type: 'POST',
//                dataType: 'json',
//                url: '{:site_url("Admin/OpenTime/del/yes/")}',
//                data: {
//                    time_id: deleteNum
//                },
//                success: function (data) {
//                    if(data.success) {
//                        alert(data.message);
//                        $('#tab' + deleteNum).remove();
//                    }
//                },
//                error: function (data) {
//                    alert('error');
//                }
//            });
        }
        $('.form-style').find('tr[id^="tab"]').each(function () {
            if($(this).index()%2 == 1){
                $(this).css('background-color','#f6f6f6');
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
        editId.text('确认');
        editId.attr('id','check' + editNum);
    });

    var id = 0;
    $('#add').click(function (e) {
        e.preventDefault();
        id++;
        var length = id;
        //添加时段
        var tr = $("<tr id="+ 'tab' + length +">" +
            "<form action='' method=''>" +
            "<td>" + "<input id=" + 'user' + length +" type='text' name = 'userID' value='后台id' readonly>" + "</td>" +
            "<td>" + "<input id=" + 'name' + length +" type='text' name = 'userName' value=''>" + "</td>" +
            "<td>" + "<input id=" + 'ulimit' + length +" type='text' name='upperLimit'/>" + "</td>" +
            "<td>" + "<input id=" + 'llimit' + length +" type='text' name='lowerLimit'/>" + "</td>" +
            "<td style='padding: 0'>" + "<button id="+ 'check' + length +" type='button'>" + '确 认' + "</button>" + "</td>" +
            "<td style='padding: 0'>" + "<button type='button' id="+ 'delete' + length +">" + '删 除' + "</button>" + "</td>" +
            "</form>" +
            "</tr>");
        $('#form').append(tr);
        $('#tab' + length).find('input:gt(0)').css('border','1px solid #ddd');
        $('.form-style').find('tr[id^="tab"]').each(function () {
            if($(this).index()%2 == 1){
                $(this).css('background-color','#f6f6f6');
            }
        });
    });
</script>
</body>
</html>