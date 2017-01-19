<?php defined("CATALOG") or die("Access denied");

include 'models/main_model.php';
include "models/{$view}_model.php";

echo add_comment();