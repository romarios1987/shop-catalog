<?php defined("CATALOG") or die("Access denied"); ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=PATH . TEMPLATE ?>css/bootstrap-grid.css">
    <link rel="stylesheet" href="<?=PATH . TEMPLATE ?>css/style.css">
    <title><?=strip_tags($breadcrumbs); ?></title>
</head>
<body>
<header>
    <div class="top-line"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="main-menu">
                    <?php include 'menu.php';?>
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

           <?=$page['text']; ?>

            </main>
        </div>
    </div>
</div>


<script src="<?=PATH . TEMPLATE ?>js/jquery-1.9.0.min.js"></script>
<script src="<?=PATH . TEMPLATE ?>js/jquery.accordion.js"></script>
<script src="<?=PATH . TEMPLATE ?>js/jquery.cookie.js"></script>


<script>
    $(document).ready(function () {
        $(".categories").dcAccordion();
    })
</script>
<script src="<?= PATH . TEMPLATE ?>js/workscript.js"></script>
</body>
</html>

