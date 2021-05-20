-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2021 at 01:20 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viola-communications`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `ab_id` int(11) NOT NULL,
  `ab_title` varchar(255) NOT NULL,
  `ab_image` text NOT NULL,
  `ab_content` longtext NOT NULL,
  `ab_title_ar` varchar(255) NOT NULL,
  `ab_content_ar` longtext NOT NULL,
  `ab_status` varchar(45) NOT NULL,
  `ab_icon` varchar(255) NOT NULL,
  `ab_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`ab_id`, `ab_title`, `ab_image`, `ab_content`, `ab_title_ar`, `ab_content_ar`, `ab_status`, `ab_icon`, `ab_order`) VALUES
(12, 'Creating unforgettable stories:', 'assets/img/blocks/ab_60a63c122dd1e.gif', '  Since 2001, Viola Communications has developed and perpetuated an entrepreneurial culture of collaboration supported by a deep passion for excellence in everything we do. ', 'Creating unforgettable stories:', '  Since 2001, Viola Communications has developed and perpetuated an entrepreneurial culture of collaboration supported by a deep passion for excellence in everything we do. ', 'published', '', 1),
(13, 'Pioneering market leadership', 'assets/img/blocks/ab_60a63c76676ba.gif', '   Viola Communications has evolved along with Abu Dhabi, refining the requirements of the region’s ever-broadening marketing and communications sector.', 'Pioneering market leadership', '      Viola Communications has evolved along with Abu Dhabi, refining the requirements of the region’s ever-broadening marketing and communications sector.', 'published', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` text NOT NULL,
  `cat_name_ar` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_name_ar`) VALUES
(1, 'General News', 'أخبار عامة'),
(2, 'Administrative News', 'أخبار إدارية'),
(4, 'Culture', 'أخبار ثقافية'),
(21, 'Test Category 3', 'تصنيف تجريبي 3'),
(20, 'Social News', 'أخبار إجتماعية'),
(19, 'Awareness News', 'أخبار توعوية'),
(14, 'Sport', 'أخبار رياضية'),
(22, 'Test Category 5', 'رقم 5');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_email` text NOT NULL,
  `c_subject` varchar(255) NOT NULL,
  `c_phone` varchar(255) NOT NULL DEFAULT '00000000000',
  `c_message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `g_id` int(11) NOT NULL,
  `g_title` varchar(255) NOT NULL,
  `g_image` text NOT NULL,
  `g_description` longtext NOT NULL,
  `g_status` int(11) NOT NULL COMMENT '1= enabled |  0 = disabled'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`g_id`, `g_title`, `g_image`, `g_description`, `g_status`) VALUES
