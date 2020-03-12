<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container_admin_order_info">

        <h2>Просмотр заказа #<?=$order['id']?></h2>
        <h4>Информация о заказе</h4>

        <table id="admin_order_show" cellspacing="0">

            <tr>
                <td>Номер заказа :</td>
                <td><?=$order['id']?></td>
            </tr>

            <tr>
                <td>Имя клиента :</td>
                <td><?=$order['user_name']?></td>
            </tr>

            <tr>
                <td>Телефон клиента :</td>
                <td><?=$order['user_phone']?></td>
            </tr>

            <tr>
                <td>Город доставки :</td>
                <td><?=$order['user_city']?></td>
            </tr>

            <tr>
                <td>Отделения НП :</td>
                <td><?=$order['user_postal']?></td>
            </tr>

            <tr>
                <td>Комментарий клиента :</td>
                <td><?=$order['user_text']?></td>
            </tr>

            <tr>
                <td>ID клиента :</td>
                <td><?=$order['user_id']?></td>
            </tr>

            <tr>
                <th>Дата заказа :</th>
                <td><?=$order['date']?></td>
            </tr>

            <tr>
                <th>Статус заказа :</th>
                <td><?=Order::getStatusText($order['status'])?></td>
            </tr>

        </table>

        <h3>Товары в заказе</h3>

        <table id="admin__order_product_list" cellspacing="1">
            <tr>
                <th>ID товара</th>
                <th>Код товара</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
            <?php foreach ($products as $product):?>
                <tr>
                    <td><?php echo $product['id']?></td>
                    <td><?php echo $product['id'];?></td>
                    <td><?php echo $product['name'];?></td>
                    <td><?php echo $product['price'];?></td>
                    <td><?php echo $productQuantity[$product['id']];?></td>

                </tr>
            <?php endforeach;?>
        </table>
    </div>
</section>
<div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
