<?php
namespace app\novel\controller;
use \think\Controller;
use app\common\Util;

class MainPage extends Controller
{
    public function index()
    {
        $response = [
            /* host */
            'host'              =>      Util::urlType() . Util::serverIp(),
        ];

        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/index.html');
    }
}
