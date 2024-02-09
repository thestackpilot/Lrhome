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
INSERT INTO `basic_settings` VALUES (1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-12-12 19:27:42','2021-12-12 19:27:42',NULL),(2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL);
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
  `item_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_quantity` int NOT NULL,
  `unit_price` int DEFAULT NULL,
  `discount_price` int DEFAULT NULL,
  `whsid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eta_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_metas`
--

LOCK TABLES `menu_metas` WRITE;
/*!40000 ALTER TABLE `menu_metas` DISABLE KEYS */;
INSERT INTO `menu_metas` VALUES (12,3,'rugs','Rugs','https://rizzyhome.ashtexsolutions.com/category/1',NULL,NULL,1,NULL,NULL,NULL),(13,3,'bedding','Bedding','https://rizzyhome.ashtexsolutions.com/category/3',NULL,NULL,1,NULL,NULL,NULL),(14,3,'pillows','Pillows','https://rizzyhome.ashtexsolutions.com/category/2',NULL,NULL,1,NULL,NULL,NULL),(15,4,'new_additions','New Additions','https://rizzyhome.ashtexsolutions.com/new-additions',NULL,NULL,1,NULL,NULL,NULL),(16,4,'top_sellers','Top Sellers','https://rizzyhome.ashtexsolutions.com/top-sellers',NULL,NULL,1,NULL,NULL,NULL),(17,4,'special_buys','Special Buys','https://rizzyhome.ashtexsolutions.com/special-buys',NULL,NULL,1,NULL,NULL,NULL),(18,4,'my_account','My Account','javascript:void(0)',NULL,NULL,1,NULL,NULL,NULL),(19,4,'register','Register','https://rizzyhome.ashtexsolutions.com/customer/login-register/aHR0cDovL3Jpenp5aG9tZS5hc2h0ZXhzb2x1dGlvbnMuY29t',NULL,NULL,1,NULL,NULL,NULL),(20,5,'about_us','About Us','https://rizzyhome.ashtexsolutions.com/about-us',NULL,NULL,1,NULL,NULL,NULL),(21,5,'contact_us','Contact Us','https://rizzyhome.ashtexsolutions.com/contact-us',NULL,NULL,1,NULL,NULL,NULL),(22,5,'show_rooms','Showrooms','https://rizzyhome.ashtexsolutions.com/showrooms',NULL,NULL,1,NULL,NULL,NULL),(23,5,'become_dealer','Become A Dealer','https://rizzyhome.ashtexsolutions.com/customer/login-register/aHR0cDovL3Jpenp5aG9tZS5hc2h0ZXhzb2x1dGlvbnMuY29t',NULL,NULL,1,NULL,NULL,NULL),(24,5,'careers','Careers','javascript:void(0)',NULL,NULL,1,NULL,NULL,NULL),(25,5,'login_help','Login Help','javascript:void(0)',NULL,NULL,1,NULL,NULL,NULL),(26,5,'faq','FAQ','javascript:void(0)',NULL,NULL,1,NULL,NULL,NULL),(27,5,'feedback','Feedback','javascript:void(0)',NULL,NULL,1,NULL,NULL,NULL),(31,2,'new_additions','New Additions','https://rizzyhome.ashtexsolutions.com/new-additions',NULL,NULL,1,NULL,NULL,NULL),(32,2,'catalog','Catalogue','javascript:void(0)',NULL,NULL,1,NULL,NULL,NULL),(33,2,'become_a_dealer','Become A Dealer','https://rizzyhome.ashtexsolutions.com/customer/login-register/aHR0cDovL3Jpenp5aG9tZS5hc2h0ZXhzb2x1dGlvbnMuY29t',NULL,NULL,1,NULL,NULL,NULL),(34,1,'rugs','Rugs','http://vcs.ashtexsolutions.com/maincollections/1','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg',NULL,1,NULL,NULL,NULL),(35,1,'pillows','Pillows','https://vcs.ashtexsolutions.com/category/2','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg',NULL,1,NULL,NULL,NULL),(36,1,'bedding','Bedding','https://vcs.ashtexsolutions.com/category/3','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg',NULL,1,NULL,NULL,NULL);
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
INSERT INTO `menus` VALUES (1,2,'Mega Header','mega_header',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-13 08:23:19',NULL),(2,2,'Main Header','main_header',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-13 08:08:04',NULL),(3,2,'First Footer','first_footer',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-13 07:40:06',NULL),(4,2,'Second Footer','second_footer',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-13 07:43:09',NULL),(5,2,'Third Footer','third_footer',NULL,NULL,1,'2021-12-12 19:27:42','2021-12-13 07:47:18',NULL),(6,1,'Rug Header','rug_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(7,1,'Rug Shop Header','rug_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(8,1,'Pillow Header','pillow_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(9,1,'Pillow Shop Header','pillow_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(10,1,'Furniture Header','furniture_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(11,1,'Furniture Shop Header','furniture_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(12,1,'Outdoor Header','outdoor_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(13,1,'Outdoor Shop Header','outdoor_shop_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(14,1,'About Us Header','aboutus_header',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(15,1,'First Footer','first_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(16,1,'Second Footer','second_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(17,1,'Third Footer','third_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(18,1,'Fourth Footer','fourth_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(19,1,'Fifth Footer','fifth_footer',NULL,NULL,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=381 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_metas`
--

LOCK TABLES `section_metas` WRITE;
/*!40000 ALTER TABLE `section_metas` DISABLE KEYS */;
INSERT INTO `section_metas` VALUES (65,7,'caption_1',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(66,7,'caption_2',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(67,7,'image',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(68,8,'image_1_title',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(69,8,'image_1_caption',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(70,8,'image_1_image',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(71,8,'image_1_url',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(72,8,'image_2_title',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(73,8,'image_2_caption',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(74,8,'image_2_image',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(75,8,'image_2_url',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(76,8,'image_3_title',NULL,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(77,8,'image_3_caption',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(78,8,'image_3_image',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(79,8,'image_3_url',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(80,8,'image_4_title',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(81,8,'image_4_caption',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(82,8,'image_4_image',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(83,8,'image_4_url',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(84,8,'image_5_title',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(85,8,'image_5_caption',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(86,8,'image_5_image',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(87,8,'image_5_url',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(88,8,'image_6_title',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(89,8,'image_6_caption',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(90,8,'image_6_image',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(91,8,'image_6_url',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(92,9,'image_1_title',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(93,9,'image_1_caption',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(94,9,'image_1_image',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(95,9,'image_1_url',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(96,9,'image_2_title',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(97,9,'image_2_caption',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(98,9,'image_2_image',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(99,9,'image_2_url',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(100,9,'image_3_title',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(101,9,'image_3_caption',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(102,9,'image_3_image',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(103,9,'image_3_url',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(104,10,'caption',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(105,10,'button_title',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(106,10,'button_text',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(107,10,'button_url',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(108,10,'catalog_img',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(109,11,'caption',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(110,11,'button_title',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(111,11,'button_text',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(112,11,'button_url',NULL,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(257,4,'caption','We make rugs for the thoughtfully layered home. For spaces designed with intention. For people that know a good rug doesn’t just tie the room together—it sets the home apart.','2021-12-13 08:07:05','2021-12-13 08:07:05',NULL),(258,4,'button_text','LEARN MORE ABOUT US','2021-12-13 08:07:05','2021-12-13 08:07:05',NULL),(259,4,'button_url','https://vcs.ashtexsolutions.com/about-us','2021-12-13 08:07:05','2021-12-13 08:07:05',NULL),(260,5,'title_top','About','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(261,5,'title_bottom','Rizzy Home','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(262,5,'description','The direct result of collaboration between two entrepreneurial brothers, Rizzy Home is the combined effort of Rizwan and Shamsu Ansari. Originally started as Rizzy Rugs and Home Texco, Rizzy Home now offers an extensive assortment of rugs.','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(263,5,'video','https://www.youtube.com/embed/dgWzTvRhBkU','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(324,2,'caption','Follow our blog for the latest trends, home tips, and touching stories from Textile Talker, Teresa','2021-12-13 08:17:47','2021-12-13 08:17:47',NULL),(325,2,'button_title','FIND OUT MORE','2021-12-13 08:17:47','2021-12-13 08:17:47',NULL),(326,2,'button_url','https://vcs.ashtexsolutions.com/about-us','2021-12-13 08:17:47','2021-12-13 08:17:47',NULL),(327,2,'image','https://rizzyhome.ashtexsolutions.com/images/lets.jpg','2021-12-13 08:17:47','2021-12-13 08:17:47',NULL),(328,1,'image_1_title','See What\'s New','2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(329,1,'image_1_caption','2021','2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(330,1,'image_1_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_left.jpg','2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(331,1,'image_1_url','https://vcs.ashtexsolutions.com/','2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(332,1,'image_2_title','Top Sellers','2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(333,1,'image_2_caption',NULL,'2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(334,1,'image_2_image',NULL,'2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(335,1,'image_2_url',NULL,'2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(336,1,'image_3_title','Donny Osmond Home','2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(337,1,'image_3_caption',NULL,'2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(338,1,'image_3_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_top_right.jpg','2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(339,1,'image_3_url',NULL,'2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(340,1,'image_4_title','Recycled Products','2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(341,1,'image_4_caption',NULL,'2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(342,1,'image_4_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_bottom.jpg','2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(343,1,'image_4_url',NULL,'2021-12-13 08:18:42','2021-12-13 08:18:42',NULL),(344,3,'caption',NULL,'2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(345,3,'prod_1_title','Rugs','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(346,3,'prod_1_caption',NULL,'2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(347,3,'prod_1_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(348,3,'prod_1_url','https://vcs.ashtexsolutions.com/category/1','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(349,3,'prod_2_title','Bedding','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(350,3,'prod_2_caption',NULL,'2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(351,3,'prod_2_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(352,3,'prod_2_url','https://vcs.ashtexsolutions.com/category/2','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(353,3,'prod_3_title','Pillow','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(354,3,'prod_3_caption',NULL,'2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(355,3,'prod_3_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(356,3,'prod_3_url','https://rizzyhome.ashtexsolutions.com/category/3','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(357,3,'prod_4_title','Rugs','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(358,3,'prod_4_caption',NULL,'2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(359,3,'prod_4_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(360,3,'prod_4_url','https://vcs.ashtexsolutions.com/category/1','2021-12-13 08:19:02','2021-12-13 08:19:02',NULL),(361,6,'image_1_title',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(362,6,'image_1_caption',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(363,6,'image_1_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(364,6,'image_1_url',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(365,6,'image_2_title',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(366,6,'image_2_caption',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(367,6,'image_2_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(368,6,'image_2_url',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(369,6,'image_3_title',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(370,6,'image_3_caption',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(371,6,'image_3_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(372,6,'image_3_url',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(373,6,'image_4_title',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(374,6,'image_4_caption',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(375,6,'image_4_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(376,6,'image_4_url',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(377,6,'image_5_title',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(378,6,'image_5_caption',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(379,6,'image_5_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-13 08:19:37','2021-12-13 08:19:37',NULL),(380,6,'image_5_url',NULL,'2021-12-13 08:19:37','2021-12-13 08:19:37',NULL);
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
INSERT INTO `sections` VALUES (1,'New Arrival','new_arrival',1,1,'2021-12-12 19:27:42','2021-12-13 08:18:42',NULL),(2,'New Additions','new_additions',1,1,'2021-12-12 19:27:42','2021-12-13 08:17:46',NULL),(3,'Our Products','our_products',1,1,'2021-12-12 19:27:42','2021-12-13 08:19:02',NULL),(4,'Learn More','learn_more',1,1,'2021-12-12 19:27:42','2021-12-13 08:07:05',NULL),(5,'About Rizzy','about_rizzy',1,1,'2021-12-12 19:27:42','2021-12-13 08:09:10',NULL),(6,'Rizzy Home','rizzy_home',1,1,'2021-12-12 19:27:42','2021-12-13 08:19:37',NULL),(7,'Banner','banner',2,1,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(8,'Key Categories','key_categories',2,1,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(9,'New Arrival','new_arrivals',2,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(10,'Catalog','catalog',2,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL),(11,'Partnership','partnership',2,1,'2021-12-12 19:33:05','2021-12-12 19:33:05',NULL);
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
INSERT INTO `slider_metas` VALUES (1,'Create your own','Unique space','storage/app/public/slider/phpRe6fiu.jpg',1,1,'2021-12-13 07:49:16','2021-12-13 08:22:08',NULL),(2,'Create your own','Unique space','storage/app/public/slider/phpO2ueg2jpg',1,1,'2021-12-13 07:52:06','2021-12-13 07:52:06',NULL),(3,'Create your own','Unique space','storage/app/public/slider/phpHi9JN5jpg',1,1,'2021-12-13 07:52:50','2021-12-13 07:52:50',NULL);
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
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
INSERT INTO `themes` VALUES (1,'LR','lr','lr','LR','api-slug-lr','http://122.129.80.188/SPARS.API.LR/api/Service/','{\"theme_name\":\"LR\",\"theme_slug\":\"lr\",\"theme_abrv\":\"LR\",\"theme_api_slug\":\"api-slug-lr\",\"theme_api_base_url\":\"http:\\/\\/122.129.80.188\\/SPARS.API.LR\\/api\\/Service\\/\",\"theme_api_key\":\"64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d\",\"theme_api_company\":\"LRResources\",\"pages\":{\"home\":{\"title\":\"Home\",\"slug\":\"home\",\"sections\":{\"banner\":{\"slug\":\"banner\",\"title\":\"Banner\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}},\"key_categories\":{\"slug\":\"key_categories\",\"title\":\"Key Categories\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\",\"image_5_title\":\"text\",\"image_5_caption\":\"text\",\"image_5_image\":\"url\",\"image_5_url\":\"url\",\"image_6_title\":\"text\",\"image_6_caption\":\"text\",\"image_6_image\":\"url\",\"image_6_url\":\"url\"}},\"new_arrivals\":{\"slug\":\"new_arrivals\",\"title\":\"New Arrival\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\"}},\"catalog\":{\"slug\":\"catalog\",\"title\":\"Catalog\",\"metas\":{\"caption\":\"text\",\"button_title\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\",\"catalog_img\":\"url\"}},\"partnership\":{\"slug\":\"partnership\",\"title\":\"Partnership\",\"metas\":{\"caption\":\"text\",\"button_title\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\"}}}}},\"sliders\":{\"lr_slider\":{\"slug\":\"lr_slider\",\"title\":\"LR Slider\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}}},\"menus\":{\"rug_header\":{\"slug\":\"rug_header\",\"title\":\"Rug Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"rug_shop_header\":{\"slug\":\"rug_shop_header\",\"title\":\"Rug Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"pillow_header\":{\"slug\":\"pillow_header\",\"title\":\"Pillow Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"pillow_shop_header\":{\"slug\":\"pillow_shop_header\",\"title\":\"Pillow Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"furniture_header\":{\"slug\":\"furniture_header\",\"title\":\"Furniture Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"furniture_shop_header\":{\"slug\":\"furniture_shop_header\",\"title\":\"Furniture Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"outdoor_header\":{\"slug\":\"outdoor_header\",\"title\":\"Outdoor Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"outdoor_shop_header\":{\"slug\":\"outdoor_shop_header\",\"title\":\"Outdoor Shop Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"aboutus_header\":{\"slug\":\"aboutus_header\",\"title\":\"About Us Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"first_footer\":{\"slug\":\"first_footer\",\"title\":\"First Footer\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"second_footer\":{\"slug\":\"second_footer\",\"title\":\"Second Footer\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"third_footer\":{\"slug\":\"third_footer\",\"title\":\"Third Footer\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"fourth_footer\":{\"slug\":\"fourth_footer\",\"title\":\"Fourth Footer\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"fifth_footer\":{\"slug\":\"fifth_footer\",\"title\":\"Fifth Footer\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}}}}','64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d','LRResources',0,'2021-12-12 19:27:38','2021-12-13 09:01:36',NULL),(2,'rizzy home','rzy','rzy','RZY','api-slug-rzy','http://122.129.80.188/SPARS.API.DEV/api/Service/','{\"theme_name\":\"rizzy home\",\"theme_slug\":\"rzy\",\"theme_abrv\":\"RZY\",\"theme_api_slug\":\"api-slug-rzy\",\"theme_api_base_url\":\"http:\\/\\/122.129.80.188\\/SPARS.API.DEV\\/api\\/Service\\/\",\"theme_api_key\":\"64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d\",\"theme_api_company\":\"LRResources\",\"pages\":{\"home\":{\"title\":\"Home\",\"slug\":\"home\",\"sections\":{\"new_arrival\":{\"slug\":\"new_arrival\",\"title\":\"New Arrival\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\"}},\"new_additions\":{\"slug\":\"new_additions\",\"title\":\"New Additions\",\"metas\":{\"caption\":\"text\",\"button_title\":\"text\",\"button_url\":\"url\",\"image\":\"url\"}},\"our_products\":{\"slug\":\"our_products\",\"title\":\"Our Products\",\"metas\":{\"caption\":\"text\",\"prod_1_title\":\"text\",\"prod_1_caption\":\"text\",\"prod_1_image\":\"url\",\"prod_1_url\":\"url\",\"prod_2_title\":\"text\",\"prod_2_caption\":\"text\",\"prod_2_image\":\"url\",\"prod_2_url\":\"url\",\"prod_3_title\":\"text\",\"prod_3_caption\":\"text\",\"prod_3_image\":\"url\",\"prod_3_url\":\"url\",\"prod_4_title\":\"text\",\"prod_4_caption\":\"text\",\"prod_4_image\":\"url\",\"prod_4_url\":\"url\"}},\"learn_more\":{\"slug\":\"learn_more\",\"title\":\"Learn More\",\"metas\":{\"caption\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\"}},\"about_rizzy\":{\"slug\":\"about_rizzy\",\"title\":\"About Rizzy\",\"metas\":{\"title_top\":\"text\",\"title_bottom\":\"text\",\"description\":\"text\",\"video\":\"url\"}},\"rizzy_home\":{\"slug\":\"rizzy_home\",\"title\":\"Rizzy Home\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\",\"image_5_title\":\"text\",\"image_5_caption\":\"text\",\"image_5_image\":\"url\",\"image_5_url\":\"url\"}}}}},\"sliders\":{\"home_slider\":{\"slug\":\"home_slider\",\"title\":\"Home Slider\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}}},\"menus\":{\"mega_header\":{\"slug\":\"mega_header\",\"title\":\"Mega Header\",\"view_all\":\"1\",\"view_all_type\":\"maincollection\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"main_header\":{\"slug\":\"main_header\",\"title\":\"Main Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"first_footer\":{\"slug\":\"first_footer\",\"title\":\"First Footer\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"second_footer\":{\"slug\":\"second_footer\",\"title\":\"Second Footer\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"third_footer\":{\"slug\":\"third_footer\",\"title\":\"Third Footer\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}}}}','64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d','LRResources',1,'2021-12-12 19:27:38','2021-12-13 09:01:36',NULL);
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
  `sales_rep_customers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-13  9:15:23
