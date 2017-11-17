-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2017 at 07:28 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `superhero_dating`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `receiver_email` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_text` text NOT NULL,
  `sender_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `receiver_email`, `date`, `comment_text`, `sender_email`) VALUES
(2, 'damonMcCready@mail.com', '2017-11-16 10:06:07', 'REALLY DAD?!', 'mindyMcCready@mail.com'),
(3, 'daveLizewski@mail.com', '2017-11-16 10:07:08', 'Why do you have so many likes, when i don\'t....', 'chrisGenovese@mail.com'),
(4, 'chrisGenovese@mail.com', '2017-11-16 10:07:35', 'HA!', 'daveLizewski@mail.com'),
(20, 'daveLizewski@mail.com', '2017-11-16 17:54:12', 'Hey there!', 'mindyMcCready@mail.com'),
(27, 'chrisGenovese@mail.com', '2017-11-17 14:02:36', 'Hey!', 'mindyMcCready@mail.com'),
(28, 'mindyMcCready@mail.com', '2017-11-17 14:03:48', 'Hey beautiful', 'chrisGenovese@mail.com'),
(29, 'damonMcCready@mail.com', '2017-11-17 14:53:40', '-.-', 'mindyMcCready@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `title` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gift`
--

INSERT INTO `gift` (`title`, `image`, `description`) VALUES
('Chocolate', 'chocolate.jpg', 'Delicious chocolate!'),
('Flowers', 'flowers.jpg', 'Beautiful flowers!'),
('Villain', 'villain.jpg', 'A villain to fight together!');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `receiver_email` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(50) NOT NULL,
  `message_text` text NOT NULL,
  `sender_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `receiver_email`, `date`, `subject`, `message_text`, `sender_email`) VALUES
(3, 'mindyMcCready@mail.com', '2017-11-16 16:19:46', 'Mindy!', 'Have you met some cute boys yet??', 'damonMcCready@mail.com'),
(4, 'mindyMcCready@mail.com', '2017-11-16 16:21:14', 'Villain hunt!', 'Hey Mindy! Nice to meet you yesterday. Wanna join for a villain hunt tonight? Let\'s meet at my place at 8 o\'clock.\r\nSee you!', 'daveLizewski@mail.com'),
(9, 'mindyMcCready@mail.com', '2017-11-17 17:26:11', 'Hallo?', 'Where you at Mindy? Can\'t reach you through your phone?', 'damonMcCready@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `image` varchar(100) NOT NULL,
  `superhero_name` varchar(50) NOT NULL,
  `superpower` varchar(200) NOT NULL,
  `profile_text` text NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `email`, `age`, `image`, `superhero_name`, `superpower`, `profile_text`, `likes`) VALUES
('Chris Genovese', 'chrisGenovese@mail.com', 16, 'redmist.jpg', 'Red Mist', 'Have a shitload of money', 'The son of corporate mafia boss Johnny G! Often cruising in my mistmobile - wanna join?', 9),
('Damon McCready', 'damonMcCready@mail.com', 43, 'bigdaddy.jpg', 'Big Daddy', 'A professional crimefighter and sniper', 'Really just in here to see what my daughter is doing...', 99),
('Dave Lizewski', 'daveLizewski@mail.com', 16, 'kickass.jpg', 'Kick-Ass', 'Hmmm.. I have a high tolerance for pain?', 'Always wanted to be a real-life superhero. Fights crime on daily basis. Looking for a sweet girl to fight crimes with!', 42),
('Mindy McCready', 'mindyMcCready@mail.com', 14, 'hitgirl.jpg', 'Hit-Girl', 'Deadly martial arts and weapons expert', 'A mix between John Rambo and Polly Pocket. Badass little girl! Wanna fight some criminals with me?', 120);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_gift`
--

CREATE TABLE `user_has_gift` (
  `receiver_email` varchar(100) NOT NULL,
  `gift_title` varchar(50) NOT NULL,
  `sender_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_has_gift`
--

INSERT INTO `user_has_gift` (`receiver_email`, `gift_title`, `sender_email`) VALUES
('chrisGenovese@mail.com', 'Chocolate', 'mindyMcCready@mail.com'),
('mindyMcCready@mail.com', 'Villain', 'daveLizewski@mail.com'),
('mindyMcCready@mail.com', 'Flowers', 'chrisGenovese@mail.com'),
('chrisGenovese@mail.com', 'Flowers', 'mindyMcCready@mail.com'),
('chrisGenovese@mail.com', 'Chocolate', 'mindyMcCready@mail.com'),
('mindyMcCready@mail.com', 'Chocolate', 'daveLizewski@mail.com'),
('damonMcCready@mail.com', 'Villain', 'mindyMcCready@mail.com'),
('daveLizewski@mail.com', 'Villain', 'mindyMcCready@mail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_ibfk_1` (`receiver_email`),
  ADD KEY `sender_email` (`sender_email`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`title`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`receiver_email`),
  ADD KEY `sender_email` (`sender_email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user_has_gift`
--
ALTER TABLE `user_has_gift`
  ADD KEY `user_email` (`receiver_email`),
  ADD KEY `gift_title` (`gift_title`),
  ADD KEY `sender_email` (`sender_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`receiver_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`sender_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`receiver_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`sender_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_has_gift`
--
ALTER TABLE `user_has_gift`
  ADD CONSTRAINT `user_has_gift_ibfk_1` FOREIGN KEY (`receiver_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_gift_ibfk_2` FOREIGN KEY (`gift_title`) REFERENCES `gift` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_gift_ibfk_3` FOREIGN KEY (`sender_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
