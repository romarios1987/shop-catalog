<?php defined("CATALOG") or die("Access denied");
include 'main_controller.php';
include "models/{$view}_model.php";


if (isset($_SESSION['auth']['user'])){
    redirect(PATH);
}



// если запрошено востановление пароля
if (isset($_POST['forgot-pass'])) {
    forgot();
    redirect();
} // Ессли есть ссылка на востановления пароля
elseif (isset($_GET['forgot'])) {
    access_change();
    $breadcrumbs = "<a href='" . PATH . "'>Главная</a> / Восстановление пароля";
    include "views/{$view}.php";
}
// Отправлен новый пароль
elseif (isset($_POST['change_pass'])){
    change_forgot_password();
    redirect(PATH . "forgot/?forgot=" . $_POST['hash']);
}

else {
    redirect(PATH);
}
