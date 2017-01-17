<?php defined("CATALOG") or die("Access denied");
include 'main_controller.php';
include "models/{$view}_model.php";

/**
 * может быть либо ID продукта, либо ID категории...
 * если есть ID продукта,
 * тогда ID категории возьмем из поля parent, иначе - возьмем сразу из параметра  **/

$get_one_product = get_one_product($product_alias);  // Массив данных о продукте
$id_category = $get_one_product['parent'];  // Получаем ID категории

include 'libs/breadcrumbs.php';

include "views/{$view}.php";