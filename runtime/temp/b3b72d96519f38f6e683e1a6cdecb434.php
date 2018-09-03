<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:\GitHub\iyuedu_web\/application/web/view/login.html";i:1535702535;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>爱阅读</title>
    <meta name="robots" content="all">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <link rel="stylesheet" href="<?php echo $host; ?>/public/css/style.css">
    <script type="text/javascript" src="http://www.iyd.cn/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>
    <script src="<?php echo $host; ?>/public/js/login.js" type="text/javascript"></script>
    <!-- 谷歌分析 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124579177-1"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-124579177-1');</script>
</head>

<body ng-app="login" style="background-color: #FFFAF0">
  <!-- 主要内容开始 -->
  <div class="login_content" ng-controller="loginCtrl">
      <h3 style="margin-left: 60px;" align="center">爱阅读登录</h3>
      <nobr><p>用户名:&nbsp;<input type="text" ng-model="logName" placeholder="请输入您的注册手机号码"></p></nobr>
      <nobr><p>密&nbsp;&nbsp;码:&nbsp;<input type="password" ng-model="logPasswd" placeholder="请输入您的密码">&nbsp;&nbsp;<label style="color: #9932CC;" ng-model="logError">{{logError}}</label></p></nobr>
      <br/>
      <div style="margin-left: 60px;" align="center">
          <a ng-click="log_register()">注册</a>&nbsp;&nbsp;&nbsp;&nbsp;<a ng-click="log_submit()">登录</a>
      </div>
  </div>
  <div class="i_clear"></div>
  <div class="i_footer fix_bottom"></div>
</body>
</html>
