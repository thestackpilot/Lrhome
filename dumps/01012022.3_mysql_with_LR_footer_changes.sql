-- MySQL dump 10.13  Distrib 8.0.16, for macos10.14 (x86_64)
--
-- Host: 127.0.0.1    Database: vcs_system
-- ------------------------------------------------------
-- Server version	5.7.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
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
 SET character_set_client = utf8mb4 ;
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
INSERT INTO `basic_settings` VALUES (1,2,'Rizzy Home','storage/3SbXRL9bmFuya2QE4nD2G1RSgbZuxtBb6clGG2kY.svg','storage/JKssqXFzdWVS6XwAtJawce6sVVqFk9yd0i1XRk43.svg','877 499 7847','info@rizzyhome.com','900 Marine Drive Calhoun, GA 30701','www.rizzyhome.com','2021-12-12 19:27:42','2021-12-31 22:09:04',NULL),(2,1,'LR Resources','storage/RlJqyHAnCBrVDq5CGPLgfQsS3fQ4qi0DjEwdrhUf.png','storage/Gh36qvlXPylRqy1GR2oK9bx76OrPq0rsznpRzBov.png','(706)-259-0155','orderdesk@lrresources.com','3432 S Dug Gap Road, Dalton, GA 30720','https://lrresources.com/','2021-12-12 19:33:04','2021-12-31 22:12:10',NULL);
/*!40000 ALTER TABLE `basic_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_name` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_price` int(11) DEFAULT NULL,
  `item_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_currency` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `item_image` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_eta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whsid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,1,'SPARSC','QLTBQ4189IV001692','QUILT - Abstract',28,129,'IVORY','8\' - 10\" X 7\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','2022-06-16T00:00:00',NULL,NULL,'2021-12-18 16:17:51','2021-12-20 14:16:18','2021-12-20 14:16:18'),(2,1,'SPARSR','QLTBQ4189IV001692','QUILT - Abstract',229,129,'IVORY','8\' - 10\" X 7\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','2022-06-18T00:00:00',NULL,NULL,'2021-12-18 16:38:22','2021-12-20 14:51:09','2021-12-20 14:51:09'),(3,1,'SPARSC','QLTBQ4189IV009092','QUILT - Abstract',12,108,'IVORY','7\' - 6\" X 7\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','1900-01-01T00:00:00',NULL,NULL,'2021-12-18 16:50:53','2021-12-20 13:42:09','2021-12-20 13:42:09'),(4,2,'SPARSC','QLTBQ4189IV001692','QUILT - Abstract',20,129,'IVORY','8\' - 10\" X 7\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','2022-06-18T00:00:00',NULL,NULL,'2021-12-20 11:59:33','2021-12-20 13:10:49','2021-12-20 13:10:49'),(5,2,'SPARSC','QLTBQ4189IV001692','QUILT - Abstract',30,129,'IVORY','8\' - 10\" X 7\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','2022-06-18T00:00:00',NULL,NULL,'2021-12-20 13:12:27','2021-12-20 13:12:46',NULL),(6,1,'SPARSR','QLTBQ4189IV001692',NULL,209,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-12-20 14:52:27','2021-12-21 06:52:43','2021-12-21 06:52:43'),(7,1,'SPARSC','ASHAL257300041818','ASHLYN -',5,20,'00 / BEIGE','1\' - 6\" X 1\' - 6\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/ASHAL25730004.jpg','2022-06-19T00:00:00',NULL,NULL,'2021-12-21 06:52:11','2022-01-01 14:19:12','2022-01-01 14:19:12'),(8,3,'SPARSC','CFSBT1192BE001004','COMFORTER SET - Holiday',12,128,'BEIGE','8\' - 4\" X 8\' - 8\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/CFSBT1192BE00.jpg','2022-06-19T00:00:00',NULL,NULL,'2021-12-21 09:04:27','2021-12-21 09:04:27',NULL),(9,1,'SPARSC','ADAAN692A57335373','ADANA - Transitional',8,109,'NAVY / GRAY','5\' - 3\" X 7\' - 3\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/ADAAN692A5733.jpg','2022-06-19T00:00:00',NULL,NULL,'2021-12-21 10:07:16','2022-01-01 14:19:12','2022-01-01 14:19:12'),(10,1,'SPARSR','ADAAN692A57335373','ADANA - Transitional',1,109,'NAVY / GRAY','5\' - 3\" X 7\' - 3\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/ADAAN692A5733.jpg','2022-06-19T00:00:00',NULL,NULL,'2021-12-21 11:59:18','2022-01-01 03:06:48','2022-01-01 03:06:48'),(11,1,'SPARSC','QLTBQ4189IV009092','QUILT - Abstract',2,108,'IVORY',NULL,'$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','1900-01-01T00:00:00',NULL,NULL,'2022-01-01 09:25:56','2022-01-01 14:19:12','2022-01-01 14:19:12'),(12,1,'SPARSC','QLTBQ4189IV007086','QUILT - Abstract',1,81,'IVORY','5\' - 10\" X 7\' - 2\"','$',NULL,'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/QLTBQ4189IV00.jpg','2022-06-30T00:00:00',NULL,NULL,'2022-01-01 14:40:34','2022-01-01 14:41:21','2022-01-01 14:41:21');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_metas`
--

DROP TABLE IF EXISTS `form_metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
 SET character_set_client = utf8mb4 ;
CREATE TABLE `forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint(20) DEFAULT NULL,
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
 SET character_set_client = utf8mb4 ;
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
) ENGINE=InnoDB AUTO_INCREMENT=514 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_metas`
--

LOCK TABLES `menu_metas` WRITE;
/*!40000 ALTER TABLE `menu_metas` DISABLE KEYS */;
INSERT INTO `menu_metas` VALUES (404,1,'rugs','Rugs','http://vcs.ashtexsolutions.com/favourites/1','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg',NULL,1,NULL,NULL,NULL),(405,1,'pillows','Pillows','http://vcs.ashtexsolutions.com/favourites/2','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg',NULL,1,NULL,NULL,NULL),(406,1,'bedding','Bedding','http://vcs.ashtexsolutions.com/favourites/3','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg',NULL,1,NULL,NULL,NULL),(407,1,'throws','Throws','http://vcs.ashtexsolutions.com/favourites/8','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/HomePage_CategoryImage_Throws.jpg',NULL,1,NULL,NULL,NULL),(408,2,'new_additions','New Additions','http://vcs.ashtexsolutions.com/filters/NewArrivals',NULL,NULL,1,NULL,NULL,NULL),(409,2,'catalog','Catalogue','javascript:void(0);',NULL,NULL,1,NULL,NULL,NULL),(410,2,'become_a_dealer','Become A Dealer','http://vcs.ashtexsolutions.com/register/',NULL,NULL,1,NULL,NULL,NULL),(411,2,'e_catalogue_rugs','E-Catalogue Rugs','https://online.flippingbook.com/view/83369/',NULL,'catalog',1,NULL,NULL,NULL),(412,2,'e_catalogue_textile','E-Catalogue Textile','https://online.flippingbook.com/view/140475/',NULL,'catalog',1,NULL,NULL,NULL),(413,2,'supplement','2021 Supplement','https://online.flippingbook.com/view/338052495/',NULL,'catalog',1,NULL,NULL,NULL),(414,3,'rugs','Rugs','http://vcs.ashtexsolutions.com/favourites/1',NULL,NULL,1,NULL,NULL,NULL),(415,3,'bedding','Bedding','http://vcs.ashtexsolutions.com/favourites/3',NULL,NULL,1,NULL,NULL,NULL),(416,3,'pillows','Pillows','http://vcs.ashtexsolutions.com/favourites/2',NULL,NULL,1,NULL,NULL,NULL),(417,3,'throws','Throws','http://vcs.ashtexsolutions.com/favourites/8',NULL,NULL,1,NULL,NULL,NULL),(418,4,'new_additions','New Arrivals','http://vcs.ashtexsolutions.com/filters/NewArrivals',NULL,NULL,1,NULL,NULL,NULL),(419,4,'top_sellers','Top Sellers','http://vcs.ashtexsolutions.com/filters/TopSellers',NULL,NULL,1,NULL,NULL,NULL),(420,4,'special_buys','Special Buys','http://vcs.ashtexsolutions.com/filters/SpecialBuys',NULL,NULL,1,NULL,NULL,NULL),(421,4,'my_account','My Account','http://vcs.ashtexsolutions.com/dashboard/dashboard',NULL,NULL,1,NULL,NULL,NULL),(422,4,'register','Register','http://vcs.ashtexsolutions.com/register/',NULL,NULL,1,NULL,NULL,NULL),(423,5,'about_us','About Us','http://vcs.ashtexsolutions.com/static/aboutus',NULL,NULL,1,NULL,NULL,NULL),(424,5,'contact_us','Contact Us','http://vcs.ashtexsolutions.com/forms/contactus',NULL,NULL,1,NULL,NULL,NULL),(425,5,'show_rooms','Showrooms','http://vcs.ashtexsolutions.com/static/showrooms',NULL,NULL,1,NULL,NULL,NULL),(426,5,'become_dealer','Become A Dealer','http://vcs.ashtexsolutions.com/register/',NULL,NULL,1,NULL,NULL,NULL),(427,5,'careers','Careers','http://vcs.ashtexsolutions.com/forms/careers',NULL,NULL,1,NULL,NULL,NULL),(428,5,'login_help','Login Help','http://vcs.ashtexsolutions.com/static/login-help/',NULL,NULL,1,NULL,NULL,NULL),(429,5,'faq','FAQ','http://vcs.ashtexsolutions.com/static/faqs',NULL,NULL,1,NULL,NULL,NULL),(430,5,'feedback','Feedback','http://vcs.ashtexsolutions.com/forms/feedback',NULL,NULL,1,NULL,NULL,NULL),(431,6,'new_addition','NEW ADDITIONS','http://vcs.ashtexsolutions.com//filters/NewArrivals',NULL,NULL,1,NULL,NULL,NULL),(432,6,'new_collection','NEW COLLECTIONS','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(433,6,'naturals','NATURALS','http://vcs.ashtexsolutions.com/designs/1/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJLaWRzICYgVGVlbiJdfV19/0',NULL,NULL,1,NULL,NULL,NULL),(434,6,'indoor_outdoor','INDOOR/OUTDOOR','http://vcs.ashtexsolutions.com/designs/1/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJJbmRvb3IvT3V0ZG9vciJdfV19/0',NULL,NULL,1,NULL,NULL,NULL),(435,6,'accents','ACCENTS','http://vcs.ashtexsolutions.com/designs/1/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJJbmRvb3IvT3V0ZG9vciJdfV19/0',NULL,NULL,1,NULL,NULL,NULL),(436,7,'naturals','SHOP NATURALS','http://vcs.ashtexsolutions.com/designs/1/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJLaWRzICYgVGVlbiJdfV19/0','https://lrresources.com/media/images/NATURALS.jpg',NULL,1,NULL,NULL,NULL),(437,7,'machine_made','SHOP MACHINE MADE','http://vcs.ashtexsolutions.com/designs/1/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJJbmRvb3IvT3V0ZG9vciJdfV19/0','https://lrresources.com/media/images/MACHINE-MADE.jpg',NULL,1,NULL,NULL,NULL),(438,7,'indoor_outdoor','SHOP INDOOR/OUTDOOR','http://vcs.ashtexsolutions.com/designs/1/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJJbmRvb3IvT3V0ZG9vciJdfV19/0','https://lrresources.com/media/images/INDOOROU-DOOR.jpg',NULL,1,NULL,NULL,NULL),(447,8,'pillows','PILLOWS','http://vcs.ashtexsolutions.com/collections/2/Colors',NULL,NULL,1,NULL,NULL,NULL),(448,8,'poufs','POUFS','http://vcs.ashtexsolutions.com/collections/2/LifeStyles',NULL,NULL,1,NULL,NULL,NULL),(449,8,'throws','THROWS','http://vcs.ashtexsolutions.com/designs/2/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJLaWRzICYgVGVlbiJdfV19/0',NULL,NULL,1,NULL,NULL,NULL),(450,8,'baskets','BASKETS','http://vcs.ashtexsolutions.com/designs/2/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiVG9wX1NlbGxlcnMiLCJWYWx1ZXMiOiBbIlRvcF9TZWxsZXJzIl19XX0=/0',NULL,NULL,1,NULL,NULL,NULL),(451,8,'chair_pads','CHAIR PADS','http://vcs.ashtexsolutions.com/designs/2/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJJbmRvb3IvT3V0ZG9vciJdfV19/0',NULL,NULL,1,NULL,NULL,NULL),(452,8,'table_tops','TABLE TOPS','http://vcs.ashtexsolutions.com/collections/2/Collections',NULL,NULL,1,NULL,NULL,NULL),(453,8,'coverlets','COVERLETS','http://vcs.ashtexsolutions.com/collections/2/Colors',NULL,NULL,1,NULL,NULL,NULL),(454,8,'wall_hangings','WALL HANGINGS','http://vcs.ashtexsolutions.com/designs/2/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJLaWRzICYgVGVlbiJdfV19/0',NULL,NULL,1,NULL,NULL,NULL),(455,20,'pet_bowls','PET BOWLS','http://vcs.ashtexsolutions.com/collections/2/Colors',NULL,NULL,1,NULL,NULL,NULL),(456,20,'pet_beds','PET BEDS','http://vcs.ashtexsolutions.com/designs/2/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJLaWRzICYgVGVlbiJdfV19/0',NULL,NULL,1,NULL,NULL,NULL),(457,9,'shop_pillows','SHOP PILLOWS','http://vcs.ashtexsolutions.com/collections/2/Collections','https://lrresources.com/media/images/pillows.jpg',NULL,1,NULL,NULL,NULL),(458,9,'shop_throws','SHOP THROWS','http://vcs.ashtexsolutions.com/collections/8/Collections','https://lrresources.com/media/images/Throws.jpg',NULL,1,NULL,NULL,NULL),(475,21,'bar_counter_tables','BAR & COUNTER TABLE','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(476,21,'dinning_table','DINING TABLE','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(477,21,'dinning_benches','DINING BENCHES','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(478,10,'accent_chairs','ACCENT CHAIRS','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(479,10,'accent_benches','ACCENT BENCHES','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(480,10,'cabinets','CABINETS','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(481,10,'coffee_tables','COFFEE TABLES','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(482,10,'consoles','CONSOLES','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(483,10,'side_tables','SIDE TABLES','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(484,10,'sideboards','SIDEBOARDS','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(485,10,'stools_ottoman','STOOLS & OTTOMAN','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(486,11,'chairs','CHAIRS','http://vcs.ashtexsolutions.com/designs/1/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJJbmRvb3IvT3V0ZG9vciJdfV19/0','https://lrresources.com/media/images/coffee-table.jpg',NULL,1,NULL,NULL,NULL),(487,11,'benches','BENCHES','http://vcs.ashtexsolutions.com/designs/1/eyJGaWx0ZXJzIjogW3siRmlsdGVySUQiOiAiRGVzaWduIiwiVmFsdWVzIjogWyJJbmRvb3IvT3V0ZG9vciJdfV19/0','https://lrresources.com/media/images/side-table.jpg',NULL,1,NULL,NULL,NULL),(488,12,'rugs','RUGS','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(489,12,'pillows','PILLOWS','http://vcs.ashtexsolutions.com/collections/2/Collections',NULL,NULL,1,NULL,NULL,NULL),(490,12,'poufs','POUFS','http://vcs.ashtexsolutions.com/collections/3/Collections',NULL,NULL,1,NULL,NULL,NULL),(491,12,'baskets','BASKETS','http://vcs.ashtexsolutions.com/collections/8/Collections',NULL,NULL,1,NULL,NULL,NULL),(492,13,'rugs','SHOP RUGS','http://vcs.ashtexsolutions.com/collections/1/Collections','https://lrresources.com/media/images/outdoor-rug.jpg',NULL,1,NULL,NULL,NULL),(493,13,'pillow','SHOP PILLOWS','http://vcs.ashtexsolutions.com/collections/2/Collections','https://lrresources.com/media/images/outdoor-pillow.jpg',NULL,1,NULL,NULL,NULL),(494,13,'poufs','SHOP POUFS','http://vcs.ashtexsolutions.com/collections/8/Collections','https://lrresources.com/media/images/outdoor-poofs.jpg',NULL,1,NULL,NULL,NULL),(497,14,'our_story','OUR STORY','http://vcs.ashtexsolutions.com/static/ourstory','https://lrresources.com/media/images/our-story.jpg',NULL,1,NULL,NULL,NULL),(498,14,'our_purpose','OUR PURPOSE','http://vcs.ashtexsolutions.com/static/ourpurpose','https://lrresources.com/media/images/our-poups.jpg',NULL,1,NULL,NULL,NULL),(499,15,'become_partner','Become A Partner','http://vcs.ashtexsolutions.com/register',NULL,NULL,1,NULL,NULL,NULL),(500,15,'our_story','Our Story','http://vcs.ashtexsolutions.com/static/ourstory',NULL,NULL,1,NULL,NULL,NULL),(501,15,'our_purpose','Our Purpose','http://vcs.ashtexsolutions.com/static/ourpurpose',NULL,NULL,1,NULL,NULL,NULL),(502,16,'rugs','Rugs','http://vcs.ashtexsolutions.com/collections/1/Collections',NULL,NULL,1,NULL,NULL,NULL),(503,16,'pillows_decor','Pillows & Decor','http://vcs.ashtexsolutions.com/collections/2/Collections',NULL,NULL,1,NULL,NULL,NULL),(504,16,'furniture','Furniture','http://vcs.ashtexsolutions.com/collections/3/Collections',NULL,NULL,1,NULL,NULL,NULL),(505,16,'outdoor','Outdoor','http://vcs.ashtexsolutions.com/collections/8/Collections',NULL,NULL,1,NULL,NULL,NULL),(506,17,'catalog_2021','Catalog 2021','https://lrresources.com/catalog-2021/index.html',NULL,NULL,1,NULL,NULL,NULL),(507,17,'catalog_accents','Catalog Accents','https://lrresources.com/accentes-catalog/index.html',NULL,NULL,1,NULL,NULL,NULL),(511,18,'contact_us','Contact Us','http://vcs.ashtexsolutions.com/static/contactus#contact-us',NULL,NULL,1,NULL,NULL,NULL),(512,18,'customer_service','Customer Service','http://vcs.ashtexsolutions.com/static/contactus#Service',NULL,NULL,1,NULL,NULL,NULL),(513,18,'showroom_markets','Showrooms & Markets','http://vcs.ashtexsolutions.com/static/contactus#Showrooms',NULL,NULL,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `menu_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` bigint(20) DEFAULT NULL,
  `name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,2,'PRODUCT','mega_header',1,'2021-12-12 19:27:42','2021-12-21 07:05:02',NULL),(2,2,'Main Top Header','main_header',1,'2021-12-12 19:27:42','2021-12-21 07:06:14',NULL),(3,2,'Products','first_footer',1,'2021-12-12 19:27:42','2021-12-21 07:07:50',NULL),(4,2,'Quick Services','second_footer',1,'2021-12-12 19:27:42','2021-12-21 07:08:39',NULL),(5,2,'Company Info','third_footer',1,'2021-12-12 19:27:42','2021-12-21 07:09:23',NULL),(6,1,'RUGS','rug_header',1,'2021-12-12 19:33:05','2021-12-31 22:47:22',NULL),(7,1,'RUGS IMAGES','rug_shop_header',1,'2021-12-12 19:33:05','2021-12-31 22:47:22',NULL),(8,1,'HOME DECOR','pillow_header',1,'2021-12-12 19:33:05','2021-12-31 22:52:30',NULL),(9,1,'PILLOW IMAGES','pillow_shop_header',1,'2021-12-12 19:33:05','2021-12-31 22:55:22',NULL),(10,1,'LIVING ROOM','furniture_header',1,'2021-12-12 19:33:05','2021-12-31 22:59:53',NULL),(11,1,'FURNITURE IMAGES','furniture_shop_header',1,'2021-12-12 19:33:05','2021-12-31 23:01:12',NULL),(12,1,'OUTDOOR','outdoor_header',1,'2021-12-12 19:33:05','2021-12-31 23:02:18',NULL),(13,1,'OUTDOOR IMAGES','outdoor_shop_header',1,'2021-12-12 19:33:05','2021-12-31 23:03:27',NULL),(14,1,'ABOUT US IMAGES','aboutus_header',1,'2021-12-12 19:33:05','2021-12-31 23:05:46',NULL),(15,1,'ABOUT US','first_footer',1,'2021-12-12 19:33:05','2021-12-31 23:06:35',NULL),(16,1,'PRODUCT CATEGORY','second_footer',1,'2021-12-12 19:33:05','2021-12-31 23:07:15',NULL),(17,1,'RESOURCES','third_footer',1,'2021-12-12 19:33:05','2021-12-31 23:07:51',NULL),(18,1,'CONTACT US','fourth_footer',1,'2021-12-12 19:33:05','2022-01-01 14:53:15',NULL),(20,1,'PETS','pet_header',1,'2021-12-31 22:47:22','2021-12-31 22:53:27',NULL),(21,1,'DINING ROOM','dining_header',1,'2021-12-31 22:47:22','2021-12-31 22:59:24',NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
 SET character_set_client = utf8mb4 ;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,2,'Home','home',1,'2021-12-12 19:27:42','2021-12-12 19:27:42',NULL),(2,1,'Home','home',1,'2021-12-12 19:33:04','2021-12-12 19:33:04',NULL),(3,2,'All Pages Common','all_pages',1,'2021-12-31 22:09:33','2021-12-31 22:09:33',NULL),(4,1,'All Pages Common','all_pages',1,'2021-12-31 22:11:22','2021-12-31 22:11:22',NULL);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section_metas`
--

DROP TABLE IF EXISTS `section_metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
) ENGINE=InnoDB AUTO_INCREMENT=1036 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_metas`
--

LOCK TABLES `section_metas` WRITE;
/*!40000 ALTER TABLE `section_metas` DISABLE KEYS */;
INSERT INTO `section_metas` VALUES (260,5,'title_top','About','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(261,5,'title_bottom','Rizzy Home','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(262,5,'description','The direct result of collaboration between two entrepreneurial brothers, Rizzy Home is the combined effort of Rizwan and Shamsu Ansari. Originally started as Rizzy Rugs and Home Texco, Rizzy Home now offers an extensive assortment of rugs.','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(263,5,'video','https://www.youtube.com/embed/dgWzTvRhBkU','2021-12-13 08:09:10','2021-12-13 08:09:10',NULL),(782,2,'caption','Follow our blog for the latest trends, home tips, and touching stories from Textile Talker, Teresa','2021-12-21 07:11:50','2021-12-21 07:11:50',NULL),(783,2,'button_title','FIND OUT MORE','2021-12-21 07:11:50','2021-12-21 07:11:50',NULL),(784,2,'button_url','http://vcs.ashtexsolutions.com/filters/NewArrivals','2021-12-21 07:11:50','2021-12-21 07:11:50',NULL),(785,2,'image','https://rizzyhome.ashtexsolutions.com/images/lets.jpg','2021-12-21 07:11:50','2021-12-21 07:11:50',NULL),(786,3,'caption',NULL,'2021-12-21 07:12:20','2021-12-21 07:12:20',NULL),(787,3,'prod_1_title','Rugs','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(788,3,'prod_1_caption',NULL,'2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(789,3,'prod_1_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(790,3,'prod_1_url','http://vcs.ashtexsolutions.com/favourites/1','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(791,3,'prod_2_title','Pillows','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(792,3,'prod_2_caption',NULL,'2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(793,3,'prod_2_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(794,3,'prod_2_url','http://vcs.ashtexsolutions.com/favourites/2','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(795,3,'prod_3_title','Bedding','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(796,3,'prod_3_caption',NULL,'2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(797,3,'prod_3_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(798,3,'prod_3_url','http://vcs.ashtexsolutions.com/favourites/3','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(799,3,'prod_4_title','Throws','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(800,3,'prod_4_caption',NULL,'2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(801,3,'prod_4_image','https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/HomePage_CategoryImage_Throws.jpg','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(802,3,'prod_4_url','http://vcs.ashtexsolutions.com/favourites/8','2021-12-21 07:12:21','2021-12-21 07:12:21',NULL),(806,4,'caption','We make rugs for the thoughtfully layered home. For spaces designed with intention. For people that know a good rug doesn’t just tie the room together—it sets the home apart.','2021-12-21 07:12:36','2021-12-21 07:12:36',NULL),(807,4,'button_text','LEARN MORE ABOUT US','2021-12-21 07:12:36','2021-12-21 07:12:36',NULL),(808,4,'button_url','http://vcs.ashtexsolutions.com/static/aboutus','2021-12-21 07:12:36','2021-12-21 07:12:36',NULL),(809,6,'image_1_title',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(810,6,'image_1_caption',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(811,6,'image_1_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(812,6,'image_1_url',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(813,6,'image_2_title',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(814,6,'image_2_caption',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(815,6,'image_2_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(816,6,'image_2_url',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(817,6,'image_3_title',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(818,6,'image_3_caption',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(819,6,'image_3_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(820,6,'image_3_url',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(821,6,'image_4_title',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(822,6,'image_4_caption',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(823,6,'image_4_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(824,6,'image_4_url',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(825,6,'image_5_title',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(826,6,'image_5_caption',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(827,6,'image_5_image','http://rizzyhome.ashtexsolutions.com/images/social/social2.jpg','2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(828,6,'image_5_url',NULL,'2021-12-21 07:12:56','2021-12-21 07:12:56',NULL),(898,1,'image_1_title','See What\'s New','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(899,1,'image_1_caption','2021','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(900,1,'image_1_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_left.jpg','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(901,1,'image_1_url','http://vcs.ashtexsolutions.com/filters/NewArrivals/','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(902,1,'image_2_title','Top Sellers','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(903,1,'image_2_caption',NULL,'2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(904,1,'image_2_image','https://rizzyhome.ashtexsolutions.com/images/lets.jpg','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(905,1,'image_2_url','http://vcs.ashtexsolutions.com/filters/TopSellers','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(906,1,'image_3_title','Donny Osmond Home','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(907,1,'image_3_caption',NULL,'2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(908,1,'image_3_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_top_right.jpg','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(909,1,'image_3_url','http://vcs.ashtexsolutions.com/filters/NewArrivals/','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(910,1,'image_4_title','Recycled Products','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(911,1,'image_4_caption',NULL,'2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(912,1,'image_4_image','https://rizzyhome.ashtexsolutions.com/storage/home/1/image_bottom.jpg','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(913,1,'image_4_url','http://vcs.ashtexsolutions.com/filters/NewArrivals/','2021-12-31 22:09:56','2021-12-31 22:09:56',NULL),(914,12,'insta_url','https://www.instagram.com/RizzyHome/','2021-12-31 22:11:09','2021-12-31 22:11:09',NULL),(915,12,'facebook_url','https://www.facebook.com/RizzyHome/','2021-12-31 22:11:09','2021-12-31 22:11:09',NULL),(916,12,'pinterest_url','javascript:void(0);','2021-12-31 22:11:09','2021-12-31 22:11:09',NULL),(917,12,'twitter_url','https://twitter.com/RizzyHome','2021-12-31 22:11:09','2021-12-31 22:11:09',NULL),(918,12,'linkedin_url','https://www.linkedin.com/','2021-12-31 22:11:09','2021-12-31 22:11:09',NULL),(934,13,'menu_1_caption','RUGS','2021-12-31 22:15:13','2021-12-31 22:15:13',NULL),(935,13,'menu_1_url','http://vcs.ashtexsolutions.com/favourite/1','2021-12-31 22:15:13','2021-12-31 22:15:13',NULL),(936,13,'menu_2_caption','PILLOWS & DECOR','2021-12-31 22:15:13','2021-12-31 22:15:13',NULL),(937,13,'menu_2_url','http://vcs.ashtexsolutions.com/favourite/2','2021-12-31 22:15:13','2021-12-31 22:15:13',NULL),(938,13,'menu_3_caption','FURNITURE','2021-12-31 22:15:13','2021-12-31 22:15:13',NULL),(939,13,'menu_3_url','http://vcs.ashtexsolutions.com/favourite/3','2021-12-31 22:15:13','2021-12-31 22:15:13',NULL),(940,13,'menu_4_caption','OUTDOOR','2021-12-31 22:15:13','2021-12-31 22:15:13',NULL),(941,13,'menu_4_url','http://vcs.ashtexsolutions.com/favourite/8','2021-12-31 22:15:13','2021-12-31 22:15:13',NULL),(942,13,'menu_5_caption','ABOUT US','2021-12-31 22:15:13','2021-12-31 22:15:13',NULL),(943,13,'menu_5_url','http://vcs.ashtexsolutions.com/static/aboutus','2021-12-31 22:15:13','2021-12-31 22:15:13',NULL),(944,14,'insta_url','https://www.instagram.com/lrhomeus/','2021-12-31 22:16:27','2021-12-31 22:16:27',NULL),(945,14,'facebook_url','https://www.facebook.com/lrhomeus','2021-12-31 22:16:27','2021-12-31 22:16:27',NULL),(946,14,'pinterest_url','https://www.pinterest.com/lrhomeus','2021-12-31 22:16:27','2021-12-31 22:16:27',NULL),(947,14,'twitter_url','https://twitter.com/lrhomeus','2021-12-31 22:16:27','2021-12-31 22:16:27',NULL),(948,14,'linkedin_url','https://linkedin.com/company/lrhomeus/','2021-12-31 22:16:27','2021-12-31 22:16:27',NULL),(980,9,'image_1_title','Rugs','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(981,9,'image_1_caption','Fusing transitional elegance with modern influence, our rug selection boasts artisanal quality gems at accessible price points','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(982,9,'image_1_image','https://lrresources.com/media/images/featured-product/df-1.png','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(983,9,'image_1_url','http://vcs.ashtexsolutions.com/favourites/1','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(984,9,'image_2_title','Pillows','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(985,9,'image_2_caption','Fusing transitional elegance with modern influence, our rug selection boasts artisanal quality gems at accessible price points','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(986,9,'image_2_image','https://lrresources.com/media/images/featured-product/df-2.png','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(987,9,'image_2_url','http://vcs.ashtexsolutions.com/favourites/2','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(988,9,'image_3_title','Furniture','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(989,9,'image_3_caption','Our newly launched furniture selection is a passion project centered around providing the most comprehensive catalog to our customers - Check it out and let us know what you think!','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(990,9,'image_3_image','https://lrresources.com/media/images/featured-product/df-3.png','2021-12-31 23:23:44','2021-12-31 23:23:44',NULL),(991,9,'image_3_url','http://vcs.ashtexsolutions.com/favourites/3','2021-12-31 23:23:45','2021-12-31 23:23:45',NULL),(992,10,'caption','See What\'s New This Season','2021-12-31 23:24:47','2021-12-31 23:24:47',NULL),(993,10,'title','Catalog 2021','2021-12-31 23:24:47','2021-12-31 23:24:47',NULL),(994,10,'button_text','Browse E-catalog','2021-12-31 23:24:47','2021-12-31 23:24:47',NULL),(995,10,'button_url','https://lrresources.com/catalog-2021/index.html','2021-12-31 23:24:47','2021-12-31 23:24:47',NULL),(996,10,'catalog_img','https://lrresources.com/media/images/catlog.jpg','2021-12-31 23:24:47','2021-12-31 23:24:47',NULL),(997,11,'title','APPLY TO BECOME A LR HOME PARTNER','2021-12-31 23:25:24','2021-12-31 23:25:24',NULL),(998,11,'button_text','Apply Now','2021-12-31 23:25:24','2021-12-31 23:25:24',NULL),(999,11,'button_url','http://vcs.ashtexsolutions.com/register/','2021-12-31 23:25:24','2021-12-31 23:25:24',NULL),(1008,7,'caption_1','L R HOME','2021-12-31 23:39:34','2021-12-31 23:39:34',NULL),(1009,7,'caption_2','View All New Collections','2021-12-31 23:39:34','2021-12-31 23:39:34',NULL),(1010,7,'image','https://lrresources.com/media/images/banner-img.jpg','2021-12-31 23:39:34','2021-12-31 23:39:34',NULL),(1011,7,'url','http://vcs.ashtexsolutions.com/maincollection','2021-12-31 23:39:34','2021-12-31 23:39:34',NULL),(1012,8,'image_1_title','Pillows','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1013,8,'image_1_caption',NULL,'2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1014,8,'image_1_image','https://lrresources.com/media/images/product/4.jpg','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1015,8,'image_1_url','http://vcs.ashtexsolutions.com/favourites/2','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1016,8,'image_2_title','Throws','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1017,8,'image_2_caption',NULL,'2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1018,8,'image_2_image','https://lrresources.com/media/images/product/5.jpg','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1019,8,'image_2_url','http://vcs.ashtexsolutions.com/favourites/8','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1020,8,'image_3_title','Poufs','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1021,8,'image_3_caption',NULL,'2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1022,8,'image_3_image','https://lrresources.com/media/images/product/6.jpg','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1023,8,'image_3_url','http://vcs.ashtexsolutions.com/favourites/8','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1024,8,'image_4_title','Naturals','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1025,8,'image_4_caption',NULL,'2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1026,8,'image_4_image','https://lrresources.com/media/images/product/1.jpg','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1027,8,'image_4_url','http://vcs.ashtexsolutions.com/favourites/3','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1028,8,'image_5_title','Machine Made','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1029,8,'image_5_caption',NULL,'2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1030,8,'image_5_image','https://lrresources.com/media/images/product/2.jpg','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1031,8,'image_5_url','http://vcs.ashtexsolutions.com/favourites/2','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1032,8,'image_6_title','Indoor Outdoor','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1033,8,'image_6_caption',NULL,'2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1034,8,'image_6_image','https://lrresources.com/media/images/product/3.jpg','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL),(1035,8,'image_6_url','http://vcs.ashtexsolutions.com/favourites/1','2021-12-31 23:52:28','2021-12-31 23:52:28',NULL);
/*!40000 ALTER TABLE `section_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'New Arrival','new_arrival',1,1,'2021-12-12 19:27:42','2021-12-31 22:09:56',NULL),(2,'Let\'s Get Rizzy','new_additions',1,1,'2021-12-12 19:27:42','2021-12-31 22:09:33',NULL),(3,'Our Products','our_products',1,1,'2021-12-12 19:27:42','2021-12-21 07:12:20',NULL),(4,'Learn More','learn_more',1,1,'2021-12-12 19:27:42','2021-12-21 07:12:36',NULL),(5,'About Rizzy','about_rizzy',1,1,'2021-12-12 19:27:42','2021-12-13 08:09:10',NULL),(6,'Rizzy Home','rizzy_home',1,1,'2021-12-12 19:27:42','2021-12-21 07:12:56',NULL),(7,'Banner','banner',2,1,'2021-12-12 19:33:04','2021-12-31 23:39:34',NULL),(8,'KEY CATEGORIES','key_categories',2,1,'2021-12-12 19:33:04','2021-12-31 23:52:28',NULL),(9,'NEW ARRIVALS','new_arrivals',2,1,'2021-12-12 19:33:05','2021-12-31 23:23:44',NULL),(10,'Catalog','catalog',2,1,'2021-12-12 19:33:05','2021-12-31 23:24:47',NULL),(11,'Partnership','partnership',2,1,'2021-12-12 19:33:05','2021-12-31 23:25:24',NULL),(12,'Footer Social media Items','footer_social_media',3,1,'2021-12-31 22:09:33','2021-12-31 22:11:09',NULL),(13,'Main Top Menu','main_top_menu',4,1,'2021-12-31 22:11:22','2021-12-31 22:15:13',NULL),(14,'Footer Social media Items','footer_social_media',4,1,'2021-12-31 22:11:22','2021-12-31 22:16:27',NULL);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider_metas`
--

DROP TABLE IF EXISTS `slider_metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider_metas`
--

LOCK TABLES `slider_metas` WRITE;
/*!40000 ALTER TABLE `slider_metas` DISABLE KEYS */;
INSERT INTO `slider_metas` VALUES (1,'Create your own','Unique space','storage/wx7fIpogaiFPQSK7PGlcIIHov3OXAAwbohtyBcBj.jpg',1,1,'2021-12-13 07:49:16','2022-01-01 10:13:02',NULL),(2,'Create your own','Unique space','storage/o6LaQderlsz33YvFPqWXQVknabn804Q7ZnALRMfD.jpg',1,1,'2021-12-13 07:52:06','2022-01-01 10:13:35',NULL);
/*!40000 ALTER TABLE `slider_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
INSERT INTO `themes` VALUES (1,'LR Resources','lr','lr','LR','api-slug-lr','http://122.129.80.188/SPARS.API.DEV/api/Service/','{\"theme_name\":\"LR Resources\",\"theme_slug\":\"lr\",\"theme_abrv\":\"LR\",\"theme_api_slug\":\"api-slug-lr\",\"theme_api_base_url\":\"http:\\/\\/122.129.80.188\\/SPARS.API.DEV\\/api\\/Service\\/\",\"theme_api_key\":\"64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d\",\"theme_api_company\":\"LRResources\",\"theme_api_image_url\":\"https:\\/\\/rizzyhome-images.ashtexsolutions.com\\/RizzyHome_B2BImages\\/Images\\/Full_Img\\/\",\"theme_api_thumbnail_url\":\"https:\\/\\/rizzyhome-images.ashtexsolutions.com\\/RizzyHome_B2BImages\\/Images\\/Thumbnail_Img\\/\",\"pages\":{\"all_pages\":{\"title\":\"All Pages Common\",\"slug\":\"all_pages\",\"sections\":{\"main_top_menu\":{\"slug\":\"main_top_menu\",\"title\":\"Main Top Menu\",\"metas\":{\"menu_1_caption\":\"text\",\"menu_1_url\":\"text\",\"menu_2_caption\":\"text\",\"menu_2_url\":\"text\",\"menu_3_caption\":\"text\",\"menu_3_url\":\"text\",\"menu_4_caption\":\"text\",\"menu_4_url\":\"text\",\"menu_5_caption\":\"text\",\"menu_5_url\":\"text\"}},\"footer_social_media\":{\"slug\":\"footer_social_media\",\"title\":\"Footer Social media Items\",\"metas\":{\"insta_url\":\"text\",\"facebook_url\":\"text\",\"pinterest_url\":\"text\",\"twitter_url\":\"text\",\"linkedin_url\":\"text\"}}}},\"home\":{\"title\":\"Home\",\"slug\":\"home\",\"sections\":{\"banner\":{\"slug\":\"banner\",\"title\":\"Banner\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"file\",\"url\":\"url\"}},\"key_categories\":{\"slug\":\"key_categories\",\"title\":\"KEY CATEGORIES\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\",\"image_5_title\":\"text\",\"image_5_caption\":\"text\",\"image_5_image\":\"url\",\"image_5_url\":\"url\",\"image_6_title\":\"text\",\"image_6_caption\":\"text\",\"image_6_image\":\"url\",\"image_6_url\":\"url\"}},\"new_arrivals\":{\"slug\":\"new_arrivals\",\"title\":\"NEW ARRIVALS\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\"}},\"catalog\":{\"slug\":\"catalog\",\"title\":\"Catalog\",\"metas\":{\"caption\":\"text\",\"title\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\",\"catalog_img\":\"url\"}},\"partnership\":{\"slug\":\"partnership\",\"title\":\"Partnership\",\"metas\":{\"title\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\"}}}}},\"sliders\":{\"lr_slider\":{\"slug\":\"lr_slider\",\"title\":\"LR Slider\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}}},\"forms\":{\"contact_us\":{\"slug\":\"contact_us\",\"title\":\"Contact Us\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}}},\"menus\":{\"rug_header\":{\"slug\":\"rug_header\",\"title\":\"RUGS\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"rug_shop_header\":{\"slug\":\"rug_shop_header\",\"title\":\"RUGS IMAGES\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"pillow_header\":{\"slug\":\"pillow_header\",\"title\":\"HOME DECOR\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"pet_header\":{\"slug\":\"pet_header\",\"title\":\"PETS\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"pillow_shop_header\":{\"slug\":\"pillow_shop_header\",\"title\":\"PILLOW IMAGES\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"furniture_header\":{\"slug\":\"furniture_header\",\"title\":\"LIVING ROOM\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"dining_header\":{\"slug\":\"dining_header\",\"title\":\"DINING ROOM\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"furniture_shop_header\":{\"slug\":\"furniture_shop_header\",\"title\":\"FURNITURE IMAGES\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"outdoor_header\":{\"slug\":\"outdoor_header\",\"title\":\"OUTDOOR\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"outdoor_shop_header\":{\"slug\":\"outdoor_shop_header\",\"title\":\"OUTDOOR IMAGES\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"aboutus_header\":{\"slug\":\"aboutus_header\",\"title\":\"ABOUT US IMAGES\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"first_footer\":{\"slug\":\"first_footer\",\"title\":\"ABOUT US\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"second_footer\":{\"slug\":\"second_footer\",\"title\":\"PRODUCT CATEGORY\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"third_footer\":{\"slug\":\"third_footer\",\"title\":\"RESOURCES\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"fourth_footer\":{\"slug\":\"fourth_footer\",\"title\":\"CONTACT US\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}}}}','64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d','LRResources',1,'2021-12-12 19:27:38','2022-01-01 14:15:14',NULL),(2,'Rizzy Home','rzy','rzy','RZY','api-slug-rzy','http://122.129.80.188/SPARS.API.Client/api/Service/','{\"theme_name\":\"Rizzy Home\",\"theme_slug\":\"rzy\",\"theme_abrv\":\"RZY\",\"theme_api_slug\":\"api-slug-rzy\",\"theme_api_base_url\":\"http:\\/\\/122.129.80.188\\/SPARS.API.Client\\/api\\/Service\\/\",\"theme_api_key\":\"64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d\",\"theme_api_company\":\"LRResources\",\"theme_api_image_url\":\"https:\\/\\/rizzyhome-images.ashtexsolutions.com\\/RizzyHome_B2BImages\\/Images\\/Full_Img\\/\",\"theme_api_thumbnail_url\":\"https:\\/\\/rizzyhome-images.ashtexsolutions.com\\/RizzyHome_B2BImages\\/Images\\/Thumbnail_Img\\/\",\"pages\":{\"all_pages\":{\"title\":\"All Pages Common\",\"slug\":\"all_pages\",\"sections\":{\"footer_social_media\":{\"slug\":\"footer_social_media\",\"title\":\"Footer Social media Items\",\"metas\":{\"insta_url\":\"text\",\"facebook_url\":\"text\",\"pinterest_url\":\"text\",\"twitter_url\":\"text\",\"linkedin_url\":\"text\"}}}},\"home\":{\"title\":\"Home\",\"slug\":\"home\",\"sections\":{\"new_arrival\":{\"slug\":\"new_arrival\",\"title\":\"New Arrival\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\"}},\"new_additions\":{\"slug\":\"new_additions\",\"title\":\"Let\'s Get Rizzy\",\"metas\":{\"caption\":\"text\",\"button_title\":\"text\",\"button_url\":\"url\",\"image\":\"url\"}},\"our_products\":{\"slug\":\"our_products\",\"title\":\"Our Products\",\"metas\":{\"caption\":\"text\",\"prod_1_title\":\"text\",\"prod_1_caption\":\"text\",\"prod_1_image\":\"url\",\"prod_1_url\":\"url\",\"prod_2_title\":\"text\",\"prod_2_caption\":\"text\",\"prod_2_image\":\"url\",\"prod_2_url\":\"url\",\"prod_3_title\":\"text\",\"prod_3_caption\":\"text\",\"prod_3_image\":\"url\",\"prod_3_url\":\"url\",\"prod_4_title\":\"text\",\"prod_4_caption\":\"text\",\"prod_4_image\":\"url\",\"prod_4_url\":\"url\"}},\"learn_more\":{\"slug\":\"learn_more\",\"title\":\"Learn More\",\"metas\":{\"caption\":\"text\",\"button_text\":\"text\",\"button_url\":\"url\"}},\"about_rizzy\":{\"slug\":\"about_rizzy\",\"title\":\"About Rizzy\",\"metas\":{\"title_top\":\"text\",\"title_bottom\":\"text\",\"description\":\"text\",\"video\":\"url\"}},\"rizzy_home\":{\"slug\":\"rizzy_home\",\"title\":\"Rizzy Home\",\"metas\":{\"image_1_title\":\"text\",\"image_1_caption\":\"text\",\"image_1_image\":\"url\",\"image_1_url\":\"url\",\"image_2_title\":\"text\",\"image_2_caption\":\"text\",\"image_2_image\":\"url\",\"image_2_url\":\"url\",\"image_3_title\":\"text\",\"image_3_caption\":\"text\",\"image_3_image\":\"url\",\"image_3_url\":\"url\",\"image_4_title\":\"text\",\"image_4_caption\":\"text\",\"image_4_image\":\"url\",\"image_4_url\":\"url\",\"image_5_title\":\"text\",\"image_5_caption\":\"text\",\"image_5_image\":\"url\",\"image_5_url\":\"url\"}}}}},\"sliders\":{\"home_slider\":{\"slug\":\"home_slider\",\"title\":\"Home Slider\",\"metas\":{\"caption_1\":\"text\",\"caption_2\":\"text\",\"image\":\"url\"}}},\"forms\":{\"contact_us\":{\"slug\":\"contact_us\",\"title\":\"Contact Us\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}},\"feedback\":{\"slug\":\"feedback\",\"title\":\"Feedback\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}},\"careers\":{\"slug\":\"careers\",\"title\":\"Careers\",\"metas\":{\"fullname\":\"text\",\"email\":\"text\",\"company\":\"text\",\"phone\":\"number\",\"Inquiry\":\"para\"}}},\"menus\":{\"mega_header\":{\"slug\":\"mega_header\",\"title\":\"PRODUCT\",\"view_all\":\"1\",\"view_all_type\":\"maincollection\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"main_header\":{\"slug\":\"main_header\",\"title\":\"Main Top Header\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"first_footer\":{\"slug\":\"first_footer\",\"title\":\"Products\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"second_footer\":{\"slug\":\"second_footer\",\"title\":\"Quick Services\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}},\"third_footer\":{\"slug\":\"third_footer\",\"title\":\"Company Info\",\"metas\":{\"key\":\"text\",\"title\":\"text\",\"url\":\"url\",\"image\":\"image\",\"parent_key\":\"text\"}}}}','64d3b4ae-dba9-47b2-bf88-f72dfbae0e9d','LRResources',0,'2021-12-12 19:27:38','2022-01-01 14:15:14',NULL);
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spars_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
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
  `role` enum('admin','customer','staff') COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `sales_rep_customers` text COLLATE utf8mb4_unicode_ci,
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'$2y$10$Os4.fCnTxhgNvv0ifric6e.oXyIbFlYjBxBxMqFR27r8uvORh7Tya','SPARSC',NULL,NULL,'Usman','Ashraf','admin@gmail.com','Test Company','','',NULL,NULL,NULL,'',1,1,'customer','{\"Customers\":[{\"CustomerID\":\"SPARSC\",\"CompanyName\":\"sparsUS\"},{\"CustomerID\":\"SPARSR\",\"CompanyName\":\"spars (DELETD)\"}]}','s:217:\"{\"_token\":\"NIRFkVFa6twVPPcsnuSx0UTM4DMbJTpjWidZ2OB2\",\"firstname\":\"Usman\",\"lastname\":\"Ashraf\",\"email\":\"admin@gmail.com\",\"company\":\"Test Company\",\"phone\":null,\"street_address\":null,\"postal_code\":null,\"description\":null}\";',NULL,'2021-12-20 11:54:15',NULL),(2,'$2y$10$0kl6c2LT0.euBs1fLcYxVevokCS3rUuYAtFYCILwuSffcWqqqBtE.','SPARSC',NULL,1,'Adil','Waqas','dsdas@dsdas.com',NULL,NULL,NULL,NULL,NULL,NULL,'3123123',0,1,'staff','{\"Customers\":[{\"CustomerID\":\"SPARSC\",\"CompanyName\":\"sparsUS\"},{\"CustomerID\":\"SPARSR\",\"CompanyName\":\"spars (DELETD)\"}]}','s:289:\"{\"_token\":\"NIRFkVFa6twVPPcsnuSx0UTM4DMbJTpjWidZ2OB2\",\"user\":null,\"firstname\":\"Adil\",\"lastname\":\"Waqas\",\"email\":\"dsdas@dsdas.com\",\"phone\":\"3123123\",\"password\":\"12345678\",\"cpassword\":\"12345678\",\"status\":\"active\",\"permissions\":[\"manage-orders\",\"manage-invoices\"],\"description\":\"dsadsadasdsa\"}\";','2021-12-20 11:55:54',NULL,NULL),(3,'$2y$10$hwiGHlQLF3ZAxfeCk/qGceHhzkFR0VDl6M5TUTJ68B4sKUJPQ7LBK','SPARSC',NULL,1,'Idrees','Mughal','idrees@vcs.com',NULL,NULL,NULL,NULL,NULL,NULL,'879879687',0,0,'staff','{\"Customers\":[{\"CustomerID\":\"SPARSC\",\"CompanyName\":\"sparsUS\"},{\"CustomerID\":\"SPARSR\",\"CompanyName\":\"spars (DELETD)\"}]}','s:305:\"{\"_token\":\"a6DjpG61p8dPkWTsiODyA5iiISgLzaSWAMc3d1eo\",\"user\":null,\"firstname\":\"Idrees\",\"lastname\":\"Mughal\",\"email\":\"idrees@vcs.com\",\"phone\":\"879879687\",\"password\":\"12345678\",\"cpassword\":\"12345678\",\"status\":\"active\",\"permissions\":[\"manage-orders\",\"manage-frieght\"],\"description\":\"This is an idrees account\"}\";','2021-12-21 09:00:27',NULL,NULL),(4,'$2y$10$1ejN6jZ/SyPdal5d4PBXsOuIi/L09mV3v3HNfYbbSDUwrsB4qeMpu','SPARSC',NULL,1,'Asfand','Jamil','jangjua@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,'12311',0,1,'staff','{\"Customers\":[{\"CustomerID\":\"SPARSC\",\"CompanyName\":\"sparsUS\"},{\"CustomerID\":\"SPARSR\",\"CompanyName\":\"spars (DELETD)\"}]}','s:298:\"{\"_token\":\"TgaX7PRVz2vizVDQG4rgT8nhCWr8DueZIaI16oAx\",\"user\":null,\"firstname\":\"Asfand\",\"lastname\":\"Jamil\",\"email\":\"jangjua@gmail.com\",\"phone\":\"12311\",\"password\":\"asdasdasd\",\"cpassword\":\"asdasdasd\",\"status\":\"active\",\"permissions\":[\"manage-staff\",\"manage-invoices\",\"manage-claims\"],\"description\":null}\";','2022-01-01 14:47:14',NULL,NULL);
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

-- Dump completed on 2022-01-01 20:06:47
