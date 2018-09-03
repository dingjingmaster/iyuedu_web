<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/9/3
 * Time: 14:30
 */

namespace app\common;


class Utils {
    public static function serverIp() {
        $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ?
            $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
        return $host;
    }
    public static function urlType () {
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        return $http_type;
    }
    public static function timeStr($time) {
        $year = substr($time, 0, 4);
        $month = substr($time, 4, 2);
        $day = substr($time, 6, 2);
        return $year . '-' . $month . '-' .$day;
    }
    /* 0与正整数下限 */
    public static function integerFloor($int) {
        return $int < 0 ? 0 : $int;
    }
    /* 分页功能 */
    /**
     *  @$curPage:          当前页数
     *  @$totalNum:         总条数
     *  @$showPage:         一次显示页数
     *  @$everyPageNum:     每页展示条数
     */
    public static function pageSplit($url, $category, $curPage, $totalNum, $showPage, $everyPageNum) {
        $html = '<ul style="margin: 0 auto;">';
        $totalPage = ceil($totalNum / $everyPageNum);                       // 总页数
        /* 当前页数格式化 */
        if($curPage <= 1 || $curPage == '') {
            $curPage = 1;
        } else if ($curPage >= $totalPage) {
            $curPage = $totalPage;
        }
        $html .= '<li class="page_turn"><a href="' . $url . '/' . $category . '/cur/0/">首页</a></li>';
        $prePage = ($curPage <= 1) ? 1 : $curPage - 1;                              // 前一页
        $nextPage = ($curPage >= $totalPage) ? $totalPage : $curPage + 1;           // 后一页
        $html .= '<li class="page_turn "><a href="' . $url . '/' . $category . '/cur/' . $prePage . '">上一页</a></li>';                  // 前一页展示
        /* 展示显示分页 */
        $ps = floor($showPage / 2);
        $pt = $curPage - $ps;
        $pageShowStart = $pt > 0 ? $pt : 1;
        $pageShowEnd = ($pageShowStart + $showPage - 1) >= $totalPage ? $totalPage : $pageShowStart + $showPage - 1;
        $pageShowStart = $pageShowEnd == $totalPage ? $pageShowEnd - $showPage + 1 : $pageShowStart;
        $pageShowStart = $pageShowStart <= 0 ? 1 : $pageShowStart;
        /* 开始准备输出页数 */
        for($i = $pageShowStart; $i <= $pageShowEnd; ++$i) {
            if($curPage == $i) {
                $html .= '<li class="page_turn"><a style="color: #9400D3" href="' . $url . '/' . $category . '/cur/' . $i . '">'  . $i . '</a></li>';
            } else {
                $html .= '<li class="page_turn"><a href="' . $url . '/' . $category . '/cur/' . $i . '">'  . $i . '</a></li>';
            }
        }
        $html .= '<li class="page_turn"><a href="' . $url . '/' . $category . '/cur/' . $nextPage . '">下一页</a></li>';
        $html .= '<li class="page_turn"><a href="' . $url . '/' . $category . '/cur/' . $totalPage . '">末页</a></li>';
        $html .= '<li class="page_turn"><a>第' . $curPage . '/' . $totalPage . '页</a></li>';
        $html .= '<li class="page_turn"><a>共计' . $totalNum . '行数据</a></li>';
        $html .= '</ul>';
        return $html;
    }
}