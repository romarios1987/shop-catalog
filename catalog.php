<?php
include 'config.php';
include 'functions.php';

$categories = get_cat();
$categories_tree = map_tree($categories);
$categories_menu = categories_to_string($categories_tree);



    $id_category = (int)$_GET['category'];
    // Хлебные крошки
    // return true (array not empty) || false
    $breadcrumbs_array = breadcrumbs($categories, $id_category);
    if ($breadcrumbs_array){
        $breadcrumbs = "<a href='/'>Главная</a> / ";
        foreach ($breadcrumbs_array as $id => $title){
            $breadcrumbs .= "<a href='?category={$id}'>{$title}</a> / ";
        }
        $breadcrumbs = rtrim($breadcrumbs, " / ");
        $breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $breadcrumbs);
    }else{
        $breadcrumbs = "<a href='/'>Главная</a> / Каталог";
    }

    // id  дочерних категорий
    $ids = cats_id($categories, $id_category);
    $ids = !$ids ? $id_category : rtrim($ids, ",");

    /***Пагинация***/
     $perpage = 9; // Количество товаров на страницу

    $count_goods = count_goods($ids); // Общее количество товаров

    // необходимое количество страниц
    $count_pages = ceil($count_goods / $perpage); // Округляем
    if (!$count_pages) $count_pages = 1; // Должна быть мимисум 1 страница
    if (isset($_GET['page'])){ // Получения запрошеной страницы
        $page = (int)$_GET['page'];
        if ($page < 1) $page = 1;
    }else{
        $page = 1;
    }
    if ($page > $count_pages) $page = $count_pages; // Если запрошеная страница больше максимума

    $start_pos = ($page - 1) * $perpage; // Начальная позьция для запроса

    $pagination = pagination($page, $count_pages);
    /***Пагинация***/

    $products = get_products($ids, $start_pos, $perpage);












