<?php defined("CATALOG") or die("Access denied"); ?>
<?php
/*** Хлебные крошки ***/
// return true (array not empty) || false
$breadcrumbs_array = breadcrumbs($categories, $id_category);
if ($breadcrumbs_array) {
    $breadcrumbs = "<a href='" . PATH . "'>Главная</a> / ";
    foreach ($breadcrumbs_array as $id => $title) {
        $breadcrumbs .= "<a href='" . PATH . "category/{$id}'>{$title}</a> / ";
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