(1, 'المعلمون المتميزون', 'images/gallery-img1.png', 'يأتي التنظيم ضمن مساعٍ دؤوبة وجهود مستمرة لتحقيق الأفضل، ولنشر ثقافة التميز بين أبناء الوطن، وحرصاً على استقطاب أكبر عدد من المتقدمين المتميزين من المعلمين والمعلمات والمدارس المتميزة، وتجسيداً لرؤية قطر 2030 بهدف تأصيل ثقافة التميز وتعزيزها في الميدان التربوي.\r\nوتوجه وزارة التعليم والتعليم العالي دعوتها للمدارس وللمعلمين المهتمين والمدركين عظمة مسؤوليتهم ومهمتهم في بناء هذا الوطن المعطاء، وللمساهمة في إطلاق عنان مهاراتهم وإبداعاتهم الكامنة، والمشاركة في هذه الجائزة التي تعد رافداً رئيساً لتحقيق الرؤية الوطنية 2030.', 1),
(2, 'الطلاب المتميزون', 'images/gallery-img2.png', 'وصف بسيط عن الطلاب المتميزون', 1),
(3, 'مرافق المدرسة', 'images/posts/gallery_5c6d423766f9a.png', 'وصف مرافق المدرسة', 1),
(4, 'الإنجازات', 'images/gallery_5c6d439d72164.png', 'وصف الإنجازات', 1),
(5, ' اللوائح والإجراءات', 'images/gallery_5c6d44a69b68e.png', 'وصف  اللوائح والإجراءات ..', 1),
(6, 'الدليل الإجرائي والتنظيمي', 'images/gallery_5c6d44f37e39d.png', 'وصف الدليل الإجرائي والتنظيمي ', 1),
(7, 'تجريب الغاليري 1', 'images/gallery_5c6dcca0cecfd.png', 'تجريب الغاليري تجريب الغاليري ..22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `img_url` text NOT NULL,
  `img_gallery_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `img_name`, `img_url`, `img_gallery_id`) VALUES
(1, 'المعلمون المتميزون 1', 'images/img_5c6ec4f8d5788.jpg', 0),
(2, 'المعلمون المتميزون 2', 'images/img_5c6ec546ccd50.jpg', 0),
(3, 'المعلمون المتميزون 3', 'images/img_5c6ec5594c4cd.jpg', 0),
(4, 'المعلمون المتميزون 4', 'images/img_5c6fcf13ad998.jpg', 0),
(5, 'المعلمون المتميزون 5', 'images/img_5c6fcf83afe7f.jpg', 0),
(6, 'المعلمون المتميزون 6', 'images/img_5c6fcfae4e24b.jpg', 0),
(7, 'المعلمون المتميزون 7', 'images/img_5c6fcfdf5e88c.jpg', 0),
(8, 'dd', 'images/img_5c6fd043b744e.jpg', 0),
(9, 'مرافق المدرسة صورة 1', 'images/img_5c71060f64f4d.jpg', 0),
(10, 'مرافق المدرسة صورة 2', 'images/img_5c71061ee9ce8.jpg', 0),
(11, 'الطلاب المتميزون صورة', 'images/img_5c71178c07124.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `m_id` int(11) NOT NULL,
  `m_title` varchar(45) CHARACTER SET utf8 NOT NULL,
  `m_type` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'attached file Type (image, audio.. )',
  `m_url` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`m_id`, `m_title`, `m_type`, `m_url`) VALUES
(51, '', '', 'assets/img/media/m_5deb7b262eb23.jpg'),
(129, '', '', 'assets/img/media/m_6049b59d5166d.jpg'),
(40, '', '', 'assets/img/media/m_5dcfda055b684.jpg'),
(132, '', '', 'assets/img/media/m_6049b5fb2e277.jpg'),
(130, '', '', 'assets/img/media/m_6049b5ca45bc3.jpg'),
(131, '', '', 'assets/img/media/m_6049b5e91e31e.jpg'),
(32, '', '', 'assets/img/media/m_5dc843ea87ce8.png'),
(33, '', '', 'assets/img/media/m_5dc843ea8bc3f.png'),
(39, '', '', 'assets/img/media/m_5dcfd9d361de9.jpg'),
(41, '', '', 'assets/img/media/m_5dcfe34354e2e.jpg'),
(42, '', '', 'assets/img/media/m_5dcfe3435613c.jpg'),
(43, '', '', 'assets/img/media/m_5dcfe34356f3f.jpg'),
(126, '', '', 'assets/img/media/m_6049b51e280d4.jpg'),
(127, '', '', 'assets/img/media/m_6049b5446049c.jpg'),
(128, '', '', 'assets/img/media/m_6049b58248dbf.jpg'),
(118, '', '', 'assets/img/media/m_603342531fdc8.jpg'),
(109, '', '', 'assets/img/media/m_60320c0bce8c8.jpg'),
(143, '', '', 'assets/img/media/m_6049b95f26286.jpg'),
(86, '', '', 'assets/img/media/m_6031ec20dfe56.jpg'),
(108, '', '', 'assets/img/media/m_60320bd04a1bb.jpg'),
(117, '', '', 'assets/img/media/m_603288bf1cf96.jpg'),
(107, '', '', 'assets/img/media/m_60320bb46cab1.jpg'),
(104, '', '', 'assets/img/media/m_603209dc2f5bd.jpg'),
(105, '', '', 'assets/img/media/m_60320a6624751.jpg'),
(106, '', '', 'assets/img/media/m_60320b9cd9876.jpg'),
(95, '', '', 'assets/img/media/m_603206efaacf0.jpg'),
(96, '', '', 'assets/img/media/m_603207b9c1940.jpg'),
(97, '', '', 'assets/img/media/m_60320842632d4.jpg'),
(98, '', '', 'assets/img/media/m_6032088a8a0a2.jpg'),
(99, '', '', 'assets/img/media/m_603208af2b00f.jpg'),
(100, '', '', 'assets/img/media/m_603209284697d.jpg'),
(101, '', '', 'assets/img/media/m_6032094cadcd7.jpg'),
(102, '', '', 'assets/img/media/m_6032096af2925.jpg'),
(103, '', '', 'assets/img/media/m_6032098b755a8.jpg'),
(140, '', '', 'assets/img/media/m_6049b8a112ce8.jpg'),
(139, '', '', 'assets/img/media/m_6049b890b41d5.jpg'),
(111, '', '', 'assets/img/media/m_60320c2faa4cd.jpg'),
(112, '', '', 'assets/img/media/m_60320ccace7ff.jpg'),
(113, '', '', 'assets/img/media/m_60320cdc35e84.jpg'),
(114, '', '', 'assets/img/media/m_60320e29b0e7e.jpg'),
(110, '', '', 'assets/img/media/m_60320c2034360.jpg'),
(87, '', '', 'assets/img/media/m_6031ed3a73705.jpg'),
(142, '', '', 'assets/img/media/m_6049b8dbf3775.jpg'),
(141, '', '', 'assets/img/media/m_6049b8c17d7d4.jpg'),
(138, '', '', 'assets/img/media/m_6049b8789cbc9.jpg'),
(115, '', '', 'assets/img/media/m_60320e4db692a.jpg'),
(119, '', '', 'assets/img/media/m_6036110db4db2.jpg'),
(120, '', '', 'assets/img/media/m_603611245f7a2.jpg'),
(121, '', '', 'assets/img/media/m_6036117a561a9.jpg'),
(122, '', '', 'assets/img/media/m_603612a78aa58.jpg'),
(123, '', '', 'assets/img/media/m_603613809b834.jpg'),
(124, '', '', 'assets/img/media/m_603675f052861.jpg'),
(125, '', '', 'assets/img/media/m_6036765509c34.jpg'),
(133, '', '', 'assets/img/media/m_6049b6ac33d14.jpg'),
(134, '', '', 'assets/img/media/m_6049b6c32da83.jpg'),
(135, '', '', 'assets/img/media/m_6049b6d9a9809.jpg'),
(136, '', '', 'assets/img/media/m_6049b78ca1612.jpg'),
(137, '', '', 'assets/img/media/m_6049b7a67711e.jpg'),
(144, '', '', 'assets/img/media/m_6049b96f00a1b.jpg'),
(145, '', '', 'assets/img/media/m_6049b9fe0ecb2.jpg'),
(146, '', '', 'assets/img/media/m_6049ba0f713e1.jpg'),
(147, '', '', 'assets/img/media/m_6049ba87df92f.jpg'),
(148, '', '', 'assets/img/media/m_6049ba99013c7.jpg'),
(149, '', '', 'assets/img/media/m_6049baac66172.jpg'),
(150, '', '', 'assets/img/media/m_6049bd0469472.jpg'),
(151, '', '', 'assets/img/media/m_6049bd1ebe245.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pg_id` int(11) NOT NULL,
  `pg_name` varchar(255) NOT NULL,
  `pg_content` longtext NOT NULL,
  `pg_slogan` varchar(255) NOT NULL,
  `pg_name_ar` varchar(255) NOT NULL,
  `pg_content_ar` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pg_id`, `pg_name`, `pg_content`, `pg_slogan`, `pg_name_ar`, `pg_content_ar`) VALUES
(17, 'Where to find us', '<p>From the heart of Abu Dhabi, our roots spread out to branches in Dubai and Cairo.</p>', 'Where to find us', 'Where to find us', '<p>From the heart of Abu Dhabi, our roots spread out to branches in Dubai and Cairo.</p>'),
(18, 'Our clients', '<p>We create transformative concepts for industries across the public and private sectors, by generating client-centric marketing and communications solutions.</p>', 'Our clients', 'Our clients', '<p>We create transformative concepts for industries across the public and private sectors, by generating client-centric marketing and communications solutions.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `prtn_id` int(11) NOT NULL,
  `prtn_name` varchar(255) NOT NULL,
  `prtn_image` text NOT NULL,
  `prtn_link` text NOT NULL,
  `prtn_status` varchar(45) NOT NULL COMMENT 'published or draft',
  `prtn_name_ar` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `srv_id` int(11) NOT NULL,
  `srv_title` varchar(255) NOT NULL,
  `srv_image` text NOT NULL,
  `srv_content` longtext NOT NULL,
  `srv_title_ar` varchar(255) NOT NULL,
  `srv_content_ar` longtext NOT NULL,
  `srv_status` varchar(45) NOT NULL,
  `srv_icon` varchar(255) NOT NULL,
  `srv_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`srv_id`, `srv_title`, `srv_image`, `srv_content`, `srv_title_ar`, `srv_content_ar`, `srv_status`, `srv_icon`, `srv_order`) VALUES
