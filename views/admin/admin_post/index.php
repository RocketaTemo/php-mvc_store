<?php
include (ROOT . '/views/parts/header_admin.php');
?>
<section>
<div class="container_admin">
    <a href="/admin/post/add" class="add_item">
        Добавить отделение почты
    </a>
    <h4 id="admin_list_h4">Список отделений почты</h4>
    <table id="admin_product_list"cellspacing="0">
        <tr>
            <th>id отедления</th>
            <th>Город</th>
            <th>Название</th>
            <th>Адрес</th>
            <th>Индекс</th>
        </tr>
        <?php foreach ($posts as $post):?>
        <?php $city=City::getCityById($post['city_id'])?>
        <tr>
            <td><?php echo $post['id']?></td>
            <td><?php echo $city['name']?></td>
            <td><?php echo $post['name']?></td>
            <td><?php echo $post['location']?></td>
            <td><?php echo $post['postcode']?></td>
            <td><a title="Редактировать" href="/admin/post/edit/<?php echo $post['id']?>" class="del">
                    <img src="../../template/images/edit.png" alt="">
                </a></td>
            <td><a title="Удалить" href="/admin/post/delete/<?php echo $post['id']?>" class="del">
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


