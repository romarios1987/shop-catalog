<?php defined("CATALOG") or die("Access denied");
/**
 * Начало востановления пароля
 */
function forgot(){
    global $connection;
    $email = trim(mysqli_real_escape_string($connection, $_POST['email'] ));
    if (empty($email)){
        $_SESSION['auth']['errors'] = 'Поле email не заполнено!';
    }else{
        $query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
        $res = mysqli_query($connection, $query);
        if (mysqli_num_rows($res) == 1){
            $expire = time() + 3600;
            $hash = md5($expire . $email);
            $query = "INSERT INTO forgot (hash, expire, email)
                      VALUES ('$hash', $expire,'$email')";
            $res = mysqli_query($connection, $query);
            if (mysqli_affected_rows($connection) > 0 ){
                // Если добавлена запись в таблицу forgot
                $link = PATH . "forgot/?forgot={$hash}";
                $subject = "Запрос на востановления пароля на сайте" . PATH;
                $body = "По ссылке <a href='{$link}'>{$link}</a> вы найдете страницу с формой, где сможете ввести новый пароль.Ссылка активна в тичение 1 часа";
                $headers = "FROM: " . strtoupper($_SERVER['SERVER_NAME']) . "\r\n";
                $headers .= "Content-type: text/html; charset=utf-8";

                mail($email, $subject, $body, $headers); // Отправляем mail пользователю!
                
                $_SESSION['auth']['ok'] = 'На ваш email выслана инструкция по востановлению пароля';

            }else{
                $_SESSION['auth']['errors'] = 'Ошибка!';
            }
        }else{
            $_SESSION['auth']['errors'] = 'Пользователь с таким email не найден!';
        }
    }
}

/**
 * Проверка пользователя на изменения пароля
 */
function access_change(){
    global $connection;
    $hash = trim(mysqli_real_escape_string($connection, $_GET['forgot']));
    // Если нет хеша
    if (empty($hash)){
        $_SESSION['forgot']['errors'] = "Перейдите по коректной ссылке";
        return;
    }
    $query = "SELECT * FROM forgot WHERE hash = '$hash' LIMIT 1";
    $res = mysqli_query($connection, $query);
    // Если не найден хеш
    if (!mysqli_num_rows($res)){
        $_SESSION['forgot']['errors'] = "Ссылка устарела или вы перешли по не коректной ссылке. Пройдите процедуру востановления пароля заново";
        return;
    }

    $now = time();
    $row = mysqli_fetch_assoc($res);
    // Если ссылка устарела
    if ($row['expire'] - $now < 0){
        $_SESSION['forgot']['errors'] = "Ссылка устарела. Пройдите процедуру востановления пароля заново";
        return;
    }
}

/**
 * Смена пароля
 */
function change_forgot_password(){
    global $connection;
    $hash = trim(mysqli_real_escape_string($connection, $_POST['hash']));
    $password = trim($_POST['new_password']);

    if (empty($password)){
        $_SESSION['forgot']['change_error'] = "Не введен пароль!";
        return;
    }
    $query = "SELECT * FROM forgot WHERE hash = '$hash' LIMIT 1";
    $res = mysqli_query($connection, $query);
    // Если не найден хеш
    if (!mysqli_num_rows($res))return;

    $now = time();
    $row = mysqli_fetch_assoc($res);
    // Если ссылка устарела
    if ($row['expire'] - $now < 0){
        mysqli_query($connection, "DELETE FROM forgot WHERE expire < $now");
        return;
    }
    $password = md5($password);
    mysqli_query($connection, "UPDATE users SET password = '$password' WHERE email ='{$row['email']}'");
    mysqli_query($connection, "DELETE FROM forgot WHERE email = '{$row['email']}'");
    $_SESSION['forgot']['ok'] = "Вы успешно сменили пароль!";

}
















