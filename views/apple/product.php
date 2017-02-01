
<?php require_once 'header.php'; ?>

<div class="page-wrap"> <!-- class="page-wrap" -->

    <div class="content">
        <ul class="breadcrumbs">
            <?=$breadcrumbs_list;?>
        </ul>

        <div class="content-page">
            <h1 class="product_title"><?=$get_one_product['title']?></h1>

            <div class="img-product">
                <img src="<?=PATH . PRODUCTIMG . $get_one_product['image']?>" alt="<?=$get_one_product['title']?>" />
            </div>

            <div class="product-txt">
                <?=$get_one_product['content']?>
            </div>
            <div class="clr"></div>
            <div class="product-inf">
                Просмотров: 210  /  Комментариев: <?=$count_comments;?>
            </div>
        </div><!--content-page-->



    </div> <!-- class="content" -->

    <?php require_once 'sidebar.php';?>

</div> <!-- class="page-wrap" -->

<?php require_once 'footer.php';?>