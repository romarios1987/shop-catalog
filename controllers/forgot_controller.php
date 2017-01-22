<?php defined("CATALOG") or die("Access denied");
include 'main_controller.php';
include "models/{$view}_model.php";


// если запрошено востановление пароля
if (isset($_POST['forgot-pass'])) {
    forgot();
    redirect();
}else{
    redirect(PATH);
}


//$breadcrumbs = "<a href='". PATH ."'>Главная</a> / {$page['title']}";
//include "views/{$view}.php";