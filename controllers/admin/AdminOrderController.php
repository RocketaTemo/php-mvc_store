<?php

class AdminOrderController extends AdminBase
{
    /**
     * Контроллер страницы заказов
     */
    public function actionIndex(){
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        //массив заказов
        $orders = Order::getAllOrders();   
        require_once ROOT . '/views/admin/admin_order/index.php';
    }

    /**
     * Контроллер просмотра информации заказа
     */
    public function actionView($orderId){
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");
        
        $order = Order::getOrderById($orderId);

        //Вытягиваем JSON строку заказанных товаров и преобразуем в массив
        $productQuantity = json_decode($order['products'], true);

        //Выбираем ключи (id товаров)
        $productIds = array_keys($productQuantity);

        $products = Product::getProductsById($productIds);
        
        require_once ROOT . '/views/admin/admin_order/view.php';
    }

    /**
     * Контроллер редактирования заказа
     */
    public function actionEdit($orderId){

        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        $order = Order::getOrderById($orderId);

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST))
        {
            $status = trim(strip_tags($_POST['status']));
            Order::edit($orderId, $status);
            header('Location: /admin/orders/edit/' . $orderId);
        }

        require_once ROOT . '/views/admin/admin_order/edit.php';
    }
    
    public function actionDelete($orderId)
    {
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        //Проверяем форму
        if (isset($_POST['submit'])) {
            //Если отправлена, то удаляем нужный товар
            Order::delete($orderId);
            //и перенаправляем на страницу товаров
            header('Location: /admin/orders');
        }

        require_once ROOT . '/views/admin/admin_order/delete.php';
    }
}