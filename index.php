<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcelo <marcelogaguero@hotmail.com>
 * Date: 21/04/13
 * Time: 10:50
 * To change this template use File | Settings | File Templates.
 */

require_once __DIR__.'/config/includes.php';

use \config\Environment;

$dispacher = new Environment('dev');
$dispacher->begin();

