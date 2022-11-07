-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 26 2022 г., 00:38
-- Версия сервера: 5.5.54
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
-- База данных: `anon_chat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ban`
--

CREATE TABLE `ban` (
  `ID` int(11) NOT NULL,
  `name` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ban`
--

INSERT INTO `ban` (`ID`, `name`) VALUES
(177, 'Poisk'),
(176, 'poisk'),
(175, 'poiske'),
(174, 'v p0iske'),
(173, 'v poiske'),
(172, 'HtTpS'),
(171, 'HtTp'),
(170, 'hTtP'),
(169, 'hTtPs'),
(168, 'htTPs'),
(167, 'htTPS'),
(166, 'htTP'),
(165, 'htTTP'),
(164, 'htTT'),
(163, 'hTPPS'),
(162, 'hTPP'),
(161, 'hTPPs'),
(160, 'hTpP'),
(159, 'hTppS'),
(158, 'hTpps'),
(157, 'HttP'),
(156, 'HttpS'),
(155, 'httpS'),
(154, 'httP'),
(153, 'http'),
(152, 'Https'),
(151, 'HTTPS'),
(150, 'HTTP'),
(149, 'HTTP'),
(148, 'T.ME'),
(147, 't.Me'),
(146, 't.mE'),
(145, 't.ME'),
(144, 'T.me'),
(143, 'в поиске'),
(142, 'поиске'),
(141, '.eu'),
(140, '.ru'),
(139, '.com'),
(138, 'www.'),
(137, 'поиске'),
(136, 'хорошо заработать'),
(135, 'ищи в поиске'),
(134, 'хочешь заработать'),
(133, 't.me'),
(132, 'тг Канал'),
(131, 'Тг канал'),
(130, 'тг канал'),
(129, 'Канал'),
(128, 'канал'),
(127, 'Подпишись'),
(126, 'подпишись'),
(125, 'https'),
(124, 'http'),
(123, '@'),
(122, 'хуй');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `chat_user` int(10) NOT NULL,
  `history` int(10) NOT NULL,
  `poisk` int(1) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `old` int(3) NOT NULL,
  `dialog` int(7) NOT NULL,
  `message` int(8) NOT NULL,
  `report` int(1) NOT NULL,
  `captcha` varchar(6) NOT NULL,
  `vip` int(11) NOT NULL,
  `ban_time` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `peremen` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--


--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `anon_chat` (`name`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `anon_chat` (`user_id`),
  ADD KEY `chat_user` (`chat_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ban`
--
ALTER TABLE `ban`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
