<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/bootstrap.min.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/form.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/manage.css')}">
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <script type="text/javascript" src="{:base_url('js/bootstrap.min.js')}"></script>
</head>
<body>
<div class="iframe-all">
    <!--表格-->
    <table id="form" class="form-style">
        <tr>
            <th width="14%">日期</th>
            <th width="13%">开始时间</th>
            <th width="13%">结束时间</th>
            <th width="10%">价格</th>
            <th width="10%">球场总数</th>
            <th width="10%">剩余总数</th>
            <th width="30%" colspan="3">操作</th>
        </tr>
        <!--{execute}-->
            $list = $this->time_list_model->fetchSevenDay();
        <!--{/execute}-->
        <!--{foreach $list $key $val}-->
        <tr id="tab{:$val['list_id']}">
            <form action=''  method=''>  
                <td><input id="form_datetime_d{:$val['list_id']}" type="text" name = 'date' disabled="disabled" value="{:$val['date']}" readonly></td>      
                <td><input id="form_datetime_s{:$val['list_id']}" type="text" name = 'start' disabled="disabled" value="{:$val['start']}" readonly></td>
                <td><input id="form_datetime_e{:$val['list_id']}" type="text" name = 'end' disabled="disabled" value="{:$val['end']}" readonly></td>
                <td><input id="price{:$val['list_id']}" type="text" name="price" disabled="disabled" value="{:$val['price']}"/></td>
                <td><input id="court_num{:$val['list_id']}" type="text" name="court_num" disabled="disabled" value="{:$val['court_num']}"/></td>
                <td><input id="surplus_num{:$val['list_id']}" type="text" name="surplus_num" disabled="disabled" value="{:$val['surplus_num']}"/></td>
                <td style="padding: 0"><button id="edit{:$val['list_id']}" type="button">修 改</button></td>
                <td style="padding: 0"><button id="state{:$val['list_id']}" type="button"><?php if($val['status']=='1'): ?>关闭预约<?php elseif($val['status']=='3'): ?>开放预约<?php endif; ?></button></td>
                </form>
        </tr>
        <!--{/foreach}-->
    </table>
</div>

<script type="text/javascript" src="{:base_url('js/iframe.js')}"></script>
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

        //状态切换
        $(document).delegate("button[id^='state']",'click',function () {
            var stopId = $(this).attr('id');
            var stopNum = stopId.substring(5);
            var text = $('#state' + stopNum).text();
            if($(this).text()=='开放预约') {
                var u = '<?php echo site_url("Admin/TimeList/unlock/"); ?>';
            } else {
                var u = '<?php echo site_url("Admin/TimeList/lock/"); ?>';
            }
            //提交状态修改后的表单信息
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: u,
                data: {
                    list_id: stopNum,
                },
                success: function (data) {
                    if(data.success) {
                        alert(data.message);
                        if(text == '开放预约') {
                            $('#state' + stopNum).text('关闭预约');
                        }
                        else {
                            $('#state' + stopNum).text('开放预约');
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
    });

    var operate = $('.operate', window.parent.document);
    $(window).load(function () {
        operate.height($('.form-style').height() + 150);
    });
    //确认时段
    $(document).delegate("button[id^='check']",'click',function () {
        var checkId = $(this).attr('id');
        var num = checkId.substring(5);
        //提交修改后的表单信息
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{:site_url("Admin/TimeList/change/yes/")}',
            data: {
                price: $('#price' + num).val(),
                court_num: $('#court_num' + num).val(),
                surplus_num: $('#surplus_num' + num).val(),
                list_id: num
            },
            success: function (data) {
                if(data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            },
            error: function (data) {
                alert('error');
            }
        });
    });

</script>

</body>
</html>