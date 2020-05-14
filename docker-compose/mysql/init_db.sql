-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: mystrath
-- ------------------------------------------------------
-- Server version	5.7.30

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
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activations` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `activations_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_activations`
--

DROP TABLE IF EXISTS `admin_activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_activations` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `admin_activations_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_activations`
--

LOCK TABLES `admin_activations` WRITE;
/*!40000 ALTER TABLE `admin_activations` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_password_resets`
--

DROP TABLE IF EXISTS `admin_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `admin_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_password_resets`
--

LOCK TABLES `admin_password_resets` WRITE;
/*!40000 ALTER TABLE `admin_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `forbidden` tinyint(1) NOT NULL DEFAULT '0',
  `language` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_email_deleted_at_unique` (`email`,`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'smaosa',NULL,'Sam','Maosa','smaosa@strathmore.edu','$2y$10$PHVp60S9OIIoosbXwsP2xuSTooCF8GhxtXWhKwUgdtf02F/pJlPCS','KwP56XtGo9gnH3FHYNNs9LTJntdXT1WbxzEw0GDtwuSQoXJPVoJn5GBQEOSr',1,0,'en',NULL,'2020-05-12 12:06:37','2020-05-12 12:58:41');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audits`
--

DROP TABLE IF EXISTS `audits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) unsigned NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audits`
--

LOCK TABLES `audits` WRITE;
/*!40000 ALTER TABLE `audits` DISABLE KEYS */;
/*!40000 ALTER TABLE `audits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint(20) unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'Savannabits\\AdminAuth\\Models\\AdminUser',1,'avatar','avatar','avatar.png','image/png','media',23924,'[]','{\"generated_conversions\": {\"thumb_75\": true, \"thumb_150\": true, \"thumb_200\": true}}','[]',1,'2020-05-12 12:06:37','2020-05-12 12:06:38');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2017_08_24_000000_create_activations_table',1),(3,'2017_08_24_000000_create_admin_activations_table',1),(4,'2017_08_24_000000_create_admin_password_resets_table',1),(5,'2017_08_24_000000_create_admin_users_table',1),(6,'2018_07_18_000000_create_wysiwyg_media_table',1),(7,'2019_08_19_000000_create_failed_jobs_table',1),(8,'2019_12_14_000001_create_personal_access_tokens_table',1),(9,'2020_05_12_120554_create_media_table',1),(10,'2020_05_12_120554_create_permission_tables',1),(11,'2020_05_12_120559_fill_default_admin_user_and_permissions',1),(12,'2020_05_12_120554_create_translations_table',2),(13,'2020_05_12_123123_create_audits_table',3),(14,'2020_05_12_123224_add_ldap_columns_to_users_table',3),(15,'2014_10_12_100000_create_password_resets_table',4),(16,'2020_05_12_125617_create_sessions_table',4),(17,'2020_05_12_125623_create_jobs_table',4),(18,'2020_05_13_124703_fill_user_permissions',5),(19,'2020_05_13_132435_fill_web_permissions_for_role',6),(20,'2020_05_13_132804_initiate_web_admin',7),(21,'2020_05_13_132911_grant_all_perms_to_web_admin',8),(22,'2020_05_13_133809_give_admin_on_first_web_user',9),(23,'2020_05_13_174016_fill_web_permissions_for_permission',10),(24,'2020_05_14_105602_add_group_to_permissions_table',11),(25,'2020_05_14_105832_populate_group_in_permissions',11),(26,'2020_05_14_113833_create_service_endpoints_table',12),(27,'2020_05_14_114058_fill_web_permissions_for_service-endpoint',13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (2,'App\\User',1),(1,'Savannabits\\AdminAuth\\Models\\AdminUser',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'admin','admin','2020-05-12 12:06:37','2020-05-14 08:36:58','admin'),(2,'admin.translation.index','admin','2020-05-12 12:06:37','2020-05-14 08:36:59','translation'),(3,'admin.translation.edit','admin','2020-05-12 12:06:37','2020-05-14 08:37:00','translation'),(4,'admin.translation.rescan','admin','2020-05-12 12:06:37','2020-05-14 08:37:00','translation'),(5,'admin.admin-user.index','admin','2020-05-12 12:06:37','2020-05-14 08:37:01','admin-user'),(6,'admin.admin-user.create','admin','2020-05-12 12:06:37','2020-05-14 08:37:02','admin-user'),(7,'admin.admin-user.edit','admin','2020-05-12 12:06:37','2020-05-14 08:37:03','admin-user'),(8,'admin.admin-user.delete','admin','2020-05-12 12:06:37','2020-05-14 08:37:03','admin-user'),(9,'admin.upload','admin','2020-05-12 12:06:37','2020-05-14 08:37:04','admin'),(10,'admin.admin-user.impersonal-login','admin','2020-05-12 12:06:37','2020-05-14 08:37:05','admin-user'),(11,'user','web','2020-05-13 12:49:36','2020-05-14 08:37:05','user'),(12,'user.index','web','2020-05-13 12:49:36','2020-05-14 08:37:06','user'),(13,'user.create','web','2020-05-13 12:49:36','2020-05-14 08:37:07','user'),(14,'user.show','web','2020-05-13 12:49:36','2020-05-14 08:37:07','user'),(15,'user.edit','web','2020-05-13 12:49:36','2020-05-14 08:37:08','user'),(16,'user.delete','web','2020-05-13 12:49:36','2020-05-14 08:37:09','user'),(17,'user.bulk-delete','web','2020-05-13 12:49:36','2020-05-14 08:37:09','user'),(18,'admin.user','admin','2020-05-13 12:49:37','2020-05-14 08:37:10','admin'),(19,'admin.user.index','admin','2020-05-13 12:49:37','2020-05-14 08:37:11','user'),(20,'admin.user.create','admin','2020-05-13 12:49:37','2020-05-14 08:37:11','user'),(21,'admin.user.show','admin','2020-05-13 12:49:37','2020-05-14 08:37:12','user'),(22,'admin.user.edit','admin','2020-05-13 12:49:37','2020-05-14 08:37:13','user'),(23,'admin.user.delete','admin','2020-05-13 12:49:37','2020-05-14 08:37:14','user'),(24,'admin.user.bulk-delete','admin','2020-05-13 12:49:37','2020-05-14 08:37:14','user'),(25,'role','web','2020-05-13 13:24:37','2020-05-14 08:37:15','role'),(26,'role.index','web','2020-05-13 13:24:37','2020-05-14 08:37:16','role'),(27,'role.create','web','2020-05-13 13:24:37','2020-05-14 08:37:17','role'),(28,'role.show','web','2020-05-13 13:24:37','2020-05-14 08:37:17','role'),(29,'role.edit','web','2020-05-13 13:24:37','2020-05-14 08:37:18','role'),(30,'role.delete','web','2020-05-13 13:24:37','2020-05-14 08:37:19','role'),(31,'role.bulk-delete','web','2020-05-13 13:24:37','2020-05-14 08:37:20','role'),(32,'permission','web','2020-05-13 17:40:17','2020-05-14 08:37:20','permission'),(33,'permission.index','web','2020-05-13 17:40:17','2020-05-14 08:37:21','permission'),(34,'permission.create','web','2020-05-13 17:40:17','2020-05-14 08:37:22','permission'),(35,'permission.show','web','2020-05-13 17:40:17','2020-05-14 08:37:23','permission'),(36,'permission.edit','web','2020-05-13 17:40:17','2020-05-14 08:37:23','permission'),(37,'permission.delete','web','2020-05-13 17:40:17','2020-05-14 08:37:24','permission'),(38,'permission.bulk-delete','web','2020-05-13 17:40:17','2020-05-14 08:37:25','permission'),(39,'service-endpoint','web','2020-05-14 11:40:59','2020-05-14 11:40:59','service-endpoint'),(40,'service-endpoint.index','web','2020-05-14 11:40:59','2020-05-14 11:40:59','service-endpoint'),(41,'service-endpoint.create','web','2020-05-14 11:40:59','2020-05-14 11:40:59','service-endpoint'),(42,'service-endpoint.show','web','2020-05-14 11:40:59','2020-05-14 11:40:59','service-endpoint'),(43,'service-endpoint.edit','web','2020-05-14 11:40:59','2020-05-14 11:40:59','service-endpoint'),(44,'service-endpoint.delete','web','2020-05-14 11:40:59','2020-05-14 11:40:59','service-endpoint'),(45,'service-endpoint.bulk-delete','web','2020-05-14 11:40:59','2020-05-14 11:40:59','service-endpoint');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(44,2),(45,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator','admin','2020-05-12 12:06:37','2020-05-12 12:06:37'),(2,'Administrator','web','2020-05-13 13:36:25','2020-05-13 13:36:25');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_endpoints`
--

DROP TABLE IF EXISTS `service_endpoints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_endpoints` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endpoint` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_endpoints_name_unique` (`name`),
  UNIQUE KEY `service_endpoints_endpoint_unique` (`endpoint`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_endpoints`
