<?php
include (ROOT . '/views/parts/header.php');
?>
<section id="cart_section">
    <div class="container">
        <!--main content-->
        <div class="content">
            <h2>Корзина</h2>

            <?php if ($res): ?>
                <p>Заказ оформлен. Мы Вам перезвоним.</p>
            <?php else: ?>

            <p>Выбрано товаров: <?php echo $totalQuantity; ?>, на сумму: <?php echo $totalPrice; ?> грн</p><br/>
            <?php if (isset($errors) && is_array($errors)):?>
                <ul class="errors" id="error_checkout">
                    <?php foreach($errors as $error):?>
                        <li> - <?php echo $error;?></li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>
            <form action="#" method="post" id="checkout_form">
                <p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>
                <input required type="text" name="first_name" placeholder="Введите имя" value="<?=$userName?>">
                <input required type="phone" name="phone" value = "<?=$userPhone?>" placeholder="Телефон в формате: 0(xx)-xxx-xx-xx">
                <input required type="text" name="city" placeholder="Город доставки" >
                <input required type="text" name="postal" placeholder="Отделение Новой Почты">
                <textarea name="comment" placeholder="Комментарий к заказу"></textarea>
                <input type=submit name="submit" value="Оформить заказ" id="check_btn">
            </form>

            <?php endif;?>
        </div>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer.php');
?>
