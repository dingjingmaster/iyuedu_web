<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/9/4
 * Time: 14:43
 */

namespace app\web\controller;


use app\common\Show;
use app\common\Utils;
use app\web\model\OnlineInfoModel;
use think\Request;
use think\Session;
use think\View;

class Category extends ControllerBase {
    public function category() {
        $showLog = Session::has('user')?'i_hidden':'i_show';
        $showLogged = Session::has('user')?'i_show':'i_hidden';
        $userName = Session::has('user')?Session::get('user.name'):'';
        $model = new OnlineInfoModel();
        $categoryName = Request::instance()->param('c');
        $curPage = Request::instance()->param('cur');

        /* 默认分类 */
        if('' == $categoryName || null == $categoryName) {
            $categoryName = '励志成功';
        }
        /* 默认页 */
        if('' == $curPage || null == $curPage) {
            $curPage = 1;
        }

        /* 分类 */
        $category = $model->novelCategory();
        $ret = $model->getCategoryNovel($categoryName);

        /* 翻页功能 */
        $book = '';
        $pageSplit = '';
        $totalNum = count($ret);
        $curItem = ($curPage - 1) * $this->everyPage;
        $curItem = Utils::integerFloor($curItem);
        $ret = array_slice($ret, $curItem, $this->everyPage);
        if(count($ret) > 0) {
            $book = Show::categoryShow($ret);
            $pageSplit = Utils::pageSplit($this->baseUrl, $categoryName, $curPage, $totalNum, $this->showPage, $this->everyPage);
        }

        $view = new View();
        $view->host = Utils::urlType() . Utils::serverIp();                                                 /* url        */
        $view->showLog = Session::has('user')?'i_hidden':'i_show';                                  /* 未登录展示 */
        $view->showLogged = Session::has('user')?'i_show':'i_hidden';                               /* 登陆展示   */
        $view->userName = Session::has('user')?Session::get('user.name'):'';                /* 用户名展示 */
        $view->categoryList = $category;
        $view->books = $book;
        $view->pageSplit = $pageSplit;

        $ret = $view->fetch('web@index/category');
        return $ret;
    }
    /* 参数设置 */
    private $baseUrl = '/web/detail/novel/id';
    private $everyPage = 20;                                    // 每页展示条数
    private $showPage = 9;                                      // 显示页数

}