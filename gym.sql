-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 03:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE cart (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `product_id` INT,
    `quantity` INT DEFAULT 1,
    `added_on` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES product(product_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) -- Assuming a users table
);


--
-- Dumping data for table `cart`
--



-- --------------------------------------------------------

--
-- Table structure for table `gym_classes`
--

CREATE TABLE `gym_classes` (
  `id` int(100) NOT NULL,
  `ClassName` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Duration` time NOT NULL,
  `Schedule` varchar(100) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_classes`
--

INSERT INTO `gym_classes` (`id`, `ClassName`, `Description`, `Duration`, `Schedule`, `Price`, `Image`) VALUES
(1, 'Yoga Basics', 'A beginner-friendly class focusing on foundational yoga poses and breathing techniques', '08:00:00', 'Mon, Wed, Fri', 20000.00, 'gettyimages-1483989816-612x612.jpg'),
(2, 'HIIT Blast', 'High-Intensity Interval Training designed to burn fat and build endurance', '12:45:00', 'Tue, Thu', 5000.00, 'wCTSRhgDB4FZSUj87EB9m8-415-80.jpg'),
(3, 'Strength Training', 'Build muscle and strength through guided weight training exercises', '08:00:00', 'Mon, Wed, Fri', 12000.00, 'gettyimages-1058746296-612x612.jpg'),
(4, 'Pilates Core', 'A Pilates class targeting the core muscles for improved stability and balance', '20:00:00', 'Mon, Wed, Fri', 9000.00, 'istockphoto-1296318064-612x612.jpg'),
(5, 'Zumba Dance', 'Fun and energetic dance-based workout set to lively music', '11:22:00', 'Wed, Sat', 7000.00, '360_F_57623282_hAlPLvGVpvMHDd22chrmisxG6SEKoOzM.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_catagory` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `product_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_catagory`, `price`, `quantity`, `product_image`) VALUES
(6, ' Amino Energy', 'Strawberry', 6200, 10, '81MuFhvomyL._AC_SX569_.jpg'),
(7, 'Amino Acid', 'Strawberry', 4500, 10, 'a29714.jpg'),
(8, 'Cretaine', 'Chocolate', 5600, 15, 'OIP.jpeg'),
(9, 'Pump Mode', 'Chocolate', 34000, 20, '51uWoQTbNkL.jpg'),
(10, 'Anabolic Muscle Builder', 'Chocolate', 6000, 25, '41am+OoFoqL.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Mobilenumber` varchar(100) NOT NULL,
  `UserAddress` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `FirstName`, `LastName`, `Mobilenumber`, `UserAddress`, `Email`, `Password`, `image`) VALUES
(2, ' Areeb', ' Shakeer', '0771844366', ' Akurana', 'areeb@gmail.com', ' 123456', 'Untitled-1.png'),
(3, 'Yoonus', 'Anees', '0761310771', 'Kurugoda,Akurana', 'yoonusanees2002@gmail.com', '123', 'IWIN7835.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `id` int(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`id`, `Name`, `description`, `number`, `image`) VALUES
(5, 'ronaldo', 'Athlete', '85486', '0bec1e8c7ab8e942e360e669396a46a9.jpg'),
(6, 'Rodrigo', 'Yooga Trainer', '9435678934', '360_F_122694157_jjUIXTkpCHa3usyTZx4RCWDIjQqKsqzS.jpg'),
(7, 'Ramos', 'HHTT', '65409854', 'istockphoto-665330426-612x612.jpg'),
(8, 'Modric', 'Cardio Kickboxing', '567834788', 'istockphoto-475495254-612x612.jpg'),
(9, 'Marcelo', 'Strength Training', '74345678', '360_F_193913452_Ue8cAJL9bj5PyPSgeBhnktE82pKc8bzT.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `user_id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`user_id`, `username`, `password`, `email`, `number`) VALUES
(194, 'yoosuf', 'yoosuf123', 'yoosuf123@gmail.com', '0712391561'),
(195, 'yoonus', 'yoonus345', 'yoonusanees@gmail.com', '0812301561'),
(196, 'shakeer', 'shakee123', 'shakeer123@gmail.com', '0771415661');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gym_classes`
--
ALTER TABLE `gym_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gym_classes`
--
ALTER TABLE `gym_classes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
