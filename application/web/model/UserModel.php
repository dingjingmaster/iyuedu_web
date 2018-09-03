<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/8/26
 * Time: 10:36
 */

namespace app\novel\model;
use MongoDB\Driver\WriteConcern;
use think\Model;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\ReadPreference;

class UserModel extends Model {
    private $mongoIP = '127.0.0.1';
    private $mongoPort = 1888;
    private $dbname = 'novel_online';
    private $userInfo = "user_info";
    private $bookShelfMax = 1000;               // 书架最多

    const RET_ERROR_NOID = -3;                  // 不存在，请重新注册
    const RET_ERROR_CUNZAI_YJIHUO = -2;         // 存在已激活
    const RET_ERROR_OTHER = -1;                 // 其他错误
    const RET_OK = 0;                           // 成功

    /**
     * 字段:
     * uid : 邮箱字符串(string)
     * user: 用户名(string)
     * passwd: 密码(string)
     * itime : 注册时间int
     * utime : 最近登录时间int
     * bn : 目前书架长度(int)
     * bs : 书架(array)(书名: 阅读到章节 + "{]" + 时间) 要根据时间排序(key 时 分 秒 )
     */
    /* 注册数据 -- 检查id是否存在 是否注册成功 */
    public function register($mail, $user, $passwd) {
        $retCode = UserModel::RET_ERROR_OTHER;
        if ("" == $mail || "" == $user || "" == $passwd) {
            return $retCode;
        }
        $doc = [
            '_id'                   => $mail,
            'user'                  => $user,
            'passwd'                => $passwd,
            'itime'                 => time(),
            'utime'                 => time(),
            'bn'                    => $this->bookShelfMax,
            'bs'                    => array(),
        ];
        try {
            $options = array();
            $filter = Array('_id'=> $mail);
            $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
            $query = new Query($filter, $options);
            $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);
            $res = $mongo->executeQuery($this->dbname . '.' . $this->userInfo, $query, $readPreference)->toArray();
            if (0 == count($res)) {
                $write = new BulkWrite(['ordered' => true]);
                $write->insert($doc);
                $ret = $mongo->executeBulkWrite($this->dbname . '.' . $this->userInfo, $write, new WriteConcern(WriteConcern::MAJORITY, 100));
                if (!$ret->getWriteConcernError()) {
                    $retCode = UserModel::RET_OK;
                }
            } else {
                $retCode = UserModel::RET_ERROR_CUNZAI_YJIHUO;
            }
        } catch (\Exception $e) {
        }
        return $retCode;
    }

    /* 验证注册是否成功  -- 邮箱是否存在 验证码是否正确 */
//    public function registerOK($mail, $user, $pm) {
//    $retCode = UserModel::RET_ERROR_OTHER;
//    $options = array();
//    $filter = Array('_id'=> $mail);
//    $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
//    $query = new Query($filter, $options);
//    $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);
//    $res = $mongo->executeQuery($this->dbname . '.' . $this->userInfo, $query, $readPreference)->toArray();
//    if(count($res) >= 1) {
//        if(($user == $res[0]->user) && ($pm == $res[0]->pm)) {
//            // 存在,修改字段
//            $doc = [
//                '_id'                   => $mail,
//                'user'                  => $user,
//                'passwd'                => $res[0]->passwd,
//                'pm'                    => $pm,
//                'itime'                 => time(),
//                'utime'                 => time(),
//                'yok'                   => 1,
//                'bn'                    => $this->bookShelfMax,
//                'bs'                    => array(),
//            ];
//            $write = new BulkWrite(['ordered' => true]);
//            $write->update(array('_id'=>$mail), $doc);
//            $ret = $mongo->executeBulkWrite($this->dbname . '.' . $this->userInfo, $write, new WriteConcern(WriteConcern::MAJORITY, 100));
//            if (!$ret->getWriteConcernError()) {
//                $retCode = UserModel::RET_OK;
//            }
//        }
//    } else {
//        // 不存在
//        $retCode = UserModel::RET_ERROR_NOID;
//    }
//
//    return $retCode;
//}

    /* 是否登录成功 */
    public function loginOK($mail, $pwd) {
        $ret = array();
        $ret['retCode'] = UserModel::RET_ERROR_OTHER;
        $options = array();
        $filter = Array('_id'=> $mail);
        $mongo = new Manager('mongodb://' . $this->mongoIP . ':' . $this->mongoPort);
        $query = new Query($filter, $options);
        $readPreference = new ReadPreference(ReadPreference::RP_PRIMARY);
        $res = $mongo->executeQuery($this->dbname . '.' . $this->userInfo, $query, $readPreference)->toArray();
        if(count($res) >= 1) {
            if ($pwd == $res[0]->passwd) {
                $ret['retCode'] = UserModel::RET_OK;
                $ret['user'] = $res[0]->user;
            }
        } else {
            $ret['retCode'] = UserModel::RET_ERROR_NOID;
        }
        return $ret;
    }

    /* 查询书架 -- 按时间分段 */

    /* 加入书架 */

    /* 移除书架 */

    /* 修改密码 -- 通过邮箱验证修改 */

}