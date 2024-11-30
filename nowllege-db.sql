-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 02:25 PM
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
-- Database: `nowllege-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(35) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'admin@admin.com', '$2y$10$b3GAX6.Pd6054RRQ8C9se.zfOhTljRkduBfAKWFrmtdKwj02aSTuq');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `article_title` varchar(250) NOT NULL,
  `article_image` varchar(200) NOT NULL,
  `article_description` text NOT NULL,
  `article_date` date NOT NULL,
  `article_trend` tinyint(4) NOT NULL,
  `article_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `category_id`, `author_id`, `article_title`, `article_image`, `article_description`, `article_date`, `article_trend`, `article_active`) VALUES
(40, 17, 5, 'Aarambh Sports Fest 2024 at IIIT Naya Raipur', 'article-17-1732964014.png', '*Aarambh Sports Fest 2024 at IIIT Naya Raipur*\r\n\r\nDate: 8th-10th August 2024\r\n\r\nThe much-awaited Aarambh Sports Fest 2024 at IIIT Naya Raipur concluded with a spectacular display of athleticism, teamwork, and competition. Held from August 8th to 10th, this annual event brought together participants from across the campus for an action-packed celebration of sportsmanship, featuring a mix of outdoor, indoor, and esports competitions.\r\n\r\n*The Event:*\r\n\r\nAarambh 2024 saw an overwhelming participation of 400 students who competed in a diverse array of sports. The event included thrilling outdoor challenges like football, cricket, and athletics, as well as indoor sports like badminton, table tennis, and basketball. For the esports enthusiasts, a variety of popular video games added an exciting digital twist to the fest.\r\n\r\n*The Teams:*\r\n\r\nThe competition was fierce, with four well-prepared teams – Renegades, Mavericks, Spartans , and  Titans – battling it out for supremacy across the various disciplines. Each team brought its own unique energy and strategy to the games, but only two could make it to the top.\r\n\r\n*The Champions:*\r\n\r\nAfter three days of intense competition, the Renegades emerged as the champions of Aarambh Sports Fest 2024, showcasing their exceptional skills, determination, and teamwork across both physical and esports challenges. Their triumph was hard-earned and celebrated by all participants and supporters alike.\r\n\r\nThe Mavericks gave the Renegades a run for their money and earned the coveted runner-up spot. Their passion and drive were evident in every game they played, making them formidable opponents throughout the event.\r\n\r\n**\r\nThe fest concluded with a grand closing ceremony where the champions and runners-up were awarded their well-deserved trophies and medals. The success of Aarambh Sports Fest 2024 not only highlighted the immense talent and enthusiasm at IIIT Naya Raipur but also set the bar high for future sports events at the institute.\r\n\r\nWe congratulate all the participants for their sportsmanship, and we look forward to even bigger and better editions of Aarambh in the future!', '2024-11-30', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(35) NOT NULL,
  `author_password` varchar(100) NOT NULL,
  `author_email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_password`, `author_email`) VALUES
(5, 'Vishesh', '$2y$10$SvRIbRw4yB25B023vjrk3uov/rqP5ip8IwMqYvHxgNLxESY1P2odm', 'vishesh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `bookmark_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL,
  `category_color` varchar(35) NOT NULL,
  `category_image` varchar(250) NOT NULL,
  `category_description` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_color`, `category_image`, `category_description`) VALUES
(15, 'Cultural Events', 'tag-yellow', 'Cultural Events1732961923.png', 'Cultural Events showcases campus festivals, performances, talent shows, and artistic expressions, celebrating diversity and creativity within the college community.'),
(16, 'Tech & Innovations', 'tag-green', 'Tech & Innovations1732962837.png', 'Fuel your curiosity with the latest in technology and innovation. Covering tech fests, hackathons, groundbreaking projects, and student startups, this category showcases ingenuity.'),
(17, 'Sports Arena', 'tag-orange', 'Sports Arena1732962971.png', 'The Sports Arena highlights college sports events, tournaments, student-athlete achievements, and recreational activities, fostering a competitive spirit on campus.'),
(18, 'Academics', 'tag-purple', 'Academics1732963163.png', 'Stay informed about academic events, examination schedules, new courses, and important campus announcements. This category also includes news about workshops, lectures, and academic achievements.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(35) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(7, 'Vishesh', 'vishesh@gmail.com', '$2y$10$SvRIbRw4yB25B023vjrk3uov/rqP5ip8IwMqYvHxgNLxESY1P2odm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`bookmark_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `bookmark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
