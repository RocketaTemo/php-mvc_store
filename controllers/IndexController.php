<?php
/**
 * Class IndexController
 * Контроллер главной страницы
 */
class IndexController
{
	public function actionIndex()
	{
		// Последние продукты
		//$latestProducts = Product::getLatestProducts();
		//Получаем id пользователя из сессии
        $userId =  User::checkLog();
        //Получаем всю информацию о пользователе из БД
		$userInfo = User::getUserById($userId);
		$products = Cart::getProducts();
		$totalPrice = Cart::getTotalPrice($products);
        require_once ROOT . '/views/index/index.php';
		return true;
	}
}