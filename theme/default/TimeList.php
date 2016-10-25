<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>预约</title>
</head>
<body>

<!--{foreach $list $val}-->

date:{:$val["date"]} time:{:$val["start"]}--{:$val["end"]} <br/>
price:{:$val["price"]} 
court_num:{:$val["court_num"]} surplus_num:{:$val["surplus_num"]}<br/>
status:
<!--{if $val["status"]==1}-->
	开放预约 <a href="{:site_url('Order/add/'.$val['list_id'])}">预约</a>
<!--{elseif $val["status"]==2}-->
	已被预约
<!--{else}-->
	不开放预约
<!--{/if}-->
<br/>
<br/>
<!--{/foreach}-->
</body>
</html>