-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 12 2025 г., 09:33
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `olimp2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_answer`
--

CREATE TABLE `admin_answer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `date_comment` datetime NOT NULL,
  `comment_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `admin_answer`
--

INSERT INTO `admin_answer` (`id`, `user_id`, `answer_id`, `date_comment`, `comment_text`) VALUES
(1, 3, 2, '2025-01-27 08:40:42', 'УAловите свое руки мощные вдохновени евкладывает в ваши творческие инструменты, которые обеспечивают абсолютный контроль над текстом. их помощью вы любым элементам тени, эффекты с использованием прозрачности. Они позволят вам создавать элегантные таблицы. И не бойтесь экспериментировать у вас всегда ть отменить или выполнить повторно действия.');

-- --------------------------------------------------------

--
-- Структура таблицы `jury_comments`
--

CREATE TABLE `jury_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `date_comment` datetime NOT NULL,
  `comment_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `jury_comments`
--

INSERT INTO `jury_comments` (`id`, `user_id`, `answer_id`, `date_comment`, `comment_text`) VALUES
(1, 2, 1, '2024-12-03 08:32:49', '<p>Start a new repository for Sanchez1901\r\nA repository contains all of your project\'s files, revision history, and collaborator discussion.</p>\r\n<p>На русском языке.</p>\r\n\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `olimp`
--

CREATE TABLE `olimp` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `olimp`
--

INSERT INTO `olimp` (`id`, `title`, `code`, `status`) VALUES
(1, 'Новая олимпиада', '132124', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `modifiers` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `title`, `content`, `alias`, `modifiers`) VALUES
(1, 'Задания', 'Задания Олимпиады', '<h2>Задания Олимпиады 2024-2025</h2>\r\n<p> УAловите свое руки мощные  вдохновениевкладывает в ваши  творческие инструменты, которые обеспечивают абсолютный контроль над текстом. их помощью вы любым элементам тени,  эффекты с использованием прозрачности. Они позволят вам создавать элегантные таблицы. И не бойтесь экспериментировать у вас всегда ть отменить или выполнить повторно действия.</p>\r\n<p> УAловите свое руки мощные  вдохновениевкладывает в ваши  творческие инструменты, которые обеспечивают абсолютный контроль над текстом. их помощью вы любым элементам тени,  эффекты с использованием прозрачности. Они позволят вам создавать элегантные таблицы. И не бойтесь экспериментировать у вас всегда ть отменить или выполнить повторно действия.</p>\r\n<p><a class=\"download\" href=\"#\">Задания 4-6 классы</a></p>\r\n<p><a class=\"download\" href=\"#\">Задания 7-11 классы</a></p>\r\n', 'tasks', '2024-11-28 08:09:05');

-- --------------------------------------------------------

--
-- Структура таблицы `quest`
--

CREATE TABLE `quest` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `tur_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `result` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tur`
--

CREATE TABLE `tur` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `olimp_id` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_reg` date NOT NULL,
  `date_last_login` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `priv` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `username`, `email`, `date_reg`, `date_last_login`, `ip`, `priv`) VALUES
(1, 'user', '12345678', 'User12', 'Ussssser@gmail.com', '2024-05-17', '2024-05-17 09:58:34', '', 1),
(2, 'admin', '12345678', 'Admin', 'admin@gmail.com', '2024-05-17', '2024-05-21 09:04:35', '', 5),
(3, 'user2', '12345678', 'User2', 'user2@gmail.com', '2024-05-17', '2024-05-21 09:07:05', '', 1),
(6, 'user1234365', '12345678', 'Alex', 'adfsfgfd@mail.ru', '2025-02-03', '0000-00-00 00:00:00', '::1', 0),
(5, 'userlsdjfkjldsf', '11111111', 'lasjdkfjlskjd', 'slkdjfklj@mail.ru', '2024-11-13', '0000-00-00 00:00:00', '::1', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user_answer`
--

CREATE TABLE `user_answer` (
  `id` int(11) NOT NULL,
  `tur_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_answer`
--

INSERT INTO `user_answer` (`id`, `tur_id`, `user_id`, `file_name`, `file_path`, `file_date`) VALUES
(1, 1, 1, 'olimp.zip', '/files/1/1/olimp.zip', '2024-12-03 08:24:19'),
(2, 1, 2, 'olimp.zip', '/files/1/2/olimp2.zip', '2024-12-03 08:24:19'),
(24, 1, 1, '67803a2c87a5b2094cdd562d2994b615.jpg', 'C:/xampp/htdocs/olimp/upload/users/1/67803a2c87a5b2094cdd562d2994b615.jpg', '2024-12-26 11:02:59'),
(25, 1, 1, 'olimp (3).sql', 'C:/xampp/htdocs/olimp/upload/users/1/olimp (3).sql', '2025-02-12 11:22:20');

-- --------------------------------------------------------

--
-- Структура таблицы `user_question`
--

CREATE TABLE `user_question` (
  `id` int(11) NOT NULL,
  `tur_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin_answer`
--
ALTER TABLE `admin_answer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `jury_comments`
--
ALTER TABLE `jury_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `olimp`
--
ALTER TABLE `olimp`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `quest`
--
ALTER TABLE `quest`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tur`
--
ALTER TABLE `tur`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_question`
--
ALTER TABLE `user_question`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin_answer`
--
ALTER TABLE `admin_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `jury_comments`
--
ALTER TABLE `jury_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `olimp`
--
ALTER TABLE `olimp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `quest`
--
ALTER TABLE `quest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tur`
--
ALTER TABLE `tur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `user_question`
--
ALTER TABLE `user_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
