<?php include 'catalog.php'; ?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=PATH?>bootstrap-grid.css">
    <link rel="stylesheet" href="<?=PATH?>style.css">

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
                        <ul class="categories">
                            <?php echo $categories_menu; ?>
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="col-sm-8">
                <main class="catalog">
                    <p class="breadcrumbs"><?=$breadcrumbs; ?></p>
                    <hr>
                    <div>
                        <select name="perpage" id="perpage">
                            <?php foreach ($option_perpage as  $option): ?>
                                <option <?php if ($perpage == $option) echo "selected"; ?> value="<?=$option;?>"><?=$option;?> Товаров на страницу</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?php if($products): ?>

                        <?php if( $count_pages > 1 ): ?>
                            <div class="pagination"><?=$pagination?></div>
                        <?php endif; ?>

                        <?php foreach($products as $product): ?>
                            <a href="<?=PATH?>product/<?=$product['alias']?>"><?=$product['title']?></a><br>
                        <?php endforeach; ?>

                        <?php if( $count_pages > 1 ): ?>
                            <div class="pagination"><?=$pagination?></div>
                        <?php endif; ?>

                    <?php else: ?>
                        <p>Здесь товаров нет!</p>
                    <?php endif; ?>
                    <hr>
                </main>
            </div>
        </div>
    </div>
    <script src="<?=PATH?>js/jquery-1.9.0.min.js"></script>
    <script src="<?=PATH?>js/jquery.accordion.js"></script>
    <script src="<?=PATH?>js/jquery.cookie.js"></script>


    <script>
        $(document).ready(function () {
            $(".categories").dcAccordion();

            /*** Создаем куку для выбора количества товаров  ***/
            $("#perpage").change(function () {
                var perPage = this.value;  // $(this).val()-по другому запись
               $.cookie('per_page', perPage, {expires: 7});
               window.location = location.href;
            })
        })
    </script>
</body>
</html>
