<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container_admin">

        <h4 id="admin_list_h4">Список заказов</h4>
        <table id="admin_product_list" cellspacing="0">
            <tr>
                <th>ID заказа</th>
                <th>Имя покупателя</th>
                <th>Телефон покупателя</th>
                <th>Дата оформления</th>
                <th>Статус</th>
                <th colspan="3">Управление</th>
            </tr>

            <?php foreach ($orders as $order):?>
                <tr>
                    <td><?=$order['id']?></td>
                    <td><?=$order['user_name']?></td>
                    <td><?=$order['user_phone']?></td>
                    <td><?=$order['date']?></td>
                    <td>
                        <?=Order::getStatusText($order['status']);?>
                    </td>
      

                    <td><a target="_blank" title="Просмотр" href="/admin/orders/view/<?=$order['id']?>" class="del">
                            <img src="../../template/images/view.png" alt="">
                        </a></td>

                    <td><a target="_blank" title="Редактировать" href="/admin/orders/edit/<?=$order['id']?>" class="del">
                            <img src="../../template/images/edit.png" alt="">
                    </a></td>

                    <td><a title="Удалить" href="/admin/orders/delete/<?=$order['id']?>" class="del">
                            <img src="../../template/images/del.png" alt="">
                    </a></a>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</section>
<div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
