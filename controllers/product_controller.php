<?php defined("CATALOG") or die("Access denied");
include 'main_controller.php';
include "models/{$view}_model.php";

/**
 * может быть либо ID продукта, либо ID категории...
 * если есть ID продукта,
 * тогда ID категории возьмем из поля parent, иначе - возьмем сразу из параметра  **/

$get_one_product = get_one_product($product_alias);  // Массив данных о продукте
$id_category = $get_one_product['parent'];  // Получаем ID категории


$product_id = $get_one_product['id']; // id товара

$count_comments = count_comments($product_id); // Получаем Количество комментариев к товару

$get_comments = get_comments($product_id); // Получаем комментарии к товару
$comments_tree = map_tree($get_comments); // Дерево для коментариев
$comments = categories_to_string($comments_tree, 'comments_template.php'); // Получаем HTML Код комментариев



//$categories_tree = map_tree($categories);
//$categories_menu = categories_to_string($categories_tree);



include 'libs/breadcrumbs.php';

include TEMPLATE . "{$view}.php";