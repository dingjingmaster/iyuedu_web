<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/8/22
 * Time: 22:13
 */

namespace app\novel\controller;
use  think\Request;
use \think\Controller;
use app\common\Util;
use app\common\MainShow;
use app\novel\model\OnlineInfoModel;

class Content extends Controller {
    public function content () {
        $novelID = Request::instance()->param('id');
        $c1 = Request::instance()->param('c1');
        $c2 = Request::instance()->param('c2');
        $novelModel = new OnlineInfoModel();
        $chapter = $novelModel->novelChapter($novelID, $c2 . '{]' . $c1);
        $content = MainShow::contentShow($chapter);

        $response = [
            /* host */
            'host'              =>      Util::urlType() . Util::serverIp(),
            'chapter'           =>      $c1,
            'content'           =>      $content,
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/content.html');
    }
}