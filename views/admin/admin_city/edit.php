<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container">
        <h2>Редактировать город <?php echo $city['name']?></h2>
        <form action="#" method="post" id="add_form" enctype="multipart/form-data">

            <p>Название города</p>
            <input required type="text" name="name" value="<?php echo $city['name']?>">

            <p>Область</p>
            <input required type="text" name="region" value="<?php echo $city['region']?>">

            
            <p>Индекс</p>
            <input required type="text" name="postcode" value="<?php echo $city['postcode']?>">

            <input type=submit name="submit" value="Сохранить" id="add_btn">
        </form>
    </div>
</section>
<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
