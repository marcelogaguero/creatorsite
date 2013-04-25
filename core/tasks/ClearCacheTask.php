<?php
/**
 * Created by Nemogroup.
 * @author: Marcelo Agüero <marcelo.aguero@nemogroup.net>
 * @since: 25/04/13 08:42
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
