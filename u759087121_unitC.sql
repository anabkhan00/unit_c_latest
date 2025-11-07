-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2025 at 02:34 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u759087121_unitC`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE `calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `all_day` tinyint(1) NOT NULL DEFAULT 0,
  `event_start_time` time DEFAULT NULL,
  `event_end_time` time DEFAULT NULL,
  `event_location` varchar(255) DEFAULT NULL,
  `event_description` text DEFAULT NULL,
  `event_shared` varchar(255) DEFAULT NULL,
  `reminder_value` int(11) DEFAULT NULL,
  `reminder_unit` enum('minutes','hours','days','weeks') DEFAULT NULL,
  `recurrence_mode` enum('never','on','after') NOT NULL DEFAULT 'never',
  `recurrence_end_date` date DEFAULT NULL,
  `recurrence_count` int(11) DEFAULT NULL,
  `recurrence_type` enum('daily','weekly','monthly','yearly') DEFAULT NULL,
  `recurrence_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `send_notification` tinyint(1) NOT NULL DEFAULT 0,
  `notification_type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calendars`
--

INSERT INTO `calendars` (`id`, `event_title`, `event_date`, `all_day`, `event_start_time`, `event_end_time`, `event_location`, `event_description`, `event_shared`, `reminder_value`, `reminder_unit`, `recurrence_mode`, `recurrence_end_date`, `recurrence_count`, `recurrence_type`, `recurrence_days`, `send_notification`, `notification_type`, `created_at`, `updated_at`) VALUES
(3, 'Business Event', '2025-02-19', 1, NULL, NULL, '123', 'desci', 'Public', 30, NULL, 'on', '2025-02-21', 1, 'daily', NULL, 0, '[\"system\", \"email\"]', NULL, NULL),
(4, 'Business Event', '2025-02-20', 1, NULL, NULL, '123', 'desci', 'Public', 30, NULL, 'on', '2025-02-21', 1, 'daily', NULL, 0, '[\"system\", \"email\"]', NULL, NULL),
(5, 'Business Event', '2025-02-21', 1, NULL, NULL, '123', 'desci', 'Public', 30, NULL, 'on', '2025-02-21', 1, 'daily', NULL, 0, '[\"system\", \"email\"]', NULL, NULL),
(6, 'new event', '2025-02-27', 1, NULL, NULL, 'test', 'new', 'Public', 0, NULL, 'never', NULL, 1, 'daily', NULL, 0, '[\"system\", \"email\"]', '2025-02-19 08:07:15', '2025-02-19 08:07:15'),
(7, 'today event', '2025-02-24', 0, '13:00:00', '14:50:00', 'Lahore, iqbal park, Pakistan', 'This is the meeting regarding to Business.', 'Public', 10, NULL, 'on', '2025-02-25', 1, 'daily', NULL, 0, '[\"system\", \"email\"]', '2025-02-20 00:38:20', '2025-02-20 00:38:20'),
(8, 'today event', '2025-02-25', 0, '13:00:00', '14:50:00', 'Lahore, iqbal park, Pakistan', 'This is the meeting regarding to Business.', 'Public', 10, NULL, 'on', '2025-02-25', 1, 'daily', NULL, 0, '[\"system\", \"email\"]', NULL, NULL),
(9, 'today event', '2025-02-24', 0, '13:00:00', '14:50:00', 'Lahore, iqbal park, Pakistan', 'This is the meeting regarding to Business.', 'Public', 10, NULL, 'on', '2025-02-25', 1, 'daily', NULL, 0, '[\"system\", \"email\"]', '2025-02-20 00:38:22', '2025-02-20 00:38:22'),
(10, 'today event', '2025-02-25', 0, '13:00:00', '14:50:00', 'Lahore, iqbal park, Pakistan', 'This is the meeting regarding to Business.', 'Public', 10, NULL, 'on', '2025-02-25', 1, 'daily', NULL, 0, '[\"system\", \"email\"]', NULL, NULL),
(11, 'marriage ceremony', '2025-03-12', 0, '03:01:00', '04:02:00', '123', 'This is the meeting regarding to Business.', 'Public', 10, NULL, 'never', NULL, 1, 'daily', NULL, 0, '[\"system\"]', '2025-03-11 01:47:30', '2025-03-11 01:47:30'),
(12, 'Qui nulla aut obcaec', '2025-03-13', 1, NULL, NULL, 'Eveniet ea consequa', 'Quae suscipit commod', 'Public', 0, NULL, 'never', NULL, 1, 'daily', NULL, 0, '[\"system\", \"email\"]', '2025-03-11 01:52:02', '2025-03-11 01:52:02'),
(13, 'Wedding', '2025-04-12', 0, '19:00:00', '21:00:00', NULL, NULL, 'When Shared', 0, NULL, 'never', NULL, 1, 'daily', NULL, 0, '[\"system\"]', '2025-03-13 02:56:58', '2025-03-13 02:56:58'),
(14, 'Farooq bhai ka dera', '2025-06-20', 0, '12:00:00', '01:00:00', 'Dera Farooq BHAI', 'Deray par hazri', 'Public', 0, NULL, 'never', NULL, 1, 'daily', NULL, 0, '[\"system\"]', '2025-06-19 18:34:48', '2025-06-19 18:34:48'),
(15, 'AI Weekly Meeting', '2025-07-12', 0, '00:00:00', '00:00:00', 'London', 'AI Weekly Meeting', 'Public', 0, NULL, 'never', NULL, 1, 'daily', NULL, 0, '[\"system\"]', '2025-07-13 13:44:52', '2025-07-13 13:44:52'),
(16, 'test', '2025-10-24', 1, NULL, NULL, 'lahore', 'dfdfdfdfd', 'Public', 0, NULL, 'never', NULL, 1, 'daily', NULL, 0, '[\"system\"]', '2025-10-23 18:44:05', '2025-10-23 18:44:05'),
(17, 'refdsfsdf', '2025-10-30', 0, '00:00:00', '00:00:00', 'dsfsd', 'dfsdf', 'Public', 0, NULL, 'never', NULL, 1, 'daily', NULL, 0, '[\"system\"]', '2025-10-30 12:24:38', '2025-10-30 12:24:38'),
(18, 'test 6', '2025-11-06', 1, NULL, NULL, 'lahore', 'eerere', 'Public', 0, NULL, 'after', NULL, 6, 'daily', NULL, 0, '[\"system\",\"email\"]', '2025-11-06 10:13:49', '2025-11-06 10:13:49'),
(19, 'test 6', '2025-11-07', 1, NULL, NULL, 'lahore', 'eerere', 'Public', 0, NULL, 'after', NULL, 6, 'daily', NULL, 0, '[\"system\",\"email\"]', NULL, NULL),
(20, 'test 6', '2025-11-08', 1, NULL, NULL, 'lahore', 'eerere', 'Public', 0, NULL, 'after', NULL, 6, 'daily', NULL, 0, '[\"system\",\"email\"]', NULL, NULL),
(21, 'test 6', '2025-11-09', 1, NULL, NULL, 'lahore', 'eerere', 'Public', 0, NULL, 'after', NULL, 6, 'daily', NULL, 0, '[\"system\",\"email\"]', NULL, NULL),
(22, 'test 6', '2025-11-10', 1, NULL, NULL, 'lahore', 'eerere', 'Public', 0, NULL, 'after', NULL, 6, 'daily', NULL, 0, '[\"system\",\"email\"]', NULL, NULL),
(23, 'test 6', '2025-11-11', 1, NULL, NULL, 'lahore', 'eerere', 'Public', 0, NULL, 'after', NULL, 6, 'daily', NULL, 0, '[\"system\",\"email\"]', NULL, NULL),
(24, 'test 6', '2025-11-12', 1, NULL, NULL, 'lahore', 'eerere', 'Public', 0, NULL, 'after', NULL, 6, 'daily', NULL, 0, '[\"system\",\"email\"]', NULL, NULL),
(25, 'test 6 1', '2025-11-06', 0, '04:00:00', '03:00:00', 'lahore', NULL, 'When Shared', 0, NULL, 'after', NULL, 2, 'daily', NULL, 0, '[\"system\"]', '2025-11-06 10:15:05', '2025-11-06 10:15:05'),
(26, 'test 6 1', '2025-11-07', 0, '04:00:00', '03:00:00', 'lahore', NULL, 'When Shared', 0, NULL, 'after', NULL, 2, 'daily', NULL, 0, '[\"system\"]', NULL, NULL),
(27, 'test 6 1', '2025-11-08', 0, '04:00:00', '03:00:00', 'lahore', NULL, 'When Shared', 0, NULL, 'after', NULL, 2, 'daily', NULL, 0, '[\"system\"]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `task_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(16, 16, 1, 'sdfjhkhfdsadfg', '2025-10-22 08:23:05', '2025-10-22 08:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phonecode` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folder_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `is_starred` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_draft` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cc` text DEFAULT NULL,
  `bcc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `folder_id`, `sender_id`, `receiver_id`, `email`, `subject`, `description`, `is_read`, `is_starred`, `deleted_at`, `is_draft`, `created_at`, `updated_at`, `cc`, `bcc`) VALUES
(1, NULL, 1, 5, 'abidwork005@gmail.com', 'Hello ggggg', '<p>Hello Wggggggrrrr</p>', 1, 1, NULL, 0, '2025-03-13 02:51:34', '2025-07-07 07:14:22', 'hr@example.com, ceo@example.com', 'person1@example.com, person2@example.com'),
(2, NULL, 1, NULL, 'zaid1@gmail.com', '12343t', '<p>asdfasfdasf</p>', 0, 0, '2025-04-14 02:25:33', 1, '2025-04-14 01:38:22', '2025-04-14 02:25:33', NULL, NULL),
(10, NULL, 1, 1, 'azhar@gmail.com', 'abc123abc', '<p>abc123abc</p>', 0, 0, NULL, 1, '2025-04-14 02:06:02', '2025-04-14 02:07:24', NULL, NULL),
(13, NULL, 1, 2, 'azharmehmood74600@gmail.com', 'laravel', '<p>123</p>', 1, 0, NULL, 0, '2025-04-14 02:23:32', '2025-05-07 06:08:31', NULL, NULL),
(14, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, '2025-04-14 04:34:37', '2025-04-14 04:35:11', NULL, NULL),
(15, NULL, 1, 2, 'azharmehmood74600@gmail.com', 'new demo', '<p>this is new demo</p>', 1, 0, NULL, 0, '2025-04-14 04:36:34', '2025-07-10 07:03:08', NULL, NULL),
(16, NULL, 1, 3, 'stackbuffer2@gmail.com', 'Want Discussion on IT Startup', '<p>test</p>', 1, 0, NULL, 0, '2025-06-17 07:26:59', '2025-07-10 07:12:55', NULL, NULL),
(17, NULL, 4, 3, 'stackbuffer2@gmail.com', 'Want to change the nameserver of domain', '<p>Test</p>', 0, 0, NULL, 0, '2025-06-17 07:30:27', '2025-06-17 07:30:27', NULL, NULL),
(18, NULL, 1, NULL, 'qynig@mailinator.com', 'Error consequatur I', NULL, 0, 0, NULL, 1, '2025-06-27 02:22:00', '2025-06-27 02:22:00', NULL, NULL),
(19, NULL, 1, 4, 'mhrabid558@gmail.com', 'Hello', '<p>hello g kia hal hain</p>', 0, 0, NULL, 0, '2025-07-03 05:26:17', '2025-07-03 05:27:21', NULL, NULL),
(20, NULL, 1, 5, 'abidwork005@gmail.com', 'sdasd', '<p>asdasdasd</p>', 0, 0, NULL, 0, '2025-07-03 05:29:33', '2025-07-03 05:29:33', NULL, NULL),
(21, NULL, 1, 5, 'abidwork005@gmail.com', 'sdasd', '<p>asdasdasd</p>', 0, 0, NULL, 1, '2025-07-03 05:29:33', '2025-07-03 05:29:33', NULL, NULL),
(22, NULL, 1, 5, 'abidwork005@gmail.com', 'asdasd', '<p>asdsad</p>', 0, 0, NULL, 1, '2025-07-03 05:33:16', '2025-07-03 05:33:16', NULL, NULL),
(23, NULL, 1, 5, 'abidwork005@gmail.com', 'This is Subject', '<p>This is body message.</p>', 0, 0, NULL, 1, '2025-07-07 07:02:15', '2025-07-07 07:04:39', NULL, NULL),
(24, NULL, 1, 5, 'abidwork005@gmail.com', 'This is Subject', '<p>This is Body</p>', 0, 0, NULL, 0, '2025-07-07 07:06:32', '2025-07-07 07:11:04', 'hr@example.com, ceo@example.com', 'person1@example.com, person2@example.com'),
(25, NULL, 1, 5, 'abidwork005@gmail.com', 'Hello ggggg', '<p>Hello bodyyyyy</p>', 0, 0, NULL, 0, '2025-07-07 07:19:57', '2025-07-07 07:24:40', 'hr@example.com, ceo@example.com', 'person1@example.com, person2@example.com'),
(26, NULL, 1, 5, 'abidwork005@gmail.com', 'This is subject email', '<p>This is body email</p>', 0, 0, NULL, 0, '2025-07-07 07:27:42', '2025-07-07 07:29:36', 'joinabiddev@gmail.com, natti6780@gmail.com', 'abidmhr2045@gmail.com, natti6780@gmail.com'),
(27, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, '2025-07-08 06:04:57', '2025-07-08 06:04:57', NULL, NULL),
(28, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, '2025-07-08 06:10:48', '2025-07-08 06:10:48', NULL, NULL),
(29, NULL, 1, 1, 'azhar@gmail.com', 'mmmm', '<p>kk</p>', 0, 0, NULL, 1, '2025-11-03 10:34:25', '2025-11-03 10:34:31', NULL, NULL),
(30, NULL, 1, 6, 'anabkhanm@gmail.com', 'sadasdsa fsdgsdfs', '<p>sadasrssdgfd hfghgdfhf jghjgfdfv yhfgf</p>', 0, 0, NULL, 1, '2025-11-05 10:55:35', '2025-11-05 10:55:42', NULL, NULL),
(31, NULL, 1, 6, 'anabkhanm@gmail.com', 'cczxcz', '<p>adasd fadascascsa</p>', 0, 0, NULL, 1, '2025-11-05 11:06:47', '2025-11-05 11:06:47', NULL, NULL),
(32, NULL, 1, 6, 'anabkhanm@gmail.com', 'sadasdsa fsdgsdfs', '<p>asdasdasdas afdasfdsdfdsf fdsfsdfsdfsd</p>', 1, 0, NULL, 0, '2025-11-05 11:11:50', '2025-11-05 11:14:04', 'xzcxzc', 'xzczxc'),
(33, NULL, 1, 6, 'anabkhanm@gmail.com', NULL, NULL, 0, 0, NULL, 1, '2025-11-05 11:12:33', '2025-11-05 11:13:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_users`
--

CREATE TABLE `event_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `calendar_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_users`
--

INSERT INTO `event_users` (`id`, `calendar_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 6, 2, NULL, NULL),
(4, 7, 2, NULL, NULL),
(5, 9, 2, NULL, NULL),
(6, 11, 2, NULL, NULL),
(7, 12, 2, NULL, NULL),
(8, 18, 3, NULL, NULL),
(9, 18, 4, NULL, NULL),
(10, 18, 5, NULL, NULL),
(11, 25, 2, NULL, NULL),
(12, 25, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '33aefd31-0f60-439f-aa11-220bcf40e674', 'database', 'default', '{\"uuid\":\"33aefd31-0f60-439f-aa11-220bcf40e674\",\"displayName\":\"App\\\\Notifications\\\\EventNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":2:{s:8:\\\"\\u0000*\\u0000items\\\";a:1:{i:0;O:44:\\\"Illuminate\\\\Notifications\\\\AnonymousNotifiable\\\":1:{s:6:\\\"routes\\\";a:1:{s:4:\\\"mail\\\";s:27:\\\"azharmehmood74600@gmail.com\\\";}}}s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\EventNotification\\\":2:{s:8:\\\"\\u0000*\\u0000event\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Calendar\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"cd1c7f00-a88c-4a00-8e7d-f2bcd80be49d\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Failed to authenticate on SMTP server with username \"noreply@zeilconsultants.com\" using the following authenticators: \"LOGIN\", \"PLAIN\". Authenticator \"LOGIN\" returned \"Expected response code \"235\" but got code \"535\", with message \"535 5.7.8 Error: authentication failed: (reason unavailable)\".\". Authenticator \"PLAIN\" returned \"Expected response code \"235\" but got code \"535\", with message \"535 5.7.8 Error: authentication failed: (reason unavailable)\".\". in C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\mailer\\Transport\\Smtp\\EsmtpTransport.php:226\nStack trace:\n#0 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\mailer\\Transport\\Smtp\\EsmtpTransport.php(161): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->handleAuth(Array)\n#1 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\mailer\\Transport\\Smtp\\EsmtpTransport.php(118): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->doEhloCommand()\n#2 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(254): Symfony\\Component\\Mailer\\Transport\\Smtp\\EsmtpTransport->executeCommand(\'HELO [127.0.0.1...\', Array)\n#3 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(277): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doHeloCommand()\n#4 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(209): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#5 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\mailer\\Transport\\AbstractTransport.php(69): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#6 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\mailer\\Transport\\Smtp\\SmtpTransport.php(137): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#7 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(573): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#8 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(335): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#9 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\Channels\\MailChannel.php(69): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#10 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\NotificationSender.php(148): Illuminate\\Notifications\\Channels\\MailChannel->send(Object(Illuminate\\Notifications\\AnonymousNotifiable), Object(App\\Notifications\\EventNotification))\n#11 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\NotificationSender.php(106): Illuminate\\Notifications\\NotificationSender->sendToNotifiable(Object(Illuminate\\Notifications\\AnonymousNotifiable), \'bc7149aa-cd15-4...\', Object(App\\Notifications\\EventNotification), \'mail\')\n#12 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Notifications\\NotificationSender->Illuminate\\Notifications\\{closure}()\n#13 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\NotificationSender.php(109): Illuminate\\Notifications\\NotificationSender->withLocale(NULL, Object(Closure))\n#14 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\ChannelManager.php(54): Illuminate\\Notifications\\NotificationSender->sendNow(Object(Illuminate\\Support\\Collection), Object(App\\Notifications\\EventNotification), Array)\n#15 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Notifications\\SendQueuedNotifications.php(119): Illuminate\\Notifications\\ChannelManager->sendNow(Object(Illuminate\\Support\\Collection), Object(App\\Notifications\\EventNotification), Array)\n#16 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Notifications\\SendQueuedNotifications->handle(Object(Illuminate\\Notifications\\ChannelManager))\n#17 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#18 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#19 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#20 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#21 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#22 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#23 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#24 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#25 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(124): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Notifications\\SendQueuedNotifications), false)\n#26 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#27 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#28 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(126): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#29 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Notifications\\SendQueuedNotifications))\n#30 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#31 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#32 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#33 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(176): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#34 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(138): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#35 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(121): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#36 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#37 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#38 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#39 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#40 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#41 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#42 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#43 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(181): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#44 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\console\\Application.php(1096): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\console\\Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 C:\\Users\\user\\Desktop\\UnitC\\vendor\\symfony\\console\\Application.php(175): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 C:\\Users\\user\\Desktop\\UnitC\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 C:\\Users\\user\\Desktop\\UnitC\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 {main}', '2025-02-19 00:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `file_syncs`
--

CREATE TABLE `file_syncs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` enum('file','folder') NOT NULL,
  `size` bigint(20) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_syncs`
--

INSERT INTO `file_syncs` (`id`, `name`, `path`, `type`, `size`, `mime_type`, `user_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Screenshots', 'uploads/Screenshots', 'folder', NULL, NULL, 1, NULL, '2025-06-27 05:47:51', '2025-06-27 05:47:51'),
(2, 'Screenshot 2025-04-26 010159.png', 'uploads/Screenshots/Screenshot 2025-04-26 010159.png', 'file', 239039, 'image/png', 1, 1, '2025-06-27 05:47:51', '2025-06-27 05:47:51'),
(3, 'Screenshot 2025-05-20 163300.png', 'uploads/Screenshots/Screenshot 2025-05-20 163300.png', 'file', 66320, 'image/png', 1, 1, '2025-06-27 05:47:51', '2025-06-27 05:47:51'),
(4, 'Screenshot 2025-06-26 160514.png', 'uploads/Screenshots/Screenshot 2025-06-26 160514.png', 'file', 90453, 'image/png', 1, 1, '2025-06-27 05:47:51', '2025-06-27 05:47:51'),
(5, 'Screenshot 2025-06-27 150557.png', 'uploads/Screenshots/Screenshot 2025-06-27 150557.png', 'file', 265003, 'image/png', 1, 1, '2025-06-27 05:47:51', '2025-06-27 05:47:51'),
(6, 'Screenshot 2025-05-20 163300.png', 'uploads/Screenshot 2025-05-20 163300.png', 'file', 66320, 'image/png', 1, NULL, '2025-06-27 05:47:56', '2025-06-27 05:47:56'),
(7, '1.jpg', 'uploads/1.jpg', 'file', 1500848, 'image/jpeg', 1, NULL, '2025-08-21 07:47:31', '2025-08-21 07:47:31'),
(8, 'Screenshot 2025-04-26 010159.png', 'uploads/Screenshot 2025-04-26 010159.png', 'file', 239039, 'image/png', 1, NULL, '2025-08-21 11:56:41', '2025-08-21 11:56:41'),
(9, 'Screenshot 2025-05-20 163300.png', 'uploads/Screenshot 2025-05-20 163300.png', 'file', 66320, 'image/png', 1, NULL, '2025-08-21 13:52:49', '2025-08-21 13:52:49'),
(10, 'Screenshot 2025-04-26 010159.png', 'uploads/Screenshots/Screenshot 2025-04-26 010159.png', 'file', 239039, 'image/png', 1, 1, '2025-08-21 13:53:23', '2025-08-21 13:53:23'),
(11, 'Screenshot 2025-05-20 163300.png', 'uploads/Screenshots/Screenshot 2025-05-20 163300.png', 'file', 66320, 'image/png', 1, 1, '2025-08-21 13:53:23', '2025-08-21 13:53:23'),
(12, 'Screenshot 2025-06-26 160514.png', 'uploads/Screenshots/Screenshot 2025-06-26 160514.png', 'file', 90453, 'image/png', 1, 1, '2025-08-21 13:53:23', '2025-08-21 13:53:23'),
(13, 'Screenshot 2025-06-27 150557.png', 'uploads/Screenshots/Screenshot 2025-06-27 150557.png', 'file', 265003, 'image/png', 1, 1, '2025-08-21 13:53:23', '2025-08-21 13:53:23'),
(14, 'Screenshot 2025-07-08 004250.png', 'uploads/Screenshots/Screenshot 2025-07-08 004250.png', 'file', 138976, 'image/png', 1, 1, '2025-08-21 13:53:23', '2025-08-21 13:53:23'),
(15, 'Screenshot 2025-08-21 172709.png', 'uploads/Screenshots/Screenshot 2025-08-21 172709.png', 'file', 105677, 'image/png', 1, 1, '2025-08-21 13:53:23', '2025-08-21 13:53:23'),
(16, 'Screenshot 2025-08-21 184249.png', 'uploads/Screenshots/Screenshot 2025-08-21 184249.png', 'file', 100133, 'image/png', 1, 1, '2025-08-21 13:53:23', '2025-08-21 13:53:23'),
(17, 'screenshot.jpg', 'uploads/screenshot.jpg', 'file', 86888, 'image/jpeg', 1, NULL, '2025-10-23 18:42:34', '2025-10-23 18:42:34'),
(18, 'web (3).php', 'uploads/web (3).php', 'file', 71912, 'text/x-php', 1, NULL, '2025-11-04 13:23:30', '2025-11-04 13:23:30'),
(19, 'screenshot (1).jpg', 'uploads/screenshot (1).jpg', 'file', 123992, 'image/jpeg', 1, NULL, '2025-11-06 10:12:51', '2025-11-06 10:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `file_sync_shares`
--

CREATE TABLE `file_sync_shares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` bigint(20) UNSIGNED NOT NULL,
  `share_with_user_id` bigint(20) UNSIGNED NOT NULL,
  `share_by_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_sync_shares`
--

INSERT INTO `file_sync_shares` (`id`, `file_id`, `share_with_user_id`, `share_by_user_id`, `created_at`, `updated_at`) VALUES
(5, 152, 2, 1, '2025-06-23 06:23:38', '2025-06-23 06:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(3, 1, 'anab', '2025-06-16 11:05:39', '2025-06-16 11:05:39'),
(4, 1, 'sir', '2025-06-16 11:06:15', '2025-06-16 11:06:15'),
(5, 1, 'sir', '2025-06-16 11:06:15', '2025-06-16 11:06:15'),
(6, 1, 'jjj', '2025-06-27 01:49:16', '2025-06-27 01:49:16'),
(7, 1, 'jhjh', '2025-06-27 01:49:26', '2025-06-27 01:49:26'),
(8, 1, 'gbhjhj', '2025-06-27 01:50:22', '2025-06-27 01:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `type`, `filename`, `path`, `user_id`, `created_at`, `updated_at`) VALUES
(35, 'image', '1741851758_man-wearing-white-shirt-medium-shot.jpg', '/media/images/1741851758_man-wearing-white-shirt-medium-shot.jpg', 1, '2025-03-13 02:42:38', '2025-03-13 02:42:38'),
(36, 'image', '1755762789_1.jpg', '/media/images/1755762789_1.jpg', 1, '2025-08-21 07:53:09', '2025-08-21 07:53:09'),
(37, 'image', '1755862705_images.jpg', '/media/images/1755862705_images.jpg', 6, '2025-08-22 11:38:25', '2025-08-22 11:38:25'),
(38, 'image', '1761068488_Asaani Playstore Banner.jpg', '/media/images/1761068488_Asaani Playstore Banner.jpg', 1, '2025-10-21 17:41:28', '2025-10-21 17:41:28'),
(39, 'video', '1761068567_4114797-uhd_3840_2160_25fps.mp4', '/media/videos/1761068567_4114797-uhd_3840_2160_25fps.mp4', 1, '2025-10-21 17:42:47', '2025-10-21 17:42:47'),
(40, 'image', '1761829036_Screenshot 2025-10-25 131730.png', '/media/images/1761829036_Screenshot 2025-10-25 131730.png', 1, '2025-10-30 12:57:16', '2025-10-30 12:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `google_event_id` varchar(255) DEFAULT NULL,
  `topic` varchar(255) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `agenda` text DEFAULT NULL,
  `meeting_url` varchar(255) DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `user_id`, `google_event_id`, `topic`, `document`, `start_time`, `duration`, `agenda`, `meeting_url`, `cancelled_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'eirajr6h0fii8321aadi5604sg', 'asdasd', NULL, '2025-08-27 02:52:00', 23, 'asdasd', 'https://meet.google.com/efm-qyrk-ufm', NULL, '2025-08-27 08:52:02', '2025-08-27 08:52:02'),
(3, 1, '80jkdcfdofkqrl7h55s85amsks', 'testsfsdfsdfsdf', NULL, '2025-08-27 13:00:00', 60, 'test', 'https://meet.google.com/uii-jrog-xnj', NULL, '2025-08-27 09:03:22', '2025-08-27 09:03:22'),
(4, 1, '1ih75rmjois2rp2cc8sb0521gs', 'test topic', NULL, '2025-09-01 10:57:00', 23, '3eee test 3eee test 3eee test 3eee test 3eee test 3eee test 3eee test 3eee test 3eee test 3eee test 3eee test 3eee test 3eee test', 'https://meet.google.com/ujd-ohvd-syq', NULL, '2025-09-01 05:56:41', '2025-09-01 05:56:41'),
(5, 6, 'ljd9fukbc3h0l3kpp5nepojmvc', 'new test', NULL, '2025-09-11 17:03:00', 40, 'no', 'https://meet.google.com/hei-zxfy-xmd', NULL, '2025-09-01 12:01:41', '2025-09-01 12:01:41'),
(6, 1, 'm0621l8aj0g28qirr9g4bamnes', 'anab testing', NULL, '2025-09-10 15:25:00', 30, 'anab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testing', 'https://meet.google.com/ahh-ckft-fvn', NULL, '2025-09-23 10:24:15', '2025-09-23 10:24:15'),
(7, 1, 'gg6tjhchrorsvoqj0ic7i6qbro', 'anab testing', NULL, '2025-10-03 15:31:00', 25, 'anab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testinganab testing', 'https://meet.google.com/hfx-fsra-xxk', NULL, '2025-09-23 10:32:12', '2025-09-23 10:32:12'),
(8, 1, 'utge7tcqpr96mfe67qauingbk4', 'ddddd', NULL, '2025-10-23 15:20:00', 34, 'ddfdf', 'https://meet.google.com/zod-tnem-ubp', NULL, '2025-10-23 10:17:14', '2025-10-23 10:17:14'),
(10, 1, 'aq1qlvc4d0rlc6js28skti08b8', 'test topic', NULL, '2025-10-23 23:44:00', 12, 'wewew', 'https://meet.google.com/cwe-gqas-npn', NULL, '2025-10-23 18:44:46', '2025-10-23 18:44:46'),
(11, 1, '2l69m04ah6plcp4p44e0k7gdls', 'ewfsdfdsfvsdfsdfsdfdsfdsfds', NULL, '2025-10-08 15:57:00', 33, 'xzXZX', 'https://meet.google.com/kqe-edxz-wmb', NULL, '2025-10-30 07:58:13', '2025-10-30 07:58:13'),
(12, 1, 'uhap3kuitilquuftur1qdrobjk', 'ewfsdfdsfvsdfsdfsdfdsfdsfds', NULL, '2025-10-31 14:00:00', 34, 'dasdasdasd', 'https://meet.google.com/smc-qynk-uop', NULL, '2025-10-30 07:58:51', '2025-10-30 07:58:51'),
(13, 1, '4pa24qhgubf5b09asj7h6nql10', 'test topic', NULL, '2025-10-30 13:04:00', 12, 'tst ree rererke', 'https://meet.google.com/gqn-vuiw-tgs', NULL, '2025-10-30 08:04:25', '2025-10-30 08:04:25'),
(14, 1, 'rjaok3s6hlj65en8bna9ic65tk', 'anab testing', NULL, '2025-10-30 17:58:00', 30, 'Agenda', 'https://meet.google.com/pmt-qxek-gwt', NULL, '2025-10-30 09:59:11', '2025-10-30 09:59:11'),
(15, 1, 'j3ia3h3psbutck2uucdgm7p0lc', 'anab testing fdfsdfsd', NULL, '2025-10-30 18:01:00', 32, NULL, 'https://meet.google.com/edr-wmxo-egs', NULL, '2025-10-30 10:01:32', '2025-10-30 10:01:32'),
(16, 1, 'kcn8j2mjjebnbdimtinaljiod4', 'anab testingerfserfewrfwerf', NULL, '2025-10-30 19:10:00', 4, 'rewerw', 'https://meet.google.com/xkf-ydqm-mex', NULL, '2025-10-30 10:10:21', '2025-10-30 10:10:21'),
(17, 1, 'a8igeechtrvv2mmo22gs7hmk10', 'dsasadasdasdasd', NULL, '2025-10-30 20:18:00', 22, 'dcsdasdasd', 'https://meet.google.com/tbq-aurc-cen', NULL, '2025-10-30 10:18:27', '2025-10-30 10:18:27'),
(18, 1, 'vdabvhjtos8lgv5vjfrk0oh0j4', 'testing meeting online', NULL, '2025-10-30 20:44:00', 30, 'testing meeting online', 'https://meet.google.com/jbq-evzg-sgg', NULL, '2025-10-30 13:44:30', '2025-10-30 13:44:30'),
(19, 6, 'ibeks93ss52o9mu2vrs6tisst4', 'document', NULL, '2025-10-14 13:08:00', 33, 'SDSD', 'https://meet.google.com/crt-qmak-htc', NULL, '2025-10-31 08:08:42', '2025-10-31 08:08:42'),
(20, 1, NULL, 'anab testingrrrrrr', NULL, '2025-11-04 13:30:00', 33, 'erdfdsfdsf vsdvcxv', NULL, NULL, '2025-11-03 08:44:08', '2025-11-03 08:44:08'),
(21, 1, NULL, 'anab testing fdfsdfsd', NULL, '2025-11-20 13:44:00', 34, 'sdfdsfsdfdsfsdfds', NULL, NULL, '2025-11-03 08:45:04', '2025-11-03 08:45:04'),
(22, 1, 'dp5bkurfq88h8r64v1rqfq0tf4', 'qewewqe', NULL, '2025-11-13 13:49:00', 23, 'fsddf fsdfsdgxffs', 'https://meet.google.com/pbg-pynz-qtn', NULL, '2025-11-03 08:53:09', '2025-11-03 08:53:09'),
(23, 1, 'duh8t0racmg4tst0duj0iunf84', 'anab testing fdfsdfsd', NULL, '2025-11-20 13:57:00', 34, 'fdsdfdsf', 'https://meet.google.com/auc-dntz-cuc', NULL, '2025-11-03 08:57:31', '2025-11-03 08:57:31'),
(24, 1, 'lgt219hifk5qnj3eoeoqo2ouqg', 'anab testingsadsadcs dasd', NULL, '2025-11-23 14:02:00', 34, 'dsfsdfdsf', 'https://meet.google.com/hso-tmmj-roi', NULL, '2025-11-03 09:02:12', '2025-11-03 09:02:12'),
(25, 1, 'vg0mdp8jifg709v2tn95jmtrt4', 'anab testingadsdasd fsadfasdas', NULL, '2025-11-30 14:11:00', 33, 'dfdsf dfsdfsdfs', 'https://meet.google.com/esx-gosd-hex', NULL, '2025-11-03 09:11:29', '2025-11-03 09:11:29'),
(26, 1, '3367pkpjqkqfl9tk4sj5rateac', 'dfds', NULL, '2025-11-13 14:13:00', 34, 'dfsdfsdfsdf', 'https://meet.google.com/uhb-krca-ttw', NULL, '2025-11-03 09:13:43', '2025-11-03 09:13:43'),
(27, 1, 't5hng3cva38tuljhn761pipb7s', 'zxczcxzxc', NULL, '2025-11-20 14:19:00', 34, 'xzxvcvxcvx', 'https://meet.google.com/frp-njbd-bbu', NULL, '2025-11-03 09:19:46', '2025-11-03 09:19:46'),
(28, 1, 't8se7i43hdasncl813ef0bcj44', 'tt', NULL, '2025-11-03 14:21:00', 50, 'ggh', 'https://meet.google.com/bsj-wbdn-sev', NULL, '2025-11-03 09:21:56', '2025-11-03 09:21:56'),
(29, 1, 'ggtt669c78a6iev9trjgndmkds', 'tt 2', NULL, '2025-11-03 17:30:00', 30, 'dsd', 'https://meet.google.com/nff-zicm-sru', NULL, '2025-11-03 09:28:04', '2025-11-03 09:28:04'),
(30, 11, '02rs3urjchal6f4fuj064tknts', 'test topic fnf', NULL, '2025-11-03 14:35:00', 34, 'sdsd', 'https://meet.google.com/fdi-ufft-ybh', NULL, '2025-11-03 09:35:17', '2025-11-03 09:35:17'),
(31, 1, 'cr96tf87mu9553df2mc31hakeo', 'asdsad', NULL, '2025-11-15 15:41:00', 34, 'dsadasdasd', 'https://meet.google.com/jcd-crgc-azx', NULL, '2025-11-03 10:43:29', '2025-11-03 10:43:29'),
(32, 1, 'qqsce6foghlal2t25rr4dpll3g', 'fdsfasdfcd dasdcxz', NULL, '2025-11-05 15:44:00', 23, 'sdasdas', 'https://meet.google.com/apq-axmq-aur', NULL, '2025-11-03 10:44:37', '2025-11-03 10:44:37'),
(33, 1, 'dfsdfds', 'dfsdfds', 'meeting_docs/1762168046_Screenshot 2025-10-17 114713.png', '2025-11-03 17:56:00', 60, 'dfsdfds', 'dfsdfds', NULL, '2025-11-03 11:07:26', '2025-11-03 11:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_user`
--

CREATE TABLE `meeting_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_user`
--

INSERT INTO `meeting_user` (`id`, `meeting_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(5, 3, 1, NULL, NULL),
(6, 3, 2, NULL, NULL),
(7, 3, 5, NULL, NULL),
(8, 3, 6, NULL, NULL),
(9, 3, 7, NULL, NULL),
(10, 3, 8, NULL, NULL),
(11, 4, 8, NULL, NULL),
(12, 5, 3, NULL, NULL),
(13, 6, 3, NULL, NULL),
(14, 7, 1, NULL, NULL),
(15, 7, 2, NULL, NULL),
(16, 7, 3, NULL, NULL),
(17, 7, 4, NULL, NULL),
(18, 8, 10, NULL, NULL),
(20, 10, 10, NULL, NULL),
(21, 11, 1, NULL, NULL),
(22, 11, 2, NULL, NULL),
(23, 11, 3, NULL, NULL),
(24, 12, 2, NULL, NULL),
(25, 12, 3, NULL, NULL),
(26, 12, 4, NULL, NULL),
(27, 13, 2, NULL, NULL),
(28, 13, 3, NULL, NULL),
(29, 14, 2, NULL, NULL),
(30, 14, 3, NULL, NULL),
(31, 15, 2, NULL, NULL),
(32, 15, 3, NULL, NULL),
(33, 16, 3, NULL, NULL),
(34, 17, 5, NULL, NULL),
(35, 17, 6, NULL, NULL),
(36, 18, 3, NULL, NULL),
(37, 18, 7, NULL, NULL),
(38, 18, 8, NULL, NULL),
(39, 19, 3, NULL, NULL),
(40, 20, 2, NULL, NULL),
(41, 21, 1, NULL, NULL),
(42, 22, 1, NULL, NULL),
(43, 23, 2, NULL, NULL),
(44, 24, 2, NULL, NULL),
(45, 25, 3, NULL, NULL),
(46, 26, 2, NULL, NULL),
(47, 27, 3, NULL, NULL),
(48, 28, 8, NULL, NULL),
(49, 28, 10, NULL, NULL),
(50, 29, 1, NULL, NULL),
(51, 29, 2, NULL, NULL),
(52, 30, 1, NULL, NULL),
(53, 31, 3, NULL, NULL),
(54, 32, 3, NULL, NULL),
(55, 33, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(27, '2014_10_12_000000_create_users_table', 1),
(28, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(29, '2019_08_19_000000_create_failed_jobs_table', 1),
(30, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(31, '2024_12_16_065251_create_emails_table', 1),
(32, '2024_12_17_051109_add_soft_deletes_to_emails_table', 1),
(34, '2024_12_19_101019_create_notes_table', 1),
(35, '2024_12_23_080531_create_teams_table', 1),
(36, '2024_12_23_092258_create_team_user_table', 1),
(37, '2024_12_24_094324_create_news_feeds_table', 1),
(38, '2024_12_24_102418_create_countries_table', 1),
(39, '2024_12_24_103003_add_foreign_key_to_users_table', 1),
(40, '2024_12_27_111219_create_file_syncs_table', 1),
(41, '2024_12_31_113115_create_media_table', 1),
(42, '2025_01_01_081038_add_column_to_teams_table', 1),
(43, '2025_01_22_054325_add_column_to_users_table', 1),
(44, '2025_01_22_064002_change_type_in_users_table', 1),
(45, '2025_01_23_064415_create_file_sync_shares_table', 1),
(46, '2025_01_24_100135_create_folders_table', 1),
(47, '2025_01_24_100232_add_column_to_emails_table', 1),
(48, '2025_01_29_100958_add_columns_to_projects_table', 1),
(50, '2025_01_30_071613_update_status_enum_in_projects_table', 1),
(51, '2025_02_13_071435_create_calendars_table', 1),
(52, '2025_02_14_112535_create_jobs_table', 1),
(53, '2025_02_25_051617_create_minisites_table', 2),
(54, '2025_05_08_053808_create_meetings_table', 3),
(55, '2025_05_08_092950_create_zoom_meeting_users_table', 3),
(56, '2025_07_07_120946_add_cc_bcc_to_emails_table', 4),
(58, '2025_01_30_061826_create_project_statuses_table', 5),
(60, '2024_12_18_050616_create_projects_table', 6),
(61, '2025_07_08_072057_create_task_statuses_table', 7),
(62, '2025_07_08_072141_create_comments_table', 7),
(63, '2025_07_08_064122_create_tasks_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `minisites`
--

CREATE TABLE `minisites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_logo` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_description` text DEFAULT NULL,
  `page_added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `document_title` varchar(255) DEFAULT NULL,
  `document_added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `document_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `minisites`
--

INSERT INTO `minisites` (`id`, `page_logo`, `page_title`, `page_description`, `page_added_by`, `team_id`, `document`, `document_title`, `document_added_by`, `document_team_id`, `created_at`, `updated_at`) VALUES
(1, 'minisite/1740720107_exe.jpg', 'test', 'asdfasf', 1, 1, NULL, NULL, NULL, NULL, '2025-02-25 02:27:28', '2025-02-28 00:21:47'),
(3, 'pages/qdWDUveEcDbnrzsihOS0lrnyOPgB91MRdPLWoEMl.png', 'resource', 'this is resource related', 1, 2, NULL, NULL, NULL, NULL, '2025-02-26 00:06:13', '2025-02-26 00:06:13'),
(4, 'minisite/1740562226_pdf.jpg', 'now', 'This is the first', 1, 1, NULL, NULL, NULL, NULL, '2025-02-26 02:15:30', '2025-02-26 04:30:26'),
(6, 'minisite/1755762643_1.jpg', 'test', 'test description', 1, 1, NULL, NULL, NULL, NULL, '2025-08-21 07:50:43', '2025-08-21 07:50:43'),
(7, 'minisite/1762424679_screenshot (1).jpg', 'zxzx', 'zxzxz', 1, 10, NULL, NULL, NULL, NULL, '2025-11-06 10:24:39', '2025-11-06 10:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `minisite_documents`
--

CREATE TABLE `minisite_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `document_title` varchar(255) DEFAULT NULL,
  `document_added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `minisite_documents`
--

INSERT INTO `minisite_documents` (`id`, `document`, `document_title`, `document_added_by`, `team_id`, `created_at`, `updated_at`) VALUES
(1, 'minisite/1761651522_6900ab4294a01.png', 'document', 3, 12, '2025-10-28 06:38:42', '2025-10-28 06:38:42'),
(2, 'minisite/1761658195_6900c5535a305.png', 'documentwerwe', 3, 12, '2025-10-28 08:29:55', '2025-10-28 08:29:55'),
(3, 'minisite/1761659125_6900c8f5d127f.png', 'asdasdasdasd', 3, 2, '2025-10-28 08:45:25', '2025-10-28 08:45:25'),
(4, 'minisite/1761659225_6900c95920752.png', 'sdsadad', 3, 2, '2025-10-28 08:47:05', '2025-10-28 08:47:05'),
(5, 'minisite/1761719610_6901b53aa7f59.png', 'document', 3, 12, '2025-10-29 01:33:30', '2025-10-29 01:33:30'),
(6, 'minisite/1761827290_690359da63cb6.json', 'document', 3, 12, '2025-10-30 07:28:10', '2025-10-30 07:28:10'),
(7, 'minisite/1761829169_69036131797ea.svg', 'fdsf', 3, 12, '2025-10-30 07:59:29', '2025-10-30 07:59:29'),
(8, 'minisite/1761831701_69036b154d648.php', 'php', 3, 12, '2025-10-30 08:41:41', '2025-10-30 08:41:41'),
(9, 'minisite/1761891014_690452c633bd0.mpp', 'documentwerwe mpp', 3, 12, '2025-10-31 01:10:14', '2025-10-31 01:10:14'),
(10, 'minisite/1761891063_690452f77e080.mpp', 'MPP', 3, 12, '2025-10-31 01:11:03', '2025-10-31 01:11:03'),
(11, 'minisite/1761892068_690456e490151.mpp', 'mpp test 2', 3, 12, '2025-10-31 01:27:48', '2025-10-31 01:27:48'),
(12, 'minisite/1761907022_6904914e9db7d.jpeg', 'document', 3, 12, '2025-10-31 05:37:02', '2025-10-31 05:37:02'),
(13, 'minisite/1761907576_690493780d7ed.php', 'fg', 3, 12, '2025-10-31 05:46:16', '2025-10-31 05:46:16'),
(14, 'minisite/1761909237_690499f53a17a.mpp', 'documentfdsfsdfs', 3, 12, '2025-10-31 06:13:57', '2025-10-31 06:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `news_feeds`
--

CREATE TABLE `news_feeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `urlToImage` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publishedAt` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_feeds`
--

INSERT INTO `news_feeds` (`id`, `title`, `source`, `content`, `description`, `urlToImage`, `url`, `user_id`, `publishedAt`, `created_at`, `updated_at`) VALUES
(1, 'Deserunt test', 'Voluptatem dolore qu', 'Deserunt quisquam fu', 'Aspernatur voluptate', NULL, 'https://www.besybolizybuv.me.uk', 1, '2025-03-04 00:51:02', '2025-03-04 00:51:02', '2025-03-07 00:31:07'),
(3, 'Dolore dolorem sed c', 'Obcaecati est dolore', 'Ut eveniet consequa', 'Dicta voluptatem Di', NULL, 'https://www.soxa.cm', 1, '2025-04-14 04:21:44', '2025-04-14 04:21:44', '2025-04-14 04:21:44'),
(4, 'ss', 'sdsd', 'sdsds', 'sdsds', 'newsFeed/1762424240_screenshot (1).jpg', NULL, 1, '2025-11-06 10:17:20', '2025-11-06 10:17:20', '2025-11-06 10:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'HAZ', 'TEST', 'images/default-notes.png', '2025-06-16 12:23:08', '2025-06-16 12:23:08'),
(2, 1, 'test', 'Test Description', 'notes/1750146381_68511d4daa26c.png', '2025-06-17 07:46:21', '2025-06-17 07:46:21'),
(4, 1, 'test', 'test is this test is this test is this test is thistest is this test is this test is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is this', 'images/default-notes.png', '2025-06-18 06:57:25', '2025-06-18 06:57:25'),
(5, 1, 'test', 'test is this test is this test is this test is thistest is this test is this test is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is this', 'images/default-notes.png', '2025-06-18 06:57:27', '2025-06-18 06:57:27'),
(6, 1, 'test', 'test test', 'notes/1761067627_68f7c26b9e66b.jpg', '2025-10-21 17:27:07', '2025-10-21 17:27:07'),
(7, 12, 'test notes', 'dfdfdf', 'notes/1762428415_690c85ffa1cfe.jpg', '2025-11-06 11:26:55', '2025-11-06 11:26:55'),
(8, 12, 'sdsds', 'sdsds', 'notes/1762428489_690c864990d71.jpg', '2025-11-06 11:28:09', '2025-11-06 11:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('azhar@gmail.com', '$2y$12$UX9.Ne0BB2Zs7//FI9yGA.f3n7h2lb6dL.NLSuSmzLCLVixPTHske', '2025-10-21 12:21:48'),
('azhar1@gmail.com', '$2y$12$xw2AIHcYrQehKuR8Eglczu.PY32H3rnK3.jGPWHy8YQDZTswy7jY2', '2025-11-06 10:10:43'),
('azharmehmood74600@gmail.com', '$2y$12$aBMLRYSuAtf60OITrIEfNuhlzMuT6vpdAQTA2PLP/4hj3FzWDSHr.', '2025-03-20 01:53:53'),
('stackbuffersislamabad@gmail.com', '$2y$12$DnCuRC/StTNLlYFCux5MXOeU/zS5gs3LedmDkQXbBDbbgdpH1J6xi', '2025-11-06 10:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 6, 'erwerewr', '<p>dsfsdfds fgdfggdfgdf</p>', 'posts/dfGWGrU5W8I4dkPxdwI08EZcrXaevhDjczAzFMuf.png', '2025-11-04 04:35:27', '2025-11-04 04:35:27'),
(2, 6, 'dsZx', '<p>ZXXCC</p>', 'posts/pTChYSRb5sbO4pArCfJT6klCBVsTE3MFoqQwEsrO.png', '2025-11-04 05:37:52', '2025-11-04 05:37:52'),
(3, 1, 'ssss', '<p>ssasasasas<strong>asasasasass<em>asasa</em></strong></p>', 'posts/0nYLyzrNSf9QFhoGzRHWdfowmiW7DLJI2gBKgwXy.jpg', '2025-11-06 10:21:33', '2025-11-06 10:21:33'),
(4, 12, 'r', '<p>cvcvcv</p>', 'posts/Pau9SMZD9hL2FQWlqnbVCqGl6jbvbUfB2K7VOyDa.jpg', '2025-11-06 10:32:52', '2025-11-06 10:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('not_started','in_progress','completed') NOT NULL DEFAULT 'not_started',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Hop Emerson', 'Reprehenderit enim q', '2017-11-09', '2024-03-13', 'completed', 3, '2025-07-08 01:57:12', '2025-07-08 01:57:12'),
(2, 'Ian Sharp', 'Voluptatem omnis fac', '1972-12-03', '2004-05-02', 'completed', 5, '2025-07-09 05:38:22', '2025-07-09 05:38:22'),
(3, 'Mia Morris', 'Magni in pariatur N', '1978-11-10', '1981-06-16', 'not_started', 2, '2025-07-10 08:08:48', '2025-07-10 08:08:48'),
(4, 'Jin Dennis', 'Ad ea delectus aut', '1972-02-15', '2012-11-24', 'not_started', 2, '2025-07-10 08:10:12', '2025-07-10 08:10:12'),
(5, 'Igor Simmons', 'Voluptatibus reicien', '2012-01-28', '2016-06-19', 'completed', 3, '2025-07-10 08:12:39', '2025-07-10 08:12:39'),
(6, 'Garrison Warren', 'Laborum Ullamco sed', '1986-01-23', '2005-01-17', 'not_started', 4, '2025-07-10 08:14:04', '2025-07-10 08:14:04'),
(7, 'Joelle Johnston', 'Excepturi et atque u', '2023-07-13', '2024-10-22', 'in_progress', 2, '2025-07-10 08:16:12', '2025-07-10 08:16:12'),
(8, 'Urielle Bass', 'Dolore occaecat repr', '2002-04-25', '2024-04-09', 'in_progress', 5, '2025-07-10 08:20:32', '2025-07-10 08:20:32'),
(9, 'asdf', 'asdasd', '2025-07-16', '2025-07-30', 'in_progress', 3, '2025-07-10 10:22:19', '2025-07-10 10:22:19'),
(10, 'asddfg', 'sdsadsdf', '2025-07-17', '2025-07-31', 'in_progress', 2, '2025-07-10 10:26:07', '2025-07-10 10:26:07'),
(11, 'usman test', 'test project', '2025-10-22', '2025-10-31', 'not_started', 3, '2025-10-22 08:05:30', '2025-10-22 08:05:30'),
(12, 'dealer ka user one', NULL, '2025-10-22', '2025-10-31', 'in_progress', 2, '2025-10-22 08:11:59', '2025-10-22 08:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `project_statuses`
--

CREATE TABLE `project_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_statuses`
--

INSERT INTO `project_statuses` (`id`, `project_id`, `updated_by`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'todo', '2025-07-08 01:57:12', '2025-07-08 01:57:12'),
(2, 2, 1, NULL, 'todo', '2025-07-09 05:38:22', '2025-07-09 05:38:22'),
(3, 3, 1, NULL, 'todo', '2025-07-10 08:08:48', '2025-07-10 08:08:48'),
(4, 4, 1, NULL, 'todo', '2025-07-10 08:10:12', '2025-07-10 08:10:12'),
(5, 5, 1, NULL, 'todo', '2025-07-10 08:12:39', '2025-07-10 08:12:39'),
(6, 6, 1, NULL, 'todo', '2025-07-10 08:14:04', '2025-07-10 08:14:04'),
(7, 7, 1, NULL, 'todo', '2025-07-10 08:16:12', '2025-07-10 08:16:12'),
(8, 8, 1, NULL, 'todo', '2025-07-10 08:20:32', '2025-07-10 08:20:32'),
(9, 9, 1, NULL, 'todo', '2025-07-10 10:22:19', '2025-07-10 10:22:19'),
(10, 10, 1, NULL, 'todo', '2025-07-10 10:26:07', '2025-07-10 10:26:07'),
(11, 11, 1, NULL, 'todo', '2025-10-22 08:05:30', '2025-10-22 08:05:30'),
(12, 12, 1, NULL, 'todo', '2025-10-22 08:11:59', '2025-10-22 08:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('todo','in_progress','onhold','done') NOT NULL DEFAULT 'todo',
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `due_date` date DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `title`, `description`, `assigned_to`, `status`, `priority`, `due_date`, `completed_at`, `created_at`, `updated_at`) VALUES
(16, 10, 'sdfsf', 'sdfsdf', 4, 'todo', 'low', '2025-07-31', NULL, '2025-07-10 10:26:07', '2025-07-10 10:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `task_statuses`
--

CREATE TABLE `task_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_statuses`
--

INSERT INTO `task_statuses` (`id`, `task_id`, `status`, `priority`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'asdasd', 'asdasd', 1, '2025-07-08 12:13:05', '2025-07-08 12:13:06'),
(2, 1, 'done', 'medium', 1, '2025-07-09 05:04:14', '2025-07-09 05:04:14'),
(3, 1, 'in_progress', 'medium', 1, '2025-07-09 05:42:46', '2025-07-09 05:42:46'),
(4, 2, 'in_progress', 'low', 1, '2025-07-10 06:55:54', '2025-07-10 06:55:54'),
(5, 4, 'in_progress', 'medium', 1, '2025-07-10 06:55:56', '2025-07-10 06:55:56'),
(6, 3, 'in_progress', 'high', 1, '2025-07-10 06:57:04', '2025-07-10 06:57:04'),
(7, 2, 'todo', 'low', 1, '2025-07-10 06:57:05', '2025-07-10 06:57:05'),
(8, 2, 'in_progress', 'low', 1, '2025-07-10 06:57:06', '2025-07-10 06:57:06'),
(9, 1, 'in_progress', 'medium', 1, '2025-07-10 06:58:11', '2025-07-10 06:58:11'),
(10, 3, 'in_progress', 'high', 1, '2025-07-10 06:58:13', '2025-07-10 06:58:13'),
(11, 4, 'done', 'medium', 1, '2025-07-10 07:01:13', '2025-07-10 07:01:13'),
(12, 5, 'in_progress', 'high', 1, '2025-09-08 10:45:47', '2025-09-08 10:45:47'),
(13, 6, 'in_progress', 'high', 1, '2025-09-08 10:45:48', '2025-09-08 10:45:48'),
(14, 1, 'in_progress', 'medium', 1, '2025-10-21 17:10:31', '2025-10-21 17:10:31'),
(15, 1, 'done', 'medium', 1, '2025-10-21 17:10:52', '2025-10-21 17:10:52'),
(16, 17, 'todo', 'high', 1, '2025-10-22 08:08:00', '2025-10-22 08:08:00'),
(17, 7, 'in_progress', 'high', 1, '2025-10-22 13:28:43', '2025-10-22 13:28:43'),
(18, 9, 'in_progress', 'medium', 1, '2025-10-22 13:28:57', '2025-10-22 13:28:57'),
(19, 10, 'in_progress', 'medium', 1, '2025-10-22 13:29:17', '2025-10-22 13:29:17'),
(20, 8, 'done', 'high', 1, '2025-10-22 13:29:31', '2025-10-22 13:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_description` longtext DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `team_description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Risk Management', 'Lorem ipsm', 2, NULL, NULL),
(2, 'Human Resource', 'This is test Description', 1, NULL, '2025-06-17 06:32:41'),
(3, 'hello', 'noo desc', 1, '2025-06-17 05:04:03', '2025-06-17 05:04:03'),
(4, 'Test team', 'Discussions', 3, '2025-06-17 07:32:26', '2025-06-17 07:32:26'),
(5, 'Test team 2', 'Test', 4, '2025-06-17 07:33:20', '2025-06-17 07:33:20'),
(6, 'hello', 'this is new', 1, '2025-06-17 07:35:44', '2025-06-17 07:35:44'),
(7, 'dsfsd', 'sdffsd', 1, '2025-06-17 07:51:15', '2025-06-17 07:51:15'),
(8, 'nnnnnn', 'jkjmnmn m, m, m', 6, '2025-08-22 11:21:54', '2025-08-22 11:21:54'),
(10, 'ttt', 'tttt', 1, '2025-10-23 10:07:55', '2025-10-23 10:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_user`
--

INSERT INTO `team_user` (`id`, `team_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, NULL),
(2, 3, 2, NULL, NULL),
(3, 4, 1, NULL, NULL),
(4, 4, 2, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 5, 2, NULL, NULL),
(7, 5, 3, NULL, NULL),
(8, 6, 2, NULL, NULL),
(9, 6, 3, NULL, NULL),
(10, 6, 4, NULL, NULL),
(11, 7, 2, NULL, NULL),
(12, 7, 3, NULL, NULL),
(14, 9, 1, NULL, NULL),
(15, 9, 2, NULL, NULL),
(16, 9, 3, NULL, NULL),
(17, 9, 4, NULL, NULL),
(18, 8, 2, NULL, NULL),
(19, 10, 2, NULL, NULL),
(20, 10, 3, NULL, NULL),
(21, 10, 4, NULL, NULL),
(22, 10, 5, NULL, NULL),
(23, 10, 6, NULL, NULL),
(24, 10, 7, NULL, NULL),
(25, 10, 8, NULL, NULL),
(26, 10, 9, NULL, NULL),
(27, 10, 10, NULL, NULL),
(28, 11, 2, NULL, NULL),
(29, 11, 3, NULL, NULL),
(30, 11, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `slack_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone_num` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `linkedin_access_token` varchar(1000) DEFAULT NULL,
  `linkedin_token_expires_at` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `google_id`, `slack_id`, `name`, `phone_num`, `email`, `email_verified_at`, `password`, `linkedin_access_token`, `linkedin_token_expires_at`, `profile_image`, `remember_token`, `created_at`, `updated_at`, `country_id`) VALUES
(1, NULL, NULL, 'Azhar', '03075818308', 'azhar1@gmail.com', NULL, '$2y$12$Gik6ZCGdDS.ilHb51dBR2O7ztsPqBCP7ejfOMLETPSLi8WTRHjQpe', NULL, NULL, NULL, NULL, NULL, '2025-11-04 06:19:30', NULL),
(2, NULL, NULL, 'mohsin', '03325078833', 'azharmehmodod74600@gmail.com', NULL, '$2y$12$Gik6ZCGdDS.ilHb51dBR2O7ztsPqBCP7ejfOMLETPSLi8WTRHjQpe', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, 'Farooq Tanveer', '03033330770', 'stackbuffer2@gmail.com', NULL, '$2y$12$lZZP0NtxGxTZ4QbAIzpYRueaAR.FjqlEGFgA50MSS1eZ6jqWsxC/e', NULL, NULL, NULL, NULL, '2025-06-17 07:23:40', '2025-06-17 07:23:40', NULL),
(4, NULL, NULL, 'SB', '03033330678', 'azhar12@gmail.com', NULL, '$2y$12$9tGyYixNkPMti1rm0VisJ.j8Cqb77poP..RNE8ukrMU/8.rpla6/C', NULL, NULL, NULL, NULL, '2025-06-17 07:29:42', '2025-06-17 07:29:42', NULL),
(5, '115208984245035433799', NULL, 'Abid Ali', NULL, 'abidwork005@gmail.com', NULL, '$2y$12$Gik6ZCGdDS.ilHb51dBR2O7ztsPqBCP7ejfOMLETPSLi8WTRHjQpe', NULL, NULL, NULL, NULL, '2025-06-23 05:09:43', '2025-06-23 05:09:43', NULL),
(6, NULL, NULL, 'muhammad anab test', '3434347687866', 'anabkhanm@gmail.com', NULL, '$2y$12$Gik6ZCGdDS.ilHb51dBR2O7ztsPqBCP7ejfOMLETPSLi8WTRHjQpe', NULL, NULL, NULL, NULL, '2025-08-07 14:01:36', '2025-08-07 14:01:36', NULL),
(7, NULL, NULL, 'anab', '03165667783', 'binobe6241@litepax.com', NULL, '$2y$12$GfJnZbX0fhlQcQa15of3J.V0rgN4dokjOm7dkJ9k3oVDEAWLmreU.', NULL, NULL, NULL, NULL, '2025-08-22 10:50:24', '2025-08-22 10:50:24', NULL),
(8, NULL, NULL, 'Daniyal Tariq', '03415524986', 'daniyaltariq238@gmail.com', NULL, '$2y$12$wlD2K6mwKd9L7n2ioB06eulFm98aNIUbTUN8zSVxp/8ixW6/GSbmu', NULL, NULL, NULL, NULL, '2025-08-22 10:50:26', '2025-08-22 10:50:26', NULL),
(9, NULL, NULL, 'muhammad anab khan', '343434', 'anabkhann@gmail.com', NULL, '$2y$12$LJp8cVTN2A3r5whPtIMNYO7EGkJFM/DGKIomTGPUziphdkIvB2loa', NULL, NULL, NULL, NULL, '2025-09-23 07:22:06', '2025-09-23 07:22:06', NULL),
(10, NULL, NULL, 'muhammad anab khan', '343434', 'anabkhanmn@gmail.com', NULL, '$2y$12$6yBjUpw1jyZuUGNo4QCHa.kZDvboxyqmrKxYHBu9yZ0nHPSM.IiOy', NULL, NULL, NULL, NULL, '2025-10-16 09:32:47', '2025-10-16 09:32:47', NULL),
(11, NULL, NULL, 'temp test', '0322222222222', 'nafees@stackbuffers.com', NULL, '$2y$12$Gik6ZCGdDS.ilHb51dBR2O7ztsPqBCP7ejfOMLETPSLi8WTRHjQpe', NULL, NULL, NULL, NULL, '2025-11-03 09:34:20', '2025-11-03 09:34:20', NULL),
(12, NULL, NULL, 'Nafees Akbar', '03320555595', 'stackbuffersislamabad@gmail.com', NULL, '$2y$12$FACmZCFklVBNsp2zbYaK4e4/M3tiDzuZf/IQ.M2ohxUv6Lw9aNm4u', NULL, NULL, NULL, NULL, '2025-11-06 10:28:26', '2025-11-06 10:28:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zoom_meeting_users`
--

CREATE TABLE `zoom_meeting_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zoom_meeting_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zoom_meeting_users`
--

INSERT INTO `zoom_meeting_users` (`id`, `zoom_meeting_id`, `user_id`, `created_at`, `updated_at`) VALUES
(10, '73271505134', 1, '2025-05-08 05:58:11', '2025-05-08 05:58:11'),
(11, '74832331944', 2, '2025-05-08 06:00:54', '2025-05-08 06:00:54'),
(12, '74308390421', 2, '2025-05-08 06:02:24', '2025-05-08 06:02:24'),
(13, '76577848686', 2, '2025-05-08 06:20:58', '2025-05-08 06:20:58'),
(14, '76395325495', 2, '2025-05-08 07:24:51', '2025-05-08 07:24:51'),
(15, '71886560887', 2, '2025-05-12 12:07:04', '2025-05-12 12:07:04'),
(16, '84142266881', 3, '2025-06-23 05:30:30', '2025-06-23 05:30:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_task_id_foreign` (`task_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emails_sender_id_foreign` (`sender_id`),
  ADD KEY `emails_receiver_id_foreign` (`receiver_id`),
  ADD KEY `emails_folder_id_foreign` (`folder_id`);

--
-- Indexes for table `event_users`
--
ALTER TABLE `event_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_users_calendar_id_foreign` (`calendar_id`),
  ADD KEY `event_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file_syncs`
--
ALTER TABLE `file_syncs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_syncs_user_id_foreign` (`user_id`),
  ADD KEY `file_syncs_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `file_sync_shares`
--
ALTER TABLE `file_sync_shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_sync_shares_file_id_foreign` (`file_id`),
  ADD KEY `file_sync_shares_share_with_user_id_foreign` (`share_with_user_id`),
  ADD KEY `file_sync_shares_share_by_user_id_foreign` (`share_by_user_id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folders_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_foreign` (`user_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meetings_user_id_foreign` (`user_id`);

--
-- Indexes for table `meeting_user`
--
ALTER TABLE `meeting_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_user_meeting_id_foreign` (`meeting_id`),
  ADD KEY `meeting_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minisites`
--
ALTER TABLE `minisites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `minisites_page_added_by_foreign` (`page_added_by`),
  ADD KEY `minisites_team_id_foreign` (`team_id`),
  ADD KEY `minisites_document_added_by_foreign` (`document_added_by`),
  ADD KEY `minisites_document_team_id_foreign` (`document_team_id`);

--
-- Indexes for table `minisite_documents`
--
ALTER TABLE `minisite_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `minisite_documents_team_id_foreign` (`team_id`),
  ADD KEY `minisite_documents_document_added_by_foreign` (`document_added_by`);

--
-- Indexes for table `news_feeds`
--
ALTER TABLE `news_feeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_feeds_user_id_foreign` (`user_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_created_by_foreign` (`created_by`);

--
-- Indexes for table `project_statuses`
--
ALTER TABLE `project_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_statuses_project_id_foreign` (`project_id`),
  ADD KEY `project_statuses_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`),
  ADD KEY `tasks_assigned_to_foreign` (`assigned_to`);

--
-- Indexes for table `task_statuses`
--
ALTER TABLE `task_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_statuses_task_id_foreign` (`task_id`),
  ADD KEY `task_statuses_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_foreign` (`user_id`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_user_team_id_foreign` (`team_id`),
  ADD KEY `team_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_country_id_foreign` (`country_id`);

--
-- Indexes for table `zoom_meeting_users`
--
ALTER TABLE `zoom_meeting_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zoom_meeting_users_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendars`
--
ALTER TABLE `calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `event_users`
--
ALTER TABLE `event_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `file_syncs`
--
ALTER TABLE `file_syncs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `file_sync_shares`
--
ALTER TABLE `file_sync_shares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `meeting_user`
--
ALTER TABLE `meeting_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `minisites`
--
ALTER TABLE `minisites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `minisite_documents`
--
ALTER TABLE `minisite_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `news_feeds`
--
ALTER TABLE `news_feeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `project_statuses`
--
ALTER TABLE `project_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `task_statuses`
--
ALTER TABLE `task_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `zoom_meeting_users`
--
ALTER TABLE `zoom_meeting_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emails_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emails_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_users`
--
ALTER TABLE `event_users`
  ADD CONSTRAINT `event_users_calendar_id_foreign` FOREIGN KEY (`calendar_id`) REFERENCES `calendars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `file_syncs`
--
ALTER TABLE `file_syncs`
  ADD CONSTRAINT `file_syncs_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `file_syncs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `file_syncs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meeting_user`
--
ALTER TABLE `meeting_user`
  ADD CONSTRAINT `meeting_user_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meeting_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
