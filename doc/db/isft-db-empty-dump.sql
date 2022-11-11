-- Adminer 4.8.1 MySQL 8.0.29 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `isft-db`;
CREATE DATABASE `isft-db` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `isft-db`;

DROP TABLE IF EXISTS `action`;
CREATE TABLE `action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `action`;

DROP TABLE IF EXISTS `audit`;
CREATE TABLE `audit` (
  `user_id` int NOT NULL,
  `action` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `audit`;

DROP TABLE IF EXISTS `degree`;
CREATE TABLE `degree` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resolution` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `degree`;

DROP TABLE IF EXISTS `degree_subjects`;
CREATE TABLE `degree_subjects` (
  `degree_id` int NOT NULL,
  `subject_id` int NOT NULL,
  KEY `fk_degree_subjects_degree1_idx` (`degree_id`),
  KEY `fk_degree_subjects_subject1_idx` (`subject_id`),
  CONSTRAINT `fk_degree_subjects_degree1` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`id`),
  CONSTRAINT `fk_degree_subjects_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `degree_subjects`;

DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `group`;

DROP TABLE IF EXISTS `group_permissions`;
CREATE TABLE `group_permissions` (
  `group_id` int NOT NULL,
  `action_id` int NOT NULL,
  KEY `fk_group_actions_group1_idx` (`group_id`),
  KEY `fk_group_actions_action1_idx` (`action_id`),
  CONSTRAINT `fk_group_actions_action1` FOREIGN KEY (`action_id`) REFERENCES `action` (`id`),
  CONSTRAINT `fk_group_actions_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `group_permissions`;

DROP TABLE IF EXISTS `group_user_members`;
CREATE TABLE `group_user_members` (
  `group_id` int NOT NULL,
  `user_id` int NOT NULL,
  KEY `fk_group_user_members_group1_idx` (`group_id`),
  KEY `fk_group_user_members_user1_idx` (`user_id`),
  CONSTRAINT `fk_group_user_members_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`),
  CONSTRAINT `fk_group_user_members_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `group_user_members`;

DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `subject`;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `user`;

DROP TABLE IF EXISTS `user_information`;
CREATE TABLE `user_information` (
  `user_id` int NOT NULL,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  UNIQUE KEY `mail_UNIQUE` (`email`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  KEY `fk_user_information_user_idx` (`user_id`),
  CONSTRAINT `fk_user_information_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `user_information`;

DROP TABLE IF EXISTS `user_session`;
CREATE TABLE `user_session` (
  `user_id` int NOT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `token_UNIQUE` (`token`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  KEY `fk_user_session_user1_idx` (`user_id`),
  CONSTRAINT `fk_user_session_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

TRUNCATE `user_session`;

DROP VIEW IF EXISTS `view_action`;
CREATE TABLE `view_action` (`id` int, `name` varchar(75), `description` varchar(128));


DROP VIEW IF EXISTS `view_group`;
CREATE TABLE `view_group` (`id` int, `name` varchar(75), `description` varchar(128));


DROP VIEW IF EXISTS `view_group_permissions`;
CREATE TABLE `view_group_permissions` (`group_name` varchar(75), `group_description` varchar(128), `action_name` varchar(75), `action_description` varchar(128));


DROP VIEW IF EXISTS `view_group_user_members`;
CREATE TABLE `view_group_user_members` (`group_name` varchar(75), `group_description` varchar(128), `username` varchar(75));


DROP VIEW IF EXISTS `view_user`;
CREATE TABLE `view_user` (`id` int, `username` varchar(75));


DROP VIEW IF EXISTS `view_user_information`;
CREATE TABLE `view_user_information` (`user_id` int, `name` varchar(75), `surname` varchar(75), `dni` varchar(45), `email` varchar(75));


DROP TABLE IF EXISTS `view_action`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_action` AS select `action`.`id` AS `id`,`action`.`name` AS `name`,`action`.`description` AS `description` from `action` where (`action`.`is_deleted` = 0);

DROP TABLE IF EXISTS `view_group`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_group` AS select `group`.`id` AS `id`,`group`.`name` AS `name`,`group`.`description` AS `description` from `group` where (`group`.`is_deleted` = 0);

DROP TABLE IF EXISTS `view_group_permissions`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_group_permissions` AS select `group`.`name` AS `group_name`,`group`.`description` AS `group_description`,`action`.`name` AS `action_name`,`action`.`description` AS `action_description` from ((`group` join `group_permissions` on((`group_permissions`.`group_id` = `group`.`id`))) join `action` on((`group_permissions`.`action_id` = `action`.`id`))) where ((`group`.`is_deleted` = 0) and (`action`.`is_deleted` = 0));

DROP TABLE IF EXISTS `view_group_user_members`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_group_user_members` AS select `group`.`name` AS `group_name`,`group`.`description` AS `group_description`,`user`.`username` AS `username` from ((`group` join `group_user_members` on((`group`.`id` = `group_user_members`.`group_id`))) join `user` on((`group_user_members`.`user_id` = `user`.`id`))) where ((`group`.`is_deleted` = 0) and (`user`.`is_deleted` = 0));

DROP TABLE IF EXISTS `view_user`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_user` AS select `user`.`id` AS `id`,`user`.`username` AS `username` from `user` where (`user`.`is_deleted` = 0);

DROP TABLE IF EXISTS `view_user_information`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_user_information` AS select `user_information`.`user_id` AS `user_id`,`user_information`.`name` AS `name`,`user_information`.`surname` AS `surname`,`user_information`.`dni` AS `dni`,`user_information`.`email` AS `email` from (`user_information` join `user` on((`user_information`.`user_id` = `user`.`id`))) where (`user`.`is_deleted` = 0);

-- 2022-10-13 23:41:07
