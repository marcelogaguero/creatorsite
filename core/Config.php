<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 21/04/13
 * Time: 11:04
 * To change this template use File | Settings | File Templates.
 */
namespace core;

class Config
{

    public static function read($filename)
    {
        $path = __DIR__."/../config/".$filename;
        if (!file_exists($path)) throw new \Exception("No existe el archivo de configuracion ". $filename);
        return parse_ini_file($path, true);
    }
}
