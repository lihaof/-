<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>预约管理</title>
</head>
<body>

<!--{foreach $list $val}-->

date:{:$val["date"]} time:{:$val["start"]}--{:$val["end"]} <br/>
price:{:$val["price"]} 
status:
<!--{if $val["status"]==1}-->
    开放预约
<!--{elseif $val["status"]==2}-->
    已被预约,预约人uid:{:$val['uid']}
<!--{else}-->
    不开放预约
<!--{/if}-->
<br/>
<!--{if $val["status"]==1}-->
    <a href="{:site_url('Admin/TimeList/lock/'.$val['list_id'])}">关闭预约</a>
<!--{elseif $val["status"]==2}-->
    <a href="{:site_url('Admin/TimeList/cancelOrder/'.$val['list_id'])}">撤销预约</a>
<!--{elseif $val["status"]==3}-->
    <a href="{:site_url('Admin/TimeList/unlock/'.$val['list_id'])}">开放预约</a>
<!--{/if}-->
<br/>
<br/>
<!--{/foreach}-->
</body>
</html>