<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 21/04/13
 * Time: 10:55
 * To change this template use File | Settings | File Templates.
 */
namespace config;

use \core\Context;
use \core\Autoloader;

class Environment
{
    private $environment;
    private $context;

    function __construct($environment){
        // ucwords
        $this->environment = $environment;
        $this->context = new Context(strtolower($environment));
    }

    public function getContext(){
        return $this->context;
    }

    public function begin(){
        $router = explode('/', $_SERVER['PATH_INFO']);
        Autoloader::load($router[1]);

        $module = null;
        $action = strtolower($router[2]).'Action';

        eval('$module = new \\modules\\'.strtolower($router[1]).'\\controllers\\'.ucwords($router[1]).'Controller();');
        $module->setContext($this->context);

        $params = $this->context->getConfig();
        error_reporting($params['error']['log']);

        return $module->$action();
    }
}
