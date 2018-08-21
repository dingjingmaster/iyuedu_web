$(document).ready(function(){
  
  "use strict";
  $(".i_rank_chose").find('li').click(function(){
    $(this).siblings().removeClass("cur");
    $(this).addClass("cur");
  });
});

function init() {
  /* 主页各个模块展示 */
  $.get('/novel/main_page/module/n/main/', function (data, status) {
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
        }
    });

  /* 主页榜单展示 */
  var app = angular.module('app', []).controller('rankCtrl', function($scope, $http) {
      $scope.show={detail:false, sample:true};
      // var
      $http({method: 'GET', url:'/novel/main_page/rank/n/rq/'}).then(function (response) {
          $scope.novels = response.data;
          $scope.mousePass = function () {
              return {detail:!$scope.show.detail, sample:!$scope.show.sample};
          };
      });
  });
}


