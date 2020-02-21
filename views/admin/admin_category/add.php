<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container">
        <h2>Добавить новый товар</h2>
        <form action="#" method="post" id="add_form">

            <p>ID категории</p>
            <input required type="text" name="id">
            <p>Название категории</p>
            <input required type="text" name="name">

            <input type=submit name="submit" value="Сохранить" id="add_btn">
        </form>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
