$(document).ready(function () {
    //表格铺满屏幕
    var formWidth = ($(window).width() - $('#nav').width())*0.95;
    var formMarginLeft = ($(window).width() - $('#nav').width() - formWidth)/2;
    $('#form').width(formWidth);
    $('#form').css('marginLeft',formMarginLeft);

    //激活的区块隐藏箭头
    $('.module2').find('.module-img').css('display','none');

    //点击子模块
    $('.module').each(function () {
        $(this).click(function () {
            $('.module').find('.module-img').css('display','block');
            $('.module').removeClass('module2');
            $(this).addClass('module2');
            $(this).find('.module-img').css('display','none');
        });
    });
});