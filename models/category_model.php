<?php defined("CATALOG") or die("Access denied"); ?>
<?php
/**
 * Получение ID дочерних категорий
 */


function cats_id($categories, $id_category)
{
    if (!$id_category) return false;
    $date = null;

    foreach ($categories as $item) {
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

function get_products($ids, $start_pos, $perpage)
{
    global $connection;
    if ($ids) {
        $query = "SELECT * FROM products WHERE parent IN($ids) ORDER BY title LIMIT $start_pos,$perpage";
    } else {
        $query = "SELECT * FROM products ORDER BY title LIMIT $start_pos,$perpage";
    }
    $res = mysqli_query($connection, $query);
    $products = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $products[] = $row;
    }
    return $products;
}

/**
 * Ф-я получения общего количества товаров
 */
function count_goods($ids)
{
    global $connection;
    if (!$ids) {
        $query = "SELECT count(*) FROM products";
    } else {
        $query = "SELECT  count(*) FROM products WHERE parent IN ($ids)";
    }
    $res = mysqli_query($connection, $query);
    $count_goods = mysqli_fetch_row($res);

    return $count_goods[0];
}
