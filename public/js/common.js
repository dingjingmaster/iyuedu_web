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

/* 首页排行榜 */
function rank_request(rankName) {
    $.get("/web/index/mrank/irank/" + rankName , function (data, status) {
        var html = '';
        if('success' == status) {
            var d = JSON.parse(data);
            for (var i = 0; i < d.length; ++i) {
                var novel = d[i];
                if(1 == novel.num) {
                    html += '<li class="i_list_item">' +
                        '<div class="i_sample i_hidden">' +
                        '<span class="i_num">'+ novel.num + '</span>' +
                        '<h4 class="i_name">' + novel.name + '</h4>' +
                        '<p class="i_author">'+ novel.author +'</p>' +
                        '</div>' +
                        '<div class="i_detail i_show">' +
                        '<span class="i_num">' + novel.num + '</span>' +
                        '<a><img style="width: 100px; height:133px;" src="data:image/' + novel.imgType + ';base64,'+novel.imgCotent +'" title="'+ novel.name+'"/></a>'+
                        '<div class="detail"><p class="i_detail_name">'+ novel.name +'</p><p class="i_detail_author">' + novel.author + '</p></div>' +
                        '</div>' +
                        '<div class="i_clear"></div>'+
                        '</li>';
                } else {
                    html += '<li class="i_list_item">' +
                        '<div class="i_sample i_show">' +
                        '<span class="i_num">'+ novel.num + '</span>' +
                        '<h4 class="i_name">' + novel.name + '</h4>' +
                        '<p class="i_author">'+ novel.author +'</p>' +
                        '</div>' +
                        '<div class="i_detail i_hidden">' +
                        '<span class="i_num">' + novel.num + '</span>' +
                        '<a><img style="width: 100px; height:133px;" src="data:image/' + novel.imgType + ';base64,'+novel.imgCotent +'" title="'+ novel.name+'"/></a>'+
                        '<div class="detail"><p class="i_detail_name">'+ novel.name +'</p><p class="i_detail_author">' + novel.author + '</p></div>' +
                        '</div>' +
                        '<div class="i_clear"></div>'+
                        '</li>';
                }
            }
            html += '<script>' + '$(".i_list_item").on("mousemove", function(){'+
                '$(this).find(".i_detail").show();'+
                '$(this).find(".i_sample").hide();'+
                '$(this).siblings().find(".i_sample").show();'+
                '$(this).siblings().find(".i_detail").hide();'+
            '});' + '</script>';
            $("#i_rank_list").html(html);
        }
    });
}