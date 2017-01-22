<?php defined("CATALOG") or die("Access denied"); ?>
<div class="form auth">

    <!-- Авторизация -->
    <div id="auth">
        <?php if (!isset($_SESSION['auth']['user'])): ?>
            <form action="<?= PATH ?>login" method="POST">
                <p><label for="login">Логин</label>
                    <input type="text" name="login" id="login"></p>
                <p><label for="password">Пароль</label>
                    <input type="password" name="password" id="password"></p>
                <p class="submit"><input type="submit" value="Войти" name="log_in"></p>
            </form>
            <p><a href="#">Регистрация</a> | <a href="#" id="forgot-link">Забыли пароль?</a></p>
            <?php if (isset($_SESSION['auth']['errors'])): ?>
                <div class="error"><?= $_SESSION['auth']['errors']; ?></div>
                <?php unset($_SESSION['auth']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['auth']['ok'])): ?>
                <div class="ok"><?= $_SESSION['auth']['ok']; ?></div>
                <?php unset($_SESSION['auth']); ?>
            <?php endif; ?>

        <?php else: ?>
            <p>Добро пожаловать,<span><?= htmlspecialchars($_SESSION['auth']['user']); ?></span>!</p>
            <p><a href="<?=PATH ?>logout">Выход</a></p>
        <?php endif; ?>
    </div><!--#auth-->

    <!-- Востановление пароля -->
    <div id="forgot">
        <form action="<?=PATH ?>forgot" method="POST">
            <p><label for="email">Email регистрации:</label>
                <input type="email" name="email" id="email">
            </p>
            <p class="submit"><input type="submit" value="Выслать пароль" name="forgot-pass"></p>
        </form>
        <p><a href="#" id="auth-link">Вход на сайт</a></p>
    </div>
</div>

<ul class="categories">
    <?php echo $categories_menu; ?>
</ul>