<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"E:\GitHub\iyuedu_web\/application/web/view/content.html";i:1535099375;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>爱阅读</title>
    <meta name="keywords" content="小说,小说网,玄幻小说,武侠小说,都市小说,历史小说,网络小说,言情小说,青春小说">
    <meta name="description" content="小说阅读,武侠小说,原创小说,网游小说,都市小说,言情小说,青春小说,历史小说,军事小说,网游小说,科幻小说,恐怖小说,首发小说,最新章节免费">
    <meta name="robots" content="all">
    <meta name="googlebot" content="all">
    <meta name="baiduspider" content="all">
    <meta name="updatetime" content="2018-08-09,20:55:32">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <link rel="stylesheet" href="<?php echo $host; ?>/public/css/style.css">
    <!-- 谷歌分析 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124579177-1"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-124579177-1');</script>
    <!-- 广告 -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>(adsbygoogle = window.adsbygoogle || []).push({google_ad_client: "ca-pub-8080155533523922", enable_page_level_ads: true});</script>
</head>

<body style="background-color: #FFFAF0">
  <!-- 主要内容开始 -->
  <div class="i_read_contain">
      <h3><?php echo $chapter; ?> &nbsp; 正文</h3><hr/>
     <?php echo $content; ?>
  </div>
  <div class="i_clear"></div>
  <div class="i_footer fix_bottom"></div>
</body>
</html>
