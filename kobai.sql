-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017 年 10 朁E15 日 13:13
-- サーバのバージョン： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kobai 作成`
CREATE DATABASE kobai;
USE kobai;
--

-- --------------------------------------------------------



--
-- テーブルの構造 `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`id`, `name`, `comment`) VALUES
(1, '惣菜パン', 'お昼にどうぞ'),
(2, '菓子パン', 'おやつにどうぞ'),
(3, 'その他', 'おいしいパン'),
(4, 'マフィン', 'おいしい'),
(8, 'サンドウィッチ', 'ハムサンドがオススメ');

-- --------------------------------------------------------

--
-- テーブルの構造 `member`
--

CREATE TABLE `member` (
  `id` int(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time` datetime NOT NULL
  `admin` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `member`
--

INSERT INTO `member` (`id`, `user_id`, `password`, `time`, `admin`) VALUES
(6, 'aki', '$2y$10$X7uOG/R2A1y8hmp3CK9mAuGd76ENtOPxlOZh80Lb5BO0PZOy1gdjC', '2017-10-12 12:20:06', `1`),
(7, '1', '$2y$10$Rimyj7grCL0lOxGAL.aUpukSfYlLRyjrHBsnhiJRlGo3Aprxgw3Vq', '2017-10-12 12:25:31', `1`),
(8, '123', '$2y$10$AtTNXlD3xe5uZTbTNg53/ebYJ4Qq/WEhmyqZbFXQcNHlhaQHPfd4y', '2017-10-12 12:27:50', `1`),
(9, '12345', '$2y$10$G2S1R2Zm2TxQLSbIFBubCu6IlVx0N5wXcbx5o4guCQmYB3SndnJie', '2017-10-14 06:34:02', `1`),
(10, '123456', '$2y$10$6tOn/QVlCbVsa2D/ui/J8.Dw79FZn08sead9IB5lAp2o3d57pFY6e', '2017-10-14 06:34:22', `1`);

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(255) NOT NULL,
  `dis_day` int(255) NOT NULL,
  `dis_value` int(255) NOT NULL,
  `day_limit` int(255) NOT NULL,
  `status` int(255) NOT NULL,
  `category` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `products`
--

INSERT INTO `products` (`id`, `name`, `value`, `dis_day`, `dis_value`, `day_limit`, `status`, `category`, `comment`) VALUES
(3, 'カレーパン（辛口）', 80, 7, 0, 20, 0, 1, '辛いカレーパンで眠気覚まし'),
(4, 'カレーパン（甘口）', 80, 7, 0, 0, 0, 1, '辛いものが苦手な方はこちら'),
(6, 'モーニングコーヒー', 90, 7, 0, 0, 0, 2, '生クリームとコーヒークリームがマッチ！'),
(7, 'ラスク', 50, 7, 0, 0, 0, 3, '牛乳を飲みながら食べたい'),
(8, '食パン', 120, 4, 15, 60, 0, 3, 'ジャムをお持ちの方はこちらをどうぞ'),
(9, 'くるみパン', 120, 3, 50, 30, 0, 1, 'くるみがおいしい'),
(11, 'メロンパン', 100, 2, 10, 20, 0, 1, '外はサクサク。中はしっとり。');

-- --------------------------------------------------------

--
-- テーブルの構造 `yoyaku`
--

CREATE TABLE `yoyaku` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `product` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `yoyaku`
--

INSERT INTO `yoyaku` (`id`, `user_id`, `product`, `quantity`, `date`, `status`) VALUES
(1000, 6, '3', '1', '2017-10-28 06:29:48', '1'),
(1001, 6, '4', '8', '2017-10-13 00:00:00', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `yoyaku`
--
ALTER TABLE `yoyaku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `yoyaku`
--
ALTER TABLE `yoyaku`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
