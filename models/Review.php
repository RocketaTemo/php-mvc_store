<?php
// Класс для работы с комментариями
class Review{


    public static function createReview($userId, $productId, $text){
        $conn = Db::getConnect();

        $sql = "INSERT INTO reviews (product_id, user_id, text)
                    VALUES (:productId, :userId, :text)
                ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':text', $text, PDO::PARAM_STR);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);

		return $stmt->execute();
   }

   public static function checkText($text){
    if (strlen($text) < 255 and strlen($text) >= 3)
        return true;
    return false;
   }

   public static function getReviewListByProductId($productId) {
    $db = Db::getConnect();

    $sql = "SELECT * FROM reviews
                WHERE product_id = :id
            ";
    $res = $db->prepare($sql);
    $res->bindParam(':id', $productId, PDO::PARAM_INT);

    $res->execute();
    $reviews = $res->fetchAll(PDO::FETCH_ASSOC);
    return $reviews;
   }

   public static function getTopReviewListByProductId ($productId) {
    $db = Db::getConnect();
    $sql = "SELECT * FROM reviews
              WHERE product_id = :productId order by date desc limit 2
            ";
    $res = $db->prepare($sql);
    $res->bindParam(':productId', $productId, PDO::PARAM_INT);

    $res->execute();
    $reviews = $res->fetchAll(PDO::FETCH_ASSOC);
    debug($reviews);
    return $reviews;
}


}