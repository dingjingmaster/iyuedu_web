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

class Content extends ControllerBase {
    public function content() {
        $showLog = Session::has('user')?'i_hidden':'i_show';
        $showLogged = Session::has('user')?'i_show':'i_hidden';
        $userName = Session::has('user')?Session::get('user.name'):'';
        $novelID = Request::instance()->param('id');
        $chapterNum = Request::instance()->param('num');
        $chapterName = Request::instance()->param('name');

        $novelModel = new OnlineInfoModel();
        $novelInfo = $novelModel->novelAllContent($novelID);

        /* 处理正文 */
        $contenr = '';
        $tmp = '';
        foreach (str_split($novelInfo['chapter'][$chapterNum . '{]' . $chapterName]) as $c) {
            if("\n" == $c) {
                $contenr .= '<p>' . $tmp . '</p><br>';
                $tmp = '';
            }
            $tmp .= $c;
        }
        $contenr .= '<p>' . $tmp . '</p><br>';


        /* 获取 前一章 和 后一章 */
        $cbk = '';
        $cnk = '';
        $cbn = '';
        $cnn = '';
        $cb = '';
        $cn = '';
        $chapterKeys = Utils::chapterSort($novelInfo['chapter']);
        $cck = array_keys($chapterKeys, $chapterName)[0];
        $cbk = array_key_exists($cck - 1, $chapterKeys)?$cck-1:'';
        $cnk = array_key_exists($cck + 1,$chapterKeys)?$cck+1:'';
        $cbn = ('' != $cbk)?$chapterKeys[$cbk]:'';
        $cnn = ('' != $cnk)?$chapterKeys[$cnk]:'';
        $cb = ('' != $cbk) ? '/web/content/content/id/' . $novelID .'/num/'. $cbk . '/name/' . $cbn:'#';
        $cn = ('' != $cnk) ? '/web/content/content/id/' . $novelID .'/num/'. $cnk . '/name/' . $cnn:'#';

        /* 输出 */
        $view = new View();
        $view->host = Utils::urlType() . Utils::serverIp();                                         /* url */
        $view->showLog = Session::has('user')?'i_hidden':'i_show';                          /* 未登录展示 */
        $view->showLogged = Session::has('user')?'i_show':'i_hidden';                       /* 登陆展示 */
        $view->userName = Session::has('user')?Session::get('user.name'):'';        /*  用户名展示 */
        $view->chapter = $chapterName;
        $view->content = $contenr;
        $view->pageTurn = '<a href="' . $cb . '">上一章</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/">首页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/web/detail/novel/id/'. $novelID .'">目录页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . $cn . '">下一章</a>';

        $ret = $view->fetch('web@index/content');

        return $ret;
    }

}