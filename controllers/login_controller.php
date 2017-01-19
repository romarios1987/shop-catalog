<?php defined("CATALOG") or die("Access denied");

include 'models/main_model.php';
include "models/{$view}_model.php";

if (isset($_POST['login'])){
    autorization();
    redirect();
}else{
    header("Location: " . PATH);
}

