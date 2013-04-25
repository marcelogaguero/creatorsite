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
    private $cache;

    function __construct(){
        $this->init();
    }

    protected function init(){
        $this->cache = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR."compiled";
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

    protected function parserTemplate($template){
        $parser = array();
        $parser['path'] = substr($template, 0, strripos($template, DIRECTORY_SEPARATOR));
        $parser['name'] = substr(strrchr($template, DIRECTORY_SEPARATOR), 1);
        return $parser;
    }

    public function render($template, $params = array()){

        $parser = $this->parserTemplate($template);

        $loader = new \Twig_Loader_Filesystem($parser['path']);
        $twig = new \Twig_Environment($loader, array(
            'cache' => $this->cache,
        ));

        return $twig->render($parser['name'], $params);

    }
}
