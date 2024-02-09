-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: vcs_system
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `basic_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_light` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_dark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_name` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_quantity` int NOT NULL,
  `item_price` int DEFAULT NULL,
  `item_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_currency` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` int DEFAULT NULL,
  `item_image` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_eta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whsid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,1,'SPARSC','QLTBQ4189IV001692','QUILT - Abstract',28,129,'IVORY','8\' - 10\" X 7\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','2022-06-16T00:00:00',NULL,NULL,'2021-12-18 16:17:51','2021-12-20 14:16:18','2021-12-20 14:16:18'),(2,1,'SPARSR','QLTBQ4189IV001692','QUILT - Abstract',229,129,'IVORY','8\' - 10\" X 7\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','2022-06-18T00:00:00',NULL,NULL,'2021-12-18 16:38:22','2021-12-20 14:51:09','2021-12-20 14:51:09'),(3,1,'SPARSC','QLTBQ4189IV009092','QUILT - Abstract',12,108,'IVORY','7\' - 6\" X 7\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','1900-01-01T00:00:00',NULL,NULL,'2021-12-18 16:50:53','2021-12-20 13:42:09','2021-12-20 13:42:09'),(4,2,'SPARSC','QLTBQ4189IV001692','QUILT - Abstract',20,129,'IVORY','8\' - 10\" X 7\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','2022-06-18T00:00:00',NULL,NULL,'2021-12-20 11:59:33','2021-12-20 13:10:49','2021-12-20 13:10:49'),(5,2,'SPARSC','QLTBQ4189IV001692','QUILT - Abstract',30,129,'IVORY','8\' - 10\" X 7\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','2022-06-18T00:00:00',NULL,NULL,'2021-12-20 13:12:27','2021-12-20 13:12:46',NULL),(6,1,'SPARSR','QLTBQ4189IV001692',NULL,209,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-12-20 14:52:27','2021-12-21 06:52:43','2021-12-21 06:52:43'),(7,1,'SPARSC','ASHAL257300041818','ASHLYN -',3,20,'00 / BEIGE','1\' - 6\" X 1\' - 6\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/ASHAL25730004.jpg','2022-06-19T00:00:00',NULL,NULL,'2021-12-21 06:52:11','2021-12-21 07:10:23',NULL),(8,3,'SPARSC','CFSBT1192BE001004','COMFORTER SET - Holiday',12,128,'BEIGE','8\' - 4\" X 8\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/CFSBT1192BE00.jpg','2022-06-19T00:00:00',NULL,NULL,'2021-12-21 09:04:27','2021-12-21 09:04:27',NULL),(9,1,'SPARSC','ADAAN692A57335373','ADANA - Transitional',8,109,'NAVY / GRAY','5\' - 3\" X 7\' - 3\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/ADAAN692A5733.jpg','2022-06-19T00:00:00',NULL,NULL,'2021-12-21 10:07:16','2021-12-21 10:20:02',NULL),(10,1,'SPARSR','ADAAN692A57335373','ADANA - Transitional',1,109,'NAVY / GRAY','5\' - 3\" X 7\' - 3\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/ADAAN692A5733.jpg','2022-06-19T00:00:00',NULL,NULL,'2021-12-21 11:59:18','2021-12-21 11:59:18',NULL);
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_metas`
--

