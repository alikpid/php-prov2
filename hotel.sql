-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 03 2023 г., 17:16
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hotel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accommodation`
--

CREATE TABLE `accommodation` (
  `id` int(11) NOT NULL,
  `room_number` varchar(10) DEFAULT NULL,
  `check_in_date` datetime DEFAULT NULL,
  `check_out_date` datetime DEFAULT NULL,
  `bill` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `accommodation`
--

INSERT INTO `accommodation` (`id`, `room_number`, `check_in_date`, `check_out_date`, `bill`) VALUES
(1, '1A', '2023-02-03 21:58:20', '2023-02-06 03:58:20', '7500.00'),
(2, '1B', '2023-02-01 03:58:20', '2023-02-03 21:58:20', '5200.00'),
(3, '3B', '2023-01-06 04:00:16', '2023-01-18 04:00:16', '20400.00'),
(4, '2', '2023-02-06 04:00:16', '2023-02-11 04:00:16', '15000.00'),
(6, '3A', '2023-02-14 10:01:16', '2023-03-10 10:01:16', '120000.00'),
(118, '6A', '2023-03-01 00:00:00', '2023-03-03 02:39:00', '3000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `resident`
--

CREATE TABLE `resident` (
  `id` int(11) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `passport` varchar(10) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `sex` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `resident`
--

INSERT INTO `resident` (`id`, `surname`, `name`, `middlename`, `passport`, `phone_number`, `sex`) VALUES
(5, 'Капустин', 'Лев', 'Валентинович', '4791115057', '79990371819', 1),
(6, 'Ковалев', 'Давид', 'Егорович', '4794564718', '79237838930', 1),
(7, 'Новицкий', 'Константин', 'Данилович', '4080956489', '79581814767', 1),
(8, 'Тетерина', 'Марина', 'Леонтьевна', '4626944883', '79948075462', 0),
(9, 'Дроздов', 'Николай', 'Николаевич', '4433107392', '79205783348', 1),
(10, 'Низьев', 'Никита', 'Петрович', '4616809491', '79267059580', 1),
(11, 'Кулибин', 'Семён', 'Антонович', '4438338597', '79165826930', 1),
(12, 'Агутина', 'Алина', 'Денисовна', '1881497751', '79031857436', 0),
(13, 'Ноздрёв', 'Максим', 'Наумович', '4276641097', '79137269145', 1),
(14, 'Созонова', 'Инга', 'Вячеславовна', '4923378072', '79062346800', 0),
(15, 'Логвинова', 'Татьяна', 'Сергеевна', '4970276088', '79273107127', 0),
(16, 'Лужков', 'Артём', 'Аркадьевич', '4057592146', '79863613898', 1),
(27, 'Колчина', 'Алина', 'Денисовна', '8118999333', '79993335544', 0),
(28, 'Пупкин', 'Валерий', 'Викторович', '8118795193', '79993335533', 1),
(32, 'Валуев', 'Никита', 'Дмитриевич', '8118795724', '79149055118', 1),
(33, 'Васькина', 'Анна', 'Сергеевна', '7618795109', '79165405328', 0),
(34, 'Какой-то', 'Мужик', '', '3435823490', '79990843275', 1),
(43, 'eijniven', 'jingfn', 'ijniejn', '3893839', '39895339737', 0),
(44, 'kjngkjeng', 'ekjnekrn', 'kdjdndjgn', '3758973847', '93845793875', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `residents_in_accommodation`
--

CREATE TABLE `residents_in_accommodation` (
  `id_accommodation` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `residents_in_accommodation`
--

INSERT INTO `residents_in_accommodation` (`id_accommodation`, `id_resident`) VALUES
(1, 12),
(1, 15),
(2, 6),
(2, 7),
(2, 8),
(3, 9),
(3, 13),
(4, 10),
(6, 5),
(6, 11),
(6, 14),
(6, 16),
(118, 34);

-- --------------------------------------------------------

--
-- Структура таблицы `room`
--

CREATE TABLE `room` (
  `room_number` varchar(10) NOT NULL,
  `price_per_day` decimal(5,0) NOT NULL,
  `isBusy` tinyint(1) NOT NULL DEFAULT 0,
  `number_of_beds` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `room`
--

INSERT INTO `room` (`room_number`, `price_per_day`, `isBusy`, `number_of_beds`) VALUES
('1A', '2500', 1, 2),
('1B', '2600', 1, 3),
('2', '3000', 1, 1),
('3A', '5000', 1, 4),
('3B', '1700', 1, 2),
('4', '1200', 0, 1),
('5A', '2700', 0, 3),
('5B', '2500', 0, 3),
('6A', '1500', 1, 1),
('6B', '1900', 0, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accommodation`
--
ALTER TABLE `accommodation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room number` (`room_number`);

--
-- Индексы таблицы `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `residents_in_accommodation`
--
ALTER TABLE `residents_in_accommodation`
  ADD PRIMARY KEY (`id_accommodation`,`id_resident`),
  ADD KEY `id resident` (`id_resident`);

--
-- Индексы таблицы `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_number`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accommodation`
--
ALTER TABLE `accommodation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT для таблицы `resident`
--
ALTER TABLE `resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accommodation`
--
ALTER TABLE `accommodation`
  ADD CONSTRAINT `accommodation_ibfk_1` FOREIGN KEY (`room_number`) REFERENCES `room` (`room_number`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `residents_in_accommodation`
--
ALTER TABLE `residents_in_accommodation`
  ADD CONSTRAINT `residents_in_accommodation_ibfk_1` FOREIGN KEY (`id_accommodation`) REFERENCES `accommodation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `residents_in_accommodation_ibfk_2` FOREIGN KEY (`id_resident`) REFERENCES `resident` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
