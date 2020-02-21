<?php
/**
 * Модель для работы с каталогом
 */
class Category
{
    /**
    * @return array список категорий
    */
    public static function getCategories () {
        $db = Db::getConnect();
        $arr_cat = [];
        $sql = "SELECT * FROM categories";

        $res = $db->query($sql);

        while ($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            $arr_cat[$row['id']] = $row;
        }
        return $arr_cat;
    }

    public static function getCategoryByAlias($catAlias) {

        $db = Db::getConnect();

        $sql = "
               SELECT * FROM categories
                    WHERE alias = :alias
               ";

        $res = $db->prepare($sql);
        $res->bindParam(':alias', $catAlias, PDO::PARAM_STR);
        $res->execute();

        $category = $res->fetch(PDO::FETCH_ASSOC);
        return $category;
    }
}