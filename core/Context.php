<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 21/04/13
 * Time: 11:07
 * To change this template use File | Settings | File Templates.
 */
namespace core;

use \core\Config;

class Context
{
    private $environment;

    function __construct ($environment){
        $this->environment = $environment;
    }

    public function getConfig(){
        $filename = 'config_'.$this->environment.'.ini';
        return Config::read($filename);
    }

    public function getEnvironment(){
        return $this->environment;
    }
}
