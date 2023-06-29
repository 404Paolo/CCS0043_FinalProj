-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2023 at 09:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `stock` int(5) NOT NULL,
  `price` int(5) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `stock`, `price`, `image`) VALUES
(0, 'Team Medallion', 1, 1000, 'assetsTeam_Medallion.png'),
(1, 'Incubator', 100, 150, 'assetsIncubator_Limited.png'),
(2, 'Super Incubator', 50, 200, 'assetsSuper_Incubator.png'),
(3, 'Premium Battle Pass x1', 100, 100, 'assetsPremium_Battle_Pass.png'),
(4, 'Premium Battle Pass x3', 30, 250, 'assetsPremium_Battle_Pass.png'),
(5, 'Remote Raid Pass x1', 5, 195, 'assetsRemote_Raid_Pass.png'),
(6, 'Remote Raid Pass x3', 1, 525, 'assetsRemote_Raid_Pass.png'),
(7, 'Poffin', 100, 100, 'assetsPoffin.png'),
(8, 'Pokeball x20', 25, 100, 'assetsPokeball.png'),
(9, 'Pokeball x100', 15, 460, 'assetsPokeball100.png'),
(10, 'Pokeball x200', 5, 800, 'assetsPokeball200.png'),
(11, 'Incense x1', 100, 80, 'assetsIncense.png'),
(12, 'Incense x8', 15, 500, 'assetsIncense8.png'),
(13, 'Incense x25', 5, 1250, 'assetsIncense25.png'),
(14, 'Star Piece x1', 100, 80, 'assetsStar_Piece.png'),
(15, 'Star Piece x8', 20, 640, 'assetsStar_Piece8.png'),
(16, 'Max Potion x10', 20, 200, 'assetsMax_Potion10.png'),
(17, 'Max Revive x6', 30, 180, 'assetsMax_Revive6.png'),
(18, 'Lucky Egg x1', 150, 80, 'assetsLucky_Egg.png'),
(19, 'Lucky Egg x8', 15, 500, 'assetsLucky_Egg8.png'),
(20, 'Lucky Egg x25', 5, 1250, 'assetsLucky_Egg25.png'),
(21, 'Lure Module x1', 50, 100, 'assetsLure_Module.png'),
(22, 'Lure Module x8', 10, 680, 'assetsLure_Module8.png'),
(23, 'Glacial Lure Module x1', 50, 200, 'assetsGlacial_Lure_Module.png'),
(24, 'Mossy Lure Module x1', 50, 200, 'assetsMossy_Lure_Module.png'),
(25, 'Magnetic Lure Module x1', 50, 200, 'assetsMagnetic_Lure_Module.png'),
(26, 'Rainy Lure Module x1', 50, 200, 'assetsRainy_Lure_Module.png'),
(27, 'Bag Upgrade', 63, 200, 'assetsBag_Upgrade.png'),
(28, 'Pokemon Storage Upgrade', 118, 200, 'assetsStorage_Upgrade.png'),
(29, 'Postcard Storage Upgrade', 13, 100, 'assetsPostcard_Storage_Upgrade.png'),
(30, 'New Trainer Box', 100, 75, 'assetsNew_Trainer_Box.png'),
(31, 'Beginner Box', 50, 150, 'assetsBeginner_Box.png'),
(32, 'Trainee Box', 40, 215, 'assetsTrainee_Box.png'),
(33, 'Voyager Box', 20, 1485, 'assetsVoyager_Box.png'),
(34, 'Coin Handful - 100', 100, 29, 'assetsCoin_Handful.png'),
(35, 'Coin Stack - 500', 100, 249, 'assetsCoin_Stack.png'),
(36, 'Coin Pouch - 1200', 100, 499, 'assetsCoin_Pouch.png'),
(37, 'Coin Bucket - 2500', 100, 999, 'assetsCoin_Bucket.png'),
(38, 'Coin Box - 5200', 100, 1990, 'assetsCoin_Box.png'),
(39, 'Coin Heap - 14500', 100, 4990, 'assetsCoin_Heap.png');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `user_id` int(11) NOT NULL,
  `cart_id` varchar(50) NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `ign` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `user_name`, `ign`, `email`, `pass`) VALUES
(1, 'Christian Paolo Reyes', '404_Paolo', 'Tupac', 'cpaolo852@gmail.com', '00000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`user_id`,`cart_id`,`transaction_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
