<?php
include (ROOT . '/views/parts/header.php');
?>
<section>
    <div class="container">
            <?php if($res):?>
                <h4 id="edit_pass_thanks">Пароль успешно изменён</h4>
                <h3 id="to_cabinet">Вернуться в <a href="/cabinet" id="reg_main_a">Кабинет</a></h3>
            <?php else: ?>
            <?php if (isset($errors) && is_array($errors)):?>
                <ul class="errors">
                    <?php foreach($errors as $error):?>
                        <li> - <?php echo $error;?></li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>

            <form action="#" method="post" id="edit_pass_form">
                <h2>Смена пароля</h2>
                <p>Введите текущий пароль </p>
                <input type="password" name="current_pass">
                <p>Придумайте новый пароль </p>
                <input type="password" name="new_pass1">
                <p>Новый пароль еще раз</p>
                <input type="password" name="new_pass2">
                <input type=submit name="submit" value="Сохранить" id="save_btn">
            </form>
        <?php endif;?>
    </div>
</section>
<div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer.php');
?>
