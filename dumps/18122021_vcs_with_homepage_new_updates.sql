-- MySQL dump 10.13  Distrib 5.7.36, for Linux (x86_64)
--
-- Host: localhost    Database: rizzy_home
-- ------------------------------------------------------
-- Server version	5.7.36-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `basic_settings`
--

DROP TABLE IF EXISTS `basic_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `basic_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_light` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_dark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basic_settings`
--

LOCK TABLES `basic_settings` WRITE;
/*!40000 ALTER TABLE `basic_settings` DISABLE KEYS */;
INSERT INTO `basic_settings` VALUES (1,2,NULL,'storage/XGTNDi8QAvugqqctpJ0YZKTc6Xk576r2WOoAPJto.svg','storage/UWZEjjFBwR7jsJsZ0hcnGSSVS66x8b25VxGkozno.svg','877 499 7847','info@rizzyhome.com','900 Marine Drive Calhoun, GA 30701','www.rizzyhome.com','2021-12-12 19:27:42','2021-12-14 23:13:07',NULL),(2,1,NULL,'storage/pFS90xCqTVfHDaMb4hWKE1kkbAZss1ZT2o3vo3bb.png','storage/fBSDQ0kkLsMcHpGW8W9kCO3oz08UgWhaqcwq0Y0e.png','(706)-259-0155','conactus@lrresources.com','3432 S Dug Gap Road, Dalton, GA 30720','https://lrresources.com/','2021-12-12 19:33:04','2021-12-15 21:10:24',NULL);
/*!40000 ALTER TABLE `basic_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `unit_price` int(11) DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `whsid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eta_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_metas`
--

DROP TABLE IF EXISTS `form_metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_metas`
--

LOCK TABLES `form_metas` WRITE;
/*!40000 ALTER TABLE `form_metas` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_metas`
--

DROP TABLE IF EXISTS `menu_metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned DEFAULT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_image` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_parent_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=375 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_metas`
--

LOCK TABLES `menu_metas` WRITE;
/*!40000 ALTER TABLE `menu_metas` DISABLE KEYS */;
INSERT INTO `menu_metas` VALUES (44,7,'naturals','Shop Naturals','https://lrresources.com/all-collections.php?ctype=Mg==','https://lrresources.com/media/images/NATURALS.jpg',NULL,1,NULL,NULL,NULL),(45,7,'machine_made','Shop Machine Made','https://lrresources.com/machine-made-collections.php','https://lrresources.com/media/images/MACHINE-MADE.jpg',NULL,1,NULL,NULL,NULL),(46,7,'indoor_outdoor','Shop Indoor/Outdoor','https://lrresources.com/all-collections.php?ctype=NA==','https://lrresources.com/media/images/INDOOROU-DOOR.jpg',NULL,1,NULL,NULL,NULL),(60,8,'home_decor','Home Decor',NULL,NULL,NULL,1,NULL,NULL,NULL),(61,8,'pillows','Pillows','https://lrresources.com/pillows.php',NULL,NULL,1,NULL,NULL,NULL),(62,8,'poufs','Poufs','https://lrresources.com/poufs.php',NULL,NULL,1,NULL,NULL,NULL),(63,12,'rugs','Rugs','https://lrresources.com/all-collections.php?ctype=NA==',NULL,NULL,1,NULL,NULL,NULL),(64,12,'pillows','Pillows','https://lrresources.com/indoor-outdoor-pillows.php',NULL,NULL,1,NULL,NULL,NULL),(65,12,'poufs','Poufs','https://lrresources.com/indoor-outdoor-poufs.php',NULL,NULL,1,NULL,NULL,NULL),(66,12,'baskets','Baskets','https://lrresources.com/indoor-outdoor-baskets.php',NULL,NULL,1,NULL,NULL,NULL),(67,13,'rugs','Shop Rugs','https://lrresources.com/indoor-outdoor.php','https://lrresources.com/media/images/outdoor-rug.jpg',NULL,1,NULL,NULL,NULL),(68,13,'pillow','Shop Pillow','https://lrresources.com/indoor-outdoor-pillows.php','https://lrresources.com/media/images/outdoor-pillow.jpg',NULL,1,NULL,NULL,NULL),(69,13,'poufs','Poufs','https://lrresources.com/indoor-outdoor-poufs.php','https://lrresources.com/media/images/outdoor-poofs.jpg',NULL,1,NULL,NULL,NULL),(70,14,'our_story','Our Story','https://lrresources.com/our-story.php','https://lrresources.com/media/images/our-story.jpg',NULL,1,NULL,NULL,NULL),(71,14,'our_purpose','Our Purpose','https://lrresources.com/our-purpose.php','https://lrresources.com/media/images/our-poups.jpg',NULL,1,NULL,NULL,NULL),(72,10,'accent_chairs','Accent Chairs','https://lrresources.com/chairs.php',NULL,NULL,1,NULL,NULL,NULL),(73,10,'accent_benches','Accent Benches','https://lrresources.com/benches.php',NULL,NULL,1,NULL,NULL,NULL),(74,10,'cabinets','Cabinets','https://lrresources.com/cabinets.php',NULL,NULL,1,NULL,NULL,NULL),(75,10,'coffee_tables','Coffee Tables','https://lrresources.com/coffee-table.php',NULL,NULL,1,NULL,NULL,NULL),(77,11,'chairs','Chairs','https://lrresources.com/chairs.php','https://lrresources.com/media/images/coffee-table.jpg',NULL,1,NULL,NULL,NULL),(78,15,'become_partner','Become A Partner','https://lrresources.com/become-partner.php',NULL,NULL,1,NULL,NULL,NULL),(79,15,'our_story','Our Story','https://lrresources.com/our-story.php',NULL,NULL,1,NULL,NULL,NULL),(80,15,'our_purpose','Our Purpose','https://lrresources.com/our-purpose.php',NULL,NULL,1,NULL,NULL,NULL),(81,16,'rugs','Rugs','https://lrresources.com/l-rug.php',NULL,NULL,1,NULL,NULL,NULL),(82,16,'pillows_decor','Pillows & Decor','https://lrresources.com/l-pillows-decoe.php',NULL,NULL,1,NULL,NULL,NULL),(83,16,'furniture','Furniture','https://lrresources.com/l-furniture.php',NULL,NULL,1,NULL,NULL,NULL),(84,16,'outdoor','Outdoor','https://lrresources.com/l-outdoor.php',NULL,NULL,1,NULL,NULL,NULL),(87,17,'catalog_2021','Catalog 2021','https://lrresources.com/catalog-2021/index.html',NULL,NULL,1,NULL,NULL,NULL),(88,17,'catalog_accents','Catalog Accents','https://lrresources.com/accentes-catalog/index.html',NULL,NULL,1,NULL,NULL,NULL),(89,18,'contact_us','Contact Us','https://lrresources.com/contact-us.php#contact-us',NULL,NULL,1,NULL,NULL,NULL),(90,18,'customer_service','Customer Service','https://lrresources.com/contact-us.php#Service',NULL,NULL,1,NULL,NULL,NULL),(91,18,'showroom_markets','Showrooms & Markets','https://lrresources.com/contact-us.php#Showrooms',NULL,NULL,1,NULL,NULL,NULL),(155,6,'new_addition','New Additions','/filters/NewAdditions',NULL,NULL,1,NULL,NULL,NULL),(156,6,'new_collection','New Collections','/filters/NewCollections',NULL,NULL,1,NULL,NULL,NULL),(157,6,'naturals','Naturals','https://lrresources.com/all-collections.php?ctype=Mg==',NULL,NULL,1,NULL,NULL,NULL),(158,6,'indoor_outdoor','INDOOR/OUTDOOR','https://lrresources.com/all-collections.php?ctype=NA==',NULL,NULL,1,NULL,NULL,NULL),(159,6,'accents','ACCENTS','https://lrresources.com/accentes-catalog/index.html',NULL,NULL,1,NULL,NULL,NULL),(299,2,'new_additions','New Additions','filters/NewAdditions',NULL,NULL,1,NULL,NULL,NULL),(300,2,'catalog','Catalogue','javascript:void(0);',NULL,NULL,1,NULL,NULL,NULL),(301,2,'become_a_dealer','Become A Dealer','/register/',NULL,NULL,1,NULL,NULL,NULL),(302,2,'e_catalogue_rugs','E-Catalogue Rugs','https://online.flippingbook.com/view/83369/',NULL,'catalog',1,NULL,NULL,NULL),(303,2,'e_catalogue_textile','E-Catalogue Textile','https://online.flippingbook.com/view/140475/',NULL,'catalog',1,NULL,NULL,NULL),(304,2,'supplement','2021 Supplement','https://online.flippingbook.com/view/338052495/',NULL,'catalog',1,NULL,NULL,NULL),(334,4,'new_additions','New Additions','filters/NewAdditions',NULL,NULL,1,NULL,NULL,NULL),(335,4,'top_sellers','Top Sellers','filters/TopSellers',NULL,NULL,1,NULL,NULL,NULL),(336,4,'special_buys','Special Buys','filters/SpecialBuys',NULL,NULL,1,NULL,NULL,NULL),(337,4,'my_account','My Account','/dashboard/dashboard',NULL,NULL,1,NULL,NULL,NULL),(338,4,'register','Register','filters/register/register',NULL,NULL,1,NULL,NULL,NULL),(343,1,'rugs','Rugs','/favourites/1','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg',NULL,1,NULL,NULL,NULL),(344,1,'pillows','Pillows','/favourites/2','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg',NULL,1,NULL,NULL,NULL),(345,1,'bedding','Bedding','/favourites/3','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg',NULL,1,NULL,NULL,NULL),(346,1,'throws','Throws','/favourites/8','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/HomePage_CategoryImage_Throws.jpg',NULL,1,NULL,NULL,NULL),(347,3,'rugs','Rugs','/favourites/1',NULL,NULL,1,NULL,NULL,NULL),(348,3,'bedding','Bedding','/favourites/3',NULL,NULL,1,NULL,NULL,NULL),(349,3,'pillows','Pillows','/favourites/2',NULL,NULL,1,NULL,NULL,NULL),(350,3,'throws','Throws','/favourites/8',NULL,NULL,1,NULL,NULL,NULL),(367,5,'about_us','About Us','/static/aboutus',NULL,NULL,1,NULL,NULL,NULL),(368,5,'contact_us','Contact Us','/forms/contactus',NULL,NULL,1,NULL,NULL,NULL),(369,5,'show_rooms','Showrooms','/static/showrooms',NULL,NULL,1,NULL,NULL,NULL),(370,5,'become_dealer','Become A Dealer','/register/',NULL,NULL,1,NULL,NULL,NULL),(371,5,'careers','Careers','/forms/careers',NULL,NULL,1,NULL,NULL,NULL),(372,5,'login_help','Login Help','/login-help/',NULL,NULL,1,NULL,NULL,NULL),(373,5,'faq','FAQ','/static/faqs',NULL,NULL,1,NULL,NULL,NULL),(374,5,'feedback','Feedback','/forms/feedback',NULL,NULL,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `menu_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint(20) DEFAULT NULL,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_all` int(11) DEFAULT NULL,
  `view_all_type` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,2,'PRODUCT','mega_header',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-18 06:46:27',NULL),(2,2,'Main Top Header','main_header',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-18 06:20:04',NULL),(3,2,'Products','first_footer',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-18 06:47:20',NULL),(4,2,'Quick Services','second_footer',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-18 06:24:20',NULL),(5,2,'Company Info','third_footer',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-18 06:52:16',NULL),(6,1,'Rug Header','rug_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-15 21:17:20',NULL),(7,1,'Rug Shop Header','rug_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 09:41:46',NULL),(8,1,'Pillow Header','pillow_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 09:48:42',NULL),(9,1,'Pillow Shop Header','pillow_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(10,1,'Furniture Header','furniture_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 10:08:01',NULL),(11,1,'Furniture Shop Header','furniture_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 10:08:55',NULL),(12,1,'Outdoor Header','outdoor_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 09:56:41',NULL),(13,1,'Outdoor Shop Header','outdoor_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 09:59:10',NULL),(14,1,'About Us Header','aboutus_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 10:04:35',NULL),(15,1,'ABOUT US','first_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-15 21:06:56',NULL),(16,1,'PRODUCT CATEGORY','second_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-15 21:06:56',NULL),(17,1,'RESOURCES','third_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-15 21:06:56',NULL),(18,1,'CONTACT US','fourth_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-15 21:06:56',NULL),(19,1,'Fifth Footer','fifth_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,2,'Home','home',1,'2021-12-12 19:27:42','2021-12-12 19:27:42',NULL),(2,1,'Home','home',1,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section_metas`
--

DROP TABLE IF EXISTS `section_metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `section_meta_section_id_foreign` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=693 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_metas`
--

LOCK TABLES `section_metas` WRITE;
/*!40000 ALTER TABLE `section_metas` DISABLE KEYS */;
INSERT INTO `section_metas` VALUES (65,7,'caption_1',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(66,7,'caption_2',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(67,7,'image',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(260,5,'title_top','About','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(261,5,'title_bottom','Rizzy Home','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(262,5,'description','The direct result of collaboration between two entrepreneurial brothers, Rizzy Home is the combined effort of Rizwan and Shamsu Ansari. Originally started as Rizzy Rugs and Home Texco, Rizzy Home now offers an extensive assortment of rugs.','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(263,5,'video','https://www.youtube.com/embed/dgWzTvRhBkU','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(361,6,'image_1_title',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(362,6,'image_1_caption',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(363,6,'image_1_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(364,6,'image_1_url',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(365,6,'image_2_title',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(366,6,'image_2_caption',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(367,6,'image_2_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(368,6,'image_2_url',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(369,6,'image_3_title',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(370,6,'image_3_caption',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(371,6,'image_3_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(372,6,'image_3_url',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(373,6,'image_4_title',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(374,6,'image_4_caption',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(375,6,'image_4_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(376,6,'image_4_url',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(377,6,'image_5_title',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(378,6,'image_5_caption',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(379,6,'image_5_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(380,6,'image_5_url',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(429,8,'image_1_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(430,8,'image_1_caption','Product Images','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(431,8,'image_1_image','https://lrresources.com/media/images/product/1.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(432,8,'image_1_url','http://rizzyhome.local.com/all-collections.php?ctype=Mg==','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(433,8,'image_2_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(434,8,'image_2_caption',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(435,8,'image_2_image','https://lrresources.com/media/images/product/2.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(436,8,'image_2_url','http://rizzyhome.local.com/machine-made-collections.php','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(437,8,'image_3_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(438,8,'image_3_caption',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(439,8,'image_3_image','https://lrresources.com/media/images/product/3.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(440,8,'image_3_url','http://rizzyhome.local.com/all-collections.php?ctype=NA==','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(441,8,'image_4_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(442,8,'image_4_caption',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(443,8,'image_4_image','https://lrresources.com/media/images/product/4.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(444,8,'image_4_url','http://rizzyhome.local.com/pillows.php','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(445,8,'image_5_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(446,8,'image_5_caption',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(447,8,'image_5_image','https://lrresources.com/media/images/product/5.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(448,8,'image_5_url','http://rizzyhome.local.com/throws.php','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(449,8,'image_6_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(450,8,'image_6_caption',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(451,8,'image_6_image','https://lrresources.com/media/images/product/6.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(452,8,'image_6_url','http://rizzyhome.local.com/poufs.php','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(489,9,'image_1_title','Rugs','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(490,9,'image_1_caption','Fusing transitional elegance with modern influence, our rug selection boasts artisanal quality gems at accessible price points','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(491,9,'image_1_image','https://lrresources.com/media/images/featured-product/df-1.png','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(492,9,'image_1_url','https://lrresources.com/l-rug.php','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(493,9,'image_2_title','Pillows','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(494,9,'image_2_caption','Fusing transitional elegance with modern influence, our rug selection boasts artisanal quality gems at accessible price points','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(495,9,'image_2_image','https://lrresources.com/media/images/featured-product/df-2.png','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(496,9,'image_2_url','https://lrresources.com/l-pillows-decoe.php','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(497,9,'image_3_title','Furniture','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(498,9,'image_3_caption','Our newly launched furniture selection is a passion project centered around providing the most comprehensive catalog to our customers - Check it out and let us know what you think!','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(499,9,'image_3_image','https://lrresources.com/media/images/featured-product/df-3.png','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(500,9,'image_3_url','https://lrresources.com/l-furniture.php','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(546,10,'caption','See What\'s New This Season','2021-12-13 10:22:12','2021-12-13 10:22:12',NULL),(547,10,'button_title','Browse E-catalog','2021-12-13 10:22:12','2021-12-13 10:22:12',NULL),(548,10,'button_text','Catalog 2021','2021-12-13 10:22:12','2021-12-13 10:22:12',NULL),(549,10,'button_url','https://lrresources.com/catalog-2021/index.html','2021-12-13 10:22:12','2021-12-13 10:22:12',NULL),(550,10,'catalog_img',NULL,'2021-12-13 10:22:12','2021-12-13 10:22:12',NULL),(551,11,'caption','APPLY TO BECOME A LR HOME PARTNER','2021-12-13 10:24:12','2021-12-13 10:24:12',NULL),(552,11,'button_title',NULL,'2021-12-13 10:24:12','2021-12-13 10:24:12',NULL),(553,11,'button_text','Apply Now','2021-12-13 10:24:12','2021-12-13 10:24:12',NULL),(554,11,'button_url',NULL,'2021-12-13 10:24:12','2021-12-13 10:24:12',NULL),(637,3,'caption',NULL,'2021-12-16 04:52:34','2021-12-16 04:52:34',NULL),(638,3,'prod_1_title','Rugs','2021-12-16 04:52:34','2021-12-16 04:52:34',NULL),(639,3,'prod_1_caption',NULL,'2021-12-16 04:52:34','2021-12-16 04:52:34',NULL),(640,3,'prod_1_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(641,3,'prod_1_url','/favourites/1','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(642,3,'prod_2_title','Pillows','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(643,3,'prod_2_caption',NULL,'2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(644,3,'prod_2_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(645,3,'prod_2_url','/favourites/2','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(646,3,'prod_3_title','Bedding','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(647,3,'prod_3_caption',NULL,'2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(648,3,'prod_3_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(649,3,'prod_3_url','/favourites/3','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(650,3,'prod_4_title','Rugs','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(651,3,'prod_4_caption',NULL,'2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(652,3,'prod_4_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(653,3,'prod_4_url','/favourites/1','2021-12-16 04:52:35','2021-12-16 04:52:35',NULL),(654,4,'caption','We make rugs for the thoughtfully layered home. For spaces designed with intention. For people that know a good rug doesn’t just tie the room together—it sets the home apart.','2021-12-16 04:53:46','2021-12-16 04:53:46',NULL),(655,4,'button_text','LEARN MORE ABOUT US','2021-12-16 04:53:46','2021-12-16 04:53:46',NULL),(656,4,'button_url','/static/aboutus','2021-12-16 04:53:46','2021-12-16 04:53:46',NULL),(657,2,'caption','Follow our blog for the latest trends, home tips, and touching stories from Textile Talker, Teresa','2021-12-16 04:54:38','2021-12-16 04:54:38',NULL),(658,2,'button_title','FIND OUT MORE','2021-12-16 04:54:38','2021-12-16 04:54:38',NULL),(659,2,'button_url','/static/aboutus','2021-12-16 04:54:38','2021-12-16 04:54:38',NULL),(660,2,'image','https://rizzyhome.ashtexsolutions.com/images/lets.jpg','2021-12-16 04:54:38','2021-12-16 04:54:38',NULL),(677,1,'image_1_title','See What\'s New','2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(678,1,'image_1_caption','2021','2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(679,1,'image_1_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_left.jpg','2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(680,1,'image_1_url',NULL,'2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(681,1,'image_2_title','Top Sellers','2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(682,1,'image_2_caption',NULL,'2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(683,1,'image_2_image',NULL,'2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(684,1,'image_2_url',NULL,'2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(685,1,'image_3_title','Donny Osmond Home','2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(686,1,'image_3_caption',NULL,'2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(687,1,'image_3_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_top_right.jpg','2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(688,1,'image_3_url',NULL,'2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(689,1,'image_4_title','Recycled Products','2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(690,1,'image_4_caption',NULL,'2021-12-16 05:00:36','2021-12-16 05:00:36',NULL),(691,1,'image_4_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_bottom.jpg','2021-12-16 05:00:37','2021-12-16 05:00:37',NULL),(692,1,'image_4_url',NULL,'2021-12-16 05:00:37','2021-12-16 05:00:37',NULL);
/*!40000 ALTER TABLE `section_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_id` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'New Arrival','new_arrival',1,1,'2021-12-12 19:27:42','2021-12-16 05:00:36',NULL),(2,'New Additions','new_additions',1,1,'2021-12-12 19:27:42','2021-12-16 04:54:37',NULL),(3,'Our Products','our_products',1,1,'2021-12-12 19:27:42','2021-12-16 04:52:34',NULL),(4,'Learn More','learn_more',1,1,'2021-12-12 19:27:42','2021-12-16 04:53:46',NULL),(5,'About Rizzy','about_rizzy',1,1,'2021-12-12 19:27:42','2021-12-13 08:09:10',NULL),(6,'Rizzy Home','rizzy_home',1,1,'2021-12-12 19:27:42','2021-12-13 08:19:37',NULL),(7,'Banner','banner',2,1,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(8,'Key Categories','key_categories',2,1,'2021-12-12 19:33:04','2021-12-13 09:29:35',NULL),(9,'New Arrival','new_arrivals',2,1,'2021-12-12 19:33:05','2021-12-13 10:13:43',NULL),(10,'Catalog','catalog',2,1,'2021-12-12 19:33:05','2021-12-13 10:22:12',NULL),(11,'Partnership','partnership',2,1,'2021-12-12 19:33:05','2021-12-13 10:24:12',NULL);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider_metas`
--

DROP TABLE IF EXISTS `slider_metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slider_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `caption_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_id` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider_metas`
--

LOCK TABLES `slider_metas` WRITE;
/*!40000 ALTER TABLE `slider_metas` DISABLE KEYS */;
INSERT INTO `slider_metas` VALUES (1,'Create your own','Unique space','storage/app/public/slider/phpVoRRvb.jpg',1,1,'2021-12-13 07:49:16','2021-12-16 04:25:53',NULL),(2,'Create your own','Unique space','storage/app/public/slider/phpvnzcB7.jpg',1,1,'2021-12-13 07:52:06','2021-12-15 13:06:51',NULL);
/*!40000 ALTER TABLE `slider_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (1,2,'Home Slider','home_slider',1,'2021-12-12 19:27:42','2021-12-12 19:27:42',NULL),(2,1,'LR Slider','lr_slider',1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL);
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staffs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffs`
--

LOCK TABLES `staffs` WRITE;
/*!40000 ALTER TABLE `staffs` DISABLE KEYS */;
/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `themes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_abrv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_api_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_api_base_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_json` text COLLATE utf8mb4_unicode_ci,
  `theme_api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_api_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` VALUES (1,'LR','lr','lr','LR','api-slug-lr','http://122.129.80.188/SPARS.API.LR/api/Service/','{\"theme_name\":\"LR\",\"theme_slug\":\"lr\",\"theme_abrv\":\"LR\",\"theme_api_slug\":\"api-slug-lr\",\"theme_api_base_url\":\"http:\\/\\/122.129.80.188\\/SPARS.API.LR\\/api\\/Service\\/\",\"theme_api_key\":\"64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d\",\"theme_api_company\":\"LRResources\",\"pages\":{\"home\":{\"title\":\"Home\",\"slug\":\"home\",\"sections\":{\"banner\":{\"slug\":\"banner\",\"title\":\"Banner\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}},\"key_categories\":{\"slug\":\"key_categories\",\"title\":\"Key Categories\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\",\"image_5_title\":\"text\",\"image_5_caption\":\"text\",\"image_5_image\":\"url\",\"image_5_url\":\"url\",\"image_6_title\":\"text\",\"image_6_caption\":\"text\",\"image_6_image\":\"url\",\"image_6_url\":\"url\"}},\"new_arrivals\":{\"slug\":\"new_arrivals\",\"title\":\"New Arrival\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\"}},\"catalog\":{\"slug\":\"catalog\",\"title\":\"Catalog\",\"metas\":{\"caption\":\"text\",\"button_title\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\",\"catalog_img\":\"url\"}},\"partnership\":{\"slug\":\"partnership\",\"title\":\"Partnership\",\"metas\":{\"caption\":\"text\",\"button_title\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\"}}}}},\"sliders\":{\"lr_slider\":{\"slug\":\"lr_slider\",\"title\":\"LR Slider\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}}},\"forms\":{\"contact_us\":{\"slug\":\"contact_us\",\"title\":\"Contact Us\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}}},\"menus\":{\"rug_header\":{\"slug\":\"rug_header\",\"title\":\"Rug Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"rug_shop_header\":{\"slug\":\"rug_shop_header\",\"title\":\"Rug Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"pillow_header\":{\"slug\":\"pillow_header\",\"title\":\"Pillow Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"pillow_shop_header\":{\"slug\":\"pillow_shop_header\",\"title\":\"Pillow Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"furniture_header\":{\"slug\":\"furniture_header\",\"title\":\"Furniture Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"furniture_shop_header\":{\"slug\":\"furniture_shop_header\",\"title\":\"Furniture Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"outdoor_header\":{\"slug\":\"outdoor_header\",\"title\":\"Outdoor Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"outdoor_shop_header\":{\"slug\":\"outdoor_shop_header\",\"title\":\"Outdoor Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"aboutus_header\":{\"slug\":\"aboutus_header\",\"title\":\"About Us Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"first_footer\":{\"slug\":\"first_footer\",\"title\":\"ABOUT US\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"second_footer\":{\"slug\":\"second_footer\",\"title\":\"PRODUCT CATEGORY\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"third_footer\":{\"slug\":\"third_footer\",\"title\":\"RESOURCES\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"fourth_footer\":{\"slug\":\"fourth_footer\",\"title\":\"CONTACT US\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"fifth_footer\":{\"slug\":\"fifth_footer\",\"title\":\"Fifth Footer\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}}}}','64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d','LRResources',0,'2021-12-12 19:27:38','2021-12-16 03:41:40',NULL),(2,'rizzy home','rzy','rzy','RZY','api-slug-rzy','http://122.129.80.188/SPARS.API.DEV/api/Service/','{\"theme_name\":\"rizzy home\",\"theme_slug\":\"rzy\",\"theme_abrv\":\"RZY\",\"theme_api_slug\":\"api-slug-rzy\",\"theme_api_base_url\":\"http:\\/\\/122.129.80.188\\/SPARS.API.DEV\\/api\\/Service\\/\",\"theme_api_key\":\"64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d\",\"theme_api_company\":\"LRResources\",\"pages\":{\"home\":{\"title\":\"Home\",\"slug\":\"home\",\"sections\":{\"new_arrival\":{\"slug\":\"new_arrival\",\"title\":\"New Arrival\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\"}},\"new_additions\":{\"slug\":\"new_additions\",\"title\":\"New Additions\",\"metas\":{\"caption\":\"text\",\"button_title\":\"text\",\"button_url\":\"url\",\"image\":\"url\"}},\"our_products\":{\"slug\":\"our_products\",\"title\":\"Our Products\",\"metas\":{\"caption\":\"text\",\"prod_1_title\":\"text\",\"prod_1_caption\":\"text\",\"prod_1_image\":\"url\",\"prod_1_url\":\"url\",\"prod_2_title\":\"text\",\"prod_2_caption\":\"text\",\"prod_2_image\":\"url\",\"prod_2_url\":\"url\",\"prod_3_title\":\"text\",\"prod_3_caption\":\"text\",\"prod_3_image\":\"url\",\"prod_3_url\":\"url\",\"prod_4_title\":\"text\",\"prod_4_caption\":\"text\",\"prod_4_image\":\"url\",\"prod_4_url\":\"url\"}},\"learn_more\":{\"slug\":\"learn_more\",\"title\":\"Learn More\",\"metas\":{\"caption\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\"}},\"about_rizzy\":{\"slug\":\"about_rizzy\",\"title\":\"About Rizzy\",\"metas\":{\"title_top\":\"text\",\"title_bottom\":\"text\",\"description\":\"text\",\"video\":\"url\"}},\"rizzy_home\":{\"slug\":\"rizzy_home\",\"title\":\"Rizzy Home\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\",\"image_5_title\":\"text\",\"image_5_caption\":\"text\",\"image_5_image\":\"url\",\"image_5_url\":\"url\"}}}}},\"sliders\":{\"home_slider\":{\"slug\":\"home_slider\",\"title\":\"Home Slider\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}}},\"forms\":{\"contact_us\":{\"slug\":\"contact_us\",\"title\":\"Contact Us\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}},\"feedback\":{\"slug\":\"feedback\",\"title\":\"Feedback\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}},\"careers\":{\"slug\":\"careers\",\"title\":\"Careers\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}}},\"menus\":{\"mega_header\":{\"slug\":\"mega_header\",\"title\":\"PRODUCT\",\"view_all\":\"1\",\"view_all_type\":\"maincollection\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"main_header\":{\"slug\":\"main_header\",\"title\":\"Main Top Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"first_footer\":{\"slug\":\"first_footer\",\"title\":\"Products\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"second_footer\":{\"slug\":\"second_footer\",\"title\":\"Quick Services\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"third_footer\":{\"slug\":\"third_footer\",\"title\":\"Company Info\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}}}}','64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d','LRResources',1,'2021-12-12 19:27:38','2021-12-17 10:32:10',NULL);
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spars_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_customer` tinyint(1) NOT NULL DEFAULT '1',
  `is_sale_rep` tinyint(1) NOT NULL DEFAULT '0',
  `sales_rep_customers` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'$2y$10$Os4.fCnTxhgNvv0ifric6e.oXyIbFlYjBxBxMqFR27r8uvORh7Tya',NULL,NULL,NULL,NULL,'admin@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,'{\"Customers\":[{\"CustomerID\":\"SPARSC\",\"CompanyName\":\"sparsUS\"},{\"CustomerID\":\"SPARSR\",\"CompanyName\":\"spars (DELETD)\"}]}',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'rizzy_home'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-18 16:53:12
