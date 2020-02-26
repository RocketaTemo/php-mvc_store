<?php
include (ROOT . '/views/parts/header.php');
?>
<section>
    <div class="container">
        <div id="cab_content">
        <h2>Личный кабинет</h2>
        <h4 id="cabinet_greeting">Здравствуйте, <?=$userInfo['last_name'] .' '. $userInfo['first_name'] ;?></h4>
        <ul id="cabinet_list">
            <li><a href="/cabinet/edit">Изменить контактную информацию</a></li>
            <li><a href="/cabinet/edit/password">Изменить пароль</a></li>
            <li><a href="/cabinet/orders">Список покупок</a></li>
            <?php if($userInfo['role']=='admin'):?>
            <li><a href="/admin">Админка</a></li>
            <br><br>
            <li><a href="/user/logout">Выход</a></li>
            <?php endif; ?>
        </ul>
        </div>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer.php');
?>