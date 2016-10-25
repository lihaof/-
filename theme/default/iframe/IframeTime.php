<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/bootstrap.min.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/bootstrap-datetimepicker.min.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/form.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/manage.css')}">
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <script type="text/javascript" src="{:base_url('js/bootstrap.min.js')}"></script>
    <script type="text/javascript" src="{:base_url('js/bootstrap-datetimepicker.min.js')}"></script>
    <script type="text/javascript" src="{:base_url('js/iframe.js')}"></script>
</head>
<body>
<div class="iframe-all">
    <!--侧面栏-->
    <div id="nav">
        <ul>
            <li class="module module2">子模块4<img class="module-img" src="{:base_url('image/in.png')}"></li>
            <li class="module">子模块5<img class="module-img" src="{:base_url('image/in.png')}"></li>
            <li class="module">子模块6<img class="module-img" src="{:base_url('image/in.png')}"></li>
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
        <!--{execute}-->
            $query = $this->db->get("open_time");
            $list = $query->result_array();
            $num_rows  = $query->num_rows();
        <!--{/execute}-->
        <!--{foreach $list $key $val}-->
        <tr id="tab{:$val['time_id']}">
            <form action=''  method=''>        
                <td><input id="form_datetime_s{:$val['time_id']}" type="text" name = 'start' disabled="disabled" value="{:$val['start']}" readonly></td>
                <td><input id="form_datetime_e{:$val['time_id']}" type="text" name = 'end' disabled="disabled" value="{:$val['end']}" readonly></td>
                <td><input id="price{:$val['time_id']}" type="text" name="price" disabled="disabled" value="{:$val['price']}"/></td>
                <td><input id="court_num{:$val['time_id']}" type="text" name="court_num" disabled="disabled" value="{:$val['court_num']}"/></td>
                <td id="state{:$val['time_id']}"><!--{if $val['status']=='1'}-->启用<!--{elseif $val['status']=='2'}-->停用<!--{/if}--></td>
                <td style="padding: 0"><button id="edit{:$val['time_id']}" type="button">修 改</button></td>
                <td style="padding: 0"><button id="stop{:$val['time_id']}" type="button">状态切换</button></td>
                <td style="padding: 0"><button id="delete{:$val['time_id']}" type="button">删 除</button></td>                
            </form>
        </tr>
        <!--{/foreach}-->
    </table>

    <div class="add-box"><button class="add" id="add">添加</button></div>
</div>



<script type="text/javascript" src="{:base_url('js/iframe.js')}"></script>
<script>
    $(document).ready(function () {
        $("input[id^='form_datetime']").datetimepicker({
            format: 'HH:ii',
            autoclose: true
        });
        //确认时段
        $(document).delegate("button[id^='check']",'click',function () {
            var checkId = $(this).attr('id');
            var num = checkId.substring(5);
            //提交修改后的表单信息
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '{:site_url("Admin/OpenTime/add/yes/")}',
                data: {
                    start: $('#form_datetime_s' + num).val(),
                    end: $('#form_datetime_e' + num).val(),
                    price: $('#price' + num).val(),
                    court_num: $('#court_num' + num).val(),
                    status: $('#state' + num).text()
                },
                success: function (data) {
                    if(data.success) {
                        alert(data.message);
                        $(this).css('background','#51bb65').text('修改');
                        $(this).parent().siblings().children('input').attr("disabled",'false').css('border','none');
                        $(this).attr('id','edit' + num);
                    } else {
                        alert(data.message);
                    }
                },
                error: function (data) {
                    alert('error');
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
            editInput.datetimepicker({
                format: 'HH:ii',
                autoclose: true
            });
        });

        //状态切换
        $(document).delegate("button[id^='stop']",'click',function () {
            var stopId = $(this).attr('id');
            var stopNum = stopId.substring(4);
            var text = $('#state' + stopNum).text();


            //提交状态修改后的表单信息
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '{:site_url("Admin/OpenTime/changStatus/yes/")}',
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
                    url: '{:site_url("Admin/OpenTime/del/yes/")}',
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
        });

        var id = {:$num_rows}+1;
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
            $('#check' + length).css('background-color','#000');
            $('#tab' + length).find('input').css('border','1px solid #ddd');
            $('#form_datetime_s'+ length).datetimepicker({
                format: 'HH:ii',
                autoclose: true
            });
            $('#form_datetime_e'+ length).datetimepicker({
                format: 'HH:ii',
                autoclose: true,
                minuteStep: 10
            });
        });
    });


</script>
</body>
</html>