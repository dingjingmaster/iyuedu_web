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
                    $html .= '<li class="i_rec1_item"><a href="/novel/detail/novel/id/' . $id . '"><img width="150px" height="200px" src="data:image/' . $value['imgType'] . ';base64,' . $value['imgCotent'] .  '"/></a>';
                    $html .= '<div class="i_rec_info"><a href="/novel/detail/novel/id/' . $id . '"><p class="i_rec_name">' . $value['name'] . '</p></a>';
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
                    $html .= '<li class="i_rec2_item"><a href="/novel/detail/novel/id/' . $id . '"><img width="120px" height="160px" src="data:image/' . $value['imgType'] . ';base64,' . $value['imgCotent'] . '"/></a>';
                    $html .= '<a href="/novel/detail/novel/id/' . $id . '">' . '<p class="i_rec2_name">' . $value['name'] . '</p></a>';
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
                $infoTmp['url'] = '/novel/detail/novel/id/' . $id;
                $infoTmp['imgSrc'] = 'data:image/' . $value['imgType'] . ';base64,' . $value['imgCotent'];
                $infoTmp['show'] = $sample;

                array_push($ret, $infoTmp);
            }
        }

        return $ret;
    }

    public static function chapterShow($chapters) {
        $retArr = array();
        $allChap = array();
        foreach ($chapters as $ik=>$iv) {
            $arr = explode('{]', $iv);
            $allChap[$arr[0]] = $arr[1];
        }
        /* 整理得到正确的顺序 */
        ksort($allChap);
        $ouArr = array();
        $jiArr = array();
        foreach ($allChap as $ik=>$iv) {
            if ($ik % 2 == 0) {
                $ououArr = array();
                array_push($ououArr, $ik);
                array_push($ououArr, $iv);
                array_push($ouArr, $ououArr);
            } else {
                $jijiArr = array();
                array_push($jijiArr, $ik);
                array_push($jijiArr, $iv);
                array_push($jiArr, $jijiArr);
            }
        }
        /* 重新整理 */
        $min = 0;
        if(count($ouArr) > count($jiArr)) {
            $min = count($jiArr);
        } else {
            $min = count($ouArr);
        }
        for($i = 0; $i < $min; ++$i) {
            $tt = array();
            array_push($tt, $ouArr[$i]);
            array_push($tt, $jiArr[$i]);
            array_push($retArr, $tt);
        }
        // 最后一个特殊元素
        if(count($ouArr) > $min) {
            $tt = array();
            array_push($tt, $ouArr[$i]);
            array_push($retArr, $tt);
        } else if (count($jiArr) > $min) {
            $tt = array();
            array_push($tt, $jiArr[$i]);
            array_push($retArr, $tt);
        }

        return $retArr;
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