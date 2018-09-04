<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:61:"E:\GitHub\iyuedu_web/application/web\view\index\category.html";i:1536043929;s:58:"E:\GitHub\iyuedu_web\application\web\view\public\base.html";i:1536037921;s:60:"E:\GitHub\iyuedu_web\application\web\view\public\header.html";i:1536047154;s:66:"E:\GitHub\iyuedu_web\application\web\view\public\categoryName.html";i:1536052395;s:69:"E:\GitHub\iyuedu_web\application\web\view\public\categoryContent.html";i:1536053234;}*/ ?>
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
<li class="i_menu_item"><a href="/web/category/category/" class="c_write">分类</a></li>
<li class="i_menu_item"><a href="#" class="c_write">书架</a></li>
<li class="i_login_status <?php echo $showLog; ?>"><nobr><a href="/novel/login/loginHTML/" class="c_write">登录</a>|<a href="/novel/login/registerHTML/" class="c_write">注册</a></nobr></li>
<li class="i_login_status <?php echo $showLogged; ?>"><nobr><a href="#" class="c_write"><?php echo $userName; ?>&nbsp;已登录</a></nobr></li>
</ul>
</div>
</div>
    <div class="i_contain">
        <div class="i_contain_left">
    <div class="i_category_list">
        <table width="100%">
            <?php $count = count($categoryList) - 1; $flag = $count % 2; if(($flag == 0)): $__FOR_START_860968858__=0;$__FOR_END_860968858__=$count;for($i=$__FOR_START_860968858__;$i < $__FOR_END_860968858__;$i+=2){ ?>
                <tr>
                    <th><a href="/web/category/category/c/<?php echo $categoryList[$i]; ?>"><?php echo $categoryList[$i]; ?></a></th>
                    <th><a href="/web/category/category/c/<?php echo $categoryList[$i+1]; ?>"><?php echo $categoryList[$i+1]; ?></a></th>
                </tr>
                <?php } else: $__FOR_START_715641919__=0;$__FOR_END_715641919__=$count;for($i=$__FOR_START_715641919__;$i < $__FOR_END_715641919__;$i+=2){ ?>
                <tr>
                    <th><a href="/web/category/category/c/<?php echo $categoryList[$i]; ?>"><?php echo $categoryList[$i]; ?></a></th>
                    <th><a href="/web/category/category/c/<?php echo $categoryList[$i+1]; ?>"><?php echo $categoryList[$i+1]; ?></a></th>
                </tr>
                <?php } ?>
                <tr><th><a href="/web/category/category/c/<?php echo $categoryList[$count-1]; ?>"><?php echo $categoryList[$count-1]; ?></a></th></tr>
            <?php endif; ?>
        </table>
    </div>
</div>
        <div class="i_contain_right">
    <div class="i_category_books"><?php echo $books; ?></div>
    <div class="i_category_split"><?php echo $pageSplit; ?></div>
</div>
<div class="i_clear"></div>
        
    </div>
    
</body>
</html>