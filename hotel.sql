-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 03 2023 г., 23:19
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
  `room_number` varchar(10) NOT NULL,
  `check-in date` datetime NOT NULL,
  `check-out date` datetime NOT NULL,
  `bill` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `accommodation`
--

INSERT INTO `accommodation` (`id`, `room_number`, `check-in date`, `check-out date`, `bill`) VALUES
(1, '1A', '2023-02-03 21:58:20', '2023-02-06 03:58:20', '7500.00'),
(2, '1B', '2023-02-01 03:58:20', '2023-02-03 21:58:20', '5200.00'),
(3, '3B', '2023-01-06 04:00:16', '2023-01-18 04:00:16', '20400.00'),
(4, '2', '2023-02-06 04:00:16', '2023-02-11 04:00:16', '15000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `resident`
--

CREATE TABLE `resident` (
  `id` int(11) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `passport` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `resident`
--

INSERT INTO `resident` (`id`, `surname`, `name`, `middlename`, `passport`) VALUES
(5, 'Капустин', 'Лев', 'Валентинович', '4791115057'),
(6, 'Ковалев', 'Давид', 'Егорович', '4794564718'),
(7, 'Новицкий', 'Константин', 'Данилович', '4080956489'),
(8, 'Тетерина', 'Марина', 'Леонтьевна', '4626944883'),
(9, 'Дроздов', 'Николай', 'Николаевич', '4433107392'),
(10, 'Низьев', 'Никита', 'Петрович', '4616809491'),
(11, 'Кулибин', 'Семён', 'Антонович', '4438338597'),
(12, 'Агутина', 'Алина', 'Денисовна', '1881497751'),
(13, 'Ноздрёв', 'Максим', 'Наумович', '4276641097'),
(14, 'Созонова', 'Инга', 'Вячеславовна', '4923378072'),
(15, 'Логвинова', 'Татьяна', 'Сергеевна', '4970276088'),
(16, 'Лужков', 'Артём', 'Аркадьевич', '4057592146');

-- --------------------------------------------------------

--
-- Структура таблицы `residents_in_accomodation`
--

CREATE TABLE `residents_in_accomodation` (
  `id_accomodation` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `residents_in_accomodation`
--

INSERT INTO `residents_in_accomodation` (`id_accomodation`, `id_resident`) VALUES
(1, 12),
(1, 15),
(2, 6),
(2, 7),
(2, 8),
(4, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `room`
--

CREATE TABLE `room` (
  `room number` varchar(10) NOT NULL,
  `price per day` decimal(5,0) NOT NULL,
  `isBusy` tinyint(1) NOT NULL DEFAULT 0,
  `number of beds` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `room`
--

INSERT INTO `room` (`room number`, `price per day`, `isBusy`, `number of beds`) VALUES
('1A', '2500', 0, 2),
('1B', '2600', 0, 3),
('2', '3000', 0, 1),
('3A', '5000', 0, 4),
('3B', '1700', 0, 2),
('4', '1200', 0, 1),
('5A', '2700', 0, 3),
('5B', '2500', 0, 3);

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
-- Индексы таблицы `residents_in_accomodation`
--
ALTER TABLE `residents_in_accomodation`
  ADD PRIMARY KEY (`id_accomodation`,`id_resident`),
  ADD KEY `id resident` (`id_resident`);

--
-- Индексы таблицы `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room number`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accommodation`
--
ALTER TABLE `accommodation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `resident`
--
ALTER TABLE `resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accommodation`
--
ALTER TABLE `accommodation`
  ADD CONSTRAINT `accommodation_ibfk_1` FOREIGN KEY (`room_number`) REFERENCES `room` (`room number`);

--
-- Ограничения внешнего ключа таблицы `residents_in_accomodation`
--
ALTER TABLE `residents_in_accomodation`
  ADD CONSTRAINT `residents_in_accomodation_ibfk_1` FOREIGN KEY (`id_accomodation`) REFERENCES `accommodation` (`id`),
  ADD CONSTRAINT `residents_in_accomodation_ibfk_2` FOREIGN KEY (`id_resident`) REFERENCES `resident` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
