-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2021 at 02:37 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_ewm`
--

-- --------------------------------------------------------

--
-- Table structure for table `ewaste`
--

CREATE TABLE `ewaste` (
  `e_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `e_type` varchar(100) NOT NULL,
  `e_name` varchar(200) NOT NULL,
  `e_age` int(11) NOT NULL,
  `e_quantity` int(11) NOT NULL,
  `e_specs` text NOT NULL,
  `e_img` text NOT NULL,
  `date` text NOT NULL,
  `s_id` int(11) NOT NULL,
  `problem` varchar(4000) NOT NULL,
  `service_feedback` varchar(4000) NOT NULL,
  `r_id` int(11) NOT NULL,
  `recycler_feedback` varchar(4000) NOT NULL,
  `s_creditpoints` int(11) NOT NULL,
  `r_creditpoints` int(11) NOT NULL,
  `buy_nobuy` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ewaste`
--

INSERT INTO `ewaste` (`e_id`, `u_id`, `e_type`, `e_name`, `e_age`, `e_quantity`, `e_specs`, `e_img`, `date`, `s_id`, `problem`, `service_feedback`, `r_id`, `recycler_feedback`, `s_creditpoints`, `r_creditpoints`, `buy_nobuy`) VALUES
(9, 1, 'laptop/pc', 'IphoneX', 12, 1, 'Apple A11 Bionic (10 nm)\r\nCPU	Hexa-core 2.39 GHz (2x Monsoon + 4x Mistral)', 'http://[::1]/CI_EWM/uploads/ewaste/iphone.jpg', '2020-12-07 17:38:09', 1, '', '', 1, 'recycled', 0, 0, 1),
(10, 1, 'tv', 'Sony 21009', 20, 1, 'Screen blurred\r\npictures black', 'http://[::1]/CI_EWM/uploads/ewaste/tv.jpeg', '2021-04-06 12:24:18', 1, 'chalo', '3', 1, 'Donw with recycling', 3, 3, 0),
(11, 1, 'mobile', 'Samsung M31', 24, 1, '8gb ram\r\n20mp front camera\r\n20 mp back camera\r\nandroid 10', 'http://[::1]/CI_EWM/uploads/ewaste/m31.JPG', '2021-01-09 09:48:45', 1, 'display', 'replaced display', 1, 'High temperature degradation', 0, 2, 0),
(12, 1, 'tv', 'MI TV A4 Pro', 12, 2, 'Resolution: HD Ready Android TV (1366x768) | Refresh Rate: 60 hertz\r\nConnectivity: 3 HDMI ports to connect set top box, Blu Ray players, gaming console | 2 USB ports to connect hard drives and other USB devices', 'http://[::1]/CI_EWM/uploads/ewaste/mi.JPG', '2021-01-09 09:51:58', 1, 'Screen is blurr', 'Replaced the led tube', 1, 'Done with high temprature segmentation', 3, 1, 0),
(13, 1, 'mobile', 'OnePlus 7', 24, 5, '10gb ram\r\n20mp front camera\r\n30mp backcamera\r\n10W fast charging\r\nFHD+ display\r\n', 'http://[::1]/CI_EWM/uploads/ewaste/oneplus.JPG', '2021-01-14 15:58:12', 1, '', '', 0, '', 0, 0, 0),
(14, 1, 'tv', 'Redmi 4A', 12, 1, '4gb ram', 'http://[::1]/CI_EWM/uploads/ewaste/m314.JPG', '2021-01-16 17:57:57', 1, 'Led tube is fine else everything is old and cannot be recyclced', 'Forwarded to recycler', 0, '', 2, 0, 1),
(15, 1, 'mobile', 'Redmi 4000', 12, 2, '48MP rear camera with ultra-wide, macro, depth sensor, portrait, night mode, ai scene recognition, hdr, pro mode | 13MP front camera\r\n16.5862 centimeters (6.53-inch) FHD+ display with multi-touch capacitive touchscreen with 2340 x 1080 pixels resolution | 19.5:9 aspect ratio\r\nMemory, Storage & SIM: 4GB RAM | 64GB internal memory expandable up to 512GB |', 'http://[::1]/CI_EWM/uploads/ewaste/nokia4.JPG', '2021-03-27 18:44:54', 1, 'Phone is absoultely old and not working except it\'s camera', 'forwarded to recycler', 0, '', 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `Tracking` varchar(50) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `u_id`, `s_id`, `amount`, `Tracking`, `date`) VALUES
(5, 1, 0, 50000, '0', '2021-03-21 19:18:55'),
(6, 1, 0, 50000, '0', '2021-03-27 18:39:35'),
(7, 1, 0, 30000, '0', '2021-03-27 18:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `Tracking` varchar(100) NOT NULL,
  `date` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `o_id`, `p_id`, `s_id`, `u_id`, `quantity`, `amount`, `Tracking`, `date`, `rating`, `review`) VALUES
(7, 5, 1, 1, 1, 1, 30000, 'Delivered', '2021-03-21 19:18:55', 5, 'amazing product love it'),
(8, 5, 2, 1, 1, 1, 20000, 'Delivered', '2021-03-21 19:18:55', 4, 'good product could have been better, love the camera and the processor, best in the\r\nsegment. Hopefully they will improve the next generation durability as this one is too weak'),
(9, 6, 1, 1, 1, 1, 30000, '', '2021-03-27 18:39:35', 0, ''),
(10, 6, 2, 1, 1, 1, 20000, 'Delivered', '2021-03-27 18:39:35', 3, 'good product, wish that i could have got the delivery earlier though, product is sleek and utility wise it is no1'),
(11, 7, 1, 1, 1, 1, 30000, 'Delivered', '2021-03-27 18:40:14', 3, 'very nice product must buy!');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(10) NOT NULL,
  `s_id` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_type` varchar(100) NOT NULL,
  `p_specs` varchar(500) NOT NULL,
  `p_quantity` int(11) NOT NULL,
  `p_age` int(10) NOT NULL,
  `date` text NOT NULL,
  `p_cost` int(10) DEFAULT NULL,
  `p_img1` varchar(200) NOT NULL,
  `p_img2` varchar(200) NOT NULL,
  `p_img3` varchar(200) NOT NULL,
  `avg_rating` int(11) NOT NULL,
  `no_reviews` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `s_id`, `p_name`, `p_type`, `p_specs`, `p_quantity`, `p_age`, `date`, `p_cost`, `p_img1`, `p_img2`, `p_img3`, `avg_rating`, `no_reviews`) VALUES
