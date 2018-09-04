<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:58:"E:\GitHub\iyuedu_web/application/web\view\index\index.html";i:1536037859;s:58:"E:\GitHub\iyuedu_web\application\web\view\public\base.html";i:1536037921;s:60:"E:\GitHub\iyuedu_web\application\web\view\public\header.html";i:1535954867;s:62:"E:\GitHub\iyuedu_web\application\web\view\public\mainRank.html";i:1536029716;s:65:"E:\GitHub\iyuedu_web\application\web\view\public\mainContent.html";i:1536037815;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>爱阅读</title>
    <meta name="keywords" content="小说,小说网,玄幻小说,武侠小说,都市小说,历史小说,网络小说,言情小说,青春小说">
    <meta name="description" content="小说阅读,武侠小说,网游小说,都市小说,言情小说,青春小说,历史小说,军事小说,网游小说,科幻小说,恐怖小说,首发小说,最新章节免费">
    <meta name="robots" content="all">
    <meta name="googlebot" content="all">
    <meta name="baiduspider" content="all">
    <meta name="updatetime" content="2018-08-09,20:55:32">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <script type="text/javascript" src="http://www.iyd.cn/js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" href="<?php echo $host; ?>/public/css/style.css">
    <script type="text/javascript" src="<?php echo $host; ?>/public/js/common.js"></script>
</head>
<body style="background-color: #ffffff">
    <div class="i_head">
