<?php

/**
 *Контроллер для просмотра и управления списком всех товаров, имеющихся в базе
 */
class AdminProductController extends AdminBase {

    /**
     * Просмотр всех товаров
     * @return bool
     */
    public function actionIndex () {

        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        //выводим список всех товаров
        $products = Product::getProductsList();

        require_once ROOT . "/views/admin_product/index.php";
        return true;
    }
    /**
     * Добавление товара
     * @return bool
     */
    public function actionAdd () {
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        //Список категорий для выпадающего списка
        $categories = Category::getCategoryListAdmin();

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['price'] = trim(strip_tags($_POST['price']));
            $options['category'] = trim(strip_tags($_POST['category']));
            $options['brand'] = trim(strip_tags($_POST['brand']));
            $options['description'] = trim(strip_tags($_POST['description']));
            $options['availability'] = trim(strip_tags($_POST['availability']));
            //Если все ок, записываем новый товар
            $id = Product::addProduct($options);

            // Если запись добавлена
            if ($id) {
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папку, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            };
            header('Location: /admin/product');
        }
        require_once ROOT . '/views/admin_product/add.php';
        return true;
    }
    /**
     * Редактирование товара
     * @return bool
     */
    public function actionEdit ($productId) {
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        //Получаем список категорий для выпадающего списка
        $categories = Category::getCategoryListAdmin();

        //Получаем информацию о выбранном товаре
        $product = Product::getProductById($productId);

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['price'] = trim(strip_tags($_POST['price']));
            $options['category'] = trim(strip_tags($_POST['category']));
            $options['brand'] = trim(strip_tags($_POST['brand']));
            $options['description'] = trim(strip_tags($_POST['description']));
            $options['availability'] = trim(strip_tags($_POST['availability']));

            Product::editProduct($productId, $options);

            header('Location: /admin/product');
        }

        require_once ROOT . '/views/admin_product/edit.php';
        return true;
    }

    /**
     * Удаление товара из БД
     * @return bool
     */
    public function actionDelete($productId){

        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        //Проверяем форму
        if (isset($_POST['submit'])) {
            //Если отправлена, то удаляем нужный товар
            Product::deleteProduct($productId);
            //и перенаправляем на страницу товаров
            header('Location: /admin/product');
        }

        require_once ROOT . '/views/admin_product/delete.php';
        return true;
    }
}