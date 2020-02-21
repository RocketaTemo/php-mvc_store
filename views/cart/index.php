<?php
include (ROOT . '/views/parts/header.php');
?>
<section>
    <div class="container">
        <!--main content-->
        <div id="cart_content">
            <?php if($productsInCart):?>
                <h2>Корзина</h2>
                <p>Вы выбрали такие товары:</p>
                <table id="cart_products"cellspacing="0">
                    <tr>
                        <th>Код товара</th>
                        <th>Название</th>
                        <th>Стоимость, грн</th>
                        <th>Количество, шт.</th>
                        <th>Удалить</th>
                    </tr>

                    <?php foreach($products as $product):?>
                    <tr>
                        <td><?php echo $product['id'];?></td>
                        <td><a href="/product/<?php echo $product['id'];?>" class="cart_item">
                                <?php echo $product['name'];?>
                        </a></td>
                        <td><?php echo $product['price']?></td>
                        <td><?php echo $productsInCart[$product['id']];?></td>
                        <td><a href="/cart/delete/<?php echo $product['id'];?>" class="del">
                            <img src="../../template/images/del.png">
                        </a></td>
                    </tr>
                    <?php endforeach;?>
                    <tr id="total_sum">
                        <td>Общая стоимость, грн: </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $totalPrice;?></td>
                    </tr>
                </table>

                <a href="../cart/checkout" class="checkout">
                    Оформить заказ
                </a>
                <?php else:?>
                    <h2 id="empty_cart">Ваша корзина пуста</h2>
                    <a href="/" id="empty_cart_to_main">Продолжить покупки</a>
            <?php endif;?>
        </div>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer.php');
?>
