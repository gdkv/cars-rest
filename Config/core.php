<?php
    // debug
    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~(E_NOTICE | E_STRICT | E_DEPRECATED));
    date_default_timezone_set('Europe/Moscow');
    if (!session_id()) @session_start();

    require("db.php");
    require("urls.php");
    require("../Core/Helpers.php");
    require("../Core/AbstractModel.php");
    require("../Core/AbstractController.php");
?>