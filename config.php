<?php

error_reporting(-1);
ini_set('display_errors', 'On');

ob_start('ob_gzhandler');
session_start();

setlocale(LC_ALL, 'de_DE.UTF-8');
date_default_timezone_set('Europe/Berlin');

// datenbank daten
define('DBTYPE','mysql');
define('DBHOST','');
define('DBNAME','');
define('DBCHAR','utf8mb4');
define('DBUSER','');
define('DBPASS','');

$db = new PDO(DBTYPE.':host='.DBHOST.'; dbname='.DBNAME.'; charset='.DBCHAR, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function sicher($str) {
return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED | ENT_SUBSTITUTE, 'UTF-8');
}

?>
