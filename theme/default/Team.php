<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的球队</title>
	<script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes">
	<link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">
	<link rel="stylesheet" type="text/css" href="{:base_url('css/tab-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/team.css')}">
</head>
<body>
        <!--创建球队-->
        <div class="box-team-round">
            <button class="box-team-btn-round">+</button>
        </div>
        
		<!--创建球队弹窗-->
		<div class="box-popup">
            <img id="teamPict" class="box-popup-title" src="{:base_url('image/team/default.png')}">
			<!-- <div id="teamPict"><span class="box-popup-title">球队头像</span></div> -->
			<img class="box-popup-btn-close" src="{:base_url('image/close.png')}">
            <form id="teamform" action="{:site_url('Team/getTeamPort')}" enctype="multipart/form-data" method="post" accept-charset="UTF-8">
                <input name="teamPort" type="file" class="box-popup-title" style="opacity: 0; margin-top: -100px;" onchange="postPort()">
            </form>
			<form class="box-popup-form">
				<span class="box-popup-text">球队名称: </span><br>
				<input type="text" class="box-popup-input" id="applyTeamName"><br>
				<span class="box-popup-text">球队宣言: </span><br>
				<input type="text" class="box-popup-input" id="applyTeamSlogan"><br>
<!--				<span class="box-popup-text">上传头像: </span>-->
<!--				<img class="box-popup-img" src="{:base_url('image/logo.png')}">-->
				<button id="applyTeam" class="box-popup-btn" type="button">创 建</button>
			</form>
		</div>

        <!--搜索球队-->
        <span id="search" class="box-team-my-title" style="background-color: #35c66e">搜索球队</span><br><br><br>
        <!--搜索框-->
        <div class="box-team-search">
            <input class="box-team-input" type="text" id="team_name" placeholder="搜索球队">
            <button class="box-team-btn" id="serchTeam">搜 索</button>
        </div><br>

        <div id="sTeam"></div>

        <!--我的球队-->
        <span id="myTeam" class="box-team-my-title" style="margin-top: -10px">我的球队</span><br><br><br>
        {if empty($myteam)}
        <span>暂未创建过球队</span>
        {else}
        {foreach $myteam $val}
        <div class="box-team-my">
            <div class="img-style">
                <img class="box-team-my-list-img" src="../image/team/{:$val['team_picture']}">
            </div>
            <div class="box-team-my-list2">
                <span class="box-team-my-list-content">{:$val["team_name"]}</span>
                <span class="dissolution" id="d{:$val['team_id']}" data_team_id="{:$val['team_id']}" onclick="dissolution(this)">解散</span><br>
                <span class="box-team-my-list-title">队长:  </span>
                <span class="box-team-my-list-content">{:$val["team_leader"]}</span>
            </div>
                <div onclick="applyteam(this)">
                <button class="box-team-my-list-btn3" value="{:$val['team_id']}" applynum="{:@$val["apply_Num"]}" name="">申请人数: {:@$val["apply_Num"]}</button>
                </div>
                <div onclick="teamnum(this)">
                <button class="box-team-my-list-btn" value="{:$val['team_id']}" name="teammate">当前人数: {:@$val["teammate_num"]}</button>
                </div>
        </div>
        {/foreach}
        {/if}
        
        <!--我加入的球队-->
        <span id="myTeam" class="box-team-my-title" style="margin-top: -10px">加入球队</span><br><br><br>
        {if empty($team)}
        <span>暂未加入过其他球队</span>
        {else}
        {foreach $team $val}
        <div id='{:$val["team_id"]}'  class="box-team-my">
            <div class="img-style">
                <img class="box-team-my-list-img" src="../image/team/{:$val['team_picture']}">
            </div>
            <div class="box-team-my-list2">
                <span class="box-team-my-list-content">{:$val["team_name"]}</span>
                <span class="exit" id="e{:$val['team_id']}" data_team_id="{:$val['team_id']}" onclick="exit(this)">退出</span><br>
                <span class="box-team-my-list-title">队长:  </span>
                <span class="box-team-my-list-content">{:$val["team_leader"]}</span>
            </div>
            <div onclick="teamnum(this)">
                <button class="box-team-my-list-btn" value="{:$val['team_id']}" name="teammate">球员列表 ({:@$val["teammate_num"]}人)</button>
            </div>
        </div>
        {/foreach}
        {/if}

	<!--底部栏-->
	<div class="bottom">
		<div><img class="btn-normal" src="{:base_url('image/reserve.png')}"><p class="p-normal">预约</p></div>
		<div><img class="btn-normal btn-pressed" src="{:base_url('image/match.png')}"><p class="p-normal p-pressed">球队</p></div>
		<div><img class="btn-normal" src="{:base_url('image/find.png')}"><p class="p-normal">发现</p></div>
		<div><img class="btn-normal" src="{:base_url('image/myself.png')}"><p class="p-normal">我</p></div>
	</div>


    <script type="text/javascript" src="{:base_url('js/team.js')}"></script>
</body>
</html>