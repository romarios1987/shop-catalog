<?php
define("CATALOG", true);
error_reporting(E_ALL);

session_start();
/**
 * Функция маршрутизации (Роутинга)
 */
$routes = [
    array('url' => '#^$|^\?#', 'view' => 'category'),
    array('url' => '#^product/(?P<product_alias>[a-z0-9-]+)#i', 'view' => 'product'),
    array('url' => '#^category/(?P<id_category>\d+)#i', 'view' => 'category'),
    array('url' => '#^page/(?P<page_alias>[a-z0-9-]+)#i', 'view' => 'page'),
    array('url' => '#^add_comment#i', 'view' => 'add_comment'),
    array('url' => '#^login#i', 'view' => 'login'),
    array('url' => '#^logout#i', 'view' => 'logout'),
    array('url' => '#^forgot#i', 'view' => 'forgot')
];

$url = ltrim($_SERVER['REQUEST_URI'], '/');

foreach ($routes as $route) {
    if (preg_match($route['url'], $url, $match)) {
        $view = $route['view'];
        break;
    }
}

if (empty($match)) {
    include 'views/404.php';
    exit;
}
extract($match);

// $id_category - ID категории
// $product_alias - alias продукта
// $view - вид для подключения
include 'config.php';
include "controllers/{$view}_controller.php";



