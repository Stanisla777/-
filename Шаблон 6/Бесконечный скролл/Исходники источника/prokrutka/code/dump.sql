-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 11 2013 г., 12:21
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `maindb2`
--
CREATE DATABASE `maindb2` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `maindb2`;

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`title`),
  UNIQUE KEY `article_id` (`article_id`),
  UNIQUE KEY `article_id_2` (`article_id`),
  UNIQUE KEY `article_id_3` (`article_id`),
  UNIQUE KEY `article_id_4` (`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`article_id`, `title`, `text`) VALUES
(1, 'Статья 1', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(2, 'Статья 2', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(3, 'Статья 3', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(4, 'Статья 4', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(5, 'Статья 5', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(6, 'Статья 6', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(7, 'Статья 7', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(8, 'Статья 8', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(9, 'Статья 9', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(10, 'Статья 10', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(11, 'Статья 11', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(12, 'Статья 12', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(13, 'Статья 13', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(14, 'Статья 14', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(15, 'Статья 15', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(16, 'Статья 16', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(17, 'Статья 17', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(18, 'Статья 18', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(19, 'Статья 19', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(20, 'Статья 20', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(21, 'Статья 21', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(22, 'Статья 22', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(23, 'Статья 23', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(24, 'Статья 24', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(25, 'Статья 25', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(26, 'Статья 26', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(27, 'Статья 27', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(28, 'Статья 28', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(29, 'Статья 29', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(30, 'Статья 30', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(50, 'Статья 50', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(49, 'Статья 49', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(48, 'Статья 48', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(47, 'Статья 47', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(46, 'Статья 46', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(45, 'Статья 45', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(44, 'Статья 44', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(43, 'Статья 43', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(42, 'Статья 42', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(41, 'Статья 41', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(40, 'Статья 40', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(39, 'Статья 39', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(38, 'Статья 38', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(37, 'Статья 37', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(36, 'Статья 36', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(35, 'Статья 35', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(34, 'Статья 34', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(33, 'Статья 33', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(32, 'Статья 32', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)'),
(31, 'Статья 31', 'Это текст статьи. Текст достаточно короткий, но для глаза приятен:)');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
