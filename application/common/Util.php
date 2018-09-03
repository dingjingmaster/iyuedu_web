<?php
namespace app\common;
use PHPMailer\PHPMailer;
use PHPMailer\Exception;
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/6/21
 * Time: 13:33
 */

class Util {

    public static function identifyingCode() {
        $buf = '';
        for($i = 0; $i <= 6; ++$i) {
            $buf .= mt_rand(1, 9);
        }
        return $buf;
    }

    public static function sendMessage($to, $userName, $content) {
        $flag = false;
        $curl = curl_init();
        $sendData = Util::data . '&mobile=' . $to .
            '&content='.rawurlencode('[爱阅读]' . '您好' . $userName . ',您的验证码为:'.$content.',该验证码24小时内有效');
        curl_setopt($curl, CURLOPT_URL, Util::url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $sendData);
        $return_str = curl_exec($curl);
        curl_close($curl);
        if(100 == $return_str) {
            $flag = true;
        }
        return $flag;
    }

    public static function sendMail($to, $userName, $content){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                   // Enable verbose debug output
            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'smtp.qq.com';                            // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                // Enable SMTP authentication
            $mail->Username = '1017054408@qq.com';                  // SMTP username
            $mail->Password = 'ddjj15235009846.';                   // SMTP password
            $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                      // TCP port to connect to
            $mail->CharSet = 'utf8';

            //Recipients
            $mail->setFrom('enjoyreadtop@sina.com', '爱阅读');
            $mail->addAddress($to, $userName);

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = '“爱阅读”账号激活';
            $mail->Body    = '<style>h3,p{color:#9932CC;font-size:20px;font-family:楷体,"Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif;}'.
                'p{font-weight:600;line-height:60px;}</style>'.
                '<h3>'.$userName . '你好！</h3><br/><p>' .
                '&nbsp;&nbsp;&nbsp;&nbsp; 感谢您选择“爱阅读”，此邮箱账号同时也作为您的登录账号，通过此账号，'.
                '我们会帮您记录您的阅读进度和阅读习惯，进而为您定制个性化推荐，请您一定要妥善保管。'.
                '为了确保您正常使用我们的服务，请您务必在 1 天内进行账户激活。</p>'.
                '<p>激活办法：将以下链接复制到浏览器，然后按下 enter 键即可！</p>'.
                '<p>&nbsp;'.$content . '</p>';

            $mail->send();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

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

    const url = 'http://sms.106jiekou.com/utf8/sms.aspx';
    const data = 'account=enjoyread&password=dingjing1009.';

}

