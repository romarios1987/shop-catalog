<?php defined("CATALOG") or die("Access denied");
include 'main_controller.php';
include "models/{$view}_model.php";


$page = get_one_page($page_alias);


if (!$page){
    include 'views/404.php';
    exit;
}

$breadcrumbs = "<a href='". PATH ."'>Главная</a> / {$page['title']}";

include TEMPLATE . "{$view}.php";