<?php
include (ROOT . '/views/parts/header.php');
?>
<section>
    <div class="container">
        <input type=submit name="submit" value="Оставить комментарий" id="add_review_btn">
    <div class="content">
        <div class = "comment">
            <h2>Отзывы покупателей о <?php echo $product['name'].' ('.$qtyReviews;?>)</h2>
            <?php foreach($reviews as $review):?>
            <?php $user = User::getUserById($review['user_id'])?>
            <p class="name">Name: <?php echo $user['first_name']?></p>
            <p class="date">Date: <?php echo $review['date']?></p>
            <p class="text">Text: <?php echo $review['text']?></p>
            <?php endforeach;?>
        </div>
        <?php if (isset($errors) && is_array($errors)): ?>
            <ul class="errors">
				<?php foreach ($errors as $error): ?>
                    <li> - <?php echo $error; ?></li>
				<?php endforeach; ?>
            </ul>
		<?php endif; ?>
        <form action="#" method="post" id="add_review">
                <label for="comment">Комментарий</label>
                <input required type="text" name="comment">
            <?php if($userId): ?>
                <label for="username">Ваше имя</label>
                <input required type="text" name="first_name" value="<?=$userInfo["first_name"]?>">
                <label for="email">Эл. почта</label>
                <input required readonly type="email" name="email" value="<?=$userInfo["email"]?>">
            <?php else: ?>
                <label for="username">Ваше имя</label>
                <input required type="text" name="first_name">
                <label for="email">Эл. почта</label>
                <input required type="email" name="email">
            <?php endif; ?>
            <input type="submit" name="submit" value="Оставить отзыв" id="review_btn">
        </form>
    </div>

    </div>
</section>