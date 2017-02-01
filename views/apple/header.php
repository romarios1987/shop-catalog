<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Webformyself Каталог яблочной продукции</title>
    <link rel="stylesheet" href="<?= PATH . TEMPLATE?>css/style.css" />
</head>
<body>

<div class="header"> <!-- class="header" -->

    <div class="wrap"> <!-- class="wrap" -->

        <div class="logo">
            <h1>
                <a href="<?=PATH?>">Catalog<span>Apple</span></a>
            </h1>
            <p>Все для вашего <br /> яблочного смартфона</p>
        </div>

        <div class="slogan">
            Добро пожаловать в каталог аксессуаров
            <span>для продукци Aplle</span>
        </div>

        <form action="" method="post">
            <ul class="search">
                <li>
                    <input type="text" class="search" name="search" />
                </li>
                <li>
                    <input type="submit" class="search-go" name="go-search" value="поиск"  />
                </li>
            </ul>
        </form>

    </div> <!-- class="/wrap" -->

</div> <!-- class="/header" -->



<div class="menu">
    <?php require_once 'menu.php';?>
    <!--<ul class="wrap">
        <li class="active"><a href="">Главная</a></li>
        <li><a href="">О нас</a></li>
        <li><a href="">Скидки</a></li>
        <li><a href="">Акции</a></li>
        <li><a href="">Новости</a></li>
    </ul>  class="/wrap" -->
</div> <!-- class="/menu" -->