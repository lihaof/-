$(document).ready(function () {

    $('.box-left').width($('.box-left').width()-2.5);
    $('.box-right').width($('.box-right').width()-2.5);

    $('.bottom div').each(function () {
        $(this).click(function () {
            $('.btn-normal').removeClass('btn-pressed');
            $('.p-normal').removeClass('p-pressed');
            $(this).children('img').addClass('btn-pressed');
            $(this).children('p').addClass('p-pressed');
        })
    });

    //动态获取周数
    var today = new Date();
    var day = today.getDay() - 1;
    var year = today.getFullYear();
    var month = today.getMonth();
    var weeks = new Array('周一', '周二', '周三', '周四', '周五', '周六', '周日');
    for(var i = 0; i < 7; i++){
        $('.week-select').find('p').eq(i).text(weeks[(day + i) % 7]);
    }

    //获取n天后的日期
    function GetDateStr(AddDayCount) {
        var dd = new Date();
        dd.setDate(dd.getDate()+AddDayCount);//获取AddDayCount天后的日期
        var d = dd.getDate();
        return d + '日';
    }

    //动态获取天数
    for(var i = 2; i < 7; i++){
        $('.week-select').find('span').eq(i).text(GetDateStr(i));
    }


    //滑动块移动
    var tabWeek = $('.week');
    tabWeek.each(function () {
        $(this).click(function () {
            var marginLeft = $(this).offset().left + 'px';
            $("#slide").animate({left:marginLeft},300);
            $('.week').removeClass('week-border');
            $(this).addClass('week-border');

        });
    });

    $("div[id^='reserve']").hide();
    $('#reserve0').show();

    //切换周数
    tabWeek.click(function () {
        var num = $(this).index();
        $("div[id^='reserve']").hide();
        // $('#tab1').hide();
        $('#reserve' + num).show();
    });

});