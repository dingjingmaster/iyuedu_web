<?php
namespace app\novel\controller;
use  think\Request;
use \think\Controller;
use app\common\Util;
use app\common\MainShow;
use app\novel\model\OnlineInfoModel;
use think\Session;

class MainPage extends Controller {
    /* 主页 展示主页 */
    public function index() {
        $showLog = Session::has('user')?'i_hidden':'i_show';
        $showLogged = Session::has('user')?'i_show':'i_hidden';
        $userName = Session::has('user')?Session::get('user.name'):'';
        $response = [
            'host'              =>      Util::urlType() . Util::serverIp(),
            'showLogged'        =>      $showLogged,
            'showLog'           =>      $showLog,
            'userName'          =>      $userName,
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/index.html');
    }

    /* 主页模块 返回数据 */
    public function module() {
        $info = array();
        $infoArray = array();
        $detail = new OnlineInfoModel();
        $moduleName = Request::instance()->param('n');
        if ('main' == $moduleName) {
            $info = $detail->mainModule();
            foreach ($info as $m => $ids) {
                foreach ($ids as $id) {
                    $infoArray[$id] = $detail->novelInfo($id);
                }
            }
        }
        $ret = MainShow::showMainModule($info, $infoArray);
        return json_encode($ret);
    }

    /* 排行榜页面 返回数据 */
    public function rank() {
        $infoArray = array();
        $detail = new OnlineInfoModel();
        $moduleName = 'rank_' . Request::instance()->param('n');
        $info = $detail->mainRank($moduleName);
        foreach ($info[$moduleName] as $id) {
            $infoArray[$id] = $detail->novelInfo($id);
        }
        $ret = MainShow::showMainRank($info, $infoArray);

        echo json_encode($ret);
    }
}
