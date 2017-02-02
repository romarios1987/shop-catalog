<?php require_once 'header.php'; ?>

    <div class="page-wrap"> <!-- class="page-wrap" -->

        <div class="content">
            <ul class="breadcrumbs">
                <?= $breadcrumbs; ?>
            </ul>

            <div class="content-page">


                <h1 class="product_title">Востановления пароля</h1>
                <!--  Ошибки изменения пароля-->
                <?php if (isset($_SESSION['forgot']['change_error'])): ?>
                    <div class="error"><?= $_SESSION['forgot']['change_error']; ?></div>
                    <?php unset($_SESSION['forgot']['change_error']); ?>

                    <div class="form auth">
                        <form action="<?= PATH ?>forgot" method="POST">
                            <table width="730" border="0" cellspacing="2" cellpadding="0" class="regtable">
                                <tr>
                                    <td>Введите ваш новый пароль: <span style="color:red;">*</span></td>
                                    <td><input type="text" name="new_password" id="new_password"/></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hash" value="<?= $_GET['forgot'] ?>">
                                    <td>Поля помеченные <span style="color:red;">*</span> обязательны для заполнения
                                    </td>
                                    <td><input type="submit" value="Изменить пароль" name="change_pass" class="regbtn"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <!--  пароль изменен-->
                <?php elseif (isset($_SESSION['forgot']['ok'])): ?>
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
                            <table width="730" border="0" cellspacing="2" cellpadding="0" class="regtable">
                                <tr>
                                    <td>Введите ваш новый пароль: <span style="color:red;">*</span></td>
                                    <td><input type="text" name="new_password" id="new_password"/></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="hash" value="<?= $_GET['forgot'] ?>">
                                    <td>Поля помеченные <span style="color:red;">*</span> обязательны для заполнения
                                    </td>
                                    <td><input type="submit" value="Изменить пароль" name="change_pass" class="regbtn"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                <?php endif; ?>

            </div><!--content-page-->

        </div> <!-- class="content" -->

        <?php require_once 'sidebar.php'; ?>

    </div> <!-- class="page-wrap" -->

<?php require_once 'footer.php'; ?>