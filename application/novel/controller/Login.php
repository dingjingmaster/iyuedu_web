<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/8/26
 * Time: 10:37
 */

namespace app\novel\controller;
use  think\Request;
use \think\Controller;
use app\common\Util;
use app\common\MainShow;


class Login extends Controller {
    public function login () {
        $response = [
            /* host */
            'host'              =>      Util::urlType() . Util::serverIp(),
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/login.html');
    }

    public function register() {
        $response = [
            /* host */
            'host'              =>      Util::urlType() . Util::serverIp(),
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/register.html');
    }
}