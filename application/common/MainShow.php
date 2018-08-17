<?php
namespace app\common;
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/8/17
 * Time: 11:23
 */

class MainShow {
    public static function showMain($info, $infoArray) {
        $ret = array();
        foreach ($info as $ik => $iv) {
            if (!isset(self::$nameMap[$ik])) {
                continue;
            }
            $html = '';
            if ('module_zbtj' == $ik) {
                $html .= '<div id="i_rec1" class="i_rec_1"><h3 class="i_rec1_title">' . self::$nameMap[$ik] . '</h3><div class="i_rec1_content"><ul class="i_rec1_list">';
                foreach ($iv as $id) {
                    $value = $infoArray[$id];
                    if (count($value) <= 0) {
                        continue;
                    }
                    $html .= '<li class="i_rec1_item"><a href=""><img width="150px" height="200px" src="data:image/' . $value['imgType'] . ';base64,' . $value['imgCotent'] .  '"/></a>';
                    $html .= '<div class="i_rec_info"><a href=""><p class="i_rec_name">' . $value['name'] . '</p></a>';
                    $html .= '<p class="i_rec_author">' . $value['author'] . '</p>';
                    $html .= '<p class="i_rec_desc">' .$value['desc'] . '</p>';
                    $html .= '</div></li>';
                }
                $html .= '</ul></div></div>';
            } else {
                $html .= '<div class="i_rec_2"><h3 class="i_rec2_title">' . self::$nameMap[$ik] . '</h3><ul class="i_rec2_list">';
                foreach ($iv as $id) {
                    $value = $infoArray[$id];
                    if(count($value) <= 0) {
                        continue;
                    }
                    $html .= '<li class="i_rec2_item"><a href=""><img width="120px" height="160px" src="data:image/' . $value['imgType'] . ';base64,' . $value['imgCotent'] . '"/></a>';
                    $html .= '<a href="">' . '<p class="i_rec2_name">' . $value['name'] . '</p></a>';
                    $html .= '<p class="i_rec2_author">' . $value['author'] . '</p></li>';
                }
                $html .= '</ul></div>';
            }
            $ret[$ik] = $html;
        }

        return $ret;
    }

    private static $nameMap = Array(
        'module_zbtj' => '重磅推荐',
        'module_ysxs' => '影视小说',
        'module_qcwx' => '青春文学',
        'module_yqxs' => '言情小说',
        'module_jdwx' => '经典文学',
        'module_lzwx' => '励志文学',
    );
}