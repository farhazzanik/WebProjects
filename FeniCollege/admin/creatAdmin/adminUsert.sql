/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.8-MariaDB : Database - finaldatabaseforfgc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admin_users` */

DROP TABLE IF EXISTS `admin_users`;

CREATE TABLE `admin_users` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `Name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `status` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `repass` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `admin_users` */

insert  into `admin_users`(`id`,`Name`,`email`,`status`,`type`,`pass`,`repass`) values ('306','SBIT','info@sbit.com.bd','Active','Main Admin','$2y$10$OTFhZTczY2VhMmI4MGNlMOhWwFkH1YIGjivdBuKOI7ps0W/jcqQ4a','$2y$10$Y2MyNWM3MzJjYTJjZDdhMOH1hzx6/fBJHTyRhHGcHCSRNg0dR3dj6'),('ADMIN-0001','Mithun Chandra Das','mithunfc@gmail.com','Active','Main Admin','$2y$10$MGExOWU3Zjk1ZjYwZTRhYuSbVNjQQJehk5Gz5PGyfxYBHEReXQRtO','$2y$10$MDViNzM4Mzk2MWY4ODIyMuz6f2xx2L8mHM2PtHwga1A6LuQ5uxVfa');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
