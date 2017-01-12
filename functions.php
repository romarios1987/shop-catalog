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











