/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 5.7.25 : Database - project_video
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `auth_users` */

DROP TABLE IF EXISTS `auth_users`;

CREATE TABLE `auth_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` int(10) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `user_status` int(10) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `auth_users` */

insert  into `auth_users`(`id`,`user_group_id`,`name`,`username`,`email`,`email_verified_at`,`password`,`photo`,`user_status`,`remember_token`,`last_login_at`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'zef_admin','zef_admin','zefadmin@zeftech.com',NULL,'$2y$10$/salf5BBw/OTr7mGPYFtsOXGpgV1e7QCjko/MjIc/.evyijdlM5h2',NULL,0,'qSProhhiUr6WRrnuvvMy4TK7hkxZS5KD9tbhgRinFIjURpPiRGaqtPRYjCw1','2020-05-04 00:51:15',NULL,'2020-05-04 00:51:15',NULL),
(6,9,'admin top kopi','admin','admin@topcoffe.com',NULL,'$2y$10$U8/Xc1wSJ.QpxSmAoMs89u2PN2UT7n9aEsAgCd19e7Fp7G0FHtgeK',NULL,1,'xICOxJl93w1JyadcEvOedS3wPeb6MHILbQgSSONwbfwnBZQQzRnjv8huoLXa','2019-08-05 20:39:27','2019-01-15 20:14:42','2019-08-05 20:39:27',NULL);

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `client` */

insert  into `client`(`id`,`name`,`status`,`created_at`,`updated_at`) values 
(1,'densu',1,'2020-05-11 21:57:22','0000-00-00 00:00:00'),
(2,'tiket',1,'2020-05-11 21:57:28','0000-00-00 00:00:00'),
(3,'kana',1,'2020-05-11 21:57:35','0000-00-00 00:00:00'),
(4,'sac',1,'2020-05-12 19:15:08','2020-05-12 19:14:53'),
(5,'brandx',1,'2020-05-12 19:15:36','2020-05-12 19:15:36'),
(6,'kitaaja',1,'2020-05-12 19:32:25','2020-05-12 19:32:25'),
(7,'agentzef',1,'2020-05-12 19:33:20','2020-05-12 19:33:20'),
(8,'paijo',1,'2020-05-12 19:34:16','2020-05-12 19:34:16'),
(9,'sukro',1,'2020-05-12 19:37:06','2020-05-12 19:37:06');

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` char(25) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `user_status` int(2) DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `last_login_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `member` */

insert  into `member`(`id`,`full_name`,`email`,`password`,`phone`,`photo`,`user_status`,`remember_token`,`last_login_at`,`created_at`,`updated_at`) values 
(6,'wahyu bunyu aja','wahyu_bunyu_jogja@yahoo.co.id','$2y$10$0rgtDOVez/0p.0YiyJOVMufESa4MOoPrK8O7FO3bx2ClnfToG4oZe',NULL,'photo_6_202005140704.jpg',1,NULL,'2020-05-14 07:04:38','2020-05-09 16:19:13','2020-05-14 07:04:38');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values 
('nursatya.rinaldi@gmail.com','$2y$10$C7eD4k/cojNYhrGuhKhMi.Tbp/bBY5ipFL2lyqczezD71CI4OAxzu','2019-01-20 15:06:17'),
('aloysius.wahyu@sac.id','$2y$10$eEgllCWxKh9dESq1CWCZR.iPP76S7SYPDayZpM3RyDspuSZHAJ.3G','2019-02-09 23:41:14'),
('tatangsyaban@gmail.com','$2y$10$enWzhRiL7ZuFRmGJSXOMO.sm/lcf2ZJBxrFZve8HD.whHRmZb2ar6','2019-02-18 17:50:27'),
('mfs_archi@yahoo.com','$2y$10$xYvx58feag5IISwdfrREEehNeyO3/SH33VnKehU22FXsfRnvIGbii','2019-03-12 21:19:30'),
('emilfais06@gmail.com','$2y$10$0sGLkTIv5sOZh3SxgbGOG.s8X2hYpwymnObkTpqmb0M.q12A2S69q','2019-04-30 07:19:03'),
('ihzaamahendri@gmail.com','$2y$10$qRxqrjEoxAMoH1bydNYw1.Z/83Vybxzp6cAIOven252iQ6fJpuDKC','2019-05-07 09:06:31'),
('lfleming123@yahoo.com','$2y$10$O2hylQMPRG3.aIICP9/Hj.Lg2B65N51ysEa7Po11xHC4vYt12QSMa','2019-08-21 07:21:49'),
('smithsarb@sbcglobal.net','$2y$10$fH2dJTBraUSLuIOy8DFYHObS6fOGVLT.AQkaZGd8gHw7wi4yTNdZa','2019-08-29 02:05:17'),
('lhebert@equitycol.com','$2y$10$nD/1SGU6hjyxG48gmYN6wOJlf/AQvpIIjquPwn6S9ZZjERWpKub5S','2019-08-29 10:04:58');

/*Table structure for table `shoope_back` */

DROP TABLE IF EXISTS `shoope_back`;

CREATE TABLE `shoope_back` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `video_id` int(10) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `uniq_id` varchar(100) DEFAULT NULL,
  `patner_name` varchar(100) DEFAULT NULL,
  `patner_parameter` varchar(100) DEFAULT NULL,
  `sales_amount` char(10) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `duration` time DEFAULT '00:00:00',
  `total_duration` char(50) DEFAULT NULL,
  `persentase` char(50) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `shoope_back` */

