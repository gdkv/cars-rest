<?php
    // debug
    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~(E_NOTICE | E_STRICT | E_DEPRECATED));
    date_default_timezone_set('Europe/Moscow');

    // composer
    require_once "../vendor/autoload.php";

    // core and router
    require("../Config/core.php");
    require("../router.php");

    // models and controllers
    foreach (glob("../Controllers/*") as $filename) {
        require("$filename");
    }
    foreach (glob("../Models/*") as $filename) {
        require("$filename");
    }

    $router = new Router();
    $router->forward();
?>