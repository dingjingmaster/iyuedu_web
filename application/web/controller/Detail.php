<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/9/4
 * Time: 7:57
 */

namespace app\web\controller;

use think\view;
use think\Session;
use think\Request;
use app\common\Show;
use app\common\Utils;
use app\web\model\OnlineInfoModel;


class Detail extends ControllerBase {
    public function novel() {
        $showLog = Session::has('user')?'i_hidden':'i_show';
        $showLogged = Session::has('user')?'i_show':'i_hidden';
        $userName = Session::has('user')?Session::get('user.name'):'';
        $novelID = Request::instance()->param('id');
        $curPage = Request::instance()->param('cur');

        $novelModel = new OnlineInfoModel();
        $novelInfo = $novelModel->novelAllInfo($novelID);
        /* 设置默认值 */
        if('' == $novelInfo['desc']) {
            $novelInfo['desc'] = '暂无';
        }
        if('' == $curPage || NULL == $curPage) {
            $curPage = 1;
        }

        /* 处理章节 */
        $chapter = Utils::chapterSort($novelInfo['chapter']);
        $totalNum = count($chapter);
        $curItem = ($curPage - 1) * $this->everyPage * 2;
        $curItem = Utils::integerFloor($curItem);
        $chapter = array_slice($chapter, $curItem, $this->everyPage * 2, true);
        $chapter = Show::chapterSplit($chapter);
        $novelInfo['chapter'] = $chapter;
        $novelInfo['updateTime'] = Utils::timeStr($novelInfo['updateTime']);

        /* 输出 */
        $view = new View();
        $view->host = Utils::urlType() . Utils::serverIp();                                         /* url */
        $view->showLog = Session::has('user')?'i_hidden':'i_show';                          /* 未登录展示 */
        $view->showLogged = Session::has('user')?'i_show':'i_hidden';                       /* 登陆展示 */
        $view->userName = Session::has('user')?Session::get('user.name'):'';        /*  用户名展示 */
        $view->novelInfo = $novelInfo;
        $view->pageSplit = Utils::pageSplit($this->baseUrl, $novelID, $curPage, $totalNum%2==1?$totalNum/2?(int)($totalNum/2+1):$totalNum/2:$totalNum/2, $this->showPage, $this->everyPage);

        $ret = $view->fetch('web@index/detail');

        return $ret;
    }

    /* 参数设置 */
    private $baseUrl = '/web/detail/novel/id';
    private $everyPage = 20;                                    // 每页展示条数
    private $showPage = 9;                                      // 显示页数

}