<div class="i_head_t">
<div class="i_head_img"><img style="width: 168px; height: 68px;" src="<?php echo $host; ?>/public/img/logo.png"></div>
<div class="i_search">
<input class="i_search_name" type="text" placeholder="请输入书名"/>
<div class="i_search_btn" style="cursor: pointer;"></div>
</div>
</div>
<div class="i_head_nav">
<ul class="i_menu">
<li class="i_menu_item"><a href="<?php echo $host; ?>" class="c_write">首页</a></li>
<li class="i_menu_item"><a href="/novel/category/init/" class="c_write">分类</a></li>
<li class="i_menu_item"><a href="#" class="c_write">书架</a></li>
<li class="i_login_status <?php echo $showLog; ?>"><nobr><a href="/novel/login/loginHTML/" class="c_write">登录</a>|<a href="/novel/login/registerHTML/" class="c_write">注册</a></nobr></li>
<li class="i_login_status <?php echo $showLogged; ?>"><nobr><a href="#" class="c_write"><?php echo $userName; ?>&nbsp;已登录</a></nobr></li>
</ul>
</div>
</div>
    <div class="i_contain">
        <div class="i_contain_left">
    <div class="i_contain_rank">
        <ul class="i_rank_chose">
            <li class="i_rank_chose_item cur" onclick="rank_request('rq')">人气榜</li>
            <li class="i_rank_chose_item" onclick="rank_request('wj')">完结榜</li>
        </ul>
        <ul id="i_rank_list" class="i_rank_list">
            <?php if(is_array($rankList) || $rankList instanceof \think\Collection || $rankList instanceof \think\Paginator): $i = 0; $__LIST__ = $rankList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$novel): $mod = ($i % 2 );++$i;if(($novel['num'] == 1)): ?>
                <li class="i_list_item">
                    <div class="i_sample i_hidden">
                        <span class="i_num"><?php echo $novel['num']; ?></span>
                        <h4 class="i_name"><?php echo $novel['name']; ?></h4>
                        <p class="i_author"><?php echo $novel['author']; ?></p>
                    </div>
                    <div class="i_detail i_show">
                        <span class="i_num"><?php echo $novel['num']; ?></span>
                        <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><img style="width: 100px; height:133px;" src="data:image/<?php echo $novel['imgType']; ?>;base64,<?php echo $novel['imgCotent']; ?>" title="<?php echo $novel['name']; ?>"/></a>
                        <div class="detail"><p class="i_detail_name"><a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><?php echo $novel['name']; ?></a></p><p class="i_detail_author"><?php echo $novel['author']; ?></p></div>
                    </div>
                    <div class="i_clear"></div>
                </li>
            <?php else: ?>
                <li class="i_list_item">
                    <div class="i_sample i_show">
                        <span class="i_num"><?php echo $novel['num']; ?></span>
                        <h4 class="i_name"><?php echo $novel['name']; ?></h4>
                        <p class="i_author"><?php echo $novel['author']; ?></p>
                    </div>
                    <div class="i_detail i_hidden">
                        <span class="i_num"><?php echo $novel['num']; ?></span>
                        <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><img style="width: 100px; height:133px;" src="data:image/<?php echo $novel['imgType']; ?>;base64,<?php echo $novel['imgCotent']; ?>" title="<?php echo $novel['name']; ?>"/></a>
                        <div class="detail"><p class="i_detail_name"><a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><?php echo $novel['name']; ?></a></p><p class="i_detail_author"><?php echo $novel['author']; ?></p></div>
                    </div>
                    <div class="i_clear"></div>
                </li>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
        <div class="i_contain_right">
    <div class="i_rec_1">
        <h3 class="i_rec1_title">重磅推荐</h3>
        <div class="i_rec1_content">
            <ul class="i_rec1_list">
                <?php if(is_array($zbtj) || $zbtj instanceof \think\Collection || $zbtj instanceof \think\Paginator): $i = 0; $__LIST__ = $zbtj;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$novel): $mod = ($i % 2 );++$i;?>
                <li class="i_rec1_item">
                    <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><img style="width:150px;height:200px" src="data:image/<?php echo $novel['imgType']; ?>;base64,<?php echo $novel['imgCotent']; ?>" title="<?php echo $novel['name']; ?>"/></a>
                    <div class="i_rec_info">
                        <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><h3 class="i_rec_name"><?php echo $novel['name']; ?></h3></a>
                        <small class="i_rec_author"><?php echo $novel['author']; ?></small>
                        <small class="i_rec_desc"><?php echo $novel['desc']; ?></small>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>

    <div class="i_rec_2">
        <h3 class="i_rec2_title">青春文学</h3>
        <ul class="i_rec2_list">
            <?php if(is_array($qcwx) || $qcwx instanceof \think\Collection || $qcwx instanceof \think\Paginator): $i = 0; $__LIST__ = $qcwx;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$novel): $mod = ($i % 2 );++$i;?>
                <li class="i_rec2_item">
                    <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><img style="width:120px;height:160px" src="data:image/<?php echo $novel['imgType']; ?>;base64,<?php echo $novel['imgCotent']; ?>" title="<?php echo $novel['name']; ?>"/></a>
                    <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><h5 class="i_rec2_name"><?php echo $novel['name']; ?></h5></a>
                    <small  class="i_rec2_author"><?php echo $novel['author']; ?></small >
                </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    <div class="i_rec_2">
        <h3 class="i_rec2_title">经典文学</h3>
        <ul class="i_rec2_list">
            <?php if(is_array($jdwx) || $jdwx instanceof \think\Collection || $jdwx instanceof \think\Paginator): $i = 0; $__LIST__ = $jdwx;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$novel): $mod = ($i % 2 );++$i;?>
            <li class="i_rec2_item">
                <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><img style="width:120px;height:160px" src="data:image/<?php echo $novel['imgType']; ?>;base64,<?php echo $novel['imgCotent']; ?>" title="<?php echo $novel['name']; ?>"/></a>
                <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><h5 class="i_rec2_name"><?php echo $novel['name']; ?></h5></a>
                <small  class="i_rec2_author"><?php echo $novel['author']; ?></small >
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    <div class="i_rec_2">
        <h3 class="i_rec2_title">励志文学</h3>
        <ul class="i_rec2_list">
            <?php if(is_array($lzwx) || $lzwx instanceof \think\Collection || $lzwx instanceof \think\Paginator): $i = 0; $__LIST__ = $lzwx;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$novel): $mod = ($i % 2 );++$i;?>
            <li class="i_rec2_item">
                <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><img style="width:120px;height:160px" src="data:image/<?php echo $novel['imgType']; ?>;base64,<?php echo $novel['imgCotent']; ?>" title="<?php echo $novel['name']; ?>"/></a>
                <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><h5 class="i_rec2_name"><?php echo $novel['name']; ?></h5></a>
                <small  class="i_rec2_author"><?php echo $novel['author']; ?></small >
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    <div class="i_rec_2">
        <h3 class="i_rec2_title">言情小说</h3>
        <ul class="i_rec2_list">
            <?php if(is_array($yqxs) || $yqxs instanceof \think\Collection || $yqxs instanceof \think\Paginator): $i = 0; $__LIST__ = $yqxs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$novel): $mod = ($i % 2 );++$i;?>
            <li class="i_rec2_item">
                <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><img style="width:120px;height:160px" src="data:image/<?php echo $novel['imgType']; ?>;base64,<?php echo $novel['imgCotent']; ?>" title="<?php echo $novel['name']; ?>"/></a>
                <a href="/web/detail/novel/id/<?php echo $novel['id']; ?>/"><h5 class="i_rec2_name"><?php echo $novel['name']; ?></h5></a>
                <small  class="i_rec2_author"><?php echo $novel['author']; ?></small >
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
        
    </div>
    
</body>
</html>