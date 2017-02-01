<?php defined("CATALOG") or die("Access denied");
include 'main_controller.php';
include "models/{$view}_model.php";

if (isset($_POST['value'])){
    echo access_field();
    exit;
}

if (isset($_POST['reg'])){
    registration();
    redirect();
}

$breadcrumbs = "<a href='". PATH ."'>Главная</a> / Регистрация";

include TEMPLATE . "{$view}.php";