<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DB", "phone");
define("PATH", "http://shop-catalog.local/");

//@ - для подавления ошибок(Вместо дефолтной ошибки будет Нет соединния с БД)
$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die ("Нет соединния с БД");

mysqli_set_charset($connection, "utf8") or die ("Не установлена кодировка соединния");