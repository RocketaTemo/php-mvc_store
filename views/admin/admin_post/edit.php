<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container">
        <h2>Редактировать отделение почты <?php echo $post['name']?></h2>
        <form action="#" method="post" id="add_form" enctype="multipart/form-data">

            <p>Город</p>
            <?php $city=City::getCityById($post['city_id'])?>
            <input required type="text" name="city_id" value="<?php echo $city['name']?>">

            <p>Название отделения</p>
            <input required type="text" name="name" value="<?php echo $post['name']?>">

            <p>Адрес</p>
            <input required type="text" name="location" value="<?php echo $post['location']?>">
            
            <p>Индекс</p>
            <input required type="text" name="postcode" value="<?php echo $post['postcode']?>">

            <input type=submit name="submit" value="Сохранить" id="add_btn">
        </form>
    </div>
</section>
<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
