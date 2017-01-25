<?php defined("CATALOG") or die("Access denied"); ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= PATH ?>views/bootstrap-grid.css">
    <link rel="stylesheet" href="<?= PATH ?>views/style.css">
    <title><?= strip_tags($breadcrumbs); ?></title>
</head>
<body>
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
                <h3>Регистрация</h3>

                <div class="form">

                    <form action="<?= PATH ?>reg" method="POST">
                        <p><label for="name_reg">Имя:</label>
                            <input type="text" name="name_reg" id="name_reg">
                        </p>
                        <p><label for="email_reg">Email</label>
                            <input type="email" class="access" data-field="email" name="email_reg" id="email_reg">
                            <span></span>
                        </p>
                        <p><label for="login_reg">Логин</label>
                            <input type="text" class="access" data-field="login" name="login_reg" id="login_reg">
                            <span></span>
                        </p>
                        <p><label for="password_reg">Пароль</label>
                            <input type="password" name="password_reg" id="password_reg">
                        </p>
                        <p class="submit"><input type="submit" value="Зарегистрироваться" name="reg"></p>
                    </form>

                </div>
                <?php if (isset($_SESSION['reg']['errors'])): ?>
                    <br><div class="error"><?=$_SESSION['reg']['errors']; unset($_SESSION['reg']);?></div>
                <?php endif; ?>
            </main>
        </div>
    </div>
</div>


<script src="<?= PATH ?>views/js/jquery-1.9.0.min.js"></script>
<script src="<?= PATH ?>views/js/jquery.accordion.js"></script>
<script src="<?= PATH ?>views/js/jquery.cookie.js"></script>


<script>
    $(document).ready(function () {
        $(".categories").dcAccordion();


        /*** -------Ajax проверка на ввод логина и емейла при регистрации----------- ***/
        $(".access").change(function () {
            var $this = $(this),
                value = $.trim($this.val()),
                dataField = $this.attr('data-field'),
                span = $this.next();

            if (value == '') {
                span.removeClass().addClass('reg-cross');
            } else {
                span.removeClass().addClass('reg-loader');
                $.ajax({
                    url: '<?=PATH?>reg',
                    type: 'POST',
                    data: {value: value, dataField: dataField},
                    success: function (res) {
                        if (res == 'no') {
                            span.removeClass().addClass('reg-cross');
                        } else {
                            span.removeClass().addClass('reg-check');
                        }
                    }
                });
            }
        });
        /*** -------Ajax проверка----------- ***/


    })
</script>
<script src="<?= PATH ?>views/js/workscript.js"></script>
</body>
</html>

