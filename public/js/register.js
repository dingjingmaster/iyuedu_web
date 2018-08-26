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

    };

    $scope.passwd2_input = function () {

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
    }
});