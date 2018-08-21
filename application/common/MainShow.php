<?php
namespace app\common;
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/8/17
 * Time: 11:23
 */

class MainShow {
    public static function showMainModule($info, $infoArray) {
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

    public static function showMainRank($info, $infoArray) {
        $ret = array();
        $num = 0;
        foreach ($info as $ik => $iv) {
            /* 判断模块名是否存在 */
            if (!isset(self::$nameMap[$ik])) {
                continue;
            }
            foreach ($iv as $id) {
                $value = $infoArray[$id];
                if(count($value) <= 0) {
                    continue;
                }
                $sample['sample'] = true;
                $sample['detail'] = false;
                $infoTmp = array();
                $infoTmp['id'] = $id;
                $infoTmp['num'] = ++ $num;
                $infoTmp['name'] = $value['name'];
                $infoTmp['author'] = $value['author'];
                $infoTmp['imgSrc'] = 'data:image/' . $value['imgType'] . ';base64,' . $value['imgCotent'];
                $infoTmp['show'] = $sample;

                array_push($ret, $infoTmp);
            }
        }

        return $ret;


            /*
            $html = '';
            foreach ($iv as $id) {
                $value = $infoArray[$id];
                if(count($value) <= 0) {
                    continue;
                }
                $html .= '<li class="i_list_item">';
                if ($first) {
                    $html .= '<div class="i_sample" style="display:none;">';
                } else {
                    $html .= '<div class="i_sample">';
                }
                $html .= '<span class="i_num">' . ++$num . '.</span>';
                $html .= '<span class="i_name">' . $value['name'] . '</span>';
                $html .= '<p class="i_author">' . $value['author'] . '</p>';
                $html .= '</div>';
                if ($first) {
                    $html .= '<div class="i_detail" style="display:block;">';
                }else {
                    $html .= '<div class="i_detail">';
                }
                $html .= '<span class="i_num">' . $num . '.</span>';
                $html .= '<a href="#">';
                $html .= '<img style="width:100px; height=133px;" src="data:image/' . $value['imgType'] . ';base64,' . $value['imgCotent'] . '"/>';
                $html .= '</a>';
                $html .= '<div class="detail">';
                $html .= '<a href="#">';
                $html .= '<p class="i_detail_name">' . $value['name'] . '</p>';
                $html .= '</a>';
                $html .= '<p class="i_detail_author">' . $value['author'] . '</p>';
                $html .= '</div></div><div class="i_clear"></div></li>';
                $first = false;
            }
            $ret[$ik] = $html;
        }
        */
    }

    private static $nameMap = Array(
        'module_zbtj' => '重磅推荐',
        'module_ysxs' => '影视小说',
        'module_qcwx' => '青春文学',
        'module_yqxs' => '言情小说',
        'module_jdwx' => '经典文学',
        'module_lzwx' => '励志文学',
        'rank_wj' => '完结榜',
        'rank_rq' => '人气榜',
    );
}