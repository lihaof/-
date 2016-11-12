/**
 * Created by Vonlion on 2016/11/12.
 */
$(document).ready(function () {

    $('#dd').click(function () {
        $('.form-style').hide().show()
        

    });


    var changebgc = function() {
        $('.form-style').find('tr').each(function () {
            if ($(this).index() % 2 == 0) {
                $(this).css('background-color', '#fff');
            }
            else {
                $(this).css('background-color', '#F6F6F6');
            }
        });
    }

    //同意球队申请
    agree = function (id) {
        var agreeList = $('#' + id).parent().parent();
        var agreeHistroy;

        // 同意事件....


        var r=confirm("您确定要通过该球队申请吗？")
        if (r){
            agreeList.remove();
            agreeList.find('.status').text('审核通过').css('color','#2bb654');
            agreeList.find('.agree-btn').remove();

            //同意之后保存记录
            $('#agreed tbody').prepend(agreeList);
            changebgc();
        }
    }



    //拒绝球队申请
    refuse = function (id) {
        var refuseList = $('#' + id);

        // 拒绝事件....


        var r=confirm("您确定要拒绝该球队申请吗？")
        if (r){
            refuseList.parent().parent().remove();
        }
    }
});