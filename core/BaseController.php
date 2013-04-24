<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 21/04/13
 * Time: 12:59
 * To change this template use File | Settings | File Templates.
 */
namespace core;

class BaseController
{
    private $context;

    function __construct(){
        $this->init();
    }

    protected function init(){
    }

    public function getContext(){
        return $this->context;
    }

    public function setContext($context){
        $this->context = $context;
    }

    public function getPathBaseModule(){
        $reflector = new \ReflectionClass(get_class($this));
        $path = explode('controllers',dirname($reflector->getFileName()));
        return $path[0];
    }

    public function render($template, $params = array()){

        extract($params);
        ob_clean();
        $html = include($template);
        ob_get_contents();
        return $html;
    }
}
