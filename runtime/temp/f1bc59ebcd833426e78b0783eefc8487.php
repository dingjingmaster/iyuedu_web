<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:\GitHub\iyuedu_web\/application/novel/view/index.html";i:1534844648;}*/ ?>
<!doctype html>
<html>
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
    <link rel="stylesheet" href="../../../public/css/style.css">
    <script src="../../../public/js/common.js" type="text/javascript"></script>
</head>

<body ng-app="app" onload="init()" style="background-color: #FFFAF0">
  <div class="i_head">
    <div class="i_head_t">
      <div class="i_head_img">
        <img src="https://farm4.static.mitang.com/M00/B8/F8/sIYBAFsLw7OAU5jlAAAUNUHMJhE969/爱阅读官网logo.png">
      </div>
      <div class="i_search">
        <input class="i_search_name" type="text" placeholder="请输入书名"/>
        <div class="i_search_btn" style="cursor: pointer;"></div>
      </div>
    </div>
    
    <div class="i_head_nav">
      <ul class="i_menu">
        <li class="i_menu_item">
          <a href="#" class="c_write">首页</a>
        </li>
        <li class="i_menu_item">
          <a href="#" class="c_write">分类</a>
        </li>
        <li class="i_menu_item">
          <a href="#" class="c_write">榜单</a>
        </li>
      </ul>
    </div>
  </div>
  
  <div id="index_contain" class="i_contain">
    <div class="i_contain_left">
      
      <div class="i_contain_rank">
        <ul class="i_rank_chose">
          <li class="i_rank_chose_item cur">人气榜</li>
          <li class="i_rank_chose_item">完结榜</li>
        </ul>
        <ul ng-cloak class="i_rank_list" ng-controller="rankCtrl">
            <li ng-model="show"
                class="i_list_item"
                ng-init="show=novel.show"
                ng-repeat="novel in novels track by novel.num"
                ng-mouseenter="show={detail:true, sample:false}"
                ng-mouseleave="show={detail:false, sample:true}">

                <div class="i_sample" ng-show="show.sample">
                    <span class="i_num">{{ novel.num }}</span>
                    <span class="i_name">{{ novel.name }}</span>
                    <p class="i_author">{{ novel.author }}</p>
                </div>
                <div class="i_detail" ng-show="show.detail">
                    <span class="i_num">{{ novel.num }}</span>
                    <a href="#">
                        <img style="width:100px; height:133px;" ng-src="{{ novel.imgSrc }}" title="{{ novel.name }}"/>
                    </a>
                    <div class="detail">
                        <a href="#" onclick="">
                            <p class="i_detail_name">{{ novel.name }}</p>
                        </a>
                        <p class="i_detail_author">{{ novel.author }}</p>
                    </div>
                </div>
                <div class="i_clear"></div>
            </li>




        </ul>
      </div>
    </div>

      <!-- 主页输出推荐 -->
      <div id="i_contain_right" class="i_contain_right"></div>
  </div>
  <div class="i_clear"></div>

  <div class="i_footer fix_bottom">
  </div>
  <script type="text/javascript" defer>
      init();
  </script>

  
</body>
</html>