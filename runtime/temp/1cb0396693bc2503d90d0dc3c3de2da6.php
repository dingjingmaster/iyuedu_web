<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"E:\GitHub\iyuedu_web\/application/novel/view/search.html";i:1535016672;}*/ ?>
<!doctype html>
<html ng-app="app" ng-controller="appCtrl" >
<head>
    <meta charset="utf-8">
    <title>爱阅读</title>
    <meta name="keywords" content="小说,小说网,玄幻小说,武侠小说,都市小说,历史小说,网络小说,言情小说,青春小说,原创网络文学">
    <meta name="description" content="小说阅读,精彩小说尽在起点中文网. 起点中文网提供玄幻小说,武侠小说,原创小说,网游小说,都市小说,言情小说,青春小说,历史小说,军事小说,网游小说,科幻小说,恐怖小说,首发小说,最新章节免费">
    <meta name="robots" content="all">
    <meta name="googlebot" content="all">
    <meta name="baiduspider" content="all">
    <meta name="updatetime" content="2018-08-09,20:55:32">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <script type="text/javascript" src="http://www.iyd.cn/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>
    <link rel="stylesheet" href="<?php echo $host; ?>/public/css/style.css">
    <script src="<?php echo $host; ?>/public/js/common.js" type="text/javascript"></script>
</head>

<body data-ng-init="detailInit()" style="background-color: #FFFAF0">
  <div class="i_head">
    <div class="i_head_t">
      <div class="i_head_img">
        <img style="width: 165px; height: 56px;" src="<?php echo $host; ?>/public/img/logo.png">
      </div>
      <div class="i_search">
        <input class="i_search_name" type="text" ng-model="query" placeholder="请输入书名"/>
        <div class="i_search_btn" ng-click="searchBook('<?php echo $host; ?>', query)" style="cursor: pointer;"></div>
      </div>
    </div>
    
    <div class="i_head_nav">
      <ul class="i_menu">
        <li class="i_menu_item">
          <a href="<?php echo $host; ?>" class="c_write">首页</a>
        </li>
        <li class="i_menu_item">
          <a href="/novel/category/init/" class="c_write">分类</a>
        </li>
        <li class="i_menu_item">
          <a href="#" class="c_write">榜单</a>
        </li>
      </ul>
    </div>
  </div>

  <!-- 主要内容开始 -->
  <div class="i_contain">
      <div class="i_search_result"><?php echo $searchResult; ?></div>
      <div class="i_category_split"><?php echo $pageSplit; ?></div>
  </div>
  <div class="i_clear"></div>
  <div class="i_footer fix_bottom"></div>
</body>
</html>
