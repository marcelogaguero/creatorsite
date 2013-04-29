<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 26/04/13
 * Time: 23:02
 * To change this template use File | Settings | File Templates.
 */
namespace tasks;

use \core\TaskBase;
use \core\Context;
use \core\Migration;

class MigrateTask extends TaskBase
{
    public function setDefination()
    {
        $definations = array(
            'group' => 'mga',
            'name' => 'migrate',
            'summary' => 'Migra la base de datos.',
            'description' => 'Actualiza o desactualiza la base de datos.',
            'parameters' => array(
                'version' => array('help' => 'Numero de version que se desea tener de la base de datos.'),
            ),
            'options' => array(
                'env' => array('default' => 'dev', 'type'=>self::OPTIONAL, 'help' => 'ambiente'),
            )
        );
        $this->setConfig($definations);
    }

     public function execute($parameters, $options){
         $context = new Context($options['env']);
         /** @var Migration $migration  */
         $migration = new Migration($context->getDb());
         $version = $parameters[0];

         if($migration->getVersion() > $version){
            $migration->downgrade($version);
         } else {
             $migration->update($version);
         }

     }
}
