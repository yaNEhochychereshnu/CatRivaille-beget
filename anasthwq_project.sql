-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 28 2024 г., 23:23
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `anasthwq_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--
-- Создание: Май 27 2024 г., 16:08
-- Последнее обновление: Май 27 2024 г., 23:11
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'открытка', '2024-05-26 05:57:10', '2024-05-26 05:57:10'),
(2, 'наклейка', '2024-05-26 05:57:16', '2024-05-26 05:57:16');

-- --------------------------------------------------------

--
-- Структура таблицы `favourites`
--
-- Создание: Май 27 2024 г., 16:08
-- Последнее обновление: Май 27 2024 г., 23:08
--

DROP TABLE IF EXISTS `favourites`;
CREATE TABLE `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-05-26 05:55:56', '2024-05-26 05:55:56'),
(2, 2, '2024-05-26 05:56:12', '2024-05-26 05:56:12'),
(3, 3, '2024-05-26 15:12:05', '2024-05-26 15:12:05'),
(4, 4, '2024-05-27 19:31:01', '2024-05-27 19:31:01'),
(5, 5, '2024-05-27 20:08:55', '2024-05-27 20:08:55');

-- --------------------------------------------------------

--
-- Структура таблицы `favourite_product`
--
-- Создание: Май 27 2024 г., 16:08
-- Последнее обновление: Май 27 2024 г., 23:09
--

DROP TABLE IF EXISTS `favourite_product`;
CREATE TABLE `favourite_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `favourite_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `favourite_product`
--

