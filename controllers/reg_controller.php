<?php defined("CATALOG") or die("Access denied");
include 'main_controller.php';
include "models/{$view}_model.php";

if (isset($_POST['value'])){
    echo access_field();
    exit;
}


$breadcrumbs = "<a href='". PATH ."'>Главная</a> / Регистрация";

include "views/{$view}.php";