<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:\GitHub\iyuedu_web\/application/novel/view/login.html";i:1535288492;}*/ ?>
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
    <!-- 广告 -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>(adsbygoogle = window.adsbygoogle || []).push({google_ad_client: "ca-pub-8080155533523922", enable_page_level_ads: true});</script>
</head>

<body style="background-color: #FFFAF0">
  <!-- 主要内容开始 -->
  <div class="login_content">
      <h3 style="margin-left: 60px;" align="center">爱阅读登录</h3>
      <nobr><p>用户名:&nbsp;<input type="text" ng-model="log_name"></p></nobr>
      <nobr><p>密&nbsp;&nbsp;码:&nbsp;<input type="text" ng-model="log_passwd"></p></nobr>
      <br/>
      <div style="margin-left: 60px;" align="center">
          <a ng-model="log_submit">登录</a>&nbsp;&nbsp;&nbsp;&nbsp;<a ng-model="log_register">注册</a>
      </div>
  </div>
  <div class="i_clear"></div>
  <div class="i_footer fix_bottom"></div>
</body>
</html>
