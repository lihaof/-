/**
 * Created by Vonlion on 2016/11/9.
 */
$(document).ready(function () {

    var bodyID = $('body');

    //创建球队弹窗居中
    var popupCenter = function () {
        var popupID = $('.box-popup');
        var popupMarginLeft = ($('body').width() - popupID.width() - 30)/2;
        popupID.css({position: "absolute",'left':popupMarginLeft + 'px'});
    };

    popupCenter();

    //灰幕
    var popupMask =
        '<div class="box-team-main">' +
        '<div class="mask">' +
        '</div>';

// 创建球队弹窗
var boxTeamRoundId = $('.box-team-round');
    boxTeamRoundId.click(function () {
    popupCenter();
    bodyID.append(popupMask);
    $('.mask').css('top',window.pageYOffset);
    $('.box-popup').fadeIn('fast').css('display','block').css('top',window.pageYOffset+100);
    bodyID.css('overflow','hidden');
});

//关闭创建球队弹窗
var close = $('.box-popup-btn-close').click(function () {
    $('.box-team-main').remove();
    $('.box-popup').fadeOut('fast').css('display','none');
    $('body').css('overflow','visible');
});


// 搜索框隐藏显示及去除搜索结果
$('#search').click(function () {
    var search = $('.box-team-search');
    if(search.css('display') == 'block'){
        search.fadeOut('fast').css('display','none');
        $('.box-team-other').fadeOut('fast').remove();
    }
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
            close();
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
                    '<div class="box-team-other">' +
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

                // document.getElementById("sTeam").innerHTML= teamInfo;
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
                teamMate +=
                '<div class="box-team-my-list2">' +
                    '<span class="box-team-my-list-title">队中场位: </span>' +
                    '<span class="box-team-my-list-content">' + steam[i]['position'] + '</span>' +
                '</div>' +
                '<div class="box-team-my-list1">' +
                    '<span class="box-team-my-list-title">队员ID: </span>' +
                    '<span class="box-team-my-list-content">' + steam[i]['uid'] + '</span>' +
                '</div>'
            }

            teamMate =
            '<div class="box-team-my box-team-member">' +
                '<div class="box-team-my-list1">' +
                    '<div class="box-team-member-close">关闭</div>' +
                '</div>' + teamMate +
            '</div>';

            bodyID.append(teamMate).append(popupMask);
            // member.fadeIn('fast').css('display','block');
            bodyID.css('overflow','hidden');

            //查看球员弹窗居中
            var memberMarginLeft = ($('body').width() - $('.box-team-member').width())/2;
            $('.box-team-member').css({position: "absolute",'left':memberMarginLeft + 'px'});

            //关闭查看球员弹窗
            var closeMember = $('.box-team-member-close').click(function () {
                $('.box-team-member').remove();
                $('.mask').fadeOut('fast').remove();
                bodyID.css('overflow','visible');
            });
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

});
