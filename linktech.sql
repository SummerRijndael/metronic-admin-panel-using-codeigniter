-- phpMyAdmin SQL Dump
-- version 4.5.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2016 at 08:35 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linktech`
--

-- --------------------------------------------------------

--
-- Table structure for table `article_has_attachments`
--

CREATE TABLE `article_has_attachments` (
  `id` bigint(20) NOT NULL,
  `article_id` bigint(20) DEFAULT '0',
  `filename` varchar(250) DEFAULT '0',
  `filetype` varchar(60) NOT NULL,
  `size` varchar(100) NOT NULL,
  `savename` varchar(250) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `core`
--

CREATE TABLE `core` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `domain` varchar(60) NOT NULL,
  `idle` int(11) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `small_logo` varchar(150) NOT NULL,
  `short_description` text NOT NULL,
  `full_description` varchar(10000) NOT NULL,
  `template` varchar(100) NOT NULL,
  `contact_person` varchar(150) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(60) NOT NULL,
  `maintenance` tinyint(1) NOT NULL,
  `email_protocol` varchar(30) NOT NULL,
  `email_host` varchar(30) NOT NULL,
  `email_username` varchar(30) NOT NULL,
  `email_password` varchar(30) NOT NULL,
  `email_port` varchar(30) NOT NULL,
  `email_crypto` varchar(30) NOT NULL,
  `mailbox_address` varchar(30) NOT NULL,
  `mailbox_host` varchar(30) NOT NULL,
  `mailbox_username` varchar(30) NOT NULL,
  `mailbox_password` varchar(30) NOT NULL,
  `mailbox_port` varchar(30) NOT NULL,
  `mailbox_box` varchar(30) NOT NULL,
  `mailbox_flags` varchar(30) NOT NULL,
  `mailbox_imap` tinyint(1) NOT NULL,
  `mailbox_ssl` tinyint(1) NOT NULL,
  `mailbox_search` varchar(30) NOT NULL,
  `pw_reset_mail_subject` varchar(150) NOT NULL,
  `pw_reset_link_mail_subject` varchar(150) NOT NULL,
  `credentials_mail_subject` varchar(150) NOT NULL,
  `language` varchar(100) NOT NULL,
  `template_front` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core`
--

INSERT INTO `core` (`id`, `company`, `email`, `domain`, `idle`, `logo`, `small_logo`, `short_description`, `full_description`, `template`, `contact_person`, `contact_number`, `address`, `city`, `maintenance`, `email_protocol`, `email_host`, `email_username`, `email_password`, `email_port`, `email_crypto`, `mailbox_address`, `mailbox_host`, `mailbox_username`, `mailbox_password`, `mailbox_port`, `mailbox_box`, `mailbox_flags`, `mailbox_imap`, `mailbox_ssl`, `mailbox_search`, `pw_reset_mail_subject`, `pw_reset_link_mail_subject`, `credentials_mail_subject`, `language`, `template_front`) VALUES
(1, 'Link Technologies PH', 'mail@mail.com', 'http://www.linktech.com', 600, 'logo.png', 'eecd4c387e251baa2cf3f5227dc70d09.png', '', '', 'blueline', 'Ryann Olaso', '09163273880', 'NCR', 'Caloocan', 0, 'smtp', 'smtp.gmail.com', 'mailer@mail.com', 'mailer@mail.com', '587', 'tls', 'mail@mailer.com', 'imap.gmail.com', 'mail@mailer.com', 'mail@mailer.com', '993', 'INBOX', '/novalidate-cert', 1, 1, 'UNSEEN', 'Password reset request', 'Password reset link', 'User credential request', 'English', 'matrix');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) NOT NULL,
  `name` varchar(250) DEFAULT '0',
  `has_child` tinyint(1) NOT NULL,
  `nav_child_id` varchar(4) NOT NULL,
  `link` varchar(250) DEFAULT '0',
  `type` varchar(250) DEFAULT '0',
  `icon` varchar(150) DEFAULT NULL,
  `sort` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `has_child`, `nav_child_id`, `link`, `type`, `icon`, `sort`) VALUES
