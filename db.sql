<<<<<<< HEAD
-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2011 at 12:32 AM
-- Server version: 5.0.90
-- PHP Version: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demos4clients_com_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `memeje__allotpoints`
--

DROP TABLE IF EXISTS `memeje__allotpoints`;
CREATE TABLE IF NOT EXISTS `memeje__allotpoints` (
  `id_allot` int(11) NOT NULL auto_increment,
  `point_type` varchar(50) collate utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY  (`id_allot`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `memeje__allotpoints`
--

INSERT INTO `memeje__allotpoints` (`id_allot`, `point_type`, `points`) VALUES
(1, 'meme_insert', 10),
(2, 'answer_to_meme', 10),
(3, 'insert_caption', 10),
(4, 'honour', 1);

-- --------------------------------------------------------

--
-- Table structure for table `memeje__badge`
--

DROP TABLE IF EXISTS `memeje__badge`;
CREATE TABLE IF NOT EXISTS `memeje__badge` (
  `id_badge` int(10) NOT NULL auto_increment,
  `image_badge` varchar(200) collate utf8_unicode_ci default NULL,
  `title_badge` varchar(50) collate utf8_unicode_ci NOT NULL,
  `desc_badge` text collate utf8_unicode_ci,
  `expr_point` int(10) NOT NULL,
  `badge_type` varchar(20) collate utf8_unicode_ci NOT NULL,
  `badge_type_number` int(10) NOT NULL,
  `glory_badge_point` int(10) NOT NULL,
  `is_glory_badge` int(1) NOT NULL,
  `ip` varchar(16) collate utf8_unicode_ci NOT NULL,
  `start` varchar(10) collate utf8_unicode_ci NOT NULL default '0',
  `end` varchar(10) collate utf8_unicode_ci NOT NULL default '0',
  `add_date` datetime default NULL,
  PRIMARY KEY  (`id_badge`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `memeje__badge`
--

INSERT INTO `memeje__badge` (`id_badge`, `image_badge`, `title_badge`, `desc_badge`, `expr_point`, `badge_type`, `badge_type_number`, `glory_badge_point`, `is_glory_badge`, `ip`, `start`, `end`, `add_date`) VALUES
(1, 'Afixi_54.jpg', 'Congratch!! You have crossed 100 experience point.', 'This achievement can be achieved after getting 100 experience points.', 0, 'exp_point', 100, 0, 0, '117.197.233.105', '0', '0', '2011-07-16 07:28:28'),
(2, 'Afixi_55.jpg', 'You have crossed 200 experience points.', 'After getting 200 experience points you will get this achievement.And Experience point can be won by posting meme ,replying meme,suggesting caption,etc.', 0, 'exp_point', 200, 0, 0, '117.197.233.105', '0', '0', '2011-07-16 07:30:00'),
(3, 'Afixi_51.jpg', '100 duels won', 'This achievement can be achieved after wining 100 duels.', 0, 'duels_won', 100, 0, 0, '117.197.233.105', '0', '0', '2011-07-16 07:31:56'),
(4, 'Afixi_50.jpg', '100 times question of the week won.', 'This achievement can be achieved after getting 100 times question of the week won.', 0, 'ques_week_won', 100, 0, 0, '117.197.233.105', '0', '0', '2011-07-16 07:32:53'),
(5, 'Afixi_56.jpg', 'Crossing 400 Exp  Points', 'This achievement can be got if your answer of the question is choosen liked most and getting this you also gain some points.', 0, 'exp_point', 400, 0, 0, '117.197.233.105', '0', '0', '2011-07-16 07:33:51'),
(6, 'Afixi_57.jpeg', 'Crossing 888 overall Replies.', 'This achievement can be won after replying over 888.', 0, 'reply', 888, 0, 0, '117.197.233.105', '0', '0', '2011-08-18 04:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__caption`
--

DROP TABLE IF EXISTS `memeje__caption`;
CREATE TABLE IF NOT EXISTS `memeje__caption` (
  `id_caption` int(11) NOT NULL auto_increment,
  `id_meme` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_live` tinyint(2) NOT NULL default '1',
  `caption` text collate utf8_unicode_ci NOT NULL,
  `tot_honour` int(11) NOT NULL default '0',
  `honour_id_user` text collate utf8_unicode_ci NOT NULL,
  `tot_dishonour` int(11) NOT NULL default '0',
  `dishonour_id_u` text collate utf8_unicode_ci NOT NULL,
  `user_status` tinyint(2) NOT NULL,
  `add_date` datetime NOT NULL,
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_caption`),
  KEY `id_meme` (`id_meme`,`id_user`),
  KEY `user_status` (`user_status`),
  KEY `is_live` (`is_live`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `memeje__caption`
--

INSERT INTO `memeje__caption` (`id_caption`, `id_meme`, `id_user`, `is_live`, `caption`, `tot_honour`, `honour_id_user`, `tot_dishonour`, `dishonour_id_u`, `user_status`, `add_date`, `ip`) VALUES
(1, 17, 2, 1, 'its my uncle', 1, '2', 0, '', 0, '2011-08-20 02:49:52', '117.201.160.57'),
(2, 17, 2, 1, 'No its my frnd', 2, '2,4', 0, '', 0, '2011-08-20 02:50:40', '117.201.160.57'),
(3, 4, 2, 1, 'Its madona!!', 1, '2', 0, '', 0, '2011-08-20 03:37:23', '117.201.160.57'),
(4, 24, 3, 1, 'hhhhhhhhhhhhhiiiiiiiiiiiiiiiiiiiii', 0, '', 0, '', 0, '2011-08-20 07:22:10', '117.201.160.57'),
(5, 24, 3, 1, 'hiiiiiiiiii', 0, '', 0, '', 0, '2011-08-20 07:22:52', '117.201.160.57'),
(6, 26, 35, 1, 'YAY thanks pati', 1, '35', 0, '', 0, '2011-08-20 17:40:21', '198.94.221.87'),
(7, 26, 35, 1, 'what the what!', 0, '', 0, '', 0, '2011-08-20 17:46:10', '198.94.221.87'),
(8, 29, 2, 1, 'Best Caption Test', 0, '', 0, '', 0, '2011-08-20 17:57:13', '76.230.233.90'),
(9, 29, 2, 1, 'Best Caption Test 2', 1, '2', 0, '', 0, '2011-08-20 17:57:25', '76.230.233.90'),
(10, 29, 36, 1, 'caption', 0, '', 0, '', 0, '2011-08-20 19:09:21', '108.205.200.122'),
(11, 31, 35, 1, 'this is a caption', 0, '', 0, '', 0, '2011-08-20 19:12:54', '108.205.200.122'),
(12, 34, 2, 1, 'hello', 0, '', 0, '', 0, '2011-08-21 20:54:55', '117.197.233.113'),
(13, 20, 2, 1, 'Hi its test.', 1, '2', 0, '', 0, '2011-08-23 02:26:41', '117.197.253.54'),
(14, 20, 2, 1, 'dasdfsdsfs', 2, '2,34', 0, '', 0, '2011-08-23 02:26:50', '117.197.253.54'),
(15, 42, 2, 1, 'Hi', 1, '2', 0, '', 0, '2011-08-23 02:31:08', '117.197.253.54'),
(16, 42, 2, 1, 'dfd', 2, '2,4', 0, '', 0, '2011-08-23 02:31:25', '117.197.253.54'),
(17, 41, 4, 1, 'dfgkjdfgkjl', 2, '4,3', 0, '', 0, '2011-08-23 03:03:25', '117.197.253.54'),
(18, 41, 4, 1, 'asdasdasdasd', 2, '4,3', 0, '', 0, '2011-08-23 03:03:40', '117.197.253.54'),
(19, 21, 10, 1, 'Hi this for testing purpose', 1, '10', 0, '', 0, '2011-08-23 21:37:56', '117.201.160.173'),
(20, 20, 10, 1, 'jhkjyhh', 0, '', 0, '', 0, '2011-08-23 21:43:58', '117.201.160.173'),
(21, 20, 34, 1, 'Hello testing', 0, '', 0, '', 0, '2011-08-24 06:32:15', '117.197.236.115'),
(22, 21, 3, 1, 'This one is for testing', 0, '', 0, '', 0, '2011-08-24 06:32:49', '117.197.236.115'),
(23, 44, 34, 1, 'For testing purpose', 0, '', 0, '', 0, '2011-08-24 06:35:06', '117.197.236.115'),
(24, 44, 10, 1, 'Hi this for testing purpose', 0, '', 0, '', 0, '2011-08-24 06:35:37', '117.197.236.115'),
(25, 44, 10, 1, 'This again for testing', 1, '3', 0, '', 0, '2011-08-24 06:36:04', '117.197.236.115'),
(26, 44, 3, 1, 'Testingggg', 1, '3', 0, '', 0, '2011-08-24 06:36:51', '117.197.236.115'),
(27, 36, 2, 1, 'asda asdasd', 0, '', 0, '', 0, '2011-08-24 06:40:30', '117.197.236.115'),
(28, 36, 2, 1, 'sdfsdsd', 0, '', 0, '', 0, '2011-08-24 06:41:56', '117.197.236.115'),
(29, 43, 10, 1, 'For testing', 0, '', 0, '', 0, '2011-08-24 06:45:54', '117.197.236.115'),
(30, 43, 3, 1, 'Testing Add caption', 0, '', 0, '', 0, '2011-08-24 06:46:31', '117.197.236.115'),
(31, 43, 34, 1, 'Testing Add Caption--1', 1, '34', 0, '', 0, '2011-08-24 06:49:07', '117.197.239.207'),
(32, 90, 30, 1, 'test', 1, '30', 0, '', 0, '2011-09-02 07:25:59', '117.201.165.160'),
(33, 90, 30, 1, 'hello', 0, '', 0, '', 0, '2011-09-02 07:43:46', '117.201.165.160'),
(34, 38, 34, 1, 'This for testing', 0, '', 0, '', 0, '2011-09-03 00:47:44', '117.201.148.167'),
(35, 87, 36, 1, 'derp', 1, '36', 0, '', 0, '2011-09-04 13:16:53', '67.160.197.181');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__config`
--

DROP TABLE IF EXISTS `memeje__config`;
CREATE TABLE IF NOT EXISTS `memeje__config` (
  `id_config` int(11) NOT NULL auto_increment,
  `name` varchar(100) character set latin1 NOT NULL default '',
  `ckey` varchar(100) character set latin1 NOT NULL default '',
  `value` varchar(255) character set latin1 NOT NULL default '',
  `f_type` varchar(20) character set latin1 NOT NULL default '',
  `f_key` text character set latin1,
  `f_value` text character set latin1,
  `is_editable` tinyint(4) NOT NULL default '1',
  `comment` text character set latin1,
  `id_seq` int(11) default '0',
  PRIMARY KEY  (`id_config`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=241 ;

--
-- Dumping data for table `memeje__config`
--

INSERT INTO `memeje__config` (`id_config`, `name`, `ckey`, `value`, `f_type`, `f_key`, `f_value`, `is_editable`, `comment`, `id_seq`) VALUES
(62, 'GENDER', 'M', 'Male', 'text', '', '', 0, '', 0),
(63, 'GENDER', 'F', 'Female', 'text', '', '', 0, '', 0),
(71, 'IMAGE', 'image_orig', 'image/orig/', 'text', '', '', 0, '', 0),
(72, 'IMAGE', 'image_thumb', 'image/thumb/', 'text', '', '', 0, '', 0),
(73, 'IMAGE', 'image_prev', 'image/prev/', 'text', '', '', 0, '', 0),
(74, 'IMAGE', 'preview_orig', 'preview/orig/', 'text', '', '', 0, '', 0),
(75, 'IMAGE', 'preview_thumb', 'preview/thumb/', 'text', '', '', 0, '', 0),
(84, 'LANGUAGE', 'English', 'en', 'text', '', '', 0, '', 0),
(90, 'IMAGE', 'thumb_width', '100', 'text', '', '', 0, '', 2),
(91, 'IMAGE', 'thumb_height', '100', 'text', '', '', 0, '', 1),
(92, 'ADMIN_THEME', 'css', 'blue', 'dropdown', 'red,blue,black,brown,purple,green,orange', 'red,blue,black,brown,purple,green,orange', 0, 'Please choose red,blue,black,brown,purple,green,orange.', 1),
(93, 'AUDIT', 'status', '1', 'radio', '1,0', 'Enabled,Disabled', 0, '', 1),
(101, 'SITE_ADMIN', 'email', 'afixi.upendra@gmail.com', 'text', '', '', 1, '', 1),
(102, 'SITE_ADMIN', 'admin_email', 'admin_email', 'text', '', '', 0, '', 2),
(104, 'CONTENT_IMAGES', 'image_width', '800', 'text', '', '', 0, '', 2),
(105, 'CONTENT_IMAGES', 'image_height', '450', 'text', '', '', 0, '', 1),
(106, 'CONTENT_IMAGES', 'content_orig', '/var/www/html/waf_res/logo/images/', 'text', '', '', 0, '', 1),
(107, 'CONTENT_IMAGES', 'orig_url', 'waf_res/waf_content/orig/', 'text', '', '', 0, '', 2),
(108, 'CONTENT_IMAGES', 'image_display', '/waf_content/images/', 'text', '', '', 0, '', 4),
(109, 'CONTENT_IMAGES', 'company_logo', '/var/www/html/waf_res/logo/thumb/', 'text', '', '', 0, '', 3),
(110, 'PAGINATE', 'rec_per_page', '10', 'text', '', '', 1, '', 2),
(111, 'PAGINATE', 'show_page', '5', 'text', '', '', 1, '', 1),
(114, 'PAGINATE_ADMIN', 'rec_per_page', '20', '', '', '', 1, '', 2),
(115, 'PAGINATE_ADMIN', 'show_page', '5', '', '', '', 1, '', 1),
(116, 'USER_TYPE', '1', 'Admin', 'text', '', '', 0, '', 0),
(117, 'USER_TYPE', '2', 'Director', 'text', '', '', 0, '', 0),
(118, 'USER_TYPE', '3', 'Account Specifier', 'text', '', '', 0, '', 0),
(119, 'USER_TYPE', '4', 'Account', 'text', '', '', 0, '', 0),
(120, 'USER_TYPE', '99', 'Developer', 'text', '', '', 0, '', 0),
(125, 'MULTI_LANG', 'islang', '1', 'text', '', '', 0, 'Set 0 to disable and 1 to enable\n', 0),
(136, 'PAYPAL', 'business', 'afixi._1312949792_biz@gmail.com', 'text', '', '', 0, 'Set your paypal business account.', 2),
(137, 'PAYPAL', 'paypal_mode', 'sandbox', 'radio', 'sandbox,live', 'Sandbox,Live', 0, 'You can set your paypal mode.', 1),
(138, 'IMAGE_HANDLER', 'library', 'gd', 'text', NULL, NULL, 1, 'im: for image magick\ngd : to use GD library', 1),
(140, 'FORGOT_PASSWORD', 'password_type', '0', 'radio', '1,0', 'encripted,normal', 0, 'Choose encrypted to store your password in encryption format otherwise normal.', 1),
(144, 'AA', 'text test', 'testvalue', 'text', '', '', 0, 'testvalue', 2),
(146, 'AA', 'radio test', '0', 'radio', '0,1', 'a,b', 0, 'radio1', 4),
(147, 'AA', 'check test', '1,2', 'checkbox', '0,1,2', 'cricket,football,chess', 0, 'hobbies', 5),
(148, 'AA', 'drop down', '2', 'dropdown', '1,2,3,4', 'programmer,tester,designer,ui expert', 0, 'drop down', 6),
(167, 'PAYPALPRO', 'API_USERNAME', 'afixi._1312949792_biz_api1.gmail.com', 'text', NULL, NULL, 1, 'API user: The user that is identified as making the call. you can also use your own API username that you created on PayPal’s sandbox or the PayPal live site.', 9),
(168, 'PAYPALPRO', 'API_PASSWORD', '1312949831', 'text', NULL, NULL, 1, 'API_password: The password associated with the API user.If you are using your own API username, enter the API password that was generated by PayPal below.', 10),
(169, 'PAYPALPRO', 'API_SIGNATURE', 'A-3Q72jBWlHzhKLpPce-5g.i25pgAN0ZF.RKm0Fh4Z5x.gqzIwkPKWlt', 'text', NULL, NULL, 1, 'API_Signature:The Signature associated with the API user. which is generated by paypal.', 11),
(171, 'PAYPALPRO', 'USE_PROXY', 'FALSE,USE_PROXY: Set this variable to TRUE to route all the API requests through proxy.', 'text', NULL, NULL, 1, 'USE_PROXY: Set this variable to TRUE to route all the API requests through proxy.', 12),
(172, 'PAYPALPRO', 'PROXY_HOST', '127.0.0.1,PROXY_HOST: Set the host name or the IP address of proxy server.', 'text', NULL, NULL, 1, 'PROXY_HOST: Set the host name or the IP address of proxy server.', 13),
(173, 'PAYPALPRO', 'PROXY_PORT', '808,PROXY_PORT: Set proxy port.NOTE : PROXY_HOST and PROXY_PORT will be read only if USE_PROXY is set to TRUE.', 'text', NULL, NULL, 1, 'PROXY_PORT: Set proxy port.NOTE : PROXY_HOST and PROXY_PORT will be read only if USE_PROXY is set to TRUE.', 14),
(175, 'PAYPALPRO', 'VERSION', '58.0,Version: this is the API version in the request.It is a mandatory parameter for each API request.', 'text', NULL, NULL, 1, 'Version: this is the API version in the request.It is a mandatory parameter for each API request.', 15),
(176, 'PAYPALPRO', 'paypal_mode', '', 'radio', 'sandbox,live', 'Sandbox,Live', 1, 'Setting of paypal mode fro transaction.For testing select Sandbox and for production set it to Live.', 1),
(177, 'PAYPALPRO', 'currency_code', 'USD', 'dropdown', 'USD,AUD', 'USD,AUD', 1, 'Currency code for Paypal.', 2),
(178, 'PAYPALPRO', 'paymentaction', 'Sale,This is to be set for instant payment through credit card.(Other values are Authorization and Order)', 'text', NULL, NULL, 1, 'This is to be set for instant payment through credit card.(Other values are Authorization and Order)', 3),
(179, 'PAYPALPRO', 'maxfailedpayments', '1,The number of scheduled payments that can fail before the profile is automatically suspended.', 'text', NULL, NULL, 1, 'The number of scheduled payments that can fail before the profile is automatically suspended.', 6),
(180, 'PAYPALPRO', 'billingfrequency', '1,Number of billing periods that make up one billing cycle.', 'text', NULL, NULL, 1, 'Number of billing periods that make up one billing cycle.', 4),
(181, 'PAYPALPRO', 'totalbillingcycle', '6,The number of billing cycles for payment period.', 'text', NULL, NULL, 1, 'The number of billing cycles for payment period.', 5),
(182, 'PAYPALPRO', 'initamt', '0,Initial non-recurring payment amount due immediately upon profile creation.', 'text', NULL, NULL, 1, 'Initial non-recurring payment amount due immediately upon profile creation.', 8),
(183, 'PAYPALPRO', 'description', 'Your recurring payment description,Description about transaction.', 'text', NULL, NULL, 1, 'Description about transaction.', 7),
(184, 'CATEGORY', '1', 'Funny', 'text', NULL, NULL, 1, '', 0),
(185, 'CATEGORY', '2', 'Love', 'text', NULL, NULL, 1, NULL, 0),
(186, 'CATEGORY', '3', 'Trees', 'text', NULL, NULL, 1, NULL, 0),
(187, 'CATEGORY', '4', 'Everyday', 'text', NULL, NULL, 1, NULL, 0),
(188, 'IMAGE', 'premade_image', 'image/orig/premade_images/', 'text', NULL, NULL, 0, '', 0),
(189, 'IMAGE', 'avtar_orig', 'image/orig/avatar/', 'text', NULL, NULL, 0, '', 0),
(190, 'IMAGE', 'avtar_thumb', 'image/thumb/avatar/', 'text', NULL, NULL, 0, '', 0),
(191, 'LIVEFEED_COLOR', 'reply', '#FFFF00', 'text', NULL, NULL, 1, 'Live feed color when replied.', 0),
(192, 'LIVEFEED_COLOR', 'agree', '#33CC00', 'text', NULL, NULL, 1, 'Live feed color when honoured', 0),
(193, 'LIVEFEED_COLOR', 'disagree', '#FF0000', 'text', NULL, NULL, 1, 'Live feed color when dishonored ', 0),
(194, 'IMAGE', 'ques_orig', 'image/orig/question/', 'text', NULL, NULL, 0, '', 0),
(195, 'IMAGE', 'ques_thumb', 'image/thumb/question/', 'text', NULL, NULL, 0, '', 0),
(198, 'IMAGE', 'badge_orig', 'image/orig/badge/', 'text', NULL, NULL, 0, '', 0),
(199, 'IMAGE', 'badge_thumb', 'image/thumb/badge/', 'text', NULL, NULL, 0, '', 0),
(200, 'LIVEFEED_COLOR', 'add_caption', '#8E35EF', 'text', NULL, NULL, 1, 'Live feed color when once caption added to the meme.', 0),
(201, 'GLORY_CATEGORY', '1', 'Common', 'text', '', '', 0, '', 0),
(202, 'GLORY_CATEGORY', '2', 'Medium', 'text', '', '', 0, '', 0),
(203, 'GLORY_CATEGORY', '3', 'Rare', 'text', '', '', 0, '', 0),
(204, 'IMAGE', 'gloryicon_orig', 'image/orig/glory_icon/', 'text', '', '', 0, '', 0),
(205, 'IMAGE', 'gloryicon_thumb', 'image/thumb/glory_icon/', 'text', '', '', 0, '', 0),
(206, 'IMAGE', 'glorybadge_orig', 'image/orig/glory_badge/', 'text', '', '', 0, '', 0),
(207, 'IMAGE', 'glorybadge_thumb', 'image/thumb/glory_badge/', 'text', '', '', 0, '', 0),
(208, 'BADGE_TYPE', 'reply', 'Replies', 'text', NULL, NULL, 1, '', 1),
(209, 'BADGE_TYPE', 'exp_point', 'Experience point', 'text', NULL, NULL, 1, '', 2),
(210, 'BADGE_TYPE', 'ques_week_won', 'Question of the week won', 'text', NULL, NULL, 1, '', 3),
(211, 'BADGE_TYPE', 'duels_won', 'Duels won', 'text', NULL, NULL, 1, '', 4),
(212, 'BADGE_TYPE', 'id_meme', 'NO of meme post', 'text', NULL, NULL, 1, NULL, 5),
(213, 'SEARCH_TYPE', '1', 'Search', 'text', NULL, NULL, 0, '', 0),
(214, 'SEARCH_TYPE', '2', 'Meme post', 'text', NULL, NULL, 0, '', 0),
(215, 'ALLOT_POINTS', 'meme_insert', 'Meme post', 'text', NULL, NULL, 0, 'Add points when a meme post', 0),
(216, 'ALLOT_POINTS', 'answer_to_meme', 'Reply', 'text', NULL, NULL, 0, '', 0),
(217, 'ALLOT_POINTS', 'insert_caption', 'Add caption', 'text', NULL, NULL, 0, '', 0),
(218, 'FACEBOOK', 'api_key', '213764722000439', 'text', NULL, NULL, 1, '', 0),
(219, 'FACEBOOK', 'secret_key', '59fab34c926f3ac596bac25c568e1b55', 'text', NULL, NULL, 1, '', 0),
(220, 'FACEBOOK', 'app_id', '213764722000439', 'text', NULL, NULL, 1, 'Application Id', 0),
(221, 'IMAGE', 'meme_orig', 'image/orig/meme/', 'text', NULL, NULL, 0, '', 0),
(222, 'IMAGE', 'premade_image_thumb', 'image/thumb/premade_images/', 'text', NULL, NULL, 0, 'Premade image thumb path', 0),
(223, 'FLAGGING_ACTION', '1', 'Approve', 'text', NULL, NULL, 0, '', 0),
(224, 'FLAGGING_ACTION', '2', 'Disapprove', 'text', NULL, NULL, 1, NULL, 0),
(225, 'FLAGGING_ACTION', '3', 'Ignore', 'text', NULL, NULL, 1, NULL, 0),
(227, 'TWITTER', 'Consumer_secret', 'fZFP6bvDECRqAAT1wrgRsVMEqyQJqYmD3Edez1jzotA', 'text', NULL, NULL, 1, NULL, 0),
(228, 'TWITTER', 'Consumer_key', '0agkdh484xwmMvLLprLvTQ', 'text', NULL, NULL, 1, NULL, 0),
(229, 'PREMADE_CATEGORY', '1', 'Part', 'text', NULL, NULL, 1, '', 0),
(230, 'PREMADE_CATEGORY', '2', 'Happy', 'text', NULL, NULL, 1, '', 0),
(231, 'PREMADE_CATEGORY', '3', 'Laugh', 'text', NULL, NULL, 1, '', 0),
(232, 'PREMADE_CATEGORY', '4', 'Sexytime', 'text', NULL, NULL, 1, '', 0),
(233, 'PREMADE_CATEGORY', '5', 'Determined', 'text', NULL, NULL, 1, '', 0),
(234, 'NOTIFY_TYPE', '1', 'accepted your friend request.', 'text', NULL, NULL, 1, 'when a user accept your friend request.', 0),
(235, 'NOTIFY_TYPE', '2', 'invited you to duel.', 'text', NULL, NULL, 1, 'when a user get a duel invitation', 0),
(236, 'NOTIFY_TYPE', '3', 'accepted your duel invitation.', 'text', NULL, NULL, 1, 'when a user accepted your duel invitation.', 0),
(237, 'NOTIFY_TYPE', '4', 'got an achievement.', 'text', NULL, NULL, 1, 'when a user get a new badge.', 0),
(238, 'NOTIFY_TYPE', '5', 'has sent you a friend request.', 'text', NULL, NULL, 1, 'when a user get a friend request', 0),
(239, 'NOTIFY_TYPE', '6', 'tagged you on a meme.', 'text', '', '', 1, 'Notification message for tagging.', 0),
(240, 'ALLOT_POINTS', 'honour', 'Honour', 'text', NULL, NULL, 0, 'For honoring a meme.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `memeje__content`
--

DROP TABLE IF EXISTS `memeje__content`;
CREATE TABLE IF NOT EXISTS `memeje__content` (
  `id_content` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `cmscode` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `meta_description` text collate utf8_unicode_ci,
  `meta_keywords` text collate utf8_unicode_ci,
  `title` text collate utf8_unicode_ci,
  `description` text collate utf8_unicode_ci,
  `language` varchar(50) character set latin1 default NULL,
  `ip` varchar(20) character set latin1 NOT NULL default '',
  `ctime` datetime NOT NULL default '0000-00-00 00:00:00',
  `last_update_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_content`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `memeje__content`
--

INSERT INTO `memeje__content` (`id_content`, `name`, `cmscode`, `meta_description`, `meta_keywords`, `title`, `description`, `language`, `ip`, `ctime`, `last_update_time`) VALUES
(1, 'aboutus', 'aboutus', '', '', '', '<p style="text-align: justify;"><span style="font-size: larger;">Afixi is a software development company specializing in Web  Applications, Mailing and Server software solutions and security. Afixi  is a sister concern                        of Neuron Consultants Pvt. Ltd., a 13 year old IT  development                        company. Founded in April, 2002 at Bangalore,  India, Afixi                        caters to clients around the world. In the few  months of                        its existence, Afixi has carved a niche for itself  amongst                        its clients. Currently, it has clients in the US,  UK, Switzerland,                        Japan and many other countries. Afixi is  appreciated by                        its clients for its quality service, quick  turnaround times,                        and easy communication with fast responses, honest  business                        practices and reasonable pricing. It provides  direct access                        to its clients to its timesheets and project  management                        system, thereby letting them monitor the progress  and actively                        participating in their projects.</span></p><p style="text-align: justify;"><span style="font-size: larger;">Members of the Afixi Technologies have been  conceptualising                        and executing customized software and web based  solutions                        to their clients from many years, successfully  deploying                        national and international projects.</span></p><p style="text-align: justify;"><span style="font-size: larger;">We can design and deliver simple or thorough  solutions to                      meet a business need. We will endeavour to build  websites                      that :                                           <img width="6" height="6" alt="" src="http://www.afixi.com/images/bullet1.gif" /> match                      your vision and capture the passion you have for  your business                      and serving your customers.<br />                     <br />                     <img width="6" height="6" alt="" src="http://www.afixi.com/images/bullet1.gif" /> maximize                      the money-making potential of every business.<br />                     <br />                     We ensure that we really understand your business,  what makes                      it so unique and what you want to achieve. We match  that with                      our knowledge of the Internet, specifically in terms  of what                      works and what doesn''t. This is combined with a  spark of inspiration                      and innovation where first-class designers and  programmers                      build the whole thing.</span></p>', 'en', '117.201.162.225', '2011-07-29 05:01:44', '2011-08-26 04:41:41'),
(3, 'How to get achievement', 'howtogetachievement', '', '', 'How to get achievement', '<p style="text-align: justify;"><span style="font-size: larger;">Avatar game set to come out for the  Xbox 360 next week is going to set records ... in rental sales. Whoever  set the Achievements for this game was either extremely lazy, or just  didn''t give a damn. You see, within the first two minutes of playing  this game, you can earn all 1000 Achievement points by just pressing one  button over and over.</span></p>', 'en', '117.201.162.225', '2011-08-26 04:38:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__donate`
--

DROP TABLE IF EXISTS `memeje__donate`;
CREATE TABLE IF NOT EXISTS `memeje__donate` (
  `id_donate` int(11) NOT NULL auto_increment,
  `amount` float default '0',
  `donated_by` int(11) default '0',
  `name` varchar(200) collate utf8_unicode_ci default NULL,
  `payer_email` varchar(200) collate utf8_unicode_ci default NULL,
  `payment_status` varchar(20) collate utf8_unicode_ci NOT NULL,
  `txn_id` varchar(200) collate utf8_unicode_ci NOT NULL,
  `donated_on` datetime default NULL,
  `add_date` datetime NOT NULL,
  PRIMARY KEY  (`id_donate`),
  KEY `amount` (`amount`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `memeje__donate`
--

INSERT INTO `memeje__donate` (`id_donate`, `amount`, `donated_by`, `name`, `payer_email`, `payment_status`, `txn_id`, `donated_on`, `add_date`) VALUES
(1, 2.55, 2, 'Test User', 'afixi._1312949689_per@gmail.com', 'Pending', '9PY650050W782625D', '2011-08-12 07:02:02', '2011-08-12 07:03:27'),
(2, 2.56, 2, 'Test User', 'afixi._1312949689_per@gmail.com', 'Pending', '21S84322PD4838543', '2011-08-12 06:15:00', '2011-08-12 07:18:01'),
(3, 2.57, 2, 'Test User', 'afixi._1312949689_per@gmail.com', 'Pending', '9R392227LW9290130', '2011-08-12 07:25:44', '2011-08-12 07:27:12'),
(4, 2.58, 2, 'Test User', 'afixi._1291880012_per@gmail.com', 'Pending', '0NR82092K7933860M', '2011-08-12 07:33:04', '2011-08-12 07:34:08'),
(5, 2.59, 2, 'Test User', 'afixi._1291880012_per@gmail.com', 'Completed', '48T51951WC989241F', '2011-08-12 07:31:35', '2011-08-12 07:36:53'),
(6, 6.22, 0, 'Test User', 'afixi._1312949689_per@gmail.com', 'Completed', '3X051550NN013950S', '2011-08-15 20:47:19', '2011-08-15 20:55:48'),
(7, 2.1, 2, 'Test User', 'afixi._1312949689_per@gmail.com', 'Completed', '7YY47017VC6989947', '2011-08-16 06:07:47', '2011-08-16 06:09:54'),
(8, 5, 34, 'Test User', 'afixi._1311243379_per@gmail.com', 'Pending', '3YW91524UT169705J', '2011-08-18 06:21:12', '2011-08-18 06:24:29'),
(9, 2.22, 24, 'Test User', 'afixi._1312949689_per@gmail.com', 'Pending', '5A315046J8926805H', '2011-08-18 21:11:38', '2011-08-18 21:14:57'),
(10, 5.66, 4, 'Test User', 'afixi._1312949689_per@gmail.com', 'Pending', '0FK18041BF835544S', '2011-08-19 00:27:42', '2011-08-19 00:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__duel`
--

DROP TABLE IF EXISTS `memeje__duel`;
CREATE TABLE IF NOT EXISTS `memeje__duel` (
  `id_duel` int(11) NOT NULL auto_increment,
  `duelled_by` int(11) NOT NULL COMMENT 'id_user who challenged.',
  `duelled_to` int(11) NOT NULL COMMENT 'id_user to whom challenged.',
  `own_meme` int(11) default NULL COMMENT 'id_meme posted by  the user who challenged.',
  `duelled_meme` int(11) default NULL COMMENT 'id_meme posted by the user who accepted the challenge.',
  `is_accepted` tinyint(4) NOT NULL default '0' COMMENT '1 if accepted.',
  `is_ignored` tinyint(4) NOT NULL default '0' COMMENT '1 if ignored.',
  `is_cancelled` tinyint(4) NOT NULL default '0' COMMENT '1 if cancelled',
  `is_read` tinyint(1) NOT NULL default '0',
  `add_date` datetime NOT NULL,
  `duelled_date` datetime default NULL,
  `own_ip` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT 'ip of user who challenged from.',
  `duelled_ip` varchar(20) collate utf8_unicode_ci default NULL COMMENT 'ip of user who accepted or posted a meme from.',
  PRIMARY KEY  (`id_duel`),
  KEY `is_read` (`is_read`),
  KEY `is_cancelled` (`is_cancelled`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Contains the info. about all duels.' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `memeje__duel`
--

INSERT INTO `memeje__duel` (`id_duel`, `duelled_by`, `duelled_to`, `own_meme`, `duelled_meme`, `is_accepted`, `is_ignored`, `is_cancelled`, `is_read`, `add_date`, `duelled_date`, `own_ip`, `duelled_ip`) VALUES
(5, 36, 35, 10, 9, 1, 0, 0, 0, '2011-09-02 00:25:27', NULL, '204.28.119.192', '204.28.119.192');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__duel_meme`
--

DROP TABLE IF EXISTS `memeje__duel_meme`;
CREATE TABLE IF NOT EXISTS `memeje__duel_meme` (
  `id_duel_meme` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `id_question` int(11) NOT NULL default '0',
  `title` varchar(300) collate utf8_unicode_ci NOT NULL,
  `image` varchar(300) collate utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `can_all_comment` tinyint(4) NOT NULL,
  `can_all_view` tinyint(4) NOT NULL,
  `tagged_user` text collate utf8_unicode_ci,
  `is_transfered_to_meme` tinyint(4) NOT NULL default '0' COMMENT '1 if  transfered to meme table.',
  `add_date` datetime NOT NULL,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_duel_meme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `memeje__duel_meme`
--

INSERT INTO `memeje__duel_meme` (`id_duel_meme`, `id_user`, `id_question`, `title`, `image`, `category`, `can_all_comment`, `can_all_view`, `tagged_user`, `is_transfered_to_meme`, `add_date`, `ip`) VALUES
(9, 35, 0, 'Haha duplicates', '9_23_55_SoMuchWin.png', 1, 1, 1, '36', 1, '0000-00-00 00:00:00', '204.28.119.192'),
(10, 36, 0, 'not good', '10_9_41_SonMeGusta.png', 1, 1, 1, '35', 1, '0000-00-00 00:00:00', '204.28.119.192');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__feature`
--

DROP TABLE IF EXISTS `memeje__feature`;
CREATE TABLE IF NOT EXISTS `memeje__feature` (
  `id_feature` int(10) NOT NULL auto_increment,
  `title` varchar(50) collate utf8_unicode_ci default '',
  `description` varchar(100) collate utf8_unicode_ci default NULL,
  `no_of_suggestion` int(11) NOT NULL default '0',
  `activation` int(5) NOT NULL,
  `add_date` datetime default NULL,
  `ip` varchar(16) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id_feature`),
  KEY `no_of_suggestion` (`no_of_suggestion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `memeje__feature`
--

INSERT INTO `memeje__feature` (`id_feature`, `title`, `description`, `no_of_suggestion`, `activation`, `add_date`, `ip`) VALUES
(1, 'Better Editor Than MS Paint', 'You can edit ur meme with better features or better editors and make ur meme much more what u need.', 3, 1, '2011-08-17 05:57:26', '117.197.253.132'),
(2, 'Share or not share', 'Share your memes directly from your account to facebook.', 5, 1, '2011-08-17 05:57:56', '117.197.253.132'),
(3, 'Points to be noted', 'Here we are providing opportunity to get some of points ,which makes u help a lot increasing ur ran', 3, 1, '2011-08-17 05:58:38', '117.197.254.18'),
(4, 'Testing Memeje', '"This for testing memeje editor". Hello testing', 2, 1, '2011-08-18 21:58:06', '117.197.232.204');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__flag`
--

DROP TABLE IF EXISTS `memeje__flag`;
CREATE TABLE IF NOT EXISTS `memeje__flag` (
  `id_flag` int(11) NOT NULL auto_increment,
  `id_meme` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `flag_action` int(11) default NULL COMMENT 'Action taken by Admin. i.e 1 if Approved,2 if Disapproved and 3 if Igoned.',
  `add_date` datetime NOT NULL,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_flag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `memeje__flag`
--

INSERT INTO `memeje__flag` (`id_flag`, `id_meme`, `id_user`, `flag_action`, `add_date`, `ip`) VALUES
(1, 26, 35, NULL, '2011-08-20 18:22:58', '108.205.200.122'),
(2, 42, 4, NULL, '2011-08-23 00:41:03', '117.197.253.54'),
(3, 38, 4, NULL, '2011-08-23 00:47:44', '117.197.253.54'),
(4, 40, 34, NULL, '2011-08-23 00:57:50', '117.197.253.54'),
(5, 38, 2, NULL, '2011-08-23 04:02:05', '117.197.253.54'),
(6, 35, 2, NULL, '2011-08-23 04:14:13', '117.197.253.54'),
(7, 34, 2, NULL, '2011-08-23 04:17:13', '117.197.253.54'),
(8, 29, 2, NULL, '2011-08-23 04:19:57', '117.197.253.54'),
(9, 15, 2, NULL, '2011-08-23 04:23:13', '117.197.253.54'),
(10, 5, 2, NULL, '2011-08-23 04:31:38', '117.197.253.54'),
(11, 20, 3, NULL, '2011-08-24 18:27:42', '67.160.197.181'),
(12, 97, 37, NULL, '2011-09-03 01:25:39', '117.201.148.167');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__frnd_request`
--

DROP TABLE IF EXISTS `memeje__frnd_request`;
CREATE TABLE IF NOT EXISTS `memeje__frnd_request` (
  `id_frnd_request` int(11) NOT NULL auto_increment,
  `requested_by` int(11) NOT NULL,
  `requested_to` int(11) NOT NULL,
  `req_status` tinyint(2) NOT NULL COMMENT '1 for accepted 2 for rejected',
  `is_read` tinyint(1) NOT NULL default '0',
  `add_date` datetime NOT NULL,
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_frnd_request`),
  KEY `requested_by` (`requested_by`,`requested_to`),
  KEY `req_status` (`req_status`),
  KEY `is_read` (`is_read`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `memeje__frnd_request`
--

INSERT INTO `memeje__frnd_request` (`id_frnd_request`, `requested_by`, `requested_to`, `req_status`, `is_read`, `add_date`, `ip`) VALUES
(1, 2, 23, 0, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(2, 2, 32, 0, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(3, 2, 33, 0, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(6, 3, 34, 1, 0, '2011-08-22 23:01:15', '117.197.243.122'),
(7, 34, 3, 2, 0, '2011-08-22 23:03:39', '117.197.243.122'),
(8, 3, 34, 1, 0, '2011-08-22 23:04:25', '117.197.243.122'),
(9, 3, 10, 1, 0, '2011-08-22 23:37:20', '117.197.253.54'),
(10, 10, 3, 2, 0, '2011-08-22 23:37:57', '117.197.253.54'),
(11, 34, 3, 2, 0, '2011-08-22 23:40:50', '117.197.253.54'),
(12, 10, 3, 2, 0, '2011-08-22 23:41:01', '117.197.253.54'),
(13, 10, 34, 2, 0, '2011-08-22 23:43:20', '117.197.253.54'),
(14, 3, 34, 1, 0, '2011-08-22 23:43:38', '117.197.253.54'),
(15, 34, 10, 1, 0, '2011-08-22 23:49:00', '117.197.253.54'),
(16, 10, 34, 2, 0, '2011-08-22 23:50:01', '117.197.253.54'),
(17, 34, 10, 1, 0, '2011-08-22 23:50:36', '117.197.253.54'),
(18, 1, 2, 1, 0, '2011-08-23 18:21:39', '75.36.207.218'),
(19, 4, 2, 1, 0, '2011-08-23 21:31:39', '117.201.160.173'),
(20, 4, 3, 1, 0, '2011-08-23 21:31:40', '117.201.160.173'),
(21, 4, 5, 1, 0, '2011-08-23 21:31:40', '117.201.160.173'),
(23, 4, 8, 0, 0, '2011-08-23 21:31:41', '117.201.160.173'),
(24, 3, 10, 1, 0, '2011-08-23 23:21:07', '117.201.160.173'),
(25, 2, 35, 1, 0, '2011-08-24 18:53:15', '204.28.119.130'),
(26, 3, 36, 0, 0, '2011-08-25 14:51:33', '67.160.197.181'),
(27, 3, 10, 1, 0, '2011-08-25 21:49:30', '117.197.233.105'),
(28, 35, 3, 1, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(29, 35, 4, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(30, 35, 5, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(31, 35, 6, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(32, 35, 8, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(33, 35, 9, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(34, 35, 10, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(35, 35, 13, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(36, 35, 15, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(37, 35, 36, 1, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(38, 32, 34, 1, 0, '2011-09-03 02:54:46', '117.201.148.167');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__leaderboard`
--

DROP TABLE IF EXISTS `memeje__leaderboard`;
CREATE TABLE IF NOT EXISTS `memeje__leaderboard` (
  `id_leaderboard` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `exp_points` int(11) default NULL,
  `duels_won` int(11) default NULL,
  `badges` int(11) default NULL,
  `ques_week_won` int(11) default NULL,
  PRIMARY KEY  (`id_leaderboard`),
  KEY `id_leaderboard` (`id_leaderboard`,`id_user`,`exp_points`,`duels_won`,`badges`,`ques_week_won`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `memeje__leaderboard`
--


-- --------------------------------------------------------

--
-- Table structure for table `memeje__login`
--

DROP TABLE IF EXISTS `memeje__login`;
CREATE TABLE IF NOT EXISTS `memeje__login` (
  `id_login` int(10) NOT NULL auto_increment,
  `id_user` int(10) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `date_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `email` varchar(150) NOT NULL default '',
  `failure_attempt` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id_login`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=780 ;

--
-- Dumping data for table `memeje__login`
--

INSERT INTO `memeje__login` (`id_login`, `id_user`, `ip`, `date_login`, `email`, `failure_attempt`) VALUES
(1, 1, '117.201.162.188', '2011-07-16 07:12:47', 'sabri@mail.afixiindia.com', 0),
(2, 1, '117.201.162.188', '2011-07-16 07:19:37', 'sabri@mail.afixiindia.com', 0),
(3, 1, '117.201.162.188', '2011-07-16 07:20:13', 'sabri@mail.afixiindia.com', 0),
(4, 5, '117.201.162.188', '2011-07-16 07:24:29', 'biswa@mail.afixiindia.com', 0),
(6, 1, '117.201.162.188', '2011-07-16 07:26:31', 'sabri@mail.afixiindia.com', 0),
(7, 5, '117.201.162.188', '2011-07-16 07:26:48', 'biswa@mail.afixiindia.com', 0),
(8, 1, '117.201.162.188', '2011-07-16 07:30:47', 'sabri@mail.afixiindia.com', 0),
(9, 4, '117.201.162.188', '2011-07-16 07:39:19', 'upendra@mail.afixiindia.com', 0),
(10, 1, '117.201.162.188', '2011-07-16 07:48:23', 'sabri@mail.afixiindia.com', 0),
(11, 1, '117.201.162.188', '2011-07-16 07:51:13', 'sabri@mail.afixiindia.com', 0),
(12, 1, '75.36.200.220', '2011-07-17 00:59:45', 'sabri@mail.afixiindia.com', 0),
(13, 2, '117.197.246.64', '2011-07-17 22:52:34', 'jagannath@mail.afixiindia.com', 0),
(14, 2, '117.197.246.64', '2011-07-17 22:53:40', 'jagannath@mail.afixiindia.com', 0),
(15, 3, '117.197.246.64', '2011-07-17 22:55:57', 'tanmaya@mail.afixiindia.com', 0),
(16, 4, '117.197.246.64', '2011-07-17 22:57:09', 'upendra@mail.afixiindia.com', 0),
(17, 2, '117.197.246.64', '2011-07-17 22:59:25', 'jagannath@mail.afixiindia.com', 0),
(18, 8, '117.197.246.64', '2011-07-17 23:00:21', 'arun@mail.afixiindia.com', 0),
(19, 15, '117.197.246.64', '2011-07-17 23:58:33', 'sasmita@mail.afixiindia.com', 0),
(20, 15, '117.197.242.21', '2011-07-18 00:16:04', 'sasmita@mail.afixiindia.com', 0),
(21, 2, '117.197.242.21', '2011-07-18 00:21:33', 'jagannath@mail.afixiindia.com', 0),
(22, 15, '117.197.242.21', '2011-07-18 02:08:53', 'sasmita@mail.afixiindia.com', 0),
(23, 3, '117.197.242.21', '2011-07-18 04:15:35', 'tanmaya@mail.afixiindia.com', 0),
(24, 1, '117.197.242.21', '2011-07-18 04:43:14', 'sabri@mail.afixiindia.com', 0),
(25, 2, '117.197.242.21', '2011-07-18 04:47:49', 'jagannath@mail.afixiindia.com', 0),
(26, 2, '117.197.242.21', '2011-07-18 05:02:59', 'jagannath@mail.afixiindia.com', 0),
(27, 2, '117.197.242.21', '2011-07-18 05:36:39', 'jagannath@mail.afixiindia.com', 0),
(28, 30, '117.197.242.21', '2011-07-18 06:34:17', 'biswal805@gmail.com', 0),
(29, 30, '117.197.242.21', '2011-07-18 06:43:12', 'biswal805@gmail.com', 0),
(30, 30, '117.197.242.21', '2011-07-18 06:53:43', 'biswal805@gmail.com', 0),
(31, 31, '117.197.242.21', '2011-07-18 06:53:46', 'afixi.sasmita@gmail.com', 0),
(32, 31, '117.197.242.21', '2011-07-18 06:56:19', 'afixi.sasmita@gmail.com', 0),
(33, 30, '117.197.242.21', '2011-07-18 06:56:39', 'biswal805@gmail.com', 0),
(34, 30, '117.197.242.21', '2011-07-18 07:01:23', 'biswal805@gmail.com', 0),
(35, 30, '117.197.242.21', '2011-07-18 07:01:49', 'biswal805@gmail.com', 0),
(36, 30, '117.197.242.21', '2011-07-18 07:05:14', 'biswal805@gmail.com', 0),
(37, 15, '117.197.242.21', '2011-07-18 07:06:25', 'sasmita@mail.afixiindia.com', 0),
(38, 15, '117.197.242.21', '2011-07-18 07:07:55', 'sasmita@mail.afixiindia.com', 0),
(39, 30, '117.197.242.21', '2011-07-18 22:21:29', 'biswal805@gmail.com', 0),
(40, 32, '117.197.242.21', '2011-07-18 23:03:02', 'afixi.jagannath@gmail.com', 0),
(41, 32, '117.197.242.21', '2011-07-18 23:03:30', 'afixi.jagannath@gmail.com', 0),
(42, 1, '204.28.119.130', '2011-07-18 23:29:48', 'sabri@mail.afixiindia.com', 0),
(43, 30, '117.197.242.21', '2011-07-18 23:35:42', 'biswal805@gmail.com', 0),
(44, 32, '117.197.242.21', '2011-07-18 23:38:02', 'afixi.jagannath@gmail.com', 0),
(45, 31, '117.197.242.21', '2011-07-18 23:39:30', 'afixi.sasmita@gmail.com', 0),
(46, 33, '117.197.246.58', '2011-07-19 01:45:21', 'manassahoo66@gmail.com', 0),
(47, 1, '117.197.253.71', '2011-07-19 05:48:58', 'sabri@mail.afixiindia.com', 0),
(48, 4, '117.197.253.71', '2011-07-19 07:13:27', 'upendra@mail.afixiindia.com', 0),
(49, 2, '117.197.253.71', '2011-07-19 07:48:29', 'jagannath@mail.afixiindia.com', 0),
(50, 15, '117.197.253.71', '2011-07-19 07:48:47', 'sasmita@mail.afixiindia.com', 0),
(51, 33, '117.197.253.71', '2011-07-19 21:48:28', 'manassahoo66@gmail.com', 0),
(52, 1, '204.28.119.130', '2011-07-20 00:28:14', 'sabri@mail.afixiindia.com', 0),
(53, 31, '117.197.253.71', '2011-07-20 00:29:59', 'afixi.sasmita@gmail.com', 0),
(54, 1, '204.28.119.130', '2011-07-20 02:40:11', 'sabri@mail.afixiindia.com', 0),
(55, 32, '117.197.253.71', '2011-07-20 02:51:59', 'afixi.jagannath@gmail.com', 0),
(56, 1, '136.152.140.118', '2011-07-20 16:13:12', 'sabri@mail.afixiindia.com', 0),
(57, 1, '76.230.234.245', '2011-07-21 23:40:52', 'sabri@mail.afixiindia.com', 0),
(58, 4, '117.197.242.162', '2011-07-22 04:48:16', 'upendra@mail.afixiindia.com', 0),
(59, 3, '117.197.242.162', '2011-07-22 05:01:01', 'tanmaya@mail.afixiindia.com', 0),
(60, 2, '117.197.242.162', '2011-07-22 06:18:54', 'jagannath@mail.afixiindia.com', 0),
(61, 1, '117.197.242.162', '2011-07-22 06:26:50', 'sabri@mail.afixiindia.com', 0),
(62, 4, '117.197.242.162', '2011-07-22 06:32:36', 'upendra@mail.afixiindia.com', 0),
(63, 2, '117.197.242.162', '2011-07-22 06:38:38', 'jagannath@mail.afixiindia.com', 0),
(64, 2, '117.197.242.162', '2011-07-22 06:41:51', 'jagannath@mail.afixiindia.com', 0),
(65, 2, '122.50.132.239', '2011-07-22 22:08:26', 'jagannath@mail.afixiindia.com', 0),
(66, 1, '76.230.234.245', '2011-07-22 23:37:48', 'sabri@mail.afixiindia.com', 0),
(67, 1, '75.36.206.215', '2011-07-23 16:22:18', 'sabri@mail.afixiindia.com', 0),
(68, 1, '75.36.206.215', '2011-07-23 22:26:18', 'sabri@mail.afixiindia.com', 0),
(69, 4, '117.197.248.186', '2011-07-23 22:33:31', 'upendra@mail.afixiindia.com', 0),
(70, 1, '75.36.206.215', '2011-07-24 05:04:17', 'sabri@mail.afixiindia.com', 0),
(71, 1, '75.36.206.215', '2011-07-24 13:08:10', 'sabri@mail.afixiindia.com', 0),
(72, 1, '75.37.46.27', '2011-07-24 18:51:06', 'sabri@mail.afixiindia.com', 0),
(73, 2, '117.201.146.173', '2011-07-24 22:26:01', 'jagannath@mail.afixiindia.com', 0),
(74, 4, '117.197.233.157', '2011-07-24 23:28:32', 'upendra@mail.afixiindia.com', 0),
(75, 15, '117.197.233.157', '2011-07-24 23:57:04', 'sasmita@mail.afixiindia.com', 0),
(76, 1, '75.37.46.27', '2011-07-25 02:39:26', 'sabri@mail.afixiindia.com', 0),
(77, 4, '117.201.145.123', '2011-07-25 07:39:09', 'upendra@mail.afixiindia.com', 0),
(78, 1, '204.28.119.130', '2011-07-25 13:02:42', 'sabri@mail.afixiindia.com', 0),
(79, 1, '136.152.138.99', '2011-07-25 17:15:12', 'sabri@mail.afixiindia.com', 0),
(80, 4, '117.197.249.109', '2011-07-25 21:55:50', 'upendra@mail.afixiindia.com', 0),
(81, 2, '117.197.249.109', '2011-07-25 21:56:24', 'jagannath@mail.afixiindia.com', 0),
(82, 1, '204.28.119.130', '2011-07-25 22:44:40', 'sabri@mail.afixiindia.com', 0),
(83, 2, '117.197.249.109', '2011-07-26 00:44:25', 'jagannath@mail.afixiindia.com', 0),
(84, 3, '117.197.249.109', '2011-07-26 01:01:35', 'tanmaya@mail.afixiindia.com', 0),
(85, 2, '117.197.249.109', '2011-07-26 01:01:41', 'jagannath@mail.afixiindia.com', 0),
(86, 1, '204.28.119.130', '2011-07-26 01:44:19', 'sabri@mail.afixiindia.com', 0),
(87, 15, '117.197.249.109', '2011-07-26 03:38:37', 'sasmita@mail.afixiindia.com', 0),
(88, 15, '117.197.249.109', '2011-07-26 03:40:07', 'sasmita@mail.afixiindia.com', 0),
(89, 15, '117.197.249.109', '2011-07-26 03:41:21', 'sasmita@mail.afixiindia.com', 0),
(90, 2, '117.197.249.109', '2011-07-26 03:45:26', 'jagannath@mail.afixiindia.com', 0),
(91, 2, '117.197.249.109', '2011-07-26 04:34:54', 'jagannath@mail.afixiindia.com', 0),
(92, 2, '117.197.236.201', '2011-07-26 07:02:19', 'jagannath@mail.afixiindia.com', 0),
(93, 4, '117.197.236.201', '2011-07-26 07:06:29', 'upendra@mail.afixiindia.com', 0),
(94, 1, '117.201.145.241', '2011-07-26 08:00:25', 'sabri@mail.afixiindia.com', 0),
(95, 1, '204.28.119.130', '2011-07-26 16:31:44', 'sabri@mail.afixiindia.com', 0),
(96, 1, '204.28.119.132', '2011-07-26 16:45:02', 'sabri@mail.afixiindia.com', 0),
(97, 4, '117.197.232.231', '2011-07-26 21:32:19', 'upendra@mail.afixiindia.com', 0),
(98, 4, '117.197.232.231', '2011-07-26 21:42:19', 'upendra@mail.afixiindia.com', 0),
(99, 2, '117.197.232.231', '2011-07-26 22:21:38', 'jagannath@mail.afixiindia.com', 0),
(100, 4, '117.197.232.231', '2011-07-26 22:40:19', 'upendra@mail.afixiindia.com', 0),
(101, 1, '204.28.119.130', '2011-07-26 22:48:17', 'sabri@mail.afixiindia.com', 0),
(102, 4, '117.197.232.231', '2011-07-26 22:49:30', 'upendra@mail.afixiindia.com', 0),
(103, 32, '117.201.160.101', '2011-07-26 23:22:54', 'afixi.jagannath@gmail.com', 0),
(104, 32, '117.201.160.101', '2011-07-26 23:35:37', 'afixi.jagannath@gmail.com', 0),
(105, 34, '117.201.160.101', '2011-07-27 00:13:37', 'afixi.satya@gmail.com', 0),
(106, 4, '117.197.239.157', '2011-07-27 05:46:09', 'upendra@mail.afixiindia.com', 0),
(107, 2, '117.197.239.157', '2011-07-27 05:46:13', 'jagannath@mail.afixiindia.com', 0),
(108, 34, '117.197.239.157', '2011-07-27 05:52:10', 'afixi.satya@gmail.com', 0),
(109, 2, '117.197.239.157', '2011-07-27 05:59:43', 'jagannath@mail.afixiindia.com', 0),
(110, 32, '117.197.239.157', '2011-07-27 05:59:45', 'afixi.jagannath@gmail.com', 0),
(111, 24, '117.197.239.157', '2011-07-27 06:08:54', 'afixi.upendra@gmail.com', 0),
(112, 2, '117.197.239.157', '2011-07-27 06:38:46', 'jagannath@mail.afixiindia.com', 0),
(113, 1, '204.28.119.130', '2011-07-27 12:34:18', 'sabri@mail.afixiindia.com', 0),
(114, 32, '117.197.232.233', '2011-07-27 20:47:44', 'afixi.jagannath@gmail.com', 0),
(115, 35, '64.120.96.139', '2011-07-27 21:00:39', 'lol.i.laugh@gmail.com', 0),
(116, 1, '204.28.119.130', '2011-07-27 21:05:12', 'sabri@mail.afixiindia.com', 0),
(117, 2, '117.197.232.233', '2011-07-27 22:07:57', 'jagannath@mail.afixiindia.com', 0),
(118, 32, '117.197.232.233', '2011-07-27 22:43:15', 'afixi.jagannath@gmail.com', 0),
(119, 34, '117.197.232.233', '2011-07-27 22:44:25', 'afixi.satya@gmail.com', 0),
(120, 34, '117.197.247.125', '2011-07-28 05:51:07', 'afixi.satya@gmail.com', 0),
(121, 34, '117.197.247.125', '2011-07-28 05:53:20', 'afixi.satya@gmail.com', 0),
(122, 34, '117.197.247.125', '2011-07-28 06:02:29', 'afixi.satya@gmail.com', 0),
(123, 34, '117.197.247.125', '2011-07-28 06:03:51', 'afixi.satya@gmail.com', 0),
(124, 2, '117.197.237.138', '2011-07-28 07:19:12', 'jagannath@mail.afixiindia.com', 0),
(125, 1, '117.197.237.138', '2011-07-28 07:23:06', 'sabri@mail.afixiindia.com', 0),
(126, 1, '204.28.119.130', '2011-07-28 11:53:05', 'sabri@mail.afixiindia.com', 0),
(127, 4, '117.197.233.45', '2011-07-28 21:07:03', 'upendra@mail.afixiindia.com', 0),
(128, 34, '117.197.233.45', '2011-07-28 21:11:58', 'afixi.satya@gmail.com', 0),
(129, 34, '117.201.166.151', '2011-07-28 21:44:58', 'afixi.satya@gmail.com', 0),
(130, 34, '117.201.166.151', '2011-07-28 21:45:42', 'afixi.satya@gmail.com', 0),
(131, 2, '117.201.166.151', '2011-07-28 21:55:18', 'jagannath@mail.afixiindia.com', 0),
(132, 1, '204.28.119.130', '2011-07-28 22:26:14', 'sabri@mail.afixiindia.com', 0),
(133, 4, '117.201.166.151', '2011-07-28 22:59:20', 'upendra@mail.afixiindia.com', 0),
(134, 32, '117.201.166.151', '2011-07-28 23:23:44', 'afixi.jagannath@gmail.com', 0),
(135, 3, '117.201.166.151', '2011-07-28 23:32:26', 'tanmaya@mail.afixiindia.com', 0),
(136, 2, '117.201.166.151', '2011-07-29 00:05:36', 'jagannath@mail.afixiindia.com', 0),
(137, 4, '117.201.166.151', '2011-07-29 00:29:55', 'upendra@mail.afixiindia.com', 0),
(138, 1, '204.28.119.130', '2011-07-29 00:42:51', 'sabri@mail.afixiindia.com', 0),
(139, 5, '117.201.166.151', '2011-07-29 02:29:34', 'biswa@mail.afixiindia.com', 0),
(140, 1, '117.201.166.151', '2011-07-29 04:59:58', 'sabri@mail.afixiindia.com', 0),
(141, 5, '117.201.166.151', '2011-07-29 06:30:28', 'biswa@mail.afixiindia.com', 0),
(142, 32, '117.201.166.151', '2011-07-29 07:28:20', 'afixi.jagannath@gmail.com', 0),
(143, 1, '204.28.119.130', '2011-07-29 16:38:03', 'sabri@mail.afixiindia.com', 0),
(144, 34, '117.197.249.37', '2011-07-29 21:11:34', 'afixi.satya@gmail.com', 0),
(145, 34, '117.197.249.37', '2011-07-29 21:30:48', 'afixi.satya@gmail.com', 0),
(146, 4, '117.197.249.37', '2011-07-29 22:20:41', 'upendra@mail.afixiindia.com', 0),
(147, 1, '75.37.46.27', '2011-07-29 23:01:17', 'sabri@mail.afixiindia.com', 0),
(148, 4, '117.197.249.37', '2011-07-30 01:02:57', 'upendra@mail.afixiindia.com', 0),
(149, 2, '117.197.249.37', '2011-07-30 01:05:48', 'jagannath@mail.afixiindia.com', 0),
(150, 1, '75.37.46.27', '2011-07-30 02:23:12', 'sabri@mail.afixiindia.com', 0),
(151, 2, '117.197.249.37', '2011-07-30 08:05:18', 'jagannath@mail.afixiindia.com', 0),
(152, 24, '27.48.32.51', '2011-07-30 13:06:00', 'afixi.upendra@gmail.com', 0),
(153, 1, '76.230.232.100', '2011-07-30 16:01:00', 'sabri@mail.afixiindia.com', 0),
(154, 35, '173.234.147.122', '2011-07-30 23:45:10', 'lol.i.laugh@gmail.com', 0),
(155, 1, '76.230.232.100', '2011-07-31 06:37:01', 'sabri@mail.afixiindia.com', 0),
(156, 1, '76.230.232.100', '2011-07-31 06:40:29', 'sabri@mail.afixiindia.com', 0),
(157, 1, '76.230.232.100', '2011-07-31 14:40:09', 'sabri@mail.afixiindia.com', 0),
(158, 1, '117.197.253.177', '2011-07-31 20:46:14', 'sabri@mail.afixiindia.com', 0),
(159, 34, '117.197.253.177', '2011-07-31 20:47:55', 'afixi.satya@gmail.com', 0),
(160, 2, '117.197.253.177', '2011-07-31 20:57:17', 'jagannath@mail.afixiindia.com', 0),
(161, 4, '117.197.253.177', '2011-07-31 21:15:55', 'upendra@mail.afixiindia.com', 0),
(162, 5, '117.197.253.177', '2011-07-31 21:42:44', 'biswa@mail.afixiindia.com', 0),
(163, 2, '117.197.253.177', '2011-07-31 22:54:39', 'jagannath@mail.afixiindia.com', 0),
(164, 4, '117.197.255.82', '2011-08-01 00:17:20', 'upendra@mail.afixiindia.com', 0),
(165, 34, '117.197.255.82', '2011-08-01 00:37:37', 'afixi.satya@gmail.com', 0),
(166, 1, '76.230.232.100', '2011-08-01 01:12:27', 'sabri@mail.afixiindia.com', 0),
(167, 2, '117.197.249.31', '2011-08-01 02:26:02', 'jagannath@mail.afixiindia.com', 0),
(168, 34, '117.197.249.31', '2011-08-01 02:29:32', 'afixi.satya@gmail.com', 0),
(169, 1, '136.152.138.197', '2011-08-01 17:09:50', 'sabri@mail.afixiindia.com', 0),
(170, 34, '117.197.245.193', '2011-08-01 20:45:15', 'afixi.satya@gmail.com', 0),
(171, 34, '117.197.245.193', '2011-08-01 21:24:38', 'afixi.satya@gmail.com', 0),
(172, 4, '117.197.245.193', '2011-08-01 23:19:38', 'upendra@mail.afixiindia.com', 0),
(173, 1, '204.28.119.130', '2011-08-01 23:47:45', 'sabri@mail.afixiindia.com', 0),
(174, 2, '117.197.245.193', '2011-08-02 00:18:35', 'jagannath@mail.afixiindia.com', 0),
(175, 2, '117.197.245.193', '2011-08-02 02:25:13', 'jagannath@mail.afixiindia.com', 0),
(176, 1, '204.28.119.130', '2011-08-02 12:39:00', 'sabri@mail.afixiindia.com', 0),
(177, 1, '204.28.119.130', '2011-08-02 16:57:51', 'sabri@mail.afixiindia.com', 0),
(178, 34, '117.197.251.4', '2011-08-02 20:53:16', 'afixi.satya@gmail.com', 0),
(179, 4, '117.197.251.4', '2011-08-02 22:45:41', 'upendra@mail.afixiindia.com', 0),
(180, 1, '204.28.119.130', '2011-08-03 00:28:52', 'sabri@mail.afixiindia.com', 0),
(181, 1, '204.28.119.130', '2011-08-03 13:36:35', 'sabri@mail.afixiindia.com', 0),
(182, 1, '204.28.119.130', '2011-08-03 17:06:04', 'sabri@mail.afixiindia.com', 0),
(183, 34, '117.197.249.186', '2011-08-03 21:12:54', 'afixi.satya@gmail.com', 0),
(184, 1, '204.28.119.130', '2011-08-04 03:02:49', 'sabri@mail.afixiindia.com', 0),
(185, 2, '117.197.246.161', '2011-08-04 03:27:27', 'jagannath@mail.afixiindia.com', 0),
(186, 4, '117.197.246.161', '2011-08-04 04:02:09', 'upendra@mail.afixiindia.com', 0),
(187, 5, '117.197.246.161', '2011-08-04 04:04:39', 'biswa@mail.afixiindia.com', 0),
(188, 30, '117.197.246.161', '2011-08-04 04:07:52', 'biswal805@gmail.com', 0),
(189, 4, '117.197.246.161', '2011-08-04 04:15:21', 'upendra@mail.afixiindia.com', 0),
(190, 2, '117.197.246.161', '2011-08-04 04:16:18', 'jagannath@mail.afixiindia.com', 0),
(191, 34, '117.197.246.161', '2011-08-04 04:18:41', 'afixi.satya@gmail.com', 0),
(192, 5, '117.197.246.161', '2011-08-04 04:20:49', 'biswa@mail.afixiindia.com', 0),
(193, 4, '117.197.246.161', '2011-08-04 04:21:19', 'upendra@mail.afixiindia.com', 0),
(194, 4, '117.197.246.161', '2011-08-04 05:08:38', 'upendra@mail.afixiindia.com', 0),
(195, 34, '117.197.246.161', '2011-08-04 06:09:00', 'afixi.satya@gmail.com', 0),
(196, 24, '117.197.246.161', '2011-08-04 06:10:38', 'afixi.upendra@gmail.com', 0),
(197, 34, '117.197.246.161', '2011-08-04 06:11:51', 'afixi.satya@gmail.com', 0),
(198, 34, '117.197.235.25', '2011-08-04 06:42:59', 'afixi.satya@gmail.com', 0),
(199, 30, '117.197.235.25', '2011-08-04 06:44:33', 'biswal805@gmail.com', 0),
(200, 34, '117.197.236.117', '2011-08-04 06:47:53', 'afixi.satya@gmail.com', 0),
(201, 30, '117.197.236.117', '2011-08-04 06:50:04', 'biswal805@gmail.com', 0),
(202, 30, '117.197.236.117', '2011-08-04 07:11:42', 'biswal805@gmail.com', 0),
(203, 2, '117.197.236.117', '2011-08-04 07:38:24', 'jagannath@mail.afixiindia.com', 0),
(204, 1, '204.28.119.130', '2011-08-04 13:43:59', 'sabri@mail.afixiindia.com', 0),
(205, 1, '204.28.119.130', '2011-08-04 17:10:27', 'sabri@mail.afixiindia.com', 0),
(206, 1, '204.28.119.130', '2011-08-04 19:00:54', 'sabri@mail.afixiindia.com', 0),
(207, 3, '117.197.254.90', '2011-08-04 20:36:58', 'tanmaya@mail.afixiindia.com', 0),
(208, 34, '117.197.254.90', '2011-08-04 20:53:49', 'afixi.satya@gmail.com', 0),
(209, 34, '117.197.254.90', '2011-08-04 20:58:11', 'afixi.satya@gmail.com', 0),
(210, 2, '117.197.254.90', '2011-08-04 20:58:54', 'jagannath@mail.afixiindia.com', 0),
(211, 4, '117.197.254.90', '2011-08-04 21:05:07', 'upendra@mail.afixiindia.com', 0),
(212, 34, '117.197.254.90', '2011-08-04 21:12:32', 'afixi.satya@gmail.com', 0),
(213, 34, '117.197.254.90', '2011-08-04 21:40:55', 'afixi.satya@gmail.com', 0),
(214, 34, '117.197.254.90', '2011-08-04 21:47:00', 'afixi.satya@gmail.com', 0),
(215, 34, '117.197.254.90', '2011-08-04 22:00:24', 'afixi.satya@gmail.com', 0),
(216, 4, '117.197.249.127', '2011-08-04 23:54:48', 'upendra@mail.afixiindia.com', 0),
(217, 34, '117.197.238.125', '2011-08-05 01:58:54', 'afixi.satya@gmail.com', 0),
(218, 34, '117.197.238.125', '2011-08-05 01:59:31', 'afixi.satya@gmail.com', 0),
(219, 34, '117.201.161.51', '2011-08-05 02:48:49', 'afixi.satya@gmail.com', 0),
(220, 1, '204.28.119.130', '2011-08-05 02:58:56', 'sabri@mail.afixiindia.com', 0),
(221, 34, '117.201.161.51', '2011-08-05 04:36:57', 'afixi.satya@gmail.com', 0),
(222, 34, '117.197.233.123', '2011-08-05 05:54:17', 'afixi.satya@gmail.com', 0),
(223, 2, '122.50.136.49', '2011-08-05 10:26:16', 'jagannath@mail.afixiindia.com', 0),
(224, 2, '122.50.136.49', '2011-08-05 10:27:21', 'jagannath@mail.afixiindia.com', 0),
(225, 1, '204.28.119.130', '2011-08-05 13:01:22', 'sabri@mail.afixiindia.com', 0),
(226, 24, '117.197.255.13', '2011-08-05 22:16:30', 'afixi.upendra@gmail.com', 0),
(227, 2, '117.197.255.13', '2011-08-05 22:53:36', 'jagannath@mail.afixiindia.com', 0),
(228, 1, '204.28.119.130', '2011-08-05 22:59:40', 'sabri@mail.afixiindia.com', 0),
(229, 2, '117.197.255.13', '2011-08-05 23:07:57', 'jagannath@mail.afixiindia.com', 0),
(230, 24, '117.197.255.13', '2011-08-05 23:24:39', 'afixi.upendra@gmail.com', 0),
(231, 2, '117.197.255.13', '2011-08-05 23:32:15', 'jagannath@mail.afixiindia.com', 0),
(232, 2, '117.197.255.13', '2011-08-05 23:34:53', 'jagannath@mail.afixiindia.com', 0),
(233, 24, '117.197.255.13', '2011-08-05 23:41:43', 'afixi.upendra@gmail.com', 0),
(234, 24, '117.197.255.13', '2011-08-05 23:46:21', 'afixi.upendra@gmail.com', 0),
(235, 2, '117.197.255.13', '2011-08-05 23:46:38', 'jagannath@mail.afixiindia.com', 0),
(236, 3, '117.197.255.13', '2011-08-05 23:50:30', 'tanmaya@mail.afixiindia.com', 0),
(237, 1, '204.28.119.130', '2011-08-06 01:51:25', 'sabri@mail.afixiindia.com', 0),
(238, 2, '117.197.245.177', '2011-08-06 02:25:15', 'jagannath@mail.afixiindia.com', 0),
(239, 4, '117.201.160.89', '2011-08-06 04:53:13', 'upendra@mail.afixiindia.com', 0),
(240, 1, '204.28.119.130', '2011-08-06 06:10:36', 'sabri@mail.afixiindia.com', 0),
(241, 2, '117.201.160.89', '2011-08-06 06:54:45', 'jagannath@mail.afixiindia.com', 0),
(242, 2, '122.50.138.14', '2011-08-06 09:17:34', 'jagannath@mail.afixiindia.com', 0),
(243, 2, '122.50.138.14', '2011-08-06 09:21:37', 'jagannath@mail.afixiindia.com', 0),
(244, 1, '204.28.119.130', '2011-08-06 14:22:18', 'sabri@mail.afixiindia.com', 0),
(245, 1, '204.28.119.130', '2011-08-06 17:41:26', 'sabri@mail.afixiindia.com', 0),
(246, 2, '122.50.138.14', '2011-08-06 21:46:57', 'jagannath@mail.afixiindia.com', 0),
(247, 2, '117.203.208.244', '2011-08-06 21:48:20', 'jagannath@mail.afixiindia.com', 0),
(248, 1, '204.28.119.130', '2011-08-06 21:51:02', 'sabri@mail.afixiindia.com', 0),
(249, 2, '122.50.138.14', '2011-08-07 06:35:00', 'jagannath@mail.afixiindia.com', 0),
(250, 2, '122.50.138.14', '2011-08-07 06:35:26', 'jagannath@mail.afixiindia.com', 0),
(251, 2, '122.50.138.14', '2011-08-07 07:26:48', 'jagannath@mail.afixiindia.com', 0),
(252, 1, '204.28.119.130', '2011-08-07 17:45:15', 'sabri@mail.afixiindia.com', 0),
(253, 4, '117.197.247.208', '2011-08-07 21:02:11', 'upendra@mail.afixiindia.com', 0),
(254, 2, '117.197.247.208', '2011-08-07 21:36:56', 'jagannath@mail.afixiindia.com', 0),
(255, 2, '117.197.247.208', '2011-08-07 21:38:10', 'jagannath@mail.afixiindia.com', 0),
(256, 2, '117.197.247.208', '2011-08-07 21:44:51', 'jagannath@mail.afixiindia.com', 0),
(257, 2, '117.197.247.208', '2011-08-07 21:48:25', 'jagannath@mail.afixiindia.com', 0),
(258, 2, '117.197.247.208', '2011-08-07 21:51:08', 'jagannath@mail.afixiindia.com', 0),
(259, 34, '117.197.233.165', '2011-08-08 00:17:19', 'afixi.satya@gmail.com', 0),
(260, 1, '136.152.178.26', '2011-08-08 16:12:27', 'sabri@mail.afixiindia.com', 0),
(261, 2, '117.197.250.111', '2011-08-08 22:36:45', 'jagannath@mail.afixiindia.com', 0),
(262, 1, '204.28.119.130', '2011-08-09 05:02:52', 'sabri@mail.afixiindia.com', 0),
(263, 5, '117.197.250.111', '2011-08-09 05:42:28', 'biswa@mail.afixiindia.com', 0),
(264, 4, '117.197.250.111', '2011-08-09 07:11:46', 'upendra@mail.afixiindia.com', 0),
(265, 34, '117.197.243.57', '2011-08-09 20:48:39', 'afixi.satya@gmail.com', 0),
(266, 4, '117.197.243.57', '2011-08-09 21:49:24', 'upendra@mail.afixiindia.com', 0),
(267, 4, '117.197.243.57', '2011-08-09 22:01:15', 'upendra@mail.afixiindia.com', 0),
(268, 4, '117.197.243.57', '2011-08-10 01:03:02', 'upendra@mail.afixiindia.com', 0),
(269, 3, '117.197.243.57', '2011-08-10 01:05:04', 'tanmaya@mail.afixiindia.com', 0),
(270, 4, '117.197.243.57', '2011-08-10 01:06:01', 'upendra@mail.afixiindia.com', 0),
(271, 3, '117.197.243.57', '2011-08-10 02:09:35', 'tanmaya@mail.afixiindia.com', 0),
(272, 3, '117.197.243.57', '2011-08-10 02:30:47', 'tanmaya@mail.afixiindia.com', 0),
(273, 4, '117.197.243.57', '2011-08-10 02:38:42', 'upendra@mail.afixiindia.com', 0),
(274, 5, '117.197.243.57', '2011-08-10 02:40:16', 'biswa@mail.afixiindia.com', 0),
(275, 5, '117.197.243.57', '2011-08-10 02:49:07', 'biswa@mail.afixiindia.com', 0),
(276, 3, '117.197.243.57', '2011-08-10 02:49:41', 'tanmaya@mail.afixiindia.com', 0),
(277, 2, '117.197.243.57', '2011-08-10 02:50:56', 'jagannath@mail.afixiindia.com', 0),
(278, 5, '117.197.243.57', '2011-08-10 02:52:02', 'biswa@mail.afixiindia.com', 0),
(279, 1, '204.28.119.130', '2011-08-10 04:08:39', 'sabri@mail.afixiindia.com', 0),
(280, 3, '117.201.165.60', '2011-08-10 04:16:39', 'tanmaya@mail.afixiindia.com', 0),
(281, 2, '117.201.163.105', '2011-08-10 06:10:55', 'jagannath@mail.afixiindia.com', 0),
(282, 2, '117.201.163.105', '2011-08-10 22:49:10', 'jagannath@mail.afixiindia.com', 0),
(283, 2, '117.201.163.105', '2011-08-10 22:50:06', 'jagannath@mail.afixiindia.com', 0),
(284, 1, '117.201.163.105', '2011-08-10 23:26:20', 'sabri@mail.afixiindia.com', 0),
(285, 1, '204.28.119.130', '2011-08-10 23:36:37', 'sabri@mail.afixiindia.com', 0),
(286, 2, '117.201.163.105', '2011-08-10 23:41:36', 'jagannath@mail.afixiindia.com', 0),
(287, 1, '204.28.119.132', '2011-08-10 23:44:09', 'sabri@mail.afixiindia.com', 0),
(288, 34, '117.201.163.105', '2011-08-10 23:52:27', 'afixi.satya@gmail.com', 0),
(289, 34, '117.201.163.105', '2011-08-11 02:29:15', 'afixi.satya@gmail.com', 0),
(290, 34, '117.201.163.105', '2011-08-11 02:31:44', 'afixi.satya@gmail.com', 0),
(291, 34, '117.201.163.105', '2011-08-11 02:41:08', 'afixi.satya@gmail.com', 0),
(292, 34, '117.201.163.105', '2011-08-11 02:45:12', 'afixi.satya@gmail.com', 0),
(293, 34, '117.201.163.105', '2011-08-11 02:53:52', 'afixi.satya@gmail.com', 0),
(294, 34, '117.201.163.105', '2011-08-11 04:17:50', 'afixi.satya@gmail.com', 0),
(295, 2, '117.197.252.189', '2011-08-11 06:25:51', 'jagannath@mail.afixiindia.com', 0),
(296, 2, '117.197.243.178', '2011-08-11 21:20:57', 'jagannath@mail.afixiindia.com', 0),
(297, 2, '117.201.165.46', '2011-08-12 00:20:45', 'jagannath@mail.afixiindia.com', 0),
(298, 2, '117.197.244.247', '2011-08-12 06:13:00', 'jagannath@mail.afixiindia.com', 0),
(299, 1, '204.28.119.132', '2011-08-12 22:11:29', 'sabri@mail.afixiindia.com', 0),
(300, 1, '204.28.119.130', '2011-08-12 23:35:26', 'sabri@mail.afixiindia.com', 0),
(301, 1, '204.28.119.130', '2011-08-13 01:23:57', 'sabri@mail.afixiindia.com', 0),
(302, 1, '204.28.119.130', '2011-08-13 10:31:52', 'sabri@mail.afixiindia.com', 0),
(303, 1, '75.37.43.42', '2011-08-14 04:22:06', 'sabri@mail.afixiindia.com', 0),
(304, 2, '122.50.132.144', '2011-08-14 05:28:37', 'jagannath@mail.afixiindia.com', 0),
(305, 2, '122.50.132.144', '2011-08-14 05:34:10', 'jagannath@mail.afixiindia.com', 0),
(306, 2, '122.50.132.144', '2011-08-14 05:35:40', 'jagannath@mail.afixiindia.com', 0),
(307, 1, '75.37.43.42', '2011-08-14 05:39:11', 'sabri@mail.afixiindia.com', 0),
(308, 1, '75.37.43.42', '2011-08-14 16:34:44', 'sabri@mail.afixiindia.com', 0),
(309, 1, '75.37.43.42', '2011-08-15 17:33:03', 'sabri@mail.afixiindia.com', 0),
(310, 2, '117.197.233.106', '2011-08-15 22:50:26', 'jagannath@mail.afixiindia.com', 0),
(311, 2, '117.197.233.106', '2011-08-15 23:24:10', 'jagannath@mail.afixiindia.com', 0),
(312, 2, '117.197.233.106', '2011-08-15 23:26:29', 'jagannath@mail.afixiindia.com', 0),
(313, 2, '117.197.233.106', '2011-08-15 23:43:01', 'jagannath@mail.afixiindia.com', 0),
(314, 2, '117.197.233.106', '2011-08-16 06:01:00', 'jagannath@mail.afixiindia.com', 0),
(315, 32, '117.197.233.106', '2011-08-16 06:45:14', 'afixi.jagannath@gmail.com', 0),
(316, 4, '117.197.253.66', '2011-08-16 20:56:42', 'upendra@mail.afixiindia.com', 0),
(317, 32, '117.197.253.66', '2011-08-16 21:14:48', 'afixi.jagannath@gmail.com', 0),
(318, 1, '75.36.200.147', '2011-08-17 03:41:38', 'sabri@mail.afixiindia.com', 0),
(319, 34, '117.201.161.219', '2011-08-17 04:06:23', 'afixi.satya@gmail.com', 0),
(320, 34, '117.201.161.219', '2011-08-17 04:09:35', 'afixi.satya@gmail.com', 0),
(321, 34, '117.201.161.219', '2011-08-17 04:43:29', 'afixi.satya@gmail.com', 0),
(322, 34, '117.201.161.219', '2011-08-17 04:46:35', 'afixi.satya@gmail.com', 0),
(323, 34, '117.197.254.18', '2011-08-17 05:44:08', 'afixi.satya@gmail.com', 0),
(324, 4, '117.197.254.18', '2011-08-17 05:55:01', 'upendra@mail.afixiindia.com', 0),
(325, 4, '117.197.254.18', '2011-08-17 05:59:03', 'upendra@mail.afixiindia.com', 0),
(326, 1, '117.197.254.18', '2011-08-17 05:59:51', 'sabri@mail.afixiindia.com', 0),
(327, 4, '117.197.254.18', '2011-08-17 06:00:46', 'upendra@mail.afixiindia.com', 0),
(328, 2, '117.197.254.18', '2011-08-17 06:21:51', 'jagannath@mail.afixiindia.com', 0),
(329, 4, '117.197.254.18', '2011-08-17 06:28:03', 'upendra@mail.afixiindia.com', 0),
(330, 1, '76.230.235.190', '2011-08-17 12:16:06', 'sabri@mail.afixiindia.com', 0),
(331, 1, '75.36.207.17', '2011-08-17 16:33:40', 'sabri@mail.afixiindia.com', 0),
(332, 1, '75.36.207.17', '2011-08-17 16:33:49', 'sabri@mail.afixiindia.com', 0),
(333, 1, '108.205.200.122', '2011-08-17 20:38:01', 'sabri@mail.afixiindia.com', 0),
(334, 34, '117.197.246.187', '2011-08-17 20:41:16', 'afixi.satya@gmail.com', 0),
(335, 34, '117.197.255.60', '2011-08-17 21:51:43', 'afixi.satya@gmail.com', 0),
(336, 32, '117.197.255.60', '2011-08-17 22:26:47', 'afixi.jagannath@gmail.com', 0),
(337, 34, '117.197.239.152', '2011-08-17 23:54:23', 'afixi.satya@gmail.com', 0),
(338, 34, '117.197.239.152', '2011-08-17 23:55:42', 'afixi.satya@gmail.com', 0),
(339, 34, '117.197.239.152', '2011-08-17 23:56:12', 'afixi.satya@gmail.com', 0),
(340, 4, '117.197.239.152', '2011-08-18 00:39:31', 'upendra@mail.afixiindia.com', 0),
(341, 2, '117.197.253.132', '2011-08-18 02:30:21', 'jagannath@mail.afixiindia.com', 0),
(342, 4, '117.197.253.132', '2011-08-18 02:38:47', 'upendra@mail.afixiindia.com', 0),
(343, 24, '117.197.253.132', '2011-08-18 02:58:38', 'afixi.upendra@gmail.com', 0),
(344, 2, '117.197.253.132', '2011-08-18 03:50:32', 'jagannath@mail.afixiindia.com', 0),
(345, 1, '117.197.253.132', '2011-08-18 03:54:22', 'sabri@mail.afixiindia.com', 0),
(346, 34, '117.197.253.132', '2011-08-18 03:58:03', 'afixi.satya@gmail.com', 0),
(347, 2, '117.197.253.132', '2011-08-18 04:11:02', 'jagannath@mail.afixiindia.com', 0),
(348, 34, '117.197.253.132', '2011-08-18 04:18:47', 'afixi.satya@gmail.com', 0),
(349, 2, '117.197.253.132', '2011-08-18 04:24:13', 'jagannath@mail.afixiindia.com', 0),
(350, 24, '117.197.253.132', '2011-08-18 04:39:19', 'afixi.upendra@gmail.com', 0),
(351, 2, '117.197.253.132', '2011-08-18 04:39:20', 'jagannath@mail.afixiindia.com', 0),
(352, 2, '117.197.253.132', '2011-08-18 04:46:02', 'jagannath@mail.afixiindia.com', 0),
(353, 34, '117.197.253.132', '2011-08-18 04:54:42', 'afixi.satya@gmail.com', 0),
(354, 34, '117.197.253.132', '2011-08-18 04:55:31', 'afixi.satya@gmail.com', 0),
(355, 34, '117.197.253.132', '2011-08-18 04:57:32', 'afixi.satya@gmail.com', 0),
(356, 2, '117.197.253.132', '2011-08-18 05:01:41', 'jagannath@mail.afixiindia.com', 0),
(357, 34, '117.197.253.132', '2011-08-18 05:50:17', 'afixi.satya@gmail.com', 0),
(358, 24, '117.197.253.132', '2011-08-18 05:51:44', 'afixi.upendra@gmail.com', 0),
(359, 24, '117.197.253.132', '2011-08-18 05:52:53', 'afixi.upendra@gmail.com', 0),
(360, 24, '117.197.253.132', '2011-08-18 05:54:44', 'afixi.upendra@gmail.com', 0),
(361, 24, '117.197.253.132', '2011-08-18 05:57:55', 'afixi.upendra@gmail.com', 0),
(362, 24, '117.197.253.132', '2011-08-18 05:59:09', 'afixi.upendra@gmail.com', 0),
(363, 24, '117.197.253.132', '2011-08-18 06:10:36', 'afixi.upendra@gmail.com', 0),
(364, 2, '117.197.253.132', '2011-08-18 06:14:01', 'jagannath@mail.afixiindia.com', 0),
(365, 2, '117.197.253.132', '2011-08-18 06:15:04', 'jagannath@mail.afixiindia.com', 0),
(366, 1, '117.197.253.132', '2011-08-18 06:28:32', 'sabri@mail.afixiindia.com', 0),
(367, 2, '117.197.253.132', '2011-08-18 06:53:45', 'jagannath@mail.afixiindia.com', 0),
(368, 2, '117.197.253.132', '2011-08-18 07:26:00', 'jagannath@mail.afixiindia.com', 0),
(369, 34, '117.197.232.204', '2011-08-18 20:56:54', 'afixi.satya@gmail.com', 0),
(370, 34, '117.197.232.204', '2011-08-18 20:59:19', 'afixi.satya@gmail.com', 0),
(371, 34, '117.197.232.204', '2011-08-18 20:59:28', 'afixi.satya@gmail.com', 0),
(372, 2, '117.197.232.204', '2011-08-18 21:02:48', 'jagannath@mail.afixiindia.com', 0),
(373, 24, '117.197.232.204', '2011-08-18 21:08:27', 'afixi.upendra@gmail.com', 0),
(374, 24, '117.197.232.204', '2011-08-18 21:09:55', 'afixi.upendra@gmail.com', 0),
(375, 24, '117.197.232.204', '2011-08-18 21:10:49', 'afixi.upendra@gmail.com', 0),
(376, 2, '117.197.232.204', '2011-08-18 21:19:47', 'jagannath@mail.afixiindia.com', 0),
(377, 34, '117.197.232.204', '2011-08-18 21:20:37', 'afixi.satya@gmail.com', 0),
(378, 34, '117.197.232.204', '2011-08-18 21:21:36', 'afixi.satya@gmail.com', 0),
(379, 24, '117.197.232.204', '2011-08-18 21:22:41', 'afixi.upendra@gmail.com', 0),
(380, 34, '117.197.232.204', '2011-08-18 21:26:41', 'afixi.satya@gmail.com', 0),
(381, 24, '117.197.232.204', '2011-08-18 21:35:02', 'afixi.upendra@gmail.com', 0),
(382, 2, '117.197.232.204', '2011-08-18 21:35:06', 'jagannath@mail.afixiindia.com', 0),
(383, 1, '117.197.232.204', '2011-08-18 21:37:35', 'sabri@mail.afixiindia.com', 0),
(384, 1, '117.197.232.204', '2011-08-18 21:43:28', 'sabri@mail.afixiindia.com', 0),
(385, 1, '117.197.232.204', '2011-08-18 21:52:06', 'sabri@mail.afixiindia.com', 0),
(386, 5, '117.197.232.204', '2011-08-18 21:53:02', 'biswa@mail.afixiindia.com', 0),
(387, 5, '117.197.232.204', '2011-08-18 21:54:54', 'biswa@mail.afixiindia.com', 0),
(388, 2, '117.197.232.204', '2011-08-18 22:04:56', 'jagannath@mail.afixiindia.com', 0),
(389, 5, '117.197.232.204', '2011-08-18 22:10:09', 'biswa@mail.afixiindia.com', 0),
(390, 5, '117.197.232.204', '2011-08-18 22:11:09', 'biswa@mail.afixiindia.com', 0),
(391, 2, '117.197.232.204', '2011-08-18 22:14:05', 'jagannath@mail.afixiindia.com', 0),
(392, 1, '117.197.232.204', '2011-08-18 22:17:22', 'sabri@mail.afixiindia.com', 0),
(393, 1, '117.197.232.204', '2011-08-18 22:24:22', 'sabri@mail.afixiindia.com', 0),
(394, 2, '117.197.232.204', '2011-08-18 22:29:28', 'jagannath@mail.afixiindia.com', 0),
(395, 2, '117.197.232.204', '2011-08-18 22:40:48', 'jagannath@mail.afixiindia.com', 0),
(396, 1, '117.197.232.204', '2011-08-18 22:41:21', 'sabri@mail.afixiindia.com', 0),
(397, 3, '117.197.232.204', '2011-08-18 22:43:27', 'tanmaya@mail.afixiindia.com', 0),
(398, 24, '117.197.232.204', '2011-08-18 22:53:15', 'afixi.upendra@gmail.com', 0),
(399, 2, '117.197.232.204', '2011-08-18 22:59:39', 'jagannath@mail.afixiindia.com', 0),
(400, 34, '117.197.232.204', '2011-08-18 23:06:48', 'afixi.satya@gmail.com', 0),
(401, 34, '117.197.232.204', '2011-08-18 23:07:28', 'afixi.satya@gmail.com', 0),
(402, 34, '117.197.232.204', '2011-08-18 23:11:00', 'afixi.satya@gmail.com', 0),
(403, 34, '117.197.232.204', '2011-08-18 23:47:34', 'afixi.satya@gmail.com', 0),
(404, 4, '117.197.232.204', '2011-08-19 00:06:47', 'upendra@mail.afixiindia.com', 0),
(405, 4, '117.197.232.204', '2011-08-19 00:12:33', 'upendra@mail.afixiindia.com', 0),
(406, 1, '117.197.232.204', '2011-08-19 00:17:22', 'sabri@mail.afixiindia.com', 0),
(407, 2, '117.197.232.204', '2011-08-19 00:30:47', 'jagannath@mail.afixiindia.com', 0),
(408, 4, '117.197.232.204', '2011-08-19 00:32:49', 'upendra@mail.afixiindia.com', 0),
(409, 34, '117.197.232.204', '2011-08-19 00:58:46', 'afixi.satya@gmail.com', 0),
(410, 1, '108.205.200.122', '2011-08-19 01:11:15', 'sabri@mail.afixiindia.com', 0),
(411, 1, '76.216.21.176', '2011-08-19 01:43:36', 'sabri@mail.afixiindia.com', 0),
(412, 34, '117.197.249.49', '2011-08-19 01:52:01', 'afixi.satya@gmail.com', 0),
(413, 34, '117.197.249.49', '2011-08-19 01:52:17', 'afixi.satya@gmail.com', 0),
(414, 1, '117.197.249.49', '2011-08-19 01:59:36', 'sabri@mail.afixiindia.com', 0),
(415, 34, '117.197.249.49', '2011-08-19 02:10:29', 'afixi.satya@gmail.com', 0),
(416, 34, '117.197.249.49', '2011-08-19 02:14:09', 'afixi.satya@gmail.com', 0),
(417, 34, '117.197.249.49', '2011-08-19 02:18:20', 'afixi.satya@gmail.com', 0),
(418, 3, '117.197.249.49', '2011-08-19 02:20:31', 'tanmaya@mail.afixiindia.com', 0),
(419, 2, '117.197.249.49', '2011-08-19 02:24:25', 'jagannath@mail.afixiindia.com', 0),
(420, 35, '67.160.197.181', '2011-08-19 02:25:33', 'lol.i.laugh@gmail.com', 0),
(421, 2, '117.197.249.49', '2011-08-19 02:26:12', 'jagannath@mail.afixiindia.com', 0),
(422, 1, '117.197.249.49', '2011-08-19 03:06:17', 'sabri@mail.afixiindia.com', 0),
(423, 34, '117.197.249.49', '2011-08-19 03:22:25', 'afixi.satya@gmail.com', 0),
(424, 2, '117.197.249.49', '2011-08-19 03:34:46', 'jagannath@mail.afixiindia.com', 0),
(425, 2, '117.197.249.49', '2011-08-19 03:47:56', 'jagannath@mail.afixiindia.com', 0),
(426, 34, '117.197.249.49', '2011-08-19 04:08:30', 'afixi.satya@gmail.com', 0),
(427, 2, '117.197.249.49', '2011-08-19 05:52:58', 'jagannath@mail.afixiindia.com', 0),
(428, 1, '117.197.249.49', '2011-08-19 05:55:23', 'sabri@mail.afixiindia.com', 0),
(429, 34, '117.197.249.49', '2011-08-19 06:25:51', 'afixi.satya@gmail.com', 0),
(430, 2, '117.197.249.49', '2011-08-19 06:27:59', 'jagannath@mail.afixiindia.com', 0),
(431, 34, '117.197.249.49', '2011-08-19 06:45:39', 'afixi.satya@gmail.com', 0),
(432, 34, '117.197.235.93', '2011-08-19 20:56:41', 'afixi.satya@gmail.com', 0),
(433, 34, '117.197.235.93', '2011-08-19 20:56:56', 'afixi.satya@gmail.com', 0),
(434, 1, '117.197.235.93', '2011-08-19 21:01:22', 'sabri@mail.afixiindia.com', 0),
(435, 1, '117.197.235.93', '2011-08-19 21:07:52', 'sabri@mail.afixiindia.com', 0),
(436, 34, '117.197.235.93', '2011-08-19 21:09:31', 'afixi.satya@gmail.com', 0),
(437, 34, '117.197.235.93', '2011-08-19 21:18:18', 'afixi.satya@gmail.com', 0),
(438, 34, '117.197.235.93', '2011-08-19 21:20:44', 'afixi.satya@gmail.com', 0),
(439, 1, '117.197.235.93', '2011-08-19 21:23:36', 'sabri@mail.afixiindia.com', 0),
(440, 2, '117.197.244.133', '2011-08-19 23:19:00', 'jagannath@mail.afixiindia.com', 0),
(441, 1, '76.216.22.128', '2011-08-19 23:24:03', 'sabri@mail.afixiindia.com', 0),
(442, 2, '117.197.244.133', '2011-08-19 23:38:44', 'jagannath@mail.afixiindia.com', 0),
(443, 2, '76.216.22.128', '2011-08-19 23:41:33', 'jagannath@mail.afixiindia.com', 0),
(444, 3, '76.216.22.128', '2011-08-19 23:49:04', 'tanmaya@mail.afixiindia.com', 0),
(445, 34, '117.197.244.133', '2011-08-19 23:51:01', 'afixi.satya@gmail.com', 0),
(446, 34, '117.197.244.133', '2011-08-19 23:53:09', 'afixi.satya@gmail.com', 0),
(447, 34, '117.197.244.133', '2011-08-19 23:54:22', 'afixi.satya@gmail.com', 0),
(448, 2, '76.216.22.128', '2011-08-20 00:10:13', 'jagannath@mail.afixiindia.com', 0),
(449, 2, '117.197.244.133', '2011-08-20 00:14:24', 'jagannath@mail.afixiindia.com', 0),
(450, 1, '117.197.244.133', '2011-08-20 00:15:12', 'sabri@mail.afixiindia.com', 0),
(451, 1, '117.197.244.133', '2011-08-20 00:16:11', 'sabri@mail.afixiindia.com', 0),
(452, 2, '117.197.244.133', '2011-08-20 00:18:06', 'jagannath@mail.afixiindia.com', 0),
(453, 3, '117.197.244.133', '2011-08-20 00:28:05', 'tanmaya@mail.afixiindia.com', 0),
(454, 2, '117.197.244.133', '2011-08-20 00:58:40', 'jagannath@mail.afixiindia.com', 0),
(455, 2, '117.201.160.57', '2011-08-20 02:43:26', 'jagannath@mail.afixiindia.com', 0),
(456, 34, '117.201.160.57', '2011-08-20 03:42:56', 'afixi.satya@gmail.com', 0),
(457, 34, '117.201.160.57', '2011-08-20 03:47:35', 'afixi.satya@gmail.com', 0),
(458, 3, '117.201.160.57', '2011-08-20 05:05:08', 'tanmaya@mail.afixiindia.com', 0),
(459, 34, '117.201.160.57', '2011-08-20 05:47:32', 'afixi.satya@gmail.com', 0),
(460, 34, '117.201.160.57', '2011-08-20 05:47:41', 'afixi.satya@gmail.com', 0),
(461, 34, '117.201.160.57', '2011-08-20 06:04:07', 'afixi.satya@gmail.com', 0),
(462, 1, '117.201.160.57', '2011-08-20 06:09:50', 'sabri@mail.afixiindia.com', 0),
(463, 3, '117.201.160.57', '2011-08-20 06:39:34', 'tanmaya@mail.afixiindia.com', 0),
(464, 2, '117.201.160.57', '2011-08-20 06:57:45', 'jagannath@mail.afixiindia.com', 0),
(465, 3, '117.201.160.57', '2011-08-20 06:59:21', 'tanmaya@mail.afixiindia.com', 0),
(466, 3, '117.201.160.57', '2011-08-20 07:03:49', 'tanmaya@mail.afixiindia.com', 0),
(467, 4, '117.201.160.57', '2011-08-20 07:07:47', 'upendra@mail.afixiindia.com', 0),
(468, 1, '117.201.160.57', '2011-08-20 07:23:48', 'sabri@mail.afixiindia.com', 0),
(469, 1, '117.201.160.57', '2011-08-20 07:57:35', 'sabri@mail.afixiindia.com', 0),
(470, 2, '76.230.233.90', '2011-08-20 15:52:53', 'jagannath@mail.afixiindia.com', 0),
(471, 1, '198.94.221.87', '2011-08-20 17:15:18', 'sabri@mail.afixiindia.com', 0),
(472, 35, '198.94.221.87', '2011-08-20 17:16:49', 'lol.i.laugh@gmail.com', 0),
(473, 1, '198.94.221.87', '2011-08-20 17:45:53', 'sabri@mail.afixiindia.com', 0),
(474, 36, '198.94.221.87', '2011-08-20 17:47:10', 'muazs786@gmail.com', 0),
(475, 36, '108.205.200.122', '2011-08-20 18:17:33', 'muazs786@gmail.com', 0),
(476, 2, '122.50.131.173', '2011-08-20 21:36:33', 'jagannath@mail.afixiindia.com', 0),
(477, 2, '122.50.131.173', '2011-08-20 21:36:35', 'jagannath@mail.afixiindia.com', 0),
(478, 36, '108.205.200.122', '2011-08-20 22:48:33', 'muazs786@gmail.com', 0),
(479, 2, '76.230.233.90', '2011-08-20 23:14:26', 'jagannath@mail.afixiindia.com', 0),
(480, 2, '122.50.131.165', '2011-08-21 18:32:15', 'jagannath@mail.afixiindia.com', 0),
(481, 2, '117.197.233.113', '2011-08-21 20:50:41', 'jagannath@mail.afixiindia.com', 0),
(482, 34, '117.197.233.113', '2011-08-21 21:01:18', 'afixi.satya@gmail.com', 0),
(483, 34, '117.197.233.113', '2011-08-21 21:01:54', 'afixi.satya@gmail.com', 0),
(484, 34, '117.197.233.113', '2011-08-21 21:20:21', 'afixi.satya@gmail.com', 0),
(485, 34, '117.197.233.113', '2011-08-21 21:21:00', 'afixi.satya@gmail.com', 0),
(486, 1, '117.197.233.113', '2011-08-21 21:43:09', 'sabri@mail.afixiindia.com', 0),
(487, 3, '117.197.233.113', '2011-08-21 21:56:20', 'tanmaya@mail.afixiindia.com', 0),
(488, 3, '117.197.233.113', '2011-08-21 22:03:15', 'tanmaya@mail.afixiindia.com', 0),
(489, 4, '117.197.233.113', '2011-08-21 22:24:50', 'upendra@mail.afixiindia.com', 0),
(490, 2, '117.197.233.113', '2011-08-21 22:25:34', 'jagannath@mail.afixiindia.com', 0),
(491, 1, '117.197.233.113', '2011-08-21 22:28:21', 'sabri@mail.afixiindia.com', 0),
(492, 8, '117.197.233.113', '2011-08-21 22:34:57', 'arun@mail.afixiindia.com', 0),
(493, 2, '117.197.233.113', '2011-08-21 22:52:45', 'jagannath@mail.afixiindia.com', 0),
(494, 2, '117.197.233.113', '2011-08-21 23:30:39', 'jagannath@mail.afixiindia.com', 0),
(495, 35, '67.160.197.181', '2011-08-21 23:32:34', 'lol.i.laugh@gmail.com', 0),
(496, 5, '117.197.233.113', '2011-08-21 23:39:00', 'biswa@mail.afixiindia.com', 0),
(497, 5, '117.197.233.113', '2011-08-21 23:41:16', 'biswa@mail.afixiindia.com', 0),
(498, 5, '117.197.233.113', '2011-08-22 00:00:28', 'biswa@mail.afixiindia.com', 0),
(499, 34, '117.197.233.113', '2011-08-22 00:03:15', 'afixi.satya@gmail.com', 0),
(500, 34, '117.197.233.113', '2011-08-22 00:04:10', 'afixi.satya@gmail.com', 0),
(501, 3, '117.197.233.113', '2011-08-22 00:04:47', 'tanmaya@mail.afixiindia.com', 0),
(502, 2, '117.197.233.113', '2011-08-22 00:08:17', 'jagannath@mail.afixiindia.com', 0),
(503, 32, '117.197.233.113', '2011-08-22 00:27:54', 'afixi.jagannath@gmail.com', 0),
(504, 2, '117.197.233.113', '2011-08-22 00:35:12', 'jagannath@mail.afixiindia.com', 0),
(505, 4, '117.197.233.113', '2011-08-22 00:47:24', 'upendra@mail.afixiindia.com', 0),
(506, 8, '117.197.233.113', '2011-08-22 00:50:24', 'arun@mail.afixiindia.com', 0),
(507, 5, '117.197.233.113', '2011-08-22 00:55:45', 'biswa@mail.afixiindia.com', 0),
(508, 8, '117.197.233.113', '2011-08-22 00:57:49', 'arun@mail.afixiindia.com', 0),
(509, 2, '117.197.233.113', '2011-08-22 01:00:35', 'jagannath@mail.afixiindia.com', 0),
(510, 34, '117.197.233.113', '2011-08-22 01:00:46', 'afixi.satya@gmail.com', 0),
(511, 34, '117.197.233.113', '2011-08-22 01:01:01', 'afixi.satya@gmail.com', 0),
(512, 4, '117.197.233.113', '2011-08-22 01:01:28', 'upendra@mail.afixiindia.com', 0),
(513, 4, '117.197.233.113', '2011-08-22 01:06:59', 'upendra@mail.afixiindia.com', 0),
(514, 8, '117.197.233.113', '2011-08-22 01:07:32', 'arun@mail.afixiindia.com', 0),
(515, 4, '117.197.233.113', '2011-08-22 01:08:36', 'upendra@mail.afixiindia.com', 0),
(516, 8, '117.201.162.22', '2011-08-22 02:11:46', 'arun@mail.afixiindia.com', 0),
(517, 4, '117.201.162.22', '2011-08-22 02:16:03', 'upendra@mail.afixiindia.com', 0),
(518, 5, '117.201.162.22', '2011-08-22 02:17:45', 'biswa@mail.afixiindia.com', 0),
(519, 10, '117.201.162.22', '2011-08-22 02:36:35', 'prabhu@mail.afixiindia.com', 0),
(520, 34, '117.201.162.22', '2011-08-22 02:36:58', 'afixi.satya@gmail.com', 0),
(521, 1, '117.201.162.22', '2011-08-22 03:05:46', 'sabri@mail.afixiindia.com', 0),
(522, 2, '117.201.162.22', '2011-08-22 04:17:03', 'jagannath@mail.afixiindia.com', 0),
(523, 10, '117.201.162.22', '2011-08-22 04:19:21', 'prabhu@mail.afixiindia.com', 0),
(524, 10, '117.197.255.101', '2011-08-22 04:43:43', 'prabhu@mail.afixiindia.com', 0),
(525, 34, '117.197.255.101', '2011-08-22 04:51:44', 'afixi.satya@gmail.com', 0),
(526, 34, '117.197.255.101', '2011-08-22 05:07:30', 'afixi.satya@gmail.com', 0),
(527, 34, '117.197.255.101', '2011-08-22 05:08:31', 'afixi.satya@gmail.com', 0),
(528, 3, '117.197.255.101', '2011-08-22 06:17:45', 'tanmaya@mail.afixiindia.com', 0),
(529, 5, '117.197.255.101', '2011-08-22 06:25:02', 'biswa@mail.afixiindia.com', 0),
(530, 5, '117.197.255.101', '2011-08-22 06:36:33', 'biswa@mail.afixiindia.com', 0),
(531, 3, '117.197.255.101', '2011-08-22 06:46:36', 'tanmaya@mail.afixiindia.com', 0),
(532, 2, '117.197.255.101', '2011-08-22 07:29:24', 'jagannath@mail.afixiindia.com', 0),
(533, 23, '122.50.128.100', '2011-08-22 10:53:35', 'jagannath.behera104@gmail.com', 0),
(534, 2, '122.50.128.100', '2011-08-22 10:59:13', 'jagannath@mail.afixiindia.com', 0),
(535, 3, '122.50.128.100', '2011-08-22 11:04:38', 'tanmaya@mail.afixiindia.com', 0),
(536, 3, '122.50.128.100', '2011-08-22 12:04:12', 'tanmaya@mail.afixiindia.com', 0),
(537, 4, '122.50.128.100', '2011-08-22 12:31:59', 'upendra@mail.afixiindia.com', 0),
(538, 3, '122.50.128.100', '2011-08-22 12:35:41', 'tanmaya@mail.afixiindia.com', 0),
(539, 4, '122.50.128.100', '2011-08-22 12:36:00', 'upendra@mail.afixiindia.com', 0),
(540, 10, '122.50.128.100', '2011-08-22 12:52:00', 'prabhu@mail.afixiindia.com', 0),
(541, 10, '122.50.128.100', '2011-08-22 13:55:40', 'prabhu@mail.afixiindia.com', 0),
(542, 36, '198.94.221.87', '2011-08-22 15:16:59', 'muazs786@gmail.com', 0),
(543, 2, '75.36.203.175', '2011-08-22 17:53:56', 'jagannath@mail.afixiindia.com', 0),
(544, 1, '117.197.243.122', '2011-08-22 21:02:11', 'sabri@mail.afixiindia.com', 0),
(545, 34, '117.197.243.122', '2011-08-22 21:23:17', 'afixi.satya@gmail.com', 0),
(546, 10, '117.197.243.122', '2011-08-22 21:27:06', 'prabhu@mail.afixiindia.com', 0),
(547, 3, '117.197.243.122', '2011-08-22 21:27:31', 'tanmaya@mail.afixiindia.com', 0),
(548, 2, '117.197.243.122', '2011-08-22 21:57:09', 'jagannath@mail.afixiindia.com', 0),
(549, 3, '117.197.243.122', '2011-08-22 21:59:40', 'tanmaya@mail.afixiindia.com', 0),
(550, 1, '117.197.243.122', '2011-08-22 22:01:09', 'sabri@mail.afixiindia.com', 0),
(551, 3, '117.197.243.122', '2011-08-22 22:04:02', 'tanmaya@mail.afixiindia.com', 0),
(552, 2, '117.197.243.122', '2011-08-22 22:14:52', 'jagannath@mail.afixiindia.com', 0),
(553, 3, '117.197.243.122', '2011-08-22 22:19:42', 'tanmaya@mail.afixiindia.com', 0),
(554, 2, '117.197.243.122', '2011-08-22 22:28:36', 'jagannath@mail.afixiindia.com', 0),
(555, 3, '117.197.243.122', '2011-08-22 22:32:28', 'tanmaya@mail.afixiindia.com', 0),
(556, 4, '117.197.243.122', '2011-08-22 22:53:21', 'upendra@mail.afixiindia.com', 0),
(557, 2, '117.197.243.122', '2011-08-22 22:54:05', 'jagannath@mail.afixiindia.com', 0),
(558, 10, '117.197.253.54', '2011-08-22 23:33:13', 'prabhu@mail.afixiindia.com', 0),
(559, 3, '117.197.253.54', '2011-08-22 23:34:28', 'tanmaya@mail.afixiindia.com', 0),
(560, 34, '117.197.253.54', '2011-08-22 23:39:52', 'afixi.satya@gmail.com', 0),
(561, 34, '117.197.253.54', '2011-08-22 23:54:24', 'afixi.satya@gmail.com', 0),
(562, 4, '117.197.253.54', '2011-08-23 00:40:50', 'upendra@mail.afixiindia.com', 0),
(563, 34, '117.197.253.54', '2011-08-23 02:18:33', 'afixi.satya@gmail.com', 0),
(564, 10, '117.197.253.54', '2011-08-23 02:18:49', 'prabhu@mail.afixiindia.com', 0),
(565, 3, '117.197.253.54', '2011-08-23 02:19:29', 'tanmaya@mail.afixiindia.com', 0),
(566, 4, '117.197.253.54', '2011-08-23 03:00:30', 'upendra@mail.afixiindia.com', 0),
(567, 2, '117.197.253.54', '2011-08-23 04:01:38', 'jagannath@mail.afixiindia.com', 0),
(568, 34, '117.197.253.54', '2011-08-23 04:47:43', 'afixi.satya@gmail.com', 0),
(569, 1, '117.197.253.54', '2011-08-23 05:02:23', 'sabri@mail.afixiindia.com', 0),
(570, 1, '117.197.253.54', '2011-08-23 05:06:04', 'sabri@mail.afixiindia.com', 0),
(571, 2, '117.201.166.170', '2011-08-23 05:31:01', 'jagannath@mail.afixiindia.com', 0),
(572, 10, '117.201.166.170', '2011-08-23 05:33:02', 'prabhu@mail.afixiindia.com', 0),
(573, 34, '117.201.166.170', '2011-08-23 05:33:31', 'afixi.satya@gmail.com', 0),
(574, 3, '117.201.166.170', '2011-08-23 05:34:53', 'tanmaya@mail.afixiindia.com', 0),
(575, 4, '117.201.166.170', '2011-08-23 06:13:58', 'upendra@mail.afixiindia.com', 0),
(576, 2, '117.201.166.170', '2011-08-23 06:16:34', 'jagannath@mail.afixiindia.com', 0),
(577, 3, '117.201.166.170', '2011-08-23 06:22:31', 'tanmaya@mail.afixiindia.com', 0),
(578, 6, '117.201.166.170', '2011-08-23 06:44:48', 'jitendra@mail.afixiindia.com', 0),
(579, 36, '108.205.200.122', '2011-08-23 10:23:12', 'muazs786@gmail.com', 0),
(580, 2, '75.36.207.218', '2011-08-23 13:48:05', 'jagannath@mail.afixiindia.com', 0),
(581, 36, '108.205.200.122', '2011-08-23 17:05:31', 'muazs786@gmail.com', 0),
(582, 1, '75.36.207.218', '2011-08-23 18:20:45', 'sabri@mail.afixiindia.com', 0),
(583, 1, '75.36.207.218', '2011-08-23 18:22:04', 'sabri@mail.afixiindia.com', 0),
(584, 2, '75.36.207.218', '2011-08-23 18:22:35', 'jagannath@mail.afixiindia.com', 0),
(585, 10, '117.197.242.69', '2011-08-23 21:09:54', 'prabhu@mail.afixiindia.com', 0),
(586, 34, '117.201.160.173', '2011-08-23 21:27:01', 'afixi.satya@gmail.com', 0),
(587, 4, '117.201.160.173', '2011-08-23 21:27:51', 'upendra@mail.afixiindia.com', 0),
(588, 3, '117.201.160.173', '2011-08-23 21:32:39', 'tanmaya@mail.afixiindia.com', 0),
(589, 2, '117.201.160.173', '2011-08-23 21:35:59', 'jagannath@mail.afixiindia.com', 0),
(590, 6, '117.201.160.173', '2011-08-23 21:39:01', 'jitendra@mail.afixiindia.com', 0),
(591, 4, '117.201.160.173', '2011-08-23 21:42:48', 'upendra@mail.afixiindia.com', 0),
(592, 5, '117.201.160.173', '2011-08-23 21:46:24', 'biswa@mail.afixiindia.com', 0),
(593, 3, '117.201.160.173', '2011-08-23 21:48:37', 'tanmaya@mail.afixiindia.com', 0),
(594, 4, '117.201.160.173', '2011-08-23 21:49:44', 'upendra@mail.afixiindia.com', 0),
(595, 4, '117.201.160.173', '2011-08-23 22:32:27', 'upendra@mail.afixiindia.com', 0),
(596, 2, '117.201.160.173', '2011-08-23 22:33:21', 'jagannath@mail.afixiindia.com', 0),
(597, 3, '117.201.160.173', '2011-08-23 23:17:33', 'tanmaya@mail.afixiindia.com', 0),
(598, 3, '173.254.204.155', '2011-08-24 02:32:13', 'tanmaya@mail.afixiindia.com', 0),
(599, 3, '117.197.236.115', '2011-08-24 06:20:35', 'tanmaya@mail.afixiindia.com', 0),
(600, 10, '117.197.236.115', '2011-08-24 06:20:53', 'prabhu@mail.afixiindia.com', 0),
(601, 34, '117.197.236.115', '2011-08-24 06:21:36', 'afixi.satya@gmail.com', 0),
(602, 2, '117.197.236.115', '2011-08-24 06:39:54', 'jagannath@mail.afixiindia.com', 0),
(603, 2, '117.197.236.115', '2011-08-24 06:41:30', 'jagannath@mail.afixiindia.com', 0),
(604, 2, '204.28.119.130', '2011-08-24 13:13:02', 'jagannath@mail.afixiindia.com', 0),
(605, 35, '67.160.197.181', '2011-08-24 16:21:17', 'lol.i.laugh@gmail.com', 0),
(606, 3, '67.160.197.181', '2011-08-24 16:21:18', 'tanmaya@mail.afixiindia.com', 0),
(607, 2, '204.28.119.130', '2011-08-24 18:15:14', 'jagannath@mail.afixiindia.com', 0),
(608, 2, '204.28.119.130', '2011-08-24 18:51:52', 'jagannath@mail.afixiindia.com', 0),
(609, 35, '67.160.197.181', '2011-08-24 18:54:59', 'lol.i.laugh@gmail.com', 0),
(610, 1, '204.28.119.130', '2011-08-24 18:58:24', 'sabri@mail.afixiindia.com', 0);
INSERT INTO `memeje__login` (`id_login`, `id_user`, `ip`, `date_login`, `email`, `failure_attempt`) VALUES
(611, 32, '117.197.238.70', '2011-08-24 21:30:23', 'afixi.jagannath@gmail.com', 0),
(612, 10, '117.197.238.70', '2011-08-24 21:50:20', 'prabhu@mail.afixiindia.com', 0),
(613, 34, '117.197.238.70', '2011-08-24 21:50:51', 'afixi.satya@gmail.com', 0),
(614, 1, '204.28.119.130', '2011-08-24 22:44:42', 'sabri@mail.afixiindia.com', 0),
(615, 2, '117.197.238.70', '2011-08-25 00:12:58', 'jagannath@mail.afixiindia.com', 0),
(616, 1, '204.28.119.130', '2011-08-25 00:23:18', 'sabri@mail.afixiindia.com', 0),
(617, 32, '117.201.144.40', '2011-08-25 00:39:00', 'afixi.jagannath@gmail.com', 0),
(618, 10, '117.201.144.40', '2011-08-25 03:09:52', 'prabhu@mail.afixiindia.com', 0),
(619, 34, '117.201.144.40', '2011-08-25 03:10:44', 'afixi.satya@gmail.com', 0),
(620, 3, '117.201.144.40', '2011-08-25 03:15:02', 'tanmaya@mail.afixiindia.com', 0),
(621, 1, '117.201.153.145', '2011-08-25 05:55:51', 'sabri@mail.afixiindia.com', 0),
(622, 2, '117.197.237.8', '2011-08-25 07:34:19', 'jagannath@mail.afixiindia.com', 0),
(623, 23, '117.197.237.8', '2011-08-25 07:57:27', 'jagannath.behera104@gmail.com', 0),
(624, 2, '122.50.129.252', '2011-08-25 10:13:55', 'jagannath@mail.afixiindia.com', 0),
(625, 1, '136.152.179.136', '2011-08-25 12:59:22', 'sabri@mail.afixiindia.com', 0),
(626, 2, '136.152.138.47', '2011-08-25 14:11:49', 'jagannath@mail.afixiindia.com', 0),
(627, 35, '67.160.197.181', '2011-08-25 14:31:14', 'lol.i.laugh@gmail.com', 0),
(628, 3, '67.160.197.181', '2011-08-25 14:31:14', 'tanmaya@mail.afixiindia.com', 0),
(629, 2, '136.152.138.47', '2011-08-25 14:57:58', 'jagannath@mail.afixiindia.com', 0),
(630, 35, '67.160.197.181', '2011-08-25 15:01:07', 'lol.i.laugh@gmail.com', 0),
(631, 2, '204.28.119.130', '2011-08-25 18:04:38', 'jagannath@mail.afixiindia.com', 0),
(632, 35, '67.160.197.181', '2011-08-25 20:46:06', 'lol.i.laugh@gmail.com', 0),
(633, 3, '67.160.197.181', '2011-08-25 20:46:07', 'tanmaya@mail.afixiindia.com', 0),
(634, 4, '117.197.233.105', '2011-08-25 21:06:07', 'upendra@mail.afixiindia.com', 0),
(635, 3, '117.197.233.105', '2011-08-25 21:08:56', 'tanmaya@mail.afixiindia.com', 0),
(636, 10, '117.197.233.105', '2011-08-25 21:14:16', 'prabhu@mail.afixiindia.com', 0),
(637, 3, '117.197.233.105', '2011-08-25 21:14:40', 'tanmaya@mail.afixiindia.com', 0),
(638, 2, '117.197.233.105', '2011-08-25 21:18:40', 'jagannath@mail.afixiindia.com', 0),
(639, 10, '117.197.233.105', '2011-08-25 21:23:33', 'prabhu@mail.afixiindia.com', 0),
(640, 3, '117.197.233.105', '2011-08-25 21:24:28', 'tanmaya@mail.afixiindia.com', 0),
(641, 2, '117.197.233.105', '2011-08-25 21:30:26', 'jagannath@mail.afixiindia.com', 0),
(642, 32, '117.197.233.105', '2011-08-25 21:31:15', 'afixi.jagannath@gmail.com', 0),
(643, 2, '117.197.233.105', '2011-08-25 21:32:17', 'jagannath@mail.afixiindia.com', 0),
(644, 1, '117.197.233.105', '2011-08-25 21:33:20', 'sabri@mail.afixiindia.com', 0),
(645, 10, '117.197.233.105', '2011-08-25 21:33:51', 'prabhu@mail.afixiindia.com', 0),
(646, 3, '117.197.233.105', '2011-08-25 21:36:34', 'tanmaya@mail.afixiindia.com', 0),
(647, 1, '117.197.233.105', '2011-08-25 21:47:09', 'sabri@mail.afixiindia.com', 0),
(648, 4, '117.197.233.105', '2011-08-25 21:54:40', 'upendra@mail.afixiindia.com', 0),
(649, 10, '117.197.233.105', '2011-08-25 21:55:19', 'prabhu@mail.afixiindia.com', 0),
(650, 1, '117.197.233.105', '2011-08-25 23:31:55', 'sabri@mail.afixiindia.com', 0),
(651, 2, '75.36.207.218', '2011-08-26 00:37:23', 'jagannath@mail.afixiindia.com', 0),
(652, 2, '117.201.162.225', '2011-08-26 03:43:19', 'jagannath@mail.afixiindia.com', 0),
(653, 3, '117.201.162.225', '2011-08-26 04:14:38', 'tanmaya@mail.afixiindia.com', 0),
(654, 4, '117.201.162.225', '2011-08-26 04:17:13', 'upendra@mail.afixiindia.com', 0),
(655, 3, '117.201.162.225', '2011-08-26 04:40:33', 'tanmaya@mail.afixiindia.com', 0),
(656, 4, '117.201.162.225', '2011-08-26 05:35:21', 'upendra@mail.afixiindia.com', 0),
(657, 35, '67.160.197.181', '2011-08-26 16:16:09', 'lol.i.laugh@gmail.com', 0),
(658, 2, '75.36.207.218', '2011-08-26 18:03:54', 'jagannath@mail.afixiindia.com', 0),
(659, 35, '204.28.119.168', '2011-08-26 21:04:06', 'lol.i.laugh@gmail.com', 0),
(660, 2, '204.28.119.130', '2011-08-26 21:57:28', 'jagannath@mail.afixiindia.com', 0),
(661, 35, '204.28.119.168', '2011-08-27 14:39:41', 'lol.i.laugh@gmail.com', 0),
(662, 2, '122.50.138.45', '2011-08-27 21:56:00', 'jagannath@mail.afixiindia.com', 0),
(663, 32, '117.197.251.81', '2011-08-28 21:28:07', 'afixi.jagannath@gmail.com', 0),
(664, 35, '67.160.197.181', '2011-08-28 22:37:55', 'lol.i.laugh@gmail.com', 0),
(665, 2, '204.28.119.130', '2011-08-28 23:39:46', 'jagannath@mail.afixiindia.com', 0),
(666, 2, '122.50.131.32', '2011-08-29 08:40:15', 'jagannath@mail.afixiindia.com', 0),
(667, 35, '157.22.13.245', '2011-08-29 11:49:04', 'lol.i.laugh@gmail.com', 0),
(668, 3, '157.22.13.245', '2011-08-29 11:49:05', 'tanmaya@mail.afixiindia.com', 0),
(669, 34, '117.197.241.237', '2011-08-29 21:30:26', 'afixi.satya@gmail.com', 0),
(670, 3, '117.197.241.237', '2011-08-29 21:31:17', 'tanmaya@mail.afixiindia.com', 0),
(671, 34, '117.197.241.237', '2011-08-29 21:38:12', 'afixi.satya@gmail.com', 0),
(672, 3, '117.197.241.237', '2011-08-29 21:54:08', 'tanmaya@mail.afixiindia.com', 0),
(673, 34, '117.197.241.237', '2011-08-29 22:52:06', 'afixi.satya@gmail.com', 0),
(674, 3, '117.197.241.237', '2011-08-29 22:52:14', 'tanmaya@mail.afixiindia.com', 0),
(675, 10, '117.197.241.237', '2011-08-29 22:52:39', 'prabhu@mail.afixiindia.com', 0),
(676, 1, '117.197.241.237', '2011-08-29 22:55:32', 'sabri@mail.afixiindia.com', 0),
(677, 10, '117.197.241.237', '2011-08-30 03:01:26', 'prabhu@mail.afixiindia.com', 0),
(678, 34, '117.197.241.237', '2011-08-30 03:01:54', 'afixi.satya@gmail.com', 0),
(679, 3, '117.197.241.237', '2011-08-30 03:17:49', 'tanmaya@mail.afixiindia.com', 0),
(680, 4, '117.197.241.237', '2011-08-30 03:18:51', 'upendra@mail.afixiindia.com', 0),
(681, 3, '117.197.241.237', '2011-08-30 05:34:26', 'tanmaya@mail.afixiindia.com', 0),
(682, 3, '117.197.241.237', '2011-08-30 05:46:44', 'tanmaya@mail.afixiindia.com', 0),
(683, 10, '117.201.163.17', '2011-08-30 06:27:59', 'prabhu@mail.afixiindia.com', 0),
(684, 3, '117.201.163.17', '2011-08-30 06:28:32', 'tanmaya@mail.afixiindia.com', 0),
(685, 2, '122.50.135.203', '2011-08-30 08:53:48', 'jagannath@mail.afixiindia.com', 0),
(686, 4, '27.48.32.47', '2011-08-31 11:08:39', 'upendra@mail.afixiindia.com', 0),
(687, 2, '122.50.131.42', '2011-09-01 08:10:55', 'jagannath@mail.afixiindia.com', 0),
(688, 3, '204.28.119.192', '2011-09-01 23:35:57', 'tanmaya@mail.afixiindia.com', 0),
(689, 2, '75.37.47.110', '2011-09-01 23:43:50', 'jagannath@mail.afixiindia.com', 0),
(690, 36, '204.28.119.192', '2011-09-02 00:10:41', 'muazs786@gmail.com', 0),
(691, 3, '204.28.119.192', '2011-09-02 00:22:50', 'tanmaya@mail.afixiindia.com', 0),
(692, 35, '204.28.119.192', '2011-09-02 00:26:17', 'lol.i.laugh@gmail.com', 0),
(693, 10, '117.201.165.160', '2011-09-02 02:18:12', 'prabhu@mail.afixiindia.com', 0),
(694, 34, '117.201.165.160', '2011-09-02 02:18:59', 'afixi.satya@gmail.com', 0),
(695, 2, '117.201.165.160', '2011-09-02 02:19:43', 'jagannath@mail.afixiindia.com', 0),
(696, 3, '117.201.165.160', '2011-09-02 02:24:42', 'tanmaya@mail.afixiindia.com', 0),
(697, 2, '117.201.165.160', '2011-09-02 02:26:18', 'jagannath@mail.afixiindia.com', 0),
(698, 2, '117.201.165.160', '2011-09-02 02:47:57', 'jagannath@mail.afixiindia.com', 0),
(699, 1, '117.201.165.160', '2011-09-02 02:48:28', 'sabri@mail.afixiindia.com', 0),
(700, 3, '117.201.165.160', '2011-09-02 02:53:36', 'tanmaya@mail.afixiindia.com', 0),
(701, 2, '117.201.165.160', '2011-09-02 03:15:23', 'jagannath@mail.afixiindia.com', 0),
(702, 34, '117.201.165.160', '2011-09-02 03:19:12', 'afixi.satya@gmail.com', 0),
(703, 2, '117.201.165.160', '2011-09-02 03:50:21', 'jagannath@mail.afixiindia.com', 0),
(704, 30, '117.201.165.160', '2011-09-02 04:59:25', 'biswal805@gmail.com', 0),
(705, 10, '117.201.165.160', '2011-09-02 05:57:31', 'prabhu@mail.afixiindia.com', 0),
(706, 2, '117.201.165.160', '2011-09-02 08:03:45', 'jagannath@mail.afixiindia.com', 0),
(707, 4, '117.201.165.160', '2011-09-02 08:21:01', 'upendra@mail.afixiindia.com', 0),
(708, 3, '117.201.165.160', '2011-09-02 08:31:35', 'tanmaya@mail.afixiindia.com', 0),
(709, 3, '117.201.165.160', '2011-09-02 08:34:19', 'tanmaya@mail.afixiindia.com', 0),
(710, 2, '117.201.165.160', '2011-09-02 08:35:40', 'jagannath@mail.afixiindia.com', 0),
(711, 2, '75.37.47.110', '2011-09-02 12:27:12', 'jagannath@mail.afixiindia.com', 0),
(712, 2, '75.37.47.110', '2011-09-02 12:27:41', 'jagannath@mail.afixiindia.com', 0),
(713, 2, '75.37.47.110', '2011-09-02 12:27:59', 'jagannath@mail.afixiindia.com', 0),
(714, 1, '75.37.47.110', '2011-09-02 12:28:25', 'sabri@mail.afixiindia.com', 0),
(715, 2, '75.37.47.110', '2011-09-02 12:43:34', 'jagannath@mail.afixiindia.com', 0),
(716, 1, '75.37.47.110', '2011-09-02 12:44:07', 'sabri@mail.afixiindia.com', 0),
(717, 3, '75.37.47.110', '2011-09-02 12:51:31', 'tanmaya@mail.afixiindia.com', 0),
(718, 35, '204.28.119.192', '2011-09-02 13:26:25', 'lol.i.laugh@gmail.com', 0),
(719, 3, '67.160.197.181', '2011-09-02 19:56:39', 'tanmaya@mail.afixiindia.com', 0),
(720, 3, '67.160.197.181', '2011-09-02 19:56:39', 'tanmaya@mail.afixiindia.com', 0),
(721, 36, '108.205.200.122', '2011-09-02 20:30:02', 'muazs786@gmail.com', 0),
(722, 32, '117.197.245.209', '2011-09-02 20:34:44', 'afixi.jagannath@gmail.com', 0),
(723, 32, '117.197.245.209', '2011-09-02 20:48:46', 'afixi.jagannath@gmail.com', 0),
(724, 36, '108.205.200.122', '2011-09-02 21:02:38', 'muazs786@gmail.com', 0),
(725, 2, '117.197.245.209', '2011-09-02 21:42:28', 'jagannath@mail.afixiindia.com', 0),
(726, 32, '117.197.245.209', '2011-09-02 21:50:48', 'afixi.jagannath@gmail.com', 0),
(727, 34, '117.197.245.209', '2011-09-02 21:56:20', 'afixi.satya@gmail.com', 0),
(728, 10, '117.197.245.209', '2011-09-02 21:56:52', 'prabhu@mail.afixiindia.com', 0),
(729, 34, '117.197.245.209', '2011-09-02 22:01:17', 'afixi.satya@gmail.com', 0),
(730, 3, '117.197.245.209', '2011-09-02 22:09:33', 'tanmaya@mail.afixiindia.com', 0),
(731, 35, '67.160.197.181', '2011-09-02 22:38:06', 'lol.i.laugh@gmail.com', 0),
(732, 2, '117.197.245.209', '2011-09-02 22:38:49', 'jagannath@mail.afixiindia.com', 0),
(733, 2, '117.197.245.209', '2011-09-02 22:56:18', 'jagannath@mail.afixiindia.com', 0),
(734, 32, '117.197.245.209', '2011-09-02 22:58:37', 'afixi.jagannath@gmail.com', 0),
(735, 3, '117.197.245.209', '2011-09-02 23:06:58', 'tanmaya@mail.afixiindia.com', 0),
(736, 1, '117.197.245.209', '2011-09-02 23:18:01', 'sabri@mail.afixiindia.com', 0),
(737, 3, '75.37.47.110', '2011-09-02 23:28:23', 'tanmaya@mail.afixiindia.com', 0),
(738, 34, '117.197.245.209', '2011-09-02 23:44:09', 'afixi.satya@gmail.com', 0),
(739, 4, '117.197.245.209', '2011-09-02 23:54:42', 'upendra@mail.afixiindia.com', 0),
(740, 32, '117.197.245.209', '2011-09-03 00:11:16', 'afixi.jagannath@gmail.com', 0),
(741, 34, '117.201.148.167', '2011-09-03 00:22:15', 'afixi.satya@gmail.com', 0),
(742, 3, '117.201.148.167', '2011-09-03 00:33:27', 'tanmaya@mail.afixiindia.com', 0),
(743, 32, '117.201.148.167', '2011-09-03 00:39:36', 'afixi.jagannath@gmail.com', 0),
(744, 34, '117.201.148.167', '2011-09-03 00:43:12', 'afixi.satya@gmail.com', 0),
(745, 36, '108.205.200.122', '2011-09-03 01:08:59', 'muazs786@gmail.com', 0),
(746, 37, '117.201.148.167', '2011-09-03 01:22:46', 'manab.rout@afixi.com', 0),
(747, 3, '117.201.148.167', '2011-09-03 02:18:44', 'tanmaya@mail.afixiindia.com', 0),
(748, 2, '117.201.148.167', '2011-09-03 02:20:59', 'jagannath@mail.afixiindia.com', 0),
(749, 36, '108.205.200.122', '2011-09-03 02:28:12', 'muazs786@gmail.com', 0),
(750, 32, '117.201.148.167', '2011-09-03 02:40:07', 'afixi.jagannath@gmail.com', 0),
(751, 32, '117.201.148.167', '2011-09-03 02:54:12', 'afixi.jagannath@gmail.com', 0),
(752, 2, '75.37.47.110', '2011-09-03 03:39:26', 'jagannath@mail.afixiindia.com', 0),
(753, 2, '117.197.248.45', '2011-09-03 04:47:43', 'jagannath@mail.afixiindia.com', 0),
(754, 32, '117.197.248.45', '2011-09-03 04:48:58', 'afixi.jagannath@gmail.com', 0),
(755, 32, '117.197.248.45', '2011-09-03 04:50:55', 'afixi.jagannath@gmail.com', 0),
(756, 34, '117.197.248.45', '2011-09-03 04:53:49', 'afixi.satya@gmail.com', 0),
(757, 32, '117.197.248.45', '2011-09-03 05:34:48', 'afixi.jagannath@gmail.com', 0),
(758, 36, '108.205.200.122', '2011-09-03 05:44:14', 'muazs786@gmail.com', 0),
(759, 34, '117.197.248.45', '2011-09-03 06:00:09', 'afixi.satya@gmail.com', 0),
(760, 35, '67.160.197.181', '2011-09-03 11:32:52', 'lol.i.laugh@gmail.com', 0),
(761, 2, '75.37.47.110', '2011-09-03 12:37:21', 'jagannath@mail.afixiindia.com', 0),
(762, 36, '67.160.197.181', '2011-09-04 13:14:14', 'muazs786@gmail.com', 0),
(763, 35, '67.160.197.181', '2011-09-04 13:14:16', 'lol.i.laugh@gmail.com', 0),
(764, 2, '67.160.197.181', '2011-09-04 13:58:31', 'jagannath@mail.afixiindia.com', 0),
(765, 2, '75.37.47.110', '2011-09-04 20:55:49', 'jagannath@mail.afixiindia.com', 0),
(766, 32, '117.197.249.6', '2011-09-04 22:10:47', 'afixi.jagannath@gmail.com', 0),
(767, 2, '75.37.47.110', '2011-09-04 22:45:21', 'jagannath@mail.afixiindia.com', 0),
(768, 35, '67.160.197.181', '2011-09-04 22:46:55', 'lol.i.laugh@gmail.com', 0),
(769, 2, '117.197.249.6', '2011-09-04 22:54:26', 'jagannath@mail.afixiindia.com', 0),
(770, 34, '117.197.249.6', '2011-09-04 22:55:10', 'afixi.satya@gmail.com', 0),
(771, 3, '117.197.249.6', '2011-09-04 22:55:51', 'tanmaya@mail.afixiindia.com', 0),
(772, 1, '117.197.249.6', '2011-09-04 23:03:18', 'sabri@mail.afixiindia.com', 0),
(773, 1, '67.160.197.181', '2011-09-04 23:04:00', 'sabri@mail.afixiindia.com', 0),
(774, 1, '75.37.47.110', '2011-09-04 23:05:22', 'sabri@mail.afixiindia.com', 0),
(775, 1, '108.205.200.122', '2011-09-04 23:05:43', 'sabri@mail.afixiindia.com', 0),
(776, 1, '117.197.249.6', '2011-09-04 23:11:46', 'sabri@mail.afixiindia.com', 0),
(777, 34, '117.197.249.6', '2011-09-04 23:14:00', 'afixi.satya@gmail.com', 0),
(778, 1, '117.197.249.6', '2011-09-04 23:29:09', 'sabri@mail.afixiindia.com', 0),
(779, 1, '117.197.249.6', '2011-09-04 23:29:44', 'sabri@mail.afixiindia.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `memeje__meme`
--

DROP TABLE IF EXISTS `memeje__meme`;
CREATE TABLE IF NOT EXISTS `memeje__meme` (
  `id_meme` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `title` varchar(300) collate utf8_unicode_ci default NULL,
  `id_captions` text collate utf8_unicode_ci NOT NULL,
  `image` varchar(300) collate utf8_unicode_ci default NULL,
  `category` int(11) NOT NULL,
  `is_live` tinyint(4) NOT NULL default '1',
  `id_question` int(11) default NULL,
  `is_duel` int(11) NOT NULL default '0',
  `duel_won` int(11) default NULL,
  `tot_reply` int(11) NOT NULL default '0',
  `tot_caption` int(11) NOT NULL default '0',
  `tot_honour` int(11) NOT NULL default '0',
  `view_count` int(11) NOT NULL default '0',
  `honour_id_user` text collate utf8_unicode_ci NOT NULL,
  `tot_dishonour` int(11) NOT NULL default '0',
  `dishonour_id_user` text collate utf8_unicode_ci NOT NULL,
  `can_all_comment` tinyint(4) NOT NULL COMMENT '1 for all 0 for friends',
  `can_all_view` tinyint(4) NOT NULL COMMENT '1 for all 0 for friends',
  `tagged_user` text collate utf8_unicode_ci,
  `user_status` tinyint(2) NOT NULL default '1',
  `add_date` datetime NOT NULL,
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_meme`),
  KEY `category` (`category`),
  KEY `can_all_comment` (`can_all_comment`),
  KEY `can_all_view` (`can_all_view`),
  KEY `is_live` (`is_live`),
  KEY `id_question` (`id_question`),
  KEY `user_status` (`user_status`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

--
-- Dumping data for table `memeje__meme`
--

INSERT INTO `memeje__meme` (`id_meme`, `id_user`, `title`, `id_captions`, `image`, `category`, `is_live`, `id_question`, `is_duel`, `duel_won`, `tot_reply`, `tot_caption`, `tot_honour`, `view_count`, `honour_id_user`, `tot_dishonour`, `dishonour_id_user`, `can_all_comment`, `can_all_view`, `tagged_user`, `user_status`, `add_date`, `ip`) VALUES
(1, 2, 'Fap', '', '1_1313764443_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 3, 1, '1,2,3', 0, '', 0, 1, NULL, 1, '2011-08-19 07:34:38', '117.197.249.49'),
(2, 2, 'war', '', '2_1_33_ChallengeAccepted.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 0, NULL, 1, '2011-08-19 07:40:59', '117.197.249.49'),
(4, 2, 'Miss funny', '3', '4_6_38_GirlFapFap.png', 1, 1, NULL, 0, NULL, 0, 1, 1, 7, '3', 1, '35', 1, 1, NULL, 1, '2011-08-19 08:03:19', '117.197.249.49'),
(5, 34, 'Test----Chrome', '', '5_1313812751_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 1, '', 0, '', 1, 1, NULL, 1, '2011-08-19 21:00:48', '117.197.235.93'),
(7, 34, 'Testt-Chrome-1', '', '7_11_43_High.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 5, '2', 1, '35', 1, 1, NULL, 1, '2011-08-19 23:32:27', '117.197.244.133'),
(8, 1, 'Trees - Test 1', '', '8_17_49_FemaleRetarded.png', 3, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-19 23:33:14', '76.216.22.128'),
(9, 1, 'Trees - Test 1', '', '9_2_34_Determined.png', 3, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-19 23:34:08', '76.216.22.128'),
(10, 34, 'Testt-safari', '', '10_AX059102.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 6, '', 0, '', 1, 1, NULL, 1, '2011-08-20 00:09:12', '117.197.244.133'),
(11, 2, 'dfg', '', '11_1313824153_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 0, NULL, 1, '2011-08-20 00:10:45', '117.197.244.133'),
(12, 1, 'jagan test', '', '12_4_36_FapFap.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 0, NULL, 1, '2011-08-20 00:16:05', '117.197.244.133'),
(13, 1, 'sdfdsf', '', '13_6_38_GirlFapFap.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-20 00:18:28', '117.197.244.133'),
(14, 34, 'Test----Safari-1', '', '14_34_1313824743_uploaded.png', 2, 1, NULL, 0, NULL, 0, 0, 2, 14, '2,35', 0, '', 0, 1, NULL, 1, '2011-08-20 00:20:41', '117.197.244.133'),
(15, 1, 'vfvd', '', '15_5_37_Gay.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 1, NULL, 1, '2011-08-20 00:51:54', '117.197.244.133'),
(16, 1, 'gfddf', '', '16_2_34_Determined.png', 3, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 0, NULL, 1, '2011-08-20 00:55:01', '117.197.244.133'),
(17, 1, 'Test', '1,2', '17_1313826966_draw.png', 2, 1, NULL, 0, NULL, 0, 2, 2, 15, '2,4', 0, '', 1, 1, NULL, 1, '2011-08-20 00:56:34', '117.197.244.133'),
(18, 2, 'sdfs', '', '18_1313845416_draw.png', 3, 1, NULL, 0, NULL, 0, 0, 1, 7, '3', 1, '35', 1, 1, NULL, 1, '2011-08-20 06:03:50', '117.201.160.57'),
(19, 2, 'dsgs', '', '19_1313845931_draw.png', 2, 0, 7, 0, NULL, 0, 0, 2, 11, '10,34', 0, '', 0, 0, NULL, 1, '2011-08-20 06:12:30', '117.201.160.57'),
(20, 34, 'Testing answer to question', '13,14,20,21', '20_34_1313846540_uploaded.png', 1, 0, 7, 0, NULL, 0, 4, 2, 7, '10,3', 1, '34', 1, 1, NULL, 1, '2011-08-20 06:36:49', '117.201.160.57'),
(21, 3, 'TESTIN QUESTION TO ANSWER----OPERA', '19,22', '21_testimonial6.png', 3, 0, 7, 0, NULL, 0, 2, 2, 6, '10,34', 0, '', 1, 1, NULL, 1, '2011-08-20 06:42:48', '117.201.160.57'),
(22, 2, 'ddshs', '', '22_3_35_NotBad.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 0, NULL, 1, '2011-08-20 07:02:06', '117.201.160.57'),
(23, 4, 'fdssd', '', '23_5_37_Gay.png', 2, 0, 7, 0, NULL, 0, 0, 0, 1, '', 2, '34,10', 0, 0, NULL, 1, '2011-08-20 07:08:31', '117.201.160.57'),
(24, 3, 'hiiiiiiii', '4,5', '24_6_38_GirlFapFap.png', 4, 1, NULL, 0, NULL, 1, 2, 1, 0, '3', 0, '', 1, 1, NULL, 1, '2011-08-20 07:21:21', '117.201.160.57'),
(25, 4, 'Hi sunny', '', '25_4_1313850416_uploaded.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 1, '', 0, '', 1, 0, NULL, 1, '2011-08-20 07:27:37', '117.201.160.57'),
(26, 4, 'Vodafone vs Memeje', '6,7', '26_4_1313850593_uploaded.png', 1, 1, NULL, 0, NULL, 0, 2, 1, 0, '4', 1, '36', 1, 1, NULL, 1, '2011-08-20 07:31:11', '117.201.160.57'),
(27, 1, 'My scooter', '', '27_1_1313852451_uploaded.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 0, NULL, 1, '2011-08-20 08:02:52', '117.201.160.57'),
(28, 35, 'baby gangser', '', '28_26_58_BabyTroll.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 1, '', 0, '', 1, 1, NULL, 1, '2011-08-20 17:43:27', '198.94.221.87'),
(29, 35, 'Obama ruins us economy', '8,9,10', '29_1_33_ChallengeAccepted.png', 2, 1, NULL, 0, NULL, 0, 3, 0, 5, '', 0, '', 1, 1, NULL, 1, '2011-08-20 17:44:09', '198.94.221.87'),
(30, 35, 'my response', '', '30_4_36_FapFap.png', 2, 0, 7, 0, NULL, 0, 0, 1, 2, '10', 0, '', 1, 1, NULL, 1, '2011-08-20 18:25:37', '108.205.200.122'),
(31, 36, 'NOT GOOD', '11', '31_9_41_SonMeGusta.png', 1, 1, NULL, 0, NULL, 2, 1, 2, 2, '36,35', 0, '', 1, 1, NULL, 1, '2011-08-20 18:50:38', '108.205.200.122'),
(32, 2, 'Trees - Test 3', '', '32_2_34_Determined.png', 3, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, NULL, 1, '2011-08-20 23:12:14', '76.230.233.90'),
(33, 36, 'stuff', '', '33_2_34_Determined.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 1, '36', 0, '', 1, 1, NULL, 1, '2011-08-21 02:41:13', '108.205.200.122'),
(34, 36, 'stonerbama', '12', '34_3_35_NotBad.png', 2, 1, NULL, 0, NULL, 0, 1, 0, 1, '', 0, '', 1, 1, NULL, 1, '2011-08-21 02:42:17', '108.205.200.122'),
(35, 34, 'Test--22nd', '', '35_1313987451_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, NULL, 1, '2011-08-21 21:32:55', '117.197.233.113'),
(36, 1, 'Hello test', '27,28', '36_4_36_FapFap.png', 1, 1, NULL, 0, NULL, 0, 2, 2, 11, '2,3', 0, '', 1, 1, NULL, 1, '2011-08-21 21:44:44', '117.197.233.113'),
(37, 2, 'Parwesh11', '', '37_1313997082_draw.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, NULL, 1, '2011-08-22 00:12:10', '117.197.233.113'),
(38, 34, 'Test--22nd--1', '34', '38_34_1314000327_uploaded.png', 2, 1, NULL, 0, NULL, 0, 1, 1, 3, '3', 0, '', 1, 1, NULL, 1, '2011-08-22 01:06:40', '117.197.233.113'),
(39, 2, 'Miss lina', '', '39_6_38_GirlFapFap.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 0, '3', 1, '2011-08-22 21:58:42', '117.197.243.122'),
(40, 2, 'JTest', '', '40_3_35_NotBad.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 3, '', 0, '', 1, 1, '3,4,24', 1, '2011-08-22 22:31:31', '117.197.243.122'),
(41, 34, 'Test day', '17,18', '41_1314083539_draw.png', 1, 1, NULL, 0, NULL, 0, 2, 1, 2, '34', 0, '', 1, 1, '3', 1, '2011-08-23 00:14:07', '117.197.253.54'),
(42, 34, 'Test day 1', '15,16', '42_1314084631_draw.png', 2, 1, NULL, 0, NULL, 3, 2, 0, 4, '', 0, '', 1, 1, NULL, 1, '2011-08-23 00:31:34', '117.197.253.54'),
(43, 34, 'Testing Tag-1', '29,30,31', '43_5_37_Gay.png', 3, 1, NULL, 0, NULL, 0, 3, 2, 5, '10,34', 1, '3', 1, 1, '3', 1, '2011-08-23 06:18:55', '117.201.166.170'),
(44, 3, 'Test-Tag-2', '23,24,25,26', '44_1314105695_draw.png', 4, 1, NULL, 0, NULL, 0, 4, 1, 0, '3', 0, '', 1, 1, '34', 1, '2011-08-23 06:26:13', '117.201.166.170'),
(45, 2, 'Tag Test (Friends Only)', '', '45_1314149023_draw.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 0, 0, '1', 1, '2011-08-23 18:24:57', '75.36.207.218'),
(46, 2, 'dgss', '', '46_1314194127_draw.png', 3, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 0, '4', 1, '2011-08-24 06:57:02', '117.197.239.207'),
(47, 2, 'Yao Ming Tag!', '', '47_12_44_Laughing.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, '1,35', 1, '2011-08-24 18:56:26', '204.28.119.130'),
(48, 35, 'lol', '', '48_6_38_GirlFapFap.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 3, '', 0, '', 1, 1, '2', 1, '2011-08-24 18:56:27', '67.160.197.181'),
(49, 35, 'test', '', '49_5_37_Gay.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, '2', 1, '2011-08-24 19:00:01', '67.160.197.181'),
(50, 1, 'Tag - Laugh', '', '50_19_51_Hehehe.png', 1, 1, NULL, 0, NULL, 0, 0, 2, 6, '1,2', 0, '', 0, 0, '2', 1, '2011-08-25 00:24:32', '204.28.119.130'),
(51, 32, 'Jaga test', '', '51_3_35_NotBad.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-25 00:39:58', '117.201.144.40'),
(52, 32, 'Jaga test', '', '52_3_35_NotBad.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-25 00:40:59', '117.201.144.40'),
(53, 32, 'Budhun m', '', '53_2_34_Determined.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-25 00:41:53', '117.201.144.40'),
(54, 32, 'asfsd', '', '54_1_33_ChallengeAccepted.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-25 00:44:12', '117.201.144.40'),
(55, 32, 'FD', '', '55_1314259053_draw.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 0, '35', 0, '', 1, 1, NULL, 1, '2011-08-25 00:58:06', '117.201.144.40'),
(56, 32, 'sda', '', '56_3_35_NotBad.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 6, '35', 0, '', 1, 1, NULL, 1, '2011-08-25 01:00:40', '117.201.144.40'),
(57, 23, 'Obama', '', '57_3_35_NotBad.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 0, NULL, 1, '2011-08-25 07:58:24', '117.197.237.8'),
(58, 3, 'huhu', '', '58_1314308530_draw.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 7, '3', 0, '', 1, 1, '4,34', 1, '2011-08-25 14:42:45', '67.160.197.181'),
(59, 2, 'Laila n majnu', '', '59_6_38_GirlFapFap.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-26 04:14:35', '117.201.162.225'),
(62, 2, 'Watermark Test', '', '62_21_53_Smile.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-26 18:08:12', '75.36.207.218'),
(63, 2, 'asdf', '', '63_1_33_ChallengeAccepted.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-26 18:11:00', '75.36.207.218'),
(64, 2, 'All/All', '', '64_2_34_Determined.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 7, '', 0, '', 1, 1, NULL, 1, '2011-08-26 18:38:46', '75.36.207.218'),
(65, 2, 'All/Friends', '', '65_2_1314409196_uploaded.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 1, NULL, 1, '2011-08-26 18:40:20', '75.36.207.218'),
(66, 2, 'Friends/All', '', '66_8_40_MeGustaCreepy.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 4, '', 0, '', 1, 0, NULL, 1, '2011-08-26 18:41:59', '75.36.207.218'),
(67, 2, 'Friends/Friends', '', '67_28_60_Melvin.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 4, '', 1, '35', 0, 0, NULL, 1, '2011-08-26 18:47:35', '75.36.207.218'),
(68, 35, 'dododo', '', '68_30_62_Troll.png', 2, 1, NULL, 0, NULL, 0, 0, 2, 40, '35,3', 0, '', 1, 1, NULL, 1, '2011-08-26 21:05:12', '204.28.119.168'),
(69, 35, 'lol', '', '69_2_34_Determined.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 5, '35', 0, '', 1, 1, NULL, 1, '2011-08-27 14:41:21', '204.28.119.168'),
(80, 3, 'Testing Duel-------1', '', '80_1314711114_draw.png', 1, 1, 0, 1, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, '10', 1, '0000-00-00 00:00:00', '117.201.163.17'),
(81, 10, 'Testing Duel------2', '', '81_1314711100_draw.png', 2, 1, 0, 1, 1, 0, 0, 2, 0, '3,10', 0, '', 1, 1, '3', 1, '0000-00-00 00:00:00', '117.201.163.17'),
(82, 3, 'notifications', '', '82_4_36_FapFap.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 2, '3', 0, '', 1, 1, '4', 1, '2011-09-02 00:25:06', '204.28.119.192'),
(83, 35, 'Haha duplicates', '', '83_23_55_SoMuchWin.png', 1, 1, 0, 1, NULL, 0, 0, 0, 1, '', 1, '35', 1, 1, '36', 1, '0000-00-00 00:00:00', '204.28.119.192'),
(84, 36, 'not good', '', '84_9_41_SonMeGusta.png', 1, 1, 0, 1, NULL, 0, 0, 2, 15, '36,35', 0, '', 1, 1, '35', 1, '0000-00-00 00:00:00', '204.28.119.192'),
(85, 34, 'Salma', '', '85_5_37_Gay.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, '3', 1, '2011-09-02 03:22:08', '117.201.165.160'),
(86, 30, 'test for fb', '', '86_Afixi_23.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 1, '', 0, '', 1, 0, NULL, 1, '2011-09-02 05:01:45', '117.201.165.160'),
(87, 30, 'test second', '35', '87_5_37_Gay.png', 3, 1, NULL, 0, NULL, 0, 1, 0, 2, '', 0, '', 1, 1, NULL, 1, '2011-09-02 05:04:18', '117.201.165.160'),
(88, 30, 'testing again', '', '88_Afixi_29.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 8, '', 0, '', 1, 1, NULL, 1, '2011-09-02 05:48:04', '117.201.165.160'),
(89, 30, 'test', '', '89_1314971684_draw.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, NULL, 1, '2011-09-02 06:55:25', '117.201.165.160'),
(90, 30, 'hello', '32,33', '90_3_35_NotBad.png', 2, 1, NULL, 0, NULL, 3, 2, 1, 38, '30', 0, '', 1, 1, NULL, 1, '2011-09-02 07:00:53', '117.201.165.160'),
(91, 2, 'aa', '', '91_3_35_NotBad.png', 1, 1, NULL, 0, NULL, 1, 0, 1, 3, '36', 0, '', 1, 1, NULL, 1, '2011-09-02 08:05:29', '117.201.165.160'),
(92, 4, 'aaa', '', '92_4_36_FapFap.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 0, NULL, 1, '2011-09-02 08:31:17', '117.201.165.160'),
(93, 3, 'bbb', '', '93_3_35_NotBad.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 0, NULL, 1, '2011-09-02 08:33:26', '117.201.165.160'),
(94, 3, 'ccc', '', '94_5_37_Gay.png', 2, 1, NULL, 0, NULL, 0, 0, 1, 2, '35', 0, '', 0, 0, NULL, 1, '2011-09-02 08:35:21', '117.201.165.160'),
(95, 34, 'Testing flag', '', '95_6_38_GirlFapFap.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 0, 1, NULL, 1, '2011-09-02 22:57:03', '117.197.245.209'),
(96, 34, 'Testing who comments', '', '96_4_36_FapFap.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 1, NULL, 1, '2011-09-02 23:33:51', '117.197.245.209'),
(97, 3, 'tryu', '', '97_3_35_NotBad.png', 2, 1, NULL, 0, NULL, 1, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-09-02 23:38:37', '117.197.245.209'),
(98, 3, 'Testing who comments---1', '', '98_6_38_GirlFapFap.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-09-02 23:47:27', '117.197.245.209'),
(99, 34, 'Tweet', '', '99_1315032810_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 1, 3, '34', 0, '', 1, 1, NULL, 1, '2011-09-02 23:54:21', '117.197.245.209'),
(100, 3, 'testing by me', '', '100_6_38_GirlFapFap.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 1, '', 0, '', 1, 1, NULL, 1, '2011-09-02 23:56:42', '117.197.245.209'),
(101, 3, 'hello', '', '101_1315034339_draw.png', 2, 1, NULL, 0, NULL, 2, 0, 0, 1, '', 2, '36,35', 1, 1, NULL, 1, '2011-09-03 00:19:30', '117.201.148.167'),
(102, 34, 'Friends who comment', '', '102_1315041815_draw.png', 3, 1, NULL, 0, NULL, 0, 0, 3, 4, '2,36,35', 0, '', 0, 1, NULL, 1, '2011-09-03 02:25:10', '117.201.148.167'),
(103, 34, 'Testing who comments--Funny', '', '103_1315042692_draw.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 0, '35', 0, '', 0, 1, NULL, 1, '2011-09-03 02:39:08', '117.201.148.167'),
(104, 2, 'Friends/Friends 2', '', '104_1_33_ChallengeAccepted.png', 4, 1, NULL, 0, NULL, 1, 0, 1, 5, '35', 1, '2', 0, 0, NULL, 1, '2011-09-03 13:22:37', '75.37.47.110'),
(105, 34, 'Testing Random Generator', '', '105_1315203260_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 1, 0, '3', 0, '', 0, 1, '32,3', 1, '2011-09-04 23:15:46', '117.197.249.6');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__notification`
--

DROP TABLE IF EXISTS `memeje__notification`;
CREATE TABLE IF NOT EXISTS `memeje__notification` (
  `id_notification` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL COMMENT 'if notification_type=4 then it''s id_badge otherwise id_user',
  `notified_user` int(11) NOT NULL,
  `notification_type` int(11) NOT NULL,
  `id_meme` int(11) default NULL,
  `is_read` int(11) NOT NULL default '0',
  `is_removed` int(11) NOT NULL COMMENT '1 if removed by user otherwise 0',
  `add_date` datetime NOT NULL,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_notification`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=128 ;

--
-- Dumping data for table `memeje__notification`
--

INSERT INTO `memeje__notification` (`id_notification`, `id_user`, `notified_user`, `notification_type`, `id_meme`, `is_read`, `is_removed`, `add_date`, `ip`) VALUES
(1, 2, 23, 5, NULL, 1, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(2, 2, 32, 5, NULL, 1, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(3, 2, 33, 5, NULL, 0, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(7, 3, 34, 5, NULL, 1, 1, '2011-08-22 23:01:15', '117.197.243.122'),
(8, 34, 3, 5, NULL, 1, 1, '2011-08-22 23:03:39', '117.197.243.122'),
(9, 3, 34, 5, NULL, 1, 1, '2011-08-22 23:04:25', '117.197.243.122'),
(10, 3, 10, 5, NULL, 1, 1, '2011-08-22 23:37:20', '117.197.253.54'),
(11, 10, 3, 5, NULL, 1, 1, '2011-08-22 23:37:58', '117.197.253.54'),
(12, 34, 3, 5, NULL, 1, 1, '2011-08-22 23:40:51', '117.197.253.54'),
(13, 10, 3, 5, NULL, 1, 1, '2011-08-22 23:41:01', '117.197.253.54'),
(14, 10, 34, 5, NULL, 1, 1, '2011-08-22 23:43:20', '117.197.253.54'),
(15, 3, 34, 5, NULL, 1, 1, '2011-08-22 23:43:38', '117.197.253.54'),
(17, 34, 10, 5, NULL, 1, 1, '2011-08-22 23:49:02', '117.197.253.54'),
(18, 10, 34, 5, NULL, 1, 1, '2011-08-22 23:50:01', '117.197.253.54'),
(19, 34, 10, 5, NULL, 1, 1, '2011-08-22 23:50:36', '117.197.253.54'),
(35, 1, 2, 5, NULL, 1, 1, '2011-08-23 18:21:39', '75.36.207.218'),
(38, 4, 2, 5, NULL, 1, 1, '2011-08-23 21:31:40', '117.201.160.173'),
(39, 4, 3, 5, NULL, 1, 1, '2011-08-23 21:31:40', '117.201.160.173'),
(40, 4, 5, 5, NULL, 1, 1, '2011-08-23 21:31:41', '117.201.160.173'),
(42, 4, 8, 5, NULL, 0, 0, '2011-08-23 21:31:41', '117.201.160.173'),
(52, 3, 10, 5, NULL, 1, 1, '2011-08-23 23:21:07', '117.201.160.173'),
(54, 2, 35, 5, NULL, 1, 1, '2011-08-24 18:53:15', '204.28.119.130'),
(55, 35, 2, 1, NULL, 1, 0, '2011-08-24 18:55:20', ''),
(63, 3, 36, 5, NULL, 1, 0, '2011-08-25 14:51:33', '67.160.197.181'),
(65, 3, 10, 5, NULL, 1, 1, '2011-08-25 21:49:30', '117.197.233.105'),
(66, 10, 3, 1, NULL, 1, 1, '2011-08-25 21:49:50', ''),
(74, 35, 3, 5, NULL, 1, 1, '2011-08-27 15:05:29', '204.28.119.168'),
(75, 35, 4, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(76, 35, 5, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(77, 35, 6, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(78, 35, 8, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(79, 35, 9, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(80, 35, 10, 5, NULL, 1, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(81, 35, 13, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(82, 35, 15, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(83, 35, 36, 5, NULL, 1, 1, '2011-08-27 15:05:29', '204.28.119.168'),
(88, 3, 34, 6, NULL, 1, 0, '2011-08-29 23:08:23', '117.197.241.237'),
(91, 10, 34, 6, NULL, 1, 0, '2011-08-30 03:06:39', '117.197.241.237'),
(108, 10, 34, 6, 3, 1, 0, '2011-08-30 05:31:55', '117.197.241.237'),
(109, 34, 10, 6, 4, 1, 0, '2011-08-30 05:33:45', '117.197.241.237'),
(114, 3, 10, 6, 7, 0, 0, '2011-08-30 06:33:10', '117.201.163.17'),
(115, 10, 3, 6, 8, 1, 0, '2011-08-30 06:34:13', '117.201.163.17'),
(116, 3, 35, 1, NULL, 1, 0, '2011-09-02 00:24:20', ''),
(117, 36, 35, 1, NULL, 1, 0, '2011-09-02 00:25:00', ''),
(118, 3, 4, 6, 82, 0, 0, '2011-09-02 00:25:07', '204.28.119.192'),
(120, 35, 36, 3, NULL, 1, 0, '2011-09-02 00:26:27', ''),
(121, 35, 36, 6, 9, 1, 0, '2011-09-02 00:27:29', '204.28.119.192'),
(122, 36, 35, 6, 10, 1, 0, '2011-09-02 00:28:10', '204.28.119.192'),
(123, 34, 3, 6, 85, 1, 0, '2011-09-02 03:22:08', '117.201.165.160'),
(124, 32, 34, 5, NULL, 1, 1, '2011-09-03 02:54:46', '117.201.148.167'),
(125, 34, 32, 1, NULL, 1, 0, '2011-09-03 02:55:02', ''),
(126, 34, 32, 6, 105, 0, 0, '2011-09-04 23:15:47', '117.197.249.6'),
(127, 34, 3, 6, 105, 0, 0, '2011-09-04 23:15:47', '117.197.249.6');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__premade_images`
--

DROP TABLE IF EXISTS `memeje__premade_images`;
CREATE TABLE IF NOT EXISTS `memeje__premade_images` (
  `id_premade_image` int(11) NOT NULL auto_increment,
  `id_category` int(11) NOT NULL,
  `image` varchar(200) collate utf8_unicode_ci NOT NULL,
  `img_name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `add_date` datetime NOT NULL,
  `ip` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_premade_image`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `memeje__premade_images`
--

INSERT INTO `memeje__premade_images` (`id_premade_image`, `id_category`, `image`, `img_name`, `add_date`, `ip`) VALUES
(1, 1, '33_ChallengeAccepted.png', '1_33_ChallengeAccepted.png', '2011-07-16 07:23:49', '117.201.162.188'),
(2, 1, '34_Determined.png', '2_34_Determined.png', '2011-07-16 07:23:53', '117.201.162.188'),
(3, 1, '35_NotBad.png', '3_35_NotBad.png', '2011-07-16 07:23:57', '117.201.162.188'),
(4, 1, '36_FapFap.png', '4_36_FapFap.png', '2011-07-16 07:24:00', '117.201.162.188'),
(5, 1, '37_Gay.png', '5_37_Gay.png', '2011-07-16 07:24:09', '117.201.162.188'),
(6, 1, '38_GirlFapFap.png', '6_38_GirlFapFap.png', '2011-07-16 07:24:15', '117.201.162.188'),
(7, 2, '39_MeGusta.png', '7_39_MeGusta.png', '2011-07-16 07:25:01', '117.201.162.188'),
(8, 2, '40_MeGustaCreepy.png', '8_40_MeGustaCreepy.png', '2011-07-16 07:25:04', '117.201.162.188'),
(9, 2, '41_SonMeGusta.png', '9_41_SonMeGusta.png', '2011-07-16 07:25:07', '117.201.162.188'),
(10, 2, '42_AwwYeah.png', '10_42_AwwYeah.png', '2011-07-16 07:25:11', '117.201.162.188'),
(11, 2, '43_High.png', '11_43_High.png', '2011-07-16 07:25:14', '117.201.162.188'),
(12, 2, '44_Laughing.png', '12_44_Laughing.png', '2011-07-16 07:25:25', '117.201.162.188'),
(13, 2, '45_LOL.png', '13_45_LOL.png', '2011-07-16 07:25:31', '117.201.162.188'),
(14, 3, '46_EWBTE.png', '14_46_EWBTE.png', '2011-07-16 07:27:46', '117.201.162.188'),
(15, 3, '47_EWBTE2.png', '15_47_EWBTE2.png', '2011-07-16 07:27:49', '117.201.162.188'),
(16, 3, '48_FemaleHappy.png', '16_48_FemaleHappy.png', '2011-07-16 07:27:53', '117.201.162.188'),
(17, 3, '49_FemaleRetarded.png', '17_49_FemaleRetarded.png', '2011-07-16 07:27:56', '117.201.162.188'),
(18, 3, '50_Happy.png', '18_50_Happy.png', '2011-07-16 07:28:01', '117.201.162.188'),
(19, 3, '51_Hehehe.png', '19_51_Hehehe.png', '2011-07-16 07:28:04', '117.201.162.188'),
(20, 3, '52_messageTroll.png', '20_52_messageTroll.png', '2011-07-16 07:28:10', '117.201.162.188'),
(21, 3, '53_Smile.png', '21_53_Smile.png', '2011-07-16 07:28:16', '117.201.162.188'),
(22, 3, '54_Smile2.png', '22_54_Smile2.png', '2011-07-16 07:28:18', '117.201.162.188'),
(23, 3, '55_SoMuchWin.png', '23_55_SoMuchWin.png', '2011-07-16 07:28:26', '117.201.162.188'),
(24, 3, '56_Stoned.png', '24_56_Stoned.png', '2011-07-16 07:28:31', '117.201.162.188'),
(25, 3, '57_AsianTroll.png', '25_57_AsianTroll.png', '2011-07-16 07:28:35', '117.201.162.188'),
(26, 4, '58_BabyTroll.png', '26_58_BabyTroll.png', '2011-07-16 07:29:36', '117.201.162.188'),
(27, 4, '59_ExcitedTroll.png', '27_59_ExcitedTroll.png', '2011-07-16 07:29:39', '117.201.162.188'),
(28, 4, '60_Melvin.png', '28_60_Melvin.png', '2011-07-16 07:29:42', '117.201.162.188'),
(29, 4, '61_messageTroll.png', '29_61_messageTroll.png', '2011-07-16 07:29:44', '117.201.162.188'),
(30, 4, '62_Troll.png', '30_62_Troll.png', '2011-07-16 07:29:46', '117.201.162.188'),
(31, 2, '41.jpg', '31_41.jpg', '2011-08-18 06:29:32', '117.197.253.132'),
(32, 2, '22145rkh8kbcl11.jpg', '32_22145rkh8kbcl11.jpg', '2011-08-18 06:29:53', '117.197.253.132');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__question`
--

DROP TABLE IF EXISTS `memeje__question`;
CREATE TABLE IF NOT EXISTS `memeje__question` (
  `id_question` int(11) NOT NULL auto_increment,
  `won_user` text collate utf8_unicode_ci NOT NULL COMMENT 'All users who have got more like in their answer',
  `title` varchar(50) collate utf8_unicode_ci NOT NULL,
  `question` text collate utf8_unicode_ci NOT NULL,
  `image` varchar(200) collate utf8_unicode_ci default NULL,
  `img_name` varchar(200) collate utf8_unicode_ci default NULL,
  `is_set` tinyint(4) NOT NULL,
  `start_date` datetime default NULL,
  `end_date` datetime default NULL,
  `add_date` datetime NOT NULL,
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_question`),
  KEY `is_set` (`is_set`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `memeje__question`
--

INSERT INTO `memeje__question` (`id_question`, `won_user`, `title`, `question`, `image`, `img_name`, `is_set`, `start_date`, `end_date`, `add_date`, `ip`) VALUES
(1, '', 'Daily life', 'What is the benefit of having Girlfriend in the same college or same school?', 'Afixi_6.jpg', '1_Afixi_6.jpg', 0, '2011-07-13 00:00:00', '2011-07-18 00:00:00', '2011-07-16 07:34:23', '117.201.162.188'),
(2, '', 'Daily morning', 'Name two things u can never eat before breakfast?', 'Afixi_11.jpg', '2_Afixi_11.jpg', 0, '2011-07-19 00:00:00', '2011-07-22 00:00:00', '2011-07-16 07:37:09', '117.201.162.188'),
(3, '', 'Funny', 'What does computer likes to eat?', 'Afixi_6.jpg', '3_Afixi_6.jpg', 0, '2011-08-01 00:00:00', '2011-08-08 00:00:00', '2011-07-16 07:56:05', '117.201.162.188'),
(4, '', 'Testing', 'This is for Testing purpose', '6Formula.JPEG', '4_6Formula.JPEG', 0, '2011-08-17 00:00:00', '2011-08-18 00:00:00', '2011-08-18 22:04:55', '117.197.232.204'),
(6, '', 'Testing', 'Testing question module.', 'Afixi_1.jpg', '6_Afixi_1.jpg', 0, '1996-08-01 00:00:00', '1996-08-01 00:00:00', '2011-08-18 22:23:14', '117.197.232.204'),
(7, '', 'Testing Add Question', 'How is the question?', '2_1266900725.JPG', '7_2_1266900725.JPG', 0, '2011-08-19 00:00:00', '2011-08-25 00:00:00', '2011-08-19 02:10:09', '117.197.235.93');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__reply`
--

DROP TABLE IF EXISTS `memeje__reply`;
CREATE TABLE IF NOT EXISTS `memeje__reply` (
  `id_reply` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `id_meme` int(11) NOT NULL,
  `reply` text collate utf8_unicode_ci NOT NULL,
  `is_live` int(1) NOT NULL,
  `user_status` tinyint(2) NOT NULL default '1',
  `add_date` datetime NOT NULL,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_reply`),
  KEY `id_user` (`id_user`),
  KEY `user_status` (`user_status`),
  KEY `id_meme` (`id_meme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `memeje__reply`
--

INSERT INTO `memeje__reply` (`id_reply`, `id_user`, `id_meme`, `reply`, `is_live`, `user_status`, `add_date`, `ip`) VALUES
(1, 3, 24, 'hiiiiii', 0, 1, '2011-08-20 07:21:48', '117.201.160.57'),
(2, 36, 31, 'awesome', 0, 1, '2011-08-20 19:08:17', '108.205.200.122'),
(3, 35, 31, 'i like this', 0, 1, '2011-08-20 19:12:06', '108.205.200.122'),
(4, 2, 42, 'hibak  kafas', 0, 1, '2011-08-23 02:32:20', '117.197.253.54'),
(5, 2, 42, 'jadsdasjvj asdsa', 0, 1, '2011-08-23 02:32:57', '117.197.253.54'),
(6, 2, 42, 'twerewewtw dfgs', 0, 1, '2011-08-23 02:33:16', '117.197.253.54'),
(7, 30, 90, 'hello', 0, 1, '2011-09-02 07:37:55', '117.201.165.160'),
(8, 30, 90, 'hi', 0, 1, '2011-09-02 07:38:23', '117.201.165.160'),
(9, 30, 90, 'gg', 0, 1, '2011-09-02 07:40:01', '117.201.165.160'),
(10, 4, 91, 'czxcz', 0, 1, '2011-09-02 08:26:57', '117.201.165.160'),
(11, 37, 101, 'abe', 0, 1, '2011-09-03 01:24:31', '117.201.148.167'),
(12, 32, 101, 'o', 0, 1, '2011-09-03 02:19:51', '117.201.148.167'),
(13, 32, 97, '12', 0, 1, '2011-09-03 02:20:40', '117.201.148.167'),
(14, 35, 104, 'hi', 0, 1, '2011-09-04 13:17:10', '67.160.197.181');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__suggestion`
--

DROP TABLE IF EXISTS `memeje__suggestion`;
CREATE TABLE IF NOT EXISTS `memeje__suggestion` (
  `id_suggestion` int(11) NOT NULL auto_increment,
  `id_feature` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `suggestion` text collate utf8_unicode_ci NOT NULL,
  `add_date` datetime NOT NULL,
  `ip` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_suggestion`),
  KEY `id_feature` (`id_feature`,`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `memeje__suggestion`
--

INSERT INTO `memeje__suggestion` (`id_suggestion`, `id_feature`, `id_user`, `suggestion`, `add_date`, `ip`) VALUES
(1, 1, 34, 'This for testing', '2011-08-18 21:54:36', '117.197.232.204'),
(2, 3, 34, 'This for testing', '2011-08-18 21:56:36', '117.197.232.204'),
(3, 2, 34, 'This for testing Share or not share:', '2011-08-18 21:57:19', '117.197.232.204'),
(4, 4, 34, 'This for testing "Testing memeje"', '2011-08-18 22:00:01', '117.197.232.204'),
(5, 1, 24, 'fgfgdfgdfgdfg', '2011-08-18 23:00:21', '117.197.232.204'),
(6, 2, 35, 'hi', '2011-08-27 15:11:19', '204.28.119.168'),
(7, 2, 35, 'hi', '2011-08-27 15:11:25', '204.28.119.168'),
(8, 3, 35, 'hi', '2011-08-27 15:11:31', '204.28.119.168'),
(9, 4, 35, 'hi', '2011-08-27 15:11:37', '204.28.119.168'),
(10, 1, 34, 'Hello for testing', '2011-09-02 02:22:28', '117.201.165.160'),
(11, 3, 2, 'sdfds', '2011-09-02 08:04:04', '117.201.165.160'),
(12, 2, 35, 'asdfsdf', '2011-09-02 13:26:58', '204.28.119.192'),
(13, 2, 35, 'asdfsdf', '2011-09-02 13:27:00', '204.28.119.192');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__user`
--

DROP TABLE IF EXISTS `memeje__user`;
CREATE TABLE IF NOT EXISTS `memeje__user` (
  `id_user` int(11) NOT NULL auto_increment,
  `uid` varchar(50) collate utf8_unicode_ci NOT NULL,
  `name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `fb_pic_big` text collate utf8_unicode_ci NOT NULL,
  `fb_pic_square` text collate utf8_unicode_ci NOT NULL,
  `fname` varchar(50) collate utf8_unicode_ci NOT NULL,
  `mname` varchar(50) collate utf8_unicode_ci default NULL,
  `lname` varchar(50) collate utf8_unicode_ci default NULL,
  `email` varchar(50) collate utf8_unicode_ci NOT NULL,
  `password` varchar(50) collate utf8_unicode_ci default NULL,
  `id_admin` tinyint(4) NOT NULL,
  `gender` varchar(20) collate utf8_unicode_ci default NULL,
  `dob` date default NULL,
  `avatar` varchar(100) collate utf8_unicode_ci default NULL,
  `address` text collate utf8_unicode_ci,
  `ques_week_won` int(11) NOT NULL default '0',
  `duels_won` int(11) default '0' COMMENT 'Number of duels own.',
  `exp_point` bigint(20) NOT NULL default '0',
  `no_badges` int(11) NOT NULL default '0',
  `id_badges` text collate utf8_unicode_ci,
  `login_status` tinyint(4) NOT NULL,
  `no_of_logs` int(11) NOT NULL COMMENT 'no of times login',
  `last_login` datetime NOT NULL,
  `update_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `login_time` int(11) NOT NULL default '0',
  `random_num` varchar(100) collate utf8_unicode_ci default NULL,
  `flag` tinyint(4) NOT NULL,
  `user_status` tinyint(2) NOT NULL default '1',
  `id_friends` text collate utf8_unicode_ci,
  `invited_to` text collate utf8_unicode_ci NOT NULL,
  `memeje_friends` text collate utf8_unicode_ci,
  `toc` tinyint(4) NOT NULL default '0',
  `add_date` datetime NOT NULL,
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_user`),
  KEY `id_fb` (`uid`,`fname`,`lname`,`email`,`id_admin`,`gender`,`login_status`),
  KEY `flag` (`flag`),
  KEY `duels_won` (`duels_won`),
  KEY `ques_week_won` (`ques_week_won`),
  KEY `no_of_logs` (`no_of_logs`),
  KEY `user_status` (`user_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `memeje__user`
--

INSERT INTO `memeje__user` (`id_user`, `uid`, `name`, `fb_pic_big`, `fb_pic_square`, `fname`, `mname`, `lname`, `email`, `password`, `id_admin`, `gender`, `dob`, `avatar`, `address`, `ques_week_won`, `duels_won`, `exp_point`, `no_badges`, `id_badges`, `login_status`, `no_of_logs`, `last_login`, `update_login`, `login_time`, `random_num`, `flag`, `user_status`, `id_friends`, `invited_to`, `memeje_friends`, `toc`, `add_date`, `ip`) VALUES
(1, '0', '', '', '', 'Parwesh', NULL, 'Sabri', 'sabri@mail.afixiindia.com', 'p455w0rd', 1, 'M', '1999-06-08', '1_Afixi_11.jpg', NULL, 0, 0, 191, 9, '1', 0, 135, '2011-07-04 18:38:25', '2011-07-04 18:38:25', 0, '0', 1, 1, NULL, '', '2', 1, '2011-06-03 10:45:30', '192.168.1.172'),
(2, '0', '', '', '', 'jagannath', NULL, 'das', 'jagannath@mail.afixiindia.com', 'jjjjjj', 0, 'M', '1988-03-08', '2_Afixi_56.jpg', NULL, 0, 0, 719, 44, '1,2,5', 0, 186, '2011-07-01 16:49:19', '2011-09-05 00:32:35', 4326580, '0', 1, 1, NULL, '100001998663937', '1,4,35', 1, '2011-06-03 00:00:00', '192.168.1.152'),
(3, '0', '', '', '', 'Tanmaya1', NULL, 'Biswal1', 'tanmaya@mail.afixiindia.com', 'tttttt', 0, 'M', '1984-06-12', '3_Afixi_19.jpg', NULL, 0, 0, 233, 9, '1,2', 0, 75, '2011-07-02 10:39:40', '2011-09-05 00:32:34', 4332564, '0', 1, 1, NULL, '', '34,4,10,35', 1, '2011-06-03 13:10:28', '192.168.1.117'),
(4, '0', '', '', '', 'upendra', NULL, 'mohanty', 'upendra@mail.afixiindia.com', 'uuuuuu', 0, 'M', '1986-06-15', '4_AwwYeah.png', NULL, 0, 0, 170, 4, '30,1', 0, 72, '0000-00-00 00:00:00', '2011-09-03 00:38:39', 4203210, '0', 1, 1, NULL, '', '3,2,5', 1, '0000-00-00 00:00:00', ''),
(5, '0', '', '', '', 'biswa', NULL, 'sethi', 'biswa@mail.afixiindia.com', 'bbbbbb', 0, 'M', NULL, '5_Afixi_95.jpg', NULL, 0, 0, 110, 0, NULL, 0, 21, '0000-00-00 00:00:00', '2011-08-23 21:48:14', 3330850, '0', 1, 1, '', '', '4', 1, '2011-06-18 11:28:38', '192.168.1.102'),
(6, '0', '', '', '', 'jitendra', NULL, 'ganthia', 'jitendra@mail.afixiindia.com', 'jjjjjj', 0, 'M', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, 2, '0000-00-00 00:00:00', '2011-08-23 21:42:28', 53795, '0', 1, 1, NULL, '', '', 1, '2011-06-18 11:30:37', ''),
(8, '0', '', '', '', 'arun', NULL, 'bahal', 'arun@mail.afixiindia.com', 'aaaaaa', 0, 'M', NULL, '8_Afixi_97.jpg', NULL, 0, 0, 0, 0, NULL, 0, 6, '2011-07-04 12:58:25', '2011-08-22 02:15:47', 3909856, '0', 1, 1, NULL, '', '', 1, '2011-06-14 11:30:37', ''),
(9, '0', '', '', '', 'sunil', NULL, 'kund', 'sunil@mail.afixiindia.com', 'sunil1', 0, 'M', NULL, NULL, NULL, 0, 2, 80, 0, NULL, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, NULL, 0, 1, NULL, '', '', 0, '0000-00-00 00:00:00', ''),
(10, '0', '', '', '', 'prabhudas', NULL, 'behera', 'prabhu@mail.afixiindia.com', 'pppppp', 0, 'F', NULL, '10_Afixi_31.jpg', NULL, 0, 0, 53, 0, NULL, 0, 23, '2011-07-01 16:01:41', '2011-09-02 22:00:49', 5251617, '0', 1, 1, NULL, '', '34,3', 1, '0000-00-00 00:00:00', ''),
(13, '0', '', '', '', 'sasmita', NULL, 'test', 'abc@mail.afixi.com', 'aaaaaa', 0, 'F', '2011-06-09', NULL, NULL, 0, 0, 0, 0, NULL, 0, 0, '2011-06-28 19:07:38', '0000-00-00 00:00:00', 0, NULL, 1, 1, NULL, '', '', 0, '0000-00-00 00:00:00', ''),
(15, '0', '', '', '', 'sasmita', NULL, 'nayak', 'sasmita@mail.afixiindia.com', 'sasmita', 0, 'F', NULL, NULL, NULL, 0, 0, 40, 0, NULL, 0, 10, '0000-00-00 00:00:00', '2011-07-26 04:59:55', 708469, '0', 1, 1, NULL, '', '', 1, '0000-00-00 00:00:00', ''),
(22, '100001446343747', 'Suryakanta Das', '', '', 'Suryakanta', NULL, 'Das', 'afixi.suryakanta@gmail.com', '76833', 0, 'M', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, 4, '0000-00-00 00:00:00', '2011-07-08 17:34:55', 3936, '0', 1, 1, '507133377,530622141,551669792,867010392,1003925137,1142223201,1264224935,1408418201,1570944230,1583047333,1619642862,1733561600,1769818682,1828036643,100000161128627,100000315094310,100000480065272,100000512297270,100000531370678,100000536581618,100000537974030,100000581874927,100000604432861,100000915508944,100000920507839,100000922024239,100000922698258,100000982826781,100000997546280,100000998291381,100001081442187,100001100307427,100001110672752,100001133203177,100001159115544,100001232541408,100001302473511,100001350826269,100001421572079,100001464824239,100001503582853,100001512554389,100001616530522,100001742965429,100001764383594,100001771058615,100001772045330,100001808616396,100001860408543,100001875633369,100001876660907,100001901250759,100001910353516,100002102326666,100002237802534,100002605110171', '', '', 1, '2011-07-08 16:29:13', '192.168.1.152'),
(23, '1126785811', 'Jagannath Behera', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/49134_1126785811_9225_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/49134_1126785811_9225_q.jpg', 'Jagannath', NULL, 'Behera', 'jagannath.behera104@gmail.com', '80446', 0, 'M', NULL, NULL, NULL, 0, 0, 10, 0, NULL, 0, 6, '0000-00-00 00:00:00', '2011-08-25 08:16:17', 3876348, '0', 1, 1, '507133377,541815706,565698211,568206892,569307477,623359389,691220853,716822438,1003926960,1006326792,1034133950,1035284186,1065183866,1079335950,1145396328,1230452951,1236106182,1243665464,1258262659,1264224935,1278005644,1283808242,1290503861,1294743391,1296978994,1317250491,1389161051,1413920893,1418182581,1420069222,1428742117,1445528594,1475997438,1496572590,1505599615,1506796700,1579073624,1583047333,1621373377,1635541964,1649543390,1678531217,1683278002,1718541700,1728894583,1733561600,1750195934,1765269713,1769818682,1772844765,1828954875,1838169796,100000032982879,100000064790526,100000091553914,100000093930174,100000122386609,100000157896157,100000161128627,100000194863142,100000246680050,100000261332992,100000315094310,100000320517423,100000323454347,100000325795577,100000338637594,100000350138533,100000404398998,100000420353418,100000441417712,100000444486084,100000447155196,100000489769484,100000501173934,100000511457777,100000565953128,100000566901535,100000614503122,100000826453856,100000838030600,100000857012181,100000916463731,100000922024239,100000939061607,100000967398338,100000979768139,100001003424270,100001037325282,100001041202090,100001062571650,100001081442187,100001085513916,100001110672752,100001153423456,100001158522804,100001166670969,100001206048184,100001262421366,100001371118393,100001372310494,100001376557806,100001405181486,100001415613495,100001421572079,100001428632482,100001444117222,100001472119768,100001496936700,100001501723146,100001503582853,100001508401270,100001516312697,100001525436407,100001556329022,100001574700252,100001616530522,100001639947137,100001726395012,100001764383594,100001792832278,100001837005316,100001860408543,100001875633369,100001950714470,100001951342251,100001955572269,100002013432308,100002073064908,100002146258445,100002201437096,100002218271134,100002237802534,100002311818211,100002372354721,100002406166424,100002454313326,100002521670339,100002545375437', '', '', 1, '2011-07-09 12:33:37', '192.168.1.152'),
(24, '100001998663937', 'Upendra Mohanty', 'http://profile.ak.fbcdn.net/static-ak/rsrc.php/v1/yL/r/HsTZSDw4avx.gif', 'http://profile.ak.fbcdn.net/static-ak/rsrc.php/v1/yo/r/UlIqmHJn-SK.gif', 'Upendra', NULL, 'Mohanty', 'afixi.upendra@gmail.com', '29964', 0, 'M', NULL, NULL, NULL, 0, 0, 70, 0, NULL, 0, 21, '0000-00-00 00:00:00', '2011-08-19 02:13:47', 3222931, '0', 1, 1, '100000536581618,100001133203177,100001742965429', '100001133203177', '', 1, '2011-07-12 18:25:16', '192.168.1.105'),
(30, '100001742965429', 'Tanmaya Biswal', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/70763_100001742965429_1207790_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/70525_100001742965429_3501927_q.jpg', 'Tanmaya', NULL, 'Biswal', 'biswal805@gmail.com', '60320', 0, 'M', NULL, NULL, NULL, 0, 0, 191, 7, '1', 0, 14, '0000-00-00 00:00:00', '2011-09-02 07:54:43', 3978816, '0', 1, 1, '507133377,530622141,705116171,725831900,867010392,1122005603,1136967788,1264224935,1278240396,1283808242,1294743391,1343838580,1385176822,1458225240,1458944237,1460113988,1500872061,1608647370,1619642862,1654757075,1667297440,1673590640,1682140759,1704177310,1728414672,1733561600,1735460270,1774623946,1775373968,1807450480,100000004620702,100000009552525,100000115669048,100000143197035,100000161128627,100000246680050,100000264562886,100000315094310,100000320240318,100000351226326,100000407762958,100000413858057,100000438849629,100000473043489,100000498223308,100000510133136,100000523758965,100000536581618,100000668894258,100000692406585,100000743272264,100000781562631,100000822585284,100000858762860,100000893107049,100000915508944,100000922024239,100000976823111,100000982826781,100000998291381,100001081442187,100001102472268,100001110672752,100001122633460,100001127643807,100001133203177,100001145365771,100001202014742,100001246420971,100001275017689,100001275526970,100001276368693,100001284709258,100001309263785,100001350826269,100001423033461,100001446343747,100001456427680,100001467596643,100001478572958,100001498500871,100001538046980,100001570189065,100001604228310,100001611399857,100001616530522,100001669494715,100001705414839,100001707693970,100001709830312,100001764383594,100001771058615,100001772045330,100001805692522,100001844610657,100001875633369,100001876660907,100001906971102,100001910353516,100001912359250,100001998663937,100002094378771,100002197951269,100002237802534,100002314085074,100002323905484,100002389122052,100002509402680,100002580651919,100002650717963', '', '', 1, '2011-07-18 06:34:17', '117.197.242.21'),
(31, '100000642790261', 'Sas Mita', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/174004_100000642790261_3866929_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/173341_100000642790261_5200245_q.jpg', 'Sas', NULL, 'Mita', 'afixi.sasmita@gmail.com', '61156', 0, 'F', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, 4, '0000-00-00 00:00:00', '2011-07-20 02:41:02', 156966, '0', 1, 1, '1142223201,1408418201,1505599615,1619642862,100000512297270,100000531370678,100000536581618,100000604432861,100000921678158,100001081442187,100001302473511', '', '', 1, '2011-07-18 06:53:46', '117.197.242.21'),
(32, '100001133203177', 'Jagannath Behera', 'http://profile.ak.fbcdn.net/static-ak/rsrc.php/v1/yL/r/HsTZSDw4avx.gif', 'http://profile.ak.fbcdn.net/static-ak/rsrc.php/v1/yo/r/UlIqmHJn-SK.gif', 'Jagannath', NULL, 'Behera', 'afixi.jagannath@gmail.com', '56909', 0, 'M', NULL, NULL, 'Bhubaneswar,Orissa,India', 0, 0, 215, 8, '1,2', 0, 31, '0000-00-00 00:00:00', '2011-09-04 23:11:27', 4145946, '0', 1, 1, '507133377,867010392,1264224935,1396336174,1619642862,1733561600,100000064790526,100000315094310,100000512297270,100000536581618,100000915508944,100000922024239,100000982826781,100000998291381,100001003424270,100001050741636,100001077214733,100001081442187,100001153423456,100001159115544,100001302473511,100001421572079,100001446343747,100001472119768,100001616530522,100001742965429,100001764383594,100001875633369,100001910353516,100001998663937,100002127308840,100002600373707', '', '34', 1, '2011-07-18 23:03:02', '117.197.242.21'),
(33, '1733561600', 'Manas Ranjan Sahoo', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/276103_1733561600_2821584_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/276103_1733561600_2821584_q.jpg', 'Manas', 'Ranjan', 'Sahoo', 'manassahoo66@gmail.com', '24730', 0, 'M', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, 2, '0000-00-00 00:00:00', '2011-07-19 21:59:00', 72797, '0', 1, 1, '507133377,660455718,1003925137,1090208658,1126785811,1142223201,1143677367,1155740762,1162361939,1193707580,1218087593,1226827633,1230452951,1257626590,1289653772,1294743391,1324731360,1367357943,1408418201,1488684914,1489707635,1583047333,1595212606,1603236290,1619642862,1629098917,1710832347,1769818682,1770357999,1791182997,1828644067,1835881426,1848242904,100000001983853,100000012093777,100000014587689,100000016747560,100000026020998,100000116531352,100000163717370,100000214253083,100000230992382,100000311570911,100000315094310,100000315394991,100000367400166,100000390968292,100000466853184,100000469299416,100000521521673,100000529727032,100000536581618,100000537974030,100000539070417,100000542390155,100000572591334,100000578012578,100000579831049,100000589772697,100000626461639,100000728504973,100000756484268,100000791720394,100000796063342,100000855431880,100000864702476,100000892989952,100000915508944,100000917670012,100000920507839,100000922024239,100000922698258,100000982826781,100000998291381,100001006204619,100001032258469,100001072110922,100001081442187,100001094015952,100001103182652,100001110672752,100001133203177,100001137186216,100001145811491,100001147419681,100001232541408,100001245422031,100001255779105,100001302473511,100001314775759,100001357865355,100001373964108,100001441271310,100001446343747,100001460166672,100001464824239,100001467471051,100001478572958,100001480602866,100001484200903,100001502905697,100001503582853,100001546362003,100001556989835,100001616530522,100001625936811,100001742965429,100001764383594,100001771058615,100001772045330,100001798334919,100001801088870,100001808616396,100001810926277,100001841008705,100001875633369,100001876660907,100001901250759,100001910353516,100001936374405,100001957924550,100002068936900,100002127671967,100002135381572,100002166777607,100002237802534,100002278954324,100002358413196,100002444843992,100002571540466,100002600373707,100002650717963', '', '', 1, '2011-07-19 01:45:21', '117.197.246.58'),
(34, '100000982826781', 'Satya Singh', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/23112_100000982826781_7395_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/27423_100000982826781_3734_q.jpg', 'Satya', NULL, 'Singh', 'afixi.satya@gmail.com', '63576', 0, 'M', NULL, '34_2.jpg', NULL, 0, 0, 567, 37, '1,2,5', 0, 130, '0000-00-00 00:00:00', '2011-09-05 00:32:35', 3448799, '0', 1, 1, '530622141,867010392,1003925137,1142223201,1264224935,1294743391,1570944230,1583047333,1619642862,1733561600,100000315094310,100000480065272,100000512297270,100000531370678,100000536581618,100000537974030,100000581874927,100000604432861,100000915508944,100000920507839,100000921678158,100000922024239,100000922698258,100000998291381,100001081442187,100001110672752,100001133203177,100001153423456,100001159115544,100001232541408,100001302473511,100001357111730,100001403210505,100001421572079,100001446343747,100001616530522,100001742965429,100001764383594,100001771058615,100001805692522,100001815700472,100001876660907,100001910353516,100001940613950', '100001616530522', '3,10,32', 1, '2011-07-27 00:13:36', '117.201.160.101'),
(35, '641286114', 'Delos Faith Chang', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/202922_641286114_6458289_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/202922_641286114_6458289_q.jpg', 'Delos', 'Faith', 'Chang', 'lol.i.laugh@gmail.com', '45387', 0, 'M', NULL, '35_neutral_truestory.png', NULL, 0, 0, 139, 3, '1', 0, 21, '0000-00-00 00:00:00', '2011-09-04 23:18:20', 3373386, '0', 1, 1, '1210794,2344595,3325693,3326091,6421032,43907949,500108689,500571416,500677183,500677196,500741172,500769042,500798869,500846571,501218633,501288743,501304937,501332310,501334389,501346679,501380300,501467289,501693379,501786928,501978450,502045144,502379708,502470266,502558106,503108021,503109235,503136638,503318090,503451432,503460504,503530231,503547066,503626053,503702105,503778884,503794653,503806255,503814579,503884247,503912947,503965618,504058116,504089825,504092580,504102286,504146738,504150210,504183810,504390934,504392586,504991653,504995058,505082387,505091148,505298638,505340622,505368775,505377869,505543544,506275818,506315895,506353598,506366987,506465408,506705990,506710648,506786498,506788892,506806075,506924771,507004217,507274150,507321111,507397086,507493860,507688178,507756470,507775283,507800257,507857722,507868978,507917340,508011458,508037588,508044161,508063184,508155581,508171040,508216353,508219261,508270991,508330469,508446500,508645165,508862780,509037813,509226808,509389605,509617497,509737095,509770181,509956748,510431944,510516666,510884076,510946537,511042197,511048206,511072717,511214405,511537311,512010854,512064380,512199780,512451884,513278168,513991055,514436444,514596961,514935929,516011401,516452867,516669329,516835907,516885724,517406509,517717898,518307082,518483903,519833723,519942471,520275602,520406697,520456416,520467667,520472017,520542607,521064119,521171014,521295465,521636907,521782151,522983945,523127065,523392116,523393064,523985806,524335015,524913457,524935931,524960868,525136847,525782929,526225218,526414907,526415876,526634740,526990459,527472080,528040881,528138012,528375875,528627274,528971649,529539425,529743103,529858353,530270206,530540138,531096567,531358751,531446314,531570297,532500758,535322188,536395497,536446901,537063682,537432129,537462097,537636867,537981998,538075212,538911261,539080537,539655910,539675643,539731207,539835715,540129505,540175482,540326818,540832914,541221941,541259857,541329657,541597010,541862572,542079164,542166762,542988471,543116487,543622740,543726096,544216245,544707049,545236826,545485729,545526905,545921755,546033375,546295538,547247655,547520892,547625010,547866671,547950756,548194492,549460778,549618546,549673437,550189669,550579342,550953040,551532929,551594399,551706070,551911505,552386935,553020873,553117577,553306693,553386201,553482439,553614304,553860038,555660570,557403945,557406828,557774663,559664992,559725961,560240635,560493058,560585849,560762268,561051884,561077007,561310032,561325449,561426135,561470319,561571744,561982106,562210210,562215125,562232238,562431130,562534866,563142960,563508297,563551358,564296473,564379482,564385091,565051781,565538586,566146150,567104911,567286931,567462571,567934244,568070207,568786400,568900918,569584824,569701299,569756358,570006024,570061265,570140198,571066847,571374656,571813792,573730620,574018828,574474788,574482017,574639522,574751978,574782096,575276564,576036239,576120299,576290212,576898232,577476316,577531110,577882138,578493593,578583114,579338114,579401982,579415038,579881084,579966928,580056942,580345752,580406462,580794304,583078244,583180686,583422424,583720876,584270499,584547876,584955595,585035940,585798941,586295851,586320408,586597773,587606969,587630201,587808230,587847888,587894202,588211737,588238828,588593162,588917866,589088344,589194342,589232952,589320151,590051316,590422494,590476153,590625571,590636482,591180830,591427004,592541163,592691025,592834765,593308265,593712622,593839191,594170629,594502929,595678085,596064149,596415693,596477759,596620062,596745186,597172018,597657154,597821975,598333553,598953968,598971568,599718184,599796227,600324552,600777048,600887781,601070232,601152734,602045948,603147533,603459438,604342604,604445241,604497781,604704744,604889068,605906106,605989950,606514832,606815247,606996094,607102742,607666012,608163277,608340800,608785949,608940335,608986250,609120402,609443708,609464815,609698472,610969467,611122703,612116001,612491149,613062446,613361645,613556017,613613202,614100650,615432540,615984658,616280904,616287748,616463154,616486500,616955239,617201172,617351566,617522324,617882893,618001044,618791270,619043074,619215972,619977802,620589814,622174047,622510059,623105475,623170528,623641137,623970872,624126144,624179066,624565873,624731179,625212223,625271935,625336893,625676885,626022535,626374521,627582266,627876385,628801000,629130621,629331538,629368868,629436419,630605041,630797813,630840929,631205405,631476191,631575313,631648722,631840305,631855291,632079553,632528832,632766398,633127731,633295139,633625054,633780064,634643240,635207243,635939883,636376573,636457597,636605844,636856153,637274186,637443593,637586347,637848205,637850939,639166404,639414438,639571980,639802048,640365729,640586847,640793370,640842529,640963816,641403241,641728412,641975254,642103994,642300327,642430915,642506042,642736007,642837733,642842895,643205425,643337285,643444497,643548985,643568199,643887482,644025837,644077668,644293914,644801947,645336666,645420839,645719911,646136316,646510946,646682061,646990764,647886254,647891829,649966319,650131207,650267526,650415859,650448172,650666480,651396478,651645449,652150607,652510472,653587832,653611992,653630830,654255034,654259502,656226386,656250057,656282634,656365482,656812570,656960164,656997823,657151248,658161647,658538852,658626875,658720346,658816678,659045241,659696393,659935672,660048676,660517924,660716205,660799851,661667734,661695053,662553134,662611644,662724047,663035347,663116997,663191061,663481213,663817188,664086966,664250530,664792027,665132223,665568862,665943623,666288961,667360168,668026943,668127753,668372353,668407098,668547124,668583411,668640385,668798596,668996235,669395788,669499326,670146973,670245467,670386277,670600599,670662334,671750691,672080468,672134065,672831392,673512078,673906681,674095604,674605054,675301612,675320577,675428855,675479713,675987126,676676038,676911402,677805387,677921014,677993693,678258318,678686815,678968277,679704407,679803311,680115391,680295304,680296487,680320351,680613377,680755541,680875607,681270192,681662615,681865566,681880104,681960514,681983139,682170300,682209141,682255623,682390151,682405178,682840063,682904697,683022624,683135592,683156216,683192833,683370190,683536413,683900023,684015573,684155706,684162600,684870669,685775340,685932342,686537616,686772906,687020587,687065010,687422745,688670353,688832666,689186923,689295346,689440790,689556698,689847208,690200939,690767129,691220383,691237370,691398804,692151853,692212745,692272385,692957108,693030112,693442232,693461835,693512076,694681650,694864383,694923486,695231330,695408893,695606466,696169601,697044357,697565483,697639142,697755345,697762586,698085244,698100612,698706281,699306197,699409244,700755262,702079012,703270281,703501953,704881259,705730696,705766033,705832734,706191994,707178593,707508383,709073321,709076788,709806675,710545319,710622273,711275645,711352385,711656998,711736912,712917872,713634176,714172059,714238320,714516178,714605517,714957594,715071586,715278861,715543145,715600042,715652232,715670766,715992876,716262492,716448592,716561696,716584451,716740374,717151802,717568867,717585789,717640337,718570342,719611912,719746894,720045007,720320848,721021405,721679799,722026655,722303976,722369691,723100992,723165117,723396875,723712740,723916883,724672831,724677343,724797562,724930670,725190519,725261712,726387763,726465963,727022923,727522155,727586102,727788303,728296932,729559225,729689950,729965044,730067180,730696178,731010262,731761582,732171430,732675012,734365305,734708966,735070990,736243914,738408804,739099387,739675081,740552455,741593686,741701494,742129740,742541972,746315104,746569605,747842603,748170297,749275995,750268601,750704611,750903872,751018509,751938924,752570544,754585596,755121453,755970244,756165716,756316386,756475374,756915205,758028277,760719336,762093454,763340541,764340219,765154103,767006994,767052831,767085108,767590704,767714993,768118453,769317199,769671529,769975056,770180074,771088076,771549744,772829557,773738141,774206467,775233707,776225460,776804889,778475299,779160251,779330243,779700033,780993008,781991631,782560138,784965401,788655595,791592505,791859748,794444568,794825506,795460073,795730523,795760642,796187924,805775496,805800404,806439501,811500242,813495077,813700426,815375157,815733278,817447421,819951505,821250337,821822500,822325159,822563775,825639242,829017597,829506101,833235596,833420323,833980533,834129055,835440230,842555610,843849213,844445163,844475433,844659340,846490270,848155290,848770223,850495095,855084083,856210091,856250482,867195460,867710120,869930544,881725522,883200462,883695150,887690141,890405211,894300061,899055362,904315636,1004229275,1005413730,1005510331,1005557186,1009892061,1010761532,1011857219,1012361985,1013393232,1013430695,1013730218,1014858331,1014884676,1015080080,1018530280,1019949312,1020877867,1021891788,1022395990,1023051207,1023495769,1023795610,1027797107,1029428025,1032125097,1032900484,1035408926,1035732127,1036380075,1036380103,1036380230,1036380235,1036380312,1036380321,1036380442,1036380445,1036380477,1036380566,1036380573,1036380604,1036380626,1036380630,1036380673,1036380754,1036380760,1036380761,1036380766,1036380776,1036380777,1036380778,1036380779,1036380790,1036380791,1036380792,1036380793,1036380795,1036380799,1036380800,1036380801,1036380807,1036380809,1036380813,1036380818,1036380829,1036380839,1036380840,1036380843,1036380846,1036380849,1036380853,1036380854,1036380857,1036380858,1036380863,1036380865,1036380884,1036380887,1036380893,1036380894,1036380895,1036380896,1036380900,1036380914,1036380916,1036380923,1036380928,1036380937,1036380938,1036380939,1036380941,1036380950,1036380966,1036380978,1036380989,1036380992,1036380996,1036380998,1036381001,1036381002,1036381014,1036381015,1036381017,1036381023,1036381028,1036381032,1036381034,1036381060,1036381063,1036381074,1036381129,1036381144,1036381146,1036381160,1036381166,1036381167,1036381168,1036381184,1036381188,1036381198,1036381222,1036381231,1036560283,1036590001,1038674804,1040352463,1041870067,1042898379,1043010487,1044317317,1044398310,1044655084,1046580086,1047210022,1047210177,1047210275,1048254635,1048260162,1048260170,1048260178,1049580814,1050000408,1052932544,1053444813,1054530605,1054530632,1055116772,1055670430,1055705007,1055790106,1055790188,1055790259,1055790478,1055790479,1055790537,1055790542,1055790543,1055790552,1055790561,1055790563,1055790564,1055790567,1055790568,1055790569,1055790570,1055790572,1055790575,1055790577,1055790578,1055790579,1055790580,1055790586,1055790603,1055790606,1055790611,1055790612,1055790624,1055790626,1055790638,1055790654,1055790667,1055790671,1055790677,1055790684,1055790685,1055790703,1055790707,1055790709,1055790717,1055790718,1055790735,1055790736,1055790741,1055790744,1055790745,1055790748,1055790780,1055790784,1055790786,1055790797,1055790804,1055790825,1055790842,1055790845,1055790846,1055790853,1055790856,1055790863,1055790887,1055790888,1055790896,1055790902,1055790911,1055790919,1055790921,1055790928,1055790929,1055790941,1055790943,1055790945,1055790953,1055790955,1055790969,1055790977,1056900035,1057140144,1057363775,1057890310,1059120428,1059232767,1060185594,1062445445,1062900298,1062930406,1062930530,1063110056,1063110105,1063110320,1063110408,1063110450,1063110456,1063140297,1063140383,1063170274,1063170429,1063170435,1063410145,1063440709,1063440730,1063560238,1063590227,1064520028,1064550214,1065150131,1065330157,1065870274,1065870616,1065870744,1067285992,1073804739,1080131239,1081980552,1082427831,1083180220,1084080920,1084381736,1085671083,1087890627,1087890691,1088010368,1088160935,1088160965,1088161280,1088280942,1088310719,1088490430,1088820193,1089075331,1089970490,1090756418,1092240512,1092510361,1093953733,1096260698,1101420180,1103220464,1109766366,1112040042,1114110923,1114290500,1116000759,1116403752,1119055726,1120786400,1125120843,1128214288,1129170241,1135240832,1135312302,1136209158,1140420409,1143340057,1145101329,1149510312,1149511545,1152555583,1155041153,1155186971,1155208039,1156650587,1158900724,1162101585,1167750424,1170150588,1179108646,1182314828,1182334723,1182407135,1182541206,1183853123,1185218431,1185600163,1186936442,1193191124,1194721855,1195523715,1196774083,1198602742,1199700623,1199806969,1200275783,1200723827,1201577933,1202130887,1202629717,1202913362,1204701456,1204858539,1213616712,1215801507,1218045861,1221660468,1221786332,1222163785,1222740390,1224540322,1225560296,1227570875,1227571017,1227840273,1229040280,1229220778,1230702369,1230930344,1232400645,1232400664,1232400726,1232401356,1233330664,1233486698,1233600174,1234260708,1234260859,1234440134,1234710563,1235580117,1236480220,1236872146,1237920343,1237920540,1237920663,1237920766,1238280401,1238370363,1238370366,1239310241,1239930398,1240830567,1241550640,1241550651,1242030294,1244582774,1245751060,1246290144,1246950129,1248590214,1253041533,1259033120,1261366382,1263932120,1273446804,1274253661,1280610251,1280790051,1283414140,1283533069,1288473381,1290587224,1297552770,1301297344,1302403857,1304428754,1306014594,1307820482,1308361031,1309200864,1310394876,1315641614,1319508799,1321355240,1324415510,1326360269,1326450325,1326767762,1328130367,1328130551,1329091143,1329450343,1330230494,1331010863,1331280499,1331454319,1332240398,1334070379,1334200206,1335600143,1335643414,1335906546,1336774378,1338150281,1341690424,1341690585,1341720319,1342260223,1347751887,1351920929,1352283895,1352441734,1352910399,1353078864,1355835558,1356541114,1357638495,1357771233,1358100584,1361010212,1364860471,1365900227,1366133353,1366800146,1368000651,1368751451,1368751661,1368751793,1368752177,1368810366,1368810444,1369873172,1370520202,1372300544,1373642446,1373700631,1373700862,1373820633,1373896180,1374361076,1376035802,1376521067,1376521383,1378914297,1380150259,1380330366,1380420064,1380510139,1380600263,1381200437,1381200715,1381574438,1385509409,1386960869,1387860250,1391040758,1391040765,1392252577,1396885883,1397745352,1398065982,1398782360,1402177212,1403405966,1404331286,1409834204,1412323873,1414020317,1417937800,1418108037,1420860090,1421040177,1421325624,1421610272,1422020799,1422516857,1425921974,1427594454,1429356576,1433670319,1434630012,1436693863,1439498008,1441163968,1441188547,1441542268,1445310718,1446463625,1447080973,1447830310,1448208598,1450808944,1452561053,1454280209,1457347207,1459033170,1466042053,1470376298,1473503369,1473507468,1476421566,1476468215,1479090236,1479930038,1480650953,1483175686,1484730089,1488000492,1490444928,1493808102,1497417210,1508696821,1511070439,1511100352,1514605290,1516284290,1518031261,1521387740,1521481648,1521773968,1522317475,1535113344,1541701534,1543083594,1543672236,1545243705,1545606490,1547610137,1547730315,1548210359,1548972187,1552902214,1556040080,1563510397,1566443990,1570602325,1572451295,1572480453,1575881012,1577497260,1581125047,1584004907,1586018157,1590309878,1601855252,1605175266,1606170301,1624835872,1633110044,1638903996,1638930188,1639852511,1644707031,1645298842,1658550239,1665728407,1672596334,1674284706,1676990651,1723971188,1740172144,1746392783,1764966203,1768318155,1781850002,1796953374,1801433305,1807493090,1809458927,1814804511,1820631148,1844733420,100000004525633,100000023175730,100000030549952,100000034065577,100000034239475,100000044133429,100000047509733,100000056584899,100000065941281,100000070832424,100000071410880,100000073835490,100000075640635,100000076414977,100000097053761,100000097400239,100000104275451,100000107092336,100000126519308,100000144006109,100000145202454,100000151850078,100000151873967,100000152164239,100000158580376,100000161923865,100000168274602,100000202810453,100000204655703,100000261469339,100000341991171,100000370327552,100000393351612,100000449443512,100000487697952,100000492651764,100000502059557,100000515371880,100000568845624,100000572010209,100000583847766,100000594822991,100000658485617,100000719947022,100000756946299,100000789194041,100000817477852,100000836274700,100000875402940,100000903040670,100000905636106,100000909903550,100000920031426,100000936735995,100000942600577,100000947084131,100000964164856,100000973570106,100000982550369,100000997302083,100001031990479,100001045653063,100001078752221,100001079303716,100001081311062,100001133648752,100001136649561,100001139147589,100001175624310,100001214282702,100001254062489,100001291255146,100001292777767,100001303065622,100001309741054,100001327664944,100001352292000,100001410006764,100001444614347,100001467431818,100001597261050,100002058171310,100002268100463,100002590204959', '541259857', '2,3,36', 1, '2011-07-27 21:00:39', '64.120.96.139'),
(36, '541259857', 'Muaz Siddiqui', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/41629_541259857_2335_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/41629_541259857_2335_q.jpg', 'Muaz', NULL, 'Siddiqui', 'muazs786@gmail.com', '59293', 0, 'M', NULL, '36_megusta_creepy.png', NULL, 0, 0, 64, 0, NULL, 0, 13, '0000-00-00 00:00:00', '2011-09-04 19:02:19', 1297335, '0', 1, 1, '213145,507274,1240959,2344595,3204374,3502009,33309822,500150470,500632115,500957104,501218633,501487359,501745548,502299176,502558106,504392586,504706254,504991653,505012700,505018401,505368676,506298078,506786498,506806075,507004217,507139983,507184653,507274150,507397086,507521208,507674892,507800257,507989314,508044161,508063184,508155581,508191693,508428289,508446500,508645165,509250531,509770181,509779528,509921817,509956748,510500450,512010854,512199780,512461616,512533273,513095284,513312882,513627559,513926740,514508136,514626145,515134469,515365090,515597774,515673866,515964621,516885724,517297704,517710202,519608921,519820680,519833723,520406697,520456416,520567988,521295465,521636907,521782151,521932303,523985806,524335015,524366580,524913457,525782929,526050246,526079201,526390644,526414907,526554318,526990459,528040881,528117820,528138012,528375875,528619342,528627274,528971649,529173346,529743103,530422966,531096567,531358751,531382804,531454000,531551315,532789579,533655378,534385011,534535152,535470992,535518294,535962753,535977176,537768571,538075212,538911261,539655910,539835715,540464739,540752784,540832914,541459047,541862572,542601685,543024128,543153495,543622740,543726096,544216245,544707049,545236826,545526905,545600420,546295538,547247655,547260981,547625010,547866671,549316900,549460778,549618546,549673437,550154176,550953040,551594399,551706070,552343819,552688682,552770316,553117577,553583861,553614304,554976202,557122433,559657089,559725961,560762268,561310032,561325449,561426135,561571744,561705802,561982106,562210210,562215125,562232238,562431130,562534866,562537693,562880787,563726995,564135351,566518407,567368828,567934244,568017189,568150580,568569551,568786400,568900918,568960028,569701299,569756358,569792094,570140198,571374656,571813792,571873524,571968578,572542260,572749841,574482017,574782096,575945940,576120299,577476316,577882138,578874504,578993464,579049758,579401982,579866444,579881084,579966928,580345752,580380642,580406462,580794304,580959146,583078244,583422424,583720876,583887153,583942013,584547876,584581807,584840615,585035940,585474492,585565457,585755744,585923988,586320408,586408082,587847888,587894202,588238828,588546825,589165201,589194342,589320151,589482161,589719761,590476153,591122159,591180830,591634510,591884578,592471334,593308265,593702597,594037671,594046135,594385065,594738486,594752643,595021905,595036640,596283853,596665976,596678637,598953968,599430758,599796227,599825434,599946524,600777048,600887781,603459438,604243169,604499281,604889068,605635416,605906106,605989950,606815247,606996094,607666012,607930319,608103202,608163277,608722845,608785949,608940335,608986250,609120402,609603064,612260122,613062446,613361645,615023339,616076507,617201172,617882893,618001044,618791270,619215972,619834368,620095832,621652057,623105475,623170528,623641137,624565873,625614739,625676885,625700737,625802790,626142925,626374521,627761859,628791000,628801000,629130621,629436419,629689629,630797813,630840929,631752529,632528832,633295139,634643240,635174941,635207243,635247306,635261134,635425454,635761694,636605844,636611846,636654150,637274186,637443593,637460591,637495976,637850939,639035486,639414438,639571980,639597969,639608957,640793370,640963816,641286114,641457577,641512455,641728412,642430915,642506042,642837733,643312799,643568199,643620961,644077668,644801947,645420839,645507269,645561548,645719911,646682061,647886254,648070884,648680605,648917748,649477733,649966319,650131207,651389972,651396478,651645449,652006873,652237497,652355319,653630830,656226386,656282634,656960164,657151248,657808139,658440118,658538852,659045241,659941476,660125602,660716205,661948370,662105542,662940827,663191061,664086966,665175549,666876145,668026943,668127753,668583411,668906380,669367424,669395788,669499326,670257506,670886797,672325112,672884947,673448153,673512078,673882243,673906681,674047651,674605054,674845454,674959179,675479713,676028884,676310572,676676038,677515385,677735609,678018032,678099223,678931616,678968277,679219851,680115391,680280166,680295304,680296487,680613377,680755541,680875607,681880104,682170300,682209141,682255623,682376249,682390151,682840063,683370190,684015573,684162600,684435726,685060149,685598733,685775340,686435295,686519675,688832666,688890438,689186923,689241680,689847208,690918492,691220383,691586472,691590371,691594464,692151853,692449023,692557607,694923486,695195937,695408893,695491178,696998701,697170766,697730752,698473611,699306197,703205353,705730696,707508383,707921658,708201726,709076788,709856331,710545319,710622273,711633995,711736912,713048009,713388169,713670241,713842370,714085412,714605517,715031475,715600042,716327834,716561696,716584451,717151802,717160546,718086799,718895453,718945174,720320848,720905296,721508516,722303976,722459286,723106137,723712740,723721556,724207616,724635020,725190519,725261712,725793241,727522155,727586102,727788303,728601158,729485483,729492500,730241709,730552795,730864781,731761582,731835994,732171430,732226995,732305199,733341776,733750527,734365305,735070990,736243914,738210701,739675081,740453241,742125738,742135030,744670622,746830272,747842603,748170297,749381777,750268601,752570544,752863237,753860713,754090155,754440552,754564681,754585596,754753540,755155044,755970244,756165716,756475374,756788372,757555993,758061017,758659877,760261763,760319466,760672455,761849744,761946227,763921158,764649425,765564369,766116795,767085108,767714993,769317199,771088076,772785242,773500161,773738141,774849360,775023687,775120009,775233707,776615253,776804889,776918992,779700033,780979847,780993008,782202570,784965401,789690530,795985050,797618045,801500234,803605602,804230083,804875057,805800404,806190626,806439501,806805450,807013929,807250248,808305556,808805542,809205544,811500242,813700426,815155216,815733278,816491379,817447421,819951505,821250337,822563775,826360726,827029319,827602069,828909164,829017597,830153274,830793507,831057079,833867765,844659340,847705205,848770223,851939874,855084083,862615634,876510712,878230606,881695584,882125121,889640703,895290595,899055362,902735471,904315636,1000622703,1004229275,1007658837,1008789379,1009650805,1011857219,1015616276,1017384088,1019580298,1020877867,1021918418,1022325730,1023495769,1029358908,1032125097,1034700027,1036350068,1036350294,1036350372,1036350494,1036350564,1036350611,1036350620,1036380630,1036380775,1036380799,1036380807,1036380829,1036380865,1036381017,1036381144,1036530398,1036530432,1036590411,1038750365,1038750529,1038750583,1038750628,1040105991,1040352463,1044317317,1044398310,1044655084,1045373237,1047210177,1047240269,1047503759,1047547281,1047882275,1047990097,1048340683,1049010352,1049580902,1050273290,1050540117,1051140042,1051380080,1054530457,1054830104,1055040480,1055670142,1055670383,1055790407,1055790478,1055790479,1055790537,1055790543,1055790552,1055790567,1055790568,1055790569,1055790570,1055790572,1055790573,1055790577,1055790578,1055790580,1055790586,1055790603,1055790611,1055790612,1055790624,1055790626,1055790654,1055790667,1055790671,1055790677,1055790684,1055790685,1055790687,1055790703,1055790707,1055790717,1055790718,1055790720,1055790735,1055790738,1055790741,1055790744,1055790745,1055790748,1055790780,1055790784,1055790786,1055790797,1055790804,1055790810,1055790825,1055790834,1055790842,1055790846,1055790848,1055790856,1055790863,1055790887,1055790888,1055790896,1055790902,1055790911,1055790919,1055790921,1055790928,1055790929,1055790941,1055790943,1055790945,1055790953,1055790969,1055790977,1055850090,1057273684,1058340118,1059630135,1060185594,1061466712,1061804407,1062782377,1062960080,1063110408,1063440678,1063830361,1064280294,1064730143,1064790260,1067519339,1069840506,1071441442,1072620126,1072811916,1073836386,1075980302,1077489148,1082427831,1085051464,1086780441,1086980145,1092936179,1094719184,1117300774,1119055726,1122025828,1125240101,1125300247,1129093610,1129882017,1131024705,1132541558,1135872371,1144212911,1159650318,1161961196,1168690551,1180308284,1190701580,1193233917,1195824363,1199806969,1200275783,1200372792,1200823677,1201146822,1201230156,1205324977,1206085471,1219836697,1221786332,1229670302,1233674984,1236060114,1241820160,1241957123,1247922542,1248687875,1251274445,1251946949,1253026150,1255431891,1256335945,1257262979,1257878895,1258510915,1260453148,1262755104,1263932120,1266857867,1267591456,1273341498,1277056281,1278657323,1280610251,1283414140,1288473381,1296860939,1298026514,1300917319,1301864368,1303536232,1306546933,1307784626,1310394876,1310616861,1313029219,1315163517,1315641614,1318550858,1319508799,1322017178,1324633392,1327020396,1328405526,1329317643,1331454319,1331841275,1335330728,1336774378,1337361554,1347587128,1349149627,1353741303,1355835558,1357638495,1358870076,1363134996,1363603059,1371460765,1371544479,1379014716,1379370328,1379715943,1385126813,1385509409,1386960869,1389171085,1396163494,1397139653,1397745352,1402653886,1403233271,1409093481,1409248102,1409563544,1414981518,1417355548,1420997855,1421325624,1422638395,1422914196,1423038907,1429554742,1433615272,1433852875,1435350551,1436693863,1439330273,1439351238,1439926432,1441163968,1441188547,1441542268,1446463625,1455320344,1457375933,1458747483,1459546332,1463024136,1466042053,1467427382,1475820270,1480650953,1480953604,1482909311,1490444928,1493808102,1502706254,1503320291,1506342121,1513516357,1516284290,1517618131,1520116904,1521773968,1529731135,1530000346,1531874222,1534316312,1536240175,1541701534,1542390080,1545000117,1545706104,1547730362,1548210359,1551241650,1552902214,1553731524,1560693528,1561257094,1566443990,1568091832,1571138650,1584004907,1593948182,1595437417,1597594241,1600744665,1607961802,1614012125,1617174805,1619254849,1624835872,1630052854,1637127147,1637244015,1642607377,1645298842,1648500181,1654328155,1658071319,1669500220,1678129517,1686199994,1723971188,1781850002,1796953374,1807493090,1808199630,1813943845,1814804511,1815952374,1816756187,1825006412,1844733420,1845862655,100000000978798,100000007606442,100000014153450,100000015275474,100000027052105,100000030549952,100000033392907,100000044133429,100000047509733,100000047671775,100000055621299,100000063273006,100000073835490,100000075640635,100000077570611,100000093924861,100000097053761,100000099298130,100000122377765,100000145202454,100000147819320,100000149717845,100000156661208,100000158706258,100000161923865,100000182160130,100000182853020,100000202810453,100000213146004,100000215512503,100000238579602,100000253943428,100000259740268,100000288978603,100000293421029,100000308856253,100000372456550,100000395190709,100000449088785,100000450230611,100000463302096,100000477244963,100000515371880,100000539402521,100000539756733,100000572010209,100000579778896,100000583847766,100000605640242,100000616785249,100000619432663,100000626713928,100000633085360,100000641476257,100000673268482,100000756946299,100000787621844,100000803256740,100000850257967,100000872271407,100000875372697,100000915181684,100000915715107,100000942600577,100000982177893,100000994791610,100001012237446,100001016901351,100001040043047,100001069581904,100001093609665,100001102630565,100001107483308,100001178142955,100001184799848,100001202180347,100001202714251,100001218767373,100001254062489,100001257013466,100001264039053,100001289791047,100001290452329,100001292777767,100001327664944,100001341426045,100001393194557,100001406960115,100001455893928,100001457355003,100001519925951,100001553563461,100001562114495,100001562698238,100001669014374,100001683499704,100001712635609,100001801519146,100001804672352,100001816345274,100001860256630,100001881692146,100001916158483,100001959002806,100002006828014,100002136740975,100002145791460,100002157950496,100002178403447,100002252308147,100002377465322,100002409968295,100002454288486', '', '35', 1, '2011-08-20 17:47:10', '198.94.221.87'),
(37, '100001771058615', 'Manab Rout', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/161191_100001771058615_6569135_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/161580_100001771058615_1357001_q.jpg', 'Manab', NULL, 'Rout', 'manab.rout@afixi.com', '82881', 0, 'M', NULL, NULL, NULL, 0, 0, 10, 0, NULL, 0, 1, '0000-00-00 00:00:00', '2011-09-03 01:26:44', 237, '0', 1, 1, '507133377,530622141,530857535,537383092,540568330,666862041,692531709,867010392,1020504396,1126785811,1142223201,1230452951,1245524100,1258166929,1264224935,1283808242,1294743391,1310371944,1383117378,1408418201,1428189257,1430915328,1446577899,1465955508,1474535590,1474625572,1486813012,1500881687,1511974562,1514392739,1529122893,1531122822,1532062822,1535542640,1545922828,1549132521,1553872926,1564525913,1565932601,1583047333,1589152919,1591792663,1595212606,1604063058,1610152840,1619642862,1622512501,1625392669,1625795307,1635270427,1642882457,1683771209,1707030872,1733561600,1761480862,1776721117,1830987964,100000002319856,100000036893352,100000078519719,100000111218790,100000148426879,100000149149778,100000161128627,100000197611683,100000273364960,100000281882356,100000315094310,100000377845640,100000387026365,100000442897813,100000455389294,100000531370678,100000536581618,100000537974030,100000574928859,100000581874927,100000702678535,100000905074681,100000915508944,100000922024239,100000943848221,100000982826781,100000997546280,100001032359108,100001043142073,100001072110922,100001081442187,100001108771411,100001110672752,100001165747839,100001211690224,100001232541408,100001255779105,100001307018573,100001317391645,100001344642044,100001350826269,100001446343747,100001464824239,100001503582853,100001513104417,100001582779314,100001595236014,100001616530522,100001635707290,100001639947137,100001656098225,100001708898669,100001742965429,100001764383594,100001772045330,100001789301962,100001794520903,100001805692522,100001808616396,100001820785440,100001839285403,100001875633369,100001876660907,100001910353516,100001939242938,100001960283906,100001974335498,100001987614672,100001990678789,100001996567722,100002004606035,100002017584782,100002044224951,100002080465002,100002143188058,100002187058694,100002203989794,100002237802534,100002248472151,100002254180870,100002254395301,100002328711915,100002369603188,100002435291489,100002506096478,100002532884461,100002545572345,100002559345302,100002600373707,100002614523461,100002626765567,100002650717963', '', NULL, 1, '2011-09-03 01:22:46', '117.201.148.167');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `memeje__caption`
--
ALTER TABLE `memeje__caption`
  ADD CONSTRAINT `memeje__caption_ibfk_1` FOREIGN KEY (`id_meme`) REFERENCES `memeje__meme` (`id_meme`) ON DELETE CASCADE;

--
-- Constraints for table `memeje__leaderboard`
--
ALTER TABLE `memeje__leaderboard`
  ADD CONSTRAINT `memeje__leaderboard_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `memeje__user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `memeje__login`
--
ALTER TABLE `memeje__login`
  ADD CONSTRAINT `memeje__login_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `memeje__user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `memeje__meme`
--
ALTER TABLE `memeje__meme`
  ADD CONSTRAINT `memeje__meme_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `memeje__user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `memeje__reply`
--
ALTER TABLE `memeje__reply`
  ADD CONSTRAINT `memeje__reply_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `memeje__user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `memeje__reply_ibfk_2` FOREIGN KEY (`id_meme`) REFERENCES `memeje__meme` (`id_meme`) ON DELETE CASCADE;

DELIMITER $$
--
-- Procedures
--


DROP PROCEDURE IF EXISTS `get_max_recs`$$
CREATE PROCEDURE `get_max_recs`(IN tab VARCHAR(300),IN col VARCHAR(500),IN  cond VARCHAR(500))
BEGIN
SET @QUER = CONCAT("SELECT ",col," FROM ",tab," WHERE ",cond);
PREPARE stmt FROM @QUER;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
END$$

DROP PROCEDURE IF EXISTS `get_search_sql`$$
CREATE PROCEDURE `get_search_sql`(IN tb_name VARCHAR(100),IN cond TEXT,IN cols TEXT)
BEGIN                                      
 IF cond ='' THEN                    
   SET @p := CONCAT('SELECT ',cols,' FROM ' , tb_name);       
 ELSE
   SET @p := CONCAT('SELECT ',cols,' FROM ' , tb_name,' WHERE ', cond);           
 END IF;
 PREPARE stmt FROM @p;
 EXECUTE stmt;
 DEALLOCATE PREPARE stmt;
END$$

DROP PROCEDURE IF EXISTS `insert_proc`$$
CREATE PROCEDURE `insert_proc`(IN tab_name varchar(30),IN cols varchar(500),IN vals varchar(500),OUT id INT)
begin

set @quer = concat('insert into ',tab_name,'(',cols,') values (',vals,')');

prepare stmt from @quer;

execute stmt;

deallocate prepare stmt;

select last_insert_id() into id;

end$$


DROP PROCEDURE IF EXISTS `update_proc`$$
CREATE PROCEDURE `update_proc`(IN tab_name varchar(50),IN parms varchar(1000),IN cond varchar(500))
begin

set @quer = concat('update ',tab_name,' set  ',parms,' where ',cond);

prepare stmt from @quer;

execute stmt;

deallocate prepare stmt;

end$$

DELIMITER ;
=======
-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2011 at 12:32 AM
-- Server version: 5.0.90
-- PHP Version: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demos4clients_com_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `memeje__allotpoints`
--

DROP TABLE IF EXISTS `memeje__allotpoints`;
CREATE TABLE IF NOT EXISTS `memeje__allotpoints` (
  `id_allot` int(11) NOT NULL auto_increment,
  `point_type` varchar(50) collate utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY  (`id_allot`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `memeje__allotpoints`
--

INSERT INTO `memeje__allotpoints` (`id_allot`, `point_type`, `points`) VALUES
(1, 'meme_insert', 10),
(2, 'answer_to_meme', 10),
(3, 'insert_caption', 10),
(4, 'honour', 1);

-- --------------------------------------------------------

--
-- Table structure for table `memeje__badge`
--

DROP TABLE IF EXISTS `memeje__badge`;
CREATE TABLE IF NOT EXISTS `memeje__badge` (
  `id_badge` int(10) NOT NULL auto_increment,
  `image_badge` varchar(200) collate utf8_unicode_ci default NULL,
  `title_badge` varchar(50) collate utf8_unicode_ci NOT NULL,
  `desc_badge` text collate utf8_unicode_ci,
  `expr_point` int(10) NOT NULL,
  `badge_type` varchar(20) collate utf8_unicode_ci NOT NULL,
  `badge_type_number` int(10) NOT NULL,
  `glory_badge_point` int(10) NOT NULL,
  `is_glory_badge` int(1) NOT NULL,
  `ip` varchar(16) collate utf8_unicode_ci NOT NULL,
  `start` varchar(10) collate utf8_unicode_ci NOT NULL default '0',
  `end` varchar(10) collate utf8_unicode_ci NOT NULL default '0',
  `add_date` datetime default NULL,
  PRIMARY KEY  (`id_badge`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `memeje__badge`
--

INSERT INTO `memeje__badge` (`id_badge`, `image_badge`, `title_badge`, `desc_badge`, `expr_point`, `badge_type`, `badge_type_number`, `glory_badge_point`, `is_glory_badge`, `ip`, `start`, `end`, `add_date`) VALUES
(1, 'Afixi_54.jpg', 'Congratch!! You have crossed 100 experience point.', 'This achievement can be achieved after getting 100 experience points.', 0, 'exp_point', 100, 0, 0, '117.197.233.105', '0', '0', '2011-07-16 07:28:28'),
(2, 'Afixi_55.jpg', 'You have crossed 200 experience points.', 'After getting 200 experience points you will get this achievement.And Experience point can be won by posting meme ,replying meme,suggesting caption,etc.', 0, 'exp_point', 200, 0, 0, '117.197.233.105', '0', '0', '2011-07-16 07:30:00'),
(3, 'Afixi_51.jpg', '100 duels won', 'This achievement can be achieved after wining 100 duels.', 0, 'duels_won', 100, 0, 0, '117.197.233.105', '0', '0', '2011-07-16 07:31:56'),
(4, 'Afixi_50.jpg', '100 times question of the week won.', 'This achievement can be achieved after getting 100 times question of the week won.', 0, 'ques_week_won', 100, 0, 0, '117.197.233.105', '0', '0', '2011-07-16 07:32:53'),
(5, 'Afixi_56.jpg', 'Crossing 400 Exp  Points', 'This achievement can be got if your answer of the question is choosen liked most and getting this you also gain some points.', 0, 'exp_point', 400, 0, 0, '117.197.233.105', '0', '0', '2011-07-16 07:33:51'),
(6, 'Afixi_57.jpeg', 'Crossing 888 overall Replies.', 'This achievement can be won after replying over 888.', 0, 'reply', 888, 0, 0, '117.197.233.105', '0', '0', '2011-08-18 04:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__caption`
--

DROP TABLE IF EXISTS `memeje__caption`;
CREATE TABLE IF NOT EXISTS `memeje__caption` (
  `id_caption` int(11) NOT NULL auto_increment,
  `id_meme` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_live` tinyint(2) NOT NULL default '1',
  `caption` text collate utf8_unicode_ci NOT NULL,
  `tot_honour` int(11) NOT NULL default '0',
  `honour_id_user` text collate utf8_unicode_ci NOT NULL,
  `tot_dishonour` int(11) NOT NULL default '0',
  `dishonour_id_u` text collate utf8_unicode_ci NOT NULL,
  `user_status` tinyint(2) NOT NULL,
  `add_date` datetime NOT NULL,
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_caption`),
  KEY `id_meme` (`id_meme`,`id_user`),
  KEY `user_status` (`user_status`),
  KEY `is_live` (`is_live`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `memeje__caption`
--

INSERT INTO `memeje__caption` (`id_caption`, `id_meme`, `id_user`, `is_live`, `caption`, `tot_honour`, `honour_id_user`, `tot_dishonour`, `dishonour_id_u`, `user_status`, `add_date`, `ip`) VALUES
(1, 17, 2, 1, 'its my uncle', 1, '2', 0, '', 0, '2011-08-20 02:49:52', '117.201.160.57'),
(2, 17, 2, 1, 'No its my frnd', 2, '2,4', 0, '', 0, '2011-08-20 02:50:40', '117.201.160.57'),
(3, 4, 2, 1, 'Its madona!!', 1, '2', 0, '', 0, '2011-08-20 03:37:23', '117.201.160.57'),
(4, 24, 3, 1, 'hhhhhhhhhhhhhiiiiiiiiiiiiiiiiiiiii', 0, '', 0, '', 0, '2011-08-20 07:22:10', '117.201.160.57'),
(5, 24, 3, 1, 'hiiiiiiiiii', 0, '', 0, '', 0, '2011-08-20 07:22:52', '117.201.160.57'),
(6, 26, 35, 1, 'YAY thanks pati', 1, '35', 0, '', 0, '2011-08-20 17:40:21', '198.94.221.87'),
(7, 26, 35, 1, 'what the what!', 0, '', 0, '', 0, '2011-08-20 17:46:10', '198.94.221.87'),
(8, 29, 2, 1, 'Best Caption Test', 0, '', 0, '', 0, '2011-08-20 17:57:13', '76.230.233.90'),
(9, 29, 2, 1, 'Best Caption Test 2', 1, '2', 0, '', 0, '2011-08-20 17:57:25', '76.230.233.90'),
(10, 29, 36, 1, 'caption', 0, '', 0, '', 0, '2011-08-20 19:09:21', '108.205.200.122'),
(11, 31, 35, 1, 'this is a caption', 0, '', 0, '', 0, '2011-08-20 19:12:54', '108.205.200.122'),
(12, 34, 2, 1, 'hello', 0, '', 0, '', 0, '2011-08-21 20:54:55', '117.197.233.113'),
(13, 20, 2, 1, 'Hi its test.', 1, '2', 0, '', 0, '2011-08-23 02:26:41', '117.197.253.54'),
(14, 20, 2, 1, 'dasdfsdsfs', 2, '2,34', 0, '', 0, '2011-08-23 02:26:50', '117.197.253.54'),
(15, 42, 2, 1, 'Hi', 1, '2', 0, '', 0, '2011-08-23 02:31:08', '117.197.253.54'),
(16, 42, 2, 1, 'dfd', 2, '2,4', 0, '', 0, '2011-08-23 02:31:25', '117.197.253.54'),
(17, 41, 4, 1, 'dfgkjdfgkjl', 2, '4,3', 0, '', 0, '2011-08-23 03:03:25', '117.197.253.54'),
(18, 41, 4, 1, 'asdasdasdasd', 2, '4,3', 0, '', 0, '2011-08-23 03:03:40', '117.197.253.54'),
(19, 21, 10, 1, 'Hi this for testing purpose', 1, '10', 0, '', 0, '2011-08-23 21:37:56', '117.201.160.173'),
(20, 20, 10, 1, 'jhkjyhh', 0, '', 0, '', 0, '2011-08-23 21:43:58', '117.201.160.173'),
(21, 20, 34, 1, 'Hello testing', 0, '', 0, '', 0, '2011-08-24 06:32:15', '117.197.236.115'),
(22, 21, 3, 1, 'This one is for testing', 0, '', 0, '', 0, '2011-08-24 06:32:49', '117.197.236.115'),
(23, 44, 34, 1, 'For testing purpose', 0, '', 0, '', 0, '2011-08-24 06:35:06', '117.197.236.115'),
(24, 44, 10, 1, 'Hi this for testing purpose', 0, '', 0, '', 0, '2011-08-24 06:35:37', '117.197.236.115'),
(25, 44, 10, 1, 'This again for testing', 1, '3', 0, '', 0, '2011-08-24 06:36:04', '117.197.236.115'),
(26, 44, 3, 1, 'Testingggg', 1, '3', 0, '', 0, '2011-08-24 06:36:51', '117.197.236.115'),
(27, 36, 2, 1, 'asda asdasd', 0, '', 0, '', 0, '2011-08-24 06:40:30', '117.197.236.115'),
(28, 36, 2, 1, 'sdfsdsd', 0, '', 0, '', 0, '2011-08-24 06:41:56', '117.197.236.115'),
(29, 43, 10, 1, 'For testing', 0, '', 0, '', 0, '2011-08-24 06:45:54', '117.197.236.115'),
(30, 43, 3, 1, 'Testing Add caption', 0, '', 0, '', 0, '2011-08-24 06:46:31', '117.197.236.115'),
(31, 43, 34, 1, 'Testing Add Caption--1', 1, '34', 0, '', 0, '2011-08-24 06:49:07', '117.197.239.207'),
(32, 90, 30, 1, 'test', 1, '30', 0, '', 0, '2011-09-02 07:25:59', '117.201.165.160'),
(33, 90, 30, 1, 'hello', 0, '', 0, '', 0, '2011-09-02 07:43:46', '117.201.165.160'),
(34, 38, 34, 1, 'This for testing', 0, '', 0, '', 0, '2011-09-03 00:47:44', '117.201.148.167'),
(35, 87, 36, 1, 'derp', 1, '36', 0, '', 0, '2011-09-04 13:16:53', '67.160.197.181');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__config`
--

DROP TABLE IF EXISTS `memeje__config`;
CREATE TABLE IF NOT EXISTS `memeje__config` (
  `id_config` int(11) NOT NULL auto_increment,
  `name` varchar(100) character set latin1 NOT NULL default '',
  `ckey` varchar(100) character set latin1 NOT NULL default '',
  `value` varchar(255) character set latin1 NOT NULL default '',
  `f_type` varchar(20) character set latin1 NOT NULL default '',
  `f_key` text character set latin1,
  `f_value` text character set latin1,
  `is_editable` tinyint(4) NOT NULL default '1',
  `comment` text character set latin1,
  `id_seq` int(11) default '0',
  PRIMARY KEY  (`id_config`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=241 ;

--
-- Dumping data for table `memeje__config`
--

INSERT INTO `memeje__config` (`id_config`, `name`, `ckey`, `value`, `f_type`, `f_key`, `f_value`, `is_editable`, `comment`, `id_seq`) VALUES
(62, 'GENDER', 'M', 'Male', 'text', '', '', 0, '', 0),
(63, 'GENDER', 'F', 'Female', 'text', '', '', 0, '', 0),
(71, 'IMAGE', 'image_orig', 'image/orig/', 'text', '', '', 0, '', 0),
(72, 'IMAGE', 'image_thumb', 'image/thumb/', 'text', '', '', 0, '', 0),
(73, 'IMAGE', 'image_prev', 'image/prev/', 'text', '', '', 0, '', 0),
(74, 'IMAGE', 'preview_orig', 'preview/orig/', 'text', '', '', 0, '', 0),
(75, 'IMAGE', 'preview_thumb', 'preview/thumb/', 'text', '', '', 0, '', 0),
(84, 'LANGUAGE', 'English', 'en', 'text', '', '', 0, '', 0),
(90, 'IMAGE', 'thumb_width', '100', 'text', '', '', 0, '', 2),
(91, 'IMAGE', 'thumb_height', '100', 'text', '', '', 0, '', 1),
(92, 'ADMIN_THEME', 'css', 'blue', 'dropdown', 'red,blue,black,brown,purple,green,orange', 'red,blue,black,brown,purple,green,orange', 0, 'Please choose red,blue,black,brown,purple,green,orange.', 1),
(93, 'AUDIT', 'status', '1', 'radio', '1,0', 'Enabled,Disabled', 0, '', 1),
(101, 'SITE_ADMIN', 'email', 'afixi.upendra@gmail.com', 'text', '', '', 1, '', 1),
(102, 'SITE_ADMIN', 'admin_email', 'admin_email', 'text', '', '', 0, '', 2),
(104, 'CONTENT_IMAGES', 'image_width', '800', 'text', '', '', 0, '', 2),
(105, 'CONTENT_IMAGES', 'image_height', '450', 'text', '', '', 0, '', 1),
(106, 'CONTENT_IMAGES', 'content_orig', '/var/www/html/waf_res/logo/images/', 'text', '', '', 0, '', 1),
(107, 'CONTENT_IMAGES', 'orig_url', 'waf_res/waf_content/orig/', 'text', '', '', 0, '', 2),
(108, 'CONTENT_IMAGES', 'image_display', '/waf_content/images/', 'text', '', '', 0, '', 4),
(109, 'CONTENT_IMAGES', 'company_logo', '/var/www/html/waf_res/logo/thumb/', 'text', '', '', 0, '', 3),
(110, 'PAGINATE', 'rec_per_page', '10', 'text', '', '', 1, '', 2),
(111, 'PAGINATE', 'show_page', '5', 'text', '', '', 1, '', 1),
(114, 'PAGINATE_ADMIN', 'rec_per_page', '20', '', '', '', 1, '', 2),
(115, 'PAGINATE_ADMIN', 'show_page', '5', '', '', '', 1, '', 1),
(116, 'USER_TYPE', '1', 'Admin', 'text', '', '', 0, '', 0),
(117, 'USER_TYPE', '2', 'Director', 'text', '', '', 0, '', 0),
(118, 'USER_TYPE', '3', 'Account Specifier', 'text', '', '', 0, '', 0),
(119, 'USER_TYPE', '4', 'Account', 'text', '', '', 0, '', 0),
(120, 'USER_TYPE', '99', 'Developer', 'text', '', '', 0, '', 0),
(125, 'MULTI_LANG', 'islang', '1', 'text', '', '', 0, 'Set 0 to disable and 1 to enable\n', 0),
(136, 'PAYPAL', 'business', 'afixi._1312949792_biz@gmail.com', 'text', '', '', 0, 'Set your paypal business account.', 2),
(137, 'PAYPAL', 'paypal_mode', 'sandbox', 'radio', 'sandbox,live', 'Sandbox,Live', 0, 'You can set your paypal mode.', 1),
(138, 'IMAGE_HANDLER', 'library', 'gd', 'text', NULL, NULL, 1, 'im: for image magick\ngd : to use GD library', 1),
(140, 'FORGOT_PASSWORD', 'password_type', '0', 'radio', '1,0', 'encripted,normal', 0, 'Choose encrypted to store your password in encryption format otherwise normal.', 1),
(144, 'AA', 'text test', 'testvalue', 'text', '', '', 0, 'testvalue', 2),
(146, 'AA', 'radio test', '0', 'radio', '0,1', 'a,b', 0, 'radio1', 4),
(147, 'AA', 'check test', '1,2', 'checkbox', '0,1,2', 'cricket,football,chess', 0, 'hobbies', 5),
(148, 'AA', 'drop down', '2', 'dropdown', '1,2,3,4', 'programmer,tester,designer,ui expert', 0, 'drop down', 6),
(167, 'PAYPALPRO', 'API_USERNAME', 'afixi._1312949792_biz_api1.gmail.com', 'text', NULL, NULL, 1, 'API user: The user that is identified as making the call. you can also use your own API username that you created on PayPal’s sandbox or the PayPal live site.', 9),
(168, 'PAYPALPRO', 'API_PASSWORD', '1312949831', 'text', NULL, NULL, 1, 'API_password: The password associated with the API user.If you are using your own API username, enter the API password that was generated by PayPal below.', 10),
(169, 'PAYPALPRO', 'API_SIGNATURE', 'A-3Q72jBWlHzhKLpPce-5g.i25pgAN0ZF.RKm0Fh4Z5x.gqzIwkPKWlt', 'text', NULL, NULL, 1, 'API_Signature:The Signature associated with the API user. which is generated by paypal.', 11),
(171, 'PAYPALPRO', 'USE_PROXY', 'FALSE,USE_PROXY: Set this variable to TRUE to route all the API requests through proxy.', 'text', NULL, NULL, 1, 'USE_PROXY: Set this variable to TRUE to route all the API requests through proxy.', 12),
(172, 'PAYPALPRO', 'PROXY_HOST', '127.0.0.1,PROXY_HOST: Set the host name or the IP address of proxy server.', 'text', NULL, NULL, 1, 'PROXY_HOST: Set the host name or the IP address of proxy server.', 13),
(173, 'PAYPALPRO', 'PROXY_PORT', '808,PROXY_PORT: Set proxy port.NOTE : PROXY_HOST and PROXY_PORT will be read only if USE_PROXY is set to TRUE.', 'text', NULL, NULL, 1, 'PROXY_PORT: Set proxy port.NOTE : PROXY_HOST and PROXY_PORT will be read only if USE_PROXY is set to TRUE.', 14),
(175, 'PAYPALPRO', 'VERSION', '58.0,Version: this is the API version in the request.It is a mandatory parameter for each API request.', 'text', NULL, NULL, 1, 'Version: this is the API version in the request.It is a mandatory parameter for each API request.', 15),
(176, 'PAYPALPRO', 'paypal_mode', '', 'radio', 'sandbox,live', 'Sandbox,Live', 1, 'Setting of paypal mode fro transaction.For testing select Sandbox and for production set it to Live.', 1),
(177, 'PAYPALPRO', 'currency_code', 'USD', 'dropdown', 'USD,AUD', 'USD,AUD', 1, 'Currency code for Paypal.', 2),
(178, 'PAYPALPRO', 'paymentaction', 'Sale,This is to be set for instant payment through credit card.(Other values are Authorization and Order)', 'text', NULL, NULL, 1, 'This is to be set for instant payment through credit card.(Other values are Authorization and Order)', 3),
(179, 'PAYPALPRO', 'maxfailedpayments', '1,The number of scheduled payments that can fail before the profile is automatically suspended.', 'text', NULL, NULL, 1, 'The number of scheduled payments that can fail before the profile is automatically suspended.', 6),
(180, 'PAYPALPRO', 'billingfrequency', '1,Number of billing periods that make up one billing cycle.', 'text', NULL, NULL, 1, 'Number of billing periods that make up one billing cycle.', 4),
(181, 'PAYPALPRO', 'totalbillingcycle', '6,The number of billing cycles for payment period.', 'text', NULL, NULL, 1, 'The number of billing cycles for payment period.', 5),
(182, 'PAYPALPRO', 'initamt', '0,Initial non-recurring payment amount due immediately upon profile creation.', 'text', NULL, NULL, 1, 'Initial non-recurring payment amount due immediately upon profile creation.', 8),
(183, 'PAYPALPRO', 'description', 'Your recurring payment description,Description about transaction.', 'text', NULL, NULL, 1, 'Description about transaction.', 7),
(184, 'CATEGORY', '1', 'Funny', 'text', NULL, NULL, 1, '', 0),
(185, 'CATEGORY', '2', 'Love', 'text', NULL, NULL, 1, NULL, 0),
(186, 'CATEGORY', '3', 'Trees', 'text', NULL, NULL, 1, NULL, 0),
(187, 'CATEGORY', '4', 'Everyday', 'text', NULL, NULL, 1, NULL, 0),
(188, 'IMAGE', 'premade_image', 'image/orig/premade_images/', 'text', NULL, NULL, 0, '', 0),
(189, 'IMAGE', 'avtar_orig', 'image/orig/avatar/', 'text', NULL, NULL, 0, '', 0),
(190, 'IMAGE', 'avtar_thumb', 'image/thumb/avatar/', 'text', NULL, NULL, 0, '', 0),
(191, 'LIVEFEED_COLOR', 'reply', '#FFFF00', 'text', NULL, NULL, 1, 'Live feed color when replied.', 0),
(192, 'LIVEFEED_COLOR', 'agree', '#33CC00', 'text', NULL, NULL, 1, 'Live feed color when honoured', 0),
(193, 'LIVEFEED_COLOR', 'disagree', '#FF0000', 'text', NULL, NULL, 1, 'Live feed color when dishonored ', 0),
(194, 'IMAGE', 'ques_orig', 'image/orig/question/', 'text', NULL, NULL, 0, '', 0),
(195, 'IMAGE', 'ques_thumb', 'image/thumb/question/', 'text', NULL, NULL, 0, '', 0),
(198, 'IMAGE', 'badge_orig', 'image/orig/badge/', 'text', NULL, NULL, 0, '', 0),
(199, 'IMAGE', 'badge_thumb', 'image/thumb/badge/', 'text', NULL, NULL, 0, '', 0),
(200, 'LIVEFEED_COLOR', 'add_caption', '#8E35EF', 'text', NULL, NULL, 1, 'Live feed color when once caption added to the meme.', 0),
(201, 'GLORY_CATEGORY', '1', 'Common', 'text', '', '', 0, '', 0),
(202, 'GLORY_CATEGORY', '2', 'Medium', 'text', '', '', 0, '', 0),
(203, 'GLORY_CATEGORY', '3', 'Rare', 'text', '', '', 0, '', 0),
(204, 'IMAGE', 'gloryicon_orig', 'image/orig/glory_icon/', 'text', '', '', 0, '', 0),
(205, 'IMAGE', 'gloryicon_thumb', 'image/thumb/glory_icon/', 'text', '', '', 0, '', 0),
(206, 'IMAGE', 'glorybadge_orig', 'image/orig/glory_badge/', 'text', '', '', 0, '', 0),
(207, 'IMAGE', 'glorybadge_thumb', 'image/thumb/glory_badge/', 'text', '', '', 0, '', 0),
(208, 'BADGE_TYPE', 'reply', 'Replies', 'text', NULL, NULL, 1, '', 1),
(209, 'BADGE_TYPE', 'exp_point', 'Experience point', 'text', NULL, NULL, 1, '', 2),
(210, 'BADGE_TYPE', 'ques_week_won', 'Question of the week won', 'text', NULL, NULL, 1, '', 3),
(211, 'BADGE_TYPE', 'duels_won', 'Duels won', 'text', NULL, NULL, 1, '', 4),
(212, 'BADGE_TYPE', 'id_meme', 'NO of meme post', 'text', NULL, NULL, 1, NULL, 5),
(213, 'SEARCH_TYPE', '1', 'Search', 'text', NULL, NULL, 0, '', 0),
(214, 'SEARCH_TYPE', '2', 'Meme post', 'text', NULL, NULL, 0, '', 0),
(215, 'ALLOT_POINTS', 'meme_insert', 'Meme post', 'text', NULL, NULL, 0, 'Add points when a meme post', 0),
(216, 'ALLOT_POINTS', 'answer_to_meme', 'Reply', 'text', NULL, NULL, 0, '', 0),
(217, 'ALLOT_POINTS', 'insert_caption', 'Add caption', 'text', NULL, NULL, 0, '', 0),
(218, 'FACEBOOK', 'api_key', '213764722000439', 'text', NULL, NULL, 1, '', 0),
(219, 'FACEBOOK', 'secret_key', '59fab34c926f3ac596bac25c568e1b55', 'text', NULL, NULL, 1, '', 0),
(220, 'FACEBOOK', 'app_id', '213764722000439', 'text', NULL, NULL, 1, 'Application Id', 0),
(221, 'IMAGE', 'meme_orig', 'image/orig/meme/', 'text', NULL, NULL, 0, '', 0),
(222, 'IMAGE', 'premade_image_thumb', 'image/thumb/premade_images/', 'text', NULL, NULL, 0, 'Premade image thumb path', 0),
(223, 'FLAGGING_ACTION', '1', 'Approve', 'text', NULL, NULL, 0, '', 0),
(224, 'FLAGGING_ACTION', '2', 'Disapprove', 'text', NULL, NULL, 1, NULL, 0),
(225, 'FLAGGING_ACTION', '3', 'Ignore', 'text', NULL, NULL, 1, NULL, 0),
(227, 'TWITTER', 'Consumer_secret', 'fZFP6bvDECRqAAT1wrgRsVMEqyQJqYmD3Edez1jzotA', 'text', NULL, NULL, 1, NULL, 0),
(228, 'TWITTER', 'Consumer_key', '0agkdh484xwmMvLLprLvTQ', 'text', NULL, NULL, 1, NULL, 0),
(229, 'PREMADE_CATEGORY', '1', 'Part', 'text', NULL, NULL, 1, '', 0),
(230, 'PREMADE_CATEGORY', '2', 'Happy', 'text', NULL, NULL, 1, '', 0),
(231, 'PREMADE_CATEGORY', '3', 'Laugh', 'text', NULL, NULL, 1, '', 0),
(232, 'PREMADE_CATEGORY', '4', 'Sexytime', 'text', NULL, NULL, 1, '', 0),
(233, 'PREMADE_CATEGORY', '5', 'Determined', 'text', NULL, NULL, 1, '', 0),
(234, 'NOTIFY_TYPE', '1', 'accepted your friend request.', 'text', NULL, NULL, 1, 'when a user accept your friend request.', 0),
(235, 'NOTIFY_TYPE', '2', 'invited you to duel.', 'text', NULL, NULL, 1, 'when a user get a duel invitation', 0),
(236, 'NOTIFY_TYPE', '3', 'accepted your duel invitation.', 'text', NULL, NULL, 1, 'when a user accepted your duel invitation.', 0),
(237, 'NOTIFY_TYPE', '4', 'got an achievement.', 'text', NULL, NULL, 1, 'when a user get a new badge.', 0),
(238, 'NOTIFY_TYPE', '5', 'has sent you a friend request.', 'text', NULL, NULL, 1, 'when a user get a friend request', 0),
(239, 'NOTIFY_TYPE', '6', 'tagged you on a meme.', 'text', '', '', 1, 'Notification message for tagging.', 0),
(240, 'ALLOT_POINTS', 'honour', 'Honour', 'text', NULL, NULL, 0, 'For honoring a meme.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `memeje__content`
--

DROP TABLE IF EXISTS `memeje__content`;
CREATE TABLE IF NOT EXISTS `memeje__content` (
  `id_content` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `cmscode` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `meta_description` text collate utf8_unicode_ci,
  `meta_keywords` text collate utf8_unicode_ci,
  `title` text collate utf8_unicode_ci,
  `description` text collate utf8_unicode_ci,
  `language` varchar(50) character set latin1 default NULL,
  `ip` varchar(20) character set latin1 NOT NULL default '',
  `ctime` datetime NOT NULL default '0000-00-00 00:00:00',
  `last_update_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_content`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `memeje__content`
--

INSERT INTO `memeje__content` (`id_content`, `name`, `cmscode`, `meta_description`, `meta_keywords`, `title`, `description`, `language`, `ip`, `ctime`, `last_update_time`) VALUES
(1, 'aboutus', 'aboutus', '', '', '', '<p style="text-align: justify;"><span style="font-size: larger;">Afixi is a software development company specializing in Web  Applications, Mailing and Server software solutions and security. Afixi  is a sister concern                        of Neuron Consultants Pvt. Ltd., a 13 year old IT  development                        company. Founded in April, 2002 at Bangalore,  India, Afixi                        caters to clients around the world. In the few  months of                        its existence, Afixi has carved a niche for itself  amongst                        its clients. Currently, it has clients in the US,  UK, Switzerland,                        Japan and many other countries. Afixi is  appreciated by                        its clients for its quality service, quick  turnaround times,                        and easy communication with fast responses, honest  business                        practices and reasonable pricing. It provides  direct access                        to its clients to its timesheets and project  management                        system, thereby letting them monitor the progress  and actively                        participating in their projects.</span></p><p style="text-align: justify;"><span style="font-size: larger;">Members of the Afixi Technologies have been  conceptualising                        and executing customized software and web based  solutions                        to their clients from many years, successfully  deploying                        national and international projects.</span></p><p style="text-align: justify;"><span style="font-size: larger;">We can design and deliver simple or thorough  solutions to                      meet a business need. We will endeavour to build  websites                      that :                                           <img width="6" height="6" alt="" src="http://www.afixi.com/images/bullet1.gif" /> match                      your vision and capture the passion you have for  your business                      and serving your customers.<br />                     <br />                     <img width="6" height="6" alt="" src="http://www.afixi.com/images/bullet1.gif" /> maximize                      the money-making potential of every business.<br />                     <br />                     We ensure that we really understand your business,  what makes                      it so unique and what you want to achieve. We match  that with                      our knowledge of the Internet, specifically in terms  of what                      works and what doesn''t. This is combined with a  spark of inspiration                      and innovation where first-class designers and  programmers                      build the whole thing.</span></p>', 'en', '117.201.162.225', '2011-07-29 05:01:44', '2011-08-26 04:41:41'),
(3, 'How to get achievement', 'howtogetachievement', '', '', 'How to get achievement', '<p style="text-align: justify;"><span style="font-size: larger;">Avatar game set to come out for the  Xbox 360 next week is going to set records ... in rental sales. Whoever  set the Achievements for this game was either extremely lazy, or just  didn''t give a damn. You see, within the first two minutes of playing  this game, you can earn all 1000 Achievement points by just pressing one  button over and over.</span></p>', 'en', '117.201.162.225', '2011-08-26 04:38:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__donate`
--

DROP TABLE IF EXISTS `memeje__donate`;
CREATE TABLE IF NOT EXISTS `memeje__donate` (
  `id_donate` int(11) NOT NULL auto_increment,
  `amount` float default '0',
  `donated_by` int(11) default '0',
  `name` varchar(200) collate utf8_unicode_ci default NULL,
  `payer_email` varchar(200) collate utf8_unicode_ci default NULL,
  `payment_status` varchar(20) collate utf8_unicode_ci NOT NULL,
  `txn_id` varchar(200) collate utf8_unicode_ci NOT NULL,
  `donated_on` datetime default NULL,
  `add_date` datetime NOT NULL,
  PRIMARY KEY  (`id_donate`),
  KEY `amount` (`amount`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `memeje__donate`
--

INSERT INTO `memeje__donate` (`id_donate`, `amount`, `donated_by`, `name`, `payer_email`, `payment_status`, `txn_id`, `donated_on`, `add_date`) VALUES
(1, 2.55, 2, 'Test User', 'afixi._1312949689_per@gmail.com', 'Pending', '9PY650050W782625D', '2011-08-12 07:02:02', '2011-08-12 07:03:27'),
(2, 2.56, 2, 'Test User', 'afixi._1312949689_per@gmail.com', 'Pending', '21S84322PD4838543', '2011-08-12 06:15:00', '2011-08-12 07:18:01'),
(3, 2.57, 2, 'Test User', 'afixi._1312949689_per@gmail.com', 'Pending', '9R392227LW9290130', '2011-08-12 07:25:44', '2011-08-12 07:27:12'),
(4, 2.58, 2, 'Test User', 'afixi._1291880012_per@gmail.com', 'Pending', '0NR82092K7933860M', '2011-08-12 07:33:04', '2011-08-12 07:34:08'),
(5, 2.59, 2, 'Test User', 'afixi._1291880012_per@gmail.com', 'Completed', '48T51951WC989241F', '2011-08-12 07:31:35', '2011-08-12 07:36:53'),
(6, 6.22, 0, 'Test User', 'afixi._1312949689_per@gmail.com', 'Completed', '3X051550NN013950S', '2011-08-15 20:47:19', '2011-08-15 20:55:48'),
(7, 2.1, 2, 'Test User', 'afixi._1312949689_per@gmail.com', 'Completed', '7YY47017VC6989947', '2011-08-16 06:07:47', '2011-08-16 06:09:54'),
(8, 5, 34, 'Test User', 'afixi._1311243379_per@gmail.com', 'Pending', '3YW91524UT169705J', '2011-08-18 06:21:12', '2011-08-18 06:24:29'),
(9, 2.22, 24, 'Test User', 'afixi._1312949689_per@gmail.com', 'Pending', '5A315046J8926805H', '2011-08-18 21:11:38', '2011-08-18 21:14:57'),
(10, 5.66, 4, 'Test User', 'afixi._1312949689_per@gmail.com', 'Pending', '0FK18041BF835544S', '2011-08-19 00:27:42', '2011-08-19 00:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__duel`
--

DROP TABLE IF EXISTS `memeje__duel`;
CREATE TABLE IF NOT EXISTS `memeje__duel` (
  `id_duel` int(11) NOT NULL auto_increment,
  `duelled_by` int(11) NOT NULL COMMENT 'id_user who challenged.',
  `duelled_to` int(11) NOT NULL COMMENT 'id_user to whom challenged.',
  `own_meme` int(11) default NULL COMMENT 'id_meme posted by  the user who challenged.',
  `duelled_meme` int(11) default NULL COMMENT 'id_meme posted by the user who accepted the challenge.',
  `is_accepted` tinyint(4) NOT NULL default '0' COMMENT '1 if accepted.',
  `is_ignored` tinyint(4) NOT NULL default '0' COMMENT '1 if ignored.',
  `is_cancelled` tinyint(4) NOT NULL default '0' COMMENT '1 if cancelled',
  `is_read` tinyint(1) NOT NULL default '0',
  `add_date` datetime NOT NULL,
  `duelled_date` datetime default NULL,
  `own_ip` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT 'ip of user who challenged from.',
  `duelled_ip` varchar(20) collate utf8_unicode_ci default NULL COMMENT 'ip of user who accepted or posted a meme from.',
  PRIMARY KEY  (`id_duel`),
  KEY `is_read` (`is_read`),
  KEY `is_cancelled` (`is_cancelled`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Contains the info. about all duels.' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `memeje__duel`
--

INSERT INTO `memeje__duel` (`id_duel`, `duelled_by`, `duelled_to`, `own_meme`, `duelled_meme`, `is_accepted`, `is_ignored`, `is_cancelled`, `is_read`, `add_date`, `duelled_date`, `own_ip`, `duelled_ip`) VALUES
(5, 36, 35, 10, 9, 1, 0, 0, 0, '2011-09-02 00:25:27', NULL, '204.28.119.192', '204.28.119.192');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__duel_meme`
--

DROP TABLE IF EXISTS `memeje__duel_meme`;
CREATE TABLE IF NOT EXISTS `memeje__duel_meme` (
  `id_duel_meme` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `id_question` int(11) NOT NULL default '0',
  `title` varchar(300) collate utf8_unicode_ci NOT NULL,
  `image` varchar(300) collate utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `can_all_comment` tinyint(4) NOT NULL,
  `can_all_view` tinyint(4) NOT NULL,
  `tagged_user` text collate utf8_unicode_ci,
  `is_transfered_to_meme` tinyint(4) NOT NULL default '0' COMMENT '1 if  transfered to meme table.',
  `add_date` datetime NOT NULL,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_duel_meme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `memeje__duel_meme`
--

INSERT INTO `memeje__duel_meme` (`id_duel_meme`, `id_user`, `id_question`, `title`, `image`, `category`, `can_all_comment`, `can_all_view`, `tagged_user`, `is_transfered_to_meme`, `add_date`, `ip`) VALUES
(9, 35, 0, 'Haha duplicates', '9_23_55_SoMuchWin.png', 1, 1, 1, '36', 1, '0000-00-00 00:00:00', '204.28.119.192'),
(10, 36, 0, 'not good', '10_9_41_SonMeGusta.png', 1, 1, 1, '35', 1, '0000-00-00 00:00:00', '204.28.119.192');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__feature`
--

DROP TABLE IF EXISTS `memeje__feature`;
CREATE TABLE IF NOT EXISTS `memeje__feature` (
  `id_feature` int(10) NOT NULL auto_increment,
  `title` varchar(50) collate utf8_unicode_ci default '',
  `description` varchar(100) collate utf8_unicode_ci default NULL,
  `no_of_suggestion` int(11) NOT NULL default '0',
  `activation` int(5) NOT NULL,
  `add_date` datetime default NULL,
  `ip` varchar(16) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id_feature`),
  KEY `no_of_suggestion` (`no_of_suggestion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `memeje__feature`
--

INSERT INTO `memeje__feature` (`id_feature`, `title`, `description`, `no_of_suggestion`, `activation`, `add_date`, `ip`) VALUES
(1, 'Better Editor Than MS Paint', 'You can edit ur meme with better features or better editors and make ur meme much more what u need.', 3, 1, '2011-08-17 05:57:26', '117.197.253.132'),
(2, 'Share or not share', 'Share your memes directly from your account to facebook.', 5, 1, '2011-08-17 05:57:56', '117.197.253.132'),
(3, 'Points to be noted', 'Here we are providing opportunity to get some of points ,which makes u help a lot increasing ur ran', 3, 1, '2011-08-17 05:58:38', '117.197.254.18'),
(4, 'Testing Memeje', '"This for testing memeje editor". Hello testing', 2, 1, '2011-08-18 21:58:06', '117.197.232.204');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__flag`
--

DROP TABLE IF EXISTS `memeje__flag`;
CREATE TABLE IF NOT EXISTS `memeje__flag` (
  `id_flag` int(11) NOT NULL auto_increment,
  `id_meme` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `flag_action` int(11) default NULL COMMENT 'Action taken by Admin. i.e 1 if Approved,2 if Disapproved and 3 if Igoned.',
  `add_date` datetime NOT NULL,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_flag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `memeje__flag`
--

INSERT INTO `memeje__flag` (`id_flag`, `id_meme`, `id_user`, `flag_action`, `add_date`, `ip`) VALUES
(1, 26, 35, NULL, '2011-08-20 18:22:58', '108.205.200.122'),
(2, 42, 4, NULL, '2011-08-23 00:41:03', '117.197.253.54'),
(3, 38, 4, NULL, '2011-08-23 00:47:44', '117.197.253.54'),
(4, 40, 34, NULL, '2011-08-23 00:57:50', '117.197.253.54'),
(5, 38, 2, NULL, '2011-08-23 04:02:05', '117.197.253.54'),
(6, 35, 2, NULL, '2011-08-23 04:14:13', '117.197.253.54'),
(7, 34, 2, NULL, '2011-08-23 04:17:13', '117.197.253.54'),
(8, 29, 2, NULL, '2011-08-23 04:19:57', '117.197.253.54'),
(9, 15, 2, NULL, '2011-08-23 04:23:13', '117.197.253.54'),
(10, 5, 2, NULL, '2011-08-23 04:31:38', '117.197.253.54'),
(11, 20, 3, NULL, '2011-08-24 18:27:42', '67.160.197.181'),
(12, 97, 37, NULL, '2011-09-03 01:25:39', '117.201.148.167');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__frnd_request`
--

DROP TABLE IF EXISTS `memeje__frnd_request`;
CREATE TABLE IF NOT EXISTS `memeje__frnd_request` (
  `id_frnd_request` int(11) NOT NULL auto_increment,
  `requested_by` int(11) NOT NULL,
  `requested_to` int(11) NOT NULL,
  `req_status` tinyint(2) NOT NULL COMMENT '1 for accepted 2 for rejected',
  `is_read` tinyint(1) NOT NULL default '0',
  `add_date` datetime NOT NULL,
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_frnd_request`),
  KEY `requested_by` (`requested_by`,`requested_to`),
  KEY `req_status` (`req_status`),
  KEY `is_read` (`is_read`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `memeje__frnd_request`
--

INSERT INTO `memeje__frnd_request` (`id_frnd_request`, `requested_by`, `requested_to`, `req_status`, `is_read`, `add_date`, `ip`) VALUES
(1, 2, 23, 0, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(2, 2, 32, 0, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(3, 2, 33, 0, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(6, 3, 34, 1, 0, '2011-08-22 23:01:15', '117.197.243.122'),
(7, 34, 3, 2, 0, '2011-08-22 23:03:39', '117.197.243.122'),
(8, 3, 34, 1, 0, '2011-08-22 23:04:25', '117.197.243.122'),
(9, 3, 10, 1, 0, '2011-08-22 23:37:20', '117.197.253.54'),
(10, 10, 3, 2, 0, '2011-08-22 23:37:57', '117.197.253.54'),
(11, 34, 3, 2, 0, '2011-08-22 23:40:50', '117.197.253.54'),
(12, 10, 3, 2, 0, '2011-08-22 23:41:01', '117.197.253.54'),
(13, 10, 34, 2, 0, '2011-08-22 23:43:20', '117.197.253.54'),
(14, 3, 34, 1, 0, '2011-08-22 23:43:38', '117.197.253.54'),
(15, 34, 10, 1, 0, '2011-08-22 23:49:00', '117.197.253.54'),
(16, 10, 34, 2, 0, '2011-08-22 23:50:01', '117.197.253.54'),
(17, 34, 10, 1, 0, '2011-08-22 23:50:36', '117.197.253.54'),
(18, 1, 2, 1, 0, '2011-08-23 18:21:39', '75.36.207.218'),
(19, 4, 2, 1, 0, '2011-08-23 21:31:39', '117.201.160.173'),
(20, 4, 3, 1, 0, '2011-08-23 21:31:40', '117.201.160.173'),
(21, 4, 5, 1, 0, '2011-08-23 21:31:40', '117.201.160.173'),
(23, 4, 8, 0, 0, '2011-08-23 21:31:41', '117.201.160.173'),
(24, 3, 10, 1, 0, '2011-08-23 23:21:07', '117.201.160.173'),
(25, 2, 35, 1, 0, '2011-08-24 18:53:15', '204.28.119.130'),
(26, 3, 36, 0, 0, '2011-08-25 14:51:33', '67.160.197.181'),
(27, 3, 10, 1, 0, '2011-08-25 21:49:30', '117.197.233.105'),
(28, 35, 3, 1, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(29, 35, 4, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(30, 35, 5, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(31, 35, 6, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(32, 35, 8, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(33, 35, 9, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(34, 35, 10, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(35, 35, 13, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(36, 35, 15, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(37, 35, 36, 1, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(38, 32, 34, 1, 0, '2011-09-03 02:54:46', '117.201.148.167');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__leaderboard`
--

DROP TABLE IF EXISTS `memeje__leaderboard`;
CREATE TABLE IF NOT EXISTS `memeje__leaderboard` (
  `id_leaderboard` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `exp_points` int(11) default NULL,
  `duels_won` int(11) default NULL,
  `badges` int(11) default NULL,
  `ques_week_won` int(11) default NULL,
  PRIMARY KEY  (`id_leaderboard`),
  KEY `id_leaderboard` (`id_leaderboard`,`id_user`,`exp_points`,`duels_won`,`badges`,`ques_week_won`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `memeje__leaderboard`
--


-- --------------------------------------------------------

--
-- Table structure for table `memeje__login`
--

DROP TABLE IF EXISTS `memeje__login`;
CREATE TABLE IF NOT EXISTS `memeje__login` (
  `id_login` int(10) NOT NULL auto_increment,
  `id_user` int(10) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `date_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `email` varchar(150) NOT NULL default '',
  `failure_attempt` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id_login`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=780 ;

--
-- Dumping data for table `memeje__login`
--

INSERT INTO `memeje__login` (`id_login`, `id_user`, `ip`, `date_login`, `email`, `failure_attempt`) VALUES
(1, 1, '117.201.162.188', '2011-07-16 07:12:47', 'sabri@mail.afixiindia.com', 0),
(2, 1, '117.201.162.188', '2011-07-16 07:19:37', 'sabri@mail.afixiindia.com', 0),
(3, 1, '117.201.162.188', '2011-07-16 07:20:13', 'sabri@mail.afixiindia.com', 0),
(4, 5, '117.201.162.188', '2011-07-16 07:24:29', 'biswa@mail.afixiindia.com', 0),
(6, 1, '117.201.162.188', '2011-07-16 07:26:31', 'sabri@mail.afixiindia.com', 0),
(7, 5, '117.201.162.188', '2011-07-16 07:26:48', 'biswa@mail.afixiindia.com', 0),
(8, 1, '117.201.162.188', '2011-07-16 07:30:47', 'sabri@mail.afixiindia.com', 0),
(9, 4, '117.201.162.188', '2011-07-16 07:39:19', 'upendra@mail.afixiindia.com', 0),
(10, 1, '117.201.162.188', '2011-07-16 07:48:23', 'sabri@mail.afixiindia.com', 0),
(11, 1, '117.201.162.188', '2011-07-16 07:51:13', 'sabri@mail.afixiindia.com', 0),
(12, 1, '75.36.200.220', '2011-07-17 00:59:45', 'sabri@mail.afixiindia.com', 0),
(13, 2, '117.197.246.64', '2011-07-17 22:52:34', 'jagannath@mail.afixiindia.com', 0),
(14, 2, '117.197.246.64', '2011-07-17 22:53:40', 'jagannath@mail.afixiindia.com', 0),
(15, 3, '117.197.246.64', '2011-07-17 22:55:57', 'tanmaya@mail.afixiindia.com', 0),
(16, 4, '117.197.246.64', '2011-07-17 22:57:09', 'upendra@mail.afixiindia.com', 0),
(17, 2, '117.197.246.64', '2011-07-17 22:59:25', 'jagannath@mail.afixiindia.com', 0),
(18, 8, '117.197.246.64', '2011-07-17 23:00:21', 'arun@mail.afixiindia.com', 0),
(19, 15, '117.197.246.64', '2011-07-17 23:58:33', 'sasmita@mail.afixiindia.com', 0),
(20, 15, '117.197.242.21', '2011-07-18 00:16:04', 'sasmita@mail.afixiindia.com', 0),
(21, 2, '117.197.242.21', '2011-07-18 00:21:33', 'jagannath@mail.afixiindia.com', 0),
(22, 15, '117.197.242.21', '2011-07-18 02:08:53', 'sasmita@mail.afixiindia.com', 0),
(23, 3, '117.197.242.21', '2011-07-18 04:15:35', 'tanmaya@mail.afixiindia.com', 0),
(24, 1, '117.197.242.21', '2011-07-18 04:43:14', 'sabri@mail.afixiindia.com', 0),
(25, 2, '117.197.242.21', '2011-07-18 04:47:49', 'jagannath@mail.afixiindia.com', 0),
(26, 2, '117.197.242.21', '2011-07-18 05:02:59', 'jagannath@mail.afixiindia.com', 0),
(27, 2, '117.197.242.21', '2011-07-18 05:36:39', 'jagannath@mail.afixiindia.com', 0),
(28, 30, '117.197.242.21', '2011-07-18 06:34:17', 'biswal805@gmail.com', 0),
(29, 30, '117.197.242.21', '2011-07-18 06:43:12', 'biswal805@gmail.com', 0),
(30, 30, '117.197.242.21', '2011-07-18 06:53:43', 'biswal805@gmail.com', 0),
(31, 31, '117.197.242.21', '2011-07-18 06:53:46', 'afixi.sasmita@gmail.com', 0),
(32, 31, '117.197.242.21', '2011-07-18 06:56:19', 'afixi.sasmita@gmail.com', 0),
(33, 30, '117.197.242.21', '2011-07-18 06:56:39', 'biswal805@gmail.com', 0),
(34, 30, '117.197.242.21', '2011-07-18 07:01:23', 'biswal805@gmail.com', 0),
(35, 30, '117.197.242.21', '2011-07-18 07:01:49', 'biswal805@gmail.com', 0),
(36, 30, '117.197.242.21', '2011-07-18 07:05:14', 'biswal805@gmail.com', 0),
(37, 15, '117.197.242.21', '2011-07-18 07:06:25', 'sasmita@mail.afixiindia.com', 0),
(38, 15, '117.197.242.21', '2011-07-18 07:07:55', 'sasmita@mail.afixiindia.com', 0),
(39, 30, '117.197.242.21', '2011-07-18 22:21:29', 'biswal805@gmail.com', 0),
(40, 32, '117.197.242.21', '2011-07-18 23:03:02', 'afixi.jagannath@gmail.com', 0),
(41, 32, '117.197.242.21', '2011-07-18 23:03:30', 'afixi.jagannath@gmail.com', 0),
(42, 1, '204.28.119.130', '2011-07-18 23:29:48', 'sabri@mail.afixiindia.com', 0),
(43, 30, '117.197.242.21', '2011-07-18 23:35:42', 'biswal805@gmail.com', 0),
(44, 32, '117.197.242.21', '2011-07-18 23:38:02', 'afixi.jagannath@gmail.com', 0),
(45, 31, '117.197.242.21', '2011-07-18 23:39:30', 'afixi.sasmita@gmail.com', 0),
(46, 33, '117.197.246.58', '2011-07-19 01:45:21', 'manassahoo66@gmail.com', 0),
(47, 1, '117.197.253.71', '2011-07-19 05:48:58', 'sabri@mail.afixiindia.com', 0),
(48, 4, '117.197.253.71', '2011-07-19 07:13:27', 'upendra@mail.afixiindia.com', 0),
(49, 2, '117.197.253.71', '2011-07-19 07:48:29', 'jagannath@mail.afixiindia.com', 0),
(50, 15, '117.197.253.71', '2011-07-19 07:48:47', 'sasmita@mail.afixiindia.com', 0),
(51, 33, '117.197.253.71', '2011-07-19 21:48:28', 'manassahoo66@gmail.com', 0),
(52, 1, '204.28.119.130', '2011-07-20 00:28:14', 'sabri@mail.afixiindia.com', 0),
(53, 31, '117.197.253.71', '2011-07-20 00:29:59', 'afixi.sasmita@gmail.com', 0),
(54, 1, '204.28.119.130', '2011-07-20 02:40:11', 'sabri@mail.afixiindia.com', 0),
(55, 32, '117.197.253.71', '2011-07-20 02:51:59', 'afixi.jagannath@gmail.com', 0),
(56, 1, '136.152.140.118', '2011-07-20 16:13:12', 'sabri@mail.afixiindia.com', 0),
(57, 1, '76.230.234.245', '2011-07-21 23:40:52', 'sabri@mail.afixiindia.com', 0),
(58, 4, '117.197.242.162', '2011-07-22 04:48:16', 'upendra@mail.afixiindia.com', 0),
(59, 3, '117.197.242.162', '2011-07-22 05:01:01', 'tanmaya@mail.afixiindia.com', 0),
(60, 2, '117.197.242.162', '2011-07-22 06:18:54', 'jagannath@mail.afixiindia.com', 0),
(61, 1, '117.197.242.162', '2011-07-22 06:26:50', 'sabri@mail.afixiindia.com', 0),
(62, 4, '117.197.242.162', '2011-07-22 06:32:36', 'upendra@mail.afixiindia.com', 0),
(63, 2, '117.197.242.162', '2011-07-22 06:38:38', 'jagannath@mail.afixiindia.com', 0),
(64, 2, '117.197.242.162', '2011-07-22 06:41:51', 'jagannath@mail.afixiindia.com', 0),
(65, 2, '122.50.132.239', '2011-07-22 22:08:26', 'jagannath@mail.afixiindia.com', 0),
(66, 1, '76.230.234.245', '2011-07-22 23:37:48', 'sabri@mail.afixiindia.com', 0),
(67, 1, '75.36.206.215', '2011-07-23 16:22:18', 'sabri@mail.afixiindia.com', 0),
(68, 1, '75.36.206.215', '2011-07-23 22:26:18', 'sabri@mail.afixiindia.com', 0),
(69, 4, '117.197.248.186', '2011-07-23 22:33:31', 'upendra@mail.afixiindia.com', 0),
(70, 1, '75.36.206.215', '2011-07-24 05:04:17', 'sabri@mail.afixiindia.com', 0),
(71, 1, '75.36.206.215', '2011-07-24 13:08:10', 'sabri@mail.afixiindia.com', 0),
(72, 1, '75.37.46.27', '2011-07-24 18:51:06', 'sabri@mail.afixiindia.com', 0),
(73, 2, '117.201.146.173', '2011-07-24 22:26:01', 'jagannath@mail.afixiindia.com', 0),
(74, 4, '117.197.233.157', '2011-07-24 23:28:32', 'upendra@mail.afixiindia.com', 0),
(75, 15, '117.197.233.157', '2011-07-24 23:57:04', 'sasmita@mail.afixiindia.com', 0),
(76, 1, '75.37.46.27', '2011-07-25 02:39:26', 'sabri@mail.afixiindia.com', 0),
(77, 4, '117.201.145.123', '2011-07-25 07:39:09', 'upendra@mail.afixiindia.com', 0),
(78, 1, '204.28.119.130', '2011-07-25 13:02:42', 'sabri@mail.afixiindia.com', 0),
(79, 1, '136.152.138.99', '2011-07-25 17:15:12', 'sabri@mail.afixiindia.com', 0),
(80, 4, '117.197.249.109', '2011-07-25 21:55:50', 'upendra@mail.afixiindia.com', 0),
(81, 2, '117.197.249.109', '2011-07-25 21:56:24', 'jagannath@mail.afixiindia.com', 0),
(82, 1, '204.28.119.130', '2011-07-25 22:44:40', 'sabri@mail.afixiindia.com', 0),
(83, 2, '117.197.249.109', '2011-07-26 00:44:25', 'jagannath@mail.afixiindia.com', 0),
(84, 3, '117.197.249.109', '2011-07-26 01:01:35', 'tanmaya@mail.afixiindia.com', 0),
(85, 2, '117.197.249.109', '2011-07-26 01:01:41', 'jagannath@mail.afixiindia.com', 0),
(86, 1, '204.28.119.130', '2011-07-26 01:44:19', 'sabri@mail.afixiindia.com', 0),
(87, 15, '117.197.249.109', '2011-07-26 03:38:37', 'sasmita@mail.afixiindia.com', 0),
(88, 15, '117.197.249.109', '2011-07-26 03:40:07', 'sasmita@mail.afixiindia.com', 0),
(89, 15, '117.197.249.109', '2011-07-26 03:41:21', 'sasmita@mail.afixiindia.com', 0),
(90, 2, '117.197.249.109', '2011-07-26 03:45:26', 'jagannath@mail.afixiindia.com', 0),
(91, 2, '117.197.249.109', '2011-07-26 04:34:54', 'jagannath@mail.afixiindia.com', 0),
(92, 2, '117.197.236.201', '2011-07-26 07:02:19', 'jagannath@mail.afixiindia.com', 0),
(93, 4, '117.197.236.201', '2011-07-26 07:06:29', 'upendra@mail.afixiindia.com', 0),
(94, 1, '117.201.145.241', '2011-07-26 08:00:25', 'sabri@mail.afixiindia.com', 0),
(95, 1, '204.28.119.130', '2011-07-26 16:31:44', 'sabri@mail.afixiindia.com', 0),
(96, 1, '204.28.119.132', '2011-07-26 16:45:02', 'sabri@mail.afixiindia.com', 0),
(97, 4, '117.197.232.231', '2011-07-26 21:32:19', 'upendra@mail.afixiindia.com', 0),
(98, 4, '117.197.232.231', '2011-07-26 21:42:19', 'upendra@mail.afixiindia.com', 0),
(99, 2, '117.197.232.231', '2011-07-26 22:21:38', 'jagannath@mail.afixiindia.com', 0),
(100, 4, '117.197.232.231', '2011-07-26 22:40:19', 'upendra@mail.afixiindia.com', 0),
(101, 1, '204.28.119.130', '2011-07-26 22:48:17', 'sabri@mail.afixiindia.com', 0),
(102, 4, '117.197.232.231', '2011-07-26 22:49:30', 'upendra@mail.afixiindia.com', 0),
(103, 32, '117.201.160.101', '2011-07-26 23:22:54', 'afixi.jagannath@gmail.com', 0),
(104, 32, '117.201.160.101', '2011-07-26 23:35:37', 'afixi.jagannath@gmail.com', 0),
(105, 34, '117.201.160.101', '2011-07-27 00:13:37', 'afixi.satya@gmail.com', 0),
(106, 4, '117.197.239.157', '2011-07-27 05:46:09', 'upendra@mail.afixiindia.com', 0),
(107, 2, '117.197.239.157', '2011-07-27 05:46:13', 'jagannath@mail.afixiindia.com', 0),
(108, 34, '117.197.239.157', '2011-07-27 05:52:10', 'afixi.satya@gmail.com', 0),
(109, 2, '117.197.239.157', '2011-07-27 05:59:43', 'jagannath@mail.afixiindia.com', 0),
(110, 32, '117.197.239.157', '2011-07-27 05:59:45', 'afixi.jagannath@gmail.com', 0),
(111, 24, '117.197.239.157', '2011-07-27 06:08:54', 'afixi.upendra@gmail.com', 0),
(112, 2, '117.197.239.157', '2011-07-27 06:38:46', 'jagannath@mail.afixiindia.com', 0),
(113, 1, '204.28.119.130', '2011-07-27 12:34:18', 'sabri@mail.afixiindia.com', 0),
(114, 32, '117.197.232.233', '2011-07-27 20:47:44', 'afixi.jagannath@gmail.com', 0),
(115, 35, '64.120.96.139', '2011-07-27 21:00:39', 'lol.i.laugh@gmail.com', 0),
(116, 1, '204.28.119.130', '2011-07-27 21:05:12', 'sabri@mail.afixiindia.com', 0),
(117, 2, '117.197.232.233', '2011-07-27 22:07:57', 'jagannath@mail.afixiindia.com', 0),
(118, 32, '117.197.232.233', '2011-07-27 22:43:15', 'afixi.jagannath@gmail.com', 0),
(119, 34, '117.197.232.233', '2011-07-27 22:44:25', 'afixi.satya@gmail.com', 0),
(120, 34, '117.197.247.125', '2011-07-28 05:51:07', 'afixi.satya@gmail.com', 0),
(121, 34, '117.197.247.125', '2011-07-28 05:53:20', 'afixi.satya@gmail.com', 0),
(122, 34, '117.197.247.125', '2011-07-28 06:02:29', 'afixi.satya@gmail.com', 0),
(123, 34, '117.197.247.125', '2011-07-28 06:03:51', 'afixi.satya@gmail.com', 0),
(124, 2, '117.197.237.138', '2011-07-28 07:19:12', 'jagannath@mail.afixiindia.com', 0),
(125, 1, '117.197.237.138', '2011-07-28 07:23:06', 'sabri@mail.afixiindia.com', 0),
(126, 1, '204.28.119.130', '2011-07-28 11:53:05', 'sabri@mail.afixiindia.com', 0),
(127, 4, '117.197.233.45', '2011-07-28 21:07:03', 'upendra@mail.afixiindia.com', 0),
(128, 34, '117.197.233.45', '2011-07-28 21:11:58', 'afixi.satya@gmail.com', 0),
(129, 34, '117.201.166.151', '2011-07-28 21:44:58', 'afixi.satya@gmail.com', 0),
(130, 34, '117.201.166.151', '2011-07-28 21:45:42', 'afixi.satya@gmail.com', 0),
(131, 2, '117.201.166.151', '2011-07-28 21:55:18', 'jagannath@mail.afixiindia.com', 0),
(132, 1, '204.28.119.130', '2011-07-28 22:26:14', 'sabri@mail.afixiindia.com', 0),
(133, 4, '117.201.166.151', '2011-07-28 22:59:20', 'upendra@mail.afixiindia.com', 0),
(134, 32, '117.201.166.151', '2011-07-28 23:23:44', 'afixi.jagannath@gmail.com', 0),
(135, 3, '117.201.166.151', '2011-07-28 23:32:26', 'tanmaya@mail.afixiindia.com', 0),
(136, 2, '117.201.166.151', '2011-07-29 00:05:36', 'jagannath@mail.afixiindia.com', 0),
(137, 4, '117.201.166.151', '2011-07-29 00:29:55', 'upendra@mail.afixiindia.com', 0),
(138, 1, '204.28.119.130', '2011-07-29 00:42:51', 'sabri@mail.afixiindia.com', 0),
(139, 5, '117.201.166.151', '2011-07-29 02:29:34', 'biswa@mail.afixiindia.com', 0),
(140, 1, '117.201.166.151', '2011-07-29 04:59:58', 'sabri@mail.afixiindia.com', 0),
(141, 5, '117.201.166.151', '2011-07-29 06:30:28', 'biswa@mail.afixiindia.com', 0),
(142, 32, '117.201.166.151', '2011-07-29 07:28:20', 'afixi.jagannath@gmail.com', 0),
(143, 1, '204.28.119.130', '2011-07-29 16:38:03', 'sabri@mail.afixiindia.com', 0),
(144, 34, '117.197.249.37', '2011-07-29 21:11:34', 'afixi.satya@gmail.com', 0),
(145, 34, '117.197.249.37', '2011-07-29 21:30:48', 'afixi.satya@gmail.com', 0),
(146, 4, '117.197.249.37', '2011-07-29 22:20:41', 'upendra@mail.afixiindia.com', 0),
(147, 1, '75.37.46.27', '2011-07-29 23:01:17', 'sabri@mail.afixiindia.com', 0),
(148, 4, '117.197.249.37', '2011-07-30 01:02:57', 'upendra@mail.afixiindia.com', 0),
(149, 2, '117.197.249.37', '2011-07-30 01:05:48', 'jagannath@mail.afixiindia.com', 0),
(150, 1, '75.37.46.27', '2011-07-30 02:23:12', 'sabri@mail.afixiindia.com', 0),
(151, 2, '117.197.249.37', '2011-07-30 08:05:18', 'jagannath@mail.afixiindia.com', 0),
(152, 24, '27.48.32.51', '2011-07-30 13:06:00', 'afixi.upendra@gmail.com', 0),
(153, 1, '76.230.232.100', '2011-07-30 16:01:00', 'sabri@mail.afixiindia.com', 0),
(154, 35, '173.234.147.122', '2011-07-30 23:45:10', 'lol.i.laugh@gmail.com', 0),
(155, 1, '76.230.232.100', '2011-07-31 06:37:01', 'sabri@mail.afixiindia.com', 0),
(156, 1, '76.230.232.100', '2011-07-31 06:40:29', 'sabri@mail.afixiindia.com', 0),
(157, 1, '76.230.232.100', '2011-07-31 14:40:09', 'sabri@mail.afixiindia.com', 0),
(158, 1, '117.197.253.177', '2011-07-31 20:46:14', 'sabri@mail.afixiindia.com', 0),
(159, 34, '117.197.253.177', '2011-07-31 20:47:55', 'afixi.satya@gmail.com', 0),
(160, 2, '117.197.253.177', '2011-07-31 20:57:17', 'jagannath@mail.afixiindia.com', 0),
(161, 4, '117.197.253.177', '2011-07-31 21:15:55', 'upendra@mail.afixiindia.com', 0),
(162, 5, '117.197.253.177', '2011-07-31 21:42:44', 'biswa@mail.afixiindia.com', 0),
(163, 2, '117.197.253.177', '2011-07-31 22:54:39', 'jagannath@mail.afixiindia.com', 0),
(164, 4, '117.197.255.82', '2011-08-01 00:17:20', 'upendra@mail.afixiindia.com', 0),
(165, 34, '117.197.255.82', '2011-08-01 00:37:37', 'afixi.satya@gmail.com', 0),
(166, 1, '76.230.232.100', '2011-08-01 01:12:27', 'sabri@mail.afixiindia.com', 0),
(167, 2, '117.197.249.31', '2011-08-01 02:26:02', 'jagannath@mail.afixiindia.com', 0),
(168, 34, '117.197.249.31', '2011-08-01 02:29:32', 'afixi.satya@gmail.com', 0),
(169, 1, '136.152.138.197', '2011-08-01 17:09:50', 'sabri@mail.afixiindia.com', 0),
(170, 34, '117.197.245.193', '2011-08-01 20:45:15', 'afixi.satya@gmail.com', 0),
(171, 34, '117.197.245.193', '2011-08-01 21:24:38', 'afixi.satya@gmail.com', 0),
(172, 4, '117.197.245.193', '2011-08-01 23:19:38', 'upendra@mail.afixiindia.com', 0),
(173, 1, '204.28.119.130', '2011-08-01 23:47:45', 'sabri@mail.afixiindia.com', 0),
(174, 2, '117.197.245.193', '2011-08-02 00:18:35', 'jagannath@mail.afixiindia.com', 0),
(175, 2, '117.197.245.193', '2011-08-02 02:25:13', 'jagannath@mail.afixiindia.com', 0),
(176, 1, '204.28.119.130', '2011-08-02 12:39:00', 'sabri@mail.afixiindia.com', 0),
(177, 1, '204.28.119.130', '2011-08-02 16:57:51', 'sabri@mail.afixiindia.com', 0),
(178, 34, '117.197.251.4', '2011-08-02 20:53:16', 'afixi.satya@gmail.com', 0),
(179, 4, '117.197.251.4', '2011-08-02 22:45:41', 'upendra@mail.afixiindia.com', 0),
(180, 1, '204.28.119.130', '2011-08-03 00:28:52', 'sabri@mail.afixiindia.com', 0),
(181, 1, '204.28.119.130', '2011-08-03 13:36:35', 'sabri@mail.afixiindia.com', 0),
(182, 1, '204.28.119.130', '2011-08-03 17:06:04', 'sabri@mail.afixiindia.com', 0),
(183, 34, '117.197.249.186', '2011-08-03 21:12:54', 'afixi.satya@gmail.com', 0),
(184, 1, '204.28.119.130', '2011-08-04 03:02:49', 'sabri@mail.afixiindia.com', 0),
(185, 2, '117.197.246.161', '2011-08-04 03:27:27', 'jagannath@mail.afixiindia.com', 0),
(186, 4, '117.197.246.161', '2011-08-04 04:02:09', 'upendra@mail.afixiindia.com', 0),
(187, 5, '117.197.246.161', '2011-08-04 04:04:39', 'biswa@mail.afixiindia.com', 0),
(188, 30, '117.197.246.161', '2011-08-04 04:07:52', 'biswal805@gmail.com', 0),
(189, 4, '117.197.246.161', '2011-08-04 04:15:21', 'upendra@mail.afixiindia.com', 0),
(190, 2, '117.197.246.161', '2011-08-04 04:16:18', 'jagannath@mail.afixiindia.com', 0),
(191, 34, '117.197.246.161', '2011-08-04 04:18:41', 'afixi.satya@gmail.com', 0),
(192, 5, '117.197.246.161', '2011-08-04 04:20:49', 'biswa@mail.afixiindia.com', 0),
(193, 4, '117.197.246.161', '2011-08-04 04:21:19', 'upendra@mail.afixiindia.com', 0),
(194, 4, '117.197.246.161', '2011-08-04 05:08:38', 'upendra@mail.afixiindia.com', 0),
(195, 34, '117.197.246.161', '2011-08-04 06:09:00', 'afixi.satya@gmail.com', 0),
(196, 24, '117.197.246.161', '2011-08-04 06:10:38', 'afixi.upendra@gmail.com', 0),
(197, 34, '117.197.246.161', '2011-08-04 06:11:51', 'afixi.satya@gmail.com', 0),
(198, 34, '117.197.235.25', '2011-08-04 06:42:59', 'afixi.satya@gmail.com', 0),
(199, 30, '117.197.235.25', '2011-08-04 06:44:33', 'biswal805@gmail.com', 0),
(200, 34, '117.197.236.117', '2011-08-04 06:47:53', 'afixi.satya@gmail.com', 0),
(201, 30, '117.197.236.117', '2011-08-04 06:50:04', 'biswal805@gmail.com', 0),
(202, 30, '117.197.236.117', '2011-08-04 07:11:42', 'biswal805@gmail.com', 0),
(203, 2, '117.197.236.117', '2011-08-04 07:38:24', 'jagannath@mail.afixiindia.com', 0),
(204, 1, '204.28.119.130', '2011-08-04 13:43:59', 'sabri@mail.afixiindia.com', 0),
(205, 1, '204.28.119.130', '2011-08-04 17:10:27', 'sabri@mail.afixiindia.com', 0),
(206, 1, '204.28.119.130', '2011-08-04 19:00:54', 'sabri@mail.afixiindia.com', 0),
(207, 3, '117.197.254.90', '2011-08-04 20:36:58', 'tanmaya@mail.afixiindia.com', 0),
(208, 34, '117.197.254.90', '2011-08-04 20:53:49', 'afixi.satya@gmail.com', 0),
(209, 34, '117.197.254.90', '2011-08-04 20:58:11', 'afixi.satya@gmail.com', 0),
(210, 2, '117.197.254.90', '2011-08-04 20:58:54', 'jagannath@mail.afixiindia.com', 0),
(211, 4, '117.197.254.90', '2011-08-04 21:05:07', 'upendra@mail.afixiindia.com', 0),
(212, 34, '117.197.254.90', '2011-08-04 21:12:32', 'afixi.satya@gmail.com', 0),
(213, 34, '117.197.254.90', '2011-08-04 21:40:55', 'afixi.satya@gmail.com', 0),
(214, 34, '117.197.254.90', '2011-08-04 21:47:00', 'afixi.satya@gmail.com', 0),
(215, 34, '117.197.254.90', '2011-08-04 22:00:24', 'afixi.satya@gmail.com', 0),
(216, 4, '117.197.249.127', '2011-08-04 23:54:48', 'upendra@mail.afixiindia.com', 0),
(217, 34, '117.197.238.125', '2011-08-05 01:58:54', 'afixi.satya@gmail.com', 0),
(218, 34, '117.197.238.125', '2011-08-05 01:59:31', 'afixi.satya@gmail.com', 0),
(219, 34, '117.201.161.51', '2011-08-05 02:48:49', 'afixi.satya@gmail.com', 0),
(220, 1, '204.28.119.130', '2011-08-05 02:58:56', 'sabri@mail.afixiindia.com', 0),
(221, 34, '117.201.161.51', '2011-08-05 04:36:57', 'afixi.satya@gmail.com', 0),
(222, 34, '117.197.233.123', '2011-08-05 05:54:17', 'afixi.satya@gmail.com', 0),
(223, 2, '122.50.136.49', '2011-08-05 10:26:16', 'jagannath@mail.afixiindia.com', 0),
(224, 2, '122.50.136.49', '2011-08-05 10:27:21', 'jagannath@mail.afixiindia.com', 0),
(225, 1, '204.28.119.130', '2011-08-05 13:01:22', 'sabri@mail.afixiindia.com', 0),
(226, 24, '117.197.255.13', '2011-08-05 22:16:30', 'afixi.upendra@gmail.com', 0),
(227, 2, '117.197.255.13', '2011-08-05 22:53:36', 'jagannath@mail.afixiindia.com', 0),
(228, 1, '204.28.119.130', '2011-08-05 22:59:40', 'sabri@mail.afixiindia.com', 0),
(229, 2, '117.197.255.13', '2011-08-05 23:07:57', 'jagannath@mail.afixiindia.com', 0),
(230, 24, '117.197.255.13', '2011-08-05 23:24:39', 'afixi.upendra@gmail.com', 0),
(231, 2, '117.197.255.13', '2011-08-05 23:32:15', 'jagannath@mail.afixiindia.com', 0),
(232, 2, '117.197.255.13', '2011-08-05 23:34:53', 'jagannath@mail.afixiindia.com', 0),
(233, 24, '117.197.255.13', '2011-08-05 23:41:43', 'afixi.upendra@gmail.com', 0),
(234, 24, '117.197.255.13', '2011-08-05 23:46:21', 'afixi.upendra@gmail.com', 0),
(235, 2, '117.197.255.13', '2011-08-05 23:46:38', 'jagannath@mail.afixiindia.com', 0),
(236, 3, '117.197.255.13', '2011-08-05 23:50:30', 'tanmaya@mail.afixiindia.com', 0),
(237, 1, '204.28.119.130', '2011-08-06 01:51:25', 'sabri@mail.afixiindia.com', 0),
(238, 2, '117.197.245.177', '2011-08-06 02:25:15', 'jagannath@mail.afixiindia.com', 0),
(239, 4, '117.201.160.89', '2011-08-06 04:53:13', 'upendra@mail.afixiindia.com', 0),
(240, 1, '204.28.119.130', '2011-08-06 06:10:36', 'sabri@mail.afixiindia.com', 0),
(241, 2, '117.201.160.89', '2011-08-06 06:54:45', 'jagannath@mail.afixiindia.com', 0),
(242, 2, '122.50.138.14', '2011-08-06 09:17:34', 'jagannath@mail.afixiindia.com', 0),
(243, 2, '122.50.138.14', '2011-08-06 09:21:37', 'jagannath@mail.afixiindia.com', 0),
(244, 1, '204.28.119.130', '2011-08-06 14:22:18', 'sabri@mail.afixiindia.com', 0),
(245, 1, '204.28.119.130', '2011-08-06 17:41:26', 'sabri@mail.afixiindia.com', 0),
(246, 2, '122.50.138.14', '2011-08-06 21:46:57', 'jagannath@mail.afixiindia.com', 0),
(247, 2, '117.203.208.244', '2011-08-06 21:48:20', 'jagannath@mail.afixiindia.com', 0),
(248, 1, '204.28.119.130', '2011-08-06 21:51:02', 'sabri@mail.afixiindia.com', 0),
(249, 2, '122.50.138.14', '2011-08-07 06:35:00', 'jagannath@mail.afixiindia.com', 0),
(250, 2, '122.50.138.14', '2011-08-07 06:35:26', 'jagannath@mail.afixiindia.com', 0),
(251, 2, '122.50.138.14', '2011-08-07 07:26:48', 'jagannath@mail.afixiindia.com', 0),
(252, 1, '204.28.119.130', '2011-08-07 17:45:15', 'sabri@mail.afixiindia.com', 0),
(253, 4, '117.197.247.208', '2011-08-07 21:02:11', 'upendra@mail.afixiindia.com', 0),
(254, 2, '117.197.247.208', '2011-08-07 21:36:56', 'jagannath@mail.afixiindia.com', 0),
(255, 2, '117.197.247.208', '2011-08-07 21:38:10', 'jagannath@mail.afixiindia.com', 0),
(256, 2, '117.197.247.208', '2011-08-07 21:44:51', 'jagannath@mail.afixiindia.com', 0),
(257, 2, '117.197.247.208', '2011-08-07 21:48:25', 'jagannath@mail.afixiindia.com', 0),
(258, 2, '117.197.247.208', '2011-08-07 21:51:08', 'jagannath@mail.afixiindia.com', 0),
(259, 34, '117.197.233.165', '2011-08-08 00:17:19', 'afixi.satya@gmail.com', 0),
(260, 1, '136.152.178.26', '2011-08-08 16:12:27', 'sabri@mail.afixiindia.com', 0),
(261, 2, '117.197.250.111', '2011-08-08 22:36:45', 'jagannath@mail.afixiindia.com', 0),
(262, 1, '204.28.119.130', '2011-08-09 05:02:52', 'sabri@mail.afixiindia.com', 0),
(263, 5, '117.197.250.111', '2011-08-09 05:42:28', 'biswa@mail.afixiindia.com', 0),
(264, 4, '117.197.250.111', '2011-08-09 07:11:46', 'upendra@mail.afixiindia.com', 0),
(265, 34, '117.197.243.57', '2011-08-09 20:48:39', 'afixi.satya@gmail.com', 0),
(266, 4, '117.197.243.57', '2011-08-09 21:49:24', 'upendra@mail.afixiindia.com', 0),
(267, 4, '117.197.243.57', '2011-08-09 22:01:15', 'upendra@mail.afixiindia.com', 0),
(268, 4, '117.197.243.57', '2011-08-10 01:03:02', 'upendra@mail.afixiindia.com', 0),
(269, 3, '117.197.243.57', '2011-08-10 01:05:04', 'tanmaya@mail.afixiindia.com', 0),
(270, 4, '117.197.243.57', '2011-08-10 01:06:01', 'upendra@mail.afixiindia.com', 0),
(271, 3, '117.197.243.57', '2011-08-10 02:09:35', 'tanmaya@mail.afixiindia.com', 0),
(272, 3, '117.197.243.57', '2011-08-10 02:30:47', 'tanmaya@mail.afixiindia.com', 0),
(273, 4, '117.197.243.57', '2011-08-10 02:38:42', 'upendra@mail.afixiindia.com', 0),
(274, 5, '117.197.243.57', '2011-08-10 02:40:16', 'biswa@mail.afixiindia.com', 0),
(275, 5, '117.197.243.57', '2011-08-10 02:49:07', 'biswa@mail.afixiindia.com', 0),
(276, 3, '117.197.243.57', '2011-08-10 02:49:41', 'tanmaya@mail.afixiindia.com', 0),
(277, 2, '117.197.243.57', '2011-08-10 02:50:56', 'jagannath@mail.afixiindia.com', 0),
(278, 5, '117.197.243.57', '2011-08-10 02:52:02', 'biswa@mail.afixiindia.com', 0),
(279, 1, '204.28.119.130', '2011-08-10 04:08:39', 'sabri@mail.afixiindia.com', 0),
(280, 3, '117.201.165.60', '2011-08-10 04:16:39', 'tanmaya@mail.afixiindia.com', 0),
(281, 2, '117.201.163.105', '2011-08-10 06:10:55', 'jagannath@mail.afixiindia.com', 0),
(282, 2, '117.201.163.105', '2011-08-10 22:49:10', 'jagannath@mail.afixiindia.com', 0),
(283, 2, '117.201.163.105', '2011-08-10 22:50:06', 'jagannath@mail.afixiindia.com', 0),
(284, 1, '117.201.163.105', '2011-08-10 23:26:20', 'sabri@mail.afixiindia.com', 0),
(285, 1, '204.28.119.130', '2011-08-10 23:36:37', 'sabri@mail.afixiindia.com', 0),
(286, 2, '117.201.163.105', '2011-08-10 23:41:36', 'jagannath@mail.afixiindia.com', 0),
(287, 1, '204.28.119.132', '2011-08-10 23:44:09', 'sabri@mail.afixiindia.com', 0),
(288, 34, '117.201.163.105', '2011-08-10 23:52:27', 'afixi.satya@gmail.com', 0),
(289, 34, '117.201.163.105', '2011-08-11 02:29:15', 'afixi.satya@gmail.com', 0),
(290, 34, '117.201.163.105', '2011-08-11 02:31:44', 'afixi.satya@gmail.com', 0),
(291, 34, '117.201.163.105', '2011-08-11 02:41:08', 'afixi.satya@gmail.com', 0),
(292, 34, '117.201.163.105', '2011-08-11 02:45:12', 'afixi.satya@gmail.com', 0),
(293, 34, '117.201.163.105', '2011-08-11 02:53:52', 'afixi.satya@gmail.com', 0),
(294, 34, '117.201.163.105', '2011-08-11 04:17:50', 'afixi.satya@gmail.com', 0),
(295, 2, '117.197.252.189', '2011-08-11 06:25:51', 'jagannath@mail.afixiindia.com', 0),
(296, 2, '117.197.243.178', '2011-08-11 21:20:57', 'jagannath@mail.afixiindia.com', 0),
(297, 2, '117.201.165.46', '2011-08-12 00:20:45', 'jagannath@mail.afixiindia.com', 0),
(298, 2, '117.197.244.247', '2011-08-12 06:13:00', 'jagannath@mail.afixiindia.com', 0),
(299, 1, '204.28.119.132', '2011-08-12 22:11:29', 'sabri@mail.afixiindia.com', 0),
(300, 1, '204.28.119.130', '2011-08-12 23:35:26', 'sabri@mail.afixiindia.com', 0),
(301, 1, '204.28.119.130', '2011-08-13 01:23:57', 'sabri@mail.afixiindia.com', 0),
(302, 1, '204.28.119.130', '2011-08-13 10:31:52', 'sabri@mail.afixiindia.com', 0),
(303, 1, '75.37.43.42', '2011-08-14 04:22:06', 'sabri@mail.afixiindia.com', 0),
(304, 2, '122.50.132.144', '2011-08-14 05:28:37', 'jagannath@mail.afixiindia.com', 0),
(305, 2, '122.50.132.144', '2011-08-14 05:34:10', 'jagannath@mail.afixiindia.com', 0),
(306, 2, '122.50.132.144', '2011-08-14 05:35:40', 'jagannath@mail.afixiindia.com', 0),
(307, 1, '75.37.43.42', '2011-08-14 05:39:11', 'sabri@mail.afixiindia.com', 0),
(308, 1, '75.37.43.42', '2011-08-14 16:34:44', 'sabri@mail.afixiindia.com', 0),
(309, 1, '75.37.43.42', '2011-08-15 17:33:03', 'sabri@mail.afixiindia.com', 0),
(310, 2, '117.197.233.106', '2011-08-15 22:50:26', 'jagannath@mail.afixiindia.com', 0),
(311, 2, '117.197.233.106', '2011-08-15 23:24:10', 'jagannath@mail.afixiindia.com', 0),
(312, 2, '117.197.233.106', '2011-08-15 23:26:29', 'jagannath@mail.afixiindia.com', 0),
(313, 2, '117.197.233.106', '2011-08-15 23:43:01', 'jagannath@mail.afixiindia.com', 0),
(314, 2, '117.197.233.106', '2011-08-16 06:01:00', 'jagannath@mail.afixiindia.com', 0),
(315, 32, '117.197.233.106', '2011-08-16 06:45:14', 'afixi.jagannath@gmail.com', 0),
(316, 4, '117.197.253.66', '2011-08-16 20:56:42', 'upendra@mail.afixiindia.com', 0),
(317, 32, '117.197.253.66', '2011-08-16 21:14:48', 'afixi.jagannath@gmail.com', 0),
(318, 1, '75.36.200.147', '2011-08-17 03:41:38', 'sabri@mail.afixiindia.com', 0),
(319, 34, '117.201.161.219', '2011-08-17 04:06:23', 'afixi.satya@gmail.com', 0),
(320, 34, '117.201.161.219', '2011-08-17 04:09:35', 'afixi.satya@gmail.com', 0),
(321, 34, '117.201.161.219', '2011-08-17 04:43:29', 'afixi.satya@gmail.com', 0),
(322, 34, '117.201.161.219', '2011-08-17 04:46:35', 'afixi.satya@gmail.com', 0),
(323, 34, '117.197.254.18', '2011-08-17 05:44:08', 'afixi.satya@gmail.com', 0),
(324, 4, '117.197.254.18', '2011-08-17 05:55:01', 'upendra@mail.afixiindia.com', 0),
(325, 4, '117.197.254.18', '2011-08-17 05:59:03', 'upendra@mail.afixiindia.com', 0),
(326, 1, '117.197.254.18', '2011-08-17 05:59:51', 'sabri@mail.afixiindia.com', 0),
(327, 4, '117.197.254.18', '2011-08-17 06:00:46', 'upendra@mail.afixiindia.com', 0),
(328, 2, '117.197.254.18', '2011-08-17 06:21:51', 'jagannath@mail.afixiindia.com', 0),
(329, 4, '117.197.254.18', '2011-08-17 06:28:03', 'upendra@mail.afixiindia.com', 0),
(330, 1, '76.230.235.190', '2011-08-17 12:16:06', 'sabri@mail.afixiindia.com', 0),
(331, 1, '75.36.207.17', '2011-08-17 16:33:40', 'sabri@mail.afixiindia.com', 0),
(332, 1, '75.36.207.17', '2011-08-17 16:33:49', 'sabri@mail.afixiindia.com', 0),
(333, 1, '108.205.200.122', '2011-08-17 20:38:01', 'sabri@mail.afixiindia.com', 0),
(334, 34, '117.197.246.187', '2011-08-17 20:41:16', 'afixi.satya@gmail.com', 0),
(335, 34, '117.197.255.60', '2011-08-17 21:51:43', 'afixi.satya@gmail.com', 0),
(336, 32, '117.197.255.60', '2011-08-17 22:26:47', 'afixi.jagannath@gmail.com', 0),
(337, 34, '117.197.239.152', '2011-08-17 23:54:23', 'afixi.satya@gmail.com', 0),
(338, 34, '117.197.239.152', '2011-08-17 23:55:42', 'afixi.satya@gmail.com', 0),
(339, 34, '117.197.239.152', '2011-08-17 23:56:12', 'afixi.satya@gmail.com', 0),
(340, 4, '117.197.239.152', '2011-08-18 00:39:31', 'upendra@mail.afixiindia.com', 0),
(341, 2, '117.197.253.132', '2011-08-18 02:30:21', 'jagannath@mail.afixiindia.com', 0),
(342, 4, '117.197.253.132', '2011-08-18 02:38:47', 'upendra@mail.afixiindia.com', 0),
(343, 24, '117.197.253.132', '2011-08-18 02:58:38', 'afixi.upendra@gmail.com', 0),
(344, 2, '117.197.253.132', '2011-08-18 03:50:32', 'jagannath@mail.afixiindia.com', 0),
(345, 1, '117.197.253.132', '2011-08-18 03:54:22', 'sabri@mail.afixiindia.com', 0),
(346, 34, '117.197.253.132', '2011-08-18 03:58:03', 'afixi.satya@gmail.com', 0),
(347, 2, '117.197.253.132', '2011-08-18 04:11:02', 'jagannath@mail.afixiindia.com', 0),
(348, 34, '117.197.253.132', '2011-08-18 04:18:47', 'afixi.satya@gmail.com', 0),
(349, 2, '117.197.253.132', '2011-08-18 04:24:13', 'jagannath@mail.afixiindia.com', 0),
(350, 24, '117.197.253.132', '2011-08-18 04:39:19', 'afixi.upendra@gmail.com', 0),
(351, 2, '117.197.253.132', '2011-08-18 04:39:20', 'jagannath@mail.afixiindia.com', 0),
(352, 2, '117.197.253.132', '2011-08-18 04:46:02', 'jagannath@mail.afixiindia.com', 0),
(353, 34, '117.197.253.132', '2011-08-18 04:54:42', 'afixi.satya@gmail.com', 0),
(354, 34, '117.197.253.132', '2011-08-18 04:55:31', 'afixi.satya@gmail.com', 0),
(355, 34, '117.197.253.132', '2011-08-18 04:57:32', 'afixi.satya@gmail.com', 0),
(356, 2, '117.197.253.132', '2011-08-18 05:01:41', 'jagannath@mail.afixiindia.com', 0),
(357, 34, '117.197.253.132', '2011-08-18 05:50:17', 'afixi.satya@gmail.com', 0),
(358, 24, '117.197.253.132', '2011-08-18 05:51:44', 'afixi.upendra@gmail.com', 0),
(359, 24, '117.197.253.132', '2011-08-18 05:52:53', 'afixi.upendra@gmail.com', 0),
(360, 24, '117.197.253.132', '2011-08-18 05:54:44', 'afixi.upendra@gmail.com', 0),
(361, 24, '117.197.253.132', '2011-08-18 05:57:55', 'afixi.upendra@gmail.com', 0),
(362, 24, '117.197.253.132', '2011-08-18 05:59:09', 'afixi.upendra@gmail.com', 0),
(363, 24, '117.197.253.132', '2011-08-18 06:10:36', 'afixi.upendra@gmail.com', 0),
(364, 2, '117.197.253.132', '2011-08-18 06:14:01', 'jagannath@mail.afixiindia.com', 0),
(365, 2, '117.197.253.132', '2011-08-18 06:15:04', 'jagannath@mail.afixiindia.com', 0),
(366, 1, '117.197.253.132', '2011-08-18 06:28:32', 'sabri@mail.afixiindia.com', 0),
(367, 2, '117.197.253.132', '2011-08-18 06:53:45', 'jagannath@mail.afixiindia.com', 0),
(368, 2, '117.197.253.132', '2011-08-18 07:26:00', 'jagannath@mail.afixiindia.com', 0),
(369, 34, '117.197.232.204', '2011-08-18 20:56:54', 'afixi.satya@gmail.com', 0),
(370, 34, '117.197.232.204', '2011-08-18 20:59:19', 'afixi.satya@gmail.com', 0),
(371, 34, '117.197.232.204', '2011-08-18 20:59:28', 'afixi.satya@gmail.com', 0),
(372, 2, '117.197.232.204', '2011-08-18 21:02:48', 'jagannath@mail.afixiindia.com', 0),
(373, 24, '117.197.232.204', '2011-08-18 21:08:27', 'afixi.upendra@gmail.com', 0),
(374, 24, '117.197.232.204', '2011-08-18 21:09:55', 'afixi.upendra@gmail.com', 0),
(375, 24, '117.197.232.204', '2011-08-18 21:10:49', 'afixi.upendra@gmail.com', 0),
(376, 2, '117.197.232.204', '2011-08-18 21:19:47', 'jagannath@mail.afixiindia.com', 0),
(377, 34, '117.197.232.204', '2011-08-18 21:20:37', 'afixi.satya@gmail.com', 0),
(378, 34, '117.197.232.204', '2011-08-18 21:21:36', 'afixi.satya@gmail.com', 0),
(379, 24, '117.197.232.204', '2011-08-18 21:22:41', 'afixi.upendra@gmail.com', 0),
(380, 34, '117.197.232.204', '2011-08-18 21:26:41', 'afixi.satya@gmail.com', 0),
(381, 24, '117.197.232.204', '2011-08-18 21:35:02', 'afixi.upendra@gmail.com', 0),
(382, 2, '117.197.232.204', '2011-08-18 21:35:06', 'jagannath@mail.afixiindia.com', 0),
(383, 1, '117.197.232.204', '2011-08-18 21:37:35', 'sabri@mail.afixiindia.com', 0),
(384, 1, '117.197.232.204', '2011-08-18 21:43:28', 'sabri@mail.afixiindia.com', 0),
(385, 1, '117.197.232.204', '2011-08-18 21:52:06', 'sabri@mail.afixiindia.com', 0),
(386, 5, '117.197.232.204', '2011-08-18 21:53:02', 'biswa@mail.afixiindia.com', 0),
(387, 5, '117.197.232.204', '2011-08-18 21:54:54', 'biswa@mail.afixiindia.com', 0),
(388, 2, '117.197.232.204', '2011-08-18 22:04:56', 'jagannath@mail.afixiindia.com', 0),
(389, 5, '117.197.232.204', '2011-08-18 22:10:09', 'biswa@mail.afixiindia.com', 0),
(390, 5, '117.197.232.204', '2011-08-18 22:11:09', 'biswa@mail.afixiindia.com', 0),
(391, 2, '117.197.232.204', '2011-08-18 22:14:05', 'jagannath@mail.afixiindia.com', 0),
(392, 1, '117.197.232.204', '2011-08-18 22:17:22', 'sabri@mail.afixiindia.com', 0),
(393, 1, '117.197.232.204', '2011-08-18 22:24:22', 'sabri@mail.afixiindia.com', 0),
(394, 2, '117.197.232.204', '2011-08-18 22:29:28', 'jagannath@mail.afixiindia.com', 0),
(395, 2, '117.197.232.204', '2011-08-18 22:40:48', 'jagannath@mail.afixiindia.com', 0),
(396, 1, '117.197.232.204', '2011-08-18 22:41:21', 'sabri@mail.afixiindia.com', 0),
(397, 3, '117.197.232.204', '2011-08-18 22:43:27', 'tanmaya@mail.afixiindia.com', 0),
(398, 24, '117.197.232.204', '2011-08-18 22:53:15', 'afixi.upendra@gmail.com', 0),
(399, 2, '117.197.232.204', '2011-08-18 22:59:39', 'jagannath@mail.afixiindia.com', 0),
(400, 34, '117.197.232.204', '2011-08-18 23:06:48', 'afixi.satya@gmail.com', 0),
(401, 34, '117.197.232.204', '2011-08-18 23:07:28', 'afixi.satya@gmail.com', 0),
(402, 34, '117.197.232.204', '2011-08-18 23:11:00', 'afixi.satya@gmail.com', 0),
(403, 34, '117.197.232.204', '2011-08-18 23:47:34', 'afixi.satya@gmail.com', 0),
(404, 4, '117.197.232.204', '2011-08-19 00:06:47', 'upendra@mail.afixiindia.com', 0),
(405, 4, '117.197.232.204', '2011-08-19 00:12:33', 'upendra@mail.afixiindia.com', 0),
(406, 1, '117.197.232.204', '2011-08-19 00:17:22', 'sabri@mail.afixiindia.com', 0),
(407, 2, '117.197.232.204', '2011-08-19 00:30:47', 'jagannath@mail.afixiindia.com', 0),
(408, 4, '117.197.232.204', '2011-08-19 00:32:49', 'upendra@mail.afixiindia.com', 0),
(409, 34, '117.197.232.204', '2011-08-19 00:58:46', 'afixi.satya@gmail.com', 0),
(410, 1, '108.205.200.122', '2011-08-19 01:11:15', 'sabri@mail.afixiindia.com', 0),
(411, 1, '76.216.21.176', '2011-08-19 01:43:36', 'sabri@mail.afixiindia.com', 0),
(412, 34, '117.197.249.49', '2011-08-19 01:52:01', 'afixi.satya@gmail.com', 0),
(413, 34, '117.197.249.49', '2011-08-19 01:52:17', 'afixi.satya@gmail.com', 0),
(414, 1, '117.197.249.49', '2011-08-19 01:59:36', 'sabri@mail.afixiindia.com', 0),
(415, 34, '117.197.249.49', '2011-08-19 02:10:29', 'afixi.satya@gmail.com', 0),
(416, 34, '117.197.249.49', '2011-08-19 02:14:09', 'afixi.satya@gmail.com', 0),
(417, 34, '117.197.249.49', '2011-08-19 02:18:20', 'afixi.satya@gmail.com', 0),
(418, 3, '117.197.249.49', '2011-08-19 02:20:31', 'tanmaya@mail.afixiindia.com', 0),
(419, 2, '117.197.249.49', '2011-08-19 02:24:25', 'jagannath@mail.afixiindia.com', 0),
(420, 35, '67.160.197.181', '2011-08-19 02:25:33', 'lol.i.laugh@gmail.com', 0),
(421, 2, '117.197.249.49', '2011-08-19 02:26:12', 'jagannath@mail.afixiindia.com', 0),
(422, 1, '117.197.249.49', '2011-08-19 03:06:17', 'sabri@mail.afixiindia.com', 0),
(423, 34, '117.197.249.49', '2011-08-19 03:22:25', 'afixi.satya@gmail.com', 0),
(424, 2, '117.197.249.49', '2011-08-19 03:34:46', 'jagannath@mail.afixiindia.com', 0),
(425, 2, '117.197.249.49', '2011-08-19 03:47:56', 'jagannath@mail.afixiindia.com', 0),
(426, 34, '117.197.249.49', '2011-08-19 04:08:30', 'afixi.satya@gmail.com', 0),
(427, 2, '117.197.249.49', '2011-08-19 05:52:58', 'jagannath@mail.afixiindia.com', 0),
(428, 1, '117.197.249.49', '2011-08-19 05:55:23', 'sabri@mail.afixiindia.com', 0),
(429, 34, '117.197.249.49', '2011-08-19 06:25:51', 'afixi.satya@gmail.com', 0),
(430, 2, '117.197.249.49', '2011-08-19 06:27:59', 'jagannath@mail.afixiindia.com', 0),
(431, 34, '117.197.249.49', '2011-08-19 06:45:39', 'afixi.satya@gmail.com', 0),
(432, 34, '117.197.235.93', '2011-08-19 20:56:41', 'afixi.satya@gmail.com', 0),
(433, 34, '117.197.235.93', '2011-08-19 20:56:56', 'afixi.satya@gmail.com', 0),
(434, 1, '117.197.235.93', '2011-08-19 21:01:22', 'sabri@mail.afixiindia.com', 0),
(435, 1, '117.197.235.93', '2011-08-19 21:07:52', 'sabri@mail.afixiindia.com', 0),
(436, 34, '117.197.235.93', '2011-08-19 21:09:31', 'afixi.satya@gmail.com', 0),
(437, 34, '117.197.235.93', '2011-08-19 21:18:18', 'afixi.satya@gmail.com', 0),
(438, 34, '117.197.235.93', '2011-08-19 21:20:44', 'afixi.satya@gmail.com', 0),
(439, 1, '117.197.235.93', '2011-08-19 21:23:36', 'sabri@mail.afixiindia.com', 0),
(440, 2, '117.197.244.133', '2011-08-19 23:19:00', 'jagannath@mail.afixiindia.com', 0),
(441, 1, '76.216.22.128', '2011-08-19 23:24:03', 'sabri@mail.afixiindia.com', 0),
(442, 2, '117.197.244.133', '2011-08-19 23:38:44', 'jagannath@mail.afixiindia.com', 0),
(443, 2, '76.216.22.128', '2011-08-19 23:41:33', 'jagannath@mail.afixiindia.com', 0),
(444, 3, '76.216.22.128', '2011-08-19 23:49:04', 'tanmaya@mail.afixiindia.com', 0),
(445, 34, '117.197.244.133', '2011-08-19 23:51:01', 'afixi.satya@gmail.com', 0),
(446, 34, '117.197.244.133', '2011-08-19 23:53:09', 'afixi.satya@gmail.com', 0),
(447, 34, '117.197.244.133', '2011-08-19 23:54:22', 'afixi.satya@gmail.com', 0),
(448, 2, '76.216.22.128', '2011-08-20 00:10:13', 'jagannath@mail.afixiindia.com', 0),
(449, 2, '117.197.244.133', '2011-08-20 00:14:24', 'jagannath@mail.afixiindia.com', 0),
(450, 1, '117.197.244.133', '2011-08-20 00:15:12', 'sabri@mail.afixiindia.com', 0),
(451, 1, '117.197.244.133', '2011-08-20 00:16:11', 'sabri@mail.afixiindia.com', 0),
(452, 2, '117.197.244.133', '2011-08-20 00:18:06', 'jagannath@mail.afixiindia.com', 0),
(453, 3, '117.197.244.133', '2011-08-20 00:28:05', 'tanmaya@mail.afixiindia.com', 0),
(454, 2, '117.197.244.133', '2011-08-20 00:58:40', 'jagannath@mail.afixiindia.com', 0),
(455, 2, '117.201.160.57', '2011-08-20 02:43:26', 'jagannath@mail.afixiindia.com', 0),
(456, 34, '117.201.160.57', '2011-08-20 03:42:56', 'afixi.satya@gmail.com', 0),
(457, 34, '117.201.160.57', '2011-08-20 03:47:35', 'afixi.satya@gmail.com', 0),
(458, 3, '117.201.160.57', '2011-08-20 05:05:08', 'tanmaya@mail.afixiindia.com', 0),
(459, 34, '117.201.160.57', '2011-08-20 05:47:32', 'afixi.satya@gmail.com', 0),
(460, 34, '117.201.160.57', '2011-08-20 05:47:41', 'afixi.satya@gmail.com', 0),
(461, 34, '117.201.160.57', '2011-08-20 06:04:07', 'afixi.satya@gmail.com', 0),
(462, 1, '117.201.160.57', '2011-08-20 06:09:50', 'sabri@mail.afixiindia.com', 0),
(463, 3, '117.201.160.57', '2011-08-20 06:39:34', 'tanmaya@mail.afixiindia.com', 0),
(464, 2, '117.201.160.57', '2011-08-20 06:57:45', 'jagannath@mail.afixiindia.com', 0),
(465, 3, '117.201.160.57', '2011-08-20 06:59:21', 'tanmaya@mail.afixiindia.com', 0),
(466, 3, '117.201.160.57', '2011-08-20 07:03:49', 'tanmaya@mail.afixiindia.com', 0),
(467, 4, '117.201.160.57', '2011-08-20 07:07:47', 'upendra@mail.afixiindia.com', 0),
(468, 1, '117.201.160.57', '2011-08-20 07:23:48', 'sabri@mail.afixiindia.com', 0),
(469, 1, '117.201.160.57', '2011-08-20 07:57:35', 'sabri@mail.afixiindia.com', 0),
(470, 2, '76.230.233.90', '2011-08-20 15:52:53', 'jagannath@mail.afixiindia.com', 0),
(471, 1, '198.94.221.87', '2011-08-20 17:15:18', 'sabri@mail.afixiindia.com', 0),
(472, 35, '198.94.221.87', '2011-08-20 17:16:49', 'lol.i.laugh@gmail.com', 0),
(473, 1, '198.94.221.87', '2011-08-20 17:45:53', 'sabri@mail.afixiindia.com', 0),
(474, 36, '198.94.221.87', '2011-08-20 17:47:10', 'muazs786@gmail.com', 0),
(475, 36, '108.205.200.122', '2011-08-20 18:17:33', 'muazs786@gmail.com', 0),
(476, 2, '122.50.131.173', '2011-08-20 21:36:33', 'jagannath@mail.afixiindia.com', 0),
(477, 2, '122.50.131.173', '2011-08-20 21:36:35', 'jagannath@mail.afixiindia.com', 0),
(478, 36, '108.205.200.122', '2011-08-20 22:48:33', 'muazs786@gmail.com', 0),
(479, 2, '76.230.233.90', '2011-08-20 23:14:26', 'jagannath@mail.afixiindia.com', 0),
(480, 2, '122.50.131.165', '2011-08-21 18:32:15', 'jagannath@mail.afixiindia.com', 0),
(481, 2, '117.197.233.113', '2011-08-21 20:50:41', 'jagannath@mail.afixiindia.com', 0),
(482, 34, '117.197.233.113', '2011-08-21 21:01:18', 'afixi.satya@gmail.com', 0),
(483, 34, '117.197.233.113', '2011-08-21 21:01:54', 'afixi.satya@gmail.com', 0),
(484, 34, '117.197.233.113', '2011-08-21 21:20:21', 'afixi.satya@gmail.com', 0),
(485, 34, '117.197.233.113', '2011-08-21 21:21:00', 'afixi.satya@gmail.com', 0),
(486, 1, '117.197.233.113', '2011-08-21 21:43:09', 'sabri@mail.afixiindia.com', 0),
(487, 3, '117.197.233.113', '2011-08-21 21:56:20', 'tanmaya@mail.afixiindia.com', 0),
(488, 3, '117.197.233.113', '2011-08-21 22:03:15', 'tanmaya@mail.afixiindia.com', 0),
(489, 4, '117.197.233.113', '2011-08-21 22:24:50', 'upendra@mail.afixiindia.com', 0),
(490, 2, '117.197.233.113', '2011-08-21 22:25:34', 'jagannath@mail.afixiindia.com', 0),
(491, 1, '117.197.233.113', '2011-08-21 22:28:21', 'sabri@mail.afixiindia.com', 0),
(492, 8, '117.197.233.113', '2011-08-21 22:34:57', 'arun@mail.afixiindia.com', 0),
(493, 2, '117.197.233.113', '2011-08-21 22:52:45', 'jagannath@mail.afixiindia.com', 0),
(494, 2, '117.197.233.113', '2011-08-21 23:30:39', 'jagannath@mail.afixiindia.com', 0),
(495, 35, '67.160.197.181', '2011-08-21 23:32:34', 'lol.i.laugh@gmail.com', 0),
(496, 5, '117.197.233.113', '2011-08-21 23:39:00', 'biswa@mail.afixiindia.com', 0),
(497, 5, '117.197.233.113', '2011-08-21 23:41:16', 'biswa@mail.afixiindia.com', 0),
(498, 5, '117.197.233.113', '2011-08-22 00:00:28', 'biswa@mail.afixiindia.com', 0),
(499, 34, '117.197.233.113', '2011-08-22 00:03:15', 'afixi.satya@gmail.com', 0),
(500, 34, '117.197.233.113', '2011-08-22 00:04:10', 'afixi.satya@gmail.com', 0),
(501, 3, '117.197.233.113', '2011-08-22 00:04:47', 'tanmaya@mail.afixiindia.com', 0),
(502, 2, '117.197.233.113', '2011-08-22 00:08:17', 'jagannath@mail.afixiindia.com', 0),
(503, 32, '117.197.233.113', '2011-08-22 00:27:54', 'afixi.jagannath@gmail.com', 0),
(504, 2, '117.197.233.113', '2011-08-22 00:35:12', 'jagannath@mail.afixiindia.com', 0),
(505, 4, '117.197.233.113', '2011-08-22 00:47:24', 'upendra@mail.afixiindia.com', 0),
(506, 8, '117.197.233.113', '2011-08-22 00:50:24', 'arun@mail.afixiindia.com', 0),
(507, 5, '117.197.233.113', '2011-08-22 00:55:45', 'biswa@mail.afixiindia.com', 0),
(508, 8, '117.197.233.113', '2011-08-22 00:57:49', 'arun@mail.afixiindia.com', 0),
(509, 2, '117.197.233.113', '2011-08-22 01:00:35', 'jagannath@mail.afixiindia.com', 0),
(510, 34, '117.197.233.113', '2011-08-22 01:00:46', 'afixi.satya@gmail.com', 0),
(511, 34, '117.197.233.113', '2011-08-22 01:01:01', 'afixi.satya@gmail.com', 0),
(512, 4, '117.197.233.113', '2011-08-22 01:01:28', 'upendra@mail.afixiindia.com', 0),
(513, 4, '117.197.233.113', '2011-08-22 01:06:59', 'upendra@mail.afixiindia.com', 0),
(514, 8, '117.197.233.113', '2011-08-22 01:07:32', 'arun@mail.afixiindia.com', 0),
(515, 4, '117.197.233.113', '2011-08-22 01:08:36', 'upendra@mail.afixiindia.com', 0),
(516, 8, '117.201.162.22', '2011-08-22 02:11:46', 'arun@mail.afixiindia.com', 0),
(517, 4, '117.201.162.22', '2011-08-22 02:16:03', 'upendra@mail.afixiindia.com', 0),
(518, 5, '117.201.162.22', '2011-08-22 02:17:45', 'biswa@mail.afixiindia.com', 0),
(519, 10, '117.201.162.22', '2011-08-22 02:36:35', 'prabhu@mail.afixiindia.com', 0),
(520, 34, '117.201.162.22', '2011-08-22 02:36:58', 'afixi.satya@gmail.com', 0),
(521, 1, '117.201.162.22', '2011-08-22 03:05:46', 'sabri@mail.afixiindia.com', 0),
(522, 2, '117.201.162.22', '2011-08-22 04:17:03', 'jagannath@mail.afixiindia.com', 0),
(523, 10, '117.201.162.22', '2011-08-22 04:19:21', 'prabhu@mail.afixiindia.com', 0),
(524, 10, '117.197.255.101', '2011-08-22 04:43:43', 'prabhu@mail.afixiindia.com', 0),
(525, 34, '117.197.255.101', '2011-08-22 04:51:44', 'afixi.satya@gmail.com', 0),
(526, 34, '117.197.255.101', '2011-08-22 05:07:30', 'afixi.satya@gmail.com', 0),
(527, 34, '117.197.255.101', '2011-08-22 05:08:31', 'afixi.satya@gmail.com', 0),
(528, 3, '117.197.255.101', '2011-08-22 06:17:45', 'tanmaya@mail.afixiindia.com', 0),
(529, 5, '117.197.255.101', '2011-08-22 06:25:02', 'biswa@mail.afixiindia.com', 0),
(530, 5, '117.197.255.101', '2011-08-22 06:36:33', 'biswa@mail.afixiindia.com', 0),
(531, 3, '117.197.255.101', '2011-08-22 06:46:36', 'tanmaya@mail.afixiindia.com', 0),
(532, 2, '117.197.255.101', '2011-08-22 07:29:24', 'jagannath@mail.afixiindia.com', 0),
(533, 23, '122.50.128.100', '2011-08-22 10:53:35', 'jagannath.behera104@gmail.com', 0),
(534, 2, '122.50.128.100', '2011-08-22 10:59:13', 'jagannath@mail.afixiindia.com', 0),
(535, 3, '122.50.128.100', '2011-08-22 11:04:38', 'tanmaya@mail.afixiindia.com', 0),
(536, 3, '122.50.128.100', '2011-08-22 12:04:12', 'tanmaya@mail.afixiindia.com', 0),
(537, 4, '122.50.128.100', '2011-08-22 12:31:59', 'upendra@mail.afixiindia.com', 0),
(538, 3, '122.50.128.100', '2011-08-22 12:35:41', 'tanmaya@mail.afixiindia.com', 0),
(539, 4, '122.50.128.100', '2011-08-22 12:36:00', 'upendra@mail.afixiindia.com', 0),
(540, 10, '122.50.128.100', '2011-08-22 12:52:00', 'prabhu@mail.afixiindia.com', 0),
(541, 10, '122.50.128.100', '2011-08-22 13:55:40', 'prabhu@mail.afixiindia.com', 0),
(542, 36, '198.94.221.87', '2011-08-22 15:16:59', 'muazs786@gmail.com', 0),
(543, 2, '75.36.203.175', '2011-08-22 17:53:56', 'jagannath@mail.afixiindia.com', 0),
(544, 1, '117.197.243.122', '2011-08-22 21:02:11', 'sabri@mail.afixiindia.com', 0),
(545, 34, '117.197.243.122', '2011-08-22 21:23:17', 'afixi.satya@gmail.com', 0),
(546, 10, '117.197.243.122', '2011-08-22 21:27:06', 'prabhu@mail.afixiindia.com', 0),
(547, 3, '117.197.243.122', '2011-08-22 21:27:31', 'tanmaya@mail.afixiindia.com', 0),
(548, 2, '117.197.243.122', '2011-08-22 21:57:09', 'jagannath@mail.afixiindia.com', 0),
(549, 3, '117.197.243.122', '2011-08-22 21:59:40', 'tanmaya@mail.afixiindia.com', 0),
(550, 1, '117.197.243.122', '2011-08-22 22:01:09', 'sabri@mail.afixiindia.com', 0),
(551, 3, '117.197.243.122', '2011-08-22 22:04:02', 'tanmaya@mail.afixiindia.com', 0),
(552, 2, '117.197.243.122', '2011-08-22 22:14:52', 'jagannath@mail.afixiindia.com', 0),
(553, 3, '117.197.243.122', '2011-08-22 22:19:42', 'tanmaya@mail.afixiindia.com', 0),
(554, 2, '117.197.243.122', '2011-08-22 22:28:36', 'jagannath@mail.afixiindia.com', 0),
(555, 3, '117.197.243.122', '2011-08-22 22:32:28', 'tanmaya@mail.afixiindia.com', 0),
(556, 4, '117.197.243.122', '2011-08-22 22:53:21', 'upendra@mail.afixiindia.com', 0),
(557, 2, '117.197.243.122', '2011-08-22 22:54:05', 'jagannath@mail.afixiindia.com', 0),
(558, 10, '117.197.253.54', '2011-08-22 23:33:13', 'prabhu@mail.afixiindia.com', 0),
(559, 3, '117.197.253.54', '2011-08-22 23:34:28', 'tanmaya@mail.afixiindia.com', 0),
(560, 34, '117.197.253.54', '2011-08-22 23:39:52', 'afixi.satya@gmail.com', 0),
(561, 34, '117.197.253.54', '2011-08-22 23:54:24', 'afixi.satya@gmail.com', 0),
(562, 4, '117.197.253.54', '2011-08-23 00:40:50', 'upendra@mail.afixiindia.com', 0),
(563, 34, '117.197.253.54', '2011-08-23 02:18:33', 'afixi.satya@gmail.com', 0),
(564, 10, '117.197.253.54', '2011-08-23 02:18:49', 'prabhu@mail.afixiindia.com', 0),
(565, 3, '117.197.253.54', '2011-08-23 02:19:29', 'tanmaya@mail.afixiindia.com', 0),
(566, 4, '117.197.253.54', '2011-08-23 03:00:30', 'upendra@mail.afixiindia.com', 0),
(567, 2, '117.197.253.54', '2011-08-23 04:01:38', 'jagannath@mail.afixiindia.com', 0),
(568, 34, '117.197.253.54', '2011-08-23 04:47:43', 'afixi.satya@gmail.com', 0),
(569, 1, '117.197.253.54', '2011-08-23 05:02:23', 'sabri@mail.afixiindia.com', 0),
(570, 1, '117.197.253.54', '2011-08-23 05:06:04', 'sabri@mail.afixiindia.com', 0),
(571, 2, '117.201.166.170', '2011-08-23 05:31:01', 'jagannath@mail.afixiindia.com', 0),
(572, 10, '117.201.166.170', '2011-08-23 05:33:02', 'prabhu@mail.afixiindia.com', 0),
(573, 34, '117.201.166.170', '2011-08-23 05:33:31', 'afixi.satya@gmail.com', 0),
(574, 3, '117.201.166.170', '2011-08-23 05:34:53', 'tanmaya@mail.afixiindia.com', 0),
(575, 4, '117.201.166.170', '2011-08-23 06:13:58', 'upendra@mail.afixiindia.com', 0),
(576, 2, '117.201.166.170', '2011-08-23 06:16:34', 'jagannath@mail.afixiindia.com', 0),
(577, 3, '117.201.166.170', '2011-08-23 06:22:31', 'tanmaya@mail.afixiindia.com', 0),
(578, 6, '117.201.166.170', '2011-08-23 06:44:48', 'jitendra@mail.afixiindia.com', 0),
(579, 36, '108.205.200.122', '2011-08-23 10:23:12', 'muazs786@gmail.com', 0),
(580, 2, '75.36.207.218', '2011-08-23 13:48:05', 'jagannath@mail.afixiindia.com', 0),
(581, 36, '108.205.200.122', '2011-08-23 17:05:31', 'muazs786@gmail.com', 0),
(582, 1, '75.36.207.218', '2011-08-23 18:20:45', 'sabri@mail.afixiindia.com', 0),
(583, 1, '75.36.207.218', '2011-08-23 18:22:04', 'sabri@mail.afixiindia.com', 0),
(584, 2, '75.36.207.218', '2011-08-23 18:22:35', 'jagannath@mail.afixiindia.com', 0),
(585, 10, '117.197.242.69', '2011-08-23 21:09:54', 'prabhu@mail.afixiindia.com', 0),
(586, 34, '117.201.160.173', '2011-08-23 21:27:01', 'afixi.satya@gmail.com', 0),
(587, 4, '117.201.160.173', '2011-08-23 21:27:51', 'upendra@mail.afixiindia.com', 0),
(588, 3, '117.201.160.173', '2011-08-23 21:32:39', 'tanmaya@mail.afixiindia.com', 0),
(589, 2, '117.201.160.173', '2011-08-23 21:35:59', 'jagannath@mail.afixiindia.com', 0),
(590, 6, '117.201.160.173', '2011-08-23 21:39:01', 'jitendra@mail.afixiindia.com', 0),
(591, 4, '117.201.160.173', '2011-08-23 21:42:48', 'upendra@mail.afixiindia.com', 0),
(592, 5, '117.201.160.173', '2011-08-23 21:46:24', 'biswa@mail.afixiindia.com', 0),
(593, 3, '117.201.160.173', '2011-08-23 21:48:37', 'tanmaya@mail.afixiindia.com', 0),
(594, 4, '117.201.160.173', '2011-08-23 21:49:44', 'upendra@mail.afixiindia.com', 0),
(595, 4, '117.201.160.173', '2011-08-23 22:32:27', 'upendra@mail.afixiindia.com', 0),
(596, 2, '117.201.160.173', '2011-08-23 22:33:21', 'jagannath@mail.afixiindia.com', 0),
(597, 3, '117.201.160.173', '2011-08-23 23:17:33', 'tanmaya@mail.afixiindia.com', 0),
(598, 3, '173.254.204.155', '2011-08-24 02:32:13', 'tanmaya@mail.afixiindia.com', 0),
(599, 3, '117.197.236.115', '2011-08-24 06:20:35', 'tanmaya@mail.afixiindia.com', 0),
(600, 10, '117.197.236.115', '2011-08-24 06:20:53', 'prabhu@mail.afixiindia.com', 0),
(601, 34, '117.197.236.115', '2011-08-24 06:21:36', 'afixi.satya@gmail.com', 0),
(602, 2, '117.197.236.115', '2011-08-24 06:39:54', 'jagannath@mail.afixiindia.com', 0),
(603, 2, '117.197.236.115', '2011-08-24 06:41:30', 'jagannath@mail.afixiindia.com', 0),
(604, 2, '204.28.119.130', '2011-08-24 13:13:02', 'jagannath@mail.afixiindia.com', 0),
(605, 35, '67.160.197.181', '2011-08-24 16:21:17', 'lol.i.laugh@gmail.com', 0),
(606, 3, '67.160.197.181', '2011-08-24 16:21:18', 'tanmaya@mail.afixiindia.com', 0),
(607, 2, '204.28.119.130', '2011-08-24 18:15:14', 'jagannath@mail.afixiindia.com', 0),
(608, 2, '204.28.119.130', '2011-08-24 18:51:52', 'jagannath@mail.afixiindia.com', 0),
(609, 35, '67.160.197.181', '2011-08-24 18:54:59', 'lol.i.laugh@gmail.com', 0),
(610, 1, '204.28.119.130', '2011-08-24 18:58:24', 'sabri@mail.afixiindia.com', 0);
INSERT INTO `memeje__login` (`id_login`, `id_user`, `ip`, `date_login`, `email`, `failure_attempt`) VALUES
(611, 32, '117.197.238.70', '2011-08-24 21:30:23', 'afixi.jagannath@gmail.com', 0),
(612, 10, '117.197.238.70', '2011-08-24 21:50:20', 'prabhu@mail.afixiindia.com', 0),
(613, 34, '117.197.238.70', '2011-08-24 21:50:51', 'afixi.satya@gmail.com', 0),
(614, 1, '204.28.119.130', '2011-08-24 22:44:42', 'sabri@mail.afixiindia.com', 0),
(615, 2, '117.197.238.70', '2011-08-25 00:12:58', 'jagannath@mail.afixiindia.com', 0),
(616, 1, '204.28.119.130', '2011-08-25 00:23:18', 'sabri@mail.afixiindia.com', 0),
(617, 32, '117.201.144.40', '2011-08-25 00:39:00', 'afixi.jagannath@gmail.com', 0),
(618, 10, '117.201.144.40', '2011-08-25 03:09:52', 'prabhu@mail.afixiindia.com', 0),
(619, 34, '117.201.144.40', '2011-08-25 03:10:44', 'afixi.satya@gmail.com', 0),
(620, 3, '117.201.144.40', '2011-08-25 03:15:02', 'tanmaya@mail.afixiindia.com', 0),
(621, 1, '117.201.153.145', '2011-08-25 05:55:51', 'sabri@mail.afixiindia.com', 0),
(622, 2, '117.197.237.8', '2011-08-25 07:34:19', 'jagannath@mail.afixiindia.com', 0),
(623, 23, '117.197.237.8', '2011-08-25 07:57:27', 'jagannath.behera104@gmail.com', 0),
(624, 2, '122.50.129.252', '2011-08-25 10:13:55', 'jagannath@mail.afixiindia.com', 0),
(625, 1, '136.152.179.136', '2011-08-25 12:59:22', 'sabri@mail.afixiindia.com', 0),
(626, 2, '136.152.138.47', '2011-08-25 14:11:49', 'jagannath@mail.afixiindia.com', 0),
(627, 35, '67.160.197.181', '2011-08-25 14:31:14', 'lol.i.laugh@gmail.com', 0),
(628, 3, '67.160.197.181', '2011-08-25 14:31:14', 'tanmaya@mail.afixiindia.com', 0),
(629, 2, '136.152.138.47', '2011-08-25 14:57:58', 'jagannath@mail.afixiindia.com', 0),
(630, 35, '67.160.197.181', '2011-08-25 15:01:07', 'lol.i.laugh@gmail.com', 0),
(631, 2, '204.28.119.130', '2011-08-25 18:04:38', 'jagannath@mail.afixiindia.com', 0),
(632, 35, '67.160.197.181', '2011-08-25 20:46:06', 'lol.i.laugh@gmail.com', 0),
(633, 3, '67.160.197.181', '2011-08-25 20:46:07', 'tanmaya@mail.afixiindia.com', 0),
(634, 4, '117.197.233.105', '2011-08-25 21:06:07', 'upendra@mail.afixiindia.com', 0),
(635, 3, '117.197.233.105', '2011-08-25 21:08:56', 'tanmaya@mail.afixiindia.com', 0),
(636, 10, '117.197.233.105', '2011-08-25 21:14:16', 'prabhu@mail.afixiindia.com', 0),
(637, 3, '117.197.233.105', '2011-08-25 21:14:40', 'tanmaya@mail.afixiindia.com', 0),
(638, 2, '117.197.233.105', '2011-08-25 21:18:40', 'jagannath@mail.afixiindia.com', 0),
(639, 10, '117.197.233.105', '2011-08-25 21:23:33', 'prabhu@mail.afixiindia.com', 0),
(640, 3, '117.197.233.105', '2011-08-25 21:24:28', 'tanmaya@mail.afixiindia.com', 0),
(641, 2, '117.197.233.105', '2011-08-25 21:30:26', 'jagannath@mail.afixiindia.com', 0),
(642, 32, '117.197.233.105', '2011-08-25 21:31:15', 'afixi.jagannath@gmail.com', 0),
(643, 2, '117.197.233.105', '2011-08-25 21:32:17', 'jagannath@mail.afixiindia.com', 0),
(644, 1, '117.197.233.105', '2011-08-25 21:33:20', 'sabri@mail.afixiindia.com', 0),
(645, 10, '117.197.233.105', '2011-08-25 21:33:51', 'prabhu@mail.afixiindia.com', 0),
(646, 3, '117.197.233.105', '2011-08-25 21:36:34', 'tanmaya@mail.afixiindia.com', 0),
(647, 1, '117.197.233.105', '2011-08-25 21:47:09', 'sabri@mail.afixiindia.com', 0),
(648, 4, '117.197.233.105', '2011-08-25 21:54:40', 'upendra@mail.afixiindia.com', 0),
(649, 10, '117.197.233.105', '2011-08-25 21:55:19', 'prabhu@mail.afixiindia.com', 0),
(650, 1, '117.197.233.105', '2011-08-25 23:31:55', 'sabri@mail.afixiindia.com', 0),
(651, 2, '75.36.207.218', '2011-08-26 00:37:23', 'jagannath@mail.afixiindia.com', 0),
(652, 2, '117.201.162.225', '2011-08-26 03:43:19', 'jagannath@mail.afixiindia.com', 0),
(653, 3, '117.201.162.225', '2011-08-26 04:14:38', 'tanmaya@mail.afixiindia.com', 0),
(654, 4, '117.201.162.225', '2011-08-26 04:17:13', 'upendra@mail.afixiindia.com', 0),
(655, 3, '117.201.162.225', '2011-08-26 04:40:33', 'tanmaya@mail.afixiindia.com', 0),
(656, 4, '117.201.162.225', '2011-08-26 05:35:21', 'upendra@mail.afixiindia.com', 0),
(657, 35, '67.160.197.181', '2011-08-26 16:16:09', 'lol.i.laugh@gmail.com', 0),
(658, 2, '75.36.207.218', '2011-08-26 18:03:54', 'jagannath@mail.afixiindia.com', 0),
(659, 35, '204.28.119.168', '2011-08-26 21:04:06', 'lol.i.laugh@gmail.com', 0),
(660, 2, '204.28.119.130', '2011-08-26 21:57:28', 'jagannath@mail.afixiindia.com', 0),
(661, 35, '204.28.119.168', '2011-08-27 14:39:41', 'lol.i.laugh@gmail.com', 0),
(662, 2, '122.50.138.45', '2011-08-27 21:56:00', 'jagannath@mail.afixiindia.com', 0),
(663, 32, '117.197.251.81', '2011-08-28 21:28:07', 'afixi.jagannath@gmail.com', 0),
(664, 35, '67.160.197.181', '2011-08-28 22:37:55', 'lol.i.laugh@gmail.com', 0),
(665, 2, '204.28.119.130', '2011-08-28 23:39:46', 'jagannath@mail.afixiindia.com', 0),
(666, 2, '122.50.131.32', '2011-08-29 08:40:15', 'jagannath@mail.afixiindia.com', 0),
(667, 35, '157.22.13.245', '2011-08-29 11:49:04', 'lol.i.laugh@gmail.com', 0),
(668, 3, '157.22.13.245', '2011-08-29 11:49:05', 'tanmaya@mail.afixiindia.com', 0),
(669, 34, '117.197.241.237', '2011-08-29 21:30:26', 'afixi.satya@gmail.com', 0),
(670, 3, '117.197.241.237', '2011-08-29 21:31:17', 'tanmaya@mail.afixiindia.com', 0),
(671, 34, '117.197.241.237', '2011-08-29 21:38:12', 'afixi.satya@gmail.com', 0),
(672, 3, '117.197.241.237', '2011-08-29 21:54:08', 'tanmaya@mail.afixiindia.com', 0),
(673, 34, '117.197.241.237', '2011-08-29 22:52:06', 'afixi.satya@gmail.com', 0),
(674, 3, '117.197.241.237', '2011-08-29 22:52:14', 'tanmaya@mail.afixiindia.com', 0),
(675, 10, '117.197.241.237', '2011-08-29 22:52:39', 'prabhu@mail.afixiindia.com', 0),
(676, 1, '117.197.241.237', '2011-08-29 22:55:32', 'sabri@mail.afixiindia.com', 0),
(677, 10, '117.197.241.237', '2011-08-30 03:01:26', 'prabhu@mail.afixiindia.com', 0),
(678, 34, '117.197.241.237', '2011-08-30 03:01:54', 'afixi.satya@gmail.com', 0),
(679, 3, '117.197.241.237', '2011-08-30 03:17:49', 'tanmaya@mail.afixiindia.com', 0),
(680, 4, '117.197.241.237', '2011-08-30 03:18:51', 'upendra@mail.afixiindia.com', 0),
(681, 3, '117.197.241.237', '2011-08-30 05:34:26', 'tanmaya@mail.afixiindia.com', 0),
(682, 3, '117.197.241.237', '2011-08-30 05:46:44', 'tanmaya@mail.afixiindia.com', 0),
(683, 10, '117.201.163.17', '2011-08-30 06:27:59', 'prabhu@mail.afixiindia.com', 0),
(684, 3, '117.201.163.17', '2011-08-30 06:28:32', 'tanmaya@mail.afixiindia.com', 0),
(685, 2, '122.50.135.203', '2011-08-30 08:53:48', 'jagannath@mail.afixiindia.com', 0),
(686, 4, '27.48.32.47', '2011-08-31 11:08:39', 'upendra@mail.afixiindia.com', 0),
(687, 2, '122.50.131.42', '2011-09-01 08:10:55', 'jagannath@mail.afixiindia.com', 0),
(688, 3, '204.28.119.192', '2011-09-01 23:35:57', 'tanmaya@mail.afixiindia.com', 0),
(689, 2, '75.37.47.110', '2011-09-01 23:43:50', 'jagannath@mail.afixiindia.com', 0),
(690, 36, '204.28.119.192', '2011-09-02 00:10:41', 'muazs786@gmail.com', 0),
(691, 3, '204.28.119.192', '2011-09-02 00:22:50', 'tanmaya@mail.afixiindia.com', 0),
(692, 35, '204.28.119.192', '2011-09-02 00:26:17', 'lol.i.laugh@gmail.com', 0),
(693, 10, '117.201.165.160', '2011-09-02 02:18:12', 'prabhu@mail.afixiindia.com', 0),
(694, 34, '117.201.165.160', '2011-09-02 02:18:59', 'afixi.satya@gmail.com', 0),
(695, 2, '117.201.165.160', '2011-09-02 02:19:43', 'jagannath@mail.afixiindia.com', 0),
(696, 3, '117.201.165.160', '2011-09-02 02:24:42', 'tanmaya@mail.afixiindia.com', 0),
(697, 2, '117.201.165.160', '2011-09-02 02:26:18', 'jagannath@mail.afixiindia.com', 0),
(698, 2, '117.201.165.160', '2011-09-02 02:47:57', 'jagannath@mail.afixiindia.com', 0),
(699, 1, '117.201.165.160', '2011-09-02 02:48:28', 'sabri@mail.afixiindia.com', 0),
(700, 3, '117.201.165.160', '2011-09-02 02:53:36', 'tanmaya@mail.afixiindia.com', 0),
(701, 2, '117.201.165.160', '2011-09-02 03:15:23', 'jagannath@mail.afixiindia.com', 0),
(702, 34, '117.201.165.160', '2011-09-02 03:19:12', 'afixi.satya@gmail.com', 0),
(703, 2, '117.201.165.160', '2011-09-02 03:50:21', 'jagannath@mail.afixiindia.com', 0),
(704, 30, '117.201.165.160', '2011-09-02 04:59:25', 'biswal805@gmail.com', 0),
(705, 10, '117.201.165.160', '2011-09-02 05:57:31', 'prabhu@mail.afixiindia.com', 0),
(706, 2, '117.201.165.160', '2011-09-02 08:03:45', 'jagannath@mail.afixiindia.com', 0),
(707, 4, '117.201.165.160', '2011-09-02 08:21:01', 'upendra@mail.afixiindia.com', 0),
(708, 3, '117.201.165.160', '2011-09-02 08:31:35', 'tanmaya@mail.afixiindia.com', 0),
(709, 3, '117.201.165.160', '2011-09-02 08:34:19', 'tanmaya@mail.afixiindia.com', 0),
(710, 2, '117.201.165.160', '2011-09-02 08:35:40', 'jagannath@mail.afixiindia.com', 0),
(711, 2, '75.37.47.110', '2011-09-02 12:27:12', 'jagannath@mail.afixiindia.com', 0),
(712, 2, '75.37.47.110', '2011-09-02 12:27:41', 'jagannath@mail.afixiindia.com', 0),
(713, 2, '75.37.47.110', '2011-09-02 12:27:59', 'jagannath@mail.afixiindia.com', 0),
(714, 1, '75.37.47.110', '2011-09-02 12:28:25', 'sabri@mail.afixiindia.com', 0),
(715, 2, '75.37.47.110', '2011-09-02 12:43:34', 'jagannath@mail.afixiindia.com', 0),
(716, 1, '75.37.47.110', '2011-09-02 12:44:07', 'sabri@mail.afixiindia.com', 0),
(717, 3, '75.37.47.110', '2011-09-02 12:51:31', 'tanmaya@mail.afixiindia.com', 0),
(718, 35, '204.28.119.192', '2011-09-02 13:26:25', 'lol.i.laugh@gmail.com', 0),
(719, 3, '67.160.197.181', '2011-09-02 19:56:39', 'tanmaya@mail.afixiindia.com', 0),
(720, 3, '67.160.197.181', '2011-09-02 19:56:39', 'tanmaya@mail.afixiindia.com', 0),
(721, 36, '108.205.200.122', '2011-09-02 20:30:02', 'muazs786@gmail.com', 0),
(722, 32, '117.197.245.209', '2011-09-02 20:34:44', 'afixi.jagannath@gmail.com', 0),
(723, 32, '117.197.245.209', '2011-09-02 20:48:46', 'afixi.jagannath@gmail.com', 0),
(724, 36, '108.205.200.122', '2011-09-02 21:02:38', 'muazs786@gmail.com', 0),
(725, 2, '117.197.245.209', '2011-09-02 21:42:28', 'jagannath@mail.afixiindia.com', 0),
(726, 32, '117.197.245.209', '2011-09-02 21:50:48', 'afixi.jagannath@gmail.com', 0),
(727, 34, '117.197.245.209', '2011-09-02 21:56:20', 'afixi.satya@gmail.com', 0),
(728, 10, '117.197.245.209', '2011-09-02 21:56:52', 'prabhu@mail.afixiindia.com', 0),
(729, 34, '117.197.245.209', '2011-09-02 22:01:17', 'afixi.satya@gmail.com', 0),
(730, 3, '117.197.245.209', '2011-09-02 22:09:33', 'tanmaya@mail.afixiindia.com', 0),
(731, 35, '67.160.197.181', '2011-09-02 22:38:06', 'lol.i.laugh@gmail.com', 0),
(732, 2, '117.197.245.209', '2011-09-02 22:38:49', 'jagannath@mail.afixiindia.com', 0),
(733, 2, '117.197.245.209', '2011-09-02 22:56:18', 'jagannath@mail.afixiindia.com', 0),
(734, 32, '117.197.245.209', '2011-09-02 22:58:37', 'afixi.jagannath@gmail.com', 0),
(735, 3, '117.197.245.209', '2011-09-02 23:06:58', 'tanmaya@mail.afixiindia.com', 0),
(736, 1, '117.197.245.209', '2011-09-02 23:18:01', 'sabri@mail.afixiindia.com', 0),
(737, 3, '75.37.47.110', '2011-09-02 23:28:23', 'tanmaya@mail.afixiindia.com', 0),
(738, 34, '117.197.245.209', '2011-09-02 23:44:09', 'afixi.satya@gmail.com', 0),
(739, 4, '117.197.245.209', '2011-09-02 23:54:42', 'upendra@mail.afixiindia.com', 0),
(740, 32, '117.197.245.209', '2011-09-03 00:11:16', 'afixi.jagannath@gmail.com', 0),
(741, 34, '117.201.148.167', '2011-09-03 00:22:15', 'afixi.satya@gmail.com', 0),
(742, 3, '117.201.148.167', '2011-09-03 00:33:27', 'tanmaya@mail.afixiindia.com', 0),
(743, 32, '117.201.148.167', '2011-09-03 00:39:36', 'afixi.jagannath@gmail.com', 0),
(744, 34, '117.201.148.167', '2011-09-03 00:43:12', 'afixi.satya@gmail.com', 0),
(745, 36, '108.205.200.122', '2011-09-03 01:08:59', 'muazs786@gmail.com', 0),
(746, 37, '117.201.148.167', '2011-09-03 01:22:46', 'manab.rout@afixi.com', 0),
(747, 3, '117.201.148.167', '2011-09-03 02:18:44', 'tanmaya@mail.afixiindia.com', 0),
(748, 2, '117.201.148.167', '2011-09-03 02:20:59', 'jagannath@mail.afixiindia.com', 0),
(749, 36, '108.205.200.122', '2011-09-03 02:28:12', 'muazs786@gmail.com', 0),
(750, 32, '117.201.148.167', '2011-09-03 02:40:07', 'afixi.jagannath@gmail.com', 0),
(751, 32, '117.201.148.167', '2011-09-03 02:54:12', 'afixi.jagannath@gmail.com', 0),
(752, 2, '75.37.47.110', '2011-09-03 03:39:26', 'jagannath@mail.afixiindia.com', 0),
(753, 2, '117.197.248.45', '2011-09-03 04:47:43', 'jagannath@mail.afixiindia.com', 0),
(754, 32, '117.197.248.45', '2011-09-03 04:48:58', 'afixi.jagannath@gmail.com', 0),
(755, 32, '117.197.248.45', '2011-09-03 04:50:55', 'afixi.jagannath@gmail.com', 0),
(756, 34, '117.197.248.45', '2011-09-03 04:53:49', 'afixi.satya@gmail.com', 0),
(757, 32, '117.197.248.45', '2011-09-03 05:34:48', 'afixi.jagannath@gmail.com', 0),
(758, 36, '108.205.200.122', '2011-09-03 05:44:14', 'muazs786@gmail.com', 0),
(759, 34, '117.197.248.45', '2011-09-03 06:00:09', 'afixi.satya@gmail.com', 0),
(760, 35, '67.160.197.181', '2011-09-03 11:32:52', 'lol.i.laugh@gmail.com', 0),
(761, 2, '75.37.47.110', '2011-09-03 12:37:21', 'jagannath@mail.afixiindia.com', 0),
(762, 36, '67.160.197.181', '2011-09-04 13:14:14', 'muazs786@gmail.com', 0),
(763, 35, '67.160.197.181', '2011-09-04 13:14:16', 'lol.i.laugh@gmail.com', 0),
(764, 2, '67.160.197.181', '2011-09-04 13:58:31', 'jagannath@mail.afixiindia.com', 0),
(765, 2, '75.37.47.110', '2011-09-04 20:55:49', 'jagannath@mail.afixiindia.com', 0),
(766, 32, '117.197.249.6', '2011-09-04 22:10:47', 'afixi.jagannath@gmail.com', 0),
(767, 2, '75.37.47.110', '2011-09-04 22:45:21', 'jagannath@mail.afixiindia.com', 0),
(768, 35, '67.160.197.181', '2011-09-04 22:46:55', 'lol.i.laugh@gmail.com', 0),
(769, 2, '117.197.249.6', '2011-09-04 22:54:26', 'jagannath@mail.afixiindia.com', 0),
(770, 34, '117.197.249.6', '2011-09-04 22:55:10', 'afixi.satya@gmail.com', 0),
(771, 3, '117.197.249.6', '2011-09-04 22:55:51', 'tanmaya@mail.afixiindia.com', 0),
(772, 1, '117.197.249.6', '2011-09-04 23:03:18', 'sabri@mail.afixiindia.com', 0),
(773, 1, '67.160.197.181', '2011-09-04 23:04:00', 'sabri@mail.afixiindia.com', 0),
(774, 1, '75.37.47.110', '2011-09-04 23:05:22', 'sabri@mail.afixiindia.com', 0),
(775, 1, '108.205.200.122', '2011-09-04 23:05:43', 'sabri@mail.afixiindia.com', 0),
(776, 1, '117.197.249.6', '2011-09-04 23:11:46', 'sabri@mail.afixiindia.com', 0),
(777, 34, '117.197.249.6', '2011-09-04 23:14:00', 'afixi.satya@gmail.com', 0),
(778, 1, '117.197.249.6', '2011-09-04 23:29:09', 'sabri@mail.afixiindia.com', 0),
(779, 1, '117.197.249.6', '2011-09-04 23:29:44', 'sabri@mail.afixiindia.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `memeje__meme`
--

DROP TABLE IF EXISTS `memeje__meme`;
CREATE TABLE IF NOT EXISTS `memeje__meme` (
  `id_meme` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `title` varchar(300) collate utf8_unicode_ci default NULL,
  `id_captions` text collate utf8_unicode_ci NOT NULL,
  `image` varchar(300) collate utf8_unicode_ci default NULL,
  `category` int(11) NOT NULL,
  `is_live` tinyint(4) NOT NULL default '1',
  `id_question` int(11) default NULL,
  `is_duel` int(11) NOT NULL default '0',
  `duel_won` int(11) default NULL,
  `tot_reply` int(11) NOT NULL default '0',
  `tot_caption` int(11) NOT NULL default '0',
  `tot_honour` int(11) NOT NULL default '0',
  `view_count` int(11) NOT NULL default '0',
  `honour_id_user` text collate utf8_unicode_ci NOT NULL,
  `tot_dishonour` int(11) NOT NULL default '0',
  `dishonour_id_user` text collate utf8_unicode_ci NOT NULL,
  `can_all_comment` tinyint(4) NOT NULL COMMENT '1 for all 0 for friends',
  `can_all_view` tinyint(4) NOT NULL COMMENT '1 for all 0 for friends',
  `tagged_user` text collate utf8_unicode_ci,
  `user_status` tinyint(2) NOT NULL default '1',
  `add_date` datetime NOT NULL,
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_meme`),
  KEY `category` (`category`),
  KEY `can_all_comment` (`can_all_comment`),
  KEY `can_all_view` (`can_all_view`),
  KEY `is_live` (`is_live`),
  KEY `id_question` (`id_question`),
  KEY `user_status` (`user_status`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

--
-- Dumping data for table `memeje__meme`
--

INSERT INTO `memeje__meme` (`id_meme`, `id_user`, `title`, `id_captions`, `image`, `category`, `is_live`, `id_question`, `is_duel`, `duel_won`, `tot_reply`, `tot_caption`, `tot_honour`, `view_count`, `honour_id_user`, `tot_dishonour`, `dishonour_id_user`, `can_all_comment`, `can_all_view`, `tagged_user`, `user_status`, `add_date`, `ip`) VALUES
(1, 2, 'Fap', '', '1_1313764443_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 3, 1, '1,2,3', 0, '', 0, 1, NULL, 1, '2011-08-19 07:34:38', '117.197.249.49'),
(2, 2, 'war', '', '2_1_33_ChallengeAccepted.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 0, NULL, 1, '2011-08-19 07:40:59', '117.197.249.49'),
(4, 2, 'Miss funny', '3', '4_6_38_GirlFapFap.png', 1, 1, NULL, 0, NULL, 0, 1, 1, 7, '3', 1, '35', 1, 1, NULL, 1, '2011-08-19 08:03:19', '117.197.249.49'),
(5, 34, 'Test----Chrome', '', '5_1313812751_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 1, '', 0, '', 1, 1, NULL, 1, '2011-08-19 21:00:48', '117.197.235.93'),
(7, 34, 'Testt-Chrome-1', '', '7_11_43_High.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 5, '2', 1, '35', 1, 1, NULL, 1, '2011-08-19 23:32:27', '117.197.244.133'),
(8, 1, 'Trees - Test 1', '', '8_17_49_FemaleRetarded.png', 3, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-19 23:33:14', '76.216.22.128'),
(9, 1, 'Trees - Test 1', '', '9_2_34_Determined.png', 3, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-19 23:34:08', '76.216.22.128'),
(10, 34, 'Testt-safari', '', '10_AX059102.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 6, '', 0, '', 1, 1, NULL, 1, '2011-08-20 00:09:12', '117.197.244.133'),
(11, 2, 'dfg', '', '11_1313824153_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 0, NULL, 1, '2011-08-20 00:10:45', '117.197.244.133'),
(12, 1, 'jagan test', '', '12_4_36_FapFap.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 0, NULL, 1, '2011-08-20 00:16:05', '117.197.244.133'),
(13, 1, 'sdfdsf', '', '13_6_38_GirlFapFap.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-20 00:18:28', '117.197.244.133'),
(14, 34, 'Test----Safari-1', '', '14_34_1313824743_uploaded.png', 2, 1, NULL, 0, NULL, 0, 0, 2, 14, '2,35', 0, '', 0, 1, NULL, 1, '2011-08-20 00:20:41', '117.197.244.133'),
(15, 1, 'vfvd', '', '15_5_37_Gay.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 1, NULL, 1, '2011-08-20 00:51:54', '117.197.244.133'),
(16, 1, 'gfddf', '', '16_2_34_Determined.png', 3, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 0, NULL, 1, '2011-08-20 00:55:01', '117.197.244.133'),
(17, 1, 'Test', '1,2', '17_1313826966_draw.png', 2, 1, NULL, 0, NULL, 0, 2, 2, 15, '2,4', 0, '', 1, 1, NULL, 1, '2011-08-20 00:56:34', '117.197.244.133'),
(18, 2, 'sdfs', '', '18_1313845416_draw.png', 3, 1, NULL, 0, NULL, 0, 0, 1, 7, '3', 1, '35', 1, 1, NULL, 1, '2011-08-20 06:03:50', '117.201.160.57'),
(19, 2, 'dsgs', '', '19_1313845931_draw.png', 2, 0, 7, 0, NULL, 0, 0, 2, 11, '10,34', 0, '', 0, 0, NULL, 1, '2011-08-20 06:12:30', '117.201.160.57'),
(20, 34, 'Testing answer to question', '13,14,20,21', '20_34_1313846540_uploaded.png', 1, 0, 7, 0, NULL, 0, 4, 2, 7, '10,3', 1, '34', 1, 1, NULL, 1, '2011-08-20 06:36:49', '117.201.160.57'),
(21, 3, 'TESTIN QUESTION TO ANSWER----OPERA', '19,22', '21_testimonial6.png', 3, 0, 7, 0, NULL, 0, 2, 2, 6, '10,34', 0, '', 1, 1, NULL, 1, '2011-08-20 06:42:48', '117.201.160.57'),
(22, 2, 'ddshs', '', '22_3_35_NotBad.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 0, NULL, 1, '2011-08-20 07:02:06', '117.201.160.57'),
(23, 4, 'fdssd', '', '23_5_37_Gay.png', 2, 0, 7, 0, NULL, 0, 0, 0, 1, '', 2, '34,10', 0, 0, NULL, 1, '2011-08-20 07:08:31', '117.201.160.57'),
(24, 3, 'hiiiiiiii', '4,5', '24_6_38_GirlFapFap.png', 4, 1, NULL, 0, NULL, 1, 2, 1, 0, '3', 0, '', 1, 1, NULL, 1, '2011-08-20 07:21:21', '117.201.160.57'),
(25, 4, 'Hi sunny', '', '25_4_1313850416_uploaded.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 1, '', 0, '', 1, 0, NULL, 1, '2011-08-20 07:27:37', '117.201.160.57'),
(26, 4, 'Vodafone vs Memeje', '6,7', '26_4_1313850593_uploaded.png', 1, 1, NULL, 0, NULL, 0, 2, 1, 0, '4', 1, '36', 1, 1, NULL, 1, '2011-08-20 07:31:11', '117.201.160.57'),
(27, 1, 'My scooter', '', '27_1_1313852451_uploaded.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 0, NULL, 1, '2011-08-20 08:02:52', '117.201.160.57'),
(28, 35, 'baby gangser', '', '28_26_58_BabyTroll.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 1, '', 0, '', 1, 1, NULL, 1, '2011-08-20 17:43:27', '198.94.221.87'),
(29, 35, 'Obama ruins us economy', '8,9,10', '29_1_33_ChallengeAccepted.png', 2, 1, NULL, 0, NULL, 0, 3, 0, 5, '', 0, '', 1, 1, NULL, 1, '2011-08-20 17:44:09', '198.94.221.87'),
(30, 35, 'my response', '', '30_4_36_FapFap.png', 2, 0, 7, 0, NULL, 0, 0, 1, 2, '10', 0, '', 1, 1, NULL, 1, '2011-08-20 18:25:37', '108.205.200.122'),
(31, 36, 'NOT GOOD', '11', '31_9_41_SonMeGusta.png', 1, 1, NULL, 0, NULL, 2, 1, 2, 2, '36,35', 0, '', 1, 1, NULL, 1, '2011-08-20 18:50:38', '108.205.200.122'),
(32, 2, 'Trees - Test 3', '', '32_2_34_Determined.png', 3, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, NULL, 1, '2011-08-20 23:12:14', '76.230.233.90'),
(33, 36, 'stuff', '', '33_2_34_Determined.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 1, '36', 0, '', 1, 1, NULL, 1, '2011-08-21 02:41:13', '108.205.200.122'),
(34, 36, 'stonerbama', '12', '34_3_35_NotBad.png', 2, 1, NULL, 0, NULL, 0, 1, 0, 1, '', 0, '', 1, 1, NULL, 1, '2011-08-21 02:42:17', '108.205.200.122'),
(35, 34, 'Test--22nd', '', '35_1313987451_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, NULL, 1, '2011-08-21 21:32:55', '117.197.233.113'),
(36, 1, 'Hello test', '27,28', '36_4_36_FapFap.png', 1, 1, NULL, 0, NULL, 0, 2, 2, 11, '2,3', 0, '', 1, 1, NULL, 1, '2011-08-21 21:44:44', '117.197.233.113'),
(37, 2, 'Parwesh11', '', '37_1313997082_draw.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, NULL, 1, '2011-08-22 00:12:10', '117.197.233.113'),
(38, 34, 'Test--22nd--1', '34', '38_34_1314000327_uploaded.png', 2, 1, NULL, 0, NULL, 0, 1, 1, 3, '3', 0, '', 1, 1, NULL, 1, '2011-08-22 01:06:40', '117.197.233.113'),
(39, 2, 'Miss lina', '', '39_6_38_GirlFapFap.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 0, '3', 1, '2011-08-22 21:58:42', '117.197.243.122'),
(40, 2, 'JTest', '', '40_3_35_NotBad.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 3, '', 0, '', 1, 1, '3,4,24', 1, '2011-08-22 22:31:31', '117.197.243.122'),
(41, 34, 'Test day', '17,18', '41_1314083539_draw.png', 1, 1, NULL, 0, NULL, 0, 2, 1, 2, '34', 0, '', 1, 1, '3', 1, '2011-08-23 00:14:07', '117.197.253.54'),
(42, 34, 'Test day 1', '15,16', '42_1314084631_draw.png', 2, 1, NULL, 0, NULL, 3, 2, 0, 4, '', 0, '', 1, 1, NULL, 1, '2011-08-23 00:31:34', '117.197.253.54'),
(43, 34, 'Testing Tag-1', '29,30,31', '43_5_37_Gay.png', 3, 1, NULL, 0, NULL, 0, 3, 2, 5, '10,34', 1, '3', 1, 1, '3', 1, '2011-08-23 06:18:55', '117.201.166.170'),
(44, 3, 'Test-Tag-2', '23,24,25,26', '44_1314105695_draw.png', 4, 1, NULL, 0, NULL, 0, 4, 1, 0, '3', 0, '', 1, 1, '34', 1, '2011-08-23 06:26:13', '117.201.166.170'),
(45, 2, 'Tag Test (Friends Only)', '', '45_1314149023_draw.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 0, 0, '1', 1, '2011-08-23 18:24:57', '75.36.207.218'),
(46, 2, 'dgss', '', '46_1314194127_draw.png', 3, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 0, '4', 1, '2011-08-24 06:57:02', '117.197.239.207'),
(47, 2, 'Yao Ming Tag!', '', '47_12_44_Laughing.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, '1,35', 1, '2011-08-24 18:56:26', '204.28.119.130'),
(48, 35, 'lol', '', '48_6_38_GirlFapFap.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 3, '', 0, '', 1, 1, '2', 1, '2011-08-24 18:56:27', '67.160.197.181'),
(49, 35, 'test', '', '49_5_37_Gay.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, '2', 1, '2011-08-24 19:00:01', '67.160.197.181'),
(50, 1, 'Tag - Laugh', '', '50_19_51_Hehehe.png', 1, 1, NULL, 0, NULL, 0, 0, 2, 6, '1,2', 0, '', 0, 0, '2', 1, '2011-08-25 00:24:32', '204.28.119.130'),
(51, 32, 'Jaga test', '', '51_3_35_NotBad.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-25 00:39:58', '117.201.144.40'),
(52, 32, 'Jaga test', '', '52_3_35_NotBad.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-25 00:40:59', '117.201.144.40'),
(53, 32, 'Budhun m', '', '53_2_34_Determined.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-25 00:41:53', '117.201.144.40'),
(54, 32, 'asfsd', '', '54_1_33_ChallengeAccepted.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-25 00:44:12', '117.201.144.40'),
(55, 32, 'FD', '', '55_1314259053_draw.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 0, '35', 0, '', 1, 1, NULL, 1, '2011-08-25 00:58:06', '117.201.144.40'),
(56, 32, 'sda', '', '56_3_35_NotBad.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 6, '35', 0, '', 1, 1, NULL, 1, '2011-08-25 01:00:40', '117.201.144.40'),
(57, 23, 'Obama', '', '57_3_35_NotBad.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 0, NULL, 1, '2011-08-25 07:58:24', '117.197.237.8'),
(58, 3, 'huhu', '', '58_1314308530_draw.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 7, '3', 0, '', 1, 1, '4,34', 1, '2011-08-25 14:42:45', '67.160.197.181'),
(59, 2, 'Laila n majnu', '', '59_6_38_GirlFapFap.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-26 04:14:35', '117.201.162.225'),
(62, 2, 'Watermark Test', '', '62_21_53_Smile.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-26 18:08:12', '75.36.207.218'),
(63, 2, 'asdf', '', '63_1_33_ChallengeAccepted.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-08-26 18:11:00', '75.36.207.218'),
(64, 2, 'All/All', '', '64_2_34_Determined.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 7, '', 0, '', 1, 1, NULL, 1, '2011-08-26 18:38:46', '75.36.207.218'),
(65, 2, 'All/Friends', '', '65_2_1314409196_uploaded.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 1, NULL, 1, '2011-08-26 18:40:20', '75.36.207.218'),
(66, 2, 'Friends/All', '', '66_8_40_MeGustaCreepy.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 4, '', 0, '', 1, 0, NULL, 1, '2011-08-26 18:41:59', '75.36.207.218'),
(67, 2, 'Friends/Friends', '', '67_28_60_Melvin.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 4, '', 1, '35', 0, 0, NULL, 1, '2011-08-26 18:47:35', '75.36.207.218'),
(68, 35, 'dododo', '', '68_30_62_Troll.png', 2, 1, NULL, 0, NULL, 0, 0, 2, 40, '35,3', 0, '', 1, 1, NULL, 1, '2011-08-26 21:05:12', '204.28.119.168'),
(69, 35, 'lol', '', '69_2_34_Determined.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 5, '35', 0, '', 1, 1, NULL, 1, '2011-08-27 14:41:21', '204.28.119.168'),
(80, 3, 'Testing Duel-------1', '', '80_1314711114_draw.png', 1, 1, 0, 1, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, '10', 1, '0000-00-00 00:00:00', '117.201.163.17'),
(81, 10, 'Testing Duel------2', '', '81_1314711100_draw.png', 2, 1, 0, 1, 1, 0, 0, 2, 0, '3,10', 0, '', 1, 1, '3', 1, '0000-00-00 00:00:00', '117.201.163.17'),
(82, 3, 'notifications', '', '82_4_36_FapFap.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 2, '3', 0, '', 1, 1, '4', 1, '2011-09-02 00:25:06', '204.28.119.192'),
(83, 35, 'Haha duplicates', '', '83_23_55_SoMuchWin.png', 1, 1, 0, 1, NULL, 0, 0, 0, 1, '', 1, '35', 1, 1, '36', 1, '0000-00-00 00:00:00', '204.28.119.192'),
(84, 36, 'not good', '', '84_9_41_SonMeGusta.png', 1, 1, 0, 1, NULL, 0, 0, 2, 15, '36,35', 0, '', 1, 1, '35', 1, '0000-00-00 00:00:00', '204.28.119.192'),
(85, 34, 'Salma', '', '85_5_37_Gay.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, '3', 1, '2011-09-02 03:22:08', '117.201.165.160'),
(86, 30, 'test for fb', '', '86_Afixi_23.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 1, '', 0, '', 1, 0, NULL, 1, '2011-09-02 05:01:45', '117.201.165.160'),
(87, 30, 'test second', '35', '87_5_37_Gay.png', 3, 1, NULL, 0, NULL, 0, 1, 0, 2, '', 0, '', 1, 1, NULL, 1, '2011-09-02 05:04:18', '117.201.165.160'),
(88, 30, 'testing again', '', '88_Afixi_29.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 8, '', 0, '', 1, 1, NULL, 1, '2011-09-02 05:48:04', '117.201.165.160'),
(89, 30, 'test', '', '89_1314971684_draw.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 1, 1, NULL, 1, '2011-09-02 06:55:25', '117.201.165.160'),
(90, 30, 'hello', '32,33', '90_3_35_NotBad.png', 2, 1, NULL, 0, NULL, 3, 2, 1, 38, '30', 0, '', 1, 1, NULL, 1, '2011-09-02 07:00:53', '117.201.165.160'),
(91, 2, 'aa', '', '91_3_35_NotBad.png', 1, 1, NULL, 0, NULL, 1, 0, 1, 3, '36', 0, '', 1, 1, NULL, 1, '2011-09-02 08:05:29', '117.201.165.160'),
(92, 4, 'aaa', '', '92_4_36_FapFap.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 0, NULL, 1, '2011-09-02 08:31:17', '117.201.165.160'),
(93, 3, 'bbb', '', '93_3_35_NotBad.png', 1, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 0, NULL, 1, '2011-09-02 08:33:26', '117.201.165.160'),
(94, 3, 'ccc', '', '94_5_37_Gay.png', 2, 1, NULL, 0, NULL, 0, 0, 1, 2, '35', 0, '', 0, 0, NULL, 1, '2011-09-02 08:35:21', '117.201.165.160'),
(95, 34, 'Testing flag', '', '95_6_38_GirlFapFap.png', 4, 1, NULL, 0, NULL, 0, 0, 0, 2, '', 0, '', 0, 1, NULL, 1, '2011-09-02 22:57:03', '117.197.245.209'),
(96, 34, 'Testing who comments', '', '96_4_36_FapFap.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 0, 1, NULL, 1, '2011-09-02 23:33:51', '117.197.245.209'),
(97, 3, 'tryu', '', '97_3_35_NotBad.png', 2, 1, NULL, 0, NULL, 1, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-09-02 23:38:37', '117.197.245.209'),
(98, 3, 'Testing who comments---1', '', '98_6_38_GirlFapFap.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 0, '', 0, '', 1, 1, NULL, 1, '2011-09-02 23:47:27', '117.197.245.209'),
(99, 34, 'Tweet', '', '99_1315032810_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 1, 3, '34', 0, '', 1, 1, NULL, 1, '2011-09-02 23:54:21', '117.197.245.209'),
(100, 3, 'testing by me', '', '100_6_38_GirlFapFap.png', 2, 1, NULL, 0, NULL, 0, 0, 0, 1, '', 0, '', 1, 1, NULL, 1, '2011-09-02 23:56:42', '117.197.245.209'),
(101, 3, 'hello', '', '101_1315034339_draw.png', 2, 1, NULL, 0, NULL, 2, 0, 0, 1, '', 2, '36,35', 1, 1, NULL, 1, '2011-09-03 00:19:30', '117.201.148.167'),
(102, 34, 'Friends who comment', '', '102_1315041815_draw.png', 3, 1, NULL, 0, NULL, 0, 0, 3, 4, '2,36,35', 0, '', 0, 1, NULL, 1, '2011-09-03 02:25:10', '117.201.148.167'),
(103, 34, 'Testing who comments--Funny', '', '103_1315042692_draw.png', 1, 1, NULL, 0, NULL, 0, 0, 1, 0, '35', 0, '', 0, 1, NULL, 1, '2011-09-03 02:39:08', '117.201.148.167'),
(104, 2, 'Friends/Friends 2', '', '104_1_33_ChallengeAccepted.png', 4, 1, NULL, 0, NULL, 1, 0, 1, 5, '35', 1, '2', 0, 0, NULL, 1, '2011-09-03 13:22:37', '75.37.47.110'),
(105, 34, 'Testing Random Generator', '', '105_1315203260_draw.png', 2, 1, NULL, 0, NULL, 0, 0, 1, 0, '3', 0, '', 0, 1, '32,3', 1, '2011-09-04 23:15:46', '117.197.249.6');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__notification`
--

DROP TABLE IF EXISTS `memeje__notification`;
CREATE TABLE IF NOT EXISTS `memeje__notification` (
  `id_notification` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL COMMENT 'if notification_type=4 then it''s id_badge otherwise id_user',
  `notified_user` int(11) NOT NULL,
  `notification_type` int(11) NOT NULL,
  `id_meme` int(11) default NULL,
  `is_read` int(11) NOT NULL default '0',
  `is_removed` int(11) NOT NULL COMMENT '1 if removed by user otherwise 0',
  `add_date` datetime NOT NULL,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_notification`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=128 ;

--
-- Dumping data for table `memeje__notification`
--

INSERT INTO `memeje__notification` (`id_notification`, `id_user`, `notified_user`, `notification_type`, `id_meme`, `is_read`, `is_removed`, `add_date`, `ip`) VALUES
(1, 2, 23, 5, NULL, 1, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(2, 2, 32, 5, NULL, 1, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(3, 2, 33, 5, NULL, 0, 0, '2011-08-22 22:58:12', '117.197.243.122'),
(7, 3, 34, 5, NULL, 1, 1, '2011-08-22 23:01:15', '117.197.243.122'),
(8, 34, 3, 5, NULL, 1, 1, '2011-08-22 23:03:39', '117.197.243.122'),
(9, 3, 34, 5, NULL, 1, 1, '2011-08-22 23:04:25', '117.197.243.122'),
(10, 3, 10, 5, NULL, 1, 1, '2011-08-22 23:37:20', '117.197.253.54'),
(11, 10, 3, 5, NULL, 1, 1, '2011-08-22 23:37:58', '117.197.253.54'),
(12, 34, 3, 5, NULL, 1, 1, '2011-08-22 23:40:51', '117.197.253.54'),
(13, 10, 3, 5, NULL, 1, 1, '2011-08-22 23:41:01', '117.197.253.54'),
(14, 10, 34, 5, NULL, 1, 1, '2011-08-22 23:43:20', '117.197.253.54'),
(15, 3, 34, 5, NULL, 1, 1, '2011-08-22 23:43:38', '117.197.253.54'),
(17, 34, 10, 5, NULL, 1, 1, '2011-08-22 23:49:02', '117.197.253.54'),
(18, 10, 34, 5, NULL, 1, 1, '2011-08-22 23:50:01', '117.197.253.54'),
(19, 34, 10, 5, NULL, 1, 1, '2011-08-22 23:50:36', '117.197.253.54'),
(35, 1, 2, 5, NULL, 1, 1, '2011-08-23 18:21:39', '75.36.207.218'),
(38, 4, 2, 5, NULL, 1, 1, '2011-08-23 21:31:40', '117.201.160.173'),
(39, 4, 3, 5, NULL, 1, 1, '2011-08-23 21:31:40', '117.201.160.173'),
(40, 4, 5, 5, NULL, 1, 1, '2011-08-23 21:31:41', '117.201.160.173'),
(42, 4, 8, 5, NULL, 0, 0, '2011-08-23 21:31:41', '117.201.160.173'),
(52, 3, 10, 5, NULL, 1, 1, '2011-08-23 23:21:07', '117.201.160.173'),
(54, 2, 35, 5, NULL, 1, 1, '2011-08-24 18:53:15', '204.28.119.130'),
(55, 35, 2, 1, NULL, 1, 0, '2011-08-24 18:55:20', ''),
(63, 3, 36, 5, NULL, 1, 0, '2011-08-25 14:51:33', '67.160.197.181'),
(65, 3, 10, 5, NULL, 1, 1, '2011-08-25 21:49:30', '117.197.233.105'),
(66, 10, 3, 1, NULL, 1, 1, '2011-08-25 21:49:50', ''),
(74, 35, 3, 5, NULL, 1, 1, '2011-08-27 15:05:29', '204.28.119.168'),
(75, 35, 4, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(76, 35, 5, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(77, 35, 6, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(78, 35, 8, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(79, 35, 9, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(80, 35, 10, 5, NULL, 1, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(81, 35, 13, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(82, 35, 15, 5, NULL, 0, 0, '2011-08-27 15:05:29', '204.28.119.168'),
(83, 35, 36, 5, NULL, 1, 1, '2011-08-27 15:05:29', '204.28.119.168'),
(88, 3, 34, 6, NULL, 1, 0, '2011-08-29 23:08:23', '117.197.241.237'),
(91, 10, 34, 6, NULL, 1, 0, '2011-08-30 03:06:39', '117.197.241.237'),
(108, 10, 34, 6, 3, 1, 0, '2011-08-30 05:31:55', '117.197.241.237'),
(109, 34, 10, 6, 4, 1, 0, '2011-08-30 05:33:45', '117.197.241.237'),
(114, 3, 10, 6, 7, 0, 0, '2011-08-30 06:33:10', '117.201.163.17'),
(115, 10, 3, 6, 8, 1, 0, '2011-08-30 06:34:13', '117.201.163.17'),
(116, 3, 35, 1, NULL, 1, 0, '2011-09-02 00:24:20', ''),
(117, 36, 35, 1, NULL, 1, 0, '2011-09-02 00:25:00', ''),
(118, 3, 4, 6, 82, 0, 0, '2011-09-02 00:25:07', '204.28.119.192'),
(120, 35, 36, 3, NULL, 1, 0, '2011-09-02 00:26:27', ''),
(121, 35, 36, 6, 9, 1, 0, '2011-09-02 00:27:29', '204.28.119.192'),
(122, 36, 35, 6, 10, 1, 0, '2011-09-02 00:28:10', '204.28.119.192'),
(123, 34, 3, 6, 85, 1, 0, '2011-09-02 03:22:08', '117.201.165.160'),
(124, 32, 34, 5, NULL, 1, 1, '2011-09-03 02:54:46', '117.201.148.167'),
(125, 34, 32, 1, NULL, 1, 0, '2011-09-03 02:55:02', ''),
(126, 34, 32, 6, 105, 0, 0, '2011-09-04 23:15:47', '117.197.249.6'),
(127, 34, 3, 6, 105, 0, 0, '2011-09-04 23:15:47', '117.197.249.6');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__premade_images`
--

DROP TABLE IF EXISTS `memeje__premade_images`;
CREATE TABLE IF NOT EXISTS `memeje__premade_images` (
  `id_premade_image` int(11) NOT NULL auto_increment,
  `id_category` int(11) NOT NULL,
  `image` varchar(200) collate utf8_unicode_ci NOT NULL,
  `img_name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `add_date` datetime NOT NULL,
  `ip` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_premade_image`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `memeje__premade_images`
--

INSERT INTO `memeje__premade_images` (`id_premade_image`, `id_category`, `image`, `img_name`, `add_date`, `ip`) VALUES
(1, 1, '33_ChallengeAccepted.png', '1_33_ChallengeAccepted.png', '2011-07-16 07:23:49', '117.201.162.188'),
(2, 1, '34_Determined.png', '2_34_Determined.png', '2011-07-16 07:23:53', '117.201.162.188'),
(3, 1, '35_NotBad.png', '3_35_NotBad.png', '2011-07-16 07:23:57', '117.201.162.188'),
(4, 1, '36_FapFap.png', '4_36_FapFap.png', '2011-07-16 07:24:00', '117.201.162.188'),
(5, 1, '37_Gay.png', '5_37_Gay.png', '2011-07-16 07:24:09', '117.201.162.188'),
(6, 1, '38_GirlFapFap.png', '6_38_GirlFapFap.png', '2011-07-16 07:24:15', '117.201.162.188'),
(7, 2, '39_MeGusta.png', '7_39_MeGusta.png', '2011-07-16 07:25:01', '117.201.162.188'),
(8, 2, '40_MeGustaCreepy.png', '8_40_MeGustaCreepy.png', '2011-07-16 07:25:04', '117.201.162.188'),
(9, 2, '41_SonMeGusta.png', '9_41_SonMeGusta.png', '2011-07-16 07:25:07', '117.201.162.188'),
(10, 2, '42_AwwYeah.png', '10_42_AwwYeah.png', '2011-07-16 07:25:11', '117.201.162.188'),
(11, 2, '43_High.png', '11_43_High.png', '2011-07-16 07:25:14', '117.201.162.188'),
(12, 2, '44_Laughing.png', '12_44_Laughing.png', '2011-07-16 07:25:25', '117.201.162.188'),
(13, 2, '45_LOL.png', '13_45_LOL.png', '2011-07-16 07:25:31', '117.201.162.188'),
(14, 3, '46_EWBTE.png', '14_46_EWBTE.png', '2011-07-16 07:27:46', '117.201.162.188'),
(15, 3, '47_EWBTE2.png', '15_47_EWBTE2.png', '2011-07-16 07:27:49', '117.201.162.188'),
(16, 3, '48_FemaleHappy.png', '16_48_FemaleHappy.png', '2011-07-16 07:27:53', '117.201.162.188'),
(17, 3, '49_FemaleRetarded.png', '17_49_FemaleRetarded.png', '2011-07-16 07:27:56', '117.201.162.188'),
(18, 3, '50_Happy.png', '18_50_Happy.png', '2011-07-16 07:28:01', '117.201.162.188'),
(19, 3, '51_Hehehe.png', '19_51_Hehehe.png', '2011-07-16 07:28:04', '117.201.162.188'),
(20, 3, '52_messageTroll.png', '20_52_messageTroll.png', '2011-07-16 07:28:10', '117.201.162.188'),
(21, 3, '53_Smile.png', '21_53_Smile.png', '2011-07-16 07:28:16', '117.201.162.188'),
(22, 3, '54_Smile2.png', '22_54_Smile2.png', '2011-07-16 07:28:18', '117.201.162.188'),
(23, 3, '55_SoMuchWin.png', '23_55_SoMuchWin.png', '2011-07-16 07:28:26', '117.201.162.188'),
(24, 3, '56_Stoned.png', '24_56_Stoned.png', '2011-07-16 07:28:31', '117.201.162.188'),
(25, 3, '57_AsianTroll.png', '25_57_AsianTroll.png', '2011-07-16 07:28:35', '117.201.162.188'),
(26, 4, '58_BabyTroll.png', '26_58_BabyTroll.png', '2011-07-16 07:29:36', '117.201.162.188'),
(27, 4, '59_ExcitedTroll.png', '27_59_ExcitedTroll.png', '2011-07-16 07:29:39', '117.201.162.188'),
(28, 4, '60_Melvin.png', '28_60_Melvin.png', '2011-07-16 07:29:42', '117.201.162.188'),
(29, 4, '61_messageTroll.png', '29_61_messageTroll.png', '2011-07-16 07:29:44', '117.201.162.188'),
(30, 4, '62_Troll.png', '30_62_Troll.png', '2011-07-16 07:29:46', '117.201.162.188'),
(31, 2, '41.jpg', '31_41.jpg', '2011-08-18 06:29:32', '117.197.253.132'),
(32, 2, '22145rkh8kbcl11.jpg', '32_22145rkh8kbcl11.jpg', '2011-08-18 06:29:53', '117.197.253.132');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__question`
--

DROP TABLE IF EXISTS `memeje__question`;
CREATE TABLE IF NOT EXISTS `memeje__question` (
  `id_question` int(11) NOT NULL auto_increment,
  `won_user` text collate utf8_unicode_ci NOT NULL COMMENT 'All users who have got more like in their answer',
  `title` varchar(50) collate utf8_unicode_ci NOT NULL,
  `question` text collate utf8_unicode_ci NOT NULL,
  `image` varchar(200) collate utf8_unicode_ci default NULL,
  `img_name` varchar(200) collate utf8_unicode_ci default NULL,
  `is_set` tinyint(4) NOT NULL,
  `start_date` datetime default NULL,
  `end_date` datetime default NULL,
  `add_date` datetime NOT NULL,
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_question`),
  KEY `is_set` (`is_set`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `memeje__question`
--

INSERT INTO `memeje__question` (`id_question`, `won_user`, `title`, `question`, `image`, `img_name`, `is_set`, `start_date`, `end_date`, `add_date`, `ip`) VALUES
(1, '', 'Daily life', 'What is the benefit of having Girlfriend in the same college or same school?', 'Afixi_6.jpg', '1_Afixi_6.jpg', 0, '2011-07-13 00:00:00', '2011-07-18 00:00:00', '2011-07-16 07:34:23', '117.201.162.188'),
(2, '', 'Daily morning', 'Name two things u can never eat before breakfast?', 'Afixi_11.jpg', '2_Afixi_11.jpg', 0, '2011-07-19 00:00:00', '2011-07-22 00:00:00', '2011-07-16 07:37:09', '117.201.162.188'),
(3, '', 'Funny', 'What does computer likes to eat?', 'Afixi_6.jpg', '3_Afixi_6.jpg', 0, '2011-08-01 00:00:00', '2011-08-08 00:00:00', '2011-07-16 07:56:05', '117.201.162.188'),
(4, '', 'Testing', 'This is for Testing purpose', '6Formula.JPEG', '4_6Formula.JPEG', 0, '2011-08-17 00:00:00', '2011-08-18 00:00:00', '2011-08-18 22:04:55', '117.197.232.204'),
(6, '', 'Testing', 'Testing question module.', 'Afixi_1.jpg', '6_Afixi_1.jpg', 0, '1996-08-01 00:00:00', '1996-08-01 00:00:00', '2011-08-18 22:23:14', '117.197.232.204'),
(7, '', 'Testing Add Question', 'How is the question?', '2_1266900725.JPG', '7_2_1266900725.JPG', 0, '2011-08-19 00:00:00', '2011-08-25 00:00:00', '2011-08-19 02:10:09', '117.197.235.93');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__reply`
--

DROP TABLE IF EXISTS `memeje__reply`;
CREATE TABLE IF NOT EXISTS `memeje__reply` (
  `id_reply` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `id_meme` int(11) NOT NULL,
  `reply` text collate utf8_unicode_ci NOT NULL,
  `is_live` int(1) NOT NULL,
  `user_status` tinyint(2) NOT NULL default '1',
  `add_date` datetime NOT NULL,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_reply`),
  KEY `id_user` (`id_user`),
  KEY `user_status` (`user_status`),
  KEY `id_meme` (`id_meme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `memeje__reply`
--

INSERT INTO `memeje__reply` (`id_reply`, `id_user`, `id_meme`, `reply`, `is_live`, `user_status`, `add_date`, `ip`) VALUES
(1, 3, 24, 'hiiiiii', 0, 1, '2011-08-20 07:21:48', '117.201.160.57'),
(2, 36, 31, 'awesome', 0, 1, '2011-08-20 19:08:17', '108.205.200.122'),
(3, 35, 31, 'i like this', 0, 1, '2011-08-20 19:12:06', '108.205.200.122'),
(4, 2, 42, 'hibak  kafas', 0, 1, '2011-08-23 02:32:20', '117.197.253.54'),
(5, 2, 42, 'jadsdasjvj asdsa', 0, 1, '2011-08-23 02:32:57', '117.197.253.54'),
(6, 2, 42, 'twerewewtw dfgs', 0, 1, '2011-08-23 02:33:16', '117.197.253.54'),
(7, 30, 90, 'hello', 0, 1, '2011-09-02 07:37:55', '117.201.165.160'),
(8, 30, 90, 'hi', 0, 1, '2011-09-02 07:38:23', '117.201.165.160'),
(9, 30, 90, 'gg', 0, 1, '2011-09-02 07:40:01', '117.201.165.160'),
(10, 4, 91, 'czxcz', 0, 1, '2011-09-02 08:26:57', '117.201.165.160'),
(11, 37, 101, 'abe', 0, 1, '2011-09-03 01:24:31', '117.201.148.167'),
(12, 32, 101, 'o', 0, 1, '2011-09-03 02:19:51', '117.201.148.167'),
(13, 32, 97, '12', 0, 1, '2011-09-03 02:20:40', '117.201.148.167'),
(14, 35, 104, 'hi', 0, 1, '2011-09-04 13:17:10', '67.160.197.181');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__suggestion`
--

DROP TABLE IF EXISTS `memeje__suggestion`;
CREATE TABLE IF NOT EXISTS `memeje__suggestion` (
  `id_suggestion` int(11) NOT NULL auto_increment,
  `id_feature` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `suggestion` text collate utf8_unicode_ci NOT NULL,
  `add_date` datetime NOT NULL,
  `ip` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_suggestion`),
  KEY `id_feature` (`id_feature`,`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `memeje__suggestion`
--

INSERT INTO `memeje__suggestion` (`id_suggestion`, `id_feature`, `id_user`, `suggestion`, `add_date`, `ip`) VALUES
(1, 1, 34, 'This for testing', '2011-08-18 21:54:36', '117.197.232.204'),
(2, 3, 34, 'This for testing', '2011-08-18 21:56:36', '117.197.232.204'),
(3, 2, 34, 'This for testing Share or not share:', '2011-08-18 21:57:19', '117.197.232.204'),
(4, 4, 34, 'This for testing "Testing memeje"', '2011-08-18 22:00:01', '117.197.232.204'),
(5, 1, 24, 'fgfgdfgdfgdfg', '2011-08-18 23:00:21', '117.197.232.204'),
(6, 2, 35, 'hi', '2011-08-27 15:11:19', '204.28.119.168'),
(7, 2, 35, 'hi', '2011-08-27 15:11:25', '204.28.119.168'),
(8, 3, 35, 'hi', '2011-08-27 15:11:31', '204.28.119.168'),
(9, 4, 35, 'hi', '2011-08-27 15:11:37', '204.28.119.168'),
(10, 1, 34, 'Hello for testing', '2011-09-02 02:22:28', '117.201.165.160'),
(11, 3, 2, 'sdfds', '2011-09-02 08:04:04', '117.201.165.160'),
(12, 2, 35, 'asdfsdf', '2011-09-02 13:26:58', '204.28.119.192'),
(13, 2, 35, 'asdfsdf', '2011-09-02 13:27:00', '204.28.119.192');

-- --------------------------------------------------------

--
-- Table structure for table `memeje__user`
--

DROP TABLE IF EXISTS `memeje__user`;
CREATE TABLE IF NOT EXISTS `memeje__user` (
  `id_user` int(11) NOT NULL auto_increment,
  `uid` varchar(50) collate utf8_unicode_ci NOT NULL,
  `name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `fb_pic_big` text collate utf8_unicode_ci NOT NULL,
  `fb_pic_square` text collate utf8_unicode_ci NOT NULL,
  `fname` varchar(50) collate utf8_unicode_ci NOT NULL,
  `mname` varchar(50) collate utf8_unicode_ci default NULL,
  `lname` varchar(50) collate utf8_unicode_ci default NULL,
  `email` varchar(50) collate utf8_unicode_ci NOT NULL,
  `password` varchar(50) collate utf8_unicode_ci default NULL,
  `id_admin` tinyint(4) NOT NULL,
  `gender` varchar(20) collate utf8_unicode_ci default NULL,
  `dob` date default NULL,
  `avatar` varchar(100) collate utf8_unicode_ci default NULL,
  `address` text collate utf8_unicode_ci,
  `ques_week_won` int(11) NOT NULL default '0',
  `duels_won` int(11) default '0' COMMENT 'Number of duels own.',
  `exp_point` bigint(20) NOT NULL default '0',
  `no_badges` int(11) NOT NULL default '0',
  `id_badges` text collate utf8_unicode_ci,
  `login_status` tinyint(4) NOT NULL,
  `no_of_logs` int(11) NOT NULL COMMENT 'no of times login',
  `last_login` datetime NOT NULL,
  `update_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `login_time` int(11) NOT NULL default '0',
  `random_num` varchar(100) collate utf8_unicode_ci default NULL,
  `flag` tinyint(4) NOT NULL,
  `user_status` tinyint(2) NOT NULL default '1',
  `id_friends` text collate utf8_unicode_ci,
  `invited_to` text collate utf8_unicode_ci NOT NULL,
  `memeje_friends` text collate utf8_unicode_ci,
  `toc` tinyint(4) NOT NULL default '0',
  `add_date` datetime NOT NULL,
  `ip` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_user`),
  KEY `id_fb` (`uid`,`fname`,`lname`,`email`,`id_admin`,`gender`,`login_status`),
  KEY `flag` (`flag`),
  KEY `duels_won` (`duels_won`),
  KEY `ques_week_won` (`ques_week_won`),
  KEY `no_of_logs` (`no_of_logs`),
  KEY `user_status` (`user_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `memeje__user`
--

INSERT INTO `memeje__user` (`id_user`, `uid`, `name`, `fb_pic_big`, `fb_pic_square`, `fname`, `mname`, `lname`, `email`, `password`, `id_admin`, `gender`, `dob`, `avatar`, `address`, `ques_week_won`, `duels_won`, `exp_point`, `no_badges`, `id_badges`, `login_status`, `no_of_logs`, `last_login`, `update_login`, `login_time`, `random_num`, `flag`, `user_status`, `id_friends`, `invited_to`, `memeje_friends`, `toc`, `add_date`, `ip`) VALUES
(1, '0', '', '', '', 'Parwesh', NULL, 'Sabri', 'sabri@mail.afixiindia.com', 'p455w0rd', 1, 'M', '1999-06-08', '1_Afixi_11.jpg', NULL, 0, 0, 191, 9, '1', 0, 135, '2011-07-04 18:38:25', '2011-07-04 18:38:25', 0, '0', 1, 1, NULL, '', '2', 1, '2011-06-03 10:45:30', '192.168.1.172'),
(2, '0', '', '', '', 'jagannath', NULL, 'das', 'jagannath@mail.afixiindia.com', 'jjjjjj', 0, 'M', '1988-03-08', '2_Afixi_56.jpg', NULL, 0, 0, 719, 44, '1,2,5', 0, 186, '2011-07-01 16:49:19', '2011-09-05 00:32:35', 4326580, '0', 1, 1, NULL, '100001998663937', '1,4,35', 1, '2011-06-03 00:00:00', '192.168.1.152'),
(3, '0', '', '', '', 'Tanmaya1', NULL, 'Biswal1', 'tanmaya@mail.afixiindia.com', 'tttttt', 0, 'M', '1984-06-12', '3_Afixi_19.jpg', NULL, 0, 0, 233, 9, '1,2', 0, 75, '2011-07-02 10:39:40', '2011-09-05 00:32:34', 4332564, '0', 1, 1, NULL, '', '34,4,10,35', 1, '2011-06-03 13:10:28', '192.168.1.117'),
(4, '0', '', '', '', 'upendra', NULL, 'mohanty', 'upendra@mail.afixiindia.com', 'uuuuuu', 0, 'M', '1986-06-15', '4_AwwYeah.png', NULL, 0, 0, 170, 4, '30,1', 0, 72, '0000-00-00 00:00:00', '2011-09-03 00:38:39', 4203210, '0', 1, 1, NULL, '', '3,2,5', 1, '0000-00-00 00:00:00', ''),
(5, '0', '', '', '', 'biswa', NULL, 'sethi', 'biswa@mail.afixiindia.com', 'bbbbbb', 0, 'M', NULL, '5_Afixi_95.jpg', NULL, 0, 0, 110, 0, NULL, 0, 21, '0000-00-00 00:00:00', '2011-08-23 21:48:14', 3330850, '0', 1, 1, '', '', '4', 1, '2011-06-18 11:28:38', '192.168.1.102'),
(6, '0', '', '', '', 'jitendra', NULL, 'ganthia', 'jitendra@mail.afixiindia.com', 'jjjjjj', 0, 'M', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, 2, '0000-00-00 00:00:00', '2011-08-23 21:42:28', 53795, '0', 1, 1, NULL, '', '', 1, '2011-06-18 11:30:37', ''),
(8, '0', '', '', '', 'arun', NULL, 'bahal', 'arun@mail.afixiindia.com', 'aaaaaa', 0, 'M', NULL, '8_Afixi_97.jpg', NULL, 0, 0, 0, 0, NULL, 0, 6, '2011-07-04 12:58:25', '2011-08-22 02:15:47', 3909856, '0', 1, 1, NULL, '', '', 1, '2011-06-14 11:30:37', ''),
(9, '0', '', '', '', 'sunil', NULL, 'kund', 'sunil@mail.afixiindia.com', 'sunil1', 0, 'M', NULL, NULL, NULL, 0, 2, 80, 0, NULL, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, NULL, 0, 1, NULL, '', '', 0, '0000-00-00 00:00:00', ''),
(10, '0', '', '', '', 'prabhudas', NULL, 'behera', 'prabhu@mail.afixiindia.com', 'pppppp', 0, 'F', NULL, '10_Afixi_31.jpg', NULL, 0, 0, 53, 0, NULL, 0, 23, '2011-07-01 16:01:41', '2011-09-02 22:00:49', 5251617, '0', 1, 1, NULL, '', '34,3', 1, '0000-00-00 00:00:00', ''),
(13, '0', '', '', '', 'sasmita', NULL, 'test', 'abc@mail.afixi.com', 'aaaaaa', 0, 'F', '2011-06-09', NULL, NULL, 0, 0, 0, 0, NULL, 0, 0, '2011-06-28 19:07:38', '0000-00-00 00:00:00', 0, NULL, 1, 1, NULL, '', '', 0, '0000-00-00 00:00:00', ''),
(15, '0', '', '', '', 'sasmita', NULL, 'nayak', 'sasmita@mail.afixiindia.com', 'sasmita', 0, 'F', NULL, NULL, NULL, 0, 0, 40, 0, NULL, 0, 10, '0000-00-00 00:00:00', '2011-07-26 04:59:55', 708469, '0', 1, 1, NULL, '', '', 1, '0000-00-00 00:00:00', ''),
(22, '100001446343747', 'Suryakanta Das', '', '', 'Suryakanta', NULL, 'Das', 'afixi.suryakanta@gmail.com', '76833', 0, 'M', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, 4, '0000-00-00 00:00:00', '2011-07-08 17:34:55', 3936, '0', 1, 1, '507133377,530622141,551669792,867010392,1003925137,1142223201,1264224935,1408418201,1570944230,1583047333,1619642862,1733561600,1769818682,1828036643,100000161128627,100000315094310,100000480065272,100000512297270,100000531370678,100000536581618,100000537974030,100000581874927,100000604432861,100000915508944,100000920507839,100000922024239,100000922698258,100000982826781,100000997546280,100000998291381,100001081442187,100001100307427,100001110672752,100001133203177,100001159115544,100001232541408,100001302473511,100001350826269,100001421572079,100001464824239,100001503582853,100001512554389,100001616530522,100001742965429,100001764383594,100001771058615,100001772045330,100001808616396,100001860408543,100001875633369,100001876660907,100001901250759,100001910353516,100002102326666,100002237802534,100002605110171', '', '', 1, '2011-07-08 16:29:13', '192.168.1.152'),
(23, '1126785811', 'Jagannath Behera', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/49134_1126785811_9225_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/49134_1126785811_9225_q.jpg', 'Jagannath', NULL, 'Behera', 'jagannath.behera104@gmail.com', '80446', 0, 'M', NULL, NULL, NULL, 0, 0, 10, 0, NULL, 0, 6, '0000-00-00 00:00:00', '2011-08-25 08:16:17', 3876348, '0', 1, 1, '507133377,541815706,565698211,568206892,569307477,623359389,691220853,716822438,1003926960,1006326792,1034133950,1035284186,1065183866,1079335950,1145396328,1230452951,1236106182,1243665464,1258262659,1264224935,1278005644,1283808242,1290503861,1294743391,1296978994,1317250491,1389161051,1413920893,1418182581,1420069222,1428742117,1445528594,1475997438,1496572590,1505599615,1506796700,1579073624,1583047333,1621373377,1635541964,1649543390,1678531217,1683278002,1718541700,1728894583,1733561600,1750195934,1765269713,1769818682,1772844765,1828954875,1838169796,100000032982879,100000064790526,100000091553914,100000093930174,100000122386609,100000157896157,100000161128627,100000194863142,100000246680050,100000261332992,100000315094310,100000320517423,100000323454347,100000325795577,100000338637594,100000350138533,100000404398998,100000420353418,100000441417712,100000444486084,100000447155196,100000489769484,100000501173934,100000511457777,100000565953128,100000566901535,100000614503122,100000826453856,100000838030600,100000857012181,100000916463731,100000922024239,100000939061607,100000967398338,100000979768139,100001003424270,100001037325282,100001041202090,100001062571650,100001081442187,100001085513916,100001110672752,100001153423456,100001158522804,100001166670969,100001206048184,100001262421366,100001371118393,100001372310494,100001376557806,100001405181486,100001415613495,100001421572079,100001428632482,100001444117222,100001472119768,100001496936700,100001501723146,100001503582853,100001508401270,100001516312697,100001525436407,100001556329022,100001574700252,100001616530522,100001639947137,100001726395012,100001764383594,100001792832278,100001837005316,100001860408543,100001875633369,100001950714470,100001951342251,100001955572269,100002013432308,100002073064908,100002146258445,100002201437096,100002218271134,100002237802534,100002311818211,100002372354721,100002406166424,100002454313326,100002521670339,100002545375437', '', '', 1, '2011-07-09 12:33:37', '192.168.1.152'),
(24, '100001998663937', 'Upendra Mohanty', 'http://profile.ak.fbcdn.net/static-ak/rsrc.php/v1/yL/r/HsTZSDw4avx.gif', 'http://profile.ak.fbcdn.net/static-ak/rsrc.php/v1/yo/r/UlIqmHJn-SK.gif', 'Upendra', NULL, 'Mohanty', 'afixi.upendra@gmail.com', '29964', 0, 'M', NULL, NULL, NULL, 0, 0, 70, 0, NULL, 0, 21, '0000-00-00 00:00:00', '2011-08-19 02:13:47', 3222931, '0', 1, 1, '100000536581618,100001133203177,100001742965429', '100001133203177', '', 1, '2011-07-12 18:25:16', '192.168.1.105'),
(30, '100001742965429', 'Tanmaya Biswal', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/70763_100001742965429_1207790_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/70525_100001742965429_3501927_q.jpg', 'Tanmaya', NULL, 'Biswal', 'biswal805@gmail.com', '60320', 0, 'M', NULL, NULL, NULL, 0, 0, 191, 7, '1', 0, 14, '0000-00-00 00:00:00', '2011-09-02 07:54:43', 3978816, '0', 1, 1, '507133377,530622141,705116171,725831900,867010392,1122005603,1136967788,1264224935,1278240396,1283808242,1294743391,1343838580,1385176822,1458225240,1458944237,1460113988,1500872061,1608647370,1619642862,1654757075,1667297440,1673590640,1682140759,1704177310,1728414672,1733561600,1735460270,1774623946,1775373968,1807450480,100000004620702,100000009552525,100000115669048,100000143197035,100000161128627,100000246680050,100000264562886,100000315094310,100000320240318,100000351226326,100000407762958,100000413858057,100000438849629,100000473043489,100000498223308,100000510133136,100000523758965,100000536581618,100000668894258,100000692406585,100000743272264,100000781562631,100000822585284,100000858762860,100000893107049,100000915508944,100000922024239,100000976823111,100000982826781,100000998291381,100001081442187,100001102472268,100001110672752,100001122633460,100001127643807,100001133203177,100001145365771,100001202014742,100001246420971,100001275017689,100001275526970,100001276368693,100001284709258,100001309263785,100001350826269,100001423033461,100001446343747,100001456427680,100001467596643,100001478572958,100001498500871,100001538046980,100001570189065,100001604228310,100001611399857,100001616530522,100001669494715,100001705414839,100001707693970,100001709830312,100001764383594,100001771058615,100001772045330,100001805692522,100001844610657,100001875633369,100001876660907,100001906971102,100001910353516,100001912359250,100001998663937,100002094378771,100002197951269,100002237802534,100002314085074,100002323905484,100002389122052,100002509402680,100002580651919,100002650717963', '', '', 1, '2011-07-18 06:34:17', '117.197.242.21'),
(31, '100000642790261', 'Sas Mita', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/174004_100000642790261_3866929_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/173341_100000642790261_5200245_q.jpg', 'Sas', NULL, 'Mita', 'afixi.sasmita@gmail.com', '61156', 0, 'F', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, 4, '0000-00-00 00:00:00', '2011-07-20 02:41:02', 156966, '0', 1, 1, '1142223201,1408418201,1505599615,1619642862,100000512297270,100000531370678,100000536581618,100000604432861,100000921678158,100001081442187,100001302473511', '', '', 1, '2011-07-18 06:53:46', '117.197.242.21'),
(32, '100001133203177', 'Jagannath Behera', 'http://profile.ak.fbcdn.net/static-ak/rsrc.php/v1/yL/r/HsTZSDw4avx.gif', 'http://profile.ak.fbcdn.net/static-ak/rsrc.php/v1/yo/r/UlIqmHJn-SK.gif', 'Jagannath', NULL, 'Behera', 'afixi.jagannath@gmail.com', '56909', 0, 'M', NULL, NULL, 'Bhubaneswar,Orissa,India', 0, 0, 215, 8, '1,2', 0, 31, '0000-00-00 00:00:00', '2011-09-04 23:11:27', 4145946, '0', 1, 1, '507133377,867010392,1264224935,1396336174,1619642862,1733561600,100000064790526,100000315094310,100000512297270,100000536581618,100000915508944,100000922024239,100000982826781,100000998291381,100001003424270,100001050741636,100001077214733,100001081442187,100001153423456,100001159115544,100001302473511,100001421572079,100001446343747,100001472119768,100001616530522,100001742965429,100001764383594,100001875633369,100001910353516,100001998663937,100002127308840,100002600373707', '', '34', 1, '2011-07-18 23:03:02', '117.197.242.21'),
(33, '1733561600', 'Manas Ranjan Sahoo', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/276103_1733561600_2821584_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/276103_1733561600_2821584_q.jpg', 'Manas', 'Ranjan', 'Sahoo', 'manassahoo66@gmail.com', '24730', 0, 'M', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, 2, '0000-00-00 00:00:00', '2011-07-19 21:59:00', 72797, '0', 1, 1, '507133377,660455718,1003925137,1090208658,1126785811,1142223201,1143677367,1155740762,1162361939,1193707580,1218087593,1226827633,1230452951,1257626590,1289653772,1294743391,1324731360,1367357943,1408418201,1488684914,1489707635,1583047333,1595212606,1603236290,1619642862,1629098917,1710832347,1769818682,1770357999,1791182997,1828644067,1835881426,1848242904,100000001983853,100000012093777,100000014587689,100000016747560,100000026020998,100000116531352,100000163717370,100000214253083,100000230992382,100000311570911,100000315094310,100000315394991,100000367400166,100000390968292,100000466853184,100000469299416,100000521521673,100000529727032,100000536581618,100000537974030,100000539070417,100000542390155,100000572591334,100000578012578,100000579831049,100000589772697,100000626461639,100000728504973,100000756484268,100000791720394,100000796063342,100000855431880,100000864702476,100000892989952,100000915508944,100000917670012,100000920507839,100000922024239,100000922698258,100000982826781,100000998291381,100001006204619,100001032258469,100001072110922,100001081442187,100001094015952,100001103182652,100001110672752,100001133203177,100001137186216,100001145811491,100001147419681,100001232541408,100001245422031,100001255779105,100001302473511,100001314775759,100001357865355,100001373964108,100001441271310,100001446343747,100001460166672,100001464824239,100001467471051,100001478572958,100001480602866,100001484200903,100001502905697,100001503582853,100001546362003,100001556989835,100001616530522,100001625936811,100001742965429,100001764383594,100001771058615,100001772045330,100001798334919,100001801088870,100001808616396,100001810926277,100001841008705,100001875633369,100001876660907,100001901250759,100001910353516,100001936374405,100001957924550,100002068936900,100002127671967,100002135381572,100002166777607,100002237802534,100002278954324,100002358413196,100002444843992,100002571540466,100002600373707,100002650717963', '', '', 1, '2011-07-19 01:45:21', '117.197.246.58'),
(34, '100000982826781', 'Satya Singh', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/23112_100000982826781_7395_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/27423_100000982826781_3734_q.jpg', 'Satya', NULL, 'Singh', 'afixi.satya@gmail.com', '63576', 0, 'M', NULL, '34_2.jpg', NULL, 0, 0, 567, 37, '1,2,5', 0, 130, '0000-00-00 00:00:00', '2011-09-05 00:32:35', 3448799, '0', 1, 1, '530622141,867010392,1003925137,1142223201,1264224935,1294743391,1570944230,1583047333,1619642862,1733561600,100000315094310,100000480065272,100000512297270,100000531370678,100000536581618,100000537974030,100000581874927,100000604432861,100000915508944,100000920507839,100000921678158,100000922024239,100000922698258,100000998291381,100001081442187,100001110672752,100001133203177,100001153423456,100001159115544,100001232541408,100001302473511,100001357111730,100001403210505,100001421572079,100001446343747,100001616530522,100001742965429,100001764383594,100001771058615,100001805692522,100001815700472,100001876660907,100001910353516,100001940613950', '100001616530522', '3,10,32', 1, '2011-07-27 00:13:36', '117.201.160.101'),
(35, '641286114', 'Delos Faith Chang', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/202922_641286114_6458289_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/202922_641286114_6458289_q.jpg', 'Delos', 'Faith', 'Chang', 'lol.i.laugh@gmail.com', '45387', 0, 'M', NULL, '35_neutral_truestory.png', NULL, 0, 0, 139, 3, '1', 0, 21, '0000-00-00 00:00:00', '2011-09-04 23:18:20', 3373386, '0', 1, 1, '1210794,2344595,3325693,3326091,6421032,43907949,500108689,500571416,500677183,500677196,500741172,500769042,500798869,500846571,501218633,501288743,501304937,501332310,501334389,501346679,501380300,501467289,501693379,501786928,501978450,502045144,502379708,502470266,502558106,503108021,503109235,503136638,503318090,503451432,503460504,503530231,503547066,503626053,503702105,503778884,503794653,503806255,503814579,503884247,503912947,503965618,504058116,504089825,504092580,504102286,504146738,504150210,504183810,504390934,504392586,504991653,504995058,505082387,505091148,505298638,505340622,505368775,505377869,505543544,506275818,506315895,506353598,506366987,506465408,506705990,506710648,506786498,506788892,506806075,506924771,507004217,507274150,507321111,507397086,507493860,507688178,507756470,507775283,507800257,507857722,507868978,507917340,508011458,508037588,508044161,508063184,508155581,508171040,508216353,508219261,508270991,508330469,508446500,508645165,508862780,509037813,509226808,509389605,509617497,509737095,509770181,509956748,510431944,510516666,510884076,510946537,511042197,511048206,511072717,511214405,511537311,512010854,512064380,512199780,512451884,513278168,513991055,514436444,514596961,514935929,516011401,516452867,516669329,516835907,516885724,517406509,517717898,518307082,518483903,519833723,519942471,520275602,520406697,520456416,520467667,520472017,520542607,521064119,521171014,521295465,521636907,521782151,522983945,523127065,523392116,523393064,523985806,524335015,524913457,524935931,524960868,525136847,525782929,526225218,526414907,526415876,526634740,526990459,527472080,528040881,528138012,528375875,528627274,528971649,529539425,529743103,529858353,530270206,530540138,531096567,531358751,531446314,531570297,532500758,535322188,536395497,536446901,537063682,537432129,537462097,537636867,537981998,538075212,538911261,539080537,539655910,539675643,539731207,539835715,540129505,540175482,540326818,540832914,541221941,541259857,541329657,541597010,541862572,542079164,542166762,542988471,543116487,543622740,543726096,544216245,544707049,545236826,545485729,545526905,545921755,546033375,546295538,547247655,547520892,547625010,547866671,547950756,548194492,549460778,549618546,549673437,550189669,550579342,550953040,551532929,551594399,551706070,551911505,552386935,553020873,553117577,553306693,553386201,553482439,553614304,553860038,555660570,557403945,557406828,557774663,559664992,559725961,560240635,560493058,560585849,560762268,561051884,561077007,561310032,561325449,561426135,561470319,561571744,561982106,562210210,562215125,562232238,562431130,562534866,563142960,563508297,563551358,564296473,564379482,564385091,565051781,565538586,566146150,567104911,567286931,567462571,567934244,568070207,568786400,568900918,569584824,569701299,569756358,570006024,570061265,570140198,571066847,571374656,571813792,573730620,574018828,574474788,574482017,574639522,574751978,574782096,575276564,576036239,576120299,576290212,576898232,577476316,577531110,577882138,578493593,578583114,579338114,579401982,579415038,579881084,579966928,580056942,580345752,580406462,580794304,583078244,583180686,583422424,583720876,584270499,584547876,584955595,585035940,585798941,586295851,586320408,586597773,587606969,587630201,587808230,587847888,587894202,588211737,588238828,588593162,588917866,589088344,589194342,589232952,589320151,590051316,590422494,590476153,590625571,590636482,591180830,591427004,592541163,592691025,592834765,593308265,593712622,593839191,594170629,594502929,595678085,596064149,596415693,596477759,596620062,596745186,597172018,597657154,597821975,598333553,598953968,598971568,599718184,599796227,600324552,600777048,600887781,601070232,601152734,602045948,603147533,603459438,604342604,604445241,604497781,604704744,604889068,605906106,605989950,606514832,606815247,606996094,607102742,607666012,608163277,608340800,608785949,608940335,608986250,609120402,609443708,609464815,609698472,610969467,611122703,612116001,612491149,613062446,613361645,613556017,613613202,614100650,615432540,615984658,616280904,616287748,616463154,616486500,616955239,617201172,617351566,617522324,617882893,618001044,618791270,619043074,619215972,619977802,620589814,622174047,622510059,623105475,623170528,623641137,623970872,624126144,624179066,624565873,624731179,625212223,625271935,625336893,625676885,626022535,626374521,627582266,627876385,628801000,629130621,629331538,629368868,629436419,630605041,630797813,630840929,631205405,631476191,631575313,631648722,631840305,631855291,632079553,632528832,632766398,633127731,633295139,633625054,633780064,634643240,635207243,635939883,636376573,636457597,636605844,636856153,637274186,637443593,637586347,637848205,637850939,639166404,639414438,639571980,639802048,640365729,640586847,640793370,640842529,640963816,641403241,641728412,641975254,642103994,642300327,642430915,642506042,642736007,642837733,642842895,643205425,643337285,643444497,643548985,643568199,643887482,644025837,644077668,644293914,644801947,645336666,645420839,645719911,646136316,646510946,646682061,646990764,647886254,647891829,649966319,650131207,650267526,650415859,650448172,650666480,651396478,651645449,652150607,652510472,653587832,653611992,653630830,654255034,654259502,656226386,656250057,656282634,656365482,656812570,656960164,656997823,657151248,658161647,658538852,658626875,658720346,658816678,659045241,659696393,659935672,660048676,660517924,660716205,660799851,661667734,661695053,662553134,662611644,662724047,663035347,663116997,663191061,663481213,663817188,664086966,664250530,664792027,665132223,665568862,665943623,666288961,667360168,668026943,668127753,668372353,668407098,668547124,668583411,668640385,668798596,668996235,669395788,669499326,670146973,670245467,670386277,670600599,670662334,671750691,672080468,672134065,672831392,673512078,673906681,674095604,674605054,675301612,675320577,675428855,675479713,675987126,676676038,676911402,677805387,677921014,677993693,678258318,678686815,678968277,679704407,679803311,680115391,680295304,680296487,680320351,680613377,680755541,680875607,681270192,681662615,681865566,681880104,681960514,681983139,682170300,682209141,682255623,682390151,682405178,682840063,682904697,683022624,683135592,683156216,683192833,683370190,683536413,683900023,684015573,684155706,684162600,684870669,685775340,685932342,686537616,686772906,687020587,687065010,687422745,688670353,688832666,689186923,689295346,689440790,689556698,689847208,690200939,690767129,691220383,691237370,691398804,692151853,692212745,692272385,692957108,693030112,693442232,693461835,693512076,694681650,694864383,694923486,695231330,695408893,695606466,696169601,697044357,697565483,697639142,697755345,697762586,698085244,698100612,698706281,699306197,699409244,700755262,702079012,703270281,703501953,704881259,705730696,705766033,705832734,706191994,707178593,707508383,709073321,709076788,709806675,710545319,710622273,711275645,711352385,711656998,711736912,712917872,713634176,714172059,714238320,714516178,714605517,714957594,715071586,715278861,715543145,715600042,715652232,715670766,715992876,716262492,716448592,716561696,716584451,716740374,717151802,717568867,717585789,717640337,718570342,719611912,719746894,720045007,720320848,721021405,721679799,722026655,722303976,722369691,723100992,723165117,723396875,723712740,723916883,724672831,724677343,724797562,724930670,725190519,725261712,726387763,726465963,727022923,727522155,727586102,727788303,728296932,729559225,729689950,729965044,730067180,730696178,731010262,731761582,732171430,732675012,734365305,734708966,735070990,736243914,738408804,739099387,739675081,740552455,741593686,741701494,742129740,742541972,746315104,746569605,747842603,748170297,749275995,750268601,750704611,750903872,751018509,751938924,752570544,754585596,755121453,755970244,756165716,756316386,756475374,756915205,758028277,760719336,762093454,763340541,764340219,765154103,767006994,767052831,767085108,767590704,767714993,768118453,769317199,769671529,769975056,770180074,771088076,771549744,772829557,773738141,774206467,775233707,776225460,776804889,778475299,779160251,779330243,779700033,780993008,781991631,782560138,784965401,788655595,791592505,791859748,794444568,794825506,795460073,795730523,795760642,796187924,805775496,805800404,806439501,811500242,813495077,813700426,815375157,815733278,817447421,819951505,821250337,821822500,822325159,822563775,825639242,829017597,829506101,833235596,833420323,833980533,834129055,835440230,842555610,843849213,844445163,844475433,844659340,846490270,848155290,848770223,850495095,855084083,856210091,856250482,867195460,867710120,869930544,881725522,883200462,883695150,887690141,890405211,894300061,899055362,904315636,1004229275,1005413730,1005510331,1005557186,1009892061,1010761532,1011857219,1012361985,1013393232,1013430695,1013730218,1014858331,1014884676,1015080080,1018530280,1019949312,1020877867,1021891788,1022395990,1023051207,1023495769,1023795610,1027797107,1029428025,1032125097,1032900484,1035408926,1035732127,1036380075,1036380103,1036380230,1036380235,1036380312,1036380321,1036380442,1036380445,1036380477,1036380566,1036380573,1036380604,1036380626,1036380630,1036380673,1036380754,1036380760,1036380761,1036380766,1036380776,1036380777,1036380778,1036380779,1036380790,1036380791,1036380792,1036380793,1036380795,1036380799,1036380800,1036380801,1036380807,1036380809,1036380813,1036380818,1036380829,1036380839,1036380840,1036380843,1036380846,1036380849,1036380853,1036380854,1036380857,1036380858,1036380863,1036380865,1036380884,1036380887,1036380893,1036380894,1036380895,1036380896,1036380900,1036380914,1036380916,1036380923,1036380928,1036380937,1036380938,1036380939,1036380941,1036380950,1036380966,1036380978,1036380989,1036380992,1036380996,1036380998,1036381001,1036381002,1036381014,1036381015,1036381017,1036381023,1036381028,1036381032,1036381034,1036381060,1036381063,1036381074,1036381129,1036381144,1036381146,1036381160,1036381166,1036381167,1036381168,1036381184,1036381188,1036381198,1036381222,1036381231,1036560283,1036590001,1038674804,1040352463,1041870067,1042898379,1043010487,1044317317,1044398310,1044655084,1046580086,1047210022,1047210177,1047210275,1048254635,1048260162,1048260170,1048260178,1049580814,1050000408,1052932544,1053444813,1054530605,1054530632,1055116772,1055670430,1055705007,1055790106,1055790188,1055790259,1055790478,1055790479,1055790537,1055790542,1055790543,1055790552,1055790561,1055790563,1055790564,1055790567,1055790568,1055790569,1055790570,1055790572,1055790575,1055790577,1055790578,1055790579,1055790580,1055790586,1055790603,1055790606,1055790611,1055790612,1055790624,1055790626,1055790638,1055790654,1055790667,1055790671,1055790677,1055790684,1055790685,1055790703,1055790707,1055790709,1055790717,1055790718,1055790735,1055790736,1055790741,1055790744,1055790745,1055790748,1055790780,1055790784,1055790786,1055790797,1055790804,1055790825,1055790842,1055790845,1055790846,1055790853,1055790856,1055790863,1055790887,1055790888,1055790896,1055790902,1055790911,1055790919,1055790921,1055790928,1055790929,1055790941,1055790943,1055790945,1055790953,1055790955,1055790969,1055790977,1056900035,1057140144,1057363775,1057890310,1059120428,1059232767,1060185594,1062445445,1062900298,1062930406,1062930530,1063110056,1063110105,1063110320,1063110408,1063110450,1063110456,1063140297,1063140383,1063170274,1063170429,1063170435,1063410145,1063440709,1063440730,1063560238,1063590227,1064520028,1064550214,1065150131,1065330157,1065870274,1065870616,1065870744,1067285992,1073804739,1080131239,1081980552,1082427831,1083180220,1084080920,1084381736,1085671083,1087890627,1087890691,1088010368,1088160935,1088160965,1088161280,1088280942,1088310719,1088490430,1088820193,1089075331,1089970490,1090756418,1092240512,1092510361,1093953733,1096260698,1101420180,1103220464,1109766366,1112040042,1114110923,1114290500,1116000759,1116403752,1119055726,1120786400,1125120843,1128214288,1129170241,1135240832,1135312302,1136209158,1140420409,1143340057,1145101329,1149510312,1149511545,1152555583,1155041153,1155186971,1155208039,1156650587,1158900724,1162101585,1167750424,1170150588,1179108646,1182314828,1182334723,1182407135,1182541206,1183853123,1185218431,1185600163,1186936442,1193191124,1194721855,1195523715,1196774083,1198602742,1199700623,1199806969,1200275783,1200723827,1201577933,1202130887,1202629717,1202913362,1204701456,1204858539,1213616712,1215801507,1218045861,1221660468,1221786332,1222163785,1222740390,1224540322,1225560296,1227570875,1227571017,1227840273,1229040280,1229220778,1230702369,1230930344,1232400645,1232400664,1232400726,1232401356,1233330664,1233486698,1233600174,1234260708,1234260859,1234440134,1234710563,1235580117,1236480220,1236872146,1237920343,1237920540,1237920663,1237920766,1238280401,1238370363,1238370366,1239310241,1239930398,1240830567,1241550640,1241550651,1242030294,1244582774,1245751060,1246290144,1246950129,1248590214,1253041533,1259033120,1261366382,1263932120,1273446804,1274253661,1280610251,1280790051,1283414140,1283533069,1288473381,1290587224,1297552770,1301297344,1302403857,1304428754,1306014594,1307820482,1308361031,1309200864,1310394876,1315641614,1319508799,1321355240,1324415510,1326360269,1326450325,1326767762,1328130367,1328130551,1329091143,1329450343,1330230494,1331010863,1331280499,1331454319,1332240398,1334070379,1334200206,1335600143,1335643414,1335906546,1336774378,1338150281,1341690424,1341690585,1341720319,1342260223,1347751887,1351920929,1352283895,1352441734,1352910399,1353078864,1355835558,1356541114,1357638495,1357771233,1358100584,1361010212,1364860471,1365900227,1366133353,1366800146,1368000651,1368751451,1368751661,1368751793,1368752177,1368810366,1368810444,1369873172,1370520202,1372300544,1373642446,1373700631,1373700862,1373820633,1373896180,1374361076,1376035802,1376521067,1376521383,1378914297,1380150259,1380330366,1380420064,1380510139,1380600263,1381200437,1381200715,1381574438,1385509409,1386960869,1387860250,1391040758,1391040765,1392252577,1396885883,1397745352,1398065982,1398782360,1402177212,1403405966,1404331286,1409834204,1412323873,1414020317,1417937800,1418108037,1420860090,1421040177,1421325624,1421610272,1422020799,1422516857,1425921974,1427594454,1429356576,1433670319,1434630012,1436693863,1439498008,1441163968,1441188547,1441542268,1445310718,1446463625,1447080973,1447830310,1448208598,1450808944,1452561053,1454280209,1457347207,1459033170,1466042053,1470376298,1473503369,1473507468,1476421566,1476468215,1479090236,1479930038,1480650953,1483175686,1484730089,1488000492,1490444928,1493808102,1497417210,1508696821,1511070439,1511100352,1514605290,1516284290,1518031261,1521387740,1521481648,1521773968,1522317475,1535113344,1541701534,1543083594,1543672236,1545243705,1545606490,1547610137,1547730315,1548210359,1548972187,1552902214,1556040080,1563510397,1566443990,1570602325,1572451295,1572480453,1575881012,1577497260,1581125047,1584004907,1586018157,1590309878,1601855252,1605175266,1606170301,1624835872,1633110044,1638903996,1638930188,1639852511,1644707031,1645298842,1658550239,1665728407,1672596334,1674284706,1676990651,1723971188,1740172144,1746392783,1764966203,1768318155,1781850002,1796953374,1801433305,1807493090,1809458927,1814804511,1820631148,1844733420,100000004525633,100000023175730,100000030549952,100000034065577,100000034239475,100000044133429,100000047509733,100000056584899,100000065941281,100000070832424,100000071410880,100000073835490,100000075640635,100000076414977,100000097053761,100000097400239,100000104275451,100000107092336,100000126519308,100000144006109,100000145202454,100000151850078,100000151873967,100000152164239,100000158580376,100000161923865,100000168274602,100000202810453,100000204655703,100000261469339,100000341991171,100000370327552,100000393351612,100000449443512,100000487697952,100000492651764,100000502059557,100000515371880,100000568845624,100000572010209,100000583847766,100000594822991,100000658485617,100000719947022,100000756946299,100000789194041,100000817477852,100000836274700,100000875402940,100000903040670,100000905636106,100000909903550,100000920031426,100000936735995,100000942600577,100000947084131,100000964164856,100000973570106,100000982550369,100000997302083,100001031990479,100001045653063,100001078752221,100001079303716,100001081311062,100001133648752,100001136649561,100001139147589,100001175624310,100001214282702,100001254062489,100001291255146,100001292777767,100001303065622,100001309741054,100001327664944,100001352292000,100001410006764,100001444614347,100001467431818,100001597261050,100002058171310,100002268100463,100002590204959', '541259857', '2,3,36', 1, '2011-07-27 21:00:39', '64.120.96.139'),
(36, '541259857', 'Muaz Siddiqui', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/41629_541259857_2335_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/41629_541259857_2335_q.jpg', 'Muaz', NULL, 'Siddiqui', 'muazs786@gmail.com', '59293', 0, 'M', NULL, '36_megusta_creepy.png', NULL, 0, 0, 64, 0, NULL, 0, 13, '0000-00-00 00:00:00', '2011-09-04 19:02:19', 1297335, '0', 1, 1, '213145,507274,1240959,2344595,3204374,3502009,33309822,500150470,500632115,500957104,501218633,501487359,501745548,502299176,502558106,504392586,504706254,504991653,505012700,505018401,505368676,506298078,506786498,506806075,507004217,507139983,507184653,507274150,507397086,507521208,507674892,507800257,507989314,508044161,508063184,508155581,508191693,508428289,508446500,508645165,509250531,509770181,509779528,509921817,509956748,510500450,512010854,512199780,512461616,512533273,513095284,513312882,513627559,513926740,514508136,514626145,515134469,515365090,515597774,515673866,515964621,516885724,517297704,517710202,519608921,519820680,519833723,520406697,520456416,520567988,521295465,521636907,521782151,521932303,523985806,524335015,524366580,524913457,525782929,526050246,526079201,526390644,526414907,526554318,526990459,528040881,528117820,528138012,528375875,528619342,528627274,528971649,529173346,529743103,530422966,531096567,531358751,531382804,531454000,531551315,532789579,533655378,534385011,534535152,535470992,535518294,535962753,535977176,537768571,538075212,538911261,539655910,539835715,540464739,540752784,540832914,541459047,541862572,542601685,543024128,543153495,543622740,543726096,544216245,544707049,545236826,545526905,545600420,546295538,547247655,547260981,547625010,547866671,549316900,549460778,549618546,549673437,550154176,550953040,551594399,551706070,552343819,552688682,552770316,553117577,553583861,553614304,554976202,557122433,559657089,559725961,560762268,561310032,561325449,561426135,561571744,561705802,561982106,562210210,562215125,562232238,562431130,562534866,562537693,562880787,563726995,564135351,566518407,567368828,567934244,568017189,568150580,568569551,568786400,568900918,568960028,569701299,569756358,569792094,570140198,571374656,571813792,571873524,571968578,572542260,572749841,574482017,574782096,575945940,576120299,577476316,577882138,578874504,578993464,579049758,579401982,579866444,579881084,579966928,580345752,580380642,580406462,580794304,580959146,583078244,583422424,583720876,583887153,583942013,584547876,584581807,584840615,585035940,585474492,585565457,585755744,585923988,586320408,586408082,587847888,587894202,588238828,588546825,589165201,589194342,589320151,589482161,589719761,590476153,591122159,591180830,591634510,591884578,592471334,593308265,593702597,594037671,594046135,594385065,594738486,594752643,595021905,595036640,596283853,596665976,596678637,598953968,599430758,599796227,599825434,599946524,600777048,600887781,603459438,604243169,604499281,604889068,605635416,605906106,605989950,606815247,606996094,607666012,607930319,608103202,608163277,608722845,608785949,608940335,608986250,609120402,609603064,612260122,613062446,613361645,615023339,616076507,617201172,617882893,618001044,618791270,619215972,619834368,620095832,621652057,623105475,623170528,623641137,624565873,625614739,625676885,625700737,625802790,626142925,626374521,627761859,628791000,628801000,629130621,629436419,629689629,630797813,630840929,631752529,632528832,633295139,634643240,635174941,635207243,635247306,635261134,635425454,635761694,636605844,636611846,636654150,637274186,637443593,637460591,637495976,637850939,639035486,639414438,639571980,639597969,639608957,640793370,640963816,641286114,641457577,641512455,641728412,642430915,642506042,642837733,643312799,643568199,643620961,644077668,644801947,645420839,645507269,645561548,645719911,646682061,647886254,648070884,648680605,648917748,649477733,649966319,650131207,651389972,651396478,651645449,652006873,652237497,652355319,653630830,656226386,656282634,656960164,657151248,657808139,658440118,658538852,659045241,659941476,660125602,660716205,661948370,662105542,662940827,663191061,664086966,665175549,666876145,668026943,668127753,668583411,668906380,669367424,669395788,669499326,670257506,670886797,672325112,672884947,673448153,673512078,673882243,673906681,674047651,674605054,674845454,674959179,675479713,676028884,676310572,676676038,677515385,677735609,678018032,678099223,678931616,678968277,679219851,680115391,680280166,680295304,680296487,680613377,680755541,680875607,681880104,682170300,682209141,682255623,682376249,682390151,682840063,683370190,684015573,684162600,684435726,685060149,685598733,685775340,686435295,686519675,688832666,688890438,689186923,689241680,689847208,690918492,691220383,691586472,691590371,691594464,692151853,692449023,692557607,694923486,695195937,695408893,695491178,696998701,697170766,697730752,698473611,699306197,703205353,705730696,707508383,707921658,708201726,709076788,709856331,710545319,710622273,711633995,711736912,713048009,713388169,713670241,713842370,714085412,714605517,715031475,715600042,716327834,716561696,716584451,717151802,717160546,718086799,718895453,718945174,720320848,720905296,721508516,722303976,722459286,723106137,723712740,723721556,724207616,724635020,725190519,725261712,725793241,727522155,727586102,727788303,728601158,729485483,729492500,730241709,730552795,730864781,731761582,731835994,732171430,732226995,732305199,733341776,733750527,734365305,735070990,736243914,738210701,739675081,740453241,742125738,742135030,744670622,746830272,747842603,748170297,749381777,750268601,752570544,752863237,753860713,754090155,754440552,754564681,754585596,754753540,755155044,755970244,756165716,756475374,756788372,757555993,758061017,758659877,760261763,760319466,760672455,761849744,761946227,763921158,764649425,765564369,766116795,767085108,767714993,769317199,771088076,772785242,773500161,773738141,774849360,775023687,775120009,775233707,776615253,776804889,776918992,779700033,780979847,780993008,782202570,784965401,789690530,795985050,797618045,801500234,803605602,804230083,804875057,805800404,806190626,806439501,806805450,807013929,807250248,808305556,808805542,809205544,811500242,813700426,815155216,815733278,816491379,817447421,819951505,821250337,822563775,826360726,827029319,827602069,828909164,829017597,830153274,830793507,831057079,833867765,844659340,847705205,848770223,851939874,855084083,862615634,876510712,878230606,881695584,882125121,889640703,895290595,899055362,902735471,904315636,1000622703,1004229275,1007658837,1008789379,1009650805,1011857219,1015616276,1017384088,1019580298,1020877867,1021918418,1022325730,1023495769,1029358908,1032125097,1034700027,1036350068,1036350294,1036350372,1036350494,1036350564,1036350611,1036350620,1036380630,1036380775,1036380799,1036380807,1036380829,1036380865,1036381017,1036381144,1036530398,1036530432,1036590411,1038750365,1038750529,1038750583,1038750628,1040105991,1040352463,1044317317,1044398310,1044655084,1045373237,1047210177,1047240269,1047503759,1047547281,1047882275,1047990097,1048340683,1049010352,1049580902,1050273290,1050540117,1051140042,1051380080,1054530457,1054830104,1055040480,1055670142,1055670383,1055790407,1055790478,1055790479,1055790537,1055790543,1055790552,1055790567,1055790568,1055790569,1055790570,1055790572,1055790573,1055790577,1055790578,1055790580,1055790586,1055790603,1055790611,1055790612,1055790624,1055790626,1055790654,1055790667,1055790671,1055790677,1055790684,1055790685,1055790687,1055790703,1055790707,1055790717,1055790718,1055790720,1055790735,1055790738,1055790741,1055790744,1055790745,1055790748,1055790780,1055790784,1055790786,1055790797,1055790804,1055790810,1055790825,1055790834,1055790842,1055790846,1055790848,1055790856,1055790863,1055790887,1055790888,1055790896,1055790902,1055790911,1055790919,1055790921,1055790928,1055790929,1055790941,1055790943,1055790945,1055790953,1055790969,1055790977,1055850090,1057273684,1058340118,1059630135,1060185594,1061466712,1061804407,1062782377,1062960080,1063110408,1063440678,1063830361,1064280294,1064730143,1064790260,1067519339,1069840506,1071441442,1072620126,1072811916,1073836386,1075980302,1077489148,1082427831,1085051464,1086780441,1086980145,1092936179,1094719184,1117300774,1119055726,1122025828,1125240101,1125300247,1129093610,1129882017,1131024705,1132541558,1135872371,1144212911,1159650318,1161961196,1168690551,1180308284,1190701580,1193233917,1195824363,1199806969,1200275783,1200372792,1200823677,1201146822,1201230156,1205324977,1206085471,1219836697,1221786332,1229670302,1233674984,1236060114,1241820160,1241957123,1247922542,1248687875,1251274445,1251946949,1253026150,1255431891,1256335945,1257262979,1257878895,1258510915,1260453148,1262755104,1263932120,1266857867,1267591456,1273341498,1277056281,1278657323,1280610251,1283414140,1288473381,1296860939,1298026514,1300917319,1301864368,1303536232,1306546933,1307784626,1310394876,1310616861,1313029219,1315163517,1315641614,1318550858,1319508799,1322017178,1324633392,1327020396,1328405526,1329317643,1331454319,1331841275,1335330728,1336774378,1337361554,1347587128,1349149627,1353741303,1355835558,1357638495,1358870076,1363134996,1363603059,1371460765,1371544479,1379014716,1379370328,1379715943,1385126813,1385509409,1386960869,1389171085,1396163494,1397139653,1397745352,1402653886,1403233271,1409093481,1409248102,1409563544,1414981518,1417355548,1420997855,1421325624,1422638395,1422914196,1423038907,1429554742,1433615272,1433852875,1435350551,1436693863,1439330273,1439351238,1439926432,1441163968,1441188547,1441542268,1446463625,1455320344,1457375933,1458747483,1459546332,1463024136,1466042053,1467427382,1475820270,1480650953,1480953604,1482909311,1490444928,1493808102,1502706254,1503320291,1506342121,1513516357,1516284290,1517618131,1520116904,1521773968,1529731135,1530000346,1531874222,1534316312,1536240175,1541701534,1542390080,1545000117,1545706104,1547730362,1548210359,1551241650,1552902214,1553731524,1560693528,1561257094,1566443990,1568091832,1571138650,1584004907,1593948182,1595437417,1597594241,1600744665,1607961802,1614012125,1617174805,1619254849,1624835872,1630052854,1637127147,1637244015,1642607377,1645298842,1648500181,1654328155,1658071319,1669500220,1678129517,1686199994,1723971188,1781850002,1796953374,1807493090,1808199630,1813943845,1814804511,1815952374,1816756187,1825006412,1844733420,1845862655,100000000978798,100000007606442,100000014153450,100000015275474,100000027052105,100000030549952,100000033392907,100000044133429,100000047509733,100000047671775,100000055621299,100000063273006,100000073835490,100000075640635,100000077570611,100000093924861,100000097053761,100000099298130,100000122377765,100000145202454,100000147819320,100000149717845,100000156661208,100000158706258,100000161923865,100000182160130,100000182853020,100000202810453,100000213146004,100000215512503,100000238579602,100000253943428,100000259740268,100000288978603,100000293421029,100000308856253,100000372456550,100000395190709,100000449088785,100000450230611,100000463302096,100000477244963,100000515371880,100000539402521,100000539756733,100000572010209,100000579778896,100000583847766,100000605640242,100000616785249,100000619432663,100000626713928,100000633085360,100000641476257,100000673268482,100000756946299,100000787621844,100000803256740,100000850257967,100000872271407,100000875372697,100000915181684,100000915715107,100000942600577,100000982177893,100000994791610,100001012237446,100001016901351,100001040043047,100001069581904,100001093609665,100001102630565,100001107483308,100001178142955,100001184799848,100001202180347,100001202714251,100001218767373,100001254062489,100001257013466,100001264039053,100001289791047,100001290452329,100001292777767,100001327664944,100001341426045,100001393194557,100001406960115,100001455893928,100001457355003,100001519925951,100001553563461,100001562114495,100001562698238,100001669014374,100001683499704,100001712635609,100001801519146,100001804672352,100001816345274,100001860256630,100001881692146,100001916158483,100001959002806,100002006828014,100002136740975,100002145791460,100002157950496,100002178403447,100002252308147,100002377465322,100002409968295,100002454288486', '', '35', 1, '2011-08-20 17:47:10', '198.94.221.87'),
(37, '100001771058615', 'Manab Rout', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/161191_100001771058615_6569135_n.jpg', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/161580_100001771058615_1357001_q.jpg', 'Manab', NULL, 'Rout', 'manab.rout@afixi.com', '82881', 0, 'M', NULL, NULL, NULL, 0, 0, 10, 0, NULL, 0, 1, '0000-00-00 00:00:00', '2011-09-03 01:26:44', 237, '0', 1, 1, '507133377,530622141,530857535,537383092,540568330,666862041,692531709,867010392,1020504396,1126785811,1142223201,1230452951,1245524100,1258166929,1264224935,1283808242,1294743391,1310371944,1383117378,1408418201,1428189257,1430915328,1446577899,1465955508,1474535590,1474625572,1486813012,1500881687,1511974562,1514392739,1529122893,1531122822,1532062822,1535542640,1545922828,1549132521,1553872926,1564525913,1565932601,1583047333,1589152919,1591792663,1595212606,1604063058,1610152840,1619642862,1622512501,1625392669,1625795307,1635270427,1642882457,1683771209,1707030872,1733561600,1761480862,1776721117,1830987964,100000002319856,100000036893352,100000078519719,100000111218790,100000148426879,100000149149778,100000161128627,100000197611683,100000273364960,100000281882356,100000315094310,100000377845640,100000387026365,100000442897813,100000455389294,100000531370678,100000536581618,100000537974030,100000574928859,100000581874927,100000702678535,100000905074681,100000915508944,100000922024239,100000943848221,100000982826781,100000997546280,100001032359108,100001043142073,100001072110922,100001081442187,100001108771411,100001110672752,100001165747839,100001211690224,100001232541408,100001255779105,100001307018573,100001317391645,100001344642044,100001350826269,100001446343747,100001464824239,100001503582853,100001513104417,100001582779314,100001595236014,100001616530522,100001635707290,100001639947137,100001656098225,100001708898669,100001742965429,100001764383594,100001772045330,100001789301962,100001794520903,100001805692522,100001808616396,100001820785440,100001839285403,100001875633369,100001876660907,100001910353516,100001939242938,100001960283906,100001974335498,100001987614672,100001990678789,100001996567722,100002004606035,100002017584782,100002044224951,100002080465002,100002143188058,100002187058694,100002203989794,100002237802534,100002248472151,100002254180870,100002254395301,100002328711915,100002369603188,100002435291489,100002506096478,100002532884461,100002545572345,100002559345302,100002600373707,100002614523461,100002626765567,100002650717963', '', NULL, 1, '2011-09-03 01:22:46', '117.201.148.167');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `memeje__caption`
--
ALTER TABLE `memeje__caption`
  ADD CONSTRAINT `memeje__caption_ibfk_1` FOREIGN KEY (`id_meme`) REFERENCES `memeje__meme` (`id_meme`) ON DELETE CASCADE;

--
-- Constraints for table `memeje__leaderboard`
--
ALTER TABLE `memeje__leaderboard`
  ADD CONSTRAINT `memeje__leaderboard_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `memeje__user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `memeje__login`
--
ALTER TABLE `memeje__login`
  ADD CONSTRAINT `memeje__login_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `memeje__user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `memeje__meme`
--
ALTER TABLE `memeje__meme`
  ADD CONSTRAINT `memeje__meme_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `memeje__user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `memeje__reply`
--
ALTER TABLE `memeje__reply`
  ADD CONSTRAINT `memeje__reply_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `memeje__user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `memeje__reply_ibfk_2` FOREIGN KEY (`id_meme`) REFERENCES `memeje__meme` (`id_meme`) ON DELETE CASCADE;

DELIMITER $$
--
-- Procedures
--


DROP PROCEDURE IF EXISTS `get_max_recs`$$
CREATE PROCEDURE `get_max_recs`(IN tab VARCHAR(300),IN col VARCHAR(500),IN  cond VARCHAR(500))
BEGIN
SET @QUER = CONCAT("SELECT ",col," FROM ",tab," WHERE ",cond);
PREPARE stmt FROM @QUER;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
END$$

DROP PROCEDURE IF EXISTS `get_search_sql`$$
CREATE PROCEDURE `get_search_sql`(IN tb_name VARCHAR(100),IN cond TEXT,IN cols TEXT)
BEGIN                                      
 IF cond ='' THEN                    
   SET @p := CONCAT('SELECT ',cols,' FROM ' , tb_name);       
 ELSE
   SET @p := CONCAT('SELECT ',cols,' FROM ' , tb_name,' WHERE ', cond);           
 END IF;
 PREPARE stmt FROM @p;
 EXECUTE stmt;
 DEALLOCATE PREPARE stmt;
END$$

DROP PROCEDURE IF EXISTS `insert_proc`$$
CREATE PROCEDURE `insert_proc`(IN tab_name varchar(30),IN cols varchar(500),IN vals varchar(500),OUT id INT)
begin

set @quer = concat('insert into ',tab_name,'(',cols,') values (',vals,')');

prepare stmt from @quer;

execute stmt;

deallocate prepare stmt;

select last_insert_id() into id;

end$$


DROP PROCEDURE IF EXISTS `update_proc`$$
CREATE PROCEDURE `update_proc`(IN tab_name varchar(50),IN parms varchar(1000),IN cond varchar(500))
begin

set @quer = concat('update ',tab_name,' set  ',parms,' where ',cond);

prepare stmt from @quer;

execute stmt;

deallocate prepare stmt;

end$$

DELIMITER ;
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
