<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 26/04/13
 * Time: 22:09
 * To change this template use File | Settings | File Templates.
 */
namespace core;

use core\db\Connection;
use core\migrations\MigrationBase;

class Migration
{
    private $path;
    private $version;
    private $migrations = array();

    function __construct($db)
    {
        $this->path =  __DIR__ . "/migrations";
        $this->version = $this->verifyVersion();
        $this->load($db);
    }

    private function load($db){

        if ($handle = opendir($this->path)) {
            require_once $this->path ."/".'MigrationBase.php';
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && $entry != 'MigrationBase.php' && $entry != 'version.ini') {
                    require_once $this->path . "/" . $entry;
                    $classname = strstr($entry, '.', true);
                    $migration = null;
                    eval('$migration = new \\core\\migrations\\'.$classname.'();');
                    $migration->setDb($db);
                    $this->migrations[] = $migration;
                }
            }
            closedir($handle);
        }
    }

    private function verifyVersion(){
        $filename = 'version.ini';
        $version = 1;

        if(!is_file($this->path.DIRECTORY_SEPARATOR.$filename)){
            $fp = fopen($this->path.DIRECTORY_SEPARATOR.$filename, 'a');
            fwrite($fp, 'version=1');
            fclose($fp);
        } else {
            $file = fopen($this->path.DIRECTORY_SEPARATOR.$filename, "r");
            $content = fread($file, filesize($this->path.DIRECTORY_SEPARATOR.$filename));
            $a_version = strstr($content, '=');
            $version = (int) $a_version[1];
        }
        return $version;
    }

    public function downgrade($version){
       /* @var MigrationBase $migration */
       foreach($this->migrations as $migration){
           if($migration->getVersion() >= $version){
                $migration->down();
                $this->saveVersion($migration->getVersion());
           }
       }
    }

    public function update($version){

        /* @var MigrationBase $migration */
        foreach($this->migrations as $migration){
            if($migration->getVersion() <= $version){
                $migration->up();
                $this->saveVersion($migration->getVersion());
            }
        }
    }

    public function getVersion(){
        return $this->version;
    }

    private function saveVersion($version){
        $filename = 'version.ini';
        $fp = fopen($filename, 'w+');
        fwrite($fp, 'version=1');
        fclose($fp);
    }
}
