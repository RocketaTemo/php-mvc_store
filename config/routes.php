<?php

return array(
	//Главаня страница
	'index.php' => 'index/index', //вызываем actionIndex в IndexController
	'' => 'index/index',  //вызываем actionIndex в IndexController

	'search/([^?]+)' => 'search/index/$1',

	//комментарии
	'reviews/([a-z0-9-]+)' => 'review/view/$1',

	//корзина
	'cart/add/([0-9]+)' => 'cart/add/$1',
	'cart/checkout' => 'cart/checkout',
	'cart/delete/([0-9]+)' => 'cart/delete/$1',
	'cart' => 'cart/index',

	//Товар
	'product/([a-z0-9-]+)' => 'product/view/$1', //actionView в ProductController

	//Категория товара
	'category/([a-z-]+)' => 'category/category/$1', //actionCategory в CatalogController

	//Регистрация
	'user/register' => 'user/register', //actionRegister в UserController

	//Вход
	'user/login' => 'user/login',

	//Выход
	'user/logout' => 'user/logout',

	//Кабинет юзера
	'cabinet/edit/password' => 'cabinet/editPassword',
	'cabinet/edit' => 'cabinet/edit',
	'cabinet/orders' => 'cabinet/ordersHistory',
	'cabinet' => 'cabinet/index',

    //Админпанель
    'admin/orders/edit/([0-9]+)' => 'adminOrder/edit/$1',
    'admin/orders/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/orders/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/orders' => 'adminOrder/index',

    'admin/category/edit/([a-z]+)' => 'adminCategory/edit/$1',
    'admin/category/add' => 'adminCategory/add',
    'admin/category/delete/([a-z]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    'admin/product/edit/([0-9]+)' => 'adminProduct/edit/$1',
    'admin/product/add' => 'adminProduct/add',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
	'admin/product' => 'adminProduct/index',

	//города
	'admin/city/edit/([0-9]+)' => 'adminCity/edit/$1',
    'admin/city/add' => 'adminCity/add',
	'admin/city/delete/([0-9]+)' => 'adminCity/delete/$1',
	'admin/city' => 'adminCity/index',

	//почта
	'admin/post/edit/([0-9]+)' => 'adminPost/edit/$1',
    'admin/post/add' => 'adminPost/add',
	'admin/post/delete/([0-9]+)' => 'adminPost/delete/$1',
	'admin/post' => 'adminPost/index',

	'admin' => 'admin/index'

);