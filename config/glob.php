<?php
define("CONTROLLER_DEFAULT", "Home");
define("ACTION_DEFAULT", "index");
define("APP", "Cloud Local");
define('URL', "http://localhost/www/frontend/app-savefile-php/");
define('PATH', $_SERVER['DOCUMENT_ROOT'] . "/www/frontend/app-savefile-php/");

error_reporting(E_ALL);

ini_set('ignore_repeated_errors', TRUE);

ini_set('display_errors', FALSE);

ini_set('log_errors', FALSE);  // TRUE "Para que guarde cualquier accion de cualquier peticion" - // FALSE "Solo guarde mis Log"

ini_set('error_log', "./config/log/php-error.log");

// error_log("Hay errores!");