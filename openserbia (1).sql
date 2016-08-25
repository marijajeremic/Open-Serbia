-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2016 at 02:23 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `openserbia`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `creator` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `creator`, `date`, `is_deleted`) VALUES
(1, 'Nocni klubovi', 3, '2016-06-26 14:49:57', 0),
(3, 'Bazeni', 3, '2016-06-26 19:10:30', 0),
(4, 'Muzeji', 3, '2016-06-26 19:10:54', 0),
(5, 'Hoteli', 3, '2016-06-26 19:11:17', 0),
(6, 'Spa', 3, '2016-06-28 00:48:13', 0),
(7, 'Hrana', 14, '2016-07-17 19:53:25', 1),
(8, 'Restorani', 14, '2016-07-20 18:47:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment_id`, `user_id`, `content`, `post_id`, `date`, `status`, `is_deleted`) VALUES
(1, 0, 6, '\r\n        Nisam znao da ovo postoji u Beogradu.', 3, '2016-07-06 13:38:02', 1, 0),
(2, 0, 3, '\r\n        Kako je zapravo ruzan ovaj hotel.', 4, '2016-07-06 13:44:51', 1, 1),
(5, 0, 3, '\r\n        OOOOOOOOOOO kakav hotel', 4, '2016-07-06 13:52:35', 1, 0),
(23, 0, 3, '\r\n        lep hotel', 5, '2016-07-11 00:22:32', 0, 0),
(24, 23, 3, 'pa samo na slici...', 5, '2016-07-11 00:22:56', 0, 0),
(35, 30, 14, 'jesu priznajem', 27, '2016-07-20 19:53:14', 1, 0),
(36, 30, 14, 'jesu priznajem', 27, '2016-07-20 19:58:09', 1, 0),
(37, 29, 14, 'slazem se', 27, '2016-07-21 18:57:15', 0, 0),
(38, 29, 14, 'slazem se', 27, '2016-07-21 18:57:26', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `date`) VALUES
(1, 6, 3, '2016-07-04 00:08:54'),
(5, 7, 3, '2016-07-04 00:11:32'),
(6, 10, 3, '2016-07-04 12:24:15'),
(7, 8, 3, '2016-07-04 20:27:50'),
(8, 11, 3, '2016-07-12 00:30:04'),
(9, 18, 18, '2016-07-17 01:55:16'),
(10, 18, 14, '2016-07-17 15:23:13'),
(13, 15, 15, '2016-07-22 19:35:01'),
(14, 15, 15, '2016-07-22 19:35:03'),
(15, 14, 15, '2016-07-23 22:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `sender_id`, `recipient_id`, `status`, `request_date`, `status_update_date`) VALUES
(1, 7, 3, 1, '2016-07-04 00:07:35', '2016-07-04 00:11:31'),
(2, 6, 3, 1, '2016-07-04 00:08:08', '2016-07-04 00:09:19'),
(3, 6, 7, 0, '2016-07-04 00:08:19', NULL),
(4, 8, 3, 2, '2016-07-04 10:44:51', '2016-07-04 11:03:31'),
(5, 10, 3, 1, '2016-07-04 12:23:24', '2016-07-04 12:24:15'),
(6, 8, 7, 0, '2016-07-04 18:48:08', NULL),
(7, 8, 3, 1, '2016-07-04 18:48:40', '2016-07-04 20:27:50'),
(8, 3, 9, 0, '2016-07-04 20:27:36', NULL),
(9, 11, 3, 1, '2016-07-12 00:27:26', '2016-07-12 00:30:04'),
(10, 18, 14, 1, '2016-07-17 01:54:09', '2016-07-17 15:23:13'),
(11, 18, 18, 1, '2016-07-17 01:54:51', '2016-07-17 01:55:16'),
(12, 14, 10, 0, '2016-07-19 13:24:36', NULL),
(13, 14, 14, 2, '2016-07-21 18:25:28', '2016-07-21 18:28:21'),
(14, 14, 14, 1, '2016-07-21 18:28:27', '2016-07-22 01:55:29'),
(15, 15, 15, 1, '2016-07-22 19:34:52', '2016-07-22 19:35:03'),
(16, 18, 11, 0, '2016-07-22 19:38:15', NULL),
(17, 14, 15, 1, '2016-07-22 19:39:24', '2016-07-23 22:05:15'),
(18, 19, 18, 0, '2016-07-22 21:15:36', NULL),
(19, 14, 12, 0, '2016-07-23 22:04:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `img_name`, `user_id`, `date`) VALUES
(19, '20160630-17265386836986-Background.jpg', 3, '2016-06-30 15:26:53'),
(20, '20160630-172653441144438-coloeful-balls-cool-hd-desktop-background-wallpapers.jpg', 3, '2016-06-30 15:26:53'),
(21, '20160630-172653756559973-ykyqottitdlrcemupbfs.jpg', 3, '2016-06-30 15:26:53'),
(22, '20160630-1727092023738694-86WiOig.jpg', 3, '2016-06-30 15:27:09'),
(23, '20160630-1727091276015298-6968796-desktop-wallpaper-backgrounds-1080p.jpg', 3, '2016-06-30 15:27:09'),
(24, '20160630-1727091620467579-cool-desktop-shoes-wallpapers.jpg', 3, '2016-06-30 15:27:09'),
(25, '20160630-173338910930257-bf1f801e-71b3-4668-ab3d-156db07ea748.jpg', 3, '2016-06-30 15:33:38'),
(26, '20160630-1733381723604056-giphy.gif', 3, '2016-06-30 15:33:38'),
(27, '20160630-17333850059009-travel.jpg', 3, '2016-06-30 15:33:38'),
(28, '20160630-1733381970623258-travel_suitcase-1200x500.jpg', 3, '2016-06-30 15:33:38'),
(29, '20160630-1733381206157163-travel-industry-air.jpg', 3, '2016-06-30 15:33:38'),
(30, '20160630-1734071661203233-images.jpg', 3, '2016-06-30 15:34:07'),
(31, '20160630-173506611635075-download.jpg', 3, '2016-06-30 15:35:06'),
(32, '20160630-173506106223524-joke-source-code.jpg', 3, '2016-06-30 15:35:06'),
(33, '20160630-1735061442212483-php-binary-code-background-digital-abbreviation-famous-coding-language-used-internet-47244645.jpg', 3, '2016-06-30 15:35:06'),
(34, '20160630-1735061031988433-php-concept-red-background-blue-text-44227744.jpg', 3, '2016-06-30 15:35:06'),
(35, '20160630-173506367186456-stock-photo-binary-code-with-php-and-magnifying-lens-on-black-background-308059304 (1).jpg', 3, '2016-06-30 15:35:06'),
(36, '20160630-173506268276906-stock-photo-php-concept-blue-background-with-blue-text-214586860.jpg', 3, '2016-06-30 15:35:06'),
(37, '20160630-181052893707059-php-development.gif', 3, '2016-06-30 16:10:52'),
(38, '20160630-181052845621120-php-flag.jpg', 3, '2016-06-30 16:10:52'),
(39, '20160704-1632341762248766-P9090026.JPG', 3, '2016-07-04 14:32:34'),
(40, '20160704-163234393158304-PC310083.JPG', 3, '2016-07-04 14:32:34'),
(41, '20160704-1632341455766960-php-development.gif', 3, '2016-07-04 14:32:34'),
(42, '20160704-1632341140976513-php-flag.jpg', 3, '2016-07-04 14:32:34'),
(43, '20160704-163251562144488-30thBirthdaySongForWomanLyricsS.jpg', 3, '2016-07-04 14:32:51'),
(44, '20160704-163251503398109-70130_media-cache-ak0.pinimg.com.jpg', 3, '2016-07-04 14:32:51'),
(45, '20160704-1632512064516910-4276169.jpg', 3, '2016-07-04 14:32:51'),
(46, '20160722-223144482137020-belgrade-serbia-marina.jpg', 15, '2016-07-22 20:31:44'),
(47, '20160722-2231441532426268-beograd.jpg', 15, '2016-07-22 20:31:44'),
(48, '20160722-2231441592874805-kalemegdan.jpg', 15, '2016-07-22 20:31:44'),
(49, '20160722-2231442032606843-most-na-adi-u-beogradu.jpg', 15, '2016-07-22 20:31:44'),
(50, '20160722-223144839584349-Serbia-sito.jpg', 15, '2016-07-22 20:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `is_deletedr` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `reciever_id`, `title`, `content`, `is_read`, `time`, `is_deleted`, `is_deletedr`) VALUES
(1, 3, 6, 'sadasda', 'dsasdasdasdasdadasd', 0, '2016-06-28 00:51:03', 1, 0),
(2, 3, 7, 'Test proba', 'asdasd asdas dasd', 0, '2016-06-28 00:51:37', 1, 0),
(3, 6, 4, 'Volim te', 'Volim te ljubavi moja najjepsa.', 0, '2016-06-28 01:17:29', 0, 0),
(4, 7, 3, 'Test proba', 'Proba ,proba....', 1, '2016-06-28 01:20:23', 0, 0),
(5, 7, 4, 'Test proba', 'Proba,saljemioop x''', 0, '2016-06-28 01:20:43', 0, 0),
(6, 6, 3, 'Testiranje', 'ASdasdasdsadds', 1, '2016-06-28 01:30:07', 0, 0),
(7, 3, 9, 'Hello Marija', 'Pozdrav Marija.Dobrodosli.', 0, '2016-06-28 22:20:20', 0, 0),
(8, 3, 9, 'Pozdrav', 'Zdravo Marija.Ovo je samo test.', 0, '2016-06-29 12:14:25', 1, 0),
(9, 3, 6, 'Love you', 'I love you babe....<3', 0, '2016-06-29 12:36:10', 0, 1),
(10, 3, 7, 'Proba brisanja', 'Cao Sofija.Ovo je samo proba.', 1, '2016-06-29 14:56:13', 0, 0),
(11, 3, 6, 'helllo alex', 'ddddddddddddddddddddddddddddddddddddddd', 1, '2016-06-29 14:56:31', 1, 0),
(12, 6, 3, 'Test proba', 'gggggggggggggggggggggggggggggg', 0, '2016-06-29 14:58:04', 0, 1),
(13, 3, 3, 'aj da pokusamo', 'Tra lal la alalallaallalal', 1, '2016-06-29 20:00:51', 1, 0),
(14, 3, 6, 'odgovor', 'ovo je odgovor na tvoju poruku', 1, '2016-06-29 20:53:39', 1, 0),
(15, 6, 3, 'RE:odgovor', 'a ovo na tvoju', 1, '2016-06-29 21:38:15', 0, 0),
(16, 6, 3, 'RE:helllo alex', 'ma sta ti meni ddddddddddd?', 1, '2016-06-29 21:40:01', 0, 1),
(17, 3, 6, 'RE:RE:helllo alex', 'koji ti je djavo?', 0, '2016-06-29 21:41:29', 1, 0),
(18, 3, 6, 'RE:RE:helllo alex', 'proba', 0, '2016-07-01 14:13:09', 1, 0),
(19, 3, 3, 'RE:aj da pokusamo', 'tralalallalal   ovo je izmena', 1, '2016-07-04 12:15:37', 1, 1),
(20, 3, 3, 'Test proba', 'kkkkkkkkkkkkkkkkkkkkkkkkkkk', 1, '2016-07-08 16:14:34', 1, 0),
(21, 14, 14, 'test test test', 'test test test', 1, '2016-07-21 18:59:29', 1, 0),
(22, 14, 14, 'RE:test test test', 'proba proba', 1, '2016-07-21 18:59:55', 1, 1),
(23, 15, 15, 'Pozdrav', '<p>Pozdrav,</p>\r\n<p>&nbsp;</p>\r\n<p>nova sam na sajtu.Zelim da upoznam ostale clanove.</p>', 0, '2016-07-22 19:32:11', 0, 0),
(24, 15, 15, 'Pozdrav', '<p>Pozdrav,</p>\r\n<p>&nbsp;</p>\r\n<p>nova sam na sajtu.Zelim da upoznam ostale clanove.</p>', 0, '2016-07-22 19:32:16', 0, 0),
(25, 15, 15, 'Pozdrav', '<p>Pozdrav,</p>\r\n<p>&nbsp;</p>\r\n<p>nova sam na sajtu.Zelim da upoznam ostale clanove.</p>', 1, '2016-07-22 19:32:22', 0, 0),
(26, 14, 18, 'Pozdrav', '<p>Pozdrav,</p>\r\n<p>nadam se da uzivas u ovim destinacijama.</p>', 1, '2016-07-22 20:25:15', 0, 0),
(27, 18, 18, 'Samo test', '<p>samo sam htela da se zezam...</p>', 0, '2016-07-22 20:26:35', 0, 0),
(28, 18, 18, 'hello', '<p>Hello</p>', 1, '2016-07-22 20:27:55', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `date`, `is_deleted`) VALUES
(1, 'Beograd', '2016-06-26 14:54:03', 0),
(2, 'Novi Sad', '2016-06-26 18:41:58', 0),
(3, 'Kragujevac', '2016-06-26 18:42:06', 0),
(4, 'Nis', '2016-06-26 18:42:12', 0),
(6, 'Kraljevo', '2016-06-26 18:48:43', 0),
(7, 'Jagodina', '2016-07-12 04:28:26', 0),
(9, 'Uzice', '2016-07-12 04:30:38', 0),
(10, 'Paracin', '2016-07-12 04:30:56', 0),
(11, 'Valjevo', '2016-07-12 04:31:52', 0),
(12, 'Pristina', '2016-07-14 00:32:32', 0),
(14, 'Subotica', '2016-07-14 00:33:57', 0),
(15, 'Pancevo', '2016-07-14 00:34:10', 0),
(16, 'Zrenjanin', '2016-07-14 00:34:34', 0),
(17, 'Cacak', '2016-07-14 00:34:46', 0),
(18, 'Novi Pazar', '2016-07-14 00:35:01', 0),
(19, 'Leskovac', '2016-07-14 00:35:17', 0),
(20, 'Smederevo', '2016-07-14 00:35:24', 0),
(21, 'Vranje', '2016-07-14 00:35:36', 0),
(23, 'Valjevo', '2016-07-14 00:35:56', 0),
(24, 'Krusevac', '2016-07-14 00:36:01', 0),
(25, 'Sabac', '2016-07-14 00:36:05', 0),
(26, 'Pozarevac', '2016-07-14 00:36:18', 0),
(27, 'Belica', '2016-07-21 13:48:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_place` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `lat` double NOT NULL DEFAULT '0',
  `lon` double NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `post_img` longtext NOT NULL,
  `descript` varchar(1000) NOT NULL,
  `admin_approved` tinyint(4) NOT NULL DEFAULT '0',
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `user_id`, `id_category`, `id_place`, `address`, `lat`, `lon`, `date`, `is_deleted`, `post_img`, `descript`, `admin_approved`, `rating`) VALUES
(3, 'Laguna SPA', '\r\n    Apartman Laguna SPA poseduje sopstveni parking kao i profesionalnu spa finsku saunu opremljenu muziÄkom linijom i zvuÄnicima, Ä‘akuzi za dve osobe, tepidarijum, profesionalni sto za masaÅ¾u koji moÅ¾ete neograniÄeno koristiti tokom vaÅ¡eg boravka bez ikakve nadoknade. Apartman ima centralno grejanje.\r\nU moguÄ‡nosti smo da vam organizujemo Äasove tenisa sa profesionalnim licenciranim trenerom kao i sparing meÄeve, Äasove jahanja, razgledanje Beograda, planinarenje po Srbiji (vlasnik apartmana je Älan planinarskog druÅ¡tva). MoÅ¾emo za vas da spremamo jela (doruÄak, ruÄak, veÄera), da za vas idemo u kupovinu hrane, da organizujemo pranje i peglanje veÅ¡a, da vam kupimo karte za koncert ili pozoriÅ¡nu predstavu. U dogovoru sa vama moÅ¾emo da vas saÄekamo na aerodromu, Å¾elezniÄkoj ili autobuskoj stanici ili na ulazu u Beograd i ako vam je potrebno moÅ¾emo i da vas vozimo u bilo koji deo Srbije.\r\nUkoliko Å¾elite da provedete intimno veÄe sa dragom osobom moÅ¾emo vam u dogovoru sa vama obezbediti:\r\nâ€“ Intimnu veÄeru po vaÅ¡em izboru\r\nâ€“ Dekoraciju stana (sveÄ‡e, ruÅ¾ine laticeâ€¦)\r\nâ€“ Profesionalnu masaÅ¾u\r\nâ€“ Å½ivu svirku (tamburice ili gitaru)\r\nPored svega navedenog i predloÅ¾enog u apartmanu imate joÅ¡: peglu, dasku za peglanje, fen, kablovsku TV, mini liniju, internet, plazma televizor (109 cm), toster, kompletno opremljenu kuhinju sa posuÄ‘em za 5 osoba, peÅ¡kire u koliÄini koja vam je potrebna, klima ureÄ‘aj, fiksni telefon, mobilni telefon sa srpskim brojem i gratis kreditom od 200 dinara za vreme vaÅ¡eg boravka (doplatu za telefon moÅ¾ete kupiti u bilo kojoj trafici).                ', 18, 6, 1, '', 0, 0, '2016-06-30 20:52:30', 0, '["20160630-225230335064467-tas-2_519a1354a3b5f.jpg","20160630-225230260441481-thumbs_LagunaSpaApartman03.jpg","20160630-2252302010467217-thumbs_LagunaSpaApartman04.jpg","20160630-2252302005496088-thumbs_LagunaSpaApartman05.jpg","20160630-2252301556228358-thumbs_LagunaSpaApartman06.jpg","20160630-225230241071670-thumbs_LagunaSpaApartman07.jpg","20160630-225230473252595-thumbs_wellnessspars-Laguna-foto01.jpg","20160630-22523085537809-thumbs_wellnessspars-Laguna-foto06.jpg","20160630-225230684671789-thumbs_wellnessspars-Laguna-foto08.jpg","20160630-225230263215975-wellnessspars-Dinara-foto01.jpg"]', '                        Apartman ima povrÅ¡inu od 50 m i sastoji se iz: dnevnog boravka, spavaÄ‡e sobe, kuhinje i kupatila, a u njemu moÅ¾e biti maksimalno smeÅ¡teno 5 osoba. Apartman se nalazi na Zvezdari u blizini sportskog centra â€žOlimpâ€œ koji u svom sastavu ima atletsku stazu, teninske terene, teretanu i nov moderni otvoreni bazen.                    ', 1, 3.6),
(5, ' Hotel Zelengora', '\r\n    I hotel â€œZelengoraâ€ i hotel â€œÅ umariceâ€, svaki na svoj naÄin, ispunjavaju sve zahteve i zadovoljavaju potrebe najprobirljivijih savremenih putnika. Poslovni ljudi i gosti Å¾eljni zabave i provoda, na raspolaganju imaju hotel â€œZelengoruâ€, koji se nalazi u samom srcu grada i veoma je pogodan za brzu i laku komunikaciju. S druge strane, za odrÅ¾avanje znaÄajnijih poslovnih, struÄnih i sveÄanih skupova, za pripremu sportskih klubova i reprezentacija, za opuÅ¡tanje i uÅ¾ivanje u tiÅ¡ini i umirujuÄ‡em prirodnom ambijentu, predlaÅ¾emo hotel â€œÅ umariceâ€, na tri kilometra od centra grada. \r\n\r\nOba hotela raspolaÅ¾u sa ukupno devet apartmana, 70 jednokrevetnih i 66 dvokrevetnih soba, opremljenih klima ureÄ‘ajima, televizorima, telefonima, beÅ¾iÄnim internetom, mini barovima, luksuznim kupatilima, kao i sa viÅ¡e od 1.500 mesta u restoranima, salama, kafeima. salonima i letnjim baÅ¡tama. \r\n\r\nKao Äovek Äije je profesionalno iskustvo u oblasti ugostiteljstva i hotelijerstva dugo Äetiri decenije, uveren sam da Ä‡e naÅ¡i objekti opravdati VaÅ¡a oÄekivanja. Uz brz i pouzdan servis koji pruÅ¾aju gostima, zaposleni u H.T.D. â€œÅ umariceâ€ potrudiÄ‡e se da VaÅ¡ boravak u naÅ¡im hotelima bude nezaboravan i svrsishodan. Veliki broj onih koji su se do sada uverili u naÅ¡e gostoprimstvo, a njih je viÅ¡e od milion i po, daju nam podsticaj da istrajemo u naÅ¡em lepom i poÅ¾rtvovanom poslu.     ', 18, 5, 3, '', 0, 0, '2016-07-01 22:55:16', 0, '["20160702-005516379254633-slide3.jpg"]', '        Hotel â€œZelengoraâ€ nalazi se u najuÅ¾em jezrgu Kragujevca.  \r\n\r\nDatira joÅ¡ iz pretproÅ¡log veka, od 1884. godine, kao jedan od nastarijih hotela u Srbiji. \r\n\r\nOsnovao ga je peÅ¡adijski kapetan prve klase Milovan GuÅ¡iÄ‡ (1822-1891), veliki dobrotvor i zaduÅ¾binar, koji je ostavio dubok trag u istoriji Kragujevca. Svome gradu podario je sav imetak - nekoliko objekata u kojima su danas smeÅ¡tene obrazovne i institucije kulture. S poÄetka, hotel â€œZelengoraâ€ je po osnivaÄu nosio naziv â€œGrand hotel GuÅ¡iÄ‡â€.      ', 1, 3.32432),
(6, 'SPLAV FREESTYLER', '\r\n    NeÅ¡to bliÅ¾e centru se nalaze visoka sedenja i barski stolovi, dok je u samom centru veliki centralni Å¡ank gde moÅ¾ete uÅ¾ivati u klasiÄnom lounge iskustvu ako to Å¾elite.\r\nNa splavu Freestyler se mogu sresti razliÄite generacije gostiju, a karakteristiÄan je i po tome da je jako popularan meÄ‘u strancima, pa se engleski jezik odomaÄ‡io na ovom splavu. VaÅ¾i za jedan od najpopularnijih splavova u Beogradu i na njemu se uvek traÅ¾i mesto viÅ¡e. Splav se otvara pola sata pre ponoÄ‡i, a zbog velikih guÅ¾vi na ulazu preporuÄljivo je doÄ‡i odmah po otvaranju, jer se popularni Free jako brzo puni i moÅ¾ete ostati bez rezervacije ukoliko i najmanje zakasnite.\r\nSplav Freestyler se nalazi na Savskom keju, u nizu sa ostalim popularnim beogradskim splavovima pa moÅ¾ete posetiti i splav River, splav Blaywatch, splav Sindikat i mnoge druge na ovom keju.', 6, 1, 1, '', 0, 0, '2016-07-05 00:54:54', 0, '["577b055e0264e5.00755116-13613633_1352323578115256_8642200794262586601_o.jpg"]', '    Splav Freestyler je u okviru celokupne ponude Beograda postao sinonim za prepoznatljive letnje House, Disco, HipHop, R''n''B Å¾urke i zabaviÄ‡e sve koji poÅ¾ele da se pridruÅ¾e. Splav je organizovan po prstenovima, pri Äemu je spoljaÅ¡nji prsten splava popunjen velikim brojem separea za veÄ‡a druÅ¡tva koja Å¾ele da se izdvoje.', 1, 3.625),
(30, 'HYATT', '<p>Hotel Hyatt&nbsp;<span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 16px;">Hyatt Regency Beograd je luksuzni hotel od pet zvezdica, pozicioniran u srcu Novog Beograda.</span></p>\r\n<p style="padding: 0px; margin: 15px 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 16px;">Hotel se nalazi nedaleko od centra grada u blizini kompleksa Beogradska Arena i Centra Sava &ndash; najveÄ‡ih kongresnih, kulturnih i poslovnih centara u na&scaron;oj zemlji. Udaljen je samo 15 minuta&nbsp; voÅ¾nje od AerodromaHyatt Regency Beograd je luksuzni hotel od pet zvezdica, pozicioniran u srcu Novog Beograda.</p>\r\n<p style="padding: 0px; margin: 15px 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 16px;">Hotel se nalazi nedaleko od centra grada u blizini kompleksa Beogradska Arena i Centra Sava &ndash; najveÄ‡ih kongresnih, kulturnih i poslovnih centara u na&scaron;oj zemlji. Udaljen je samo 15 minuta&nbsp; voÅ¾nje od AerodromaHyatt Regency Beograd je luksuzni hotel od pet zvezdica, pozicioniran u srcu Novog Beograda.</p>\r\n<p style="padding: 0px; margin: 15px 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 16px;">Hotel se nalazi nedaleko od centra grada u blizini kompleksa Beogradska Arena i Centra Sava &ndash; najveÄ‡ih kongresnih, kulturnih i poslovnih centara u na&scaron;oj zemlji. Udaljen je samo 15 minuta&nbsp; voÅ¾nje od AerodromaHyatt Regency Beograd je luksuzni hotel od pet zvezdica, pozicioniran u srcu Novog Beograda.</p>\r\n<p style="padding: 0px; margin: 15px 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 16px;">Hotel se nalazi nedaleko od centra grada u blizini kompleksa Beogradska Arena i Centra Sava &ndash; najveÄ‡ih kongresnih, kulturnih i poslovnih centara u na&scaron;oj zemlji. Udaljen je samo 15 minuta&nbsp; voÅ¾nje od Aerodroma</p>', 14, 5, 1, 'Milentija PopoviÄ‡a', 44.8129906, 20.43429679999997, '2016-07-24 23:59:21', 0, '["579556597581e1.74021998-1302343732hyatt-regency-belgrade-photos-facilities-hotel-information.jpeg","5795565975a463.53088714-hotel-hyatt-655x310.jpg","5795565975bbb2.62652430-main_image_activities.jpg"]', '<p style="padding: 0px; margin: 15px 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 16px;">Hyatt Regency Beograd je luksuzni hotel od pet zvezdica, pozicioniran u srcu Novog Beograda.</p>\r\n<p style="padding: 0px; margin: 15px 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 16px;">Hotel se nalazi nedaleko od centra grada u blizini kompleksa Beogradska Arena i Centra Sava &ndash; najveÄ‡ih kongresnih, kulturnih i poslovnih centara u na&scaron;oj zemlji. Udaljen je samo 15 minuta&nbsp; voÅ¾nje od Aerodroma</p>', 1, 0),
(34, 'MUZEJ "21. OKTOBAR"', '\r\n    ZidajuÄ‡i trideset kula bez prozora i vrata arhitekte Ivan AntiÄ‡ i Ivanka RaspopoviÄ‡ imali su nameru da pokaÅ¾u bezizlaznost nenaoruÅ¾anih graÄ‘ana ispred mitraljeskih cevi. Crvena cigla asocira na prolivenu krv, trideset tri kupole â€“ trideset masovnih grobnica u Spomen parku i tri u obliÅ¾njim naseljima, a providne piramide od pleksiglasa na njihovim vrhovima predstavljaju poslednji pogled Å¾rtava uperen ka nebu. Osnova muzeja je uraÄ‘ena u obliku krsta, opÅ¡tehriÅ¡Ä‡anskog simbola stradanja.\r\nU muzeju se Äuvaju potresni dokumenti vezani za 21. oktobar 1941. godine od kojih su najtragiÄnije poruke streljanih graÄ‘ana napisane u poslednjim trenucima Å¾ivota, dokumenti i fotografije naÄ‘ene kod njih. Od umetniÄkih dela u muzeju istiÄe se ciklus od 27 slika Petra Lubarde pod nazivom "Dosta krvi, dosta ubijanja". Ispred zgrade Muzeja, na travnjaku, i ispred njegovog ulaza nalaze se dve skulpture od bronze, poklon novosadskog vajara Jovana SoldatoviÄ‡a Kragujevcu: SuÄ‘aje i ÄŒovek bez iluzija.\r\n', 14, 4, 3, 'bb', 44.021353, 20.894359899999927, '2016-07-26 00:01:41', 0, '["5796a8658787e6.52160556-13194645803768_muzej_21_oktobar_za_sajt1.jpg","5796a86587a892.70901107-images.jpg","5796a86587c0d3.52950553-kragujevac-5.jpg"]', '    Na ulazu u Spomen park podignuta je impozantna zgrada Muzeja "21. oktobar" u Äijoj je arhitekturi naglaÅ¡ena simbolika kragujevaÄke tragedije.', 1, 0),
(35, 'Casa Nova', '\r\n    Pri ureÄ‘enju enterijera restorana aktivno je uÄesvovao i sam vlasnik restorana tako da se vodilo raÄuna o najsitnijim detaljima, vinoteka od kovanog gvoÅ¾Ä‘a, oslikani zidovi, mala galerija sa nekoliko stolova, diskretno svetlo kuÄ‡ne lampe, udobne stolice, tako da boravak bude Å¡to prijatniji.BaÅ¡ta restorana pruÅ¾a sve moguÄ‡nosti za prijatan boravak i opuÅ¡tanje u toku i posle radnog dana, ali i za osveÅ¾enje svima koji su se odluÄili da provedu dan razgledajuÄ‡i znamenitosti Beograda.\r\n\r\nU ponudi su salate, paste, biftek, piletina, Ä‡uretina,â€¦ po receptima italijanske i francuske kuhinje. Ali, ovde moÅ¾ete pojesti i odliÄno pripremljene plodove mora i nekoliko vrsta ribe.\r\n\r\nCasa Nova se Å¾eli pohvaliti specijalitetom KuÄ‡e. To je "Sicilijanski toÄak". Kao podlogu ima tortilju, preko nje povrÄ‡e spremljeno na puteru i belom vinu, a odozgo biftek ili piletina (po Å¾elji). Jos jedan biftek Å¾eli doÄ‡i do izraÅ¾aja - "Biftek u sosu od gorgonzole", a odmah tu je i "Peper stek" - biftek u sosu od zelenog bibera.Testenine, sirevi i sosevi, od kojih je "Sos sa 4 vrste sira" - najbolji u gradu!\r\n\r\nZa aperitiv nude se domace rakije, Dunja, Kajsija, Å ljiva i Malina, a vinska karta sadrÅ¾i veliki izbor domaÄ‡ih, italijanskih,francuskih, argentinskih, Äileanskih i australijskih vina.\r\n\r\nTiramisu, profiterole, Äokoladni sufle i Äokoladni mus... Ako zelite da probate najfilovanije, najbogatije i najneobiÄnije palaÄinke u gradu, naruÄite punjene palaÄinke sa flambiranim jabukama na rumu, pinjolima, suvim groÅ¾Ä‘em, preko kojih se preliva karamel sos, Äokolada i sladoled od vanile!\r\n\r\nEros Ramazzotti, Laura Pausini... lagani italijanski zvuci, neprimetno ce dopirati do Vas i uÄiniti VaÅ¡e vreme jos prijatnijim. Na vama je da se prepustite ljubaznom osoblju, Äije Ä‡e vas preporuke odvesti na uzbudljivo gastronomsko putovanje.', 14, 8, 1, 'Ð“Ð¾ÑÐ¿Ð¾Ð´Ð°Ñ€ ÐˆÐ¾Ð²Ð°Ð½Ð¾Ð²Ð°', 44.82009799999999, 20.462066999999934, '2016-07-26 00:18:25', 0, '["5796ac51d95e00.90819592-restoran-casa-nova-1c.jpg","5796ac51d97d45.95057613-restoran-casa-nova-08.jpg"]', '    U samom centru Beograda, na DorÄ‡olu, u starom gradskom kraju poznatom po svom multikulturalnom ambijentu, nalazi se restoran italijansko-francuske kuhinje Casa Nova.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating_posts`
--

CREATE TABLE `rating_posts` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rating_post` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_posts`
--

INSERT INTO `rating_posts` (`id`, `post_id`, `rating_post`, `date`, `user_id`) VALUES
(1, 3, 4, '2016-07-09 22:50:21', 8),
(2, 4, 4, '2016-07-09 22:50:29', 8),
(3, 5, 2, '2016-07-09 22:50:42', 8),
(4, 3, 5, '2016-07-09 22:51:51', 3),
(5, 4, 3, '2016-07-09 22:52:04', 3),
(6, 6, 2, '2016-07-09 22:52:28', 3),
(7, 6, 3, '2016-07-09 22:52:54', 6),
(8, 5, 4, '2016-07-09 22:53:03', 6),
(9, 4, 4, '2016-07-09 22:53:32', 6),
(10, 3, 5, '2016-07-09 22:53:39', 6),
(11, 3, 4, '2016-07-10 03:49:49', 7),
(12, 4, 2, '2016-07-10 03:49:58', 7),
(13, 6, 4, '2016-07-10 11:55:10', 3),
(14, 6, 4, '2016-07-10 11:55:16', 3),
(15, 6, 4, '2016-07-10 11:56:13', 3),
(16, 6, 4, '2016-07-10 11:56:59', 3),
(17, 5, 1, '2016-07-10 11:57:01', 3),
(18, 3, 5, '2016-07-10 11:57:06', 3),
(19, 4, 1, '2016-07-10 11:57:08', 3),
(20, 4, 1, '2016-07-10 11:57:09', 3),
(21, 4, 1, '2016-07-10 11:57:09', 3),
(22, 4, 1, '2016-07-10 11:57:10', 3),
(23, 4, 1, '2016-07-10 11:57:11', 3),
(24, 4, 1, '2016-07-10 11:57:11', 3),
(25, 4, 1, '2016-07-10 11:57:11', 3),
(26, 4, 1, '2016-07-10 11:57:11', 3),
(27, 4, 1, '2016-07-10 11:57:11', 3),
(28, 4, 1, '2016-07-10 11:57:12', 3),
(29, 4, 1, '2016-07-10 11:57:12', 3),
(30, 4, 1, '2016-07-10 11:57:12', 3),
(31, 4, 1, '2016-07-10 11:57:12', 3),
(32, 4, 1, '2016-07-10 11:57:12', 3),
(33, 4, 1, '2016-07-10 11:57:12', 3),
(34, 4, 1, '2016-07-10 11:57:13', 3),
(35, 4, 1, '2016-07-10 11:57:13', 3),
(36, 4, 1, '2016-07-10 11:57:13', 3),
(37, 4, 1, '2016-07-10 11:57:13', 3),
(38, 4, 1, '2016-07-10 11:57:13', 3),
(39, 4, 1, '2016-07-10 11:57:14', 3),
(40, 4, 1, '2016-07-10 11:57:14', 3),
(41, 4, 1, '2016-07-10 11:57:14', 3),
(42, 4, 1, '2016-07-10 11:57:14', 3),
(43, 4, 1, '2016-07-10 11:57:14', 3),
(44, 4, 1, '2016-07-10 11:57:15', 3),
(45, 4, 1, '2016-07-10 11:57:15', 3),
(46, 4, 1, '2016-07-10 11:57:15', 3),
(47, 4, 1, '2016-07-10 11:57:15', 3),
(48, 4, 1, '2016-07-10 11:57:15', 3),
(49, 4, 1, '2016-07-10 11:57:15', 3),
(50, 4, 1, '2016-07-10 11:57:16', 3),
(51, 4, 1, '2016-07-10 11:57:16', 3),
(52, 4, 1, '2016-07-10 11:57:16', 3),
(53, 4, 1, '2016-07-10 11:57:16', 3),
(54, 4, 1, '2016-07-10 11:57:17', 3),
(55, 4, 5, '2016-07-10 11:57:17', 3),
(56, 4, 5, '2016-07-10 11:57:17', 3),
(57, 4, 5, '2016-07-10 11:57:18', 3),
(58, 4, 5, '2016-07-10 11:57:18', 3),
(59, 4, 5, '2016-07-10 11:57:18', 3),
(60, 4, 5, '2016-07-10 11:57:18', 3),
(61, 4, 5, '2016-07-10 11:57:18', 3),
(62, 4, 5, '2016-07-10 11:57:18', 3),
(63, 4, 5, '2016-07-10 11:57:19', 3),
(64, 4, 5, '2016-07-10 11:57:19', 3),
(65, 4, 5, '2016-07-10 11:57:19', 3),
(66, 4, 5, '2016-07-10 11:57:19', 3),
(67, 4, 5, '2016-07-10 11:57:19', 3),
(68, 4, 5, '2016-07-10 11:57:19', 3),
(69, 4, 5, '2016-07-10 11:57:20', 3),
(70, 4, 5, '2016-07-10 11:57:20', 3),
(71, 4, 5, '2016-07-10 11:57:20', 3),
(72, 4, 5, '2016-07-10 11:57:20', 3),
(73, 4, 5, '2016-07-10 11:57:20', 3),
(74, 4, 5, '2016-07-10 11:57:20', 3),
(75, 4, 5, '2016-07-10 11:57:21', 3),
(76, 4, 5, '2016-07-10 11:57:21', 3),
(77, 4, 5, '2016-07-10 11:57:21', 3),
(78, 4, 5, '2016-07-10 11:57:21', 3),
(79, 4, 5, '2016-07-10 11:57:21', 3),
(80, 3, 4, '2016-07-10 12:09:21', 3),
(81, 3, 4, '2016-07-10 12:09:51', 3),
(82, 3, 4, '2016-07-10 12:10:08', 3),
(83, 3, 4, '2016-07-10 12:10:51', 3),
(84, 6, 3, '2016-07-10 12:45:39', 3),
(85, 5, 5, '2016-07-10 12:46:21', 3),
(86, 5, 5, '2016-07-10 12:46:22', 3),
(87, 5, 5, '2016-07-10 12:46:22', 3),
(88, 5, 5, '2016-07-10 12:46:23', 3),
(89, 5, 5, '2016-07-10 12:46:23', 3),
(90, 5, 5, '2016-07-10 12:46:23', 3),
(91, 5, 5, '2016-07-10 12:46:24', 3),
(92, 5, 5, '2016-07-10 12:46:25', 3),
(93, 5, 5, '2016-07-10 12:46:25', 3),
(94, 5, 4, '2016-07-10 12:46:26', 3),
(95, 5, 3, '2016-07-10 12:46:26', 3),
(96, 5, 3, '2016-07-10 12:46:27', 3),
(97, 5, 3, '2016-07-10 12:46:27', 3),
(98, 5, 3, '2016-07-10 12:46:27', 3),
(99, 5, 3, '2016-07-10 12:46:27', 3),
(100, 5, 3, '2016-07-10 12:46:28', 3),
(101, 5, 3, '2016-07-10 12:46:28', 3),
(102, 5, 3, '2016-07-10 12:46:28', 3),
(103, 5, 3, '2016-07-10 12:46:28', 3),
(104, 5, 3, '2016-07-10 12:46:29', 3),
(105, 5, 3, '2016-07-10 12:46:29', 3),
(106, 5, 3, '2016-07-10 12:46:29', 3),
(107, 5, 3, '2016-07-10 12:46:29', 3),
(108, 5, 3, '2016-07-10 12:46:29', 3),
(109, 5, 3, '2016-07-10 12:46:29', 3),
(110, 5, 3, '2016-07-10 12:46:30', 3),
(111, 5, 3, '2016-07-10 12:46:30', 3),
(112, 5, 2, '2016-07-10 12:46:31', 3),
(113, 5, 2, '2016-07-10 12:46:31', 3),
(114, 5, 2, '2016-07-10 12:46:31', 3),
(115, 5, 2, '2016-07-10 12:46:32', 3),
(116, 5, 2, '2016-07-10 12:46:32', 3),
(117, 5, 2, '2016-07-10 12:46:32', 3),
(118, 3, 2, '2016-07-10 13:04:26', 3),
(119, 3, 2, '2016-07-10 13:04:27', 3),
(120, 3, 3, '2016-07-10 13:04:29', 3),
(121, 3, 2, '2016-07-10 13:04:32', 3),
(122, 3, 4, '2016-07-10 13:04:36', 3),
(123, 4, 2, '2016-07-10 13:04:41', 3),
(124, 4, 2, '2016-07-10 13:04:43', 3),
(125, 4, 2, '2016-07-10 13:04:44', 3),
(126, 4, 1, '2016-07-10 13:04:45', 3),
(127, 4, 1, '2016-07-10 13:04:46', 3),
(128, 4, 1, '2016-07-10 13:04:46', 3),
(129, 4, 1, '2016-07-10 13:04:46', 3),
(130, 4, 1, '2016-07-10 13:04:47', 3),
(131, 4, 1, '2016-07-10 13:04:47', 3),
(132, 4, 1, '2016-07-10 13:04:47', 3),
(133, 4, 1, '2016-07-10 13:04:47', 3),
(134, 4, 1, '2016-07-10 13:04:47', 3),
(135, 9, 3, '2016-07-13 17:47:25', 3),
(136, 11, 2, '2016-07-16 01:48:35', 3),
(137, 27, 2, '2016-07-17 04:20:40', 14),
(138, 4, 4, '2016-07-19 13:20:32', 14),
(139, 6, 5, '2016-07-19 13:20:35', 14),
(140, 11, 4, '2016-07-19 13:20:37', 14),
(141, 5, 4, '2016-07-20 18:53:39', 14),
(142, 3, 2, '2016-07-23 19:09:44', 14);

-- --------------------------------------------------------

--
-- Table structure for table `site_messages`
--

CREATE TABLE `site_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_messages`
--

INSERT INTO `site_messages` (`id`, `name`, `email`, `title`, `content`, `date`) VALUES
(1, 'Marija Jeremic', 'makita.marija@gmail.com', 'Prva poruka', 'Proba', '2016-07-21 21:35:30'),
(2, 'Marija Jeremic', 'makita.marija@gmail.com', 'Prva poruka', 'Proba samo...', '2016-07-21 21:36:59'),
(3, 'Marija Jeremic', 'makita.marija@gmail.com', 'Test proba', 'Samo probamo...', '2016-07-21 21:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_logged` tinyint(4) NOT NULL DEFAULT '0',
  `superadmin` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `is_blocked` tinyint(4) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `date`, `admin`, `status`, `is_logged`, `superadmin`, `is_deleted`, `is_blocked`, `image`) VALUES
(4, 'Marija', 'maki@gmail.com', '11111', '2016-06-26 23:42:10', 0, 1, 0, 0, 0, 1, ''),
(6, 'Aleksandar', 'coa@mail.com', '22222', '2016-06-27 23:51:40', 1, 0, 0, 0, 0, 0, ''),
(7, 'Sofija', 'sofi@mail.com', '33333', '2016-06-27 23:52:09', 0, 1, 0, 0, 0, 1, ''),
(8, 'Katarina', 'kaca@mail.com', '12345', '2016-06-28 21:24:56', 0, 0, 0, 0, 0, 0, ''),
(9, 'Marija Jeremic', 'marija@gmail.com', '1106985', '2016-06-28 21:42:27', 0, 0, 0, 0, 0, 0, ''),
(10, 'Marijana', 'marijana.beograd@gmail.com', '123456', '2016-07-04 12:22:43', 1, 0, 0, 0, 0, 0, '13576742_1050457941729123_3741470182751994445_o.jpg'),
(11, 'Aleksandar Zivanovic', 'coapsyfactor@gmail.com', 'Test123', '2016-07-07 09:43:53', 1, 0, 0, 0, 0, 0, 'most-na-adi-u-beogradu.jpg'),
(12, 'Maja', 'makita@mail.com', 'c5fe25896e49ddfe996db7508cf00534', '2016-07-17 00:29:01', 0, 0, 0, 0, 0, 0, '5.png'),
(14, 'Marija', 'makita.marija@gmail.com', '0ac1130f4080a02d5a3d8cb0c7fc5bb7', '2016-07-17 00:58:29', 1, 0, 1, 1, 0, 0, 'P9090026.JPG'),
(15, 'Daca', 'daca@mail.com', '1fd91f3edcd0edd098614e9e72e1d7e4', '2016-07-17 01:48:32', 0, 0, 1, 0, 0, 0, 'img.jpg'),
(17, 'Aca', 'aca@mail.com', '1fd91f3edcd0edd098614e9e72e1d7e4', '2016-07-17 01:52:20', 0, 0, 0, 0, 0, 0, 'img.jpg'),
(18, 'Ana', 'ana@mail.com', '1fd91f3edcd0edd098614e9e72e1d7e4', '2016-07-17 01:53:38', 0, 0, 1, 0, 0, 0, 'php-development.gif'),
(19, 'Sanja', 'sanja@mail.com', '1fd91f3edcd0edd098614e9e72e1d7e4', '2016-07-17 02:00:01', 0, 0, 0, 0, 0, 0, '9.jpg'),
(20, 'Coa Car', 'coajecarina@najbolji.sam', 'f228ebdcd6672bb92199671957ebcb6a', '2016-07-19 20:06:32', 0, 0, 0, 0, 0, 0, 'img.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `rating_posts`
--
ALTER TABLE `rating_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_messages`
--
ALTER TABLE `site_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `rating_posts`
--
ALTER TABLE `rating_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `site_messages`
--
ALTER TABLE `site_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
