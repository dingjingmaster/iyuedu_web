$(document).ready(function(){
  
  "use strict";
  $(".i_rank_chose").find('li').click(function(){
    $(this).siblings().removeClass("cur");
    $(this).addClass("cur");
  });
});

var app = angular.module('app', []).controller('appCtrl', function($scope, $http) {

    /* 主页初始化请求 */
    $scope.init = function () {
        /* 初始化排行榜 */
        this.getRank('/novel/main_page/rank/n/rq/');
        /* 初始化主页模块 */
        $http({method: 'GET', url: '/novel/main_page/module/n/main/'}).then(function (response) {
            var js = response.data;
            var html = js.module_zbtj;
            for(var key in js) {
                if('module_zbtj' == key) {
                    continue;
                }
                html += js[key];
            }
            $scope.mainRec =  html;
        });
    };

    /* rank 请求 */
    $scope.getRank = function (url) {
        $scope.show={detail:false, sample:true};
        $http({method: 'GET', url: url}).then(function (response) {
            $scope.novels = response.data;
        });
    };

    /* rank 鼠标事件 */
    $scope.mousePass = function () {
        return {detail:!$scope.show.detail, sample:!$scope.show.sample};
    };
});

app.filter('toHTML', ['$sce', function ($sce) {
    return function (text) {
        return $sce.trustAsHtml(text);
    };
}]);

// function init() {
//   /* 主页各个模块展示 */
//   $.get('/novel/main_page/module/n/main/', function (data, status) {
//         if ('success' == status) {
//             var html = "";
//             var json = JSON.parse(data);
//             html += json['module_zbtj'];
//             for (var key in json) {
//                 if ('module_zbtj' == key) {
//                     continue;
//                 }
//                 html += json[key];
//             }
//             document.getElementById('i_contain_right').innerHTML = html;
//         }
//     });
//
//   /* 主页榜单展示 */
//  // main_rank('/novel/main_page/rank/n/rq/');
// }