(1, 'test1', 'assets/img/services/srv_60a3a9ad839de.png', '<p>test</p>', 'تجربه', '<p>تجربه</p>', 'published', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_description` text NOT NULL,
  `site_logo` text NOT NULL,
  `site_email` varchar(255) NOT NULL,
  `site_address` text NOT NULL,
  `site_phone` text NOT NULL,
  `site_keywords` text NOT NULL,
  `site_status` int(11) NOT NULL,
  `site_close_msg` text NOT NULL,
  `site_fb` text NOT NULL,
  `site_tw` text NOT NULL,
  `site_ytb` text NOT NULL,
  `site_instagram` text NOT NULL,
  `site_copyrights` text NOT NULL,
  `site_name_ar` varchar(255) NOT NULL,
  `site_description_ar` text NOT NULL,
  `site_keywords_ar` text NOT NULL,
  `site_close_msg_ar` text NOT NULL,
  `site_copyrights_ar` text NOT NULL,
  `site_address_ar` text NOT NULL,
  `site_terms` text NOT NULL,
  `site_terms_ar` text CHARACTER SET utf8 COLLATE utf8_german2_ci NOT NULL,
  `site_whatsapp` text NOT NULL,
  `site_snapchat` text NOT NULL,
  `site_linkedin` text NOT NULL,
  `site_map` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_description`, `site_logo`, `site_email`, `site_address`, `site_phone`, `site_keywords`, `site_status`, `site_close_msg`, `site_fb`, `site_tw`, `site_ytb`, `site_instagram`, `site_copyrights`, `site_name_ar`, `site_description_ar`, `site_keywords_ar`, `site_close_msg_ar`, `site_copyrights_ar`, `site_address_ar`, `site_terms`, `site_terms_ar`, `site_whatsapp`, `site_snapchat`, `site_linkedin`, `site_map`) VALUES
