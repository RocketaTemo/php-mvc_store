<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<div class="container_admin_del">
    <?php $city = City::getCityById($cityId) ?>
    <h4>Удалить город <?php echo $city['name']; ?></h4>
    <p>Вы действительно хотите удалить этот город?</p>
    <form method="post">
        <input type="submit" name="submit" value="Удалить" />
    </form>
</div>
<div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
