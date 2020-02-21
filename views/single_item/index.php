<?php
include(ROOT . '/views/parts/header.php');
?>
<section>
    <div class="container">
        <!--main content-->
        <ul class="breadcrumbs"><?= $breadcrumbs;?></ul>
        <div class="content">
                <div class="product_info">
                    <div class="single_product_img">
                        <img alt="" src="<?= Product::getImage($product['id']); ?>" />
                    </div>
                    <div class="single_product_details">
                            <h2><?= $product['name']?></h2>
                            <p class="code">Код товара: <?= $product['id']?></p>
                            <p class="item_price"><?= $product['price']?>&nbsp;грн</p>
                            <div id="input_div">
                                <a href="#" class="to_cart" data-id="<?= $product['id'];?>">
                                   Купить</a>
                            </div>
                            <?php if ($product['availability'] == 1):?>
                                <p><b>Наличие:</b> На складе</p>
                            <?php else:?>
                                <p><b>Наличие:</b> Под заказ</p>
                            <?php endif; ?>
                            <p><b>Состояние:</b> Новое</p>
                            <p><b>Производитель: </b><?php echo $product['brand']?></p>
                    <div class = "product_review">
                    <h3>Отзывы покупателей: <?=$qtyReviews?></h3>
                        <?php foreach ($reviews as $review):?>
                        <?php $user = User::getUserById($review['user_id'])?>
                        <p class="name">Name: <?php echo $user['first_name']?></p>
                        <p class="date">Date: <?php echo $review['date']?></p>
                        <p class="text">Text: <?php echo $review['text']?></p>
                        <br/>
                        <?php endforeach;?>
                        <a href="/reviews/<?php echo $product['alias'];?>">
                             Смотреть все отзывы
                        </a>
                    </div></div>
                </div>
                    </div>
                    <div class = "product_description">
                            <h2>Описание</h2>
                            <p><?=$product['description']?></p>

        </div>
    </div></div>
</section>
<div class="appendix"></div>
<?php
include(ROOT . '/views/parts/footer.php');
?>