DROP TABLE IF EXISTS `form_metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_metas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `form_id` bigint unsigned NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int DEFAULT '1',
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_metas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned DEFAULT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_image` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_parent_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=431 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_metas`
--

LOCK TABLES `menu_metas` WRITE;
/*!40000 ALTER TABLE `menu_metas` DISABLE KEYS */;
INSERT INTO `menu_metas` VALUES (44,7,'naturals','Shop Naturals','https://lrresources.com/all-collections.php?ctype=Mg==','https://lrresources.com/media/images/NATURALS.jpg',NULL,1,NULL,NULL,NULL),(45,7,'machine_made','Shop Machine Made','https://lrresources.com/machine-made-collections.php','https://lrresources.com/media/images/MACHINE-MADE.jpg',NULL,1,NULL,NULL,NULL),(46,7,'indoor_outdoor','Shop Indoor/Outdoor','https://lrresources.com/all-collections.php?ctype=NA==','https://lrresources.com/media/images/INDOOROU-DOOR.jpg',NULL,1,NULL,NULL,NULL),(60,8,'home_decor','Home Decor',NULL,NULL,NULL,1,NULL,NULL,NULL),(61,8,'pillows','Pillows','https://lrresources.com/pillows.php',NULL,NULL,1,NULL,NULL,NULL),(62,8,'poufs','Poufs','https://lrresources.com/poufs.php',NULL,NULL,1,NULL,NULL,NULL),(63,12,'rugs','Rugs','https://lrresources.com/all-collections.php?ctype=NA==',NULL,NULL,1,NULL,NULL,NULL),(64,12,'pillows','Pillows','https://lrresources.com/indoor-outdoor-pillows.php',NULL,NULL,1,NULL,NULL,NULL),(65,12,'poufs','Poufs','https://lrresources.com/indoor-outdoor-poufs.php',NULL,NULL,1,NULL,NULL,NULL),(66,12,'baskets','Baskets','https://lrresources.com/indoor-outdoor-baskets.php',NULL,NULL,1,NULL,NULL,NULL),(67,13,'rugs','Shop Rugs','https://lrresources.com/indoor-outdoor.php','https://lrresources.com/media/images/outdoor-rug.jpg',NULL,1,NULL,NULL,NULL),(68,13,'pillow','Shop Pillow','https://lrresources.com/indoor-outdoor-pillows.php','https://lrresources.com/media/images/outdoor-pillow.jpg',NULL,1,NULL,NULL,NULL),(69,13,'poufs','Poufs','https://lrresources.com/indoor-outdoor-poufs.php','https://lrresources.com/media/images/outdoor-poofs.jpg',NULL,1,NULL,NULL,NULL),(70,14,'our_story','Our Story','https://lrresources.com/our-story.php','https://lrresources.com/media/images/our-story.jpg',NULL,1,NULL,NULL,NULL),(71,14,'our_purpose','Our Purpose','https://lrresources.com/our-purpose.php','https://lrresources.com/media/images/our-poups.jpg',NULL,1,NULL,NULL,NULL),(72,10,'accent_chairs','Accent Chairs','https://lrresources.com/chairs.php',NULL,NULL,1,NULL,NULL,NULL),(73,10,'accent_benches','Accent Benches','https://lrresources.com/benches.php',NULL,NULL,1,NULL,NULL,NULL),(74,10,'cabinets','Cabinets','https://lrresources.com/cabinets.php',NULL,NULL,1,NULL,NULL,NULL),(75,10,'coffee_tables','Coffee Tables','https://lrresources.com/coffee-table.php',NULL,NULL,1,NULL,NULL,NULL),(77,11,'chairs','Chairs','https://lrresources.com/chairs.php','https://lrresources.com/media/images/coffee-table.jpg',NULL,1,NULL,NULL,NULL),(78,15,'become_partner','Become A Partner','https://lrresources.com/become-partner.php',NULL,NULL,1,NULL,NULL,NULL),(79,15,'our_story','Our Story','https://lrresources.com/our-story.php',NULL,NULL,1,NULL,NULL,NULL),(80,15,'our_purpose','Our Purpose','https://lrresources.com/our-purpose.php',NULL,NULL,1,NULL,NULL,NULL),(81,16,'rugs','Rugs','https://lrresources.com/l-rug.php',NULL,NULL,1,NULL,NULL,NULL),(82,16,'pillows_decor','Pillows & Decor','https://lrresources.com/l-pillows-decoe.php',NULL,NULL,1,NULL,NULL,NULL),(83,16,'furniture','Furniture','https://lrresources.com/l-furniture.php',NULL,NULL,1,NULL,NULL,NULL),(84,16,'outdoor','Outdoor','https://lrresources.com/l-outdoor.php',NULL,NULL,1,NULL,NULL,NULL),(87,17,'catalog_2021','Catalog 2021','https://lrresources.com/catalog-2021/index.html',NULL,NULL,1,NULL,NULL,NULL),(88,17,'catalog_accents','Catalog Accents','https://lrresources.com/accentes-catalog/index.html',NULL,NULL,1,NULL,NULL,NULL),(89,18,'contact_us','Contact Us','https://lrresources.com/contact-us.php#contact-us',NULL,NULL,1,NULL,NULL,NULL),(90,18,'customer_service','Customer Service','https://lrresources.com/contact-us.php#Service',NULL,NULL,1,NULL,NULL,NULL),(91,18,'showroom_markets','Showrooms & Markets','https://lrresources.com/contact-us.php#Showrooms',NULL,NULL,1,NULL,NULL,NULL),(155,6,'new_addition','New Additions','/filters/NewAdditions',NULL,NULL,1,NULL,NULL,NULL),(156,6,'new_collection','New Collections','/filters/NewCollections',NULL,NULL,1,NULL,NULL,NULL),(157,6,'naturals','Naturals','https://lrresources.com/all-collections.php?ctype=Mg==',NULL,NULL,1,NULL,NULL,NULL),(158,6,'indoor_outdoor','INDOOR/OUTDOOR','https://lrresources.com/all-collections.php?ctype=NA==',NULL,NULL,1,NULL,NULL,NULL),(159,6,'accents','ACCENTS','https://lrresources.com/accentes-catalog/index.html',NULL,NULL,1,NULL,NULL,NULL),(404,1,'rugs','Rugs','http://vcs.ashtexsolutions.com/favourites/1','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg',NULL,1,NULL,NULL,NULL),(405,1,'pillows','Pillows','http://vcs.ashtexsolutions.com/favourites/2','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg',NULL,1,NULL,NULL,NULL),(406,1,'bedding','Bedding','http://vcs.ashtexsolutions.com/favourites/3','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg',NULL,1,NULL,NULL,NULL),(407,1,'throws','Throws','http://vcs.ashtexsolutions.com/favourites/8','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/HomePage_CategoryImage_Throws.jpg',NULL,1,NULL,NULL,NULL),(408,2,'new_additions','New Additions','http://vcs.ashtexsolutions.com/filters/NewArrivals',NULL,NULL,1,NULL,NULL,NULL),(409,2,'catalog','Catalogue','javascript:void(0);',NULL,NULL,1,NULL,NULL,NULL),(410,2,'become_a_dealer','Become A Dealer','http://vcs.ashtexsolutions.com/register/',NULL,NULL,1,NULL,NULL,NULL),(411,2,'e_catalogue_rugs','E-Catalogue Rugs','https://online.flippingbook.com/view/83369/',NULL,'catalog',1,NULL,NULL,NULL),(412,2,'e_catalogue_textile','E-Catalogue Textile','https://online.flippingbook.com/view/140475/',NULL,'catalog',1,NULL,NULL,NULL),(413,2,'supplement','2021 Supplement','https://online.flippingbook.com/view/338052495/',NULL,'catalog',1,NULL,NULL,NULL),(414,3,'rugs','Rugs','http://vcs.ashtexsolutions.com/favourites/1',NULL,NULL,1,NULL,NULL,NULL),(415,3,'bedding','Bedding','http://vcs.ashtexsolutions.com/favourites/3',NULL,NULL,1,NULL,NULL,NULL),(416,3,'pillows','Pillows','http://vcs.ashtexsolutions.com/favourites/2',NULL,NULL,1,NULL,NULL,NULL),(417,3,'throws','Throws','http://vcs.ashtexsolutions.com/favourites/8',NULL,NULL,1,NULL,NULL,NULL),(418,4,'new_additions','New Arrivals','http://vcs.ashtexsolutions.com/filters/NewArrivals',NULL,NULL,1,NULL,NULL,NULL),(419,4,'top_sellers','Top Sellers','http://vcs.ashtexsolutions.com/filters/TopSellers',NULL,NULL,1,NULL,NULL,NULL),(420,4,'special_buys','Special Buys','http://vcs.ashtexsolutions.com/filters/SpecialBuys',NULL,NULL,1,NULL,NULL,NULL),(421,4,'my_account','My Account','http://vcs.ashtexsolutions.com/dashboard/dashboard',NULL,NULL,1,NULL,NULL,NULL),(422,4,'register','Register','http://vcs.ashtexsolutions.com/register/',NULL,NULL,1,NULL,NULL,NULL),(423,5,'about_us','About Us','http://vcs.ashtexsolutions.com/static/aboutus',NULL,NULL,1,NULL,NULL,NULL),(424,5,'contact_us','Contact Us','http://vcs.ashtexsolutions.com/forms/contactus',NULL,NULL,1,NULL,NULL,NULL),(425,5,'show_rooms','Showrooms','http://vcs.ashtexsolutions.com/static/showrooms',NULL,NULL,1,NULL,NULL,NULL),(426,5,'become_dealer','Become A Dealer','http://vcs.ashtexsolutions.com/register/',NULL,NULL,1,NULL,NULL,NULL),(427,5,'careers','Careers','http://vcs.ashtexsolutions.com/forms/careers',NULL,NULL,1,NULL,NULL,NULL),(428,5,'login_help','Login Help','http://vcs.ashtexsolutions.com/static/login-help/',NULL,NULL,1,NULL,NULL,NULL),(429,5,'faq','FAQ','http://vcs.ashtexsolutions.com/static/faqs',NULL,NULL,1,NULL,NULL,NULL),(430,5,'feedback','Feedback','http://vcs.ashtexsolutions.com/forms/feedback',NULL,NULL,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `menu_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint DEFAULT NULL,
  `name` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_all` int DEFAULT NULL,
  `view_all_type` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int DEFAULT '1',
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
INSERT INTO `menus` VALUES (1,2,'PRODUCT','mega_header',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-21 07:05:02',NULL),(2,2,'Main Top Header','main_header',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-21 07:06:14',NULL),(3,2,'Products','first_footer',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-21 07:07:50',NULL),(4,2,'Quick Services','second_footer',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-21 07:08:39',NULL),(5,2,'Company Info','third_footer',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-21 07:09:23',NULL),(6,1,'Rug Header','rug_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-15 21:17:20',NULL),(7,1,'Rug Shop Header','rug_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 09:41:46',NULL),(8,1,'Pillow Header','pillow_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 09:48:42',NULL),(9,1,'Pillow Shop Header','pillow_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(10,1,'Furniture Header','furniture_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 10:08:01',NULL),(11,1,'Furniture Shop Header','furniture_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 10:08:55',NULL),(12,1,'Outdoor Header','outdoor_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 09:56:41',NULL),(13,1,'Outdoor Shop Header','outdoor_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 09:59:10',NULL),(14,1,'About Us Header','aboutus_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-13 10:04:35',NULL),(15,1,'ABOUT US','first_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-15 21:06:56',NULL),(16,1,'PRODUCT CATEGORY','second_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-15 21:06:56',NULL),(17,1,'RESOURCES','third_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-15 21:06:56',NULL),(18,1,'CONTACT US','fourth_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-15 21:06:56',NULL),(19,1,'Fifth Footer','fifth_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `section_metas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_id` bigint unsigned NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `section_meta_section_id_foreign` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=893 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_metas`
--

