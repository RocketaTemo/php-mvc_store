<?php
class PostOffice{
    //Получение списка городов
    public static function getPostList () {
        $db = Db::getConnect();
        $sql = "
                SELECT id, city_id, name, location, postcode FROM postoffice
                ORDER BY id ASC
                ";
        $res = $db->query($sql);
        $posts = $res->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public static function getPostListByCityId ($cityId) {
        $db = Db::getConnect();
        $sql = "
                SELECT id, city_id, name, location, postcode FROM postoffice where city_id = :city_id
                ORDER BY id ASC
                ";
        $res = $db->prepare($sql);
        $res -> bindParam(':city_id', $cityId, PDO::PARAM_INT);
        $res->execute;
        $cities = $res->fetchAll(PDO::FETCH_ASSOC);
        return $cities;
    }
    //Добавить город
    public static function addPost($options){
        $db = Db::getConnect();

        $sql = "INSERT INTO postoffice(city_id, name, location, postcode)
            VALUES(:city_id, :name, :location, :postcode)
        ";
        $res = $db->prepare($sql);
        $res -> bindParam(':city_id', $options['city_id'], PDO::PARAM_INT);
        $res -> bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res -> bindParam(':location', $options['name'], PDO::PARAM_STR);
        $res -> bindParam(':postcode', $options['postcode'], PDO::PARAM_INT);
        //Если запрос выполнен успешно
        return $res->execute();
    }
    //Редактировать город
    public static function editPost($postId, $options){
        $db = Db::getConnect();
         $sql = "UPDATE postoffice
         SET
            city_id = :city_id
             name = :name,
             location = :location,
             postcode = :postcode,
         WHERE id = :id
         ";
        $res = $db->prepare($sql);
        $res -> bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res -> bindParam(':location', $options['location'], PDO::PARAM_STR);
        $res -> bindParam(':postcode', $options['postcode'], PDO::PARAM_INT);
        $res -> bindParam(':id', $postId, PDO::PARAM_INT);
        //Если запрос выполнен успешно
        return $res->execute();
    }
    //Удалить город
    public static function deletePost($postId)
    {
        $db = Db::getConnect();

        $sql = "DELETE FROM postoffice WHERE id = :id";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $postId, PDO::PARAM_INT);
        return $res->execute();
    }
    //Получить город по id
    public static function getPostById ($postId) {

        $db = Db::getConnect();

        $sql = "SELECT id, city_id, name, location, postcode FROM postoffice
                    WHERE id = :id
               ";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $postId, PDO::PARAM_INT);
        $res->execute();
        $post = $res->fetch(PDO::FETCH_ASSOC);
        return $post;
    }



}