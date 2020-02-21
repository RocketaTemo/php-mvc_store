-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 09 2019 г., 00:45
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vape_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_group`
--

CREATE TABLE `attribute_group` (
  `id_attribute` int(11) NOT NULL,
  `name_attribute` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица атрибутов';

--
-- Дамп данных таблицы `attribute_group`
--

INSERT INTO `attribute_group` (`id_attribute`, `name_attribute`) VALUES
(1, 'Никотин'),
(2, 'Объем'),
(3, 'Производитель');

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_product`
--

CREATE TABLE `attribute_product` (
  `attr_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `attribute_product`
--

INSERT INTO `attribute_product` (`attr_id`, `product_id`) VALUES
(1, 1),
(2, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_attr_group` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='таблица связей атрибутов и значений';

--
-- Дамп данных таблицы `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `id_attr_group`, `value`) VALUES
(1, 1, '0 мг'),
(2, 1, '1.5 мг'),
(3, 1, '3 мг'),
(4, 1, '6 мг'),
(5, 2, '10 мл'),
(6, 2, '15 мл'),
(7, 2, '30 мл'),
(8, 2, '60 мл'),
(9, 2, '100 мл'),
(10, 2, '120 мл'),
(11, 3, 'VapeLab'),
(12, 3, 'Im Vape');

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_valuey`
--

CREATE TABLE `attribute_valuey` (
  `id_value` int(11) NOT NULL,
  `attribute_value` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица значений атрибутов';

--
-- Дамп данных таблицы `attribute_valuey`
--

INSERT INTO `attribute_valuey` (`id_value`, `attribute_value`) VALUES
(7, '0 мг'),
(8, '1.5 мг'),
(1, '10 мл'),
(5, '100 мл'),
(6, '120 мл'),
(2, '15 мл'),
(9, '3 мг'),
(3, '30 мл'),
(10, '6 мг'),
(4, '60 мл');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `alias`) VALUES
(1, 0, 'ЭЛЕКТРОННЫЕ СИГАРЕТЫ', 'elektronnye-sigarety'),
(2, 0, 'ЖИДКОСТЬ', 'zhidkosti'),
(3, 0, 'КОМПЛЕКТУЮЩИЕ', 'komplektuyushchie'),
(4, 0, 'САМОЗАМЕС', 'samozames'),
(5, 0, 'АКСЕССУАРЫ', 'aksessuary'),
(6, 1, 'СТАРТОВЫЕ НАБОРЫ', 'startovye-nabory\r\n'),
(7, 1, 'БОКС МОДЫ\r\n', 'box-modi'),
(10, 1, 'МЕХАНИЧЕСКИЕ МОДЫ', 'mech-modi'),
(11, 1, 'АТОМАЙЗЕРЫ', 'atomi'),
(12, 2, 'ПРЕМИУМ ЖИДКОСТИ', 'premium-zhidkosti'),
(13, 2, 'АВТОРСКИЕ ЖИДКОСТИ', 'avtorskie-zhidkosti'),
(14, 3, 'АККУМУЛЯТОРЫ', 'akkumulyatory'),
(15, 3, 'ЗАРЯДНЫЕ', 'zaryadnie'),
(16, 3, 'ДРИП-ТИПЫ', 'drip-tipy'),
(17, 3, 'СПИРАЛИ', 'spirali'),
(18, 3, 'ХЛОПОК', 'hlopok'),
(19, 4, 'АРОМАТИЗАТОРЫ', 'aromatizatory'),
(20, 4, 'ГОТОВЫЕ БАЗЫ', 'gotovie-bazy'),
(21, 4, 'ФЛАКОНЫ', 'flakony'),
(22, 4, 'НИКОТИН', 'nikotin'),
(23, 5, 'ВЕЙП БЕНДЫ', 'vape-bandy'),
(24, 5, 'ИНСТРУМЕНТЫ', 'instrumenty'),
(25, 5, 'ТЕРМОУСАДКА 18650', 'termousadka-18650'),
(26, 5, 'СТЕКЛА', 'stekla');

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `name`, `region`, `postcode`) VALUES
(1, 'Харьков', 'Харьков', 610000);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `products` text NOT NULL,
  `postoffice_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `postoffice`
--

CREATE TABLE `postoffice` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `postoffice`
--

INSERT INTO `postoffice` (`id`, `city_id`, `name`, `location`, `postcode`) VALUES
(1, 1, 'Новая Почта', 'ул.Светлая, д.19', 31);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cat_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `cat_id`, `name`, `alias`, `price`, `availability`, `brand`, `description`) VALUES
(1, 13, 'вкусный пончик', 'corbanated-donut', '1488', 1, 'imvape', ''),
(3, 13, 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 'qqqqqqqq', '9999', 1, 'fsfas', '');

-- --------------------------------------------------------

--
-- Структура таблицы `product_attribute_value`
--

CREATE TABLE `product_attribute_value` (
  `id_product` int(11) NOT NULL,
  `id_attribute` int(11) NOT NULL,
  `id_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='таблица связей между атрибута, значением атрибутов, и товарами';

--
-- Дамп данных таблицы `product_attribute_value`
--

INSERT INTO `product_attribute_value` (`id_product`, `id_attribute`, `id_value`) VALUES
(1, 1, 1),
(1, 2, 5),
(1, 3, 8),
(3, 1, 7),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `postoffice_id` int(11) NOT NULL,
  `role` varchar(60) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `city_id`, `postoffice_id`, `role`) VALUES
(1, 'artem', 'motyrev', 'admin@gmail.com', '0967449500', '$2y$10$j0rpR1NdBNZ7.MtLIzVatuJVr9WsMeuQz88g8cmvMFaTHn/mkPsk6', 1, 1, 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attribute_group`
--
ALTER TABLE `attribute_group`
  ADD PRIMARY KEY (`id_attribute`);

--
-- Индексы таблицы `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD PRIMARY KEY (`attr_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_attribute` (`id_attr_group`);

--
-- Индексы таблицы `attribute_valuey`
--
ALTER TABLE `attribute_valuey`
  ADD PRIMARY KEY (`id_value`),
  ADD UNIQUE KEY `attributte_value` (`attribute_value`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `postoffice`
--
ALTER TABLE `postoffice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Индексы таблицы `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD PRIMARY KEY (`id_product`,`id_attribute`,`id_value`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_value` (`id_value`),
  ADD KEY `id_attribute` (`id_attribute`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `postoffice_id` (`postoffice_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attribute_group`
--
ALTER TABLE `attribute_group`
  MODIFY `id_attribute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `attribute_valuey`
--
ALTER TABLE `attribute_valuey`
  MODIFY `id_value` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `postoffice`
--
ALTER TABLE `postoffice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD CONSTRAINT `attribute_product_ibfk_1` FOREIGN KEY (`attr_id`) REFERENCES `attribute_value` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `attribute_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD CONSTRAINT `attribute_value_ibfk_1` FOREIGN KEY (`id_attr_group`) REFERENCES `attribute_group` (`id_attribute`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD CONSTRAINT `product_attribute_value_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_attribute_value_ibfk_2` FOREIGN KEY (`id_attribute`) REFERENCES `attribute_group` (`id_attribute`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_attribute_value_ibfk_3` FOREIGN KEY (`id_value`) REFERENCES `attribute_valuey` (`id_value`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
