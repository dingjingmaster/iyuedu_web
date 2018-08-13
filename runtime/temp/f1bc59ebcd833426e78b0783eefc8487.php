<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:\GitHub\iyuedu_web\/application/novel/view/index.html";i:1533826203;}*/ ?>
<!DOCTYPE html>
<html xml:lang="zh-Hans" lang="zh-Hans">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>悦读吧</title>
    <!--<link rel="icon" href="<?php echo $host; ?>/public/assets/img/dj.icon" type="image/x-icon"/>-->
    <!-- CSS 文件 -->
    <link href="<?php echo $host; ?>/public/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $host; ?>/public/css/lrs-index.css" rel="stylesheet">
</head>
<body>
<!-- 导航栏开始 -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">标题</a>
        </div>

        <!-- 导航内容开始 -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">文学</a></li>
                <li><a href="#">传记</a></li>
                <li><a href="#">百科</a></li>
                <li><a href="#">励志</a></li>
                <li><a href="#">诗词</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left">
                    <div class="navbar-form navbar-left input-group">
                        <span class="input-group-btn" data-toggle="buttons">
                            <label class="btn btn-default active"><input type="radio" name="options" autocomplete="off" checked>书名</label>
                            <label class="btn btn-default"><input type="radio" name="options" autocomplete="off">作者名</label>
                        </span>
                        <input type="text" class="form-control" placeholder="请输入书名或者作者名...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">查找</button>
                        </span>
                    </div>
                </form>
            </ul>
        </div>
        <!-- 导航内容结束 -->
    </div>
</nav>
<!-- 导航栏结束 -->

<!-- banner 开始 -->
<div class="container-fluid lrs-padding-banner" style="height: 20px">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">

            <div id="index-banner" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#index-banner" data-slide-to="0" class="active"></li>
                    <li data-target="#index-banner" data-slide-to="1"></li>
                    <li data-target="#index-banner" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img style="width: 100%; height: 180px" src="https://qidian.qpic.cn/qidian_common/349573/e36fef0004ba30ba59a40bcdb26ce819/0" alt="...">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="https://qidian.qpic.cn/qidian_common/349573/c6890cd0a2aadc1ca5555b776c6ce38d/0" alt="...">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="https://qidian.qpic.cn/qidian_common/349573/58aa7af36b21e05850e246ee8d90e7a1/0" alt="...">
                        <div class="carousel-caption">
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#index-banner" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#index-banner" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- banner 结束 -->


