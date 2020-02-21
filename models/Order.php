<?php
//Модель для работі с заказами
class Order{

    //сохранение заказа в бд
    public static function save($userId, $userName, $userPhone, $productsInCart, $userText, $postofficeId){
        $conn = Db::getConnect();

        //Преобразовываем массив товаров в строку JSON
        $productsInCart = json_encode($productsInCart);
        $sql = "
            INSERT INTO orders (user_id, user_name, user_phone, user_text, products, postoffice_id
                VALUES (:userId, :userName, :userPhone, :userText, :products, :postoffice_id)
            ";
        $res = $conn->prepare($sql);
        $res->bindParam(':userId', $userId, PDO::PARAM_INT);
        $res->bindParam(':userName', $userName, PDO::PARAM_STR);
        $res->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $res->bindParam(':userText', $userText, PDO::PARAM_STR);
        $res->bindParam(':products', $productsInCart, PDO::PARAM_STR);
        $res->bindParam(':postoffice_id', $postofficeId, PDO::PARAM_INT);


        return $res->execute();
    }

    public static function getOrderByUserId($userId){
        $conn = Db::getConnect();
        $sql = "SELECT * FROM orders WHERE userId = :userId";

        $res = $conn->prepare($sql);
        $res->bindParam(':userId', $userId, PDO::PARAM_INT);
        $res ->execute();

        return $res->fetchAll(PDO::FETCH_ASSOC);;
    }

    public static function getStatusText($status){
        switch($status){
            case 1 : return "Заказ не обработан";
            case 2 : return "Заказ обработан";
            case 1 : return "Заказ отменен";
            default : return "Ошибка заказа";

        }
    }
}