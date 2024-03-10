-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-03-10 02:33:02
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `php_work`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `service_table`
--

CREATE TABLE `service_table` (
  `id` int(11) NOT NULL,
  `line_up` varchar(40) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `price` int(40) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `time_stamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `service_table`
--

INSERT INTO `service_table` (`id`, `line_up`, `service_name`, `price`, `img_path`, `time_stamp`) VALUES
(69, 'PCメンテナンス', '各部品を清掃し、劣化した部品があればリストを作成します。', 20000, './up-images/image 3.png', '2024-03-08 11:21:35'),
(70, 'PC構築', 'お客様が購入して、当店に持ち込んでいただいた部品を組立いたします。', 20122, './up-images/image 7.png', '2024-03-08 11:35:05');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `service_table`
--
ALTER TABLE `service_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `img_pass` (`img_path`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `service_table`
--
ALTER TABLE `service_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
