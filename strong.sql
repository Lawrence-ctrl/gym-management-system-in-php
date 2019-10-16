-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 30, 2019 at 03:25 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `strong`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_page`
--

CREATE TABLE `admin_page` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_photo` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_page`
--

INSERT INTO `admin_page` (`admin_id`, `admin_name`, `admin_photo`, `admin_phone`, `admin_email`, `admin_password`, `created_date`, `updated_date`) VALUES
(1, 'GMS', '0.png', '09972089188', 'lawrence@gmail.com', '12b967951c05d1432dd952e7d7bfe146', '2019-08-10 17:31:17', '2019-08-10 17:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `bookuser_id` int(11) NOT NULL,
  `bookuser_name` varchar(255) NOT NULL,
  `bookuser_email` varchar(255) NOT NULL,
  `bookuser_pass` varchar(255) NOT NULL,
  `bookuser_img` varchar(255) NOT NULL,
  `bookuser_phone` varchar(255) NOT NULL,
  `bookuser_address` text NOT NULL,
  `bookuser_fb` varchar(255) NOT NULL,
  `bookuser_status` int(11) NOT NULL,
  `bookdate` date NOT NULL,
  `enddate` date NOT NULL,
  `bookduration` int(11) NOT NULL,
  `bookuserplan` int(11) NOT NULL,
  `bookage` int(11) NOT NULL,
  `bookweight` float NOT NULL,
  `bookgender` int(11) NOT NULL,
  `booked` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `bookuser_id`, `bookuser_name`, `bookuser_email`, `bookuser_pass`, `bookuser_img`, `bookuser_phone`, `bookuser_address`, `bookuser_fb`, `bookuser_status`, `bookdate`, `enddate`, `bookduration`, `bookuserplan`, `bookage`, `bookweight`, `bookgender`, `booked`, `created_date`, `updated_date`) VALUES
(1, 1, 'Lawrence', 'lawrence@gmail.com', '5d41402abc4b2a76b9719d911017c592', '5d4e9b12ec3a4_obivan.png', '09972089188', 'North Dagon', 'Lawrence', 1, '2019-08-01', '2020-02-01', 3, 1, 22, 135, 1, 1, '2019-08-10 17:46:44', '2019-08-10 17:46:44'),
(10, 3, 'Tun Myint Aung', 'atun@gmail.com', '5d41402abc4b2a76b9719d911017c592', '5d68ccc2892fc_10_avatar-512.png', '09456789123', 'Mingalardon', 'Tun Myint Aung', 1, '2019-09-01', '2019-10-01', 1, 1, 22, 135, 1, 1, '2019-08-30 14:17:34', '2019-08-30 14:17:34'),
(11, 5, 'Thuta Yar Moe', 'staystrong@gmail.com', '5d41402abc4b2a76b9719d911017c592', '5d6c92263eb98_vector-avatars-avatar-icon-5.png', '09972089188', 'north dagon', 'lawrence', 1, '2019-09-02', '2020-09-02', 4, 1, 22, 135, 1, 1, '2019-09-02 10:23:42', '2019-09-02 10:23:42'),
(12, 6, 'Law Law', 'mgmg@gmail.com', '5d41402abc4b2a76b9719d911017c592', '5d6c92f2c8493_3_avatar-512.png', '09972089188', 'north dagon', 'lawrence', 1, '2019-09-03', '2019-12-03', 2, 3, 22, 135, 1, 1, '2019-09-02 10:30:28', '2019-09-02 10:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `calories`
--

CREATE TABLE `calories` (
  `calorie_id` int(11) NOT NULL,
  `calorie_food_name` varchar(255) NOT NULL,
  `calorie_number` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calories`
--