--

LOCK TABLES `service_endpoints` WRITE;
/*!40000 ALTER TABLE `service_endpoints` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_endpoints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('AcrEqIxUGkii7kkKAL09iHv5f2xsN8cEs0YMH7D8',1,'172.18.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:76.0) Gecko/20100101 Firefox/76.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZ2hCbzFRdGZRNGFoeXF3Z1dDeTVtZHQzbm9sZDJVRjVxdkZTTDRNcCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vY3NtLnN0cmF0aG1vcmUuZWR1L3JvbGVzLzIvZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6ODoiY2FzX3VzZXIiO3M6NjoiU01hb3NhIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1589449598);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `namespace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '*',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` json NOT NULL,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `translations_namespace_index` (`namespace`),
  KEY `translations_group_index` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'savannabits/admin-ui','admin','operation.succeeded','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(2,'savannabits/admin-ui','admin','operation.failed','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(3,'savannabits/admin-ui','admin','operation.not_allowed','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(4,'*','admin','admin-user.columns.username','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(5,'*','admin','admin-user.columns.user_number','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(6,'*','admin','admin-user.columns.first_name','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(7,'*','admin','admin-user.columns.last_name','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(8,'*','admin','admin-user.columns.email','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(9,'*','admin','admin-user.columns.password','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(10,'*','admin','admin-user.columns.password_repeat','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(11,'*','admin','admin-user.columns.activated','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(12,'*','admin','admin-user.columns.forbidden','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(13,'*','admin','admin-user.columns.language','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(14,'savannabits/admin-ui','admin','forms.select_an_option','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(15,'*','admin','admin-user.columns.roles','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(16,'savannabits/admin-ui','admin','forms.select_options','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(17,'*','admin','admin-user.actions.create','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(18,'savannabits/admin-ui','admin','btn.save','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(19,'*','admin','admin-user.actions.edit','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(20,'*','admin','admin-user.actions.index','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(21,'savannabits/admin-ui','admin','placeholder.search','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(22,'savannabits/admin-ui','admin','btn.search','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(23,'*','admin','admin-user.columns.id','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(24,'savannabits/admin-ui','admin','btn.edit','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(25,'savannabits/admin-ui','admin','btn.delete','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(26,'savannabits/admin-ui','admin','pagination.overview','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(27,'savannabits/admin-ui','admin','index.no_items','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(28,'savannabits/admin-ui','admin','index.try_changing_items','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(29,'savannabits/admin-ui','admin','btn.new','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(30,'savannabits/admin-ui','admin','profile_dropdown.account','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(31,'savannabits/admin-auth','admin','profile_dropdown.logout','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(32,'savannabits/admin-ui','admin','sidebar.content','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(33,'savannabits/admin-ui','admin','sidebar.settings','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(34,'*','admin','admin-user.actions.edit_password','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(35,'*','admin','admin-user.actions.edit_profile','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(36,'savannabits/admin-ui','admin','media_uploader.max_number_of_files','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(37,'savannabits/admin-ui','admin','media_uploader.max_size_pre_file','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(38,'savannabits/admin-ui','admin','media_uploader.private_title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(39,'*','admin','menu-item.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(40,'*','admin','purchase-order.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(41,'*','admin','lpo.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(42,'*','admin','grn.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(43,'*','admin','bulk-dispatch.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(44,'*','admin','recipe.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(45,'*','admin','charity.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(46,'*','admin','disposal.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(47,'*','admin','derived-unit.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(48,'*','admin','depot.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(49,'*','admin','article.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(50,'*','admin','status.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(51,'*','S',' Recipe Requests','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(52,'*','admin','batch.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(53,'*','admin','batch-item.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(54,'*','admin','stock.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(55,'savannabits/admin-auth','activations','email.line','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(56,'savannabits/admin-auth','activations','email.action','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(57,'savannabits/admin-auth','activations','email.notRequested','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(58,'savannabits/admin-auth','admin','activations.activated','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(59,'savannabits/admin-auth','admin','activations.invalid_request','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(60,'savannabits/admin-auth','admin','activations.disabled','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(61,'savannabits/admin-auth','admin','activations.sent','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(62,'savannabits/admin-auth','admin','passwords.sent','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(63,'savannabits/admin-auth','admin','passwords.reset','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(64,'savannabits/admin-auth','admin','passwords.invalid_token','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(65,'savannabits/admin-auth','admin','passwords.invalid_user','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(66,'savannabits/admin-auth','admin','passwords.invalid_password','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(67,'savannabits/admin-auth','admin','activation_form.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(68,'savannabits/admin-auth','admin','activation_form.note','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(69,'savannabits/admin-auth','admin','auth_global.email','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(70,'savannabits/admin-auth','admin','activation_form.button','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(71,'savannabits/admin-auth','admin','login.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(72,'savannabits/admin-auth','admin','login.sign_in_text','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(73,'savannabits/admin-auth','admin','auth_global.password','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(74,'savannabits/admin-auth','admin','login.button','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(75,'savannabits/admin-auth','admin','login.forgot_password','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(76,'savannabits/admin-auth','admin','forgot_password.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(77,'savannabits/admin-auth','admin','forgot_password.note','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(78,'savannabits/admin-auth','admin','forgot_password.button','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(79,'savannabits/admin-auth','admin','password_reset.title','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(80,'savannabits/admin-auth','admin','password_reset.note','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(81,'savannabits/admin-auth','admin','auth_global.password_confirm','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(82,'savannabits/admin-auth','admin','password_reset.button','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(83,'*','*','Manage access','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(84,'*','*','Translations','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(85,'*','*','Configuration','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL),(86,'*','*','Manage users','[]',NULL,'2020-05-12 12:06:44','2020-05-12 12:06:44',NULL);
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_guid_unique` (`guid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Sam Arosi Maosa','smaosa@strathmore.edu',NULL,NULL,'Samson','Arosi','Maosa',NULL,NULL,'smaosa',NULL,'2020-05-13 12:55:35','2020-05-13 12:55:35',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wysiwyg_media`
--

DROP TABLE IF EXISTS `wysiwyg_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wysiwyg_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wysiwygable_id` int(10) unsigned DEFAULT NULL,
  `wysiwygable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wysiwyg_media_wysiwygable_id_index` (`wysiwygable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wysiwyg_media`
--

LOCK TABLES `wysiwyg_media` WRITE;
/*!40000 ALTER TABLE `wysiwyg_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `wysiwyg_media` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-14  9:48:23
