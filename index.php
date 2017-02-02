<?php
error_reporting(E_ALL);
define("CATALOG", true);

session_start();
include 'config.php';

/**
 * Функция маршрутизации (Роутинга)
 */
$routes = [
    array('url' => '#^$|^\?#', 'view' => 'category'),
    array('url' => '#^product/(?P<product_alias>[a-z0-9-]+)#i', 'view' => 'product'),
    array('url' => '#^category/(?P<category_alias>[a-z0-9-]+)#i', 'view' => 'category'),
    array('url' => '#^page/(?P<page_alias>[a-z0-9-]+)#i', 'view' => 'page'),
    array('url' => '#^add_comment#i', 'view' => 'add_comment'),
    array('url' => '#^login#i', 'view' => 'login'),
    array('url' => '#^logout#i', 'view' => 'logout'),
    array('url' => '#^forgot#i', 'view' => 'forgot'),
    array('url' => '#^reg#i', 'view' => 'reg')
];

$url = ltrim($_SERVER['REQUEST_URI'], '/');

foreach ($routes as $route) {
    if (preg_match($route['url'], $url, $match)) {
        $view = $route['view'];
        break;
    }
}

if (empty($match)) {
    include TEMPLATE . '404.php';
    exit;
}
extract($match);

// $id_category - ID категории
// $product_alias - alias продукта
// $view - вид для подключения
include "controllers/{$view}_controller.php";



