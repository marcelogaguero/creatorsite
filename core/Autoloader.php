<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 21/04/13
 * Time: 12:25
 * To change this template use File | Settings | File Templates.
 */
namespace core;

class Autoloader
{
    public static function load($module){
        $path = __DIR__.'/../modules/'.$module.'/controllers/';

        if(!is_dir($path)) throw new \Exception("No existe el modulo ". $module);

        if ($handle = opendir($path)) {

            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    require_once $path . '' . $entry;
                }
            }
            closedir($handle);
        }

        self::loadLibs();
    }

    public static function loadLibs(){
        require_once __DIR__.'/../libs/addendum/annotations.php';
        require_once __DIR__.'/../core/tools/Utils.php';
        require_once __DIR__.'/../core/db/Connection.php';
        require_once __DIR__.'/../core/Context.php';
        require_once __DIR__.'/../core/Migration.php';
        require_once __DIR__.'/../core/Config.php';
    }

}
