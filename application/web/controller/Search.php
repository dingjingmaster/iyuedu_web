<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/9/3
 * Time: 10:47
 */

namespace app\web\controller;
use think\View;
use think\Session;
use think\Request;
use app\common\Show;
use app\common\Utils;
use app\web\model\OnlineInfoModel;

class Search extends ControllerBase {
    public function book() {
        $showLog = Session::has('user')?'i_hidden':'i_show';
        $showLogged = Session::has('user')?'i_show':'i_hidden';
        $userName = Session::has('user')?Session::get('user.name'):'';

        $html = '';
        $pageSplit = '';
        $queryName = Request::instance()->param('query');
        $curPage = Request::instance()->param('cur');
        if('' != $queryName) {
            $novelModel = new OnlineInfoModel();
            $novel = $novelModel->novelQuery($queryName);
            if('' == $curPage || NULL == $curPage) {
                $curPage = 1;
            }
            $totalNum = count($novel);
            $curItem = ($curPage - 1) * $this->everyPage;
            $curItem = Utils::integerFloor($curItem);
            $novel = array_slice($novel, $curItem, $this->everyPage);

            if(count($novel) > 0) {
                $html .= Show::searchShow($novel);
                $pageSplit = Utils::pageSplit($this->baseUrl, $queryName, $curPage, $totalNum, $this->showPage, $this->everyPage);
            } else {
                $html = '<p align="center"> sorry!!! 没有找到您的书籍，我们会尽快对书籍进行补充。</p>';
            }
        } else {
            $html = '<p align="center"> sorry!!! 没有找到您的书籍，我们会尽快对书籍进行补充。</p>';
        }
        $view = new View();
        $view->host = Utils::urlType() . Utils::serverIp();                                         /* url */
        $view->showLog = Session::has('user')?'i_hidden':'i_show';                          /* 未登录展示 */
        $view->showLogged = Session::has('user')?'i_show':'i_hidden';                       /* 登陆展示 */
        $view->userName = Session::has('user')?Session::get('user.name'):'';        /*  用户名展示 */
        $view->searchResult = $html;
        $view->pageSplit = $pageSplit;

        $ret = $view->fetch('web@index/search');

        return $ret;
    }
    private $baseUrl = '/web/search/book/query';
    private $everyPage = 20;            // 每页展示条数
    private $showPage = 9;              // 显示页数
}