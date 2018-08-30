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
use think\Session;

class Detail extends Controller {
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
        $chapter = MainShow::chapterShow($novelInfo['chapter']);
        $totalNum = count($chapter);
        $curItem = ($curPage - 1) * $this->everyPage;
        $curItem = Util::integerFloor($curItem);
        $chapter = array_slice($chapter, $curItem, $this->everyPage);

        $response = [
            'host'              =>      Util::urlType() . Util::serverIp(),
            'id'                =>      $novelInfo['_id'],
            'name'              =>      $novelInfo['name'],
            'author'            =>      $novelInfo['author'],
            'category'          =>      $novelInfo['category'],
            'status'            =>      $novelInfo['status'],
            'view'              =>      $novelInfo['viewcount'],
            'showLogged'        =>      $showLogged,
            'showLog'           =>      $showLog,
            'userName'          =>      $userName,
            'update'            =>      Util::timeStr($novelInfo['updateTime']),
            'desc'              =>      $novelInfo['desc'],
            'img'               =>      'data:image/' . $novelInfo['imgType'] . ';base64,' . $novelInfo['imgCotent'],
            'chapter'           =>      $chapter,
            'pageSplit'         =>      Util::pageSplit($this->baseUrl, $novelID, $curPage, $totalNum, $this->showPage, $this->everyPage),
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/detail.html');
    }
    /* 参数设置 */
    private $baseUrl = '/novel/detail/novel/id';
    private $everyPage = 20;            // 每页展示条数
    private $showPage = 5;              // 显示页数
}