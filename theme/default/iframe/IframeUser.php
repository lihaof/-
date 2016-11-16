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
<!--{execute}-->
    $group = $this->User_group_model->getUserGroup();
<!--{/execute}-->
<div class="iframe-all">
    <!--开放时间段管理-->
    <table id="form" class="form-style">
        <tr>
            <th width="17%">用户组ID</th>
            <th width="17%">用户组名</th>
            <th width="17%">积分下限</th>
            <th width="17%">积分上限</th>
            <th width="30%" colspan="2">操作</th>
        </tr>

        {foreach $group $value}
        <tr id="tab0">
            <form action=''  method=''>
                <td><input id="" name = "userID" disabled="disabled" value="{:$value['group_id']}" readonly></td>
                <td><input id="group_name{:$value['group_id']}" type="text" name = "userName" disabled="disabled" value="{:$value['group_name']}"></td>
                <td><input id="min_point{:$value['group_id']}" type="text" name="upperLimit" disabled="disabled" value="{:$value['min_point']}"/></td>
                <td><input id="max_point{:$value['group_id']}" type="text" name="lowerLimit" disabled="disabled" value="{:$value['max_point']}"/></td>
                <td style="padding: 0"><button id="edit{:$value['group_id']}" type="button">修 改</button></td>
                <td style="padding: 0"><button id="delete{:$value['group_id']}" type="button">删 除</button></td>
            </form>
        </tr>
        {/foreach}

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


    //确认修改用户组
    $(document).delegate("button[id^='check']",'click',function () {
        var url = '{:site_url("BackUserGroup/editgroup")}';
        var checkId = $(this).attr('id');
        var group_id = checkId.substring(5);
        var group_name = $('#group_name' + group_id).val();
        var min_point  = $('#min_point' + group_id).val();
        var max_point  = $('#max_point' + group_id).val();
        postajax(url,group_id,group_name,min_point,max_point);
    });
    //确认新增用户组
    $(document).delegate("button[id^='addgrp']",'click',function () {
        var url = '{:site_url("BackUserGroup/addgroup")}';
        var checkId = $(this).attr('id');
        var group_id = checkId.substring(6);
        var group_name = $('#add_group_name' + group_id).val();
        var min_point  = $('#add_min_point' + group_id).val();
        var max_point  = $('#add_max_point' + group_id).val();
        if(
            group_name == ""||
            min_point  == ""||
            max_point  == ""
        ) alert("请完整填写信息");
        else postajax(url,group_id,group_name,min_point,max_point);
    });

    //删除用户组
    $(document).delegate("button[id^='delete']",'click',function () {
        var deleteId = $(this).attr('id');
        var deleteNum = deleteId.substring(6);
        if($(this).attr('isadd')) {
            $('#tab' + deleteNum).remove();
        } else {
            var  c = window.confirm("确认删除该用户组？");
            if (c) {
                var url = '{:site_url("BackUserGroup/deletegroup")}';
                var group_id = deleteNum;
                var group_name = $('#group_name' + group_id).val();
                var min_point  = $('#min_point' + group_id).val();
                var max_point  = $('#max_point' + group_id).val();
                postajax(url,group_id,group_name,min_point,max_point);
            }
            $('.form-style').find('tr[id^="tab"]').each(function () {
                if($(this).index()%2 == 1){
                    $(this).css('background-color','#f6f6f6');
                }
            });
        }
        
    });



    //修改
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
            "<td>" + "<input id=" + 'user' + length +" type='text' name = 'userID' value='' readonly>" + "</td>" +
            "<td>" + "<input id=" + 'add_group_name' + length +" type='text' name = 'userName' value=''>" + "</td>" +
            "<td>" + "<input id=" + 'add_min_point' + length +" type='text' name='upperLimit'/>" + "</td>" +
            "<td>" + "<input id=" + 'add_max_point' + length +" type='text' name='lowerLimit'/>" + "</td>" +
            "<td style='padding: 0'>" + "<button id="+ 'addgrp' + length +" type='button'>" + '确 认' + "</button>" + "</td>" +
            "<td style='padding: 0'>" + "<button type='button' id="+ 'delete' + length +" isadd='1' "+">" + '删 除' + "</button>" + "</td>" +
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

    function postajax(url,group_id,group_name,min_point,max_point) {
       $.ajax({
           type: 'POST',
           dataType: 'json',
           url: url,
           data: {
               group_id  : group_id,
               group_name: group_name,
               min_point : min_point,
               max_point : max_point,
           },
           success: function (data) {
               if(data!=1) alert(data);
               else alert("设置成功");
           },
           error: function (data) {
               alert('error');
           }
       });
    }
</script>
</body>
</html>