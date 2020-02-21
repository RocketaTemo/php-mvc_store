<?php
class City{
    //Получение списка городов
    public static function getCitiesList () {
        $db = Db::getConnect();
        $sql = "
                SELECT id, name, region, postcode FROM cities
                ORDER BY id ASC
                ";
        $res = $db->query($sql);
        $cities = $res->fetchAll(PDO::FETCH_ASSOC);
        return $cities;
    }
    //Добавить город
    public static function addCity($options){
        $db = Db::getConnect();

        $sql = "INSERT INTO cities(name, region, postcode)
            VALUES(:name, :region, :postcode)
        ";
        $res = $db->prepare($sql);
        $res -> bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res -> bindParam(':region', $options['region'], PDO::PARAM_STR);
        $res -> bindParam(':postcode', $options['postcode'], PDO::PARAM_INT);
        //Если запрос выполнен успешно
        return $res->execute();
    }
    //Редактировать город
    public static function editCity($cityId, $options){
        $db = Db::getConnect();
         $sql = "UPDATE cities
         SET
             name = :name,
             region = :region,
             postcode = :postcode,
         WHERE id = :id
         ";
        $res = $db->prepare($sql);
        $res -> bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res -> bindParam(':region', $options['region'], PDO::PARAM_STR);
        $res -> bindParam(':postcode', $options['postcode'], PDO::PARAM_INT);
        $res -> bindParam(':id', $cityId, PDO::PARAM_INT);
        //Если запрос выполнен успешно
        return $res->execute();
    }
    //Удалить город
    public static function deleteCity($cityId)
    {
        $db = Db::getConnect();

        $sql = "DELETE FROM cities WHERE id = :id";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $cityId, PDO::PARAM_INT);
        return $res->execute();
    }
    //Получить город по id
    public static function getCityById ($cityId) {

        $db = Db::getConnect();

        $sql = "SELECT id, name, region, postcode
                 FROM cities
                    WHERE id = :id
               ";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $cityId, PDO::PARAM_INT);
        $res->execute();

        $city = $res->fetch(PDO::FETCH_ASSOC);
        return $city;
    }

    public static function getCityByName ($cityName) {

        $db = Db::getConnect();

        $sql = "SELECT id, name, region, postcode
                 FROM cities
                    WHERE name = :name
               ";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $cityName, PDO::PARAM_STR);
        $res->execute();
        $city = $res->fetch(PDO::FETCH_ASSOC);
        return $city;
    }

}