<?php
/*Структура таблицы комментариев!
comment_id - № комментария
comment_author - автор комментария
comment_text - текст комментария
parent_id - ID родительского комментария(0)
comment_product - ID продукта, к которому относится комментарий
approved - модерация комментария
created_date - дата комментария
is_admin - принадлежит ли комментарий админ сайта*/
?>
<?php defined("CATALOG") or die("Access denied"); ?>
<li>
    <div class="comment-content<?php if ($category['is_admin']) echo ' manager' ?>">
        <div class="comment-meta">
            <span class="author"><?= htmlspecialchars($category['comment_author']); ?></span>
            <span class="date"><?= $category['created_date'] ?></span>
        </div>
        <div class="comment-text">
            <p><?= nl2br(htmlspecialchars($category['comment_text'])); ?></p>
            <a class="open-form reply" data="<?= $category['comment_id'] ?>">Ответить</a>
        </div>
    </div>
    <?php if (isset($category['childs']) && $category['childs']): ?>
        <ul>
            <?php echo categories_to_string($category['childs'], 'comments_template.php') ?>
        </ul>
    <?php endif; ?>

</li>

