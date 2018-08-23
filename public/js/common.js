$(document).ready(function(){
  
  "use strict";
  $(".i_rank_chose").find('li').click(function(){
    $(this).siblings().removeClass("cur");
    $(this).addClass("cur");
  });
});

var app = angular.module('app', []).controller('appCtrl', function($scope, $http) {

    /* 主页初始化请求 */
    $scope.mainInit = function () {
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

    /* 搜索请求 */
    $scope.searchBook = function (host, query) {
        if (undefined === query || null == query || "" === query) {
            return;
        }
        window.location.href="javascript:location.href='" + host + "/novel/search/book/query/" + query + "'";
    }
});

app.filter('toHTML', ['$sce', function ($sce) {
    return function (text) {
        return $sce.trustAsHtml(text);
    };
}]);



