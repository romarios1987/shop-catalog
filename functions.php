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
    include 'views/category_template.php';
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

/**
 * Получение ID дочерних категорий
 */


function cats_id($categories, $id_category){
    if (!$id_category) return false;
    $date = null;

    foreach ($categories as $item){
        if ($item['parent'] == $id_category) {
            $date .= $item['id'] . ",";
            $date .= cats_id($categories, $item['id']);
        }
    }
    return $date;
}


/**
 * Ф-я получение товаров
 */

function get_products($ids, $start_pos, $perpage){
    global $connection;
    if ($ids){
        $query = "SELECT * FROM products WHERE parent IN($ids) ORDER BY title LIMIT $start_pos,$perpage";
    }else{
        $query = "SELECT * FROM products ORDER BY title LIMIT $start_pos,$perpage";
    }
    $res = mysqli_query($connection, $query);
    $products = [];
    while ($row = mysqli_fetch_assoc($res)){
        $products[] = $row;
    }
    return $products;
}

/**
 * Ф-я получения отдельного товара
 */
function get_one_product($product_alias){
    global $connection;
    $product_alias = mysqli_real_escape_string($connection, $product_alias);
    $query = "SELECT * FROM products WHERE alias = '$product_alias' ";
    $res = mysqli_query($connection, $query);


    return mysqli_fetch_assoc($res);
}




/**
 * Ф-я получения общего количества товаров
 */
function count_goods($ids){
    global $connection;
    if (!$ids) {
        $query = "SELECT count(*) FROM products";
    } else {
        $query = "SELECT  count(*) FROM products WHERE parent IN ($ids)";
    }
    $res = mysqli_query($connection, $query);
    $count_goods = mysqli_fetch_row($res);

    return  $count_goods[0];
}

/**
 * Постраничная навигация
 */
function pagination($page, $count_pages, $modrew = true){
    // << < 3 4 5 6 7 > >>
    // $back - ссылка НАЗАД
    // $forward - ссылка ВПЕРЕД
    // $startpage - ссылка В НАЧАЛО
    // $endpage - ссылка В КОНЕЦ
    // $page2left - вторая страница слева
    // $page1left - первая страница слева
    // $page2right - вторая страница справа
    // $page1right - первая страница справа

    $uri = '?';
    if (!$modrew){
        // Если есть параметры в запросе
        if ($_SERVER['QUERY_STRING']){
            foreach ($_GET as $key => $value) {
                if($key != 'page') $uri .= "{$key}=$value&amp;";
            }
        }
    }else{
        $url = $_SERVER['REQUEST_URI'];
        $url = explode("?", $url);
        if (isset($url[1]) && $url[1] != ''){
            $params = explode("&", $url[1]);
            foreach ($params as $param) {
              if (!preg_match("#page=#", $param))$uri .= "{$param}&amp;";
            }
        }
    }

    if( $page > 1 ){
        $back = "<a class='nav-link' href='{$uri}page=" .($page-1). "'>&lt;</a>";
    }
    if( $page < $count_pages ){
        $forward = "<a class='nav-link' href='{$uri}page=" .($page+1). "'>&gt;</a>";
    }
    if( $page > 3 ){
        $startpage = "<a class='nav-link' href='{$uri}page=1'>&laquo;</a>";
    }
    if( $page < ($count_pages - 2) ){
        $endpage = "<a class='nav-link' href='{$uri}page={$count_pages}'>&raquo;</a>";
    }
    if( $page - 2 > 0 ){
        $page2left = "<a class='nav-link' href='{$uri}page=" .($page-2). "'>" .($page-2). "</a>";
    }
    if( $page - 1 > 0 ){
        $page1left = "<a class='nav-link' href='{$uri}page=" .($page-1). "'>" .($page-1). "</a>";
    }
    if( $page + 1 <= $count_pages ){
        $page1right = "<a class='nav-link' href='{$uri}page=" .($page+1). "'>" .($page+1). "</a>";
    }
    if( $page + 2 <= $count_pages ){
        $page2right = "<a class='nav-link' href='{$uri}page=" .($page+2). "'>" .($page+2). "</a>";
    }

    return $startpage.$back.$page2left.$page1left.'<a class="nav-active">'.$page.'</a>'.$page1right.$page2right.$forward.$endpage;
}

















