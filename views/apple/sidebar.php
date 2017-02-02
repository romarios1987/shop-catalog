<div class="sidebar-wrap"> <!-- class="sidebar-wrap" -->

    <div class="block-body"> <!-- class="block-body" -->

        <?php if (!isset($_SESSION['auth']['user'])): ?>
            <div class="block-title">Войти</div>
        <?php else: ?>
            <div class="block-title">Мини-профиль</div>
        <?php endif; ?>

        <div id="auth">
            <?php if (!isset($_SESSION['auth']['user'])): ?>
                <form action="<?= PATH ?>login" method="POST">
                    <ul class="auth-user">
                        <li>
                            <input type="text" name="login" class="login" placeholder="Введите ваш логин"/>
                        </li>
                        <li>
                            <input type="password" name="password" class="password" placeholder="Введите ваш пароль"/>
                        </li>
                        <li>
                            <input class="lisubmit" type="submit" name="log_in" value="Войти"
                                   src="<?= PATH . TEMPLATE ?>images/auth-btn.jpg"/>
                        </li>
                    </ul>
                </form>

                <a href="#" id="forgot-link">Забыл пароль?</a>
                <a href="href=" <?= PATH ?>reg">Зарегистрироваться</a>
                <?php if (isset($_SESSION['auth']['errors'])): ?>
                    <div class="error"><?= $_SESSION['auth']['errors']; ?></div>
                    <?php unset($_SESSION['auth']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['auth']['ok'])): ?>
                    <div class="ok"><?= $_SESSION['auth']['ok']; ?></div>
                    <?php unset($_SESSION['auth']); ?>
                <?php endif; ?>

            <?php else: ?>
                <p class="s1">Добро пожаловать, <span><?= htmlspecialchars($_SESSION['auth']['user']); ?></span>!</p>
                <p class="s1">Вы состоите в группе: <?php if ($_SESSION['auth']['is_admin']) echo 'Администраторы'; else echo 'Пользователи'; ?></p>
                <p><a href="<?= PATH ?>logout">Выход</a></p>
            <?php endif; ?>
        </div>  <!--#auth-->

        <!-- Востановление пароля -->
        <div id="forgot">
            <form action="<?= PATH ?>forgot" method="POST">
                <ul class="auth-user">
                    <li><input type="email" name="email" id="email" class="login" placeholder="Введите ваш email"></li>
                    <li><input type="submit" value="Выслать пароль" name="forgot-pass"</li>
                </ul>
            </form>
            <p><a href="#" id="auth-link">Вход на сайт</a></p>
        </div>


    </div> <!-- class="block-body" -->

    <div class="block-body"> <!-- class="block-body" -->
        <div class="block-title">Каталог</div>
        <ul class="catalog">
            <?php echo $categories_menu; ?>
        </ul>
    </div> <!-- class="block-body" -->

</div> <!-- class="sidebar-wrap" -->