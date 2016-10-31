<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>球队后台管理</title>
	<script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
</head>
<body>
<span>所有球队：</span>
<hr>
{foreach $team $val}
球队id：{:$val["team_id"]}<br>
球队名称：{:$val["team_name"]}<br>
队长id: {:$val["team_leader"]}<br>
球队宣言：{:$val["team_slogan"]}<br>
球队图片名：{:$val["team_picture"]}<br>
球队状态：{:$val["team_status"]}<br>
<button value="{:$val['team_id']}" name="teammate">球员列表</button>
{if !$val["team_status"]}
<a href="{:site_url('Admin/Team/verifyTeam')}?team_id={:$val['team_id']}">通过审核</a>
{/if}
<hr>
{/foreach}
</body>
<script type="text/javascript">
	$("button[name='teammate']").click(function(){
		var teamMate="";
		$.ajax({
			url:"{:site_url('Admin/Team/getTeammate')}",
			cache:false,
			type:"POST",
			async:false,
			data:{
				team_id:$(this).attr('value')
			},
			success:function(msg) {
				steam = $.parseJSON(msg);
				for(var i=0;i<steam.length;i++) {
					teamMate +='队中场位：'+steam[i]['position']+'<br>'+
					'审核状态：'+steam[i]['team_memmber_status']+'<br>'+
					'队员id: '+steam[i]['uid']+'<br>'+
					'<hr>';
				}
				alert(teamMate);
			}
		});
	})
</script>
</html>