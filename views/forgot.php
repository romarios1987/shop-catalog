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
                <h3>Востановление пароля</h3>
                <!--  Ошибки изменения пароля-->
                <?php if (isset($_SESSION['forgot']['change_error'])): ?>
                    <div class="error"><?= $_SESSION['forgot']['change_error']; ?></div>
                    <?php unset($_SESSION['forgot']['change_error']); ?>
                    <div class="form auth">
                        <form action="<?= PATH ?>forgot" method="POST">
                            <p><label for="new_password">Новый пароль:</label>
                                <input type="text" name="new_password" id="new_password">
                            </p>
                            <input type="hidden" name="hash" value="<?= $_GET['forgot']; ?>">
                            <p class="submit"><input type="submit" value="Изменить пароль" name="change_pass"></p>
                        </form>
                    </div>
                    
                    <!--  пароль изменен-->
                    <?php elseif(isset($_SESSION['forgot']['ok'])): ?>
                    <div class="ok"><?= $_SESSION['forgot']['ok']; ?></div>
                    <?php unset($_SESSION['forgot']['ok']); ?>


                    <!--  Ошибки доступа на изменения пароля-->
                <?php elseif (isset($_SESSION['forgot']['errors'])): ?>
                    <div class="error"><?= $_SESSION['forgot']['errors']; ?></div>
                    <?php unset($_SESSION['forgot']['errors']); ?>

                    <!--  только зашли-->
                <?php else: ?>
                    <div class="form auth">
                        <form action="<?= PATH ?>forgot" method="POST">
                            <p><label for="new_password">Новый пароль:</label>
                                <input type="text" name="new_password" id="new_password">
                            </p>
                            <input type="hidden" name="hash" value="<?= $_GET['forgot'] ?>">
                            <p class="submit"><input type="submit" value="Изменить пароль" name="change_pass"></p>
                        </form>
                    </div>
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
    })
</script>
<script src="<?= PATH ?>views/js/workscript.js"></script>
</body>
</html>

