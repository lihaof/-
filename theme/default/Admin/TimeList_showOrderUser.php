<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>预约管理--撤销指定用户预约</title>
</head>
<body>
<!--{if !empty($list)}-->

<!--{foreach $list $val}-->
用户：{:$val["uid"]}     <a href="{:site_url('Admin/TimeList/cancelOrder/'.$val['list_id'].'/'.$val['uid'])}">撤销预约</a><br/>
<!--{/foreach}-->
<!--{else}-->
暂无用户预约
<!--{/if}-->
</body>
</html>