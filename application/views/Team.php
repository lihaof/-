<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>我的球队</title>
	<script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/top-bar.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/tab-bar.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/team.css'); ?>">
</head>
<body style="padding-bottom: 100px">
        <!--创建球队-->
        <div class="box-team-round">
            <button class="box-team-btn-round">+</button>
        </div>
        
		<!--创建球队弹窗-->
		<div class="box-popup">
            <img id="teamPict" class="box-popup-title" src="<?php echo base_url('image/team/default.png'); ?>">
			<!-- <div id="teamPict"><span class="box-popup-title">球队头像</span></div> -->
			<img class="box-popup-btn-close" src="<?php echo base_url('image/close.png'); ?>">
            <form id="teamform" action="<?php echo site_url('Team/getTeamPort'); ?>" enctype="multipart/form-data" method="post" accept-charset="UTF-8">
                <input name="teamPort" type="file" class="box-popup-title" style="opacity: 0; margin-top: -100px;" onchange="postPort()">
            </form>
			<form class="box-popup-form">
				<span class="box-popup-text">球队名称: </span><br>
				<input type="text" class="box-popup-input" id="applyTeamName"><br>
				<span class="box-popup-text">球队宣言: </span><br>
				<input type="text" class="box-popup-input" id="applyTeamSlogan"><br>
<!--				<span class="box-popup-text">上传头像: </span>-->
<!--				<img class="box-popup-img" src="<?php echo base_url('image/logo.png'); ?>">-->
				<button id="applyTeam" class="box-popup-btn" type="button">创 建</button>
			</form>
		</div>

        <!--搜索球队-->
        <span id="search" class="box-team-my-title" style="background: linear-gradient(to right,#49b571,#52cb7e);">搜索球队</span>
        <!--搜索框-->
        <div class="box-team-search">
            <input class="box-team-input" type="text" id="team_name" placeholder="搜索球队">
            <button class="box-team-btn" id="serchTeam">搜 索</button>
        </div>

        <div id="sTeam"></div>

        <!--我的球队-->
        <span id="myTeam" class="box-team-my-title" style="background: linear-gradient(to right,#e69e50,#f7aa56);">我的球队</span>
        <?php if(empty($myteam)): ?>
        <span class="no-team">暂未创建过球队</span>
        <?php else: ?>
        <?php foreach($myteam as $val): ?>
        <div class="box-team-my">
            <div class="img-style">
                <img class="box-team-my-list-img" src="../image/team/<?php echo $val['team_picture']; ?>">
            </div>
            <div class="box-team-my-list2">
                <span class="box-team-my-list-content"><?php echo $val["team_name"]; ?></span>
                <span class="dissolution" id="d<?php echo $val['team_id']; ?>" data_team_id="<?php echo $val['team_id']; ?>" onclick="dissolution(this)">解散</span><br>
                <span class="box-team-my-list-title">队长:  </span>
                <span class="box-team-my-list-content"><?php echo $val["team_leader"]; ?></span>
            </div>
                <div onclick="applyteam(this)">
                <button class="box-team-my-list-btn3" value="<?php echo $val['team_id']; ?>" applynum="<?php echo @$val["apply_Num"]; ?>" name="">申请人数: <?php echo @$val["apply_Num"]; ?></button>
                </div>
                <div onclick="teamnum(this)">
                <button class="box-team-my-list-btn" value="<?php echo $val['team_id']; ?>" name="teammate">当前人数: <?php echo @$val["teammate_num"]; ?></button>
                </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <!--我加入的球队-->
        <span id="myTeam" class="box-team-my-title" style="background: linear-gradient(to right,#c64e54,#e25960);">加入球队</span>
        <?php if(empty($team)): ?>
        <span class="no-team">暂未加入球队</span>
        <?php else: ?>
        <?php foreach($team as $val): ?>
        <div id='<?php echo $val["team_id"]; ?>'  class="box-team-my">
            <div class="img-style">
                <img class="box-team-my-list-img" src="../image/team/<?php echo $val['team_picture']; ?>">
            </div>
            <div class="box-team-my-list2">
                <span class="box-team-my-list-content"><?php echo $val["team_name"]; ?></span>
                <span class="exit" id="e<?php echo $val['team_id']; ?>" data_team_id="<?php echo $val['team_id']; ?>" onclick="exit(this)">退出</span><br>
                <span class="box-team-my-list-title">队长:  </span>
                <span class="box-team-my-list-content"><?php echo $val["team_leader"]; ?></span>
            </div>
            <div onclick="teamnum(this)">
                <button class="box-team-my-list-btn" value="<?php echo $val['team_id']; ?>" name="teammate">球员列表 (<?php echo @$val["teammate_num"]; ?>人)</button>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

	<!--底部栏-->
	<div class="bottom">
		<div onclick="window.location='<?php echo base_url("index.php/reserve"); ?>';"><img class="btn-normal" src="<?php echo base_url('image/reserve.png'); ?>"><p class="p-normal">预约</p></div>
		<div><img class="btn-normal btn-pressed" src="<?php echo base_url('image/match.png'); ?>"><p class="p-normal p-pressed">球队</p></div>
		<div><img class="btn-normal" src="<?php echo base_url('image/find.png'); ?>"><p class="p-normal">发现</p></div>
		<div onclick="window.location='<?php echo base_url("index.php/myself"); ?>';"><img class="btn-normal" src="<?php echo base_url('image/myself.png'); ?>"><p class="p-normal">我</p></div>
	</div>


    <script type="text/javascript" src="<?php echo base_url('js/team.js'); ?>"></script>
</body>
</html>