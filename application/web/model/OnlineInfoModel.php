<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/9/3
 * Time: 14:40
 */

namespace app\web\model;


class OnlineInfoModel extends ModelBase {
    private $csummary = "online_info";
    private $cinfo = 'online_index';
    private $cdata = 'online_data';

    /* 首页排行榜 默认最多20条 */
    public function mainRank($moduleName) {
        $rankID = array();
        $rankInfo = array();
        $ret = $this->queryById($this->csummary, 'detail');
        if(count($ret) > 0) {
            foreach ($ret['mainRank'] as $ik=>$iv) {
                if($moduleName == $ik) {
                    $arr = explode('{]', $iv);
                    $rankID[$ik] = array_slice($arr, 0, 20, true);
                }
            }
        } else {
            // 错误
        }
        // 根据 ID 获取信息
        $num = 0;
        foreach ($rankID as $id=>$iv) {
            foreach ($iv as $iid) {
                $ret = $this->queryById($this->cinfo, $iid);
                if (count($ret) > 0) {
                    $tmp = array();
                    $tmp['num'] = ++ $num;
                    $tmp['name'] = $ret['name'];
                    $tmp['author'] = $ret['author'];
                    $tmp['imgType'] = $ret['imgType'];
                    $tmp['imgCotent'] = $ret['imgCotent'];

                    array_push($rankInfo, $tmp);
                }
            }
        }
        return $rankInfo;
    }
}