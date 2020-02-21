<?php
include (ROOT . '/views/parts/header.php');
?>
<section>
    <div class="container">
            <?php if($res):?>
                <h4 id="edit_thanks">Персональные данные сохранены</h4>
                <h3 id="to_cabinet">Вернуться в <a href="/cabinet" id="reg_main_a">Кабинет</a></h3>
            <?php else: ?>

            <?php if (isset($errors) && is_array($errors)):?>
                <ul class="errors">
                    <?php foreach($errors as $error):?>
                        <li> - <?php echo $error;?></li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>

            <form action="#" method="post" id="edit_form">
                <h2>Редактирование личных данных</h2>
                <p>Имя</p>
                <input type="text" name="first_name" value= <?= $userInfo['first_name']?>>
                <p>Фамилия</p>
                <input type="text" name="last_name" value= <?= $userInfo['last_name'] ?>>
                <p>Электронная почтa</p>
                <input type="email" name="email" value= <?= $userInfo['email'] ?>>
                <p>Телефон</p>
                <input type="text" name="phone" placeholder= <?= $userInfo['phone'] ?>>
                <p>Адрес доставки</p>
                <select name = "city_id">
                    <?php $city = City::getCityById($userInfo['city_id'])?>
                    <option value = <?php echo $userInfo['city_id'] ?>> <? echo $city['name'] ?>  </option>
                    <?php foreach ($cities as $city): ?>
                    <option value = <?php echo $city['id'] ?>> <? echo $city['name'] ?>  </option>
					<?php endforeach; ?>
                </select>
                <select name = "postoffice_id">
                    <?php $postoffice = PostOffice::getPostById($userInfo['postoffice_id'])?>
                    <option value = <?php echo $userInfo['postoffice_id'] ?>> <? echo $postoffice['name'] ?>  </option>
                    <?php foreach ($postoffices as $fostoffice): ?>
                    <option value = <?php echo $fostoffice['id'] ?>> <? echo $fostoffice['name'] ?>  </option>
					<?php endforeach; ?>
                </select>
                <input type=submit name="submit" value="Сохранить" id="save_btn">
            </form>
        <?php endif;?>
    </div>
</section>
<div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer.php');
?>
