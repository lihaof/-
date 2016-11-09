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

	<div class="box-team-main">
        <div class="mask"></div>

        <!--创建球队-->
        <div class="box-team-round">
            <button class="box-team-btn-round">+</button>
        </div>
        
		<!--创建球队弹窗-->
		<div class="box-popup">
			<span class="box-popup-title">创建球队</span>
			<img class="box-popup-btn-close" src="{:base_url('image/close.png')}">
			<form class="box-popup-form">
				<span id="applyTeamName" class="box-popup-text">球队名称: </span><br>
				<input type="text" class="box-popup-input"><br>
				<span class="box-popup-text">球队宣言: </span><br>
				<input type="text" class="box-popup-input"><br>
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
        <span id="myTeam" class="box-team-my-title" style="margin-top: -20px">我的球队</span><br><br><br>
        {foreach $team $val}
        <div class="box-team-my">
            <div class="box-team-my-list1" style="border-top-right-radius: 10px;border-top-left-radius: 10px;">
                <span class="box-team-my-list-title">球队ID: </span>
                <span class="box-team-my-list-content">{:$val["team_id"]}</span>
            </div>
            <div class="box-team-my-list2">
                <span class="box-team-my-list-title">球队名称: </span>
                <span class="box-team-my-list-content">{:$val["team_name"]}</span>
            </div>
            <div class="box-team-my-list1">
                <span class="box-team-my-list-title">队长ID: </span>
                <span class="box-team-my-list-content">{:$val["team_leader"]}</span>
            </div>
            <div class="box-team-my-list2">
                <span class="box-team-my-list-title">球队宣言: </span>
                <span class="box-team-my-list-content">{:$val["team_slogan"]}</span>
            </div>
            <div class="box-team-my-list1">
                <span class="box-team-my-list-title">球队图片名: </span>
                <span class="box-team-my-list-content">{:$val["team_picture"]}</span>
            </div>
            <div class="box-team-my-list2">
                <span class="box-team-my-list-title">球队状态: </span>
                <span class="box-team-my-list-content">{:$val["team_status"]}</span>
            </div>
                <button class="box-team-my-list-btn" value="{:$val['team_id']}" name="teammate">球员列表</button>
        </div>
		{/foreach}

	</div>

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