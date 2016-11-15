<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的球队</title>
    <script type="text/javascript" src="{:base_url('js/jquery.js')}"></script>
    <link rel="stylesheet" type="text/css" href="{:base_url('css/top-bar.css')}">
    <link rel="stylesheet" type="text/css" href="{:base_url('css/tab-bar.css')}">
</head>
<body>
<!--微信自带顶部栏-->
<div class="topbar-default">
    <span>我的球队</span>
</div>
<input type="text" id="applyTeamName" placeholder="创建球队名称">
<button id="applyTeam">创建球队</button>
<br>
<span>我加入的球队：</span>

{foreach $team $val}
球队id：{:$val["team_id"]}<br>
球队名称：{:$val["team_name"]}<br>
队长id: {:$val["team_leader"]}<br>
球队宣言：{:$val["team_slogan"]}<br>
球队图片名：{:$val["team_picture"]}<br>
球队状态：{:$val["team_status"]}<br>
<button value="{:$val['team_id']}" name="teammate">球员列表</button>
<hr>
{/foreach}
<input type="text" id="team_name" placeholder="搜索球队">
<button id="serchTeam">搜索</button>
<div id="sTeam"></div>

<span>我创建的球队：</span>

{foreach $team $val}
{if $val["team_leader"]==1}<!--这个1是当前用户id,由后台传输到这里进行判断，待获取-->
球队id：{:$val["team_id"]}<br>
球队名称：{:$val["team_name"]}<br>
队长id: {:$val["team_leader"]}<br>
球队宣言：{:$val["team_slogan"]}<br>
球队图片名：{:$val["team_picture"]}<br>
球队状态：{:$val["team_status"]}<br>
<button value="{:$val['team_id']}" name="allteammate">所有球员</button>
<div id="teammateinfo{:$val['team_id']}"></div>
<hr>
{/if}
{/foreach}

<!--底部栏-->
<div class="bottom">
    <div><img class="btn-normal" src="{:base_url('image/reserve.png')}"><p class="p-normal">预约</p></div>
    <div><img class="btn-normal btn-pressed" src="{:base_url('image/match.png')}"><p class="p-normal p-pressed">球队</p></div>
    <div><img class="btn-normal" src="{:base_url('image/find.png')}"><p class="p-normal">发现</p></div>
    <div><img class="btn-normal" src="{:base_url('image/myself.png')}"><p class="p-normal">我</p></div>
</div>


<script type="text/javascript">
    $("button#applyTeam").click(function(){
        var teamInfo='';
        var teamurl='';
        $.ajax({
            url:"{:site_url('Team/applyTeam')}",
            cache:false,
            type:"POST",
            async:false,
            data:{
                team_name:$("#applyTeamName").val()
            },
            success:function(msg) {
                alert($.parseJSON(msg).info);
            }
        })
    });

    $("button#serchTeam").click(function(){
        document.getElementById("sTeam").innerHTML = "等待搜索结果……";
        var teamInfo='';
        var teamurl='';
        $.ajax({
            url:"{:site_url('Team/serchTeam')}",
            cache:false,
            type:"POST",
            async:false,
            data:{
                team_name:$("#team_name").val()
            },
            success:function(msg) {
                steam = $.parseJSON(msg);
                for(var i=0;i<steam.length;i++) {
                    teamurl = "{:site_url('Team/joinTeam')}"+"?team_id="+steam[i]['team_id'];
                    teamInfo += "<a href="+teamurl+">申请加入</a>"+'<br>'+
                        '球队id：'+steam[i]['team_id']+'<br>'+
                        '球队名称：'+steam[i]['team_name']+'<br>'+
                        '队长id: '+steam[i]['team_leader']+'<br>'+
                        '球队宣言：'+steam[i]['team_slogan']+'<br>'+
                        '球队图片名：'+steam[i]['team_picture']+'<br>'+
                        '球队状态：'+steam[i]['team_status']+'<br>'+
                        '<hr>';
                    document.getElementById("sTeam").innerHTML= teamInfo;
                }
            }
        });
    });
    $("button[name='teammate']").click(function(){
        var teamMate="";
        $.ajax({
            url:"{:site_url('Team/getValidTeammate')}",
            cache:false,
            type:"POST",
            async:false,
            data:{
                team_id:$(this).attr('value')
            },
            success:function(msg) {
                steam = $.parseJSON(msg);
                for(var i=0;i<steam.length;i++) {
                    teamMate +='队中场位：'+steam[i]['position']+'\n'+
                        '队员id: '+steam[i]['uid']+'\n'+'\n';
                }
                alert(teamMate);
            }
        });
    });
    $("button[name='allteammate']").click(function(){
        var teamMate="";
        $.ajax({
            url:"{:site_url('Team/getTeammate')}",
            cache:false,
            type:"POST",
            async:false,
            data:{
                team_id:$(this).attr('value')
            },
            success:function(msg) {
                steam = $.parseJSON(msg);
                for(var i=0;i<steam.length;i++) {
                    teamurl = "{:site_url('Team/admitTeam')}"+"?team_memmber_id="+steam[i]['team_memmber_id'];
                    teamMate +=
                        '队员id: '+steam[i]['uid']+' '+
                        '队中场位：'+steam[i]['position']+' '+
                        '审核状态：'+steam[i]['team_memmber_status'];
                    if(steam[i]['team_memmber_status']==0){
                        teamMate += " <a href="+teamurl+">通过审核</a>";
                    }
                    teamMate += "<br>";
                }
                document.getElementById("teammateinfo{:$val['team_id']}").innerHTML = teamMate;
            }
        });
    });
</script>
</body>
</html>