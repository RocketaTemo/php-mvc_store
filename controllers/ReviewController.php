<?php
class ReviewController{
    public function actionView($productAlias){

        $userId = User::checkLog();

        $product = Product::getProductByAlias($productAlias);

        $userInfo = User::getUserById($userId);

        //получаем список отзывов  товара
        $reviews = Review::getReviewListByProductId($product['id']);

        //поулучаем кол-во отзывов товара
        $qtyReviews = count(Review::getReviewListByProductId($product['id']));

        $text = '';
        $res = false;
		$errors = false;

        if (isset($_POST) and !empty($_POST)){
            $text = trim(strip_tags($_POST['comment']));

            if (!Review::checkText($text))
                $errors[] = "Текст комментария должен быть длинее 5 и короче 255 символов.";

            if (!$errors)
				$res = Review::createReview($userId, $product['id'], $text);

        }

        require_once ROOT . '/views/review/review.php';
        return true;
    }
}