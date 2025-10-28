-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2025 at 07:57 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stack_unitc`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE `calendars` (
  `id` bigint UNSIGNED NOT NULL,
  `event_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `all_day` tinyint(1) NOT NULL DEFAULT '0',
  `event_start_time` time DEFAULT NULL,
  `event_end_time` time DEFAULT NULL,
  `event_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_description` text COLLATE utf8mb4_unicode_ci,
  `event_shared` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_value` int DEFAULT NULL,
  `reminder_unit` enum('minutes','hours','days','weeks') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recurrence_mode` enum('never','on','after') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'never',
  `recurrence_end_date` date DEFAULT NULL,
  `recurrence_count` int DEFAULT NULL,
  `recurrence_type` enum('daily','weekly','monthly','yearly') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recurrence_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `send_notification` tinyint(1) NOT NULL DEFAULT '0',
  `notification_type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

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
(14, 'Farooq bhai ka dera', '2025-06-20', 0, '12:00:00', '01:00:00', 'Dera Farooq BHAI', 'Deray par hazri', 'Public', 0, NULL, 'never', NULL, 1, 'daily', NULL, 0, '[\"system\"]', '2025-06-19 18:34:48', '2025-06-19 18:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `task_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'sadasdasd', '2025-07-08 12:12:21', '2025-07-08 12:12:22'),
(2, 1, 1, 'asdasdasd', '2025-07-09 04:56:12', '2025-07-09 04:56:12'),
(3, 1, 1, 'asdasdasd', '2025-07-09 04:56:12', '2025-07-09 04:56:12'),
(4, 1, 1, 'asdasdasd', '2025-07-09 04:56:12', '2025-07-09 04:56:12'),
(5, 1, 1, 'asdasdasd', '2025-07-09 04:56:12', '2025-07-09 04:56:12'),
(6, 1, 1, 'asdasdasd', '2025-07-09 04:56:12', '2025-07-09 04:56:12'),
(7, 1, 1, 'asdasdasd', '2025-07-09 04:56:49', '2025-07-09 04:56:49'),
(8, 1, 1, 'asdasdasd', '2025-07-09 04:57:36', '2025-07-09 04:57:36'),
(9, 1, 1, 'Helloo', '2025-07-09 04:57:56', '2025-07-09 04:57:56'),
(10, 1, 1, 'asdfasddsad', '2025-07-09 05:00:40', '2025-07-09 05:00:40'),
(11, 1, 1, 'asdasdasd', '2025-07-09 05:00:44', '2025-07-09 05:00:44'),
(12, 1, 1, 'okay', '2025-07-09 05:00:48', '2025-07-09 05:00:48'),
(13, 1, 1, 'okayyy', '2025-07-09 05:00:56', '2025-07-09 05:00:56'),
(14, 1, 1, 'okay g', '2025-07-09 05:03:53', '2025-07-09 05:03:53'),
(15, 2, 1, 'I am working', '2025-07-09 05:42:02', '2025-07-09 05:42:02'),
(16, 2, 1, 'this is commnet', '2025-07-10 06:05:36', '2025-07-10 06:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonecode` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint UNSIGNED NOT NULL,
  `folder_id` bigint UNSIGNED DEFAULT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_starred` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_draft` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cc` text COLLATE utf8mb4_unicode_ci,
  `bcc` text COLLATE utf8mb4_unicode_ci
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
(15, NULL, 1, 2, 'azharmehmood74600@gmail.com', 'new demo', '<p>this is new demo</p>', 0, 0, NULL, 0, '2025-04-14 04:36:34', '2025-04-14 04:37:16', NULL, NULL),
(16, NULL, 1, 3, 'stackbuffer2@gmail.com', 'Want Discussion on IT Startup', '<p>test</p>', 0, 0, NULL, 0, '2025-06-17 07:26:59', '2025-06-17 07:26:59', NULL, NULL),
(17, NULL, 4, 3, 'stackbuffer2@gmail.com', 'Want to change the nameserver of domain', '<p>Test</p>', 0, 0, NULL, 0, '2025-06-17 07:30:27', '2025-06-17 07:30:27', NULL, NULL),
(18, NULL, 1, NULL, 'qynig@mailinator.com', 'Error consequatur I', NULL, 0, 0, NULL, 1, '2025-06-27 02:22:00', '2025-06-27 02:22:00', NULL, NULL),
(19, NULL, 1, 4, 'mhrabid558@gmail.com', 'Hello', '<p>hello g kia hal hain</p>', 0, 0, NULL, 0, '2025-07-03 05:26:17', '2025-07-03 05:27:21', NULL, NULL),
(20, NULL, 1, 5, 'abidwork005@gmail.com', 'sdasd', '<p>asdasdasd</p>', 0, 0, NULL, 0, '2025-07-03 05:29:33', '2025-07-03 05:29:33', NULL, NULL),
(21, NULL, 1, 5, 'abidwork005@gmail.com', 'sdasd', '<p>asdasdasd</p>', 0, 0, NULL, 1, '2025-07-03 05:29:33', '2025-07-03 05:29:33', NULL, NULL),
(22, NULL, 1, 5, 'abidwork005@gmail.com', 'asdasd', '<p>asdsad</p>', 0, 0, NULL, 1, '2025-07-03 05:33:16', '2025-07-03 05:33:16', NULL, NULL),
(23, NULL, 1, 5, 'abidwork005@gmail.com', 'This is Subject', '<p>This is body message.</p>', 0, 0, NULL, 1, '2025-07-07 07:02:15', '2025-07-07 07:04:39', NULL, NULL),
(24, NULL, 1, 5, 'abidwork005@gmail.com', 'This is Subject', '<p>This is Body</p>', 1, 0, NULL, 0, '2025-07-07 07:06:32', '2025-07-10 05:07:01', 'hr@example.com, ceo@example.com', 'person1@example.com, person2@example.com'),
(25, NULL, 1, 5, 'abidwork005@gmail.com', 'Hello ggggg', '<p>Hello bodyyyyy</p>', 1, 0, NULL, 0, '2025-07-07 07:19:57', '2025-07-10 05:06:53', 'hr@example.com, ceo@example.com', 'person1@example.com, person2@example.com'),
(26, NULL, 1, 5, 'abidwork005@gmail.com', 'This is subject email', '<p>This is body email</p>', 1, 0, NULL, 0, '2025-07-07 07:27:42', '2025-07-10 05:00:50', 'joinabiddev@gmail.com, natti6780@gmail.com', 'abidmhr2045@gmail.com, natti6780@gmail.com'),
(27, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, '2025-07-08 06:04:57', '2025-07-08 06:04:57', NULL, NULL),
(28, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, '2025-07-08 06:10:48', '2025-07-08 06:10:48', NULL, NULL),
(29, NULL, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, '2025-07-10 04:58:32', '2025-07-10 04:58:36', NULL, NULL),
(30, NULL, 1, 5, 'abidwork005@gmail.com', 'sdfsdfsdf', '<p>sdfsdfsdfsdfsdfsdfsdf</p>', 0, 0, NULL, 0, '2025-07-10 06:22:55', '2025-07-10 06:24:02', 'hr@example.com, ceo@example.com', 'abidmhr2045@gmail.com, natti6780@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `event_users`
--

CREATE TABLE `event_users` (
  `id` bigint UNSIGNED NOT NULL,
  `calendar_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
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
(7, 12, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('file','folder') COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint DEFAULT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
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
(7, 'Screenshot 2025-04-26 010159.png', 'uploads/Screenshot 2025-04-26 010159.png', 'file', 239039, 'image/png', 1, NULL, '2025-08-21 06:55:38', '2025-08-21 06:55:38'),
(8, 'Screenshot 2025-06-26 160514.png', 'uploads/Screenshot 2025-06-26 160514.png', 'file', 90453, 'image/png', 1, NULL, '2025-08-21 06:58:51', '2025-08-21 06:58:51'),
(9, 'respectmart-vue', 'uploads/respectmart-vue', 'folder', NULL, NULL, 1, NULL, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(10, '.browserslistrc', 'uploads/respectmart-vue/.browserslistrc', 'file', 30, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(11, '.env', 'uploads/respectmart-vue/.env', 'file', 384, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(12, '.eslintrc.js', 'uploads/respectmart-vue/.eslintrc.js', 'file', 741, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(13, '.gitignore', 'uploads/respectmart-vue/.gitignore', 'file', 275, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(14, '.nvmrc', 'uploads/respectmart-vue/.nvmrc', 'file', 6, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(15, 'babel.config.js', 'uploads/respectmart-vue/babel.config.js', 'file', 67, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(16, 'conversion.log', 'uploads/respectmart-vue/conversion.log', 'file', 1476, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(17, 'cypress.json', 'uploads/respectmart-vue/cypress.json', 'file', 50, 'application/json', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(18, '.htaccess', 'uploads/respectmart-vue/.htaccess', 'file', 418, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(19, 'blog.json', 'uploads/respectmart-vue/blog.json', 'file', 103619, 'application/json', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(20, 'respectmart-business-home.json', 'uploads/respectmart-vue/respectmart-business-home.json', 'file', 7057, 'application/json', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(21, 'respectmart-footer.json', 'uploads/respectmart-vue/respectmart-footer.json', 'file', 893, 'application/json', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(22, 'respectmart-home.json', 'uploads/respectmart-vue/respectmart-home.json', 'file', 5943, 'application/json', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(23, 'respectmart-home.remove.txt', 'uploads/respectmart-vue/respectmart-home.remove.txt', 'file', 345, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(24, 'respectmart-shipping-home.json', 'uploads/respectmart-vue/respectmart-shipping-home.json', 'file', 4240, 'application/json', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(25, 'flag-bg.png', 'uploads/respectmart-vue/flag-bg.png', 'file', 102775, 'image/png', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(26, 'countries.json', 'uploads/respectmart-vue/countries.json', 'file', 10823, 'application/json', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(27, 'bootstrap.css', 'uploads/respectmart-vue/bootstrap.css', 'file', 184957, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(28, 'main-business.css', 'uploads/respectmart-vue/main-business.css', 'file', 10706, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(29, 'main.css', 'uploads/respectmart-vue/main.css', 'file', 253000, 'text/plain', 1, 9, '2025-08-21 07:00:02', '2025-08-21 07:00:02'),
(30, 'Screenshot 2025-04-26 010159.png', 'uploads/Screenshots/Screenshot 2025-04-26 010159.png', 'file', 239039, 'image/png', 1, 1, '2025-08-21 07:00:09', '2025-08-21 07:00:09'),
(31, 'Screenshot 2025-05-20 163300.png', 'uploads/Screenshots/Screenshot 2025-05-20 163300.png', 'file', 66320, 'image/png', 1, 1, '2025-08-21 07:00:09', '2025-08-21 07:00:09'),
(32, 'Screenshot 2025-06-26 160514.png', 'uploads/Screenshots/Screenshot 2025-06-26 160514.png', 'file', 90453, 'image/png', 1, 1, '2025-08-21 07:00:09', '2025-08-21 07:00:09'),
(33, 'Screenshot 2025-06-27 150557.png', 'uploads/Screenshots/Screenshot 2025-06-27 150557.png', 'file', 265003, 'image/png', 1, 1, '2025-08-21 07:00:09', '2025-08-21 07:00:09'),
(34, 'Screenshot 2025-07-08 004250.png', 'uploads/Screenshots/Screenshot 2025-07-08 004250.png', 'file', 138976, 'image/png', 1, 1, '2025-08-21 07:00:09', '2025-08-21 07:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `file_sync_shares`
--

CREATE TABLE `file_sync_shares` (
  `id` bigint UNSIGNED NOT NULL,
  `file_id` bigint UNSIGNED NOT NULL,
  `share_with_user_id` bigint UNSIGNED NOT NULL,
  `share_by_user_id` bigint UNSIGNED NOT NULL,
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
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `type`, `filename`, `path`, `user_id`, `created_at`, `updated_at`) VALUES
(35, 'image', '1741851758_man-wearing-white-shirt-medium-shot.jpg', '/media/images/1741851758_man-wearing-white-shirt-medium-shot.jpg', 1, '2025-03-13 02:42:38', '2025-03-13 02:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `google_event_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `duration` int NOT NULL,
  `agenda` text COLLATE utf8mb4_unicode_ci,
  `meeting_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_user`
--

CREATE TABLE `meeting_user` (
  `id` bigint UNSIGNED NOT NULL,
  `meeting_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(63, '2025_07_08_064122_create_tasks_table', 8),
(64, '2025_08_27_055609_create_meetings_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `minisites`
--

CREATE TABLE `minisites` (
  `id` bigint UNSIGNED NOT NULL,
  `page_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_description` text COLLATE utf8mb4_unicode_ci,
  `page_added_by` bigint UNSIGNED DEFAULT NULL,
  `team_id` bigint UNSIGNED NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_added_by` bigint UNSIGNED DEFAULT NULL,
  `document_team_id` bigint UNSIGNED DEFAULT NULL,
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
(6, NULL, 'Quis ipsum dolor com', 'Odio ipsam esse dolo', 1, 2, NULL, NULL, NULL, NULL, '2025-10-22 01:09:55', '2025-10-22 01:09:55'),
(7, NULL, NULL, NULL, NULL, 2, 'minisite/1761113419_68f8754b26d2f.jpg', 'Qui quia veritatis d', 1, NULL, '2025-10-22 01:10:19', '2025-10-22 01:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `news_feeds`
--

CREATE TABLE `news_feeds` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `urlToImage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
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
(4, 'Perferendis perspici', 'Eum id tempor praes', 'Autem voluptatem Se', 'Deleniti asperiores', 'newsFeed/1761048936_Screenshot 2025-06-27 150557.png', 'https://www.zod.us', 1, '2025-10-21 07:15:36', '2025-10-21 07:15:36', '2025-10-21 07:15:36'),
(5, 'Nam autem deleniti r', 'Dolor libero enim et', 'Quo sed sit exercit', 'Ipsam aut quia labor', NULL, 'https://www.joqazu.in', 1, '2025-10-22 01:40:35', '2025-10-22 01:40:35', '2025-10-22 01:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'HAZ', 'TEST', 'images/default-notes.png', '2025-06-16 12:23:08', '2025-06-16 12:23:08'),
(2, 1, 'test', 'Test Description', 'notes/1750146381_68511d4daa26c.png', '2025-06-17 07:46:21', '2025-06-17 07:46:21'),
(3, 1, 'new user', 'hello world', 'notes/1750229791_6852631fd581e.png', '2025-06-18 06:56:31', '2025-06-18 06:56:31'),
(4, 1, 'test', 'test is this test is this test is this test is thistest is this test is this test is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is thistest is this', 'images/default-notes.png', '2025-06-18 06:57:25', '2025-06-18 06:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('azharmehmood74600@gmail.com', '$2y$12$aBMLRYSuAtf60OITrIEfNuhlzMuT6vpdAQTA2PLP/4hj3FzWDSHr.', '2025-03-20 01:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('not_started','in_progress','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_started',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Hop Emerson', 'Reprehenderit enim q', '2017-11-09', '2024-03-13', 'completed', 3, '2025-07-08 01:57:12', '2025-07-08 01:57:12'),
(2, 'Ian Sharp', 'Voluptatem omnis fac', '1972-12-03', '2004-05-02', 'completed', 5, '2025-07-09 05:38:22', '2025-07-09 05:38:22'),
(3, 'hello', 'hellloo', '2025-07-24', '2025-07-25', 'in_progress', 2, '2025-07-10 02:41:51', '2025-07-10 02:41:51'),
(4, 'sdsad', 'asdasd', '2025-07-17', '2025-07-29', 'in_progress', 3, '2025-07-10 02:44:40', '2025-07-10 02:44:40'),
(5, 'Micah Becker', 'Vitae sit proident', '2026-07-19', '2040-05-28', 'not_started', 3, '2025-07-10 03:11:29', '2025-07-10 03:11:29'),
(6, 'Ramona Frost', 'Quis odit vitae vel', '1974-04-10', '1988-08-21', 'completed', 2, '2025-07-10 03:11:56', '2025-07-10 03:11:56'),
(7, 'zsdasd', 'asdasdasd', '2025-07-24', '2025-07-24', 'in_progress', 2, '2025-07-10 05:23:14', '2025-07-10 05:23:14'),
(8, 'texfgf', 'sdfsdf', '2025-07-24', '2025-07-31', 'in_progress', 3, '2025-07-10 06:02:58', '2025-07-10 06:02:58'),
(9, 'test 2', 'test', '2025-10-22', '2025-10-29', 'not_started', 2, '2025-10-22 01:51:58', '2025-10-22 01:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `project_statuses`
--

CREATE TABLE `project_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_statuses`
--

INSERT INTO `project_statuses` (`id`, `project_id`, `updated_by`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'todo', '2025-07-08 01:57:12', '2025-07-08 01:57:12'),
(2, 2, 1, NULL, 'todo', '2025-07-09 05:38:22', '2025-07-09 05:38:22'),
(3, 3, 1, NULL, 'todo', '2025-07-10 02:41:51', '2025-07-10 02:41:51'),
(4, 4, 1, NULL, 'todo', '2025-07-10 02:44:40', '2025-07-10 02:44:40'),
(5, 5, 1, NULL, 'todo', '2025-07-10 03:11:29', '2025-07-10 03:11:29'),
(6, 6, 1, NULL, 'todo', '2025-07-10 03:11:56', '2025-07-10 03:11:56'),
(7, 7, 1, NULL, 'todo', '2025-07-10 05:23:14', '2025-07-10 05:23:14'),
(8, 8, 1, NULL, 'todo', '2025-07-10 06:02:58', '2025-07-10 06:02:58'),
(9, 9, 1, NULL, 'todo', '2025-10-22 01:51:58', '2025-10-22 01:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `assigned_to` bigint UNSIGNED DEFAULT NULL,
  `status` enum('todo','in_progress','onhold','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'todo',
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `due_date` date DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `title`, `description`, `assigned_to`, `status`, `priority`, `due_date`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Task5', 'This is the descriptionThis is the descriptionThis is the descriptionThis is the descriptionThis is the descriptionThis is the descriptionThis is the description This is the description This is the descriptionThis is the description This is the descriptionThis is the descriptionThis is the description This is the descriptionThis is the description This is the descriptionvThis is the descriptionvThis is the description This is the description This is the description vThis is the descriptionThis is the descriptionThis is the descriptionThis is the descriptionThis is the descriptionThis is the description', 4, 'todo', 'high', '2025-07-08', NULL, '2025-07-08 11:52:00', '2025-07-10 06:06:34'),
(2, 2, 'Porro Nam sunt iure', 'Ullam explicabo Arc', 2, 'done', 'low', '2037-09-05', '2025-10-22 01:45:13', '2025-07-09 05:38:22', '2025-10-22 01:45:13'),
(3, 2, 'Corporis voluptas ma', 'Voluptas anim adipis', 2, 'todo', 'high', '2038-05-13', NULL, '2025-07-09 05:38:22', '2025-07-09 05:38:22'),
(4, 2, 'Iusto rerum blanditi', 'Minim officia illum', 2, 'todo', 'medium', '2033-01-22', NULL, '2025-07-09 05:38:22', '2025-07-09 05:38:22'),
(5, 2, 'Maiores eligendi in', 'Reiciendis unde quas', 5, 'todo', 'high', '2031-11-26', NULL, '2025-07-09 05:38:22', '2025-07-09 05:38:22'),
(6, 2, 'Assumenda blanditiis', 'Molestias aut aliqui', 3, 'todo', 'high', '1985-08-07', NULL, '2025-07-09 05:38:22', '2025-07-09 05:38:22'),
(7, 2, 'Quia neque culpa do', 'Aut pariatur Quia f', 4, 'todo', 'high', '1994-07-09', NULL, '2025-07-09 05:38:22', '2025-07-09 05:38:22'),
(8, 2, 'Reprehenderit conseq', 'Officiis ex error co', 3, 'todo', 'high', '2045-12-26', NULL, '2025-07-09 05:38:22', '2025-07-09 05:38:22'),
(9, 3, 'asd', 'asd', 3, 'todo', 'medium', '2025-07-24', NULL, '2025-07-10 02:41:51', '2025-07-10 02:41:51'),
(10, 3, 'asd', 'asd', 4, 'todo', 'low', '2025-07-28', NULL, '2025-07-10 02:41:51', '2025-07-10 02:41:51'),
(11, 4, 'asdasd', 'asd', 3, 'todo', 'medium', '2025-07-22', NULL, '2025-07-10 02:44:40', '2025-07-10 02:44:40'),
(12, 5, 'Eos ullam qui aut et', 'Voluptatem magni es', 2, 'todo', 'medium', '2028-02-26', NULL, '2025-07-10 03:11:29', '2025-07-10 03:11:29'),
(13, 6, 'Fuga Veritatis id d', 'Recusandae Delectus', 4, 'todo', 'high', '2039-01-27', NULL, '2025-07-10 03:11:56', '2025-07-10 03:11:56'),
(14, 7, 'qwer', 'sdfdsf', 4, 'todo', 'low', '2026-07-23', NULL, '2025-07-10 05:23:14', '2025-07-10 05:23:14'),
(15, 8, 'sdfsf', 'sdf', 2, 'todo', 'low', '2025-08-01', NULL, '2025-07-10 06:02:58', '2025-07-10 06:02:58'),
(16, 8, 'sdf', 'sdf', 1, 'todo', 'medium', '2025-07-31', NULL, '2025-07-10 06:02:58', '2025-07-10 06:02:58'),
(17, 8, 'sdf', 'sdf', 2, 'todo', 'high', '2025-07-25', NULL, '2025-07-10 06:02:58', '2025-07-10 06:02:58'),
(18, 9, 'task 1', 'gffffh', 3, 'todo', 'medium', '2025-10-24', NULL, '2025-10-22 01:51:58', '2025-10-22 01:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `task_statuses`
--

CREATE TABLE `task_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
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
(4, 1, 'todo', 'high', 1, '2025-07-10 06:06:34', '2025-07-10 06:06:34'),
(5, 2, 'in_progress', 'low', 1, '2025-07-10 06:07:19', '2025-07-10 06:07:19'),
(6, 2, 'done', 'low', 1, '2025-10-22 01:45:13', '2025-10-22 01:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint UNSIGNED NOT NULL,
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_description` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
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
(8, 'Yolanda Soto', 'Cupidatat laborum do', 1, '2025-10-22 01:17:26', '2025-10-22 01:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
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
(13, 8, 3, NULL, NULL),
(14, 8, 4, NULL, NULL),
(15, 8, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slack_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `google_id`, `slack_id`, `name`, `phone_num`, `email`, `email_verified_at`, `password`, `profile_image`, `remember_token`, `created_at`, `updated_at`, `country_id`) VALUES
(1, NULL, NULL, 'Azhar', '03075818308', 'mhrabid558@gmail.com', NULL, '$2y$12$DnbD2ZYMgpaAFXgz6jXHT.vIgzRog3SwFlSeZvaM/vFHPEM9gKUKS', NULL, 'Miv64FlvcW5NNPbkEv50yA8W2AJf9iiPMMxyvb9Jrenub5Kf2PfnhqZx66bb', NULL, '2025-10-21 07:20:18', NULL),
(2, NULL, NULL, 'mohsin', '03325078833', 'azharmehmood74600@gmail.com', NULL, '$2y$12$Gik6ZCGdDS.ilHb51dBR2O7ztsPqBCP7ejfOMLETPSLi8WTRHjQpe', NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, 'Farooq Tanveer', '03033330770', 'stackbuffer2@gmail.com', NULL, '$2y$12$lZZP0NtxGxTZ4QbAIzpYRueaAR.FjqlEGFgA50MSS1eZ6jqWsxC/e', NULL, NULL, '2025-06-17 07:23:40', '2025-06-17 07:23:40', NULL),
(4, NULL, NULL, 'SB', '03033330678', 'azhar12@gmail.com', NULL, '$2y$12$9tGyYixNkPMti1rm0VisJ.j8Cqb77poP..RNE8ukrMU/8.rpla6/C', NULL, NULL, '2025-06-17 07:29:42', '2025-06-17 07:29:42', NULL),
(5, '115208984245035433799', NULL, 'Abid Ali', NULL, 'abidwork005@gmail.com', NULL, '$2y$12$Gik6ZCGdDS.ilHb51dBR2O7ztsPqBCP7ejfOMLETPSLi8WTRHjQpe', NULL, NULL, '2025-06-23 05:09:43', '2025-06-23 05:09:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zoom_meeting_users`
--

CREATE TABLE `zoom_meeting_users` (
  `id` bigint UNSIGNED NOT NULL,
  `zoom_meeting_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
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
(16, '84142266881', 3, '2025-06-23 05:30:30', '2025-06-23 05:30:30'),
(17, '88080432802', 1, '2025-08-26 07:15:30', '2025-08-26 07:15:30');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `event_users`
--
ALTER TABLE `event_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `file_syncs`
--
ALTER TABLE `file_syncs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `file_sync_shares`
--
ALTER TABLE `file_sync_shares`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_user`
--
ALTER TABLE `meeting_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `minisites`
--
ALTER TABLE `minisites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news_feeds`
--
ALTER TABLE `news_feeds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_statuses`
--
ALTER TABLE `project_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `task_statuses`
--
ALTER TABLE `task_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `zoom_meeting_users`
--
ALTER TABLE `zoom_meeting_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- Constraints for table `file_sync_shares`
--
ALTER TABLE `file_sync_shares`
  ADD CONSTRAINT `file_sync_shares_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `file_syncs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `file_sync_shares_share_by_user_id_foreign` FOREIGN KEY (`share_by_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `file_sync_shares_share_with_user_id_foreign` FOREIGN KEY (`share_with_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `minisites`
--
ALTER TABLE `minisites`
  ADD CONSTRAINT `minisites_document_added_by_foreign` FOREIGN KEY (`document_added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `minisites_document_team_id_foreign` FOREIGN KEY (`document_team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `minisites_page_added_by_foreign` FOREIGN KEY (`page_added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `minisites_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news_feeds`
--
ALTER TABLE `news_feeds`
  ADD CONSTRAINT `news_feeds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_statuses`
--
ALTER TABLE `project_statuses`
  ADD CONSTRAINT `project_statuses_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_statuses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task_statuses`
--
ALTER TABLE `task_statuses`
  ADD CONSTRAINT `task_statuses_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_statuses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_user`
--
ALTER TABLE `team_user`
  ADD CONSTRAINT `team_user_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `zoom_meeting_users`
--
ALTER TABLE `zoom_meeting_users`
  ADD CONSTRAINT `zoom_meeting_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
