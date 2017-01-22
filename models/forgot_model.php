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