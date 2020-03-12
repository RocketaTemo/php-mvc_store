<?php
//Модель для работі с заказами
class Order{

    //сохранение заказа в бд
    public static function save($userId, $userName, $userPhone, $userCity, $userPostal, $productsInCart, $userText)
    {

        $conn = Db::getConnect();

        //Преобразовываем массив товаров в строку JSON
        $productsInCart = json_encode($productsInCart);
        $sql = "
            INSERT INTO orders (user_id, user_name, user_phone, user_city, user_postal, user_text, products)
                VALUES (:userId, :userName, :userPhone, :userCity, :userPostal, :userText, :products)
            ";
        $res = $conn->prepare($sql);
        $res->bindParam(':userId', $userId, PDO::PARAM_INT);
        $res->bindParam(':userName', $userName, PDO::PARAM_STR);
        $res->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $res->bindParam(':userCity', $userCity, PDO::PARAM_STR);
        $res->bindParam(':userPostal', $userPostal, PDO::PARAM_STR);
        $res->bindParam(':userText', $userText, PDO::PARAM_STR);
        $res->bindParam(':products', $productsInCart, PDO::PARAM_STR);

        return $res->execute();
    }

    public static function edit($order_id, $status)
    {
        $conn = Db::getConnect();

        $sql="
            UPDATE orders
            SET status = :status
            WHERE id = :order_id
            ";

        $res = $conn->prepare($sql);
        $res -> bindParam(':status', $status, PDO::PARAM_INT);
        $res -> bindParam(':order_id', $order_id, PDO::PARAM_INT);
        return $res -> execute();
    }

    public static function delete($orderId)
    {
        $db = Db::getConnect();

        $sql = "DELETE FROM orders WHERE id = :id";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $orderId, PDO::PARAM_INT);
        return $res->execute();
    }
    public static function getOrderByUserId($userId)
    {
        $conn = Db::getConnect();
        $sql = "SELECT * FROM orders WHERE user_id = :userId";

        $res = $conn->prepare($sql);
        $res->bindParam(':userId', $userId, PDO::PARAM_INT);
        $res->execute();

        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getOrderById($orderId)
    {
        $conn = Db::getConnect();
        $sql = "SELECT * FROM orders
                    WHERE id = :id";
        $res = $conn->prepare($sql);
        $res->bindParam(':id', $orderId, PDO::PARAM_INT);
        $res->execute();

        $data = $res->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getAllOrders()
    {
        $conn = Db::getConnect();
        
        $sql = "SELECT * FROM orders";
        $stmt = $conn->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getStatusText($status)
    {
        switch($status){
            case 1 : return "Заказ не обработан";
            case 2 : return "Заказ обработан";
            case 3 : return "Заказ отправлен";
            case 4 : return "Заказ отменен";
            default : return "Ошибка заказа";

        }
    }

}