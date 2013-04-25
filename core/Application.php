<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 21/04/13
 * Time: 12:25
 * To change this template use File | Settings | File Templates.
 */
namespace core;

class Application
{
    static public function init(){
        require_once "Autoloader.php";
        \core\Autoloader::loadLibs();
        return true;
    }
}
