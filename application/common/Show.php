<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/9/4
 * Time: 8:17
 */

namespace app\common;


class Show {
    /* 章节分成两份 并分页 */
    public static function chapterSplit($chapter){
        $c = array();
        $c1 = array();
        $c2 = array();
        $num = 0;
        $flag = true;
        foreach ($chapter as $ik=>$iv) {
            $tmp = array();
            $tmp[$ik] = $iv;
            if(++$num % 2 == 1) {
                $flag = true;
                array_push($c1, $tmp);
            } else if($num % 2 == 0){
                $flag = false;
                array_push($c2, $tmp);
            }
        }
        /* 分两列 */
        $cn1 = count($c1);
        $cn2 = count($c2);
        $min = $cn1>$cn2?$cn2:$cn1;
        for($i = 0; $i < $min; ++ $i) {
            $tt = array();
            array_push($tt, $c1[$i]);
            array_push($tt, $c2[$i]);
            array_push($c, $tt);
        }
        /* 最后一个特殊元素 */
        if($flag) {
            $tt = array();
            array_push($tt, $c1[$min]);
            array_push($c, $tt);
        }
        return $c;
    }


}