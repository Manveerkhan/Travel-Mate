-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2025 at 08:59 AM
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
-- Database: `travel_mate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(4, 'admin', '$2y$10$VOFOO7BOkNhPr6dTDEz4uulLZwx190wllGPt0XHfxBgUoXdOxiRQu');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `package_id`, `booking_date`, `status`, `created_at`) VALUES
(1, 1, 2, '2025-03-01', 'Approved', '2025-10-31 19:15:24'),
(2, 1, 16, '2025-01-30', 'Approved', '2025-10-31 19:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `description`, `image`) VALUES
(1, 'Goa', 'Sun-kissed beaches, vibrant nightlife, Portuguese heritage, and seafood shacks.', 'goa.jpg'),
(2, 'Jaipur', 'The Pink City with forts, palaces, bazaars, and rich Rajasthani culture.', 'jaipur.jpg'),
(3, 'Kerala Backwaters', 'Serene backwaters, houseboats, coconut lagoons, and lush greenery.', 'kerala-backwaters.jpg'),
(4, 'Manali', 'Himachal\'s hill station for snow, adventure sports, and mountain vistas.', 'manali.jpg'),
(5, 'Leh–Ladakh', 'High-altitude deserts, monasteries, Pangong Lake and epic road trips.', 'ladakh.jpg'),
(6, 'Rishikesh', 'Yoga capital on the Ganges, river rafting, and Himalayan foothills.', 'rishikesh.jpg'),
(7, 'Andaman & Nicobar', 'Turquoise waters, coral reefs, and pristine islands like Havelock.', 'andaman.jpg'),
(8, 'Varanasi', 'Spiritual capital on the Ganges with ancient ghats and rituals.', '1761938877_march24.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `destination_id`, `title`, `price`, `duration`, `image`) VALUES
(1, 1, 'Goa Beach Escape – North & South Highlights', 18999.00, '4 days / 3 nights', 'goa-beach-escape.jpg'),
(2, 1, 'Goa Leisure & Water Sports', 25999.00, '5 days / 4 nights', 'goa-water-sports.jpg'),
(3, 2, 'Jaipur Heritage Circuit with Amber Fort', 14999.00, '3 days / 2 nights', 'jaipur-heritage.jpg'),
(4, 2, 'Royal Rajasthan: Jaipur City & Markets', 17999.00, '4 days / 3 nights', 'jaipur-markets.jpg'),
(5, 3, 'Kerala Backwaters Houseboat Stay', 27999.00, '3 days / 2 nights', 'kerala-houseboat.jpg'),
(6, 3, 'Cochin–Alleppey–Munnar Scenic Kerala', 34999.00, '6 days / 5 nights', 'kerala-scenic.jpg'),
(7, 4, 'Manali Snow & Solang Adventure', 21999.00, '5 days / 4 nights', 'manali-solang.jpg'),
(8, 4, 'Manali–Rohtang Pass Explorer (Seasonal)', 24999.00, '5 days / 4 nights', 'manali-rohtang.jpg'),
(9, 5, 'Ladakh Essentials: Leh, Nubra & Pangong', 49999.00, '7 days / 6 nights', 'ladakh-essentials.jpg'),
(10, 5, 'Ladakh Monasteries & Lakes Expedition', 56999.00, '8 days / 7 nights', 'ladakh-monasteries.jpg'),
(11, 6, 'Rishikesh Yoga Retreat & Ganga Aarti', 12999.00, '3 days / 2 nights', 'rishikesh-yoga.jpg'),
(12, 6, 'Rishikesh Rafting & Camp Stay', 15999.00, '3 days / 2 nights', 'rishikesh-rafting.jpg'),
(13, 7, 'Andaman Highlights: Port Blair & Havelock', 43999.00, '5 days / 4 nights', 'andaman-highlights.jpg'),
(14, 7, 'Andaman Beach & Snorkeling Special', 46999.00, '6 days / 5 nights', 'andaman-snorkel.jpg'),
(15, 8, 'Varanasi Spiritual Sojourn with Ghat Walk', 11999.00, '3 days / 2 nights', 'varanasi-sojourn.jpg'),
(16, 8, 'Varanasi–Sarnath Heritage Trail', 14999.00, '4 days / 3 nights', 'varanasi-sarnath.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'avi', 'avi@gmail.com', '$2y$10$o3wkD2aIBseC7Twze2.CB.qLww2fwrFB1juLdf1/wZ/AfTVGIkEqi', '2025-10-31 19:14:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
