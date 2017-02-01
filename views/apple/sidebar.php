<div class="sidebar-wrap"> <!-- class="sidebar-wrap" -->

    <div class="block-body"> <!-- class="block-body" -->
        <div class="block-title">Войти</div>
        <form action="" method="post">
            <ul class="auth-user">
                <li>
                    <input type="text" class="login" placeholder="Введите ваш логин" />
                </li>
                <li>
                    <input type="password" class="password" placeholder="Введите ваш пароль" />
                </li>
                <li>
                    <input class="lisubmit" type="image" src="<?= PATH . TEMPLATE?>images/auth-btn.jpg" />
                </li>
            </ul>
        </form>
        <a href="">Забыл пароль?</a>
        <a href="">Зарегистрироваться</a>
    </div> <!-- class="block-body" -->

    <div class="block-body"> <!-- class="block-body" -->
        <div class="block-title">Каталог</div>
        <ul class="catalog">
            <?php echo $categories_menu; ?>
        </ul>
    </div> <!-- class="block-body" -->

</div> <!-- class="sidebar-wrap" -->

