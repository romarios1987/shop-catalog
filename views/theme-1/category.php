<?php defined("CATALOG") or die("Access denied"); ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= PATH . TEMPLATE?>css/bootstrap-grid.css">
    <link rel="stylesheet" href="<?= PATH . TEMPLATE?>css/style.css">

    <title><?= strip_tags($breadcrumbs); ?></title>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="top-line"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <nav class="main-menu">
                        <?php include 'menu.php'; ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <aside class="sidebar">
                        <div>
                            <?php include 'sidebar.php'; ?>
                        </div>
                    </aside>
                </div>
                <div class="col-sm-8">
                    <main class="catalog">
                        <p class="breadcrumbs"><?= $breadcrumbs; ?></p>
                        <hr>
                        <div>
                            <select name="perpage" id="perpage">
                                <?php foreach ($option_perpage as $option): ?>
                                    <option <?php if ($perpage == $option) echo "selected"; ?>
                                            value="<?= $option; ?>"><?= $option; ?> Товаров на страницу
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <?php if ($products): ?>

                            <?php foreach ($products as $product): ?>
                                <a href="<?= PATH ?>product/<?= $product['alias'] ?>"><?= $product['title'] ?></a><br>
                            <?php endforeach; ?>

                            <?php if ($count_pages > 1): ?>
                                <div class="pagination"><?= $pagination ?></div>
                            <?php endif; ?>

                        <?php else: ?>
                            <p>Здесь товаров нет!</p>
                        <?php endif; ?>
                        <hr>
                    </main>
                </div>
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    Footer
                </div>
            </div>
        </div>
    </footer>
</div> <!--wrapper-->
<script src="<?= PATH . TEMPLATE ?>js/jquery-1.9.0.min.js"></script>
<script src="<?= PATH . TEMPLATE ?>js/jquery.accordion.js"></script>
<script src="<?= PATH . TEMPLATE ?>js/jquery.cookie.js"></script>

<script>
    $(document).ready(function () {
        $(".categories").dcAccordion();

        /*** Создаем куку для выбора количества товаров  ***/
        $("#perpage").change(function () {
            var perPage = this.value;  // $(this).val()-по другому запись
            $.cookie('per_page', perPage, {expires: 7, path: '/'});
            window.location = location.href;
        })
    })
</script>
<script src="<?= PATH . TEMPLATE ?>js/workscript.js"></script>
</body>
</html>
