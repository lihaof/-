$(document).ready(function(){
    //默认显示第一个表格
    $('.form-style').hide().eq(0).show();

    //表格铺满屏幕
    var formWidth = ($(window).width() - $('#nav').width())*0.95;
    var formMarginLeft = ($(window).width() - $('#nav').width() - formWidth)/2;
    $('.form-style').width(formWidth);
    $('.form-style').css('marginLeft',formMarginLeft);

    //激活的区块隐藏箭头
    $('.module2').find('.module-img').css('display','none');

    //点击子模块切换
    $('.module').each(function () {
        $(this).click(function () {
            $('.module').find('.module-img').css('display','block');
            $('.module').removeClass('module2');
            $(this).addClass('module2');
            $(this).find('.module-img').css('display','none');
            $('.form-style').hide().eq($(this).index()).show();
        });
    });
});