-- Adminer 4.8.1 MySQL 5.5.5-10.3.36-MariaDB-0+deb10u2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `isft-db`;
CREATE DATABASE `isft-db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `isft-db`;

DELIMITER ;;

CREATE PROCEDURE `usp_create_action`(IN `name` varchar(75), IN `description` varchar(128))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        INSERT INTO action(name, description) VALUES (name, description);
   COMMIT;
END;;

CREATE PROCEDURE `usp_create_audit`(IN `user_id` int, IN `action` varchar(256))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION 

 BEGIN
   ROLLBACK;
   RESIGNAL;
 END;

START TRANSACTION;
 INSERT INTO audit(audit.user_id, audit.action, audit.action_date) 
 VALUES (user_id, action, NOW());
COMMIT;
END;;

CREATE PROCEDURE `usp_create_degree`(IN `name` varchar(75), IN `description` varchar(128), IN `resolution` varchar(45))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION 

 BEGIN
   ROLLBACK;
   RESIGNAL;
 END;

START TRANSACTION;
 INSERT into degree(name, description, resolution) 
 VALUES (name, description, resolution);
COMMIT;
END;;

CREATE PROCEDURE `usp_create_degree_subjects`(IN `degree_id` int, IN `subject_id` int)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION 

 BEGIN
   ROLLBACK;
   RESIGNAL;
 END;

START TRANSACTION;
 INSERT into degree_subjects(degree_id, subject_id) 
 VALUES (degree_id, subject_id);
COMMIT;
END;;

CREATE PROCEDURE `usp_create_group`(IN `name` varchar(75), IN `description` varchar(128))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        INSERT INTO `group`(name, description) VALUES (name, description);
   COMMIT;
END;;

CREATE PROCEDURE `usp_create_group_permissions`(IN `group_id` int, IN `action_id` int)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    INSERT INTO group_permissions(group_id, action_id) VALUES (group_id, action_id);
    COMMIT;
END;;

CREATE PROCEDURE `usp_create_group_user_members`(IN `group_id` int, IN `user_id` int)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    INSERT INTO group_user_members(group_id, user_id) VALUES (group_id, user_id);
    COMMIT;
END;;

CREATE PROCEDURE `usp_create_subject`(IN `name` varchar(45), IN `year` varchar(45))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION 

 BEGIN
   ROLLBACK;
   RESIGNAL;
 END;

START TRANSACTION;
 INSERT INTO subject(name, `year`) 
 VALUES (name, `year`);
COMMIT;
END;;

CREATE PROCEDURE `usp_create_user`(IN `username` varchar(75), IN `password` varchar(256))
BEGIN
DECLARE user_id INT DEFAULT 0;
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        INSERT INTO user(username, password) VALUES (username, password);
        SET user_id = LAST_INSERT_ID();
        CALL `usp_create_group_user_members`(2, user_id);
   COMMIT;
END;;

CREATE PROCEDURE `usp_create_user_information`(IN `user_id` int, IN `name` varchar(75), IN `surname` varchar(75), IN `dni` varchar(45), IN `email` varchar(75))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        INSERT INTO user_information(user_id, name, surname, dni, email) VALUES (user_id, name, surname, dni, email);
   COMMIT;
END;;

CREATE PROCEDURE `usp_create_user_session`(IN `user_id` int, IN `token` varchar(256))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        INSERT INTO user_session(token, created, expires, user_id) 
        VALUES (token, NOW(), DATE_ADD(NOW(), INTERVAL 1 DAY), user_id);
   COMMIT;
END;;

CREATE PROCEDURE `usp_delete_action`(IN `id` int)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
   UPDATE action SET action.is_deleted = 1 WHERE action.id = id;
   COMMIT;
END;;

CREATE PROCEDURE `usp_delete_degree`(IN `id` int)
BEGIN
 DECLARE EXIT HANDLER FOR SQLEXCEPTION 
 BEGIN
  ROLLBACK;
  RESIGNAL;
 END;

START TRANSACTION;

UPDATE degree
SET is_deleted = '1'
WHERE degree.id = id;
COMMIT;
END;;

CREATE PROCEDURE `usp_delete_degree_subjects`(IN `degree_id` tinyint, IN `subject_id` tinyint)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    DELETE FROM degree_subjects WHERE degree_subjects.degree.id = degree.id AND degree_subjects.subject_id = subject_id;
    COMMIT;
END;;

CREATE PROCEDURE `usp_delete_group`(IN `id` int)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
   UPDATE `group` SET `group`.is_deleted = 1 WHERE `group`.id = id;
   COMMIT;
END;;

CREATE PROCEDURE `usp_delete_group_permissions`(IN `group_id` int, IN `action_id` int)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    DELETE FROM group_permissions WHERE group_permissions.group_id = group_id AND group_permissions.action_id = action_id;
    COMMIT;
END;;

CREATE PROCEDURE `usp_delete_group_user_members`(IN `group_id` int, IN `user_id` int)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    DELETE FROM group_user_members WHERE group_user_members.group_id = group_id AND group_user_members.user_id = user_id;
    COMMIT;
END;;

CREATE PROCEDURE `usp_delete_subject`(IN `id` int)
BEGIN
 DECLARE EXIT HANDLER FOR SQLEXCEPTION 
 BEGIN
  ROLLBACK;
  RESIGNAL;
 END;

START TRANSACTION;

UPDATE subject
SET is_deleted = '1'
WHERE subject.id = id;
COMMIT;

END;;

CREATE PROCEDURE `usp_delete_user`(IN `id` int)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    UPDATE user SET user.is_deleted = 1 WHERE user.id = id;
    COMMIT;
END;;

CREATE PROCEDURE `usp_delete_user_information`(IN `user_id` int)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        DELETE FROM user_information WHERE user_information.user_id = user_id;
   COMMIT;
END;;

CREATE PROCEDURE `usp_delete_user_session`(IN `token` varchar(256))
DELETE FROM user_session WHERE user_session.token = token;;

CREATE PROCEDURE `usp_getAll_action`()
SELECT view_action.id, view_action.name, view_action.description FROM view_action;;

CREATE PROCEDURE `usp_getAll_audit`()
BEGIN

SELECT audit.user_id, audit.action, audit.action_date FROM audit;

END;;

CREATE PROCEDURE `usp_getAll_degree`()
BEGIN

SELECT view_degree.id, view_degree.name, view_degree.description, view_degree.resolution FROM view_degree;

END;;

CREATE PROCEDURE `usp_getAll_degree_subjects`()
BEGIN

SELECT view_degree_subjects.degree_id, view_degree_subjects.name, view_degree_subjects.description, view_degree_subjects.resolution, view_degree_subjects.subject_id, view_degree_subjects.`year` FROM view_degree_subjects;

END;;

CREATE PROCEDURE `usp_getAll_group`()
SELECT view_group.id, view_group.name, view_group.description FROM view_group;;

CREATE PROCEDURE `usp_getAll_group_permissions`()
SELECT view_group_permissions.group_id, view_group_permissions.group_name,
view_group_permissions.group_description, view_group_permissions.action_id,
view_group_permissions.action_name, view_group_permissions.action_description  FROM view_group_permissions;;

CREATE PROCEDURE `usp_getAll_group_user_members`()
SELECT view_group_user_members.group_id, view_group_user_members.group_name,
view_group_user_members.group_description, view_group_user_members.username FROM view_group_user_members;;

CREATE PROCEDURE `usp_getAll_subject`()
BEGIN

SELECT view_subject.id, view_subject.name, view_subject.`year` FROM view_subject;

END;;

CREATE PROCEDURE `usp_getAll_user`()
SELECT view_user.id, view_user.username FROM view_user;;

CREATE PROCEDURE `usp_getAll_user_information`()
SELECT view_user_information.user_id, view_user_information.name, 
view_user_information.surname, view_user_information.dni, view_user_information.email FROM view_user_information;;

CREATE PROCEDURE `usp_get_action`(IN `id` int)
SELECT view_action.id, view_action.name, view_action.description FROM view_action WHERE view_action.id = id;;

CREATE PROCEDURE `usp_get_audit`(IN `user_id` int)
BEGIN

SELECT audit.user_id, audit.action, audit.action_date FROM audit
WHERE audit.user_id = user_id;

END;;

CREATE PROCEDURE `usp_get_degree`(IN `id` int)
BEGIN

SELECT view_degree.name, view_degree.description, view_degree.resolution FROM view_degree
WHERE view_degree.id = id;

END;;

CREATE PROCEDURE `usp_get_degree_subjects`(IN `degree_id` int, IN `subject_id` int)
BEGIN

SELECT view_degree_subjects.degree_id, view_degree_subjects.name, view_degree_subjects.description, view_degree_subjects.resolution, view_degree_subjects.subject_id, view_degree_subjects.`year` FROM view_degree_subjects
WHERE view_degree_subjects.degree_id = degree_id AND view_degree_subjects.subject_id = subject_id;

END;;

CREATE PROCEDURE `usp_get_group`(IN `id` int)
SELECT view_group.id, view_group.name, view_group.description FROM view_group WHERE view_group.id = id;;

CREATE PROCEDURE `usp_get_group_permissions`(IN `group_id` int)
SELECT view_group_permissions.group_id, view_group_permissions.group_name,
view_group_permissions.group_description, view_group_permissions.action_id,
view_group_permissions.action_name, view_group_permissions.action_description  FROM view_group_permissions WHERE view_group_permissions.group_id = group_id;;

CREATE PROCEDURE `usp_get_group_user_members`(IN `group_id` int)
SELECT view_group_user_members.group_id, view_group_user_members.group_name,
view_group_user_members.group_description, view_group_user_members.username FROM view_group_user_members WHERE view_group_user_members.group_id = group_id;;

CREATE PROCEDURE `usp_get_subject`(IN `id` int)
BEGIN

SELECT view_subject.name, view_subject.`year` FROM view_subject
WHERE view_subject.id = id;

END;;

CREATE PROCEDURE `usp_get_user`(IN `id` int)
SELECT view_user.id, view_user.username FROM view_user WHERE view_user.id = id;;

CREATE PROCEDURE `usp_get_user_information`(IN `user_id` int)
SELECT view_user_information.user_id, view_user_information.name, 
view_user_information.surname, view_user_information.dni, view_user_information.email FROM view_user_information WHERE view_user_information.user_id;;

CREATE PROCEDURE `usp_get_user_password_hash`(IN `username` varchar(75))
SELECT user.id, user.password FROM user WHERE user.username = username;;

CREATE PROCEDURE `usp_update_action`(IN `id` int, IN `name` varchar(75), IN `description` varchar(128))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
         UPDATE action SET action.name = name, action.description = description WHERE action.id = id;
    COMMIT;
END;;

CREATE PROCEDURE `usp_update_degree`(IN `id` int, IN `name` varchar(75), IN `description` varchar(128), IN `resolution` varchar(45))
BEGIN
 DECLARE EXIT HANDLER FOR SQLEXCEPTION 
 BEGIN
  ROLLBACK;
  RESIGNAL;
 END;

START TRANSACTION;

UPDATE degree
SET degree.name = name , degree.description = description , degree.resolution = resolution
WHERE degree.id = id;

COMMIT;
END;;

CREATE PROCEDURE `usp_update_group`(IN `id` int, IN `name` varchar(75), IN `description` varchar(128))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
         UPDATE `group` SET `group`.name = name, `group`.description = description WHERE `group`.id = id;
    COMMIT;
END;;

CREATE PROCEDURE `usp_update_subject`(IN `id` int, IN `name` varchar(45), IN `year` varchar(45))
BEGIN
 DECLARE EXIT HANDLER FOR SQLEXCEPTION 
 BEGIN
  ROLLBACK;
  RESIGNAL;
 END;

START TRANSACTION;

UPDATE subject
SET subject.name = name , subject.`year` = `year`
WHERE subject.id = id;
COMMIT;
END;;

CREATE PROCEDURE `usp_update_user`(IN `id` int, IN `username` varchar(75), IN `password` varchar(256))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    UPDATE user SET user.username = username , user.password = password WHERE user.id = id;
    COMMIT;
END;;

CREATE PROCEDURE `usp_update_user_information`(IN `user_id` int, IN `name` varchar(75), IN `surname` varchar(75), IN `dni` varchar(45), IN `email` varchar(75))
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        UPDATE user_information SET user_information.name = name, user_information.surname = surname,
   user_information.dni = dni, user_information.email = email WHERE user_information.user_id = user_id; 
   COMMIT;
END;;

CREATE PROCEDURE `usp_validate_session_token`(IN `token` varchar(256))
SELECT user_session.id FROM user_session WHERE expires > NOW() AND user_session.token = token;;

DELIMITER ;

DROP TABLE IF EXISTS `action`;
CREATE TABLE `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `audit`;
CREATE TABLE `audit` (
  `user_id` int(11) NOT NULL,
  `action` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `degree`;
CREATE TABLE `degree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resolution` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `degree_subjects`;
CREATE TABLE `degree_subjects` (
  `degree_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  KEY `fk_degree_subjects_degree1_idx` (`degree_id`),
  KEY `fk_degree_subjects_subject1_idx` (`subject_id`),
  CONSTRAINT `fk_degree_subjects_degree1` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`id`),
  CONSTRAINT `fk_degree_subjects_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `group_permissions`;
CREATE TABLE `group_permissions` (
  `group_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  KEY `fk_group_actions_group1_idx` (`group_id`),
  KEY `fk_group_actions_action1_idx` (`action_id`),
  CONSTRAINT `fk_group_actions_action1` FOREIGN KEY (`action_id`) REFERENCES `action` (`id`),
  CONSTRAINT `fk_group_actions_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `group_user_members`;
CREATE TABLE `group_user_members` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `fk_group_user_members_group1_idx` (`group_id`),
  KEY `fk_group_user_members_user1_idx` (`user_id`),
  CONSTRAINT `fk_group_user_members_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`),
  CONSTRAINT `fk_group_user_members_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `user_information`;
CREATE TABLE `user_information` (
  `user_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `user_session`;
CREATE TABLE `user_session` (
  `user_id` int(11) NOT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `token_UNIQUE` (`token`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  KEY `fk_user_session_user1_idx` (`user_id`),
  CONSTRAINT `fk_user_session_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP VIEW IF EXISTS `view_action`;
CREATE TABLE `view_action` (`id` int(11), `name` varchar(75), `description` varchar(128));


DROP VIEW IF EXISTS `view_degree`;
CREATE TABLE `view_degree` (`id` int(11), `name` varchar(75), `description` varchar(128), `resolution` varchar(45));


DROP VIEW IF EXISTS `view_degree_subjects`;
CREATE TABLE `view_degree_subjects` (`degree_id` int(11), `name` varchar(75), `description` varchar(128), `resolution` varchar(45), `subject_id` int(11), `year` varchar(45));


DROP VIEW IF EXISTS `view_group`;
CREATE TABLE `view_group` (`id` int(11), `name` varchar(75), `description` varchar(128));


DROP VIEW IF EXISTS `view_group_permissions`;
CREATE TABLE `view_group_permissions` (`group_id` int(11), `group_name` varchar(75), `group_description` varchar(128), `action_id` int(11), `action_name` varchar(75), `action_description` varchar(128));


DROP VIEW IF EXISTS `view_group_user_members`;
CREATE TABLE `view_group_user_members` (`group_id` int(11), `group_name` varchar(75), `group_description` varchar(128), `username` varchar(75));


DROP VIEW IF EXISTS `view_subject`;
CREATE TABLE `view_subject` (`id` int(11), `name` varchar(45), `year` varchar(45));


DROP VIEW IF EXISTS `view_user`;
CREATE TABLE `view_user` (`id` int(11), `username` varchar(75));


DROP VIEW IF EXISTS `view_user_information`;
CREATE TABLE `view_user_information` (`user_id` int(11), `name` varchar(75), `surname` varchar(75), `dni` varchar(45), `email` varchar(75));


DROP TABLE IF EXISTS `view_action`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_action` AS select `action`.`id` AS `id`,`action`.`name` AS `name`,`action`.`description` AS `description` from `action` where `action`.`is_deleted` = 0;

DROP TABLE IF EXISTS `view_degree`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_degree` AS select `degree`.`id` AS `id`,`degree`.`name` AS `name`,`degree`.`description` AS `description`,`degree`.`resolution` AS `resolution` from `degree` where `degree`.`is_deleted` = '0';

DROP TABLE IF EXISTS `view_degree_subjects`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_degree_subjects` AS select `degree`.`id` AS `degree_id`,`degree`.`name` AS `name`,`degree`.`description` AS `description`,`degree`.`resolution` AS `resolution`,`subject`.`id` AS `subject_id`,`subject`.`year` AS `year` from ((`degree` join `degree_subjects` on(`degree`.`id` = `degree_subjects`.`degree_id`)) join `subject` on(`subject`.`id` = `degree_subjects`.`subject_id`)) where `degree`.`is_deleted` = 0 and `subject`.`is_deleted` = 0;

DROP TABLE IF EXISTS `view_group`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_group` AS select `group`.`id` AS `id`,`group`.`name` AS `name`,`group`.`description` AS `description` from `group` where `group`.`is_deleted` = 0;

DROP TABLE IF EXISTS `view_group_permissions`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_group_permissions` AS select `group`.`id` AS `group_id`,`group`.`name` AS `group_name`,`group`.`description` AS `group_description`,`action`.`id` AS `action_id`,`action`.`name` AS `action_name`,`action`.`description` AS `action_description` from ((`group` join `group_permissions` on(`group_permissions`.`group_id` = `group`.`id`)) join `action` on(`group_permissions`.`action_id` = `action`.`id`)) where `group`.`is_deleted` = 0 and `action`.`is_deleted` = 0;

DROP TABLE IF EXISTS `view_group_user_members`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_group_user_members` AS select `group`.`id` AS `group_id`,`group`.`name` AS `group_name`,`group`.`description` AS `group_description`,`user`.`username` AS `username` from ((`group` join `group_user_members` on(`group`.`id` = `group_user_members`.`group_id`)) join `user` on(`group_user_members`.`user_id` = `user`.`id`)) where `group`.`is_deleted` = 0 and `user`.`is_deleted` = 0;

DROP TABLE IF EXISTS `view_subject`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_subject` AS select `subject`.`id` AS `id`,`subject`.`name` AS `name`,`subject`.`year` AS `year` from `subject` where `subject`.`is_deleted` = '0';

DROP TABLE IF EXISTS `view_user`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_user` AS select `user`.`id` AS `id`,`user`.`username` AS `username` from `user` where `user`.`is_deleted` = 0;

DROP TABLE IF EXISTS `view_user_information`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_user_information` AS select `user_information`.`user_id` AS `user_id`,`user_information`.`name` AS `name`,`user_information`.`surname` AS `surname`,`user_information`.`dni` AS `dni`,`user_information`.`email` AS `email` from (`user_information` join `user` on(`user_information`.`user_id` = `user`.`id`)) where `user`.`is_deleted` = 0;

-- 2022-10-27 22:28:12
