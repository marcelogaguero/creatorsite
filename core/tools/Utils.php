<?php
/**
 * Created by Nemogroup.
 * @author: Marcelo Agüero <marcelo.aguero@nemogroup.net>
 * @since: 25/04/13 08:47
 */
namespace core\tools;

class Utils
{
    public static function deleteDirectory($dir)
    {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!self::deleteDirectory($dir.DIRECTORY_SEPARATOR.$item)) return false;
        }
        rmdir($dir);
        if(!mkdir($dir.DIRECTORY_SEPARATOR."compiled", 0775, true)) throw new \Exception("No se pudo crear el directorio $dir/compiled. \n");
    }
}
