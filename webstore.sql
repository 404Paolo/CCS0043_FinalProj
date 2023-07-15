-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2023 at 04:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `coins`
--

CREATE TABLE `coins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coins`
--

INSERT INTO `coins` (`id`, `name`, `price`, `image`, `category`, `value`) VALUES
(0, 'Coin Handful', 99, 'assets/Coin_Handful.png', 'Coins', 100),
(1, 'Coin Stack', 249, 'assets\\Coin_Stack.png', 'Coins', 600),
(2, 'Coin Pouch', 499, 'assets\\Coin_Pouch.png', 'Coins', 1300),
(3, 'Coin Bucket', 999, 'assets\\Coin_Bucket.png', 'Coins', 2700),
(4, 'Coin Box', 1990, 'assets\\Coin_Box.png', 'Coins', 5600),
(5, 'Coin Heap', 4990, 'assets\\Coin_Heap.png', 'Coins', 15500);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `stock` int(5) NOT NULL,
  `price` int(5) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(80) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `stock`, `price`, `image`, `description`, `category`) VALUES
(0, 'Pokeball x20', 25, 100, 'assets\\Pokeball.png', 'Catch Pokemons', 'Pokeballs'),
(1, 'Pokeball x100', 14, 460, 'assets\\Pokeball100.png', 'Catch Pokemons', 'Pokeballs'),
(2, 'Pokeball x200', 5, 800, 'assets\\Pokeball200.png', 'Catch Pokemons', 'Pokeballs'),
(3, 'Incubator', 100, 150, 'assets\\Incubator_Limited.png', 'Hatch Pokemons', 'Incubators'),
(4, 'Super Incubator', 49, 200, 'assets\\Super_Incubator.png', 'Hatch Pokemons', 'Incubators'),
(5, 'Premium Battle Pass', 100, 100, 'assets\\Premium_Battle_Pass.png', 'Participate in raids', 'Battle Passes'),
(6, 'Remote Raid Pass x1', 50, 195, 'assets\\Remote_Raid_Pass.png', 'Remotely participate in raids', 'Battle Passes'),
(7, 'Remote Raid Pass x3', 15, 525, 'assets\\Remote_Raid_Pass3.png', 'Remotely participate in raids', 'Battle Passes'),
(8, 'Incense x1', 100, 80, 'assets\\Incense.png', 'Lure Pokemons to you', 'Incense'),
(9, 'Incense x8', 15, 500, 'assets\\Incense8.png', 'Lure Pokemons to you', 'Incense'),
(10, 'Incense x25', 5, 1250, 'assets\\Incense25.png', 'Lure Pokemons to you', 'Incense'),
(11, 'Max Potion x10', 20, 200, 'assets\\Max_Potion10.png', 'Restore Pokemon hp', 'Medicine'),
(12, 'Max Revive x6', 30, 180, 'assets\\Max_Revive6.png', 'Revive Pokemon', 'Medicine'),
(13, 'Lucky Egg x1', 150, 80, 'assets\\Lucky_Egg.png', 'Hatches into a Pokemon', 'Eggs'),
(14, 'Lucky Egg x8', 15, 500, 'assets\\Lucky_Egg8.png', 'Hatches into a Pokemon', 'Eggs'),
(15, 'Lucky Egg x25', 5, 1250, 'assets\\Lucky_Egg25.png', 'Hatches into a Pokemon', 'Eggs'),
(16, 'Lure Module x1', 50, 100, 'assets\\Lure_Module.png', 'Lures Pokemons to a spot', 'Lures'),
(17, 'Lure Module x8', 10, 680, 'assets\\Lure_Module8.png', 'Lures Pokemons to a spot', 'Lures'),
(18, 'Glacial Lure Module x1', 50, 200, 'assets\\Glacial_Lure_Module.png', 'Lures Pokemons to a spot', 'Lures'),
(19, 'Mossy Lure Module x1', 50, 200, 'assets\\Mossy_Lure_Module.png', 'Lures Pokemons to a spot', 'Lures'),
(20, 'Magnetic Lure Module x1', 50, 200, 'assets\\Magnetic_Lure_Module.png', 'Lures Pokemons to a spot', 'Lures'),
(21, 'Rainy Lure Module x1', 50, 200, 'assets\\Rainy_Lure_Module.png', 'Lures Pokemons to a spot', 'Lures'),
(22, 'Bag Upgrade', 63, 200, 'assets\\Bag_Upgrade.png', 'Increase Bag Capacity', 'Upgrades'),
(23, 'Pokemon Storage Upgrade', 118, 200, 'assets\\Storage_Upgrade.png', 'Increase Pokemon Storage', 'Upgrades'),
(24, 'Postcard Storage Upgrade', 13, 100, 'assets\\Postcard_Storage_Upgrade.png', 'Increase Postcard Storage', 'Upgrades'),
(25, 'New Trainer Box', 100, 75, 'assets\\New_Trainer_Box.png', 'Assorted Items', 'Boxes'),
(26, 'Beginner Box', 50, 150, 'assets\\Beginner_Box.png', 'Assorted Items', 'Boxes'),
(27, 'Trainee Box', 40, 215, 'assets\\Trainee_Box.png', 'Assorted Items', 'Boxes'),
(28, 'Voyager Box', 20, 1485, 'assets\\Voyager_Box.png', 'Assorted Items', 'Boxes'),
(29, 'Team Medallion', 1, 1000, 'assets\\Team_Medallion.png', 'Change teams(One-time use)', 'Others'),
(30, 'Poffin', 100, 100, 'assets\\Poffin.png', 'Boost Pokemon\'s\" Conditions', 'Others'),
(31, 'Star Piece x1', 100, 80, 'assets\\Star_Piece.png', 'Stardust boost', 'Others'),
(32, 'Star Piece x8', 19, 640, 'assets\\Star_Piece8.png', 'Stardust boost', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` varchar(50) NOT NULL,
  `transaction_type` varchar(10) NOT NULL,
  `bill` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_date`, `user_id`, `cart_id`, `transaction_type`, `bill`) VALUES
('2023-07-15 16:51:21', 1, '1', 'coins', 249),
('2023-07-15 16:51:31', 1, '1', 'item', 460);

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
  `pass` varchar(50) NOT NULL,
  `balance` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `user_name`, `ign`, `email`, `pass`, `balance`) VALUES
(1, 'Christian Paolo M. Reyes', 'Admin', '0000-0000-0000', 'paolo@gmail.com', '00000000', 140);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coins`
--
ALTER TABLE `coins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_date`,`user_id`,`cart_id`,`transaction_type`);

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
