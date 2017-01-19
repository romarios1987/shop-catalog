<?php defined("CATALOG") or die("Access denied"); ?>
<div class="form auth">
    <?php if (!isset($_SESSION['auth']['user'])): ?>
    <form action="<?=PATH?>login" method="POST">
        <p><label for="login">Логин</label>
        <input type="text" name="login" id="login"></p>
        <p><label for="password">Пароль</label>
        <input type="password" name="password" id="password"></p>
        <p class="submit"><input type="submit" value="Войти" name="log_in"></p>
    </form>
        <p><a href="#">Регистрация</a> | <a href="#">Забыли пароль?</a></p>
        <?php if (isset($_SESSION['auth']['errors'])): ?>
            <div class="error"><?=$_SESSION['auth']['errors'];?></div>
            <?php unset($_SESSION['auth']); ?>
        <?php endif; ?>

    <?php else: ?>
        <p>Добро пожаловать, <span><?=htmlspecialchars($_SESSION['auth']['user']); ?></span>!</p>
        <p><a href="<?=PATH?>logout">Выход</a></p>
    <?php endif; ?>
</div>

<ul class="categories">
    <?php echo $categories_menu; ?>
</ul>