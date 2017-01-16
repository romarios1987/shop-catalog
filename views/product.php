<?php defined("CATALOG") or die("Access denied"); ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=PATH?>views/bootstrap-grid.css">
    <link rel="stylesheet" href="<?=PATH?>views/style.css">
    <title>Каталог</title>
</head>
<body>
<header>
    <div class="top-line"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="main-menu">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="#">О нас</a></li>
                        <li><a href="#">Контакты</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <aside class="sidebar">
                <div>
                    <?php include 'sidebar.php';?>
                </div>
            </aside>
        </div>
        <div class="col-sm-8">
            <main class="catalog">
                <p class="breadcrumbs"><?= $breadcrumbs; ?></p>
                <hr>
                <?php if ($get_one_product): ?>
                    <?php print_arr($get_one_product); ?>
                <?php else: ?>
                    <p>Такого товара нету!</p>
                <?php endif; ?>
            </main>
        </div>
    </div>
</div>


<script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
<script src="<?=PATH?>views/js/jquery.accordion.js"></script>
<script src="<?=PATH?>views/js/jquery.cookie.js"></script>


<script>
    $(document).ready(function () {
        $(".categories").dcAccordion();
    })
</script>
</body>
</html>

