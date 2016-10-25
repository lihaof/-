<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>开放时段管理--修改</title>
</head>
<body>
<form action="{:site_url('Admin/OpenTime/change/'.$data['time_id'].'/yes/')}" method="post">
	<input type="hidden" name="time_id" value="{:$data['time_id']}">
	开始时间：<input type="time" name="start" value="{:$data['start']}"> <br/>
	结束时间：<input type="time" name="end" value="{:$data['end']}"> <br/>
	价格：<input type="text" name="price" value="{:$data['price']}"> <br/>
	球场数量：<input type="text" name="court_num" value="{:$data['court_num']}"> <br/>
	<input type="submit" value="修改">
</form>
</body>
</html>