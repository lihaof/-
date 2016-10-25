<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>预约管理</title>
</head>
<body>

<!--{foreach $list $val}-->

date:{:$val["date"]} time:{:$val["start"]}--{:$val["end"]} <br/>
price:{:$val["price"]} <br/>
court_num:{:$val["court_num"]} surplus_num:{:$val["surplus_num"]}<br/>

status:
<!--{if $val["status"]==1}-->
    开放预约
<!--{else}-->
    不开放预约
<!--{/if}-->
<br/>
<!--{if $val["status"]==1}-->
    <a href="{:site_url('Admin/TimeList/lock/'.$val['list_id'])}">关闭预约</a>
<!--{elseif $val["status"]==2}-->
<!--{elseif $val["status"]==3}-->
    <a href="{:site_url('Admin/TimeList/unlock/'.$val['list_id'])}">开放预约</a>
<!--{/if}-->
<br/>

<!--{if $val["surplus_num"]<$val["court_num"]}-->
    <a href="{:site_url('Admin/TimeList/showOrderUser/'.$val['list_id'])}">撤销指定用户预约</a>
<!--{/if}-->

<br/>
<!--{/foreach}-->
</body>
</html>