INSERT INTO `calories` (`calorie_id`, `calorie_food_name`, `calorie_number`, `created_date`, `updated_date`) VALUES
(1, 'á€€á€¼á€€á€ºá€žá€¬á€¸á€’á€¶á€•á€±á€«á€€á€º (ááƒá€‡á€½á€”á€ºá€¸)', 708, '2019-08-25 22:07:54', '2019-08-25 22:07:54'),
(2, 'á€€á€¼á€€á€ºá€žá€¬á€¸â€Œá€á€±á€«á€€á€ºá€†á€½á€²á€€á€¼á€±á€¬á€º (áá„á€‡á€½á€”á€ºá€¸)', 594, '2019-08-25 22:14:23', '2019-08-25 22:14:23'),
(3, 'á€•á€²á€•á€¼á€¯á€á€ºá€‘á€™á€„á€ºá€¸á€†á€®á€†á€™á€ºá€¸ (á‰á€‡á€½á€”á€ºá€¸)', 435, '2019-08-25 22:14:54', '2019-08-25 22:14:54'),
(4, 'á€‘á€™á€„á€ºá€¸ á€•á€”á€ºá€¸á€€á€”á€ºá€œá€¯á€¶á€¸ (á†á€‡á€½á€”á€ºá€¸)', 186, '2019-08-25 22:15:26', '2019-08-25 22:15:26'),
(5, 'á€‘á€™á€„á€ºá€¸ á€•á€”á€ºá€¸á€€á€”á€ºá€•á€¼á€¬á€¸ (á‰á€‡á€½á€”á€ºá€¸)', 275, '2019-08-25 22:15:49', '2019-08-25 22:15:49'),
(6, 'á€‘á€™á€„á€ºá€¸â€Œá€•á€±á€«á€„á€ºá€¸ áá€•á€½á€² (áá‚á€‡á€½á€”á€ºá€¸)', 475, '2019-08-25 22:16:12', '2019-08-25 22:16:12'),
(7, 'á€•á€²á€•á€¼á€¯á€á€ºá€‘á€™á€„á€ºá€¸â€Œâ€Œá€€á€¼á€±á€¬á€º (á‰á€‡á€½á€”á€ºá€¸)', 426, '2019-08-25 22:17:06', '2019-08-25 22:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chid` int(11) NOT NULL,
  `fromid` int(11) NOT NULL,
  `toid` int(11) NOT NULL,
  `chats` text NOT NULL,
  `status` int(11) NOT NULL,
  `chat_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chid`, `fromid`, `toid`, `chats`, `status`, `chat_time`) VALUES
(1, 1, 5, 'hello', 1, '2019-09-28 14:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `current`
--

CREATE TABLE `current` (
  `current_id` int(11) NOT NULL,
  `current_name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `current`
--

INSERT INTO `current` (`current_id`, `current_name`, `created_date`, `updated_date`) VALUES
(1, '1 Month', '2019-08-10 17:06:54', '2019-08-10 17:06:54'),
(2, '3 Months', '2019-08-10 17:06:54', '2019-08-10 17:06:54'),
(3, '6 Months', '2019-08-10 17:07:29', '2019-08-10 17:07:29'),
(4, '1 Year', '2019-08-10 17:07:29', '2019-08-10 17:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `exer_id` int(11) NOT NULL,
  `exer_name` varchar(255) NOT NULL,
  `exer_category_id` int(11) NOT NULL,
  `exer_story` text NOT NULL,
  `exer_times` varchar(255) NOT NULL,
  `exer_img` varchar(255) NOT NULL,
  `exer_plan` int(11) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exercises_category`
--

CREATE TABLE `exercises_category` (
  `cat_id` int(11) NOT NULL,
  `exercises_name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exercises_category`
--

INSERT INTO `exercises_category` (`cat_id`, `exercises_name`, `created_date`, `modified_date`) VALUES
(1, 'All', '2019-08-10 17:25:59', '2019-08-10 17:25:59'),
(2, 'Day 1-Chest', '2019-08-10 17:25:59', '2019-08-10 17:25:59'),
(3, 'Day 2-Shoulder', '2019-08-10 17:26:26', '2019-08-10 17:26:26'),
(4, 'Day 3-Leg', '2019-08-10 17:26:26', '2019-08-10 17:26:26'),
(5, 'Day 4-Back', '2019-08-10 17:27:02', '2019-08-10 17:27:02'),
(6, 'Day 5-Arm', '2019-08-10 17:27:02', '2019-08-10 17:27:02'),
(7, 'Day 6-Abs', '2019-08-10 17:27:21', '2019-08-10 17:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE `expenditure` (
  `expend_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `trainer_email` varchar(255) NOT NULL,
  `trainer_expend` float NOT NULL,
  `expenditure_status` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`expend_id`, `trainer_id`, `trainer_email`, `trainer_expend`, `expenditure_status`, `created_date`, `updated_date`) VALUES
(1, 1, 'nawhtee@gmail.com', 600000, 0, '2019-09-02', '2019-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `favo_id` int(11) NOT NULL,
  `favoexer_id` int(11) NOT NULL,
  `favouser_id` int(11) NOT NULL,
  `action` varchar(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `member_email` varchar(255) NOT NULL,
  `income` float NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `book_id`, `member_email`, `income`, `created_date`, `updated_date`) VALUES
(1, 1, 'lawrence@gmail.com', 210000, '2019-08-10', '2019-08-10'),
(2, 10, 'atun@gmail.com', 35000, '2019-08-30', '2019-08-30'),
(3, 11, 'staystrong@gmail.com', 420000, '2019-09-02', '2019-09-02'),
(4, 12, 'mgmg@gmail.com', 120000, '2019-09-02', '2019-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `logid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `activity` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`logid`, `uid`, `activity`) VALUES
(1, 1, '2019-08-13 16:24:36'),
(2, 1, '0000-00-00 00:00:00'),
(3, 1, '0000-00-00 00:00:00'),
(4, 1, '0000-00-00 00:00:00'),
(5, 2, '0000-00-00 00:00:00'),
(6, 1, '0000-00-00 00:00:00'),
(7, 1, '0000-00-00 00:00:00'),
(8, 3, '0000-00-00 00:00:00'),
(9, 3, '0000-00-00 00:00:00'),
(10, 1, '0000-00-00 00:00:00'),
(11, 3, '0000-00-00 00:00:00'),
(12, 5, '0000-00-00 00:00:00'),
(13, 6, '0000-00-00 00:00:00'),
(14, 1, '0000-00-00 00:00:00'),
(15, 1, '0000-00-00 00:00:00'),
(16, 1, '2019-09-28 14:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `o_expend`
--

CREATE TABLE `o_expend` (
  `oexpend_id` int(11) NOT NULL,
  `oexpend_name` varchar(255) NOT NULL,
  `oexpend_price` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_price` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`plan_id`, `plan_name`, `plan_price`, `created_date`, `updated_date`) VALUES
(1, 'Regular (35000)', 35000, '2019-08-10 17:04:36', '2019-08-10 17:04:36'),
(2, 'Weight Gain (40000)', 40000, '2019-08-10 17:04:36', '2019-08-10 17:04:36'),
(3, 'Weight Loss (40000)', 40000, '2019-08-10 17:04:55', '2019-08-10 17:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `pos_id` int(11) NOT NULL,
  `pos_name` varchar(255) NOT NULL,
  `pos_price` float NOT NULL,
  `pos_category` int(11) NOT NULL,
  `pos_image` varchar(255) NOT NULL,
  `pos_quantity` int(11) NOT NULL,
  `pos_desc` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`pos_id`, `pos_name`, `pos_price`, `pos_category`, `pos_image`, `pos_quantity`, `pos_desc`, `created_date`, `updated_date`) VALUES
(1, 'Coconut Milk', 1500, 3, '5d52897699c94_Coconut-Milk.jpg', 20, 0, '2019-08-13 16:27:10', '2019-09-05 11:13:06'),
(2, 'Orange Juice', 2000, 3, '5d68d5ea77ba8_orange_juice.jpg', 20, 0, '2019-08-30 14:23:14', '2019-08-30 14:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `pos_category`
--

CREATE TABLE `pos_category` (
  `pos_cat_id` int(11) NOT NULL,
  `pos_cat_name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_category`
--

INSERT INTO `pos_category` (`pos_cat_id`, `pos_cat_name`, `created_date`, `updated_date`) VALUES
(1, 'All', '2019-08-10 17:22:53', '2019-08-10 17:22:53'),
(2, 'Medicines', '2019-08-10 17:22:53', '2019-08-10 17:22:53'),
(3, 'Drinks', '2019-08-13 16:26:47', '2019-08-13 16:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `pos_income`
--

CREATE TABLE `pos_income` (
  `posi_id` int(11) NOT NULL,
  `poss_id` int(11) NOT NULL,
  `poss_member_id` int(11) NOT NULL,
  `poss_user_id` int(11) NOT NULL,
  `poss_price` int(11) NOT NULL,
  `poss_quantity` int(11) NOT NULL,
  `poss_total` int(11) NOT NULL,
  `poss_status` int(11) NOT NULL,
  `pos_created_date` date NOT NULL,
  `pos_updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_income`
--

INSERT INTO `pos_income` (`posi_id`, `poss_id`, `poss_member_id`, `poss_user_id`, `poss_price`, `poss_quantity`, `poss_total`, `poss_status`, `pos_created_date`, `pos_updated_date`) VALUES
(1, 1, 1, 1, 1500, 5, 7500, 1, '2019-08-13', '2019-08-13'),
(4, 1, 10, 3, 1500, 2, 3000, 1, '2019-08-30', '2019-08-30'),
(6, 1, 10, 3, 1500, 2, 3000, 1, '2019-08-30', '2019-08-30'),
(7, 1, 1, 1, 1500, 11, 16500, 0, '2019-09-05', '2019-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating_number` float NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `user_id`, `rating_number`, `created_date`, `updated_date`) VALUES
(1, 3, 4, '2019-08-30', '2019-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trainer_name` varchar(255) NOT NULL,
  `trainer_email` varchar(255) NOT NULL,
  `trainer_photo` varchar(255) NOT NULL,
  `trainer_fees` float NOT NULL,
  `trainer_pass` varchar(255) NOT NULL,
  `tstart_date` date NOT NULL,
  `tend_date` date NOT NULL,
  `t_duration` int(11) NOT NULL,
  `trainer_exer_id` int(11) NOT NULL,
  `trainer_phone` varchar(255) NOT NULL,
  `trainer_address` text NOT NULL,
  `trainer_fb` varchar(255) NOT NULL,
  `trainer_gender` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_id`, `user_id`, `trainer_name`, `trainer_email`, `trainer_photo`, `trainer_fees`, `trainer_pass`, `tstart_date`, `tend_date`, `t_duration`, `trainer_exer_id`, `trainer_phone`, `trainer_address`, `trainer_fb`, `trainer_gender`, `created_date`, `modified_date`) VALUES
(1, 4, 'Naw Htee Moo', 'nawhtee@gmail.com', '5d6c8d954ef86_61-512.png', 100000, '5d41402abc4b2a76b9719d911017c592', '2019-10-01', '2020-04-01', 1, 1, '0992147893', 'Insein', 'Naw Htee', 2, '2019-09-02', '2019-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `t_current`
--

CREATE TABLE `t_current` (
  `t_id` int(11) NOT NULL,
  `tc_name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_current`
--

INSERT INTO `t_current` (`t_id`, `tc_name`, `created_date`, `updated_date`) VALUES
(1, '6 Months', '2019-08-10 17:23:45', '2019-08-10 17:23:45'),
(2, '1 Year', '2019-08-10 17:23:45', '2019-08-10 17:23:45'),
(3, '1 Year and 6 Months', '2019-08-10 17:24:18', '2019-08-10 17:24:18'),
(4, '2 Year', '2019-08-10 17:24:18', '2019-08-10 17:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `userphone` varchar(255) NOT NULL,
  `useraddress` text NOT NULL,
  `userfb` varchar(255) NOT NULL,
  `userstatus` tinyint(4) NOT NULL,
  `u_status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `useremail`, `userpass`, `user_img`, `userphone`, `useraddress`, `userfb`, `userstatus`, `u_status`, `created_date`, `updated_date`) VALUES
(1, 'Lawrence', 'lawrence@gmail.com', '5d41402abc4b2a76b9719d911017c592', '5d4e9b12ec3a4_obivan.png', '09972089188', 'North Dagon', 'Lawrence', 1, 1, '2019-08-10 16:53:14', '2019-08-10 16:53:14'),
(3, 'Tun Myint Aung', 'atun@gmail.com', '5d41402abc4b2a76b9719d911017c592', '5d68ccc2892fc_10_avatar-512.png', '09456789123', 'Mingalardon', 'Tun Myint Aung', 1, 1, '2019-08-30 13:44:10', '2019-08-30 13:44:10'),
(4, 'Naw Htee Moo', 'nawhtee@gmail.com', '5d41402abc4b2a76b9719d911017c592', '5d6c8d954ef86_61-512.png', '0992147893', 'Insein', 'Naw Htee', 2, 0, '2019-09-02 10:03:41', '2019-09-02 10:03:41'),
(5, 'Thuta Yar Moe', 'staystrong@gmail.com', '5d41402abc4b2a76b9719d911017c592', '5d6c92263eb98_vector-avatars-avatar-icon-5.png', '09972089188', 'north dagon', 'lawrence', 1, 1, '2019-09-02 10:23:10', '2019-09-02 10:23:10'),
(6, 'Law Law', 'mgmg@gmail.com', '5d41402abc4b2a76b9719d911017c592', '5d6c92f2c8493_3_avatar-512.png', '09972089188', 'north dagon', 'lawrence', 1, 1, '2019-09-02 10:26:34', '2019-09-02 10:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `yours`
--

CREATE TABLE `yours` (
  `your_id` int(11) NOT NULL,
  `your_userid` int(11) NOT NULL,
  `your_food_id` int(11) NOT NULL,
  `your_quantity` int(11) NOT NULL,
  `your_calorie` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_page`
--
ALTER TABLE `admin_page`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `calories`
--
ALTER TABLE `calories`
  ADD PRIMARY KEY (`calorie_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chid`);

--
-- Indexes for table `current`
--
ALTER TABLE `current`
  ADD PRIMARY KEY (`current_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`exer_id`);

--
-- Indexes for table `exercises_category`
--
ALTER TABLE `exercises_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`expend_id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`favo_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `o_expend`
--
ALTER TABLE `o_expend`
  ADD PRIMARY KEY (`oexpend_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `pos_category`
--
ALTER TABLE `pos_category`
  ADD PRIMARY KEY (`pos_cat_id`);

--
-- Indexes for table `pos_income`
--
ALTER TABLE `pos_income`
  ADD PRIMARY KEY (`posi_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `t_current`
--
ALTER TABLE `t_current`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `yours`
--
ALTER TABLE `yours`
  ADD PRIMARY KEY (`your_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_page`
--
ALTER TABLE `admin_page`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `calories`
--
ALTER TABLE `calories`
  MODIFY `calorie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `current`
--
ALTER TABLE `current`
  MODIFY `current_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `exer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exercises_category`
--
ALTER TABLE `exercises_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `expend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `favo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `o_expend`
--
ALTER TABLE `o_expend`
  MODIFY `oexpend_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pos_category`
--
ALTER TABLE `pos_category`
  MODIFY `pos_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pos_income`
--
ALTER TABLE `pos_income`
  MODIFY `posi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_current`
--
ALTER TABLE `t_current`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `yours`
--
ALTER TABLE `yours`
  MODIFY `your_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
