<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/8/23
 * Time: 14:19
 */

namespace app\novel\controller;
use  think\Request;
use \think\Controller;
use app\common\Util;
use app\common\MainShow;
use app\novel\model\OnlineInfoModel;

class Category extends Controller {
    public function init () {
        $novelModel = new OnlineInfoModel();
        $category = $novelModel->novelCategory();
        $ret = $novelModel->getCategoryNovel($category[0]);
        $curPage = 0;                           // 当前第几页
        $totalNum = count($ret);                // 总条数

        $ret = array_slice($ret, 0, $this->everyPage);
        $response = [
            'host'              =>      Util::urlType() . Util::serverIp(),
            'category'          =>      MainShow::novelCategory($category),
            'books'             =>      MainShow::searchShow($ret),
            'pageSplit'         =>      Util::pageSplit($category[0], $curPage, $totalNum, $this->showPage, $this->everyPage),
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/category.html');
    }

    public function category() {
        $model = new OnlineInfoModel();
        $categoryName = Request::instance()->param('c');
        $curPage = Request::instance()->param('cur');
        $category = $model->novelCategory();
        $ret = $model->getCategoryNovel($categoryName);
        /* 翻页功能 */
        $totalNum = count($ret);
        $curItem = ($curPage - 1) * $this->everyPage;
        $ret = array_slice($ret, $curItem, $this->everyPage);

        $response = [
            'host'              =>      Util::urlType() . Util::serverIp(),
            'category'          =>      MainShow::novelCategory($category),
            'books'             =>      MainShow::searchShow($ret),
            'pageSplit'         =>      Util::pageSplit($categoryName, $curPage, $totalNum, $this->showPage, $this->everyPage),
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/category.html');
    }

    /* 参数设置 */
    private $everyPage = 12;            // 每页展示条数
    private $showPage = 5;              // 显示页数
}