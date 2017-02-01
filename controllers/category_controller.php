<?php defined("CATALOG") or die("Access denied"); ?>
<?php
include 'main_controller.php';
include "models/{$view}_model.php";

if (!isset($id_category)) $id_category = null;

include 'libs/breadcrumbs.php';
// id  дочерних категорий
$ids = cats_id($categories, $id_category);
$ids = !$ids ? $id_category : rtrim($ids, ",");



/***Пагинация***/
// Количество товаров на страницу
$perpage = ( isset($_COOKIE['per_page']) && (int)$_COOKIE['per_page'] ) ? $_COOKIE['per_page'] : PERPAGE;

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



include TEMPLATE . "{$view}.php";


