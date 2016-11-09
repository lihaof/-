/**
 * Created by Vonlion on 2016/11/9.
 */
$(document).ready(function () {
    var popupID = $('.box-popup');
    var popupMarginLeft = ($('.box-team-main').width() - popupID.width() - 30)/2;
    popupID.css({position: "absolute",'left':popupMarginLeft + 'px'});
    // alert($('.box-team-main').width());
    // alert(popupID.width());
});


var boxTeamRoundId = $('.box-team-round');
boxTeamRoundId.click(function () {
    $('.mask').css('display','block');
    $('.box-popup').fadeIn('fast').css('display','block');
});


$('.box-popup-btn-close').click(function () {
    $('.mask').css('display','none');
    $('.box-popup').fadeOut('fast').css('display','none');
});


// 搜索框隐藏显示
$('#search').click(function () {
    var search = $('.box-team-search');
    if(search.css('display') == 'block'){ search.fadeOut('fast').css('display','none');}
    else { search.fadeIn('fast').css('display','block');}
});

// 我的球队隐藏显示
$('#myTeam').click(function () {
    var team = $('.box-team-my');
    if(team.css('display') == 'block'){ team.fadeOut('fast').css('display','none');}
    else { team.fadeIn('fast').css('display','block');}
});

$("button#applyTeam").click(function(){
    var teamInfo='';
    var teamurl='';
    $.ajax({
        url:"./Team/applyTeam",
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
        url:"./Team/serchTeam",
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
                teamInfo +=
                    '<div class="box-team-my">' +
                    '<div class="box-team-my-list1" style="border-top-right-radius: 10px;border-top-left-radius: 10px;">' +
                    '<span class="box-team-my-list-title">球队ID: </span>' +
                    '<span class="box-team-my-list-content">' + steam[i]["team_id"] + '</span>' +
                    '</div>' +
                    '<div class="box-team-my-list2">' +
                    '<span class="box-team-my-list-title">球队名称: </span>' +
                    '<span class="box-team-my-list-content">' + steam[i]["team_name"] + '</span>' +
                    '</div>' +
                    '<div class="box-team-my-list1" style="border-top-right-radius: 10px;border-top-left-radius: 10px;">' +
                    '<span class="box-team-my-list-title">队长ID: </span>' +
                    '<span class="box-team-my-list-content">' + steam[i]["team_leader"] + '</span>' +
                    '</div>' +
                    '<div class="box-team-my-list2">' +
                    '<span class="box-team-my-list-title">球队宣言: </span>' +
                    '<span class="box-team-my-list-content">' + steam[i]["team_slogan"] + '</span>' +
                    '</div>' +
                    '<div class="box-team-my-list1" style="border-top-right-radius: 10px;border-top-left-radius: 10px;">' +
                    '<span class="box-team-my-list-title">球队图片名: </span>' +
                    '<span class="box-team-my-list-content">' + steam[i]["team_picture"] + '</span>' +
                    '</div>' +
                    '<div class="box-team-my-list2">' +
                    '<span class="box-team-my-list-title">球队状态: </span>' +
                    '<span class="box-team-my-list-content">' + steam[i]["team_status"] + '</span>' +
                    '</div>' +
                    '<a href="+teamurl+">' + '<button class="box-team-my-list-btn2">申请加入</button>' + '</a>' +
                    '</div>';

                document.getElementById("sTeam").innerHTML= teamInfo;
            }
        }
    });
});
$("button[name='teammate']").click(function(){
    var teamMate="";
    $.ajax({
        url:"./Team/getValidTeammate",
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
        url:"./Team/getTeammate",
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
