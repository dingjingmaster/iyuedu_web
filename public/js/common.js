$(document).ready(function(){

    "use strict";
    $(".i_rank_chose").find('li').click(function(){
        $(this).siblings().removeClass("cur");
        $(this).addClass("cur");
    });

    $(".i_list_item").on("mousemove", function(){
        $(this).find('.i_detail').show();
        $(this).find('.i_sample').hide();
        $(this).siblings().find('.i_sample').show();
        $(this).siblings().find('.i_detail').hide();
    });
});