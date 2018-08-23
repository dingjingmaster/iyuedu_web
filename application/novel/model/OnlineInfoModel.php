<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/8/17
 * Time: 11:45
 */
namespace app\novel\model;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\BSON\Regex;
use MongoDB\Driver\ReadPreference;
use think\Model;

class OnlineInfoModel extends Model{
    private $mongoIP = '127.0.0.1';
    private $mongoPort = 27017;
    private $dbname = 'novel_online';
    private $csummary = "online_info";
    private $cinfo = 'online_index';
    private $cdata = 'online_data';

    /* 首页模块，每个人模块最多取  10  条 */
    public function mainModule() {
        $retModule = array();

        $options = array();
        $filter = Array('_id' => 'detail');
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);
        $res = $mongo->executeQuery($this->dbname . '.' . $this->csummary, $query, $readPreference);
        foreach ($res as $i) {
            foreach ($i ->module as $k => $v) {
                $arr = explode('{]', $v);
                $retModule[$k] = array_slice($arr, 0, 10, true);
            }
        }

        return $retModule;
    }

    /* 首页排行榜  默认最多取  20  条 */
    public function mainRank($name) {
        $retModule = array();

        $options = array();
        $filter = Array('_id' => 'detail');
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);
        $res = $mongo->executeQuery($this->dbname . '.' . $this->csummary, $query, $readPreference);
        foreach ($res as $i) {
            foreach ($i ->mainRank as $k => $v) {
                if ($name == $k) {
                    $arr = explode('{]', $v);
                    $retModule[$k] = array_slice($arr, 0, 20, true);
                }
            }
        }

        return $retModule;
    }

    public function novelInfo($id) {
        $retInfo = array();
        $options = array();
        $filter = Array('_id' => $id);
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);
        $res = $mongo->executeQuery($this->dbname . '.' . $this->cinfo, $query, $readPreference);
        foreach ($res as $i) {
            foreach ($i as $ik=>$iv) {
                $retInfo[$ik] = $iv;
            }
        }

        return $retInfo;
    }

    // 包含章节信息的 小说信息
    public function novelAllInfo($id) {
        $novelInfo = array();
        $options = array();
        $filter = Array('_id' => $id);
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);

        $res = $mongo->executeQuery($this->dbname . '.' . $this->cinfo, $query, $readPreference);
        foreach ($res as $i) {
            foreach ($i as $ik=>$iv) {
                $novelInfo[$ik] = $iv;
            }
        }
        $bids = $novelInfo['blockId'];
        $chapters = array();
        foreach($bids as $bid) {
            $filter = Array('_id' => $bid);
            $query = new Query($filter, $options);
            $res = $mongo->executeQuery($this->dbname . '.' . $this->cdata, $query, $readPreference);
            foreach ($res as $i) {
                foreach ($i as $ik=>$iv) {
                    if('chapterContent' == $ik) {
                        foreach ($iv as $iik=>$iiv) {
                            array_push($chapters, $iik);
                        }
                    }
                }
            }
        }
        $novelInfo['chapter'] = $chapters;

        return $novelInfo;
    }

    // 查找小说内容
    public function novelChapter($id, $chapter) {
        $novelInfo = array();
        $options = array();
        $filter = Array('_id' => $id);
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);

        $res = $mongo->executeQuery($this->dbname . '.' . $this->cinfo, $query, $readPreference);
        foreach ($res as $i) {
            foreach ($i as $ik=>$iv) {
                if($ik == 'blockId') {
                    $novelInfo[$ik] = $iv;
                    break;
                }
            }
        }
        $bids = $novelInfo['blockId'];
        $chapters = array();
        foreach($bids as $bid) {
            $filter = Array('_id' => $bid);
            $query = new Query($filter, $options);
            $res = $mongo->executeQuery($this->dbname . '.' . $this->cdata, $query, $readPreference);
            foreach ($res as $i) {
                foreach ($i as $ik=>$iv) {
                    if('chapterContent' == $ik) {
                        foreach ($iv as $iik=>$iiv) {
                            $chapters[$iik] = $iiv;
                        }
                    }
                }
            }
        }
        return $chapters[$chapter];
    }

    /* 根据关键词查找小说 */
    public function novelQuery($queryName){
        $novels = array();
        $options = array();
        $filter = Array('name' => new Regex($queryName));
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);

        $res = $mongo->executeQuery($this->dbname . '.' . $this->cinfo, $query, $readPreference);
        foreach ($res as $i) {
            $novelInfo = array();
            foreach ($i as $ik=>$iv) {
                $novelInfo[$ik] = $iv;
            }
            if(count($novelInfo) > 0) {
                array_push($novels, $novelInfo);
            }
        }

        return $novels;
    }

    /* 小说分类 */
    public function novelCategory() {
        $categorys = array();
        $options = array();
        $filter = Array('_id' => 'detail');
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);
        $res = $mongo->executeQuery($this->dbname . '.' . $this->csummary, $query, $readPreference);
        foreach ($res as $i) {
            foreach ($i ->category as $k => $v) {
                array_push($categorys, $v);
            }
        }
        $categorys = array_unique($categorys);
        sort($categorys);
        return $categorys;
    }

    /* 获取某类别的小说 */
    public function getCategoryNovel($category) {
        $retInfo = array();
        $options = array();
        $filter = Array('category' => $category);
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);
        $res = $mongo->executeQuery($this->dbname . '.' . $this->cinfo, $query, $readPreference);
        foreach ($res as $i) {
            $novelInfo = array();
            foreach ($i as $ik=>$iv) {
                $novelInfo[$ik] = $iv;
            }
            if(count($novelInfo) > 0) {
                array_push($retInfo, $novelInfo);
            }
        }
        return $retInfo;
    }
}