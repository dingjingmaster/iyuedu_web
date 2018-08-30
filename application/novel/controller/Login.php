<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/8/26
 * Time: 10:37
 */

namespace app\novel\controller;
use think\Session;
use  think\Request;
use app\common\Util;
use \think\Controller;
use app\novel\model\UserModel;


class Login extends Controller {
    const RET_OK    = 0;
    const RET_ERROR =   -1;
    public function loginHTML () {

        $response = [
            'host'              =>      Util::urlType() . Util::serverIp(),
        ];

        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/login.html');
    }

    public function registerHTML() {
        $response = [
            'host'              =>      Util::urlType() . Util::serverIp(),
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/register.html');
    }

    /* 邮箱验证 -- 发送邮件 */
    public function regUser() {
        $retCode = Login::RET_ERROR;
        $retInfo = '';
        $userModel = new UserModel();
        $user = Request::instance()->param('user');
        $mail = Request::instance()->param('mail');
        $passwd = Request::instance()->param('passwd');

        $pm = Util::identifyingCode();
        $ret = $userModel->register($mail, $user, $passwd, $pm);
        if (UserModel::RET_OK == $ret) {
            $url = Util::urlType() . Util::serverIp() . '/novel/login/regResult/u/' . $user . '/e/' . $mail . '/p/' . $pm;
            $er = Util::sendMail($mail, $user, $url);
            if($er) {
                $retCode = Login::RET_OK;
                $retInfo = '注册成功, 请您登陆注册邮箱进行验证!';
            } else {
                $retCode = Login::RET_ERROR;
                $retInfo = '注册邮件发送失败！';
            }
        } else if (UserModel::RET_ERROR_CUNZAI_YJIHUO == $ret) {
            $retCode = Login::RET_ERROR;
            $retInfo = '抱歉，该邮箱已存在!若您忘记密码，请找回!';
        } else {
            $retCode = Login::RET_ERROR;
            $retInfo = '抱歉, 服务器发生错误';
        }

        return json_encode(array("retCode"=>$retCode, "retInfo"=>$retInfo));
    }

    /* 邮箱验证 -- 结果 */
    public function regResult() {
        $retInfo = '激活失败，请您检查是否已过激活时间！请重新注册！';
        $userModel = new UserModel();
        $user = Request::instance()->param('u');
        $mail = Request::instance()->param('e');
        $pm = Request::instance()->param('p');

        $ret = $userModel->registerOK($mail, $user, $pm);
        if(UserModel::RET_OK == $ret) {
            $retInfo = '激活成功！感谢您的配合！祝您阅读愉快！&nbsp;&nbsp;<a href="' . Util::urlType() . Util::serverIp() . '">开始免费阅读</a>';
        }
        return $retInfo;
    }

    /* 检查是否登陆成功 */
    public function canLogin() {
        $retCode = Login::RET_ERROR;
        $retInfo = '登录错误，请您检查密码是否正确！';
        $userModel = new UserModel();
        $user = Request::instance()->param('u');
        $pwd = Request::instance()->param('p');

        $ret = $userModel->loginOK($user, $pwd);
        if(UserModel::RET_OK == $ret['retCode']) {
            $retCode = Login::RET_OK;
            $retInfo = '登陆成功！';
            Session::set('user.name', isset($ret['user'])?$ret['user']:"");
            Session::set('user.mail', $user);
        }
        return json_encode(array('retCode' => $retCode, 'retInfo' => $retInfo));
    }
}