<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/9/3
 * Time: 10:49
 */

namespace app\web\model;

use think\Model;
use MongoDB\BSON\Regex;
use MongoDB\Driver\Query;
use MongoDB\Driver\Manager;
use MongoDB\Driver\ReadPreference;

class ModelBase extends Model {
    private $mongoIP = '127.0.0.1';
    private $mongoPort = 1888; //27017;
    private $dbname = 'novel_online';

    public function __construct($data = []) {
        parent::__construct($data);
    }

    public function queryById($collection, $id) {
        $ret = array();
        $options = array();
        $filter = Array('_id' => $id);
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);
        $res = $mongo->executeQuery($this->dbname . '.' . $collection, $query, $readPreference)->toArray();
        foreach ($res as $i) {
            foreach ($i as $k=>$iv) {
                $ret[$k] = $iv;
            }
        }
        return $ret;
    }

    public function queryByField($collection, $field, $value) {
        $novels = array();
        $options = array();
        $filter = Array($field => new Regex($value));
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);
        $res = $mongo->executeQuery($this->dbname . '.' . $collection, $query, $readPreference)->toArray();
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






    public function __destruct() {
        // TODO: Implement __destruct() method.
    }
}