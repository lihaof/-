<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>开放时段管理--查询</title>
</head>
<body>

<a href="{:site_url('Admin/OpenTime/add/')}">添加</a><br />

<!--{foreach $list $val}-->

time:{:$val["start"]}--{:$val["end"]} <br/>
price:{:$val["price"]} 
status:
<!--{if $val["status"]==1}-->
    启用
<!--{elseif $val["status"]==2}-->
	停用
<!--{/if}-->
<br/>
<a href="{:site_url('Admin/OpenTime/change/'.$val['time_id'])}">修改</a> - <a href="{:site_url('Admin/OpenTime/del/'.$val['time_id']).'/yes/'}">删除</a> - <!--{if $val["status"]==2}-->
    <a href="{:site_url('Admin/OpenTime/unlock/'.$val['time_id'])}">启用</a>
<!--{elseif $val["status"]==1}-->
	<a href="{:site_url('Admin/OpenTime/lock/'.$val['time_id'])}">停用</a>
<!--{/if}-->
<br/>
<br/>
<!--{/foreach}-->
</body>
</html>