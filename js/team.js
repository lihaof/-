/**
 * Created by Vonlion on 2016/11/9.
 */
$(document).ready(function () {

    //解散球队确认事件
    dissolution = function(id){
         var r=confirm("您确定要解散球队吗？")
          if (r==true){
            alert("您已成功解散球队");
            $('#' + id).parent().parent().remove();
          }

    }

    //退出球队确认事件
   exit = function(id){
         var r=confirm("您确定要退出球队吗？")
          if (r==true){
            alert("您已成功退出球队");
            $('#' + id).parent().parent().remove();
          }
    }

    var bodyID = $('body');

    // var member = $('.box-team-member');
    // var memberMarginLeft = ($('body').width() - member.width())/2;
    // member.css({position: "absolute",'left':memberMarginLeft + 'px','top':window.pageYOffset+400});

    // 申请列表居中
    /*var join = $('#joinList');
    var joinMarginLeft = ($('body').width() - join.width())/2;
    join.css({position: "absolute",'left':joinMarginLeft + 'px','top':window.pageYOffset+100});*/


    //显示申请列表
    $('#joinBtn').click(function () {
        //$('#joinList').fadeIn('fast').css('display','block');
        //bodyID.append(popupMask).css('overflow','hidden');
        if($(this).attr('applynum')==0) {
            alert("暂时未有用户申请加入");
        } else {
            var applyteammate = "";
            $.ajax({
                url:"./Team/getApplyTeammate",
                cache:false,
                type:"POST",
                async:false,
                data:{
                    team_id:$(this).attr('value')
                },
                success:function(msg) {
                    steam = $.parseJSON(msg);
                    for(var i=0;i<steam.length;i++) {
                        applyteammate +=
                        '<div id="' +
                        i+
                        '">' +
                            '<div class="img-style2"><img class="box-team-my-list-img" src="../image/fruit.png"></div>'+
                            '<div class="box-team-my-list2">'+
                                '<span class="box-team-my-list-title">队员: </span>'+
                                '<span class="box-team-my-list-content">'+steam[i]['uid']+'</span>'+
                                '<div class="btn-join">同意</div><br>'+
                            '</div>'+
                            '<div class="box-team-my-list1">'+
                                '<span class="box-team-my-list-title">队中场位: </span>'+
                                '<span class="box-team-my-list-content">'+steam[i]['position']+'</span>'+
                                '<div class="btn-join-refused">拒绝</div><br>'+
                            '</div>' +
                        '</div>';

                    }
                        applyteammate = 
                        '<div id="joinList" class="box-team-my2">'+
                        '<div class="box-team-my-list1">' +
                            '<span class="join-list-title">球队申请</span>'+
                            '<img id="joinClose" class="box-team-member-close" src="../image/close.png">' +
                        '</div>' +
                        applyteammate +
                        '</div>';

                        console.log(applyteammate);

                    bodyID.append(applyteammate).append(popupMask);
                    bodyID.css('overflow','hidden');

                    // 申请列表居中
                    var join = $('#joinList');
                    var joinMarginLeft = ($('body').width() - join.width())/2;
                    join.css({position: "absolute",'left':joinMarginLeft + 'px','top':window.pageYOffset+100});
                
                    $('.mask').css('top',window.pageYOffset);
                    //关闭申请列表
                   
                    $('#joinClose').click(function () {
                        $('#joinList').remove();
                        $('.mask').fadeOut('fast').remove();
                        bodyID.css('overflow','visible');
                    });

                     var closeJoin = function(){
                         $('#joinList').remove();
                        $('.mask').fadeOut('fast').remove();
                        bodyID.css('overflow','visible');
                     }

                    //同意以后移除当前申请列
                    $('.btn-join').click(function(){
                        //同意事件.......


                        //同意后删除当前列
                        $(this).parent().parent().remove();
                       if(!$('.btn-join').length){closeJoin();}
                    });

                     //拒绝以后移除当前申请列
                    $('.btn-join-refused').click(function(){
                        //拒绝事件.......

                        
                        //拒绝后删除当前列
                       $(this).parent().parent().remove();
                       if(!$('.btn-join-refused').length){closeJoin();}
                    });
                }
            })
        }
    });

    //关闭申请列表
    $('#joinClose').click(function () {
        $('#joinList').fadeOut('fast').css('display','none');
        $('.mask').fadeOut('fast').remove();
        bodyID.css('overflow','visible');
    });

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
$('.box-popup-btn-close').click(function () {
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
    if($("#applyTeamName").val()==""){
        alert("请输入球队名");
    } else {
        $.ajax({
            url:"./Team/applyTeam",
            cache:false,
            type:"POST",
            async:false,
            data:{
                team_name:$("#applyTeamName").val(),
                team_slogan:$("#applyTeamSlogan").val(),
                team_picture:$("#teamPict").attr("picurl")
            },
            success:function(msg) {
                alert($.parseJSON(msg).info);
                $('.box-team-main').remove();
                $('.box-popup').fadeOut('fast').css('display','none');
                $('body').css('overflow','visible');
            }
        })
    }
    
});

$("button#serchTeam").click(function(){
    document.getElementById("serchTeam").innerHTML = "搜索中…";
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
            if(steam=="") {
                alert("没有找到匹配结果");
                document.getElementById("serchTeam").innerHTML = "搜索";
            } else {
                for(var i=0;i<steam.length;i++) {
                    teamurl = "./Team/joinTeam"+"?team_id="+steam[i]['team_id'];
                    teamInfo +=
                        '<div class="box-team-my box-team-other">' +
                            '<div class="img-style2"><img class="box-team-my-list-img" src="'+
                            '../image/team/'+
                            steam[i]["team_picture"] +
                            '"></div>' +
                            '<div class="box-team-my-list2">' +
                                '<span class="box-team-my-list-content">' + steam[i]["team_name"] + '</span>' +
                                '<a class="btn-join" href= '+teamurl+'>申请加入</a>' + '<br>' +
                            '</div>' +
                            '<div class="box-team-my-list1">' +
                                '<span class="box-team-my-list-title">队长: </span>' +
                                '<span class="box-team-my-list-content">' + steam[i]["team_leader"] + '</span>' +
                            '</div>' +
                        '</div>' +
                        '</div>';
                    document.getElementById("sTeam").innerHTML= teamInfo;
            }
            document.getElementById("serchTeam").innerHTML = "搜索";
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
                    '<div class="img-style2" style="padding-left: 0"><img class="box-team-my-list-img" src="../image/fruit.png"></div>' +
                    '<span class="box-team-my-list-title">队员: </span>' +
                    '<span class="box-team-my-list-content">' + steam[i]['uid'] + '</span>' +
                '</div>' +
                '<div class="box-team-my-list1">' +
                    '<span class="box-team-my-list-title">队中场位: </span>' +
                    '<span class="box-team-my-list-content">' + steam[i]['position'] + '</span>' +
                '</div>' + '<div class="single-line2"></div>' +
                '<div class="single-line"></div>';
            }

            teamMate =
            '<div class="box-team-my box-team-member" style="box-shadow:none">' +
                '<div class="box-team-my-list1">' +
                    '<span class="join-list-title">我的队友</span>' +
                    '<img class="box-team-member-close" src="../image/close.png">' +
                '</div>' + teamMate +
            '</div>';

            bodyID.append(teamMate).append(popupMask);
            // member.fadeIn('fast').css('display','block');
            bodyID.css('overflow','hidden');

            //查看球员弹窗居中
            var member = $('.box-team-member');
            var memberMarginLeft = ($('body').width() - member.width())/2;
            member.css({position: "absolute",'left':memberMarginLeft + 'px','top':window.pageYOffset+100});
            $('.mask').css('top',window.pageYOffset);

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
                teamurl = "./Team/admitTeam"+"?team_memmber_id="+steam[i]['team_memmber_id'];
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

function postPort()
{
    var formData = new FormData($( "#teamform" )[0]);  
     $.ajax({  
          url:"./Team/getTeamPort",
          type: 'POST',  
          data: formData,  
          async: false,  
          cache: false,  
          contentType: false,  
          processData: false,  
          success: function (returndata) {
            returndata = $.parseJSON(returndata);
            if(returndata['error']) {
                alert(returndata['error']);
            } else {
                $("#teamPict").attr("src","../image/team/"+returndata['success']);
                $("#teamPict").attr("picurl",returndata['success']);
            }
          },
          error: function (returndata) {  
              alert(returndata);
          }  
     });
}
