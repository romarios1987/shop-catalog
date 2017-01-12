<?php
include 'config.php';
include 'functions.php';

$categories = get_cat();
$categories_tree = map_tree($categories);
$categories_menu = categories_to_string($categories_tree);


if (isset($_GET['category'])){
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
}