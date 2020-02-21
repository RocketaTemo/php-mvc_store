<?php

class Cart
{
     /**
     * Добавление товара в корзину
     * @param $id - id товара
     * @return int - количество товаров в корзине
     */
     public static function addProduct($productsIds) {
        $id = intval($productsIds);
        //Пустой массив для товаров в корзине (ключ - id товара, значение - кол-во)
        $productsInCart = array();

        //Если в корзине уже есть товары, заполняем массив
        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        //Если товар уже есть в корзине, но пользователь добавляет еще один,
        //то увеличиваем количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            //Добавляем новый товар в корзину
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::itemsCount();
    }

    //Получаем массив товаров из сессии
    public static function getProducts(){
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    //Удаляем продукт из корзины
    public static function delProduct($productId){

        //получаем массив товаров(Колво, id) из корзины
        $productsInCart = self::getProducts();

        //удаляем нужный товар по 1 единице
        if ($productsInCart[$productId] == 1) {
            unset($productsInCart[$productId]);
        } else {
            $productsInCart[$productId]--;
        }

        //записываем новый массив в сессию
        $_SESSION['products'] = $productsInCart;
    }

    //Подсчет кол-ва товаров в корзине
    public static function itemsCount(){

        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else
            return 0;
    }

    //Подсчет суммы всех товаров в корзине
    public static function getTotalPrice($products){

        $productsInCart = self::getProducts();
        $total = 0;
        if ($products) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        return $total;
    }
    //оформить заказ
    public static function clear(){
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }
}