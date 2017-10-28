-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017 年 10 朁E27 日 09:43
-- サーバのバージョン： 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kobai`
--
CREATE DATABASE IF NOT EXISTS `kobai` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `kobai`;

-- --------------------------------------------------------

--
-- テーブルの構造 `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`id`, `name`, `comment`) VALUES
(1, '惣菜パン', 'お昼にどうぞ'),
(2, '菓子パン', 'おやつにどうぞ'),
(3, 'その他', 'おいしいパン'),
(4, 'マフィン', 'おいしい'),
(8, 'サンドウィッチ', 'ハムサンドがオススメ'),
(9, 'パイ', 'さくさく生地');

-- --------------------------------------------------------

--
-- テーブルの構造 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `admin` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- テーブルのデータのダンプ `member`
--

INSERT INTO `member` (`id`, `user_id`, `password`, `time`, `admin`) VALUES
(1, 'admin', '$2y$10$9Cy6csfkTVKBSVfycGJrE.RWrJnyqIOlCpwo59KoeA1Y56YUMqefG', '2017-10-12 00:00:00', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(255) NOT NULL 
  _INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` int(255) NOT NULL,
  `dis_day` int(255) NOT NULL,
  `dis_value` int(255) NOT NULL,
  `day_limit` int(255) NOT NULL,
  `status` int(255) NOT NULL,
  `category` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- テーブルのデータのダンプ `products`
--

INSERT INTO `products` (`id`, `name`, `value`, `dis_day`, `dis_value`, `day_limit`, `status`, `category`, `comment`) VALUES
(1, 'カレーパン（辛口）', 80, 7, 0, 20, 0, 1, '辛いカレーパンで眠気覚まし'),
(2, 'カレーパン（甘口）', 80, 7, 0, 20, 0, 1, '辛いものが苦手な方はこちら'),
(3, 'モーニングコーヒー', 90, 7, 0, 10, 0, 2, '生クリームとコーヒークリームがマッチ！'),
(4, 'ラスク', 50, 7, 0, 20, 0, 3, '牛乳を飲みながら食べたい'),
(5, '食パン', 120, 4, 15, 60, 0, 3, 'ジャムをお持ちの方はこちらをどうぞ'),
(6, 'くるみパン', 120, 3, 50, 30, 0, 1, 'なつかしい中国を思い出す味'),
(7, 'オレンジパン', 18, 7, 0, 2, 0, 9, 'おいしいおいしい');

-- --------------------------------------------------------

--
-- テーブルの構造 `yoyaku`
--

DROP TABLE IF EXISTS `yoyaku`;
CREATE TABLE IF NOT EXISTS `yoyaku` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