(1, 'Messages', 0, '', 'messages', 'main', 'fa fa-envelope', 1),
(2, 'Settings', 1, '011', NULL, 'Main', 'fa fa-cog', 2),
(3, 'Dashboard', 0, '', 'dashboard', 'main', 'fa fa-dashboard', 0),
(4, 'Gallery', 0, '', 'gallery_maintenance', 'main', 'fa fa-photo', 3);

-- --------------------------------------------------------

--
-- Table structure for table `module_childs`
--

CREATE TABLE `module_childs` (
  `id` int(10) NOT NULL,
  `name` varchar(250) DEFAULT '0',
  `link` varchar(250) DEFAULT '0',
  `icon` varchar(60) NOT NULL,
  `parent_id` varchar(20) NOT NULL,
  `sort` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_childs`
--

INSERT INTO `module_childs` (`id`, `name`, `link`, `icon`, `parent_id`, `sort`) VALUES
(1, 'User accounts', 'accounts', 'fa fa-users', '011', 1),
(2, 'General settings', 'main_settings', 'fa fa-cog', '011', 0),
(3, 'POP / IMAP / SMTP', 'email_service', 'fa fa-envelope', '011', 3),
(4, 'File manager', 'file_manager', 'fa fa-file-archive-o', '011', 4);

-- --------------------------------------------------------

--
-- Table structure for table `outbox_messages`
--

CREATE TABLE `outbox_messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `view_id` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `sender` varchar(250) NOT NULL,
  `reply_to` varchar(150) NOT NULL,
  `cc` varchar(150) NOT NULL,
  `bcc` varchar(150) NOT NULL,
  `recipient` varchar(250) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `time` varchar(100) NOT NULL,
  `conversation` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `spam` tinyint(1) NOT NULL,
  `important` tinyint(1) NOT NULL,
  `attachment` varchar(255) DEFAULT '',
  `attachment_link` varchar(255) DEFAULT '',
  `receiver_delete` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pw_reset`
--

CREATE TABLE `pw_reset` (
  `id` int(10) NOT NULL,
  `email` varchar(250) DEFAULT '0',
  `timestamp` varchar(250) DEFAULT '0',
  `token` varchar(250) DEFAULT '0',
  `user` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sessions_db`
--

CREATE TABLE `sessions_db` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions_db`
--

INSERT INTO `sessions_db` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('ae4d0dec8f651d63e2a86c41dedfd83959449835', '::1', 1468330986, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436383332393839363b757365725f69647c693a313b),
('a5b8ef65cced623ab2a8c6f7425d14f347674dc3', '::1', 1468332320, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436383333313037333b757365725f69647c693a313b),
('c0ebbac64bfaa9023cede65d4e9ea760026dd18f', '::1', 1468332421, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436383333323432313b);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `view_id` varchar(150) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `firstname` varchar(120) DEFAULT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(120) DEFAULT NULL,
  `hashed_password` varchar(128) DEFAULT NULL,
  `about` varchar(250) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `address` varchar(60) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `interest` varchar(60) NOT NULL,
  `occupation` varchar(60) NOT NULL,
  `status` enum('active','inactive','deleted') DEFAULT 'active',
  `system_lock` tinyint(1) NOT NULL,
  `admin` enum('0','1') DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `userpic` varchar(250) DEFAULT 'no-pic.png',
  `title` varchar(150) NOT NULL,
  `access` varchar(150) NOT NULL DEFAULT '1,2',
  `access_child` varchar(100) NOT NULL,
  `last_active` varchar(50) DEFAULT NULL,
  `last_login` varchar(50) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `queue` bigint(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `view_id`, `username`, `firstname`, `middlename`, `lastname`, `hashed_password`, `about`, `email`, `address`, `mobile`, `interest`, `occupation`, `status`, `system_lock`, `admin`, `created`, `userpic`, `title`, `access`, `access_child`, `last_active`, `last_login`, `last_updated`, `queue`) VALUES
(1, '3993cf6ebb20c56d76b8210c2f782e40e36b8735', 'summer', 'Ryann', 'Garcia', 'Olaso', '2f91f70d978d120354d10a2a9a3d855798d675e1b9da68e24091e642d1c9fe08bcc3033c2facd2732b3fc06d6bc942053f9cd287646bf22c02975e485bcb7d7c', '', 'yanr_laso@yahoo.com', '', '09163273880', 'Girls', 'Web Developer', 'active', 0, '1', '2016-04-27 08:10:47', '0c7606242ff9e21a5d1c7b89f497341b.jpg', 'Web Master', '3,1,2,4', '2,1,3,4', '0', '1468329895', '2016-07-06 04:42:28', 0),
(2, '84a336870784ee8e894e3d81722d9a3741483c7c', 'test.test', 'dummy', '', 'dummy', 'b50372c65d6c55a73ced971124f47cc1e512d72eba63f14d2f4d4947c7f50d67e18386fe788e0dece009f360f1d300c4820013be019e13e539eb6d16645943f2', '', 'theresa.tano18@gmail.com', '', '', '', '', 'active', 0, '0', '2016-04-27 08:14:30', 'no-pic.png', 'web designer', '1,2', '', '0', '1461929488', '2016-04-27 08:14:30', 0),
(7, 'd483b5ab04cf4b95f8cb566c6dd6933b893d4e77', 'user.test', 'dummy 2', '', 'dummy 2', 'd9a0f1439bc560f72f037e35ae840439d942d4774d9e17d345fa6582b78ddb3a440faba8a541bf4b1cd5cd946ed5f0840fd3a1d5156d9a0e9f44640fa14beae0', '', 'asdsd@asdasd.co', '', '', '', '', 'deleted', 0, '0', '2016-04-28 12:13:51', 'no-pic.png', 'asdasdsd', '1,2', '', NULL, NULL, '2016-04-28 12:13:51', 0),
(8, '39283b605eefda1ef2e06e1910f4abed6ee7ea0e', 'abascsa', 'sdasd', 'adasd', 'asdasd', '3e4213fe7562a9dd28301f0dc1b6337573d31475b7a20fc2ff84a8a73db6db3d7201a0195ad5549ebefbf72b7d2b40e00aaaa2d96095557906d48a065902c037', '', 'mail@mail.com', '', '', '', '', 'inactive', 0, '0', '2016-04-29 11:36:05', 'no-pic.png', '23fasasf', '1', '', NULL, NULL, '2016-04-29 11:36:05', 0),
(9, '2d1cc9c200a9e41376add548a578f5e66095cebe', 'sample.sample', 'Ryann Mc\'niel S', 'Asdojaos Jop \'aosdjasjd', 'Oasjdajsodjaop As', '609fc955957b4d4b7459c423c56af3e277f4faab4a4f32572b86e24b7ff392c0542dd910b726265e9236c6668901da69749920bdd88d29a5a4f3fc8480b62352', '', 'mail@mail.com', '', '', '', '', 'active', 0, '0', '2016-04-29 14:25:23', 'no-pic.png', 'Sample Title', '1,2', '', NULL, NULL, '2016-05-25 19:41:11', 0),
(10, '521e882ff2851198d65b90429b6ae4b4ad5b7d56', 'ple.ple', 'Ioahwe Oi Isdj', 'Oihsdas Ihoidh S', 'Dhoi Ohsd Oaishd S', '7834055aa34a9ab5156662d1581669d5bde00f81eaf8451dffbf870844fd33b2c2786fd5cb1edc88c7d5526154fd5ac81b74d120796d4769417d82d6402ef7dc', '', 'mailer@mail.com', '', '', '', '', 'deleted', 0, '0', '2016-04-29 14:27:57', 'no-pic.png', 'Titles', '1,2', '', NULL, NULL, '2016-06-02 13:47:24', 0),
(11, 'ab111d6a03d0f5b1c986d366db2900e69906556e', 'dasdas', 'Sdasdasd', 'Asdasdasd', 'Asafs', '372eeacaa2edfe18852907335d9f0e7ee0f7def18860c89e724ff08642255fca83c046617953479db8699accc0c5aa3c98fe4e31172e66c2a4e23fc4a0325e62', '', 'mail@mail.com', '', '', '', '', 'deleted', 0, '0', '2016-04-29 15:30:47', 'no-pic.png', 'isaasdad', '1,2', '', NULL, NULL, '2016-04-29 15:30:47', 0),
(12, 'acb9e9fca0ef83b9b473b0a2c642695c855f3b77', 'spakol.com', 'Asdasda', 'Sdasdada', 'Sdasdasdasd', '079e478d960e2aa6bb6ebb0ac773c15637eb8d14e455ec7ec2b4d23cbe2ad4aa04e33370a326c939e4932eb998529eda74d8f6cc72a6d3a6ba5436bd8a256b65', '', 'maiasda@hoas.c', '', '', '', '', 'deleted', 0, '1', '2016-04-29 16:49:07', 'no-pic.png', 'Dummy Account', '3,1', '', NULL, NULL, '2016-06-21 06:38:25', 0),
(13, '303bf21a449d35bc5d5a4b6f9097f618058f6f8d', 'asdasdasda', 'Asdaasdfas', '', 'Asfasfasfasf', 'a2fc1ffd7a3f3a017f5818533fde2baf298c50000e8b30bf6bb8c05446dd0d0d56967555c2983537b640a6a96130d753a0e846c7eded773e79e14611475f2885', '', 'asuods@mail.com', '', '', '', '', 'deleted', 0, '1', '2016-05-25 07:57:31', 'no-pic.png', 'Sanoke', '3,1,2,4', '2,4', NULL, NULL, '2016-06-20 08:39:09', 0),
(14, 'b9e914ebfcef445b99b2b66132a0df55d86dd88e', 'theresa.tano', 'Ma. Theresa', 'Lerona', 'Tano', '8be029c463208f56ecc15f2f3cb4ecc48d9e20e0f8080ef6f8f1fbf51f042c5351d9850d76445bf04da31df9202da547cc0a5396c14956a1ae6b5e8f09bcd7e4', '', 'asda214asdasd@mail.com', '', '', '', '', 'active', 0, '0', '2016-05-25 07:58:01', '1d842d424e4268a1d52f7fb3994a361b.JPG', 'Designer', '3,1,2', '', '0', '1465525507', '2016-06-09 13:01:54', 0),
(15, 'efb1626216d628f7ea76be24985ce376424a47cd', 'sdasdasud', 'Dasdasdasd', 'Daasdas', 'Sddasdasdasd', 'dee1cc5b17a2494b3fea6e33ddfcbf7ba70ba9578d1fdc684f8169552d5b6285e8b974e12568a17d3115ad114d7a2e8c3a170740edf33687c4ea988702289a27', '', 'masd@mail.com', '', '', '', '', 'active', 0, '1', '2016-05-25 08:00:37', '0bb5fc2a2f5be21dc19f10b568914c0b.jpg', 'Pasdasdasd', '1,2', '', NULL, NULL, '2016-05-25 17:32:35', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article_has_attachments`
--
ALTER TABLE `article_has_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_childs`
--
ALTER TABLE `module_childs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outbox_messages`
--
ALTER TABLE `outbox_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pw_reset`
--
ALTER TABLE `pw_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions_db`
--
ALTER TABLE `sessions_db`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article_has_attachments`
--
ALTER TABLE `article_has_attachments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `core`
--
ALTER TABLE `core`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `module_childs`
--
ALTER TABLE `module_childs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `outbox_messages`
--
ALTER TABLE `outbox_messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pw_reset`
--
ALTER TABLE `pw_reset`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
