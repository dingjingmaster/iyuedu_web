<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/8/22
 * Time: 14:38
 */

namespace app\novel\controller;
use  think\Request;
use \think\Controller;
use app\common\Util;
use app\common\MainShow;
use app\novel\model\OnlineInfoModel;

class Detail extends Controller {
    public function novel() {
        $novelID = Request::instance()->param('id');
        $novelModel = new OnlineInfoModel();
        $novelInfo = $novelModel->novelAllInfo($novelID);

        /* 设置默认值 */
        if('' == $novelInfo['desc']) {
            $novelInfo['desc'] = '暂无';
        }

        /* 处理章节 */
        $chapter = MainShow::chapterShow($novelInfo['chapter']);

        $response = [
            /* host */
            'host'              =>      Util::urlType() . Util::serverIp(),
            'name'              =>      $novelInfo['name'],
            'author'            =>      $novelInfo['author'],
            'category'          =>      $novelInfo['category'],
            'status'            =>      $novelInfo['status'],
            'view'              =>      $novelInfo['viewcount'],
            'update'              =>    Util::timeStr($novelInfo['updateTime']),
            'desc'              =>      $novelInfo['desc'],
            'img'               =>      'data:image/' . $novelInfo['imgType'] . ';base64,' . $novelInfo['imgCotent'],
            'chapter'           =>      $chapter,
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/detail.html');
    }
}