<!-- <script src="<?php ROOT?>/template/js/main.js"></script> -->

<?php foreach($products as $product):?>
<div class="product-item">
    <a href="/product/<?=$product['alias']?>">
        <img alt="" width="268px" height="249px" src="<?=Product::getImage($product['alias']); ?>" /></a>
    <div class="product-list">
        <a href="/product/<?=$product['alias']?>">
            <div class="product-name">
                <h3><?=$product['name']?></h3>
            </div>
        </a>
        <span class="item_price">Цена: <?=$product['price']?>&nbspгрн</span>
        <a href="#" class="to_cart" data-id="<?=$product['id'];?>">
            Купить
        </a>
    </div>
</div>
<?php endforeach;?>