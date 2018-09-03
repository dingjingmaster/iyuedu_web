<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/9/3
 * Time: 10:41
 */

namespace app\web\controller;

use think\Controller;
use think\Request;

class ControllerBase extends Controller {
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }



    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}