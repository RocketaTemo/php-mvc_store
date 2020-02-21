<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container">
        <h2>Добавить новое отделение почты</h2>
            <form action="#" method="post" id="add_form">
                <p>Город</p>
                <input required type="text" name="city_id">

                <p>Название отделения</p>
                <input required type="text" name="name">

                <p>Адрес</p>
                <input required type="text" name="location">

                <p>Индекс</p>
                <input required type="text" name="postcode">

                <input type=submit name="submit" value="Сохранить" id="add_btn">
            </form>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
