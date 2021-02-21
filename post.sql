-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2021 at 09:36 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bluesky`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `body`, `author`, `published`, `created_at`) VALUES
(1, 'Dark Necessities', 'You got sneak attacked from the zodiac', 'Mike', 0, '2021-02-20 21:21:47'),
(5, '6 Best Fonts for programming in 2021', 'Eye fatigue (also known as Asthenopia) can be a serious issue and spending hours on end in the default VSCode setup can be tempting', 'Braydon Coyer', 1, '2021-02-21 20:21:59'),
(6, '11 Easy UI Design Tips for Web Devs', 'Whilst learning web development, most of us don?t have much design experience or access to a UI designer. So here are 11 easy to apply UI design fundamentals to make your projects look sleek and modern.', 'Danny Adams', 1, '2021-02-21 20:48:18'),
(7, 'I Created Famous Logos with CSS', 'CSS is a powerful tool that can do almost anything once you have had a full grasp of it. Sometimes we\'re not aware of all the things you can do with CSS, and end up taking a complicated route to do what we need to be done. That\'s why we need to always practice CSS and grow our skills in it and knowledge of it.', 'Shahed Nasser', 1, '2021-02-21 20:50:00'),
(8, 'HTML tags Cheat Sheet', 'Hello World! Today I created for you a cheat sheet with all the html tags you may need (And a miscellaneous of other useful stuff in html).', 'DevLorenzo', 1, '2021-02-22 00:41:57'),
(9, 'My productivity setup ( VS Code )', 'In this post I am gonna show you my personal vs code setup! Which makes me more productive. And gives me inspiration to do more coding. I will show you how turn this boring one', 'Ratful', 1, '2021-02-22 00:49:54'),
(10, 'test only', 'lorem test', 'yoyow', 0, '2021-02-22 03:19:49'),
(11, 'test2', 'test2', 'test2', 0, '2021-02-22 03:20:04'),
(12, 'test3', 'test3', 'test3', 0, '2021-02-22 03:20:53'),
(13, 'test5', 'test5', 'test5', 0, '2021-02-22 03:21:14'),
(14, 'test6', 'test6', 'test6', 0, '2021-02-22 03:26:18'),
(15, 'test7', 'test7', 'test7', 0, '2021-02-22 03:26:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
