<?php
include (ROOT . '/views/parts/header_admin.php');
?>
<section>
<div class="container_admin">
    <a href="/admin/city/add" class="add_item">
        Добавить город
    </a>
    <h4 id="admin_list_h4">Список городов</h4>
    <table id="admin_product_list"cellspacing="0">
        <tr>
            <th>id города</th>
            <th>Название</th>
            <th>Область</th>
            <th>Индекс</th>
        </tr>
        <?php foreach ($cities as $city):?>
        <tr>
            <td><?php echo $city['id']?></td>
            <td><?php echo $city['name']?></td>
            <td><?php echo $city['region']?></td>
            <td><?php echo $city['postcode']?></td>
            <td><a title="Редактировать" href="/admin/city/edit/<?php echo $city['id']?>" class="del">
                    <img src="../../template/images/edit.png" alt="">
                </a></td>
            <td><a title="Удалить" href="/admin/city/delete/<?php echo $city['id']?>" class="del">
                <img src="../../template/images/del.png" alt="">
            </a></td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
</section>
<?php
include (ROOT . '/views/parts/footer_admin.php');
?>


