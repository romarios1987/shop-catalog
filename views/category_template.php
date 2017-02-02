<?php defined("CATALOG") or die("Access denied"); ?>
<li>
    <a href="<?=PATH?>category/<?=$category['alias']?>"><?=$category['title']?></a>
    <?php if (isset($category['childs']) && $category['childs']): ?>
        <ul>
            <?php echo categories_to_string($category['childs'])?>
        </ul>
    <?php endif; ?>
</li>