(1, 1, 'IphoneX', 'Mobile Phone', 'Iphone', 5, 0, '', 30000, 'http://[::1]/CI_EWM/uploads/service/products/iphonex.png', '', '', 4, 2),
(2, 1, 'One Plus', 'Mobile Phone', 'one plus', 5, 0, '', 20000, 'http://[::1]/CI_EWM/uploads/service/products/oneplus8.jpg', '', '', 4, 2),
(6, 1, 'Nokia 5.3', 'Mobile Phone', 'Capture a whole range of new angles with the quad camera and ultra-wide 118° lens\r\nShoot like a pro with advanced AI imaging to bring your nighttime and portrait shots to life\r\nEnjoy videos and games with the powerful Qualcomm Snapdragon 665 processor and the impressive 6.55-inch HD+ screen\r\nStay charged for up to 2 days with the 4000 mAh battery and AI-assisted Adaptive Battery', 2, 10, '2021-03-17 19:53:30', 15000, 'http://[::1]/CI_EWM/uploads/service/products/nokia.jpg', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recycled_products`
--

CREATE TABLE `recycled_products` (
  `recycled_product_id` int(5) NOT NULL,
  `e_id` int(3) NOT NULL,
  `r_id` int(3) NOT NULL,
  `gold` int(3) NOT NULL,
  `silver` int(3) NOT NULL,
  `palladium` int(3) NOT NULL,
  `copper` int(3) NOT NULL,
  `other_metals` int(3) NOT NULL,
  `other_non_metals` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recycled_products`
--

INSERT INTO `recycled_products` (`recycled_product_id`, `e_id`, `r_id`, `gold`, `silver`, `palladium`, `copper`, `other_metals`, `other_non_metals`) VALUES
(1, 12, 1, 50, 50, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recycler`
--

CREATE TABLE `recycler` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `pword` varchar(50) NOT NULL,
  `profile_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recycler`
--

INSERT INTO `recycler` (`id`, `fname`, `cname`, `role`, `contact`, `email`, `address`, `pword`, `profile_img`) VALUES
(1, 'Vandit Popat', 'Vandit Private LTD', 'recycler', 9876543219, 'vandit@gmail.com', 'Charni Road', 'vandit', 'http://[::1]/CI_EWM/uploads/profilepic/img_avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `pword` varchar(50) NOT NULL,
  `profile_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `fname`, `cname`, `role`, `contact`, `email`, `address`, `pword`, `profile_img`) VALUES
(1, 'Pranav Bhat', 'Pranav Ent', 'service', 1234567891, 'pranav@gmail.com', 'Mulund', 'pranav', 'http://[::1]/CI_EWM/uploads/profilepic/service/img_avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `pword` varchar(50) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `creditpoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `cname`, `role`, `contact`, `email`, `address`, `pword`, `profile_img`, `creditpoints`) VALUES
(1, 'Rohan Shah', 'Rohan Corps', 'user', 8169885434, 'rohan27@somaiya.edu', 'Byculla, Mumbai', 'rohan', 'http://[::1]/CI_EWM/uploads/profilepic/user/KJSCE1.JPG', 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ewaste`
--
ALTER TABLE `ewaste`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `recycled_products`
--
ALTER TABLE `recycled_products`
  ADD PRIMARY KEY (`recycled_product_id`);

--
-- Indexes for table `recycler`
--
ALTER TABLE `recycler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email_id` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ewaste`
--
ALTER TABLE `ewaste`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recycled_products`
--
ALTER TABLE `recycled_products`
  MODIFY `recycled_product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recycler`
--
ALTER TABLE `recycler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
