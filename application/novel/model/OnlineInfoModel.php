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
use MongoDB\Driver\ReadPreference;
use think\Db;
use think\Model;

class OnlineInfoModel extends Model{
    private $mongoIP = '127.0.0.1';
    private $mongoPort = 27017;
    private $dbname = 'novel_online';
    private $csummary = "online_info";
    private $cinfo = 'online_index';
    private $cdata = 'online_data';

    public function novelModule() {
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

//        print_r($retInfo);
        return $retInfo;
    }
}