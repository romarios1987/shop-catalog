<?php defined("CATALOG") or die("Access denied"); ?>
<?php
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