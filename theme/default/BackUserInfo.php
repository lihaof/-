<!DOCTYPE html>
<html lang="en">
<head>
    <title>用户信息管理后台</title>
</head>
<body>
<form action="<?php echo site_url('BackUserInfo/editUserinfo'); ?>" method="POST" > 
	<table border="1">
	    <tr>
			<th>用户ID</th>
			<th>用户昵称</th>
			<th>用户头像</th>
			<th>用户积分</th>
		</tr>
	    {foreach $userList $val}
		<tr>
	    <td>{:$val["uid"]}</td>
		<td>{:$val["nickname"]}</td>
		<td><img src="{:$val['picture']}"></td>
		<!--<td>{:$val["picture"]}</td>-->
		<td><input type="number" name="{:$val['uid']}" value="{:$val['point']}"></td>
		</tr>
		{/foreach}
	</table>
	{:$this->pagination->create_links();}
	<button type="submit">提 交</button>
</form>

</body>
</html>