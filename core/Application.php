<?php
/**
 * Created by Nemogroup.
 * @author: Marcelo Agüero <marcelo.aguero@nemogroup.net>
 * @since: 25/04/13 13:52
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
