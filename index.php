<?php include 'catalog.php'; ?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-grid.css">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
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
                    <?php print_arr($categories); ?>
                </main>
            </div>
        </div>
    </div>
    <script src="js/jquery-1.9.0.min.js"></script>
    <script src="js/jquery.accordion.js"></script>
    <script src="js/jquery.cookie.js"></script>


    <script>
        $(document).ready(function () {
            $(".categories").dcAccordion();
        })
    </script>
</body>
</html>
