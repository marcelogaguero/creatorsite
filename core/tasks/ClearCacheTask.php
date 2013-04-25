<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 21/04/13
 * Time: 12:25
 * To change this template use File | Settings | File Templates.
 */

namespace tasks;

use \core\tools\Utils;
use \core\TaskBase;

class ClearCacheTask extends TaskBase
{
    public function setDefination()
    {
        $definations = array(
            'group' => 'mga',
            'name' => 'cache-clear',
            'summary' => 'Borra la cache',
            'description' => 'Elimina los templates compilados de la cache',
            'parameters' => array(),
            'options' => array()
        );
        $this->setConfig($definations);
    }

    public function execute($parameters, $options)
    {
        Utils::deleteDirectory(__DIR__ ."/../../cache/compiled");
    }

}
