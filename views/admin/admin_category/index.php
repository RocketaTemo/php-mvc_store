<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container_admin">
        <a href="/admin/category/add" class="add_cat">
            Добавить категорию
        </a>
        <h4 id="admin_list_h4">Список категорий</h4>
        <table id="admin_product_list" cellspacing="0">
            <tr>
                <th>ID категории</th>
                <th>Название категории</th>
            </tr>

            <?php foreach ($categories as $category):?>
                <tr>
                    <td><?php echo $category['uriName']?></td>
                    <td><?php echo $category['name']?></td>
                    <td>
                    </td>
                    <td><a title="Редактировать" href="/admin/category/edit/<?php echo $category['uriName']?>" class="del">
                            <img src="../../template/images/edit.png" alt="">
                        </a></td>
                    <td><a title="Удалить" href="/admin/category/delete/<?php echo $category['uriName']?>" class="del">
                            <img src="../../template/images/del.png" alt="">
                        </a></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</section>
<div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
