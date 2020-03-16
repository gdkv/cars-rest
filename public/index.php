<?php
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