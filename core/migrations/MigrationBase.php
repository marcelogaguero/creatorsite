<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 26/04/13
 * Time: 22:44
 * To change this template use File | Settings | File Templates.
 */
namespace core\migrations;

abstract class MigrationBase
{
    private $version;
    protected $db;

    public function setDb($db){
        $this->db = $db;
    }

    public function getVersion(){
        return $this->version;
    }

    abstract public function up();
    abstract public function down();
}