(1, 'emirates steel', '<p>emirates steel</p>', 'assets/img/logo_5deb88ae3e1e4.png', 'admin@viola.ae', '', '', 'emirates steel,emirates,steel', 1, '', 'https://facebook.com', 'https://twitter.com', '', 'https://instagram.com', 'Emirates Steel', 'باجنيد للتجارة', '<p>تأسست شركة باجنيد للتجارة في ستينيات القرن الماضي في الرياض ثم وسعت نشاطها إلى جدة. نحن نفخر بأنفسنا في تقديم أفضل المنتجات وفاخراتنا في خدماتنا وفاخراتنا. في أعلى جودة عاكس جودة أعمال البناء المباني المباني القاسية في المملكة العربية السعودية.</p>', 'عزل حراري،عزل مائي،عزل صوتي،باسف،صوف صخري،سابك،بيتومات،عوازل،عزل الاسطح', '', 'http://www.bajunaid-sa.com', 'الرياض : حي الامانة - حي الحمراء - حي الملز - حي السلي', '', '', '', 'https://snapchat.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings_miscellaneous`
--

CREATE TABLE `settings_miscellaneous` (
  `services_number` int(11) NOT NULL,
  `services_heading` text CHARACTER SET utf8 NOT NULL,
  `services_heading_ar` text CHARACTER SET utf8 NOT NULL,
  `services_limit` int(11) NOT NULL,
  `enable_services` int(11) NOT NULL,
  `portfolio_number` int(11) NOT NULL,
  `portfolio_heading` varchar(255) CHARACTER SET utf8 NOT NULL,
  `portfolio_heading_ar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `portfolio_limit` int(11) NOT NULL,
  `enable_portfolio` int(11) NOT NULL,
  `partners_number` int(11) NOT NULL,
  `partners_heading` varchar(255) CHARACTER SET utf8 NOT NULL,
  `partners_heading_ar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `enable_partners` int(11) NOT NULL,
  `blog_number` int(11) NOT NULL,
  `blog_heading` text CHARACTER SET utf8 NOT NULL,
  `blog_heading_ar` text CHARACTER SET utf8 NOT NULL,
  `blog_limit` int(11) NOT NULL,
  `enable_blog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_miscellaneous`
--

INSERT INTO `settings_miscellaneous` (`services_number`, `services_heading`, `services_heading_ar`, `services_limit`, `enable_services`, `portfolio_number`, `portfolio_heading`, `portfolio_heading_ar`, `portfolio_limit`, `enable_portfolio`, `partners_number`, `partners_heading`, `partners_heading_ar`, `enable_partners`, `blog_number`, `blog_heading`, `blog_heading_ar`, `blog_limit`, `enable_blog`) VALUES
(2, 'Most Services We Provide', 'أهم الخدمات التي نقدمها', 11, 1, 12, '', '', 0, 0, 8, 'Partners We Proud Of', 'شركاء نفتخر بهم', 1, 4, 'Latest  Company News', 'أخر أخبار ومستجدات المؤسسة', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slide_id` int(11) NOT NULL,
  `slide_title` varchar(255) NOT NULL,
  `slide_image` text NOT NULL,
  `slide_description` text NOT NULL,
  `slide_link` text NOT NULL,
  `slide_status` varchar(45) NOT NULL,
  `slide_title_ar` varchar(255) NOT NULL,
  `slide_description_ar` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slide_id`, `slide_title`, `slide_image`, `slide_description`, `slide_link`, `slide_status`, `slide_title_ar`, `slide_description_ar`) VALUES
(10, 'WWW1', 'assets/img/slider/slide_60a3b23a1a9a8.png', '   WWWW  1 ', 'WW', 'published', 'j[nfi', '    j[nfi  ');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `facebook_title` varchar(255) NOT NULL,
  `facebook_widget` text NOT NULL,
  `twitter_title` varchar(255) NOT NULL,
  `twitter_widget` text NOT NULL,
  `youtube_title` varchar(255) NOT NULL,
  `youtube_widget` text NOT NULL,
  `instagram_title` varchar(255) NOT NULL,
  `instagram_description` text NOT NULL,
  `instagram_widget` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`facebook_title`, `facebook_widget`, `twitter_title`, `twitter_widget`, `youtube_title`, `youtube_widget`, `instagram_title`, `instagram_description`, `instagram_widget`) VALUES
('تابعنا على  الفايسبوك', '<a class=\"twitter-timeline\" data-width=\"300\" data-height=\"500\" data-theme=\"light\" href=\"https://twitter.com/FaroukSchool?ref_src=twsrc%5Etfw\">Tweets by FaroukSchool</a> <script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>', 'تابعنا على تويتر ', '<a class=\"twitter-timeline\" data-width=\"300\" data-height=\"500\" data-theme=\"light\" href=\"https://twitter.com/FaroukSchool?ref_src=twsrc%5Etfw\">Tweets by FaroukSchool</a> <script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>', ' شاهدنا على قناة الفاروق', 'PLW6J-bSlJUgn3PlBBKCBgN8C65Q4mqlEL', ' تابعنا على  أنستغرام ', '<p> لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم \r\n							لتعرض على العميل ليتصور طريقه وضع النصوص \r\n							بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او \r\n							فلاير على سبيل المثال ... او نماذج مواقع انترنت ...\r\n							لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم \r\n							لتعرض على العميل ليتصور طريقه وضع النصوص  \r\n						</p>\r\n						<p> لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم \r\n							لتعرض على العميل ليتصور طريقه وضع النصوص \r\n							بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او \r\n							فلاير على سبيل المثال ... او نماذج مواقع انترنت ...\r\n							لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم \r\n							لتعرض على العميل ليتصور طريقه وضع النصوص  \r\n						</p>', '<div>\r\n						<a href=\"https://instawidget.net/v/user/FaroukSchool\" id=\"link-d32150dfa0d5e725f45ed88c4e7c6adedbf8d50b29d900440488c0f9070959ca\">@FaroukSchool</a>\r\n						<script src=\"https://instawidget.net/js/instawidget.js?u=d32150dfa0d5e725f45ed88c4e7c6adedbf8d50b29d900440488c0f9070959ca&width=700px\"></script>\r\n					</div>'),
('تابعنا على  الفايسبوك', '<a class=\"twitter-timeline\" data-width=\"300\" data-height=\"500\" data-theme=\"light\" href=\"https://twitter.com/FaroukSchool?ref_src=twsrc%5Etfw\">Tweets by FaroukSchool</a> <script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>', 'تابعنا على تويتر ', '<a class=\"twitter-timeline\" data-width=\"300\" data-height=\"500\" data-theme=\"light\" href=\"https://twitter.com/FaroukSchool?ref_src=twsrc%5Etfw\">Tweets by FaroukSchool</a> <script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>', ' شاهدنا على قناة الفاروق', 'PLW6J-bSlJUgn3PlBBKCBgN8C65Q4mqlEL', ' تابعنا على  أنستغرام ', '<p> لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم \r\n							لتعرض على العميل ليتصور طريقه وضع النصوص \r\n							بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او \r\n							فلاير على سبيل المثال ... او نماذج مواقع انترنت ...\r\n							لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم \r\n							لتعرض على العميل ليتصور طريقه وضع النصوص  \r\n						</p>\r\n						<p> لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم \r\n							لتعرض على العميل ليتصور طريقه وضع النصوص \r\n							بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او \r\n							فلاير على سبيل المثال ... او نماذج مواقع انترنت ...\r\n							لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم \r\n							لتعرض على العميل ليتصور طريقه وضع النصوص  \r\n						</p>', '<div>\r\n						<a href=\"https://instawidget.net/v/user/FaroukSchool\" id=\"link-d32150dfa0d5e725f45ed88c4e7c6adedbf8d50b29d900440488c0f9070959ca\">@FaroukSchool</a>\r\n						<script src=\"https://instawidget.net/js/instawidget.js?u=d32150dfa0d5e725f45ed88c4e7c6adedbf8d50b29d900440488c0f9070959ca&width=700px\"></script>\r\n					</div>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` text NOT NULL,
  `user_email` text NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_password` text NOT NULL,
  `user_fname` text NOT NULL,
  `user_lname` text NOT NULL,
  `user_status` varchar(45) NOT NULL,
  `user_avatar` text NOT NULL,
  `user_about` text NOT NULL,
  `user_fb` text NOT NULL,
  `user_tw` text NOT NULL,
  `user_instg` text NOT NULL,
  `user_reg_date` text NOT NULL,
  `user_role` text NOT NULL,
  `districts_district_id` int(11) NOT NULL,
  `cities_city_id` int(11) NOT NULL,
  `states_state_id` int(11) NOT NULL,
  `countries_country_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_password`, `user_fname`, `user_lname`, `user_status`, `user_avatar`, `user_about`, `user_fb`, `user_tw`, `user_instg`, `user_reg_date`, `user_role`, `districts_district_id`, `cities_city_id`, `states_state_id`, `countries_country_id`, `created_by`) VALUES
(1, 'wmw1', 'admin@viola.ae', '212600556441', 'e10adc3949ba59abbe56e057f20f883e', 'المدير', 'المشرف', 'enabled', 'assets/img/users/user_60a3b647f1494.png', '  test', 'https://facebook.com', 'https://twitter.com', 'https://youtube.com', '2019-01-26', 'sup-admin', 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(45) NOT NULL,
  `role_name_ar` varchar(45) NOT NULL,
  `role_status` varchar(45) CHARACTER SET latin1 NOT NULL,
  `role_permissions` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`, `role_name_ar`, `role_status`, `role_permissions`) VALUES
(1, 'Super Admin', 'المدير المشرف', 'published', 'All');

-- --------------------------------------------------------

--
-- Table structure for table `welcome_block`
--

CREATE TABLE `welcome_block` (
  `blck_name` varchar(255) NOT NULL,
  `blck_content` text NOT NULL,
  `blck_image` text NOT NULL,
  `blck_link` varchar(255) NOT NULL,
  `blck_name_ar` varchar(255) NOT NULL,
  `blck_content_ar` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `welcome_block`
--

INSERT INTO `welcome_block` (`blck_name`, `blck_content`, `blck_image`, `blck_link`, `blck_name_ar`, `blck_content_ar`) VALUES
('welcome', 'emirates_steel', 'assets/img/logo_60a3b38976103.png', 'about.php', 'مرحباً', 'emirates_steel'),
('welcome', 'emirates_steel', 'assets/img/logo_60a3b38976103.png', 'about.php', 'مرحباً', 'emirates_steel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`ab_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `fk_images_gallery1_idx1` (`img_gallery_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pg_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`prtn_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`srv_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_users_districts1_idx1` (`districts_district_id`),
  ADD KEY `fk_users_cities1_idx1` (`cities_city_id`),
  ADD KEY `fk_users_states1_idx1` (`states_state_id`),
  ADD KEY `fk_users_countries1_idx1` (`countries_country_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `ab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `prtn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `srv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
