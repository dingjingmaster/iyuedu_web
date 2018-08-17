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

function get_request() {
  $.get('/novel/main_page/module/m/main/', function (data, status) {
    if ('success' == status) {
      var html = "";
      var json = JSON.parse(data);
      html += json['module_zbtj'];
      for (var key in json) {
        if ('module_zbtj' == key) {
          continue;
        }
        html += json[key];
      }
      document.getElementById('i_contain_right').innerHTML = html;
        // document.getElementById('i_rec11').innerHTML = json['module_zbtj'];
        // document.getElementById('i_rec12').innerHTML = json['moudle_ysxs'];
        // document.getElementById('i_rec13').innerHTML = json['module_qcwx'];
        // document.getElementById('i_rec14').innerHTML = json['module_yqxs'];
        // document.getElementById('i_rec15').innerHTML = json['module_jdwx'];
        // document.getElementById('i_rec16').innerHTML = json['module_lzwx'];
    }
  });
}


