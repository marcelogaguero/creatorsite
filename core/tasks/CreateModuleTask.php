<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 23/04/13
 * Time: 21:57
 * To change this template use File | Settings | File Templates.
 */
namespace tasks;

use \core\TaskBase;

class CreateModuleTask extends TaskBase
{
    public function setDefination()
    {
        $definations = array(
            'group' => 'mga',
            'name' => 'create-module',
            'summary' => 'Crea un nuevo modulo.',
            'description' => 'Crea toda la estructura de un nuevo modulo.',
            'parameters' => array(
                'module' => array('help' => 'Nombre del modulo a crear.'),
            ),
            'options' => array(
            )
        );
        $this->setConfig($definations);
    }

    public function execute($parameters, $options)
    {
        $path = __DIR__ . "/../../../../modules/".$parameters[0];

        if(!mkdir($path."/controllers", 0, true)) throw new \Exception("No se pudo crear el modulo");
        if(!mkdir($path."/css", 0, true)) throw new \Exception("No se pudo crear el modulo");
        if(!mkdir($path."/img", 0, true)) throw new \Exception("No se pudo crear el modulo");
        if(!mkdir($path."/js", 0, true)) throw new \Exception("No se pudo crear el modulo");
        if(!mkdir($path."/views", 0, true)) throw new \Exception("No se pudo crear el modulo");

    }
}
