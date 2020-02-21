<?php
ob_start();
session_start();

// Bывод ошшибок на экран
error_reporting(E_ALL);
ini_set('display_error', 'On');

// Поключение файлов системы
define('ROOT', dirname(__FILE__));
require_once ROOT . '/core/Router.php';
require_once ROOT . '/core/Db.php';
require_once ROOT . '/core/AdminBase.php';
require_once ROOT . '/models/User.php';
require_once ROOT . '/models/Category.php';
require_once ROOT . '/models/Product.php';
require_once ROOT . '/models/Cart.php';
require_once ROOT . '/models/Order.php';
require_once ROOT . '/models/Review.php';
require_once ROOT . '/models/City.php';
require_once ROOT . '/models/PostOffice.php';
require_once ROOT . '/models/BreadCrumbs.php';
require_once ROOT. '/widgets/filter/Filter.php';

function debug($data){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

$router = new Router();
$router->start();
?>