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

/**
 * Регистрация
 */

function registration(){
    global $connection;
    $errors = '';
    $fields = ['login' => 'Логин', 'email' => 'Email'];
    $name = trim($_POST['name_reg']);
    $email = trim($_POST['email_reg']);
    $login = trim($_POST['login_reg']);
    $password = trim($_POST['password_reg']);

    if (empty($name)) $errors .= '<li>Не указано имя</li>';
    if (empty($email)) $errors .= '<li>Не указан email</li>';
    if (empty($login)) $errors .= '<li>Не указан логин</li>';
    if (empty($password)) $errors .= '<li>Не указан пароль</li>';
    
    if (!empty($errors)){
        // Не заполненые обязательные поля
        $_SESSION['reg']['errors'] = "Не заполненые обязательные поля: <ul>{$errors}</ul>";
        return;
    }
    $name = mysqli_real_escape_string($connection, $name);
    $email = mysqli_real_escape_string($connection, $email);
    $login = mysqli_real_escape_string($connection, $login);
    $password = md5($password);

    // Проверка дублирования данных
    $query = "SELECT login, email FROM users WHERE login = '$login' OR email = '$email'";
    $res = mysqli_query($connection, $query);
    if (mysqli_num_rows($res) > 0){
        $data = [];
        while ($row = mysqli_fetch_assoc($res)){
            // берем то, что совпадает с содержимым $_POST, т.е - дубликаты
            $data = array_intersect($row, $_POST);
            foreach ($data as $key => $val){
                $keys[$key] = $key;
            }
        }
        foreach ($keys as $key => $val){
            $errors .= "<li>{$fields[$key]}</li>";
        }
        $_SESSION['reg']['errors'] = "Выберите другие значения для полей: <ul>{$errors}</ul>";
        return;
    }



}






























