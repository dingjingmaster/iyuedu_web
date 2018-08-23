<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"E:\GitHub\iyuedu_web\/application/novel/view/detail.html";i:1535005854;}*/ ?>
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
      <div class="d_detail">
          <div>
              <img class="d_detail_img" src="<?php echo $img; ?>"/>
              <div class="d_detail_info">
                  <h1><?php echo $name; ?></h1>
                  <span><strong>作者</strong>：<?php echo $author; ?></span><br/>
                  <span><strong>类型</strong>：<?php echo $category; ?></span><br/>
                  <span><strong>状态</strong>：<?php echo $status; ?></span><br/>
                  <span><strong>阅读量</strong>：<?php echo $view; ?></span><br/>
                  <span><strong>更新时间</strong>：<?php echo $update; ?></span><br/>
                  <span><strong>简介</strong>：</span><br/>
                  <small class="d_detail_desc"><?php echo $desc; ?></small>
              </div>
          </div>
          <div class="i_clear"></div>
          <h3>&nbsp;&nbsp;&nbsp;&nbsp;目录</h3><hr/>
          <div class="d_detail_catalog">
              <table width="100%">
                  <?php foreach($chapter as $vo): if(count($vo) == 2): ?>
                  <tr align="left" class="d_catalog_table">
                      <th><a href="/novel/content/content/id/<?php echo $id; ?>/c1/<?php echo $vo[0][1]; ?>/c2/<?php echo $vo[0][0]; ?>/"><?php echo $vo[0][1]; ?></a></th>
                      <th><a href="/novel/content/content/id/<?php echo $id; ?>/c1/<?php echo $vo[1][1]; ?>/c2/<?php echo $vo[1][0]; ?>/"><?php echo $vo[1][1]; ?></a></th>
                  </tr>
                  <?php elseif(count($vo) == 1): ?>
                  <tr align="left" class="d_catalog_table">
                      <th><a href="/novel/content/content/id/<?php echo $id; ?>/c1/<?php echo $vo[0][1]; ?>/c2/<?php echo $vo[0][0]; ?>/"><?php echo $vo[0][1]; ?></a></th>
                      <th></th>
                  </tr>
                  <?php endif; endforeach; ?>
              </table>
          </div>
      </div>
      <div class="d_category_rec"></div>

  </div>
  <div class="i_clear"></div>
  <div class="i_footer fix_bottom"></div>
</body>
</html>
