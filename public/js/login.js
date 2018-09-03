angular.module('login', []).controller('loginCtrl', function($scope, $http) {
    $scope.log_register = function () {
        window.location.href = '/novel/login/registerHTML/';
    };
    
    $scope.log_submit = function () {
        $scope.logError = '';
        var pattern = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
        if ("" != $scope.logPasswd && pattern.test($scope.logName)) {
            $http({
                method: 'POST',
                url: '/novel/login/canLogin/',
                data:{
                    "u": $scope.logName,
                    "p": $scope.logPasswd
                }
            }).then(function (response) {
                if(200 == response.status) {
                    var info = response.data;
                    if(info.retCode == 0) {
                        $scope.logError = info.retInfo;
                        // 进入书架
                        window.location.href = '/';
                    } else {
                        $scope.logError = "密码输入错误";
                    }
                } else {
                    alert('抱歉！请求失败，请您稍后再试！');
                    return false;
                }
            });
        } else {
            alert("请您检查并确认，输入的数据是否正确!!!");
        }
    }
});