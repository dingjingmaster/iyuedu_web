<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\GitHub\iyuedu_web\/application/novel/view/register.html";i:1535293318;}*/ ?>
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
    <script src="<?php echo $host; ?>/public/js/register.js" type="text/javascript"></script>
    <!-- 谷歌分析 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124579177-1"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-124579177-1');</script>
    <!-- 广告 -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>(adsbygoogle = window.adsbygoogle || []).push({google_ad_client: "ca-pub-8080155533523922", enable_page_level_ads: true});</script>
</head>

<body  ng-app="register" style="background-color: #FFFAF0">
  <!-- 主要内容开始 -->
  <div ng-cloak ng-controller="registerCtrl" class="register_content">
      <h3 style="color: #9932CC;">爱阅读新用户注册</h3>
      <nobr><p>用户名:&nbsp;<input class="reg_input" type="text" ng-model="regName" placeholder="用户名" ng-blur="name_input()"/>&nbsp;&nbsp;<label style="color: #9932CC" ng-model="regNameL">{{regNameL}}</label></p></nobr>
      <nobr><p>邮&nbsp;&nbsp;箱:&nbsp;<input class="reg_input" type="text" ng-model="regMail" placeholder="请输入邮箱" ng-blur="mail_input()"/>&nbsp;&nbsp;<label style="color: #9932CC" ng-model="regMailL">{{regMailL}}</label></p></nobr>
      <nobr><p>密&nbsp;&nbsp;码:&nbsp;<input class="reg_input" type="text" ng-model="regPasswd1" placeholder="请输入密码" ng-blur="passwd1_input()"/>&nbsp;&nbsp;<label style="color: #9932CC" ng-model="regPasswd1L">{{regPasswd1L}}</label></p></nobr>
      <nobr><p>密&nbsp;&nbsp;码:&nbsp;<input class="reg_input" type="text" ng-model="regPasswd2" placeholder="请再次输入密码" ng-blur="passwd2_input()"/>&nbsp;&nbsp;<label style="color: #9932CC" ng-model="regPasswd2L">{{regPasswd2L}}</label></p></nobr>
      <br/>
      <div style="margin-left: 98px;" align="center">
          <a ng-click="register_clear()">重置</a>&nbsp;&nbsp;&nbsp;&nbsp;<a ng-model="registerOk">注册</a>
      </div>
  </div>
  <div class="i_clear"></div>
  <div class="i_footer fix_bottom"></div>
</body>
</html>
