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
            <li class="module">子模块4<img class="module-img" src="{:base_url('image/in.png')}"></li>
            <li class="module module2">子模块5<img class="module-img" src="{:base_url('image/in.png')}"></li>
            <li class="module">子模块6<img class="module-img" src="{:base_url('image/in.png')}"></li>
        </ul>
    </div>



    <!--表格-->
    <table id="form" class="form-style">
        <tr>
            <th width="20%">开始时间</th>
            <th width="20%">结束时间</th>
            <th width="13%">价格</th>
            <th width="9%">球场总数</th>
            <th width="9%">剩余总数</th>
            <th width="29%" colspan="3">操作</th>
        </tr>
        <!--{execute}-->
            $queryDate = array();
            for($i=0;$i<7;$i++) {
                $queryDate[] = date('Y-m-d',time()+86400*$i);
            }
            $query = $this->db->or_where_in('date',$queryDate)->order_by('date','asc')->get("time_list");
            $list = $query->result_array();
            $num_rows  = $query->num_rows();
        <!--{/execute}-->
        <!--{foreach $list $key $val}-->
        <tr id="tab{:$val['list_id']}">
            <form action=''  method=''>        
                <td><input id="form_datetime_s{:$val['list_id']}" type="text" name = 'start' disabled="disabled" value="{:$val['date']} {:$val['start']}" readonly></td>
                <td><input id="form_datetime_e{:$val['list_id']}" type="text" name = 'end' disabled="disabled" value="{:$val['date']} {:$val['end']}" readonly></td>
                <td><input id="price{:$val['list_id']}" type="text" name="price" disabled="disabled" value="{:$val['price']}"/></td>
                <td><input id="court_num{:$val['list_id']}" type="text" name="court_num" disabled="disabled" value="{:$val['court_num']}"/></td>
                <td><input id="surplus_num{:$val['list_id']}" type="text" name="surplus_num" disabled="disabled" value="{:$val['surplus_num']}"/></td>
                <td style="padding: 0"><button id="state{:$val['list_id']}" type="button"><?php if($val['status']=='1'): ?>关闭预约<?php elseif($val['status']=='3'): ?>开放预约<?php endif; ?></button></td>
                <td style="padding: 0"><button id="stop{:$val['list_id']}" type="button">管理预约用户</button></td>
<!--                 <td style="padding: 0"><button id="delete{:$val['list_id']}" type="button">删 除</button></td>                
 -->            </form>
        </tr>
        <!--{/foreach}-->
    </table>

    <!-- <div class="add-box"><button class="add" id="add">添加</button></div> -->
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

        $("input[id^='form_datetime']").datetimepicker({
            format: 'HH:ii',
            autoclose: true
        });



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

        // //删除时段
        // $(document).delegate("button[id^='delete']",'click',function () {
        //     var deleteId = $(this).attr('id');
        //     var deleteNum = deleteId.substring(6);
        //     var  c = window.confirm("确认删除改时段吗？");
        //     if (c) {
        //         $.ajax({
        //             type: 'POST',
        //             dataType: 'json',
        //             url: '{:site_url("Admin/OpenTime/del/yes/")}',
        //             data: {
        //                 list_id: deleteNum
        //             },
        //             success: function (data) {
        //                 if(data.success) {
        //                     alert(data.message);
        //                     $('#tab' + deleteNum).remove();
        //                 }
        //             },
        //             error: function (data) {
        //                 alert('error');
        //             }
        //         });
        //     }
        //     changebgc();
        // });

    //     var id = {:$num_rows}+1;
    //     $('#add').click(function (e) {
    //         e.preventDefault();
    //         var length = ++id;
    //         //添加时段
    //         var tr = $("<tr id="+ 'tab' + length +">" +
    //             "<form action='' method=''>" +
    //             "<td>" + "<input id=" + 'form_datetime_s' + length +" type='text' name = 'start' value='00:00' readonly>" + "</td>" +
    //             "<td>" + "<input id=" + 'form_datetime_e' + length +" type='text' name = 'end' value='00:00' readonly>" + "</td>" +
    //             "<td>" + "<input id=" + 'price' + length +" type='text' name='price'/>" + "</td>" +
    //             "<td>" + "<input id=" + 'court_num' + length +" type='text' name='court_num'/>" + "</td>" +
    //             "<td id="+ 'state' + length +">" + '启用' + "</td>" +
    //             "<td style='padding: 0'>" + "<button id="+ 'check' + length +" type='button'>" + '添 加' + "</button>" + "</td>" +
    //             "<td style='padding: 0'>" + "<button type='button' id="+ 'stop' + length +">" + '状态切换' + "</button>" + "</td>" +
    //             "<td style='padding: 0'>" + "<button type='button' id="+ 'delete' + length +">" + '删 除' + "</button>" + "</td>" +
    //             "</form>" +
    //             "</tr>");
    //         $('#form').append(tr);
    //         $('#tab' + length).find('input').css('border','1px solid #ddd');
    //         $('#form_datetime_s'+ length).datetimepicker({
    //             format: 'HH:ii',
    //             autoclose: true
    //         });
    //         $('#form_datetime_e'+ length).datetimepicker({
    //             format: 'HH:ii',
    //             autoclose: true,
    //             minuteStep: 10
    //         });
    //         changebgc();
    //     });

     });


</script>
</body>
</html>