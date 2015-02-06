<?php
/**
 * Created by PhpStorm.
 * User: Lab
 * Date: 15-1-21
 * Time: 下午7:59
 */
$ini = parse_ini_file(dirname(dirname(__FILE__))."/config.ini", true);

define('DB_HOST',		$ini['global']['host']);
define('DB_USER',		$ini['global']['username']);
define('DB_PASSWORD',	$ini['global']['password']);
define('DB_CHARSET',	$ini['global']['charset']);

define('Chinavec_VERSION',    isset($ini['global']['version']) ? $ini['global']['version'] : '');
define("Chinavec_LOG",        $ini['global']['log']);

define('DEFAULT_WIDTH',	1024);
define('DEFAULT_HEIGHT',768);

/* ui_press module config */
$vec_campus = array(
    "db_name"	=> $ini['press']['db_name'],
    "prefix"	=> $ini['press']['prefix'],
    "relDIR"	=> $ini['press']['relDIR'],
    "dir"		=> $_SERVER['DOCUMENT_ROOT'].$ini['press']['relDIR']
);

/* ui_runtime module config */
$vec_upload = array(
    "db_name"	=> $ini['runtime']['db_name'],
    "prefix"	=> $ini['runtime']['prefix'],
    "relDIR"	=> $ini['runtime']['relDIR'],
    "medialib"	=> $ini['runtime']['medialib'],
    "temp"		=> $ini['runtime']['temp'],
    "icon"		=> $ini['runtime']['icon'],
    "dir"		=> $_SERVER['DOCUMENT_ROOT'].$ini['runtime']['relDIR'],
    "debug"		=> intval($ini['runtime']['debug'])
);

$ui_open = array(
    "db_name"   => $ini['open']['db_name'],
    "prefix"	=> $ini['open']['prefix'],
    "ucprefix"	=> $ini['open']['ucprefix'],
    "relDIR"    => $ini['open']['relDIR'],
    "uckey"     => "hep9rcl5Lfr3F833h9UbOd0c7fXaJ5d6S3J8U6Z3l9C1F1PdAbIfI48565c3fdm4"
);
$ui_open['ucapi'] = "http://{$_SERVER['SERVER_NAME']}{$ui_open['relDIR']}/uc_server";

// End of ui_config.php
