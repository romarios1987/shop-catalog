<?php defined("CATALOG") or die("Access denied");

include 'models/main_model.php';

unset($_SESSION['auth']);
redirect();