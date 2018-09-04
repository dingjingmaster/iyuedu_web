<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/9/3
 * Time: 14:40
 */

namespace app\web\model;


class OnlineInfoModel extends ModelBase {

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
                    $tmp['id'] = $ret['_id'];
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

    /* 小说所有信息请求 */
    public function novelAllInfo($id) {
        $retInfo = array();
        $info = $this->queryById($this->cinfo, $id);
        $chapter = array();
        foreach ($info['blockId'] as $bid) {
            $ret = $this->queryById($this->cdata, $bid);
            foreach ($ret['chapterContent'] as $ik=>$iv) {
                $chapter[$ik] = "";
            }
        }
        // 用到的数据
        $retInfo['id'] = $info['_id'];
        $retInfo['name'] = $info['name'];
        $retInfo['author'] = $info['author'];
        $retInfo['status'] = $info['status'];
        $retInfo['desc'] = $info['desc'];
        $retInfo['viewcount'] = $info['viewcount'];
        $retInfo['updateTime'] = $info['updateTime'];
        $retInfo['category'] = $info['category'];
        $retInfo['imgType'] = $info['imgType'];
        $retInfo['imgCotent'] = $info['imgCotent'];
        $retInfo['chapter'] = $chapter;

        return $retInfo;
    }

    /* 小说所有信息请求 */
    public function novelAllContent($id) {
        $retInfo = array();
        $info = $this->queryById($this->cinfo, $id);
        $retInfo = $info;
        $chapter = array();
        foreach ($info['blockId'] as $bid) {
            $ret = $this->queryById($this->cdata, $bid);
            foreach ($ret['chapterContent'] as $ik=>$iv) {
                $chapter[$ik] = $iv;
            }
        }
        $retInfo['id'] = $info['_id'];
        $retInfo['chapter'] = $chapter;

        return $retInfo;
    }

    /* 首页右侧推荐 */
    public function mainRecommend(){
        $mainID = array();
        $mainInfo = array();
        $ret = $this->queryById($this->csummary, 'detail');
        if(count($ret) > 0) {
            foreach ($ret['module'] as $ik=>$iv) {
                $arr = explode('{]', $iv);
                $mainID[$ik] = array_slice($arr, 0, 20, true);
            }
        } else {
            // 错误
        }
        // 根据 ID 获取信息
        foreach ($mainID as $id=>$iv) {
            $module = array();
            foreach ($iv as $iid) {
                $ret = $this->queryById($this->cinfo, $iid);
                if (count($ret) > 0) {
                    $tmp = array();
                    $tmp['id'] = $ret['_id'];
                    $tmp['name'] = $ret['name'];
                    $tmp['author'] = $ret['author'];
                    $tmp['imgType'] = $ret['imgType'];
                    $tmp['imgCotent'] = $ret['imgCotent'];
                    $tmp['desc'] = $ret['desc'];
                    array_push($module, $tmp);
                }
            }
            $mainInfo[$id] = array_slice($module, 0, 10, true);
        }
        return $mainInfo;
    }

    /* 获取类别 */
    public function novelCategory() {
        $categorys = array();
        $ret = $this->queryByField($this->csummary, '_id', 'detail');
        if(count($ret) > 0) {
            foreach ($ret[0]['category'] as $ik=>$iv) {
                array_push($categorys, $iv);
            }
        }
        $categorys = array_unique($categorys);
        sort($categorys);
        return $categorys;
    }

    /* 根据关键词查找小说 */
    public function novelQuery($queryName){
        $novels = $this->queryByField($this->cinfo, 'name', $queryName);
        return $novels;
    }

    /* 获取某类别的小说 */
    public function getCategoryNovel($category) {
        $novels = $this->queryByField($this->cinfo, 'category', $category);
        return $novels;
    }

    private $csummary = "online_info";
    private $cinfo = 'online_index';
    private $cdata = 'online_data';
}