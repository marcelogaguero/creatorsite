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
        $module = $parameters[0];
        $path = __DIR__ . "/../../modules/".strtolower($module);

        if(!mkdir($path, 0775, true)) throw new \Exception("No se pudo crear el directorio $path. \n");
        if(!mkdir($path."/controllers", 0775, true)) throw new \Exception("No se pudo crear el directorio $path/controllers. \n");
        if(!mkdir($path."/css", 0775, true)) throw new \Exception("No se pudo crear el directorio $path/css. \n");
        if(!mkdir($path."/img", 0775, true)) throw new \Exception("No se pudo crear el directorio $path/img. \n");
        if(!mkdir($path."/js", 0775, true)) throw new \Exception("No se pudo crear el directorio $path/js. \n");
        if(!mkdir($path."/views", 0775, true)) throw new \Exception("No se pudo crear el directorio $path/views. \n");

        $file = $path."/controllers/".$module."Controller.php";
        $code = $this->getClassCode($module);
        if (!file_put_contents($file, $code)) die("Error: no se pudo crear el archivo $file. \n");

        $html = $this->getCodeView();
        $file = $path."/views/index.php";
        if (!file_put_contents($file, $html)) die("Error: no se pudo crear el archivo $file. \n");

    }

    protected function getClassCode($module){

        $dir = strtolower($module);
        $date = date('d/m/Y m:s');
        $nameclass = $module."Controller";

        $code = <<<EOD
<?php
    /**
    * @author: Marcelo Agüero <marcelogaguero@hotmail.com>
    * @since: $date
    *
    * Controlador creado dinamicamente con una tarea
    */
    namespace modules\\$dir\\controllers;

    use \core\BaseController;

    class $nameclass extends BaseController
    {
        public function indexAction(){
            return \$this->render(\$this->getPathBaseModule().'/views/index.php', array());
        }
    }
EOD;
        return $code;
    }

    protected function getCodeView(){
        $html = <<<EOD
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        </head>
        <body>
            CONTENIDO
        </body>
        </html>
EOD;
        return $html;
    }
}