<!-- 正文开始 -->
<div class="lrs-padding-content container-fluid">
    <div class="row">
        <!-- 推荐展示开始 -->
        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-1" style="background: #c1e2b3">
            <!-- 第一行开始 -->
            <div class="row" style="background: #2b542c">
                <div class="col-xs-12 col-sm-12 col-md-4" style="background: #eea236">
                    <div class="lrs-book-div center-block">
                        <img src="<?php echo $host; ?>/public/img/2205s.jpg" alt="测试图片" class="img-thumbnail lrs-book-img">
                        <div class="lrs-book-summary center-block">
                            <dd><dt class="bg-success">大主宰</dt></dd>
                            <dd>
                                <span class="label label-info">玄幻</span>
                                <span class="label label-info">奇幻</span>
                            </dd>
                            <dd class="lrs-book-summary-info">
                                《大主宰》主角，号“大主宰” [2]  ，牧府府主，大千宫”诛魔王“。拥有“八部浮屠”和“一气化三清“，并将”一气化三清“修至三神境，外加真龙真凤之灵结合自成“一气化五身身”；’负八神脉与九神脉，掌握”太灵圣体“、“万古不朽身“、”无尽光明体”三座原始法身“，修成圣品肉身，借助三法身之力于“苍穹榜”上留下姓氏，超脱圣品 [3]  。后再次掌握“荒神体”、“夜神古体”二座原始法身，”一气化三清“达到归一境，五法身归一，终于在苍穹榜上留下完整真名，将该境界命名为“主宰境”，大千世界有史以来牧尘是第一个在“苍穹榜”上留下全名的人。
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4" style="background: #eea236">
                    <div class="lrs-book-div center-block">
                        <img src="<?php echo $host; ?>/public/img/2205s.jpg" alt="测试图片" class="img-thumbnail lrs-book-img">
                        <div class="lrs-book-summary center-block">
                            <dd><dt class="bg-success">大主宰</dt></dd>
                            <dd>
                                <span class="label label-info">玄幻</span>
                                <span class="label label-info">奇幻</span>
                            </dd>
                            <dd class="lrs-book-summary-info">
                                《大主宰》主角，号“大主宰” [2]  ，牧府府主，大千宫”诛魔王“。拥有“八部浮屠”和“一气化三清“，并将”一气化三清“修至三神境，外加真龙真凤之灵结合自成“一气化五身身”；’负八神脉与九神脉，掌握”太灵圣体“、“万古不朽身“、”无尽光明体”三座原始法身“，修成圣品肉身，借助三法身之力于“苍穹榜”上留下姓氏，超脱圣品 [3]  。后再次掌握“荒神体”、“夜神古体”二座原始法身，”一气化三清“达到归一境，五法身归一，终于在苍穹榜上留下完整真名，将该境界命名为“主宰境”，大千世界有史以来牧尘是第一个在“苍穹榜”上留下全名的人。
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4" style="background: #eea236">
                    <div class="lrs-book-div center-block">
                        <img src="<?php echo $host; ?>/public/img/2205s.jpg" alt="测试图片" class="img-thumbnail lrs-book-img">
                        <div class="lrs-book-summary center-block">
                            <dd><dt class="bg-success">大主宰</dt></dd>
                            <dd>
                                <span class="label label-info">玄幻</span>
                                <span class="label label-info">奇幻</span>
                            </dd>
                            <dd class="lrs-book-summary-info">
                                《大主宰》主角，号“大主宰” [2]  ，牧府府主，大千宫”诛魔王“。拥有“八部浮屠”和“一气化三清“，并将”一气化三清“修至三神境，外加真龙真凤之灵结合自成“一气化五身身”；’负八神脉与九神脉，掌握”太灵圣体“、“万古不朽身“、”无尽光明体”三座原始法身“，修成圣品肉身，借助三法身之力于“苍穹榜”上留下姓氏，超脱圣品 [3]  。后再次掌握“荒神体”、“夜神古体”二座原始法身，”一气化三清“达到归一境，五法身归一，终于在苍穹榜上留下完整真名，将该境界命名为“主宰境”，大千世界有史以来牧尘是第一个在“苍穹榜”上留下全名的人。
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 第一行结束 -->

            <!-- 第一行开始 -->
            <div class="row" style="background: #2b542c">
                <div class="col-xs-12 col-sm-12 col-md-4" style="background: #eea236">
                    <div class="lrs-book-div center-block">
                        <img src="<?php echo $host; ?>/public/img/2205s.jpg" alt="测试图片" class="img-thumbnail lrs-book-img">
                        <div class="lrs-book-summary center-block">
                            <dd><dt class="bg-success">大主宰</dt></dd>
                            <dd>
                                <span class="label label-info">玄幻</span>
                                <span class="label label-info">奇幻</span>
                            </dd>
                            <dd class="lrs-book-summary-info">
                                《大主宰》主角，号“大主宰” [2]  ，牧府府主，大千宫”诛魔王“。拥有“八部浮屠”和“一气化三清“，并将”一气化三清“修至三神境，外加真龙真凤之灵结合自成“一气化五身身”；’负八神脉与九神脉，掌握”太灵圣体“、“万古不朽身“、”无尽光明体”三座原始法身“，修成圣品肉身，借助三法身之力于“苍穹榜”上留下姓氏，超脱圣品 [3]  。后再次掌握“荒神体”、“夜神古体”二座原始法身，”一气化三清“达到归一境，五法身归一，终于在苍穹榜上留下完整真名，将该境界命名为“主宰境”，大千世界有史以来牧尘是第一个在“苍穹榜”上留下全名的人。
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4" style="background: #eea236">
                    <div class="lrs-book-div center-block">
                        <img src="<?php echo $host; ?>/public/img/2205s.jpg" alt="测试图片" class="img-thumbnail lrs-book-img">
                        <div class="lrs-book-summary center-block">
                            <dd><dt class="bg-success">大主宰</dt></dd>
                            <dd>
                                <span class="label label-info">玄幻</span>
                                <span class="label label-info">奇幻</span>
                            </dd>
                            <dd class="lrs-book-summary-info">
                                《大主宰》主角，号“大主宰” [2]  ，牧府府主，大千宫”诛魔王“。拥有“八部浮屠”和“一气化三清“，并将”一气化三清“修至三神境，外加真龙真凤之灵结合自成“一气化五身身”；’负八神脉与九神脉，掌握”太灵圣体“、“万古不朽身“、”无尽光明体”三座原始法身“，修成圣品肉身，借助三法身之力于“苍穹榜”上留下姓氏，超脱圣品 [3]  。后再次掌握“荒神体”、“夜神古体”二座原始法身，”一气化三清“达到归一境，五法身归一，终于在苍穹榜上留下完整真名，将该境界命名为“主宰境”，大千世界有史以来牧尘是第一个在“苍穹榜”上留下全名的人。
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4" style="background: #eea236">
                    <div class="lrs-book-div center-block">
                        <img src="<?php echo $host; ?>/public/img/2205s.jpg" alt="测试图片" class="img-thumbnail lrs-book-img">
                        <div class="lrs-book-summary center-block">
                            <dd><dt class="bg-success">大主宰</dt></dd>
                            <dd>
                                <span class="label label-info">玄幻</span>
                                <span class="label label-info">奇幻</span>
                            </dd>
                            <dd class="lrs-book-summary-info">
                                《大主宰》主角，号“大主宰” [2]  ，牧府府主，大千宫”诛魔王“。拥有“八部浮屠”和“一气化三清“，并将”一气化三清“修至三神境，外加真龙真凤之灵结合自成“一气化五身身”；’负八神脉与九神脉，掌握”太灵圣体“、“万古不朽身“、”无尽光明体”三座原始法身“，修成圣品肉身，借助三法身之力于“苍穹榜”上留下姓氏，超脱圣品 [3]  。后再次掌握“荒神体”、“夜神古体”二座原始法身，”一气化三清“达到归一境，五法身归一，终于在苍穹榜上留下完整真名，将该境界命名为“主宰境”，大千世界有史以来牧尘是第一个在“苍穹榜”上留下全名的人。
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 第一行结束 -->

            <!-- 第一行开始 -->
            <div class="row" style="background: #2b542c">
                <div class="col-xs-12 col-sm-12 col-md-4" style="background: #eea236">
                    <div class="lrs-book-div center-block">
                        <img src="<?php echo $host; ?>/public/img/2205s.jpg" alt="测试图片" class="img-thumbnail lrs-book-img">
                        <div class="lrs-book-summary center-block">
                            <dd><dt class="bg-success">大主宰</dt></dd>
                            <dd>
                                <span class="label label-info">玄幻</span>
                                <span class="label label-info">奇幻</span>
                            </dd>
                            <dd class="lrs-book-summary-info">
                                《大主宰》主角，号“大主宰” [2]  ，牧府府主，大千宫”诛魔王“。拥有“八部浮屠”和“一气化三清“，并将”一气化三清“修至三神境，外加真龙真凤之灵结合自成“一气化五身身”；’负八神脉与九神脉，掌握”太灵圣体“、“万古不朽身“、”无尽光明体”三座原始法身“，修成圣品肉身，借助三法身之力于“苍穹榜”上留下姓氏，超脱圣品 [3]  。后再次掌握“荒神体”、“夜神古体”二座原始法身，”一气化三清“达到归一境，五法身归一，终于在苍穹榜上留下完整真名，将该境界命名为“主宰境”，大千世界有史以来牧尘是第一个在“苍穹榜”上留下全名的人。
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4" style="background: #eea236">
                    <div class="lrs-book-div center-block">
                        <img src="<?php echo $host; ?>/public/img/2205s.jpg" alt="测试图片" class="img-thumbnail lrs-book-img">
                        <div class="lrs-book-summary center-block">
                            <dd><dt class="bg-success">大主宰</dt></dd>
                            <dd>
                                <span class="label label-info">玄幻</span>
                                <span class="label label-info">奇幻</span>
                            </dd>
                            <dd class="lrs-book-summary-info">
                                《大主宰》主角，号“大主宰” [2]  ，牧府府主，大千宫”诛魔王“。拥有“八部浮屠”和“一气化三清“，并将”一气化三清“修至三神境，外加真龙真凤之灵结合自成“一气化五身身”；’负八神脉与九神脉，掌握”太灵圣体“、“万古不朽身“、”无尽光明体”三座原始法身“，修成圣品肉身，借助三法身之力于“苍穹榜”上留下姓氏，超脱圣品 [3]  。后再次掌握“荒神体”、“夜神古体”二座原始法身，”一气化三清“达到归一境，五法身归一，终于在苍穹榜上留下完整真名，将该境界命名为“主宰境”，大千世界有史以来牧尘是第一个在“苍穹榜”上留下全名的人。
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4" style="background: #eea236">
                    <div class="lrs-book-div center-block">
                        <img src="<?php echo $host; ?>/public/img/2205s.jpg" alt="测试图片" class="img-thumbnail lrs-book-img">
                        <div class="lrs-book-summary center-block">
                            <dd><dt class="bg-success">大主宰</dt></dd>
                            <dd>
                                <span class="label label-info">玄幻</span>
                                <span class="label label-info">奇幻</span>
                            </dd>
                            <dd class="lrs-book-summary-info">
                                《大主宰》主角，号“大主宰” [2]  ，牧府府主，大千宫”诛魔王“。拥有“八部浮屠”和“一气化三清“，并将”一气化三清“修至三神境，外加真龙真凤之灵结合自成“一气化五身身”；’负八神脉与九神脉，掌握”太灵圣体“、“万古不朽身“、”无尽光明体”三座原始法身“，修成圣品肉身，借助三法身之力于“苍穹榜”上留下姓氏，超脱圣品 [3]  。后再次掌握“荒神体”、“夜神古体”二座原始法身，”一气化三清“达到归一境，五法身归一，终于在苍穹榜上留下完整真名，将该境界命名为“主宰境”，大千世界有史以来牧尘是第一个在“苍穹榜”上留下全名的人。
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 第一行结束 -->
        </div>
        <!-- 推荐展示结束 -->

        <!-- top 侧边栏 -->
        <div class="hidden-xs hidden-sm col-md-2" style="background: #ebccd1">
            <div class="lrs-book-slider center-block">
                <h4>热销榜</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <small class="lrs-book-slider-category">玄幻</small>
                        <a href="#">大主宰</a>
                        <small class="lrs-book-slider-author">天蚕土豆</small>
                    </li>
                    <li class="list-group-item">
                        <small class="lrs-book-slider-category">玄幻</small>
                        <a href="#">大主宰</a>
                        <small class="lrs-book-slider-author">天蚕土豆</small>
                    </li>
                    <li class="list-group-item">
                        <small class="lrs-book-slider-category">玄幻</small>
                        <a href="#">大主宰</a>
                        <small class="lrs-book-slider-author">天蚕土豆</small>
                    </li>
                    <li class="list-group-item">
                        <small class="lrs-book-slider-category">玄幻</small>
                        <a href="#">大主宰</a>
                        <small class="lrs-book-slider-author">天蚕土豆</small>
                    </li>
                    <li class="list-group-item">
                        <small class="lrs-book-slider-category">玄幻</small>
                        <a href="#">大主宰</a>
                        <small class="lrs-book-slider-author">天蚕土豆</small>
                    </li>
                </ul>
            </div>
        </div>
        <!-- 推荐侧边栏结束 -->
    </div>
    <!-- 分类热书 top -->
    <div>
        <div class="row">
            <!-- 推荐展示开始 -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-1" style="background: #c1e2b3">
            </div>
    </div>
</div>

<!-- 正文结束 -->

<!-- 页脚开始 -->

<!-- 页脚结束 -->
<!-- javascript -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $host; ?>/public/js/bootstrap.min.js"></script>
</body>
</html>