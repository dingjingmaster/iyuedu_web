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
use app\common\Utils;
use app\web\model\OnlineInfoModel;

class Index extends ControllerBase {
    public function index() {
        $view = new View();
        $onlineInfo = new OnlineInfoModel();
        $view->host = Utils::urlType() . Utils::serverIp();                                         /* url */
        $view->showLog = Session::has('user')?'i_hidden':'i_show';                          /* 未登录展示 */
        $view->showLogged = Session::has('user')?'i_show':'i_hidden';                       /* 登陆展示 */
        $view->userName = Session::has('user')?Session::get('user.name'):'';        /*  用户名展示 */

        /* 左侧排行榜 */
        $view->rankList = $onlineInfo->mainRank('rank_rq');

        /* 右侧主页数据 */
        $mainList = $onlineInfo->mainRecommend();
        $view->zbtj = $mainList['module_zbtj'];
        $view->qcwx = $mainList['module_qcwx'];
        $view->jdwx = $mainList['module_jdwx'];
        $view->lzwx = $mainList['module_lzwx'];
        $view->yqxs = $mainList['module_yqxs'];

        // 错误捕获处理
        $ret = $view->fetch('web@index/index');

        return $ret;
    }

    /* 首页 排行榜请求 */
    public function mrank() {
        $onlineInfo = new OnlineInfoModel();
        /* 左侧排行榜数据 */
        $rankName = '';
        $rankName = Request::instance()->param('irank');
        if("" != $rankName) {
            $rankName = 'rank_' . $rankName;
        } else {
            // 默认人气榜
            $rankName = 'rank_' . 'rq';
        }
        $rankList = $onlineInfo->mainRank($rankName);

        return json_encode($rankList);
    }

    /*  */
}