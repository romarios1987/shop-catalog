<?php defined("CATALOG") or die("Access denied"); ?>
<?php
/**
 * Ф-я получения Комментариев
 */
function add_comment(){
    global $connection;
    $comment_author = trim(mysqli_real_escape_string($connection, $_POST['commentAuthor']));
    $comment_text = trim(mysqli_real_escape_string($connection, $_POST['commentText']));
    $parent = (int)$_POST['parent'];
    $comment_product = (int)$_POST['productId'];


    // ПРОВЕРКИ
    // Если нет ID товара
    if (!$comment_product) {
        $res = ['answer' => 'Неизвестный продукт!'];
        return json_encode($res);
    }
    // Еслине не заполнены поля
    if (empty($comment_author) || empty($comment_text)) {
        $res = ['answer' => 'Не заполнены все поля!'];
        return json_encode($res);
    }
    $query = "INSERT INTO comments (comment_author, comment_text, parent, comment_product) 
              VALUES('$comment_author', '$comment_text', $parent, $comment_product)";
    $res = mysqli_query($connection, $query);

    if (mysqli_affected_rows($connection) > 0){
        $comment_id = mysqli_insert_id($connection);
        $comment_html = get_last_comment($comment_id);
        return $comment_html;
    }else{
        $res = ['answer' => 'Ошибка добавления комментария!'];
        return json_encode($res);
    }
}

/**
 * Подучения добавленого комментария
 */
function get_last_comment($comment_id){
    global $connection;
    $query = "SELECT * FROM comments WHERE  comment_id = $comment_id ORDER BY comment_id";
    $res = mysqli_query($connection, $query);
    $comment = mysqli_fetch_assoc($res);
    ob_start();
    include 'views/new_comment.php';
    $comment_html = ob_get_clean();

    $res = ['answer' => 'Комментарий добавлен!', 'code' => $comment_html, 'id' => $comment_id];
    return json_encode($res);


}