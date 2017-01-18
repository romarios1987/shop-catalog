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
    <link rel="stylesheet" href="<?= PATH ?>views/css/jquery-ui.css">
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
                        <?php if ($get_one_product): ?>
                            <?php print_arr($get_one_product); ?>
                        <?php else: ?>
                            <p>Такого товара нету!</p>
                        <?php endif; ?>
                        <hr>
                        <h3>Отзывы к товару (0)</h3>
                        <ul class="comments">
                            <?php echo $comments; ?>
                        </ul>
                        <button class="open-form">Добавить комментарий</button>

                        <div id="form-wrap">
                            <form action="<?= PATH ?>add_comment" method="post" class="form">
                                <p><label for="comment_author">Имя: </label>
                                    <input type="text" name="comment_author" id="comment_author">
                                </p>
                                <p><label for="comment_text">Комментарий: </label>
                                    <textarea name="comment_text" id="comment_text" cols="30" rows="5"></textarea>
                                </p>
                                <input type="hidden" name="parent" id="parent" value="0">
                                <!-- <p><input type="submit" value="Добавить" name="submit"></p>-->
                            </form>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div><!--content-->

    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    Footer
                </div>
            </div>
        </div>
    </footer><!--main-footer-->
</div> <!--wrapper-->

<script src="<?= PATH ?>views/js/jquery-1.9.0.min.js"></script>
<script src="<?= PATH ?>views/js/jquery-ui.min.js"></script>
<script src="<?= PATH ?>views/js/jquery.accordion.js"></script>
<script src="<?= PATH ?>views/js/jquery.cookie.js"></script>


<script>
    $(document).ready(function () {
        $(".categories").dcAccordion();

        $("#form-wrap").dialog({
            autoOpen: false,
            width: 450,
            modal: true,
            title: 'Добавление сообщения',
            resizable: false,
            draggable: false,
            show: {effect: 'slide', duration: 700},
            hide: {effect: 'clip', duration: 700},
            buttons: {
                "Добавить отзыв": function () {
                    var commentAuthor = $.trim($('#comment_author').val()),
                        commentText = $.trim($('#comment_text').val()),
                        parent = $('#parent').val(),
                        productId = <?=$product_id?>;
                    if (commentText == '' || commentAuthor == '') {
                        alert('Не заполнены все поля!');
                        return;
                    }
                    $('#comment_text').val('');
                    $(this).dialog('close');
                    $.ajax({
                        url: '<?=PATH?>add_comment',
                        type: 'POST',
                        data: {commentAuthor: commentAuthor, commentText: commentText, parent: parent, productId: productId},
                        success: function (res) {
                            var result = JSON.parse(res);
                            console.log(result);
                        },
                        error: function () {
                            alert("Ошибка!");
                        }
                        
                    });
                },
                "Отмена": function () {
                    $(this).dialog('close');
                    $('#comment_text').val('');
                }
            }
        });
        $(".open-form").click(function () {
            $("#form-wrap").dialog('open');
            var parent = $(this).attr('data');
            if (!parseInt(parent)) parent = 0;
            $('input[name="parent"]').val(parent);
        });
    })
</script>
</body>
</html>

