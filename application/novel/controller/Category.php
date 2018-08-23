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

        $response = [
            'host'              =>      Util::urlType() . Util::serverIp(),
            'category'          =>      MainShow::novelCategory($category),
            'books'             =>      MainShow::searchShow($ret),
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/category.html');
    }

    public function category() {
        $infoArray = array();
        $model = new OnlineInfoModel();
        $categoryName = Request::instance()->param('c');
        $category = $model->novelCategory();
        $ret = $model->getCategoryNovel($categoryName);

        $response = [
            'host'              =>      Util::urlType() . Util::serverIp(),
            'category'          =>      MainShow::novelCategory($category),
            'books'             =>      MainShow::searchShow($ret),
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/category.html');
    }
}