<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"E:\GitHub\iyuedu_web/application/web\view\index\content.html";i:1536038485;s:58:"E:\GitHub\iyuedu_web\application\web\view\public\base.html";i:1536037921;s:61:"E:\GitHub\iyuedu_web\application\web\view\public\content.html";i:1536053021;}*/ ?>
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
    
    <div class="i_contain">
        
        
        <div class="i_read_contain">
    <h3><?php echo $chapter; ?> &nbsp; 正文</h3><hr/>
    <?php echo $content; ?>
    <hr/>
    <div align="center">
        <?php echo $pageTurn; ?>
    </div>
</div>
<div class="i_clear"></div>
    </div>
    
</body>
</html>