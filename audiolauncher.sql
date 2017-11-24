-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2017 at 02:12 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `audiolauncher`
--

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE `audio` (
  `audio_id` int(8) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `artist` varchar(120) NOT NULL,
  `description` mediumtext NOT NULL,
  `file` varchar(300) NOT NULL,
  `thumb` varchar(200) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `views` int(8) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audio`
--

INSERT INTO `audio` (`audio_id`, `title`, `artist`, `description`, `file`, `thumb`, `duration`, `views`) VALUES
(1, 'Love The Way You Lie', 'Eminem & Rihanna', 'This smash hit saw Eminem and Rihanna reflect on their ambivalent and abusive relationships with their respective ex-partners Kim & Chris Brown.\r\nThe track’s chorus was written by Skylar Grey (in under 15 minutes) about her abusive relationship with the music industry.', 'Eminem-Rihanna - Love the way you lie  - AudioLauncher.mp3', 'Eminem-Rihanna - Love the way you lie  - AudioLauncher.jpg', '', 150),
(2, 'Boulevard of Broken Dreams', 'Green Day', 'Green Day is an American punk rock band formed in 1986 by lead vocalist and guitarist Billie Joe Armstrong and bassist Mike Dirnt. For much of the band\'s career, they have been a trio with drummer Tré Cool, who replaced John Kiffmeyer in 1990 prior to the recording of the band\'s second studio album, Kerplunk (1991). Guitarist Jason White, who has been a touring member since 1999, was a member from 2012 to 2016.', 'Green Day - Boulevard of Broken Dreams - AudioLauncher.mp3', 'Green Day - Boulevard of Broken Dreams - AudioLauncher.jpg', '', 47),
(3, 'Crawling', 'Linkin Park', 'Chester felt trapped by his need for escape, overwhelmed by his insecurities and his demons that existed outside of his drug abuse. When people take drugs while happy, and spiritually self-aligned to their core personal values, moderation is easy. But without any confidence and the feeling that reality cannot be dealt with or comprehended, substance or behavioral abuse becomes a ritual to numb out the pain you cannot stand, sapping away self-control as the behavior becomes conditionally reinforced, creating an addiction.', 'Linkin Park - Crawling  - AudioLauncher.mp3', 'Linkin Park - Crawling  - AudioLauncher.jpg', '', 13),
(4, 'Beat it', 'Michael Jackson', '\"Beat It\" is a song written and performed by American singer Michael Jackson single from the singer\'s sixth solo album, Thriller (1982). The song was produced by Quincy Jones together with Jackson. Following the successful chart performances of the Thriller singles \"The Girl Is Mine\" and \"Billie Jean\", \"Beat It\" was released on February 14, 1983 as the album\'s third single. The song is also notable for its famous video, which featured Jackson bringing two gangs together through the power of music and dance.', 'Michael Jackson - Beat it - AudioLauncher.mp3', 'Michael Jackson - Beat it - AudioLauncher.jpg', '', 22),
(14, 'Wakka Wakka', 'Shakira', ' Type Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description HereType Short Description Here Type Short Description Here', '1511485718Shakira - Wakka Wakka - AudioLauncher.mp3', '1511485718Shakira - Wakka Wakka - AudioLauncher.jpg', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `audio_genre`
--

CREATE TABLE `audio_genre` (
  `audio_id` int(8) UNSIGNED NOT NULL,
  `genre_id` int(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audio_genre`
--

INSERT INTO `audio_genre` (`audio_id`, `genre_id`) VALUES
(1, 1),
(2, 7),
(3, 7),
(4, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(10) UNSIGNED NOT NULL,
  `genre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre`) VALUES
(1, 'Pop'),
(2, 'Rock'),
(3, 'Pop'),
(4, 'Electronic'),
(5, 'HipHop'),
(6, 'Jazz'),
(7, 'Metal'),
(8, 'Folk'),
(9, 'Dubstep'),
(10, 'Blues'),
(11, 'Country'),
(12, 'Rock'),
(13, 'Grunge'),
(14, 'Disco'),
(15, 'Classical'),
(16, 'Rock'),
(17, 'Instrumental'),
(18, 'Acoustic'),
(19, 'Voice');

-- --------------------------------------------------------

--
-- Table structure for table `interactions`
--

CREATE TABLE `interactions` (
  `interaction_id` int(20) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `user_id` int(8) NOT NULL,
  `audio_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interactions`
--

INSERT INTO `interactions` (`interaction_id`, `type`, `user_id`, `audio_id`) VALUES
(9, 1, 3, 1),
(10, 1, 4, 1),
(11, 1, 3, 11),
(12, 1, 3, 4),
(13, 1, 3, 2),
(14, 0, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `security_tokens`
--

CREATE TABLE `security_tokens` (
  `token_id` int(20) UNSIGNED NOT NULL,
  `content` varchar(50) NOT NULL,
  `user_id` int(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `used` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(70) NOT NULL,
  `lname` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '1',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `fname`, `lname`, `email`, `role`, `verified`, `join_date`) VALUES
(1, '$2y$10$X/DGKnmENyBWXDskkyEDcOFOODL7XsUbSOisu.rkH/rdkP3hf1u6i', 'Safayat', 'Jamil', 'safayatjamil27@gmail.com', 0, 1, '2017-08-28 17:56:29'),
(2, '$2y$10$gJ.GIAPmQEeud6VaExvPauBhjrN/ThekceNmDMQpewesR/lMwO8Ly', 'site', 'Admin', 'admin@site.com', 0, 1, '2017-10-16 23:42:18'),
(3, '$2y$10$XRKBI8iKoymZ.WW2pu.mbeGKWWDewaTepWHPi3muzK8CcKCb2BA.S', 'sa', 'sadik', 'sadik5397@gmail.com', 1, 1, '2017-11-23 12:44:55'),
(4, '$2y$10$RPF.KrPhyTLkhTe1LvRgfu.1vSD2lkhzp67yXQ9WO2cZzs7o0aySu', 'S.a.', 'Sadik', 's737083@mvrht.net', 1, 1, '2017-11-23 21:04:35'),
(5, '1bbd886460827015e5d605ed44252251', 'Test', 'User 01', 'test01@gmail.com', 1, 1, '2017-11-23 21:41:59'),
(6, 'bae5e3208a3c700e3db642b6631e95b9', 'Test', 'User 02', 'test02@gmail.com', 1, 1, '2017-11-23 21:46:10'),
(7, 'd27d320c27c3033b7883347d8beca317', 'Test', 'User 03', 'test03@gmail.com', 1, 1, '2017-11-23 21:47:16'),
(8, 'f638f4354ff089323d1a5f78fd8f63ca', 'Test', 'User 05', 'test05@gmail.com', 1, 1, '2017-11-23 21:48:56'),
(9, 'b857eed5c9405c1f2b98048aae506792', 'Test', 'User 04', 'test04@gmail.com', 1, 1, '2017-11-23 21:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_audio`
--

CREATE TABLE `user_audio` (
  `user_id` int(8) UNSIGNED NOT NULL,
  `audio_id` int(8) UNSIGNED NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_audio`
--

INSERT INTO `user_audio` (`user_id`, `audio_id`, `upload_time`) VALUES
(3, 1, '2017-11-23 18:38:08'),
(7, 2, '2017-11-23 22:21:59'),
(8, 3, '2017-11-23 22:22:09'),
(5, 4, '2017-11-23 22:29:16'),
(3, 14, '2017-11-24 01:08:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`audio_id`);

--
-- Indexes for table `audio_genre`
--
ALTER TABLE `audio_genre`
  ADD KEY `audio_id` (`audio_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `interactions`
--
ALTER TABLE `interactions`
  ADD PRIMARY KEY (`interaction_id`);

--
-- Indexes for table `security_tokens`
--
ALTER TABLE `security_tokens`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_audio`
--
ALTER TABLE `user_audio`
  ADD KEY `user_id` (`user_id`,`audio_id`),
  ADD KEY `audio_id` (`audio_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audio`
--
ALTER TABLE `audio`
  MODIFY `audio_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `interactions`
--
ALTER TABLE `interactions`
  MODIFY `interaction_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `security_tokens`
--
ALTER TABLE `security_tokens`
  MODIFY `token_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audio_genre`
--
ALTER TABLE `audio_genre`
  ADD CONSTRAINT `audio_genre_ibfk_1` FOREIGN KEY (`audio_id`) REFERENCES `audio` (`audio_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `audio_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_audio`
--
ALTER TABLE `user_audio`
  ADD CONSTRAINT `user_audio_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_audio_ibfk_2` FOREIGN KEY (`audio_id`) REFERENCES `audio` (`audio_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
