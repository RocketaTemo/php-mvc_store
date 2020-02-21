<?php
include (ROOT . '/widgets/menu/menu.php');
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Vape Shop</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link href="<?php ROOT?>/template/css/main.css" rel="stylesheet">
    <link href="<?php ROOT?>/template/megamenu/css/style.css" rel="stylesheet">
    <link href="<?php ROOT?>/template/css/ion.tabs.css" rel="stylesheet">
    <link href="<?php ROOT?>/template/css/ion.tabs.skinBordered.css" rel="stylesheet">
    <script src="<?php ROOT?>/template/js/jquery.js"></script>
    <script src="<?php ROOT?>/template/js/main.js"></script>
    <script src="<?php ROOT?>/template/megamenu/js/megamenu.js"></script>
    <script src="<?php ROOT?>/template/js/ion.tabs.js"></script>
</head>

<body>
    <div class="wrapper">
        <header id="header">
            <div class="top_nav">
                <div class="logo">
                    <a href="/"><img alt="" src="<?php ROOT?>/template/images/logo.png" /></a>
                </div>
                <div class="area main">
                    <div class="sub-area_top">
                        <ul>
                            <li><a href="/">О МАГАЗИНЕ</a></li>
                            <li><a href="/">ДОСТАВКА И ОПЛАТА</a></li>
                            <li><a href="/">КОНТАКТЫ</a></li>
                            <li><a href="/">ОТЗЫВЫ</a></li>
                        </ul>
                    </div>
                        <div class="container-1">
                            <span class="icon"><i class="icon-search"></i></span>
                            <input type="search" id="search" name="search" placeholder="поиск товара на сайте...">
                            <ul id="here"></ul>
                        </div>
                    <div class="sub-sub-area_bot">
                        <div>
                            <span class="stagstrong">пн-пт:</span>
                            10:00-20:00&nbsp;&nbsp;&nbsp;
                            <span class="stagstrong">сб-вс:</span>
                            12:00-20:00
                        </div>
                    </div>
                </div>
                <div class="area work">
                </div>
                <div class="area phones">
                    <a name="phone1" href="tel:+380960000001">
                        <img src="/template/images/operators/kyivstar.jpg" alt="kyivstar">
                        (096) 000 00 01</a>
                    <a name="phone1" href="tel:+380960000002">
                        <img src="/template/images/operators/mts.jpg" alt="mts">
                        (066) 000 00 02</a>
                    <a name="phone1" href="tel:+380960000003">
                        <img src="/template/images/operators/lifecell.jpg" alt="lifecell">
                        (093) 000 00 03</a>
                </div>
                <?php if(User::isGuest()):?>
                <div class="cart">
                    <a href="/cart"><img src="/template/images/cart.png">
                        <div class="cart_count_w">
                            <span class="cart_count"><?=Cart::itemsCount()?></span>
                        </div>
                        <span class="cart_info_text">
                            <span>КОРЗИНА:</span>
                            <br>
                        </span>
                    </a>
                </div>
                <div class="cab">
                    <a href="/user/register"> <img src="/template/images/user.png" alt="user">
                        <br> Регистрация</a>
                </div>
                <?php else:?>
                <div class="cart">
                    <a href="/cart"><img src="/template/images/cart.png">
                        <div class="cart_count_w">
                            <span class="cart_count"><?=Cart::itemsCount()?></span>
                        </div>
                        <span class="cart_info_text">
                            <span>КОРЗИНА:</span>
                            <br>
                        </span>
                    </a>
                </div>
                <div class="cab">
                    <img src="/template/images/user.png" width="50" height="50" alt="user">
                    <br>
                    <a href="/cabinet">Личный кабинет</a>
                </div>
                <?php endif;?>
            </div>
            <div class="header_bottom">
                <div class="menu-container">
                    <div class="menu">
                        <ul>
                            <?php new menu([]);?>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
    </header>