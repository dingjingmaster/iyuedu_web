<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/8/23
 * Time: 10:28
 */

namespace app\novel\controller;
use  think\Request;
use \think\Controller;
use app\common\Util;
use app\common\MainShow;
use app\novel\model\OnlineInfoModel;

class Search extends Controller {
    public function book() {
        /* 查找名字 */
        $queryName = Request::instance()->param('query');
        $curPage = Request::instance()->param('cur');
        $novelModel = new OnlineInfoModel();
        $novel = $novelModel->novelQuery($queryName);
        $html = '';
        $pageSplit = '';

        if('' == $curPage || NULL == $curPage) {
            $curPage = 1;
        }

        $totalNum = count($novel);
        $curItem = ($curPage - 1) * $this->everyPage;
        $curItem = Util::integerFloor($curItem);
        $novel = array_slice($novel, $curItem, $this->everyPage);

        if(count($novel) <= 0) {
            $html .= '<p align="center"> sorry!!! 没有找到您的书籍，我们会尽快对书籍进行补充。</p>';
        } else {
            $html .= MainShow::searchShow($novel);
            $pageSplit = Util::pageSplit($this->baseUrl, $queryName, $curPage, $totalNum, $this->showPage, $this->everyPage);
        }

        $response = [
            /* host */
            'host'              =>      Util::urlType() . Util::serverIp(),
            'searchResult'      =>      $html,
            'pageSplit'         =>      $pageSplit,
        ];
        $this->assign($response);
        return $this->fetch(ROOT_PATH . '/application/novel/view/search.html');
    }

    private $baseUrl = '/novel/search/book/query/';
    private $everyPage = 20;            // 每页展示条数
    private $showPage = 5;              // 显示页数

}