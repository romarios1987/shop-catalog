<?php defined("CATALOG") or die("Access denied");
include 'main_controller.php';
include "models/{$view}_model.php";


$page = get_one_page($page_alias);


if (!$page){
    include 'views/404.php';
    exit;
}

$breadcrumbs = "<li><a href='". PATH ."'>Главная</a></li> - <li>{$page['title']}</li>";

include TEMPLATE . "{$view}.php";