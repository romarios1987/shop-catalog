<?php defined("CATALOG") or die("Access denied");

/**
 *Проверка доступности поля при регистрации
 */

function access_field(){
    global $connection;
    $fields = ['login', 'email'];
    $value = trim(mysqli_real_escape_string($connection, $_POST['value']));
    $field = $_POST['dataField'];

    if (!in_array($field, $fields)) {
        return 'no';
    }
    $query = "SELECT id FROM users WHERE $field = '$value'";
    $res = mysqli_query($connection, $query);
    if (mysqli_num_rows($res) > 0) {
        return 'no';
    } else {
        return 'yes';
    }

}

