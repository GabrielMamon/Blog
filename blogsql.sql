-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 05, 2019 at 01:09 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Gaming');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_07_05_025656_create_post_table', 2),
(4, '2019_07_05_031410_add_coverimage_to_post_table', 3),
(5, '2019_07_05_055658_create_category_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author` bigint(20) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_slugged` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagepath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `author`, `title`, `title_slugged`, `content`, `imagepath`, `category`, `created_at`, `updated_at`) VALUES
(7, 1, 'Cyberpunk 2077', 'cyberpunk-2077', 'Cyberpunk 2077 is an upcoming role-playing video game developed and published by CD Projekt, releasing for Microsoft Windows, PlayStation 4, and Xbox One on 16 April 2020. Adapted from the 1988 tabletop game Cyberpunk 2020, it is set fifty-seven years later in dystopian Night City, California, an open world with six distinct regions. In a first-person perspective, players assume the role of the customisable mercenary V, who can reach prominence in three character classes by applying experience points to stat upgrades. V has an arsenal of ranged weapons and options for melee combat.\r\n\r\nCyberpunk 2077 is being developed by CD Projekt Red, an internal studio within CD Projekt, using the REDengine 4 game engine. They launched a new division in Wrocław and partnered with Digital Scapes to assist production. Around 450 total staff members are involved with the development, exceeding the number that worked on the studio\'s previous game, The Witcher 3: Wild Hunt. Cyberpunk 2020 creator Mike Pondsmith consulted on the project and actor Keanu Reeves has a starring role.', 'uploaded/cover/cyberpunk-2077_1562328803.jpg', 'Games', '2019-07-05 12:13:23', '2019-07-05 12:13:23'),
(8, 1, 'JoJo\'s Bizarre Adventure: Golden Wind', 'jojos-bizarre-adventure-golden-wind', 'Vento Aureo (黄金の風 Ōgon no Kaze), translated into English as Golden Wind, is the fifth story arc of JoJo\'s Bizarre Adventure, serialized in Weekly Shōnen Jump from December 1995 to April 1999. Originally titled JoJo\'s Bizarre Adventure Part 5 Giorno Giovanna: Golden Heritage (ジョジョの奇妙な冒険 第5部 ジョルノ・ジョバァーナ【黄金なる遺産】 JoJo no Kimyō na Bōken Dai Go Bu Joruno Jobāna [Ōgon naru Isan]), the arc spans a total of 155 chapters and takes place after Diamond is Unbreakable.\r\n\r\nSet in 2001 Italy, the story follows Giorno Giovanna and his dream to rise within the Neapolitan mafia and defeat the boss of Passione, the most powerful and influential gang, in order to become a \"Gang-Star\". With the aid of a capo and his men, and fueled by his own resolve, Giorno sets out to fulfill his goal of absolving the mafia of its corruption.', 'uploaded/cover/jojos-bizarre-adventure-golden-wind_1562330229.jpg', 'Anime', '2019-07-05 12:37:09', '2019-07-05 12:37:09'),
(9, 1, 'Aireal drones/ quadcopter review 2019', 'aireal-drones-quadcopter-review-2019', 'An unmanned aerial vehicle (UAV) (or uncrewed aerial vehicle,[2] commonly known as a drone) is an aircraft without a human pilot on board. UAVs are a component of an unmanned aircraft system (UAS); which include a UAV, a ground-based controller, and a system of communications between the two. The flight of UAVs may operate with various degrees of autonomy: either under remote control by a human operator or autonomously by onboard computers.[3]\r\n\r\nCompared to crewed aircraft, UAVs were originally used for missions too \"dull, dirty or dangerous\"[4] for humans. While they originated mostly in military applications, their use is rapidly expanding to commercial, scientific, recreational, agricultural, and other applications,[5] such as policing, peacekeeping,[6] and surveillance, product deliveries, aerial photography, smuggling,[7] and drone racing. Civilian UAVs now vastly outnumber military UAVs, with estimates of over a million sold by 2015.', 'uploaded/cover/aireal-drones-quadcopter-review-2019_1562331908.jpg', 'Technology', '2019-07-05 13:05:08', '2019-07-05 13:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'DemoAcc', 'demoaccount@gmail.com', NULL, '$2y$10$aKeJIDmB7gIot6n2/VvdreQLdDa4Uc8nkJBMbl72ZvPRKU.NbZxlC', NULL, '2019-07-05 05:08:32', '2019-07-05 05:08:32'),
(2, 'Forsite', 'forsite@gmail.com', NULL, '$2y$10$MAt6W4AbubrTyxC0h0xNjO5R.9rTIcVGmUAZdk/sZlELbrECZOlFm', NULL, '2019-07-05 04:05:14', '2019-07-05 04:05:14'),
(4, 'Gabriel', 'gabrielmamon444@gmail.com', NULL, '$2y$10$NIAQhHjqcfk/IK9iDIx.nuBpph94xWgjl3.aWCvacvDDf52ufUvm6', NULL, '2019-07-04 18:47:16', '2019-07-04 18:47:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
