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

    public static function searchShow($novel) {
        $html = '<table width="100%">';
        $html .= '<tr><th align="left">封面</th><th align="left">书名</th><th align="left">作者名</th><th align="left">类别</th><th align="left">状态</th><th align="left">阅读量</th><th align="left">最后更新</th></tr><br/>';
        foreach ($novel as $n) {
            $html .= '<tr>';
            $html .= '<td>' . '<a href="/web/detail/novel/id/' . $n['_id'] . '"><img width="80px" height="96px" src="data:image/' . $n["imgType"] . ';base64,' . $n['imgCotent'] . '"/></a></td>';
            $html .= '<td>' . '<a href="/web/detail/novel/id/' . $n['_id'] . '"><p>' . $n['name'] . '</p></a></td>';
            $html .= '<td>' . '<p>' . $n['author'] . '</p></td>';
            $html .= '<td>' . '<p>' . $n['category'] . '</p></td>';
            $html .= '<td>' . '<p>' . $n['status'] . '</p></td>';
            $html .= '<td>' . '<p>' . $n['viewcount'] . '</p></td>';
            $html .= '<td>' . '<p>' . Utils::timeStr($n['updateTime']) . '</p></td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        return $html;
    }




}