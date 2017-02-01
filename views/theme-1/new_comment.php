

<div class='comment-content <?php if ($comment['is_admin'])echo "manager" ?>'>
    <div class='comment-meta'>
        <span class='author'><?=htmlspecialchars($comment['comment_author']) ?></span>
        <span class='date'><?=$comment['created_date'] ?></span>
    </div>

    <div class='comment-text'><p>
            <?= nl2br(htmlspecialchars($comment['comment_text'])) ?></p>
    </div>

</div>