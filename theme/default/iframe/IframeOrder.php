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
            <li class="module">子模块5<img class="module-img" src="{:base_url('image/in.png')}"></li>
            <li class="module module2">用户预约管理<img class="module-img" src="{:base_url('image/in.png')}"></li>
        </ul>
    </div>



    <!--表格-->
    <table id="form" class="form-style">
        <tr>
            <th width="10%">用户uid</th>
            <th width="20%">日期</th>
            <th width="20%">时间</th>
            <th width="10%">价格</th>
            <th width="20%">状态</th>
            <th width="20%" colspan="3">操作</th>
        </tr>
        <!--{execute}-->
            $query = $this->db->order_by('time','desc')->get("user_order");
            $list = $query->result_array();
            foreach($list as $key=>&$value) {
                $data = $this->db->where(['list_id'=>$value['list_id']])->get('time_list')->first_row('array');
                unset($data['list_id']);
                unset($data['status']);
                unset($data['court_num']);
                unset($data['surplus_num']);
                $value = array_merge($value,$data);
            }
            $num_rows  = $query->num_rows();
        <!--{/execute}-->
        <!--{foreach $list $key $val}-->
        <tr id="tab{:$val['order_id']}">
            <form action=''  method=''>        
                <td><input id="form_datetime_s{:$val['uid']}" type="text" name = 'uid' disabled="disabled" value="{:$val['uid']} " readonly></td>
                <td><input id="form_datetime_e{:$val['order_id']}" type="text" name = 'date' disabled="disabled" value="{:$val['date']}" readonly></td>
                <td><input id="form_datetime_e{:$val['order_id']}" type="text" name = 'time' disabled="disabled" value="{:$val['start']} - {:$val['end']}" readonly></td>
                <td><input id="price{:$val['order_id']}" type="text" name="price" disabled="disabled" value="{:$val['price']}"/></td>
                <td><input id="status{:$val['order_id']}" type="text" name="status" disabled="disabled" value="<!--{if $val['status']=='1'}-->预约成功<!--{elseif $val['status']=='2'}-->撤销预约<!--{/if}-->"/></td>
                <td style="padding: 0"><button id="state{:$val['order_id']}" type="button"><?php if($val['status']=='1'): ?>撤销预约<?php endif; ?></button></td>
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

        $("input[id^='form_datetime']").datetimepicker({
            format: 'HH:ii',
            autoclose: true
        });



        //状态切换
        $(document).delegate("button[id^='state']",'click',function () {
            var stopId = $(this).attr('id');
            var stopNum = stopId.substring(5);
            var text = $('#state' + stopNum).text();
            var u = '<?php echo site_url("Admin/TimeList/cancelOrder/"); ?>';
            //提交状态修改后的表单信息
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: u,
                data: {
                    order_id: stopNum,
                },
                success: function (data) {
                    if(data.success) {
                        alert(data.message);
                        $('#state' + stopNum).text('');
                        $('#status' + stopNum).val('撤销预约');
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


</script>
</body>
</html>