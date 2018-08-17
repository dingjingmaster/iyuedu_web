<?php
namespace app\novel\controller;
use  think\Request;
use \think\Controller;
use app\common\Util;
use app\common\MainShow;
use app\novel\model\OnlineInfoModel;

class MainPage extends Controller {
    /* 主页 展示主页 */
    public function index() {
        $response = [
            /* host */
            'host'              =>      Util::urlType() . Util::serverIp(),
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/index.html');
    }

    /* 主页模块 返回数据 */
    // http://127.0.0.1/novel/main_page/module/m/zbtj
    public function module() {
        $ret = array();
        $info = array();
        $infoArray = array();
        $detail = new OnlineInfoModel();
        $moduleName = Request::instance()->param('m');
        if ($moduleName == 'main') {
            $info = $detail->novelModule();
            foreach ($info as $m => $ids) {
                foreach ($ids as $id) {
                    $infoArray[$id] = $detail->novelInfo($id);
                }
            }
        }
        $ret = MainShow::showMain($info, $infoArray);
        return json_encode($ret);
    }
}