INSERT INTO `favourite_product` (`id`, `favourite_id`, `product_id`, `created_at`, `updated_at`) VALUES
(14, 1, 2, NULL, NULL),
(18, 3, 2, NULL, NULL),
(28, 4, 1, NULL, NULL),
(29, 5, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--
-- Создание: Май 27 2024 г., 16:08
-- Последнее обновление: Май 27 2024 г., 16:08
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_11_10_064021_create_orders_table', 1),
(4, '2023_11_10_064146_create_categories_table', 1),
(5, '2023_11_10_064209_create_products_table', 1),
(6, '2023_11_10_072223_create_order_product_table', 1),
(7, '2024_05_05_151751_create_favourites_table', 1),
(8, '2024_05_26_082537_create_favourite_product_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--
-- Создание: Май 27 2024 г., 16:08
-- Последнее обновление: Май 27 2024 г., 23:12
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sum` int(11) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'В корзине',
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trackcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `sum`, `status`, `full_name`, `phone`, `address`, `postcode`, `trackcode`, `receipt_path`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'В корзине', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-26 05:55:56', '2024-05-26 05:55:56'),
(2, 2, 0, 'В корзине', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-26 05:56:12', '2024-05-26 05:56:12'),
(3, 3, 550, 'Отправлено', 'фамилия имя отчество', '+7 (977) 266-93-19', 'город улица дом квартира', '111111', '111111', NULL, '2024-05-26 15:12:05', '2024-05-26 15:27:51'),
(5, 3, 450, 'Отправлено', 'фамилия имя отчество', '+7 (977) 266-93-19', 'город улица дом квартира', '111111', NULL, 'img/Product5.jpg', '2024-05-27 00:45:43', '2024-05-27 01:30:47'),
(6, 3, 450, 'Подтвержден', 'фамилия имя отчество', '+7 (977) 266-93-19', 'город улица дом квартира', '111111', NULL, 'img/Product2.jpg', '2024-05-27 01:29:20', '2024-05-27 14:07:45'),
(7, 3, 450, 'В сборке', 'фамилия имя отчество', '+7 (977) 266-93-19', 'город улица дом квартира', '111111', NULL, 'img/Product2.jpg', '2024-05-27 02:24:45', '2024-05-27 02:53:34'),
(8, 3, 0, 'В корзине', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-27 02:28:36', '2024-05-27 02:28:36'),
(9, 4, 550, 'Отправлен', 'Фамилия Имя Отчество', '+7 (977) 266-93-19', 'Город, улица, дом', '111111', '111111', 'img/Product2.jpg', '2024-05-27 19:31:01', '2024-05-27 19:36:03'),
(10, 4, 0, 'В корзине', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-27 19:32:54', '2024-05-27 19:32:54'),
(11, 5, 550, 'Отправлен', 'Фамилия Имя Отчество', '+7 (777) 777-77-77', 'Город, улица, дом, квартира', '111111', '111111', 'img/Product2.jpg', '2024-05-27 20:08:55', '2024-05-27 20:12:30'),
(12, 5, 0, 'В корзине', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-27 20:10:22', '2024-05-27 20:10:22');

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--
-- Создание: Май 27 2024 г., 16:08
-- Последнее обновление: Май 28 2024 г., 12:14
--

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE `order_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 1, NULL, NULL),
(4, 5, 2, 1, NULL, NULL),
(6, 6, 2, 1, NULL, NULL),
(7, 7, 2, 1, NULL, NULL),
(8, 1, 1, 1, NULL, NULL),
(10, 9, 2, 2, NULL, NULL),
(11, 11, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--
-- Создание: Май 27 2024 г., 16:08
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--
-- Создание: Май 27 2024 г., 16:08
-- Последнее обновление: Май 27 2024 г., 23:12
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '10',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `category_id`, `title`, `img_path`, `price`, `size`, `material`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 'Открытка \"Чжун Ли\" с золотом', 'img/Product3.jpg', 200, '15х15', 'картон, золотая фольга', 10, '2024-05-26 05:58:02', '2024-05-26 05:58:02'),
(2, 2, 'Наклейка \"Чжун Ли\" с золотом', 'img/Product3.jpg', 100, '5x5', 'клейкая бумага, голо-фольга', 10, '2024-05-26 06:24:47', '2024-05-26 06:24:47');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--
-- Создание: Май 27 2024 г., 16:08
-- Последнее обновление: Май 27 2024 г., 23:08
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'admin1@pochta.ru', '$2y$10$lNxgAHCuKSUq87Z1EWfHwO5ADL3QlRQpvt.7945IZGBcL5ToDnHPi', 1, '2024-05-26 05:55:56', '2024-05-26 05:55:56'),
(2, 'testuser1', 'testuser1@pochta.ru', '$2y$10$QLy3wkRRD6YV.2m2hohG9eU7td2qDMgfi61HYQaRSo2VG2wNByIfy', 0, '2024-05-26 05:56:12', '2024-05-26 05:56:12'),
(3, 'testuser2', 'anastasia.semeniuk2k17@yandex.ru', '$2y$10$GUrBT9yXL.bW45HehSENm.r8.7Ex85SVKK012oPyNE40NJWffWnJ6', 0, '2024-05-26 15:12:05', '2024-05-26 15:12:05'),
(4, 'testuser3', 'testuser3@pochta.ru', '$2y$10$jgpQ7i/bQhdr9F2W5D5te.fM7qRaXAVUJIKaF1.Qow2baArU1aK8O', 0, '2024-05-27 19:31:01', '2024-05-27 19:31:01'),
(5, 'testuser4', 'testuser4@pochta.ru', '$2y$10$rMJjVBp855uFpBVXUsIbhOKwENie8a1QMs6GeDKfKikirTOAp0fGC', 0, '2024-05-27 20:08:55', '2024-05-27 20:08:55');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourites_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `favourite_product`
--
ALTER TABLE `favourite_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourite_product_favourite_id_foreign` (`favourite_id`),
  ADD KEY `favourite_product_product_id_foreign` (`product_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_login_unique` (`login`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `favourite_product`
--
ALTER TABLE `favourite_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `favourite_product`
--
ALTER TABLE `favourite_product`
  ADD CONSTRAINT `favourite_product_favourite_id_foreign` FOREIGN KEY (`favourite_id`) REFERENCES `favourites` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourite_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
