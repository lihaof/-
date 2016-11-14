<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户组信息管理</title>
<body>
<table border="1">
    <tr>
		<th>用户组ID</th>
		<th>用户组名称</th>
		<th>积分下线</th>
		<th>积分上线</th>
	</tr>
    {foreach $group $val}
	<tr>
	    <td>{:$val["group_id"]}</td>
		<td><input type="text" name = " " value="{:$val['group_name']}"></td>
		<td><input type="number" name=" " value="{:$val['min_point']}"></td>
		<td><input type="number" name=" " value="{:$val['max_point']}"></td>
	</tr>
	{/foreach}

	<!--加一个新增-->

</table>
</body>
</html>