<?php
/**
 * Ф-я для удобной разпечатки массивов
 */
function print_arr($array){
    echo "<pre>". print_r($array, true) ."</pre>";
}


/**
 * Получаем данные из таблицы категорий
 */

function get_cat(){
    global $connection;
    $query = "SELECT * FROM categories";
    $res = mysqli_query($connection, $query);

    $arr_cat = [];
    while ($row = mysqli_fetch_assoc($res)){
        $arr_cat[$row['id']] = $row;
    }
    return $arr_cat;
}
/**
 * Построение дерева
 **/
function map_tree($dataset) {
    $tree = array();

    foreach ($dataset as $id=>&$node) {
        if (!$node['parent']){
            $tree[$id] = &$node;
        }else{
            $dataset[$node['parent']]['childs'][$id] = &$node;
        }
    }
    return $tree;
}
/**
 * Дерево в HTML строку
 */

function categories_to_string($array_categories){
    $string = '';
    foreach ($array_categories as $item){
        $string .= categories_to_template($item);
    }
    return $string;
}

/**
 * Шаблон вывода категорий
 */
function categories_to_template($category){
    ob_start(); // Начинаем буферизацию вывода
    include 'category_template.php';
    return ob_get_clean(); // Очищаем буфер
}

/**
 * Хлебные крошки
 */
function breadcrumbs($categories, $id_category){
    if (!$id_category) return false;

    $count = count($categories);
    $breadcrumbs_array = [];

    for ($i = 0; $i < $count; $i++){
        if ($categories[$id_category]) {
            $breadcrumbs_array[$categories[$id_category]['id']] =  $categories[$id_category]['title'];
            $id_category = $categories[$id_category]['parent'];
        }else break;
    }
    return  array_reverse($breadcrumbs_array, true);
}











