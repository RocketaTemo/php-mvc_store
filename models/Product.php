<?php
/**
 * Модель для работы с товарами
 */
class Product
{
    /**
     * Выводим товары по выбранной категории
     * @param $catId ид. категории
     * @return array
     */
    public static function getProductListByCatId ($catId, $sql_parts = NULL, $sort = NULL){
        $db = Db::getConnect();
        $sql = false;
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
        if($catId <= 4){
        $sql = "SELECT p.id, p.cat_id, p.name, p.alias, 
                CAST(p.price AS UNSIGNED) AS price,
                p.availability, p.brand, p.description, p.img,
                c.parent_id AS parent_id
                FROM products p LEFT JOIN categories c ON p.cat_id = c.id
                WHERE c.parent_id = :id 
                $sql_parts $sort";
        }
        else{
        $sql = "SELECT p.id, p.cat_id, p.name, p.alias, 
                CAST(p.price AS UNSIGNED) AS price,
                p.availability, p.brand, p.description, p.img
                FROM products p WHERE cat_id = :id
                $sql_parts $sort";
        }
        
        $res = $db->prepare($sql);
        $res->bindParam(':id', $catId, PDO::PARAM_INT);
        $res->execute();

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
    public static function getProductById($productId){
        $db = Db::getConnect();
        
        $sql = "
            SELECT * FROM products
                WHERE id = :id
        ";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $productId, PDO::PARAM_INT);
        $res->execute();

        $product = $res->fetch(PDO::FETCH_ASSOC);
        return $product;

    }

    public static function getProductsById ($productsIds){
        $db = Db::getConnect();
        //Разбиваем пришедший массив в строку
        $stringIds = implode(',', $productsIds);

        $sql = "
               SELECT id, alias, name, price FROM products WHERE id IN ($stringIds)
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
        $noImage = 'no-image.png';

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
    public static function addImage($id){

        $img = $id . 'jpg';

        $db = Db::getConnect();

        $sql = "
        UPDATE products
            SET img = :img
                WHERE id = :id
        ";

        $res = $db->prepare($sql);
        $res -> bindParam(':id', $id, PDO::PARAM_INT);
        $res -> bindParam(':img', $img, PDO::PARAM_STR);
        return $res->execute();
    }
    public static function addProduct($options){
        $db = Db::getConnect();

        $sql = "INSERT INTO products(cat_id, name , price,
                            availability, brand, description)
            VALUES(:category, :name, :price,
                            :availability, :brand, :description)
        ";
        $res = $db->prepare($sql);
        debug($options['category']);
        $res -> bindParam(':category', $options['category'], PDO::PARAM_STR);
        $res -> bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res -> bindParam(':price', $options['price'], PDO::PARAM_INT);
        $res -> bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $res -> bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $res -> bindParam(':description', $options['description'], PDO::PARAM_STR);
        
        //Если запрос выполнен успешно
        if ($res->execute()) {
            //Возвращаем id последней записи, позже, в контроллере переходим на страницу этого товара, если все успешно
            self::createAlias($db->lastInsertId(), $options['name']);
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
                cat_id = :cat_id,
                name = :name,
                price = :price,
                availability = :availability,
                brand = :brand,
                description =  :description
            WHERE id = :id
            ";
        $res = $db->prepare($sql);
        $res -> bindParam(':cat_id', $options['cat_id'], PDO::PARAM_INT);
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

    public static function createAlias($id, $str){
        $str = self::str2url($str)."-{$id}";
        $db = Db::getConnect();
        $sql = "
            UPDATE products
            SET alias = :alias
            WHERE id = :id
        ";
        $res = $db->prepare($sql);
        $res -> bindParam(':alias', $str, PDO::PARAM_STR);
        $res -> bindParam(':id', $id, PDO::PARAM_INT);
        return $res -> execute();
    }

    public static function str2url($str) {
        // переводим в транслит
        $str = self::rus2translit($str);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }

    public static function rus2translit($string) {

        $converter = array(

            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

            'и' => 'i',   'й' => 'y',   'к' => 'k',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'h',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',



            'А' => 'A',   'Б' => 'B',   'В' => 'V',

            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

            'И' => 'I',   'Й' => 'Y',   'К' => 'K',

            'Л' => 'L',   'М' => 'M',   'Н' => 'N',

            'О' => 'O',   'П' => 'P',   'Р' => 'R',

            'С' => 'S',   'Т' => 'T',   'У' => 'U',

            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

        );

        return strtr($string, $converter);

    }
}