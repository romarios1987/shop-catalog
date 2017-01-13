<?php
include 'config.php';
include 'functions.php';

$categories = get_cat();
$categories_tree = map_tree($categories);
$categories_menu = categories_to_string($categories_tree);


if (isset($_GET['product'])) {
    $product_id = (int)$_GET['product'];

    $get_one_product = get_one_product($product_id);  // Массив данных о продукте
    $id_category = $get_one_product['parent'];  // Получаем ID категории
} else {
    $id_category = (int)$_GET['category'];
}

/*** Хлебные крошки ***/
// return true (array not empty) || false
$breadcrumbs_array = breadcrumbs($categories, $id_category);
if ($breadcrumbs_array) {
    $breadcrumbs = "<a href='" . PATH . "'>Главная</a> / ";
    foreach ($breadcrumbs_array as $id => $title) {
        $breadcrumbs .= "<a href='" . PATH . "?category={$id}'>{$title}</a> / ";
    }
    if (!isset($get_one_product)) {
        $breadcrumbs = rtrim($breadcrumbs, " / ");
        $breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $breadcrumbs);
    } else {
        $breadcrumbs .= $get_one_product['title'];
    }
} else {
    $breadcrumbs = "<a href='" . PATH . "'>Главная</a> / Каталог";
}

// id  дочерних категорий
$ids = cats_id($categories, $id_category);
$ids = !$ids ? $id_category : rtrim($ids, ",");


/***Пагинация***/
echo $perpage = (int)$_COOKIE['per_page'] ? $_COOKIE['per_page'] : PERPAGE; // Количество товаров на страницу

$count_goods = count_goods($ids); // Общее количество товаров

// необходимое количество страниц
$count_pages = ceil($count_goods / $perpage); // Округляем
if (!$count_pages) $count_pages = 1; // Должна быть мимисум 1 страница
if (isset($_GET['page'])) { // Получения запрошеной страницы
    $page = (int)$_GET['page'];
    if ($page < 1) $page = 1;
} else {
    $page = 1;
}
if ($page > $count_pages) $page = $count_pages; // Если запрошеная страница больше максимума

$start_pos = ($page - 1) * $perpage; // Начальная позиция для запроса

$pagination = pagination($page, $count_pages);
/***Пагинация***/

$products = get_products($ids, $start_pos, $perpage);