LOCK TABLES `section_metas` WRITE;
/*!40000 ALTER TABLE `section_metas` DISABLE KEYS */;
INSERT INTO `section_metas` VALUES (65,7,'caption_1',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(66,7,'caption_2',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(67,7,'image',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(260,5,'title_top','About','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(261,5,'title_bottom','Rizzy Home','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(262,5,'description','The direct result of collaboration between two entrepreneurial brothers, Rizzy Home is the combined effort of Rizwan and Shamsu Ansari. Originally started as Rizzy Rugs and Home Texco, Rizzy Home now offers an extensive assortment of rugs.','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(263,5,'video','https://www.youtube.com/embed/dgWzTvRhBkU','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(429,8,'image_1_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(430,8,'image_1_caption','Product Images','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(431,8,'image_1_image','https://lrresources.com/media/images/product/1.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(432,8,'image_1_url','http://rizzyhome.local.com/all-collections.php?ctype=Mg==','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(433,8,'image_2_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(434,8,'image_2_caption',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(435,8,'image_2_image','https://lrresources.com/media/images/product/2.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(436,8,'image_2_url','http://rizzyhome.local.com/machine-made-collections.php','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(437,8,'image_3_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(438,8,'image_3_caption',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(439,8,'image_3_image','https://lrresources.com/media/images/product/3.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(440,8,'image_3_url','http://rizzyhome.local.com/all-collections.php?ctype=NA==','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(441,8,'image_4_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(442,8,'image_4_caption',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(443,8,'image_4_image','https://lrresources.com/media/images/product/4.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(444,8,'image_4_url','http://rizzyhome.local.com/pillows.php','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(445,8,'image_5_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(446,8,'image_5_caption',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(447,8,'image_5_image','https://lrresources.com/media/images/product/5.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(448,8,'image_5_url','http://rizzyhome.local.com/throws.php','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(449,8,'image_6_title',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(450,8,'image_6_caption',NULL,'2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(451,8,'image_6_image','https://lrresources.com/media/images/product/6.jpg','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(452,8,'image_6_url','http://rizzyhome.local.com/poufs.php','2021-12-13 09:29:35','2021-12-13 09:29:35',NULL),(489,9,'image_1_title','Rugs','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(490,9,'image_1_caption','Fusing transitional elegance with modern influence, our rug selection boasts artisanal quality gems at accessible price points','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(491,9,'image_1_image','https://lrresources.com/media/images/featured-product/df-1.png','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(492,9,'image_1_url','https://lrresources.com/l-rug.php','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(493,9,'image_2_title','Pillows','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(494,9,'image_2_caption','Fusing transitional elegance with modern influence, our rug selection boasts artisanal quality gems at accessible price points','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(495,9,'image_2_image','https://lrresources.com/media/images/featured-product/df-2.png','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(496,9,'image_2_url','https://lrresources.com/l-pillows-decoe.php','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(497,9,'image_3_title','Furniture','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(498,9,'image_3_caption','Our newly launched furniture selection is a passion project centered around providing the most comprehensive catalog to our customers - Check it out and let us know what you think!','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(499,9,'image_3_image','https://lrresources.com/media/images/featured-product/df-3.png','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(500,9,'image_3_url','https://lrresources.com/l-furniture.php','2021-12-13 10:13:43','2021-12-13 10:13:43',NULL),(546,10,'caption','See What\'s New This Season','2021-12-13 10:22:12','2021-12-13 10:22:12',NULL),(547,10,'button_title','Browse E-catalog','2021-12-13 10:22:12','2021-12-13 10:22:12',NULL),(548,10,'button_text','Catalog 2021','2021-12-13 10:22:12','2021-12-13 10:22:12',NULL),(549,10,'button_url','https://lrresources.com/catalog-2021/index.html','2021-12-13 10:22:12','2021-12-13 10:22:12',NULL),(550,10,'catalog_img',NULL,'2021-12-13 10:22:12','2021-12-13 10:22:12',NULL),(551,11,'caption','APPLY TO BECOME A LR HOME PARTNER','2021-12-13 10:24:12','2021-12-13 10:24:12',NULL),(552,11,'button_title',NULL,'2021-12-13 10:24:12','2021-12-13 10:24:12',NULL),(553,11,'button_text','Apply Now','2021-12-13 10:24:12','2021-12-13 10:24:12',NULL),(554,11,'button_url',NULL,'2021-12-13 10:24:12','2021-12-13 10:24:12',NULL),(782,2,'caption','Follow our blog for the latest trends, home tips, and touching stories from Textile Talker, Teresa','2021-12-21 07:11:50','2021-12-21 07:11:50',NULL),(783,2,'button_title','FIND OUT MORE','2021-12-21 07:11:50','2021-12-21 07:11:50',NULL),(784,2,'button_url','http://vcs.ashtexsolutions.com/filters/NewArrivals','2021-12-21 07:11:50','2021-12-21 07:11:50',NULL),(785,2,'image','https://rizzyhome.ashtexsolutions.com/images/lets.jpg','2021-12-21 07:11:50','2021-12-21 07:11:50',NULL),(786,3,'caption',NULL,'2021-12-21 07:12:20','2021-12-21 07:12:20',NULL),(787,3,'prod_1_title','Rugs','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(788,3,'prod_1_caption',NULL,'2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(789,3,'prod_1_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(790,3,'prod_1_url','http://vcs.ashtexsolutions.com/favourites/1','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(791,3,'prod_2_title','Pillows','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(792,3,'prod_2_caption',NULL,'2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(793,3,'prod_2_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(794,3,'prod_2_url','http://vcs.ashtexsolutions.com/favourites/2','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(795,3,'prod_3_title','Bedding','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(796,3,'prod_3_caption',NULL,'2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(797,3,'prod_3_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(798,3,'prod_3_url','http://vcs.ashtexsolutions.com/favourites/3','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(799,3,'prod_4_title','Throws','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(800,3,'prod_4_caption',NULL,'2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(801,3,'prod_4_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/HomePage_CategoryImage_Throws.jpg','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(802,3,'prod_4_url','http://vcs.ashtexsolutions.com/favourites/8','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(806,4,'caption','We make rugs for the thoughtfully layered home. For spaces designed with intention. For people that know a good rug doesn’t just tie the room together—it sets the home apart.','2021-12-21 07:12:36','2021-12-21 07:12:36',NULL),(807,4,'button_text','LEARN MORE ABOUT US','2021-12-21 07:12:36','2021-12-21 07:12:36',NULL),(808,4,'button_url','http://vcs.ashtexsolutions.com/static/aboutus','2021-12-21 07:12:36','2021-12-21 07:12:36',NULL),(809,6,'image_1_title',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(810,6,'image_1_caption',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(811,6,'image_1_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(812,6,'image_1_url',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(813,6,'image_2_title',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(814,6,'image_2_caption',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(815,6,'image_2_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(816,6,'image_2_url',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(817,6,'image_3_title',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(818,6,'image_3_caption',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(819,6,'image_3_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(820,6,'image_3_url',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(821,6,'image_4_title',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(822,6,'image_4_caption',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(823,6,'image_4_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(824,6,'image_4_url',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(825,6,'image_5_title',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(826,6,'image_5_caption',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(827,6,'image_5_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(828,6,'image_5_url',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(877,1,'image_1_title','See What\'s New','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(878,1,'image_1_caption','2021','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(879,1,'image_1_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_left.jpg','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(880,1,'image_1_url','http://vcs.ashtexsolutions.com/filters/NewArrivals/','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(881,1,'image_2_title','Top Sellers','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(882,1,'image_2_caption',NULL,'2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(883,1,'image_2_image','https://rizzyhome.ashtexsolutions.com/images/lets.jpg','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(884,1,'image_2_url','http://vcs.ashtexsolutions.com/filters/TopSellers','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(885,1,'image_3_title','Donny Osmond Home','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(886,1,'image_3_caption',NULL,'2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(887,1,'image_3_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_top_right.jpg','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(888,1,'image_3_url',NULL,'2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(889,1,'image_4_title','Recycled Products','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(890,1,'image_4_caption',NULL,'2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(891,1,'image_4_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_bottom.jpg','2021-12-21 09:35:08','2021-12-21 09:35:08',NULL),(892,1,'image_4_url',NULL,'2021-12-21 09:35:08','2021-12-21 09:35:08',NULL);
/*!40000 ALTER TABLE `section_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_id` bigint unsigned NOT NULL,
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
INSERT INTO `sections` VALUES (1,'New Arrival','new_arrival',1,1,'2021-12-12 19:27:42','2021-12-21 09:35:08',NULL),(2,'New Additions','new_additions',1,1,'2021-12-12 19:27:42','2021-12-21 07:11:50',NULL),(3,'Our Products','our_products',1,1,'2021-12-12 19:27:42','2021-12-21 07:12:20',NULL),(4,'Learn More','learn_more',1,1,'2021-12-12 19:27:42','2021-12-21 07:12:36',NULL),(5,'About Rizzy','about_rizzy',1,1,'2021-12-12 19:27:42','2021-12-13 08:09:10',NULL),(6,'Rizzy Home','rizzy_home',1,1,'2021-12-12 19:27:42','2021-12-21 07:12:56',NULL),(7,'Banner','banner',2,1,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(8,'Key Categories','key_categories',2,1,'2021-12-12 19:33:04','2021-12-13 09:29:35',NULL),(9,'New Arrival','new_arrivals',2,1,'2021-12-12 19:33:05','2021-12-13 10:13:43',NULL),(10,'Catalog','catalog',2,1,'2021-12-12 19:33:05','2021-12-13 10:22:12',NULL),(11,'Partnership','partnership',2,1,'2021-12-12 19:33:05','2021-12-13 10:24:12',NULL);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider_metas`
--

DROP TABLE IF EXISTS `slider_metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slider_metas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `caption_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_id` bigint unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider_metas`
--

LOCK TABLES `slider_metas` WRITE;
/*!40000 ALTER TABLE `slider_metas` DISABLE KEYS */;
INSERT INTO `slider_metas` VALUES (1,'Create your own','Unique space','storage/app/public/slider/phpNON5do.jpg',1,1,'2021-12-13 07:49:16','2021-12-21 08:40:58',NULL),(2,'Create your own','Unique space','storage/app/public/slider/phpvnzcB7.jpg',1,1,'2021-12-13 07:52:06','2021-12-15 13:06:51',NULL),(3,'Create your own','Unique space','storage/MGJEI0EvTmVGbeRKLzBSaXIcbK6X6We9HCcUZB4E.jpg',1,1,'2021-12-21 08:40:05','2021-12-21 08:40:05',NULL);
/*!40000 ALTER TABLE `slider_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `themes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_prefix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_abrv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_api_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_api_base_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `theme_api_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_api_company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
INSERT INTO `themes` VALUES (1,'LR','lr','lr','LR','api-slug-lr','http://122.129.80.188/SPARS.API.LR/api/Service/','{\"theme_name\":\"LR\",\"theme_slug\":\"lr\",\"theme_abrv\":\"LR\",\"theme_api_slug\":\"api-slug-lr\",\"theme_api_base_url\":\"http:\\/\\/122.129.80.188\\/SPARS.API.LR\\/api\\/Service\\/\",\"theme_api_key\":\"64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d\",\"theme_api_company\":\"LRResources\",\"pages\":{\"home\":{\"title\":\"Home\",\"slug\":\"home\",\"sections\":{\"banner\":{\"slug\":\"banner\",\"title\":\"Banner\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}},\"key_categories\":{\"slug\":\"key_categories\",\"title\":\"Key Categories\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\",\"image_5_title\":\"text\",\"image_5_caption\":\"text\",\"image_5_image\":\"url\",\"image_5_url\":\"url\",\"image_6_title\":\"text\",\"image_6_caption\":\"text\",\"image_6_image\":\"url\",\"image_6_url\":\"url\"}},\"new_arrivals\":{\"slug\":\"new_arrivals\",\"title\":\"New Arrival\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\"}},\"catalog\":{\"slug\":\"catalog\",\"title\":\"Catalog\",\"metas\":{\"caption\":\"text\",\"button_title\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\",\"catalog_img\":\"url\"}},\"partnership\":{\"slug\":\"partnership\",\"title\":\"Partnership\",\"metas\":{\"caption\":\"text\",\"button_title\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\"}}}}},\"sliders\":{\"lr_slider\":{\"slug\":\"lr_slider\",\"title\":\"LR Slider\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}}},\"forms\":{\"contact_us\":{\"slug\":\"contact_us\",\"title\":\"Contact Us\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}}},\"menus\":{\"rug_header\":{\"slug\":\"rug_header\",\"title\":\"Rug Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"rug_shop_header\":{\"slug\":\"rug_shop_header\",\"title\":\"Rug Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"pillow_header\":{\"slug\":\"pillow_header\",\"title\":\"Pillow Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"pillow_shop_header\":{\"slug\":\"pillow_shop_header\",\"title\":\"Pillow Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"furniture_header\":{\"slug\":\"furniture_header\",\"title\":\"Furniture Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"furniture_shop_header\":{\"slug\":\"furniture_shop_header\",\"title\":\"Furniture Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"outdoor_header\":{\"slug\":\"outdoor_header\",\"title\":\"Outdoor Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"outdoor_shop_header\":{\"slug\":\"outdoor_shop_header\",\"title\":\"Outdoor Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"aboutus_header\":{\"slug\":\"aboutus_header\",\"title\":\"About Us Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"first_footer\":{\"slug\":\"first_footer\",\"title\":\"ABOUT US\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"second_footer\":{\"slug\":\"second_footer\",\"title\":\"PRODUCT CATEGORY\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"third_footer\":{\"slug\":\"third_footer\",\"title\":\"RESOURCES\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"fourth_footer\":{\"slug\":\"fourth_footer\",\"title\":\"CONTACT US\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"fifth_footer\":{\"slug\":\"fifth_footer\",\"title\":\"Fifth Footer\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}}}}','64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d','LRResources',0,'2021-12-12 19:27:38','2021-12-21 10:48:58',NULL),(2,'rizzy home','rzy','rzy','RZY','api-slug-rzy','http://122.129.80.188/SPARS.API.DEV/api/Service/','{\"theme_name\":\"rizzy home\",\"theme_slug\":\"rzy\",\"theme_abrv\":\"RZY\",\"theme_api_slug\":\"api-slug-rzy\",\"theme_api_base_url\":\"http:\\/\\/122.129.80.188\\/SPARS.API.DEV\\/api\\/Service\\/\",\"theme_api_key\":\"64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d\",\"theme_api_company\":\"LRResources\",\"pages\":{\"home\":{\"title\":\"Home\",\"slug\":\"home\",\"sections\":{\"new_arrival\":{\"slug\":\"new_arrival\",\"title\":\"New Arrival\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\"}},\"new_additions\":{\"slug\":\"new_additions\",\"title\":\"New Additions\",\"metas\":{\"caption\":\"text\",\"button_title\":\"text\",\"button_url\":\"url\",\"image\":\"url\"}},\"our_products\":{\"slug\":\"our_products\",\"title\":\"Our Products\",\"metas\":{\"caption\":\"text\",\"prod_1_title\":\"text\",\"prod_1_caption\":\"text\",\"prod_1_image\":\"url\",\"prod_1_url\":\"url\",\"prod_2_title\":\"text\",\"prod_2_caption\":\"text\",\"prod_2_image\":\"url\",\"prod_2_url\":\"url\",\"prod_3_title\":\"text\",\"prod_3_caption\":\"text\",\"prod_3_image\":\"url\",\"prod_3_url\":\"url\",\"prod_4_title\":\"text\",\"prod_4_caption\":\"text\",\"prod_4_image\":\"url\",\"prod_4_url\":\"url\"}},\"learn_more\":{\"slug\":\"learn_more\",\"title\":\"Learn More\",\"metas\":{\"caption\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\"}},\"about_rizzy\":{\"slug\":\"about_rizzy\",\"title\":\"About Rizzy\",\"metas\":{\"title_top\":\"text\",\"title_bottom\":\"text\",\"description\":\"text\",\"video\":\"url\"}},\"rizzy_home\":{\"slug\":\"rizzy_home\",\"title\":\"Rizzy Home\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\",\"image_5_title\":\"text\",\"image_5_caption\":\"text\",\"image_5_image\":\"url\",\"image_5_url\":\"url\"}}}}},\"sliders\":{\"home_slider\":{\"slug\":\"home_slider\",\"title\":\"Home Slider\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}}},\"forms\":{\"contact_us\":{\"slug\":\"contact_us\",\"title\":\"Contact Us\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}},\"feedback\":{\"slug\":\"feedback\",\"title\":\"Feedback\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}},\"careers\":{\"slug\":\"careers\",\"title\":\"Careers\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}}},\"menus\":{\"mega_header\":{\"slug\":\"mega_header\",\"title\":\"PRODUCT\",\"view_all\":\"1\",\"view_all_type\":\"maincollection\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"main_header\":{\"slug\":\"main_header\",\"title\":\"Main Top Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"first_footer\":{\"slug\":\"first_footer\",\"title\":\"Products\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"second_footer\":{\"slug\":\"second_footer\",\"title\":\"Quick Services\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"third_footer\":{\"slug\":\"third_footer\",\"title\":\"Company Info\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}}}}','64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d','LRResources',1,'2021-12-12 19:27:38','2021-12-21 10:48:58',NULL);
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spars_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint DEFAULT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_customer` tinyint(1) NOT NULL DEFAULT '1',
  `is_sale_rep` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('admin','customer','staff') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `sales_rep_customers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'$2y$10$Os4.fCnTxhgNvv0ifric6e.oXyIbFlYjBxBxMqFR27r8uvORh7Tya','SPARSC',NULL,NULL,'Usman','Ashraf','admin@gmail.com','Test Company','','',NULL,NULL,NULL,'',1,1,'customer','{\"Customers\":[{\"CustomerID\":\"SPARSC\",\"CompanyName\":\"sparsUS\"},{\"CustomerID\":\"SPARSR\",\"CompanyName\":\"spars (DELETD)\"}]}','s:217:\"{\"_token\":\"NIRFkVFa6twVPPcsnuSx0UTM4DMbJTpjWidZ2OB2\",\"firstname\":\"Usman\",\"lastname\":\"Ashraf\",\"email\":\"admin@gmail.com\",\"company\":\"Test Company\",\"phone\":null,\"street_address\":null,\"postal_code\":null,\"description\":null}\";',NULL,'2021-12-20 11:54:15',NULL),(2,'$2y$10$0kl6c2LT0.euBs1fLcYxVevokCS3rUuYAtFYCILwuSffcWqqqBtE.','SPARSC',NULL,1,'Adil','Waqas','dsdas@dsdas.com',NULL,NULL,NULL,NULL,NULL,NULL,'3123123',0,1,'staff','{\"Customers\":[{\"CustomerID\":\"SPARSC\",\"CompanyName\":\"sparsUS\"},{\"CustomerID\":\"SPARSR\",\"CompanyName\":\"spars (DELETD)\"}]}','s:289:\"{\"_token\":\"NIRFkVFa6twVPPcsnuSx0UTM4DMbJTpjWidZ2OB2\",\"user\":null,\"firstname\":\"Adil\",\"lastname\":\"Waqas\",\"email\":\"dsdas@dsdas.com\",\"phone\":\"3123123\",\"password\":\"12345678\",\"cpassword\":\"12345678\",\"status\":\"active\",\"permissions\":[\"manage-orders\",\"manage-invoices\"],\"description\":\"dsadsadasdsa\"}\";','2021-12-20 11:55:54',NULL,NULL),(3,'$2y$10$hwiGHlQLF3ZAxfeCk/qGceHhzkFR0VDl6M5TUTJ68B4sKUJPQ7LBK','SPARSC',NULL,1,'Idrees','Mughal','idrees@vcs.com',NULL,NULL,NULL,NULL,NULL,NULL,'879879687',0,0,'staff','{\"Customers\":[{\"CustomerID\":\"SPARSC\",\"CompanyName\":\"sparsUS\"},{\"CustomerID\":\"SPARSR\",\"CompanyName\":\"spars (DELETD)\"}]}','s:305:\"{\"_token\":\"a6DjpG61p8dPkWTsiODyA5iiISgLzaSWAMc3d1eo\",\"user\":null,\"firstname\":\"Idrees\",\"lastname\":\"Mughal\",\"email\":\"idrees@vcs.com\",\"phone\":\"879879687\",\"password\":\"12345678\",\"cpassword\":\"12345678\",\"status\":\"active\",\"permissions\":[\"manage-orders\",\"manage-frieght\"],\"description\":\"This is an idrees account\"}\";','2021-12-21 09:00:27',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-23 16:54:12
