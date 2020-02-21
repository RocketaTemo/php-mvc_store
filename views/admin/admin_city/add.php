<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container">
        <h2>Добавить новый город</h2>
            <form action="#" method="post" id="add_form">
                <p>Название города</p>
                <input required type="text" name="name">

                <p>Регион</p>
                <input required type="text" name="region">

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
