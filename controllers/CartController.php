<?php

//Контроллер для работы с корзиной
class CartController
{
    /**
     * Добавление товара в корзину
     * @param $productId
     */
    public function actionAdd($productId){
        echo Cart::addProduct($productId);
        return true;
    }

    //Удаление 1 ед товара из корзины
    public function actionMinus($productId){
        Cart::minusProduct($productId);
        return header('Location: /cart');
    }

    //Добавление 1 ед товара в корзину
    public function actionPlus($productId){
        Cart::plusProduct($productId);
        return header('Location: /cart');
    }

    //Удаление товара из корзины
    public function actionDelete($productId){
        Cart::delProduct($productId);
        return header('Location: /cart');
    }
    
    /**
     * Главная страница корзины
     * @return bool
     */
     public function actionIndex (){

        $productsInCart = false;

        //Получаем данные из корзины
        $productsInCart = Cart::getProducts();
        if($productsInCart){

            //Получаем полную информацию о товаре
            $productsId = array_keys($productsInCart);

            $products = Product::getProductsById($productsId);

            //Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once ROOT . '/views/cart/index.php';

        return true;
    }

    //оформление заказа
    public function actionCheckout(){
        $productsInCart = Cart::getProducts(); 
        if($productsInCart == false){
            header('Location: /');
        }

        //Общая стоимость
        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsById($productsIds);
        $totalPrice = Cart::getTotalPrice($products);

        //Кол-во товаров
        $totalQuantity = Cart::itemsCount();

        //Поля для формы
        $userInfo='';
        $userName ='';
        $userPhone = '';
        $userText = '';

        //Статус успешного оформления заказа
        $res = false;
        
        //Проверка на авторизацию
        if(!User::isGuest()){
            //если не гость, получаем данные о пользователе из БД
            $userId = User::checkLog();
            $userInfo = User::getUserById($userId);
            $userName = $userInfo['first_name'];
            $userPhone = $userInfo['phone'];
        }else $userId = false; //Если гость, то поля формы будут пустыми

        //Обработка формы
        if (isset($_POST) and !empty($_POST)) {
            $userName = trim(strip_tags($_POST['first_name']));
            $userPhone = trim(strip_tags($_POST['phone']));
            $userCity = trim(strip_tags($_POST['city']));
            $userPostal = trim(strip_tags($_POST['postal']));
            $userText = trim(strip_tags($_POST['comment']));

            //Флаг ошибок
            $errors = false;
            //Валидация полей
            if (!User::checkFirstName($userName)) {
                $errors[] = 'Имя не может быть короче 2-х символов';
            }

            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Введите корректный номер';
            }

            if (!$errors) {
                // Если ошибок нет
                // Сохраняем заказ в БД
                $res = Order::save($userId, $userName, $userPhone, $userCity, $userPostal, $productsInCart, $userText);

                if ($res) {
                    // Если заказ успешно сохранен
                    // Оповещаем администратора о новом заказе по почте
                    $adminEmail = 'RocketaTemo@gmail.com';
                    $message = '<a href="http://vape.shop/admin/orders">Список заказов</a>';
                    $subject = 'Новый заказ!';
                    mail($adminEmail, $subject, $message);

                    // Очистка корзины
                    Cart::clear();
                }
            }
        }
        require_once ROOT . '/views/cart/checkout.php';
        return true;
    }
}