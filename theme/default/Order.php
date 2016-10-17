<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>我的预约</title>
</head>
<body>

<!--{foreach $list $val}-->

date:{:$val["date"]} time:{:$val["start"]}--{:$val["end"]} <br/>
price:{:$val["price"]} 
status:
<!--{if $val["status"]==1}-->
	预约成功
<!--{elseif $val["status"]==2}-->
	预约取消
<!--{else}-->
	未知
<!--{/if}-->
<br/>
<br/>
<!--{/foreach}-->
</body>
</html>