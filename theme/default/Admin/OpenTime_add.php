<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>开放时段管理--添加</title>
</head>
<body>
<form action="{:site_url('Admin/OpenTime/add/yes')}" method="post">
	开始时间：<input type="time" name="start"> <br/>
	结束时间：<input type="time" name="end"> <br/>
	价格：<input type="text" name="price"> <br/>
	<input type="submit" value="添加">
</form>
</body>
</html>