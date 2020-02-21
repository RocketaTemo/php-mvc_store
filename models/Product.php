<?php
/**
 * Модель для работы с товарами
 */
class Product
{
    /**
     * Выводим товары по выбранной категории
     * @param $catAlias ид. категории
     * @return array
     */
    public static function getProductListByCatId ($catId, $sql_parts = NULL, $sort = NULL){
        switch ($sort){
            case 'popular':
            $sort = 'ORDER BY count DESC';
            break;

            case 'newest':
            $sort = 'ORDER BY datetime DESC';
            break;

            case 'price-asc':
            $sort = 'ORDER BY price ASC';
            break;

            case 'price-desc':
            $sort = 'ORDER BY price DESC';
            break;
            default: $sort = 'ORDER BY price ASC'; break;
        }
        $db = Db::getConnect();

        $sql = "SELECT * FROM products
                   WHERE cat_id = :id AND alias IS NOT NULL
                    $sql_parts $sort
                ";

        $res = $db->prepare($sql);

        $res->bindParam(':id', $catId, PDO::PARAM_INT);

        $res->execute();

        //Получение и возврат результатов

        $products = $res->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }


    /**
     * Выводит списко всех товраов
     *
     * @return array
     */
    public static function getProductsList () {

        $db = Db::getConnect();

        $sql = "
                SELECT id, name, price FROM products
                ORDER BY id ASC
                ";

        $res = $db->query($sql);

        $products = $res->fetchAll(PDO::FETCH_ASSOC);
        return $products;

        return $products;
    }


    /**
     * Выбираем товар по идентификатору
     * @param $productId
     * @return mixed
     */
    public static function getProductByAlias($productAlias) {

        $db = Db::getConnect();

        $sql = "
               SELECT * FROM products
                    WHERE alias = :alias
               ";

        $res = $db->prepare($sql);
        $res->bindParam(':alias', $productAlias, PDO::PARAM_STR);
        $res->execute();

        $product = $res->fetch(PDO::FETCH_ASSOC);
        return $product;
    }

    public static function getProductsById ($productsIds){
        $db = Db::getConnect();
        //Разбиваем пришедший массив в строку
        $stringIds = implode(',', $productsIds);

        $sql = "
               SELECT id, name, price FROM products WHERE id IN ($stringIds)
               ";

        $res = $db->query($sql);

        $products = $res->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage ($id) {

        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/img/products/';

        // Путь к изображению товара
        $pathToProductImg = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImg)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImg;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

    public static function addProduct($options){
        $db = Db::getConnect();

        $sql = "INSERT INTO products(categoryName, name, price,
                            availability, brand, description)
            VALUES(:category, :name, :price,
                            :availability, :brand, :description)
        ";
        $res = $db->prepare($sql);

        $res -> bindParam(':category', $options['category'], PDO::PARAM_STR);
        $res -> bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res -> bindParam(':price', $options['price'], PDO::PARAM_INT);
        $res -> bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $res -> bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $res -> bindParam(':description', $options['description'], PDO::PARAM_STR);

        //Если запрос выполнен успешно
        if ($res->execute()) {
            //Возвращаем id последней записи, позже, в контроллере переходим на страницу этого товара, если все успешно
            return $db->lastInsertId();
        } else {
            return 0;
        }
    }
    public static function editProduct($productId, $options){
        $db = Db::getConnect();

        $sql = "
            UPDATE products
            SET
                categoryName = :category,
                name = :name,
                price = :price,
                availability = :availability,
                brand = :brand,
                description =  :description
            WHERE id = :id
            ";
        $res = $db->prepare($sql);
        $res -> bindParam(':category', $options['category'], PDO::PARAM_STR);
        $res -> bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res -> bindParam(':price', $options['price'], PDO::PARAM_INT);
        $res -> bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $res -> bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $res -> bindParam(':description', $options['description'], PDO::PARAM_STR);
        $res -> bindParam(':id', $productId, PDO::PARAM_INT);

        return $res->execute();
    }

    public static function deleteProduct($productId)
    {
        $db = Db::getConnect();

        $sql = "DELETE FROM products WHERE id = :id";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $productId, PDO::PARAM_INT);
        return $res->execute();
    }

    //Живой поиск по сайту
    public static function findProductsByKeywords($keywords){
        $db = Db::getConnect();

        $sql = "
                SELECT id, name FROM products
                  WHERE name LIKE :keywords LIMIT 10
                ";

        $res = $db->prepare($sql);

        $res->execute(array(':keywords' => '%'.$keywords.'%'));

        //Получение и возврат результатов
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}