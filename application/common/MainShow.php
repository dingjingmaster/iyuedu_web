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
                    $html .= '<div class="i_rec_info"><a href="/novel/detail/novel/id/' . $id . '"><h3 class="i_rec_name">' . $value['name'] . '</h3></a>';
                    $html .= '<small class="i_rec_author">' . $value['author'] . '</small>';
                    $html .= '<small class="i_rec_desc">' .$value['desc'] . '</small>';
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
                    $html .= '<a href="/novel/detail/novel/id/' . $id . '">' . '<h5 class="i_rec2_name">' . $value['name'] . '</h5></a>';
                    $html .= '<small class="i_rec2_author">' . $value['author'] . '</small></li>';
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
        /*  */
        $tmpArr = array();
        foreach ($allChap as $ik=>$iv) {
            array_push($tmpArr, $ik . '{]' . $iv);
        }

        $flag = true;
        $oneArr = array();
        $twoArr = array();
        for($i = 0; $i < count($tmpArr); ++$i) {
            if($flag) {
                $ttArr = array();
                $arr = explode('{]', $tmpArr[$i]);
                $ttArr[0] = $arr[0];
                $ttArr[1] = $arr[1];
                array_push($oneArr, $ttArr);
                if($i + 1 < count($tmpArr)) {
                    $arr = explode('{]', $tmpArr[$i + 1]);
                    $ttArr[0] = $arr[0];
                    $ttArr[1] = $arr[1];
                    array_push($twoArr, $ttArr);
                }
                $flag = false;
                continue;
            }
            $flag = true;
        }

        /* 重新整理 */
        $min = 0;
        if(count($oneArr) >= count($twoArr)) {
            $min = count($twoArr);
        } else {
            $min = count($oneArr);
        }
        for($i = 0; $i < $min; ++$i) {
            $tt = array();
            array_push($tt, $oneArr[$i]);
            array_push($tt, $twoArr[$i]);
            array_push($retArr, $tt);
        }
        // 最后一个特殊元素
        if(count($oneArr) > $min) {
            $tt = array();
            array_push($tt, $oneArr[$i]);
            array_push($retArr, $tt);
        } else if (count($twoArr) > $min) {
            $tt = array();
            array_push($tt, $twoArr[$i]);
            array_push($retArr, $tt);
        }

        return $retArr;
    }

    public static function contentShow($id, $content) {
        // 处理内容展示
        $retArr = array();
        $str = '';
        foreach (str_split($content['content']) as $ik=>$iv) {
            if("\n" == $iv) {
                array_push($retArr, $str);
                $str = '';
            }
            $str .= $iv;
        }
        $str = '';
        foreach ($retArr as $ik=>$iv) {
            $str .= '<p>' . $iv . '</p><br>';
        }
        $str .= '<hr/><div align="center">';
        if('' != $content['beforeKey']) {
            $arr = explode('{]', $content['beforeKey']);
            $str .= '<a href="/novel/content/content/id/' . $id . '/c1/' . $arr[1] . '/c2/' . $arr[0] . '/">上一章</a>';
        } else {
            $str .= '<a href="#">上一章</a>';
        }
        // 首页
        $str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/">首页</a>';
        // 目录页
        $str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://enjoyread.top/novel/detail/novel/id/' . $id . '">目录页</a>';

        if('' != $content['afterKey']) {
            $arr = explode('{]', $content['afterKey']);
            $str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/novel/content/content/id/' . $id . '/c1/' . $arr[1] . '/c2/' . $arr[0] . '/">下一章</a>';
        } else {
            $str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">下一章</a>';
        }
        $str .= '</div>';

        return $str;
    }

    public static function searchShow($novel) {
        $html = '<table width="100%">';
        $html .= '<tr><th align="left">封面</th><th align="left">书名</th><th align="left">作者名</th><th align="left">类别</th><th align="left">状态</th><th align="left">阅读量</th><th align="left">最后更新</th></tr><br/>';
        foreach ($novel as $n) {
            $html .= '<tr>';
            $html .= '<td>' . '<a href="/novel/detail/novel/id/' . $n['_id'] . '"><img width="80px" height="96px" src="data:image/' . $n["imgType"] . ';base64,' . $n['imgCotent'] . '"/></a></td>';
            $html .= '<td>' . '<a href="/novel/detail/novel/id/' . $n['_id'] . '"><p>' . $n['name'] . '</p></a></td>';
            $html .= '<td>' . '<p>' . $n['author'] . '</p></td>';
            $html .= '<td>' . '<p>' . $n['category'] . '</p></td>';
            $html .= '<td>' . '<p>' . $n['status'] . '</p></td>';
            $html .= '<td>' . '<p>' . $n['viewcount'] . '</p></td>';
            $html .= '<td>' . '<p>' . Util::timeStr($n['updateTime']) . '</p></td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        return $html;
    }

    public static function novelCategory($category) {
        /* 分两列展示 */
        $flag = true;
        $html = '<table width="100%">';
        for($i = 0; $i < count($category); ++$i) {
            $html .= '<tr>';
            if($flag) {
                $html .= '<th><a href="/novel/category/category/c/' . $category[$i] . '">' . $category[$i] . '</a></th>';
                if($i + 1 < count($category)) {
                    $html .= '<th><a href="/novel/category/category/c/' . $category[$i + 1] . '">' . $category[$i + 1] . '</a></th>';
                } else {
                    $html .= '<th></th>';
                }
                $flag = false;
                continue;
            }
            $html .= '</tr>';
            $flag = true;
        }
        $html .= '</table>';
        return $html;
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