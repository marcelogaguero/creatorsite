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
use \core\db\Connection;

class Context
{
    private $environment;
    private $config;
    private $connection;

    function __construct ($environment){
        $this->environment = $environment;
        $this->setDefined();
    }

    public function getConfig(){
        if(!isset($this->config)){
            $filename = 'config_'.$this->environment.'.ini';
            $this->config = Config::read($filename);
        }
        return $this->config;
    }

    public function getEnvironment(){
        return $this->environment;
    }

    protected function setDefined(){
        $config = $this->getConfig();
        $this->defineDB($config['db']);
    }

    protected function defineDB($params){
        foreach($params as $key => $value){
            define(strtoupper($key), ($value) ? $value : '');
        }
    }

    public function getDb(){
        if(!isset($this->connection)){
            $this->connection = Connection::getInstance();
        }
        return $this->connection;
    }
}