insert  into `shoope_back`(`id`,`video_id`,`order_id`,`uniq_id`,`patner_name`,`patner_parameter`,`sales_amount`,`category`,`duration`,`total_duration`,`persentase`,`created_at`,`updated_at`) values 
(23,13,'nyoot','Shoopyback-nyoot-23','shopback','5678',NULL,NULL,'00:00:02','5.064','20','2020-05-14 05:15:11','2020-05-14 05:15:11'),
(24,13,'nyoot','Shoopyback-nyoot-24','shopback','5678',NULL,NULL,'00:00:03','5.064','50','2020-05-14 05:15:26','2020-05-14 05:15:26'),
(25,13,'ngelaba','Shoopyback-ngelaba-25','shopback','5678',NULL,NULL,'00:00:03','5.064','50','2020-05-14 05:15:51','2020-05-14 05:15:51'),
(26,14,'ngelaba','Shoopyback-ngelaba-26','shopback','5678',NULL,NULL,'00:00:01','5.064','20','2020-05-14 05:15:55','2020-05-14 05:15:55'),
(27,14,'pieto','Shoopyback-pieto-27','shopback','5678',NULL,NULL,'00:00:02','5.064','20','2020-05-14 05:16:08','2020-05-14 05:16:08'),
(28,15,'pieto','Shoopyback-pieto-28','shopback','5678',NULL,NULL,'00:00:01','5.064','20','2020-05-14 05:16:12','2020-05-14 05:16:12'),
(29,13,'pieto','Shoopyback-pieto-29','shopback','5678',NULL,NULL,'00:00:01','5.064','20','2020-05-14 05:16:15','2020-05-14 05:16:15'),
(30,15,'pieto','Shoopyback-pieto-30','shopback','5678',NULL,NULL,'00:00:01','5.064','20','2020-05-14 05:16:18','2020-05-14 05:16:18'),
(31,13,'pieto','Shoopyback-pieto-31','shopback','5678',NULL,NULL,'00:00:01','5.064','20','2020-05-14 05:16:20','2020-05-14 05:16:20');

/*Table structure for table `user_groups` */

DROP TABLE IF EXISTS `user_groups`;

CREATE TABLE `user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_superadmin` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_groups` */

insert  into `user_groups`(`id`,`name`,`is_superadmin`,`created_at`,`updated_at`) values 
(1,'Super Administrator',1,'2017-05-28 08:34:23','2017-05-28 08:34:23'),
(9,'admin',0,'2019-01-15 20:11:43','2019-01-15 20:11:43'),
(15,'Juri',0,'2019-02-07 01:24:25','2019-02-07 01:24:25');

/*Table structure for table `user_menu_groups` */

DROP TABLE IF EXISTS `user_menu_groups`;

CREATE TABLE `user_menu_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `user_menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=492 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_menu_groups` */

insert  into `user_menu_groups`(`id`,`user_group_id`,`user_menu_id`) values 
(1,1,1),
(2,1,2),
(3,1,3),
(5,1,5),
(8,1,8),
(491,1,139);

/*Table structure for table `user_menus` */

DROP TABLE IF EXISTS `user_menus`;

CREATE TABLE `user_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint(4) NOT NULL DEFAULT '1',
  `is_superadmin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_menus` */

insert  into `user_menus`(`id`,`parent_id`,`menu`,`file`,`icon_tags`,`position`,`is_superadmin`,`created_at`,`updated_at`) values 
(1,0,'Settings','#','fa fa-gears',2,0,'2017-05-28 08:34:34','2017-05-28 08:34:34'),
(2,1,'Admin User','users','fa fa-user',22,0,'2017-05-28 08:34:34','2017-07-16 11:34:49'),
(3,1,'Admin User Group & Authorization','groups','fa fa-users',21,0,'2017-05-28 08:34:34','2017-06-03 14:35:40'),
(5,1,'Logs Record (Backend)','logs','fa fa-archive',24,0,'2017-05-28 08:34:34','2017-05-28 08:34:34'),
(8,1,'Module','users_menu','fa fa-align-left',25,0,'2017-05-31 21:16:22','2017-10-13 01:15:13'),
(139,0,'Video','video',NULL,25,0,'2020-05-01 19:16:57','2020-05-01 19:16:57');

/*Table structure for table `videos` */

DROP TABLE IF EXISTS `videos`;

CREATE TABLE `videos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `client_id` int(10) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `description` text,
  `target_view` int(10) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `video_name` varchar(100) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `background` varchar(100) DEFAULT NULL,
  `start_publish` date DEFAULT NULL,
  `end_publish` date DEFAULT NULL,
  `status` int(2) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `videos` */

insert  into `videos`(`id`,`client_id`,`title`,`brand`,`description`,`target_view`,`path`,`video_name`,`video`,`photo`,`background`,`start_publish`,`end_publish`,`status`,`created_at`,`updated_at`) values 
(13,5,'testing','aduh','coba aja',10000,'http://projectvideo.zef/storage/uploads/video//video','video_13_202005130640','video_13_202005130640.wmv','photo_13_202005130640.jpg','background_13_202005130640.jpg','2020-05-13','2020-05-31',1,'2020-05-13 06:41:08','2020-05-13 06:41:08'),
(14,3,'percobaan 2','aduh','percobaan 2',1000,'http://projectvideo.zef/storage/uploads/video//video','video_14_202005130642','video_14_202005130642.wmv','photo_14_202005130642.jpg','background_14_202005130642.jpg','2020-05-13','2020-06-30',1,'2020-05-13 06:42:16','2020-05-13 06:42:16'),
(15,2,'coba 3','aduh','coba 3',100,'http://projectvideo.zef/storage/uploads/video//video','video_15_202005130645','video_15_202005130645.wmv','photo_15_202005130645.jpg','background_15_202005130645.jpg','2020-05-13','2020-05-16',1,'2020-05-13 06:45:41','2020-05-13 06:45:41');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
