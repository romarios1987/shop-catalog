<?php defined("CATALOG") or die("Access denied");


define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DB", "phone");
define("PATH", "http://shop-catalog.local/");
define("PRODUCTIMG", "user-files/products/");
define("PERPAGE", 6);  // Вывод количества товаров
define("TEMPLATE","views/apple/" ); // Шаблоны

$option_perpage = [9, 12, 15];

//@ - для подавления ошибок(Вместо дефолтной ошибки будет Нет соединния с БД)
$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die ("Нет соединния с Базой");

mysqli_set_charset($connection, "utf8") or die ("Не установлена кодировка соединния");