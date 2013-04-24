<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 21/04/13
 * Time: 12:58
 * To change this template use File | Settings | File Templates.
 */
namespace modules\test\controllers;

use \core\BaseController;

class TestController extends BaseController
{
    public function indexAction(){

        $params = $_GET;

        return $this->render($this->getPathBaseModule().'/views/index.php', $params);
    }
}
