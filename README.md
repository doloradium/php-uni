```
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.0
-- Время создания: Ноя 27 2024 г., 16:23
-- Версия сервера: 8.0.35
-- Версия PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mebel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Contracts`
--

CREATE TABLE `Contracts` (
  `id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `contract_date` date DEFAULT NULL,
  `execution_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Contracts`
--

INSERT INTO `Contracts` (`id`, `customer_id`, `contract_date`, `execution_date`) VALUES
(1, 1, '2022-02-16', '2022-03-12'),
(2, 2, '2022-06-10', '2022-06-25'),
(3, 3, '2022-11-05', '2022-11-20'),
(4, 4, '2023-01-20', '2023-02-05'),
(5, 5, '2023-05-15', '2023-05-30'),
(6, 6, '2023-09-10', '2023-09-25'),
(7, 7, '2024-03-05', '2024-03-20'),
(8, 8, '2024-07-10', '2024-07-25'),
(9, 9, '2024-10-15', '2024-11-01');

-- --------------------------------------------------------

--
-- Структура таблицы `Customers`
--

CREATE TABLE `Customers` (
  `id` int NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Customers`
--

INSERT INTO `Customers` (`id`, `customer_name`, `address`, `phone`) VALUES
(1, 'Иван Иванов', 'г. Москва, ул. Ленина, д. 11', '+7 495 123-45-66'),
(2, 'Сергей Петров', 'г. Санкт-Петербург, ул. Невский, д. 50', '+7 812 234-56-78'),
(3, 'Ольга Смирнова', 'г. Новосибирск, ул. Красный проспект, д. 25', '+7 383 345-67-89'),
(4, 'Екатерина Кузнецова', 'г. Екатеринбург, ул. Малышева, д. 100', '+7 343 456-78-90'),
(5, 'Дмитрий Соколов', 'г. Казань, ул. Баумана, д. 30', '+7 843 567-89-01'),
(6, 'Мария Попова', 'г. Нижний Новгород, ул. Горького, д. 15', '+7 831 678-90-12'),
(7, 'Алексей Федоров', 'г. Самара, ул. Московское шоссе, д. 200', '+7 846 789-01-23'),
(8, 'Анна Васильева', 'г. Омск, ул. Ленина, д. 55', '+7 381 890-12-34'),
(9, 'Павел Ковалев', 'г. Челябинск, ул. Кирова, д. 80', '+7 351 901-23-45'),
(10, 'Татьяна Романовна', 'г. Уфа, ул. Октябрьская, д. 72', '+7 347 012-34-88');

-- --------------------------------------------------------

--
-- Структура таблицы `Models`
--

CREATE TABLE `Models` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `model` varchar(10) DEFAULT NULL,
  `characteristics` text,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Models`
--

INSERT INTO `Models` (`id`, `name`, `model`, `characteristics`, `price`) VALUES
(1, 'Стол офисный', 'MOD00231', 'Материал: дерево, Размеры: 120x60x75 см', 5002.00),
(2, 'Шкаф-купе', 'MOD002', 'Материал: ЛДСП, Размеры: 200x60x240 см', 15000.00),
(3, 'Кресло офисное', 'MOD003', 'Материал: ткань, Цвет: черный', 8000.00),
(4, 'Диван угловой', 'MOD004', 'Материал: кожа, Цвет: коричневый', 25000.00),
(5, 'Стул деревянный', 'MOD005', 'Материал: массив, Цвет: белый', 3000.00),
(6, 'Кровать двуспальная', 'MOD006', 'Материал: металл, Размеры: 200x180 см', 18000.00),
(7, 'Полка настенная', 'MOD007', 'Материал: стекло, Размеры: 100x25 см', 4000.00),
(8, 'Тумба прикроватная', 'MOD008', 'Материал: ЛДСП, Цвет: дуб', 2500.00),
(9, 'Обеденный стол', 'MOD009', 'Материал: массив дуба, Размеры: 180x90x75 см', 12000.00),
(10, 'Кухонный гарнитур', 'MOD010', 'Материал: ЛДСП, Цвет: белый', 3600.00);

-- --------------------------------------------------------

--
-- Структура таблицы `Sales`
--

CREATE TABLE `Sales` (
  `id` int NOT NULL,
  `contract_id` int NOT NULL,
  `model_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Sales`
--

INSERT INTO `Sales` (`id`, `contract_id`, `model_id`, `quantity`) VALUES
(1, 9, 10, 2),
(2, 9, 7, 1),
(3, 9, 5, 2),
(4, 8, 9, 1),
(5, 8, 8, 2),
(6, 8, 6, 2),
(7, 7, 10, 1),
(8, 7, 4, 1),
(9, 7, 1, 2),
(10, 6, 9, 2),
(11, 6, 8, 1),
(12, 6, 7, 2),
(13, 6, 2, 1),
(14, 5, 6, 2),
(15, 5, 5, 3),
(16, 5, 3, 2),
(17, 4, 10, 1),
(18, 4, 4, 1),
(19, 4, 1, 3),
(20, 3, 8, 3),
(21, 3, 7, 2),
(22, 3, 2, 1),
(23, 2, 9, 1),
(24, 2, 6, 4),
(25, 9, 10, 1),
(26, 9, 7, 1),
(27, 9, 5, 2),
(28, 8, 9, 1),
(29, 8, 8, 2),
(30, 8, 6, 2),
(31, 7, 10, 1),
(32, 7, 4, 1),
(33, 7, 1, 2),
(34, 6, 9, 2),
(35, 6, 8, 1),
(36, 6, 7, 2),
(37, 6, 2, 1),
(38, 5, 6, 2),
(39, 5, 5, 3),
(40, 5, 3, 2),
(41, 4, 10, 1),
(42, 4, 4, 1),
(43, 4, 1, 3),
(44, 3, 8, 3),
(45, 3, 7, 2),
(46, 3, 2, 1),
(47, 2, 9, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `count` int DEFAULT '0',
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `username`, `password`, `email`, `real_name`, `role`, `count`, `last_login`) VALUES
(18, 'admin', '$2y$10$y0DBQw1qTd3PHwHw/1gh6O7hxOtS8K.pa9KNWmUwVR8s.S88DGK2C', 'admin@admin.com', 'Валерий Макей', 'admin', 3, '2024-11-27 16:21:05'),
(19, 'editor', '$2y$10$w8pm7SMKQpsTi8AZZiOu4uNIJJZRAFl8qN5ZRCGEiulRNQyk1lbXu', 'editor@editor', 'Иван Иванов', 'editor', 6, '2024-11-27 16:21:56'),
(20, 'guest', '$2y$10$zrgVwBdFPsH.cEj5dRN9Bei/EVC6ZCkynaxelmjZGizfmZPjeVOia', 'guest@guest', 'Петр Петров', 'guest', 0, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Contracts`
--
ALTER TABLE `Contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Индексы таблицы `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Models`
--
ALTER TABLE `Models`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Sales`
--
ALTER TABLE `Sales`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Contracts`
--
ALTER TABLE `Contracts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `Customers`
--
ALTER TABLE `Customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `Models`
--
ALTER TABLE `Models`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `Sales`
--
ALTER TABLE `Sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Contracts`
--
ALTER TABLE `Contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `Customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```
