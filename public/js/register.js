angular.module('register', []).controller('registerCtrl', function($scope, $http) {
    /* 重置按钮 */
    $scope.name_input = function () {
        var len = $scope.regName.length;
        if("" != $scope.regName && len <= 15) {
            $scope.regNameL = "正确";
        } else if(len > 15){
            $scope.regNameL = "用户名仅限15个字符以内";
            $scope.regName = "";
        } else {
            $scope.regNameL ="请输入可见字符";
            $scope.regName = "";
        }
    };
    
    $scope.mail_input = function () {
        var pattern = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if (pattern.test($scope.regMail)){
            $scope.regMailL = "正确";
        }else {
            $scope.regMailL = "错误的邮箱格式";
            $scope.regMail = "";
        }
    };

    $scope.passwd1_input = function () {
        var len = $scope.regPasswd1.length;
        if("" != $scope.regPasswd1 && len <= 20) {
            $scope.regPasswd1L = "正确";
        } else if (len > 15) {
            $scope.regPasswd1L = "密码仅限20个字符以内";
            $scope.regPasswd1 = "";
        } else {
            $scope.regPasswd1L = "请输入有效字符";
            $scope.regPasswd1 = "";
        }
    };

    $scope.passwd2_input = function () {
        $scope.regPasswd2L = "";
        if($scope.regPasswd1 != $scope.regPasswd2) {
            $scope.regPasswd2L = "两次输入密码不一致";
        } else {
            $scope.regPasswd2L = "正确";
        }
    };

    $scope.register_clear = function () {
        $scope.regName = "";
        $scope.regNameL = "";
        $scope.regMail = "";
        $scope.regMailL = "";
        $scope.regPasswd1 = "";
        $scope.regPasswd1L = "";
        $scope.regPasswd2 = "";
        $scope.regPasswd2L = "";
    };

    $scope.register_ok = function () {
        var pattern = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if ("" != $scope.regName && pattern.test($scope.regMail) && ($scope.regPasswd1 == $scope.regPasswd2)) {
            $http({
                method: 'POST',
                url: '/novel/login/regUser/',
                data:{
                    "user":$scope.regName,
                    "mail":$scope.regMail,
                    "passwd":$scope.regPasswd1
                }
            }).then(function (response) {
                if(200 == response.status) {
                    var info = response.data;
                    if(info.retCode == 0) {
                        alert(info.retInfo);
                        window.location.href = '/novel/login/loginHTML/';
                    } else {
                        alert(info.retInfo + '请您稍后再试! 感谢您的理解！');
                        window.location.href = '/';
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