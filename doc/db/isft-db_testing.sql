-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 11-11-2022 a las 21:42:55
-- Versión del servidor: 5.7.34
-- Versión de PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `isft-db`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_action` (IN `name` VARCHAR(75), IN `description` VARCHAR(128))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        INSERT INTO action(name, description) VALUES (name, description);
   COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_audit` (IN `user_id` INT, IN `action` VARCHAR(256))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION 

 BEGIN
   ROLLBACK;
   RESIGNAL;
 END;

START TRANSACTION;
 INSERT INTO audit(audit.user_id, audit.action, audit.action_date) 
 VALUES (user_id, action, NOW());
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_degree` (IN `name` VARCHAR(75), IN `description` VARCHAR(128), IN `resolution` VARCHAR(45))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION 

 BEGIN
   ROLLBACK;
   RESIGNAL;
 END;

START TRANSACTION;
 INSERT into degree(name, description, resolution) 
 VALUES (name, description, resolution);
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_degree_subjects` (IN `degree_id` INT, IN `subject_id` INT)  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION 

 BEGIN
   ROLLBACK;
   RESIGNAL;
 END;

START TRANSACTION;
 INSERT into degree_subjects(degree_id, subject_id) 
 VALUES (degree_id, subject_id);
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_group` (IN `name` VARCHAR(75), IN `description` VARCHAR(128))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        INSERT INTO `group`(name, description) VALUES (name, description);
   COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_group_permissions` (IN `group_id` INT, IN `action_id` INT)  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    INSERT INTO group_permissions(group_id, action_id) VALUES (group_id, action_id);
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_group_user_members` (IN `group_id` INT, IN `user_id` INT)  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    INSERT INTO group_user_members(group_id, user_id) VALUES (group_id, user_id);
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_subject` (IN `name` VARCHAR(45), IN `year` VARCHAR(45))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION 

 BEGIN
   ROLLBACK;
   RESIGNAL;
 END;

START TRANSACTION;
 INSERT INTO subject(name, `year`) 
 VALUES (name, `year`);
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_user` (IN `username` VARCHAR(75), IN `password` VARCHAR(256))  BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_user_information` (IN `user_id` INT, IN `name` VARCHAR(75), IN `surname` VARCHAR(75), IN `dni` VARCHAR(45), IN `email` VARCHAR(75))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        INSERT INTO user_information(user_id, name, surname, dni, email) VALUES (user_id, name, surname, dni, email);
   COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_create_user_session` (IN `user_id` INT, IN `token` VARCHAR(256))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        INSERT INTO user_session(token, created, expires, user_id) 
        VALUES (token, NOW(), DATE_ADD(NOW(), INTERVAL 1 DAY), user_id);
   COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_delete_action` (IN `id` INT)  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
   UPDATE action SET action.is_deleted = 1 WHERE action.id = id;
   COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_delete_degree` (IN `id` INT)  BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_delete_degree_subjects` (IN `degree_id` TINYINT, IN `subject_id` TINYINT)  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    DELETE FROM degree_subjects WHERE degree_subjects.degree.id = degree.id AND degree_subjects.subject_id = subject_id;
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_delete_group` (IN `id` INT)  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
   UPDATE `group` SET `group`.is_deleted = 1 WHERE `group`.id = id;
   COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_delete_group_permissions` (IN `group_id` INT, IN `action_id` INT)  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    DELETE FROM group_permissions WHERE group_permissions.group_id = group_id AND group_permissions.action_id = action_id;
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_delete_group_user_members` (IN `group_id` INT, IN `user_id` INT)  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    DELETE FROM group_user_members WHERE group_user_members.group_id = group_id AND group_user_members.user_id = user_id;
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_delete_subject` (IN `id` INT)  BEGIN
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

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_delete_user` (IN `id` INT)  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    UPDATE user SET user.is_deleted = 1 WHERE user.id = id;
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_delete_user_information` (IN `user_id` INT)  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        DELETE FROM user_information WHERE user_information.user_id = user_id;
   COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_delete_user_session` (IN `token` VARCHAR(256))  DELETE FROM user_session WHERE user_session.token = token$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_getAll_action` ()  SELECT view_action.id, view_action.name, view_action.description FROM view_action$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_getAll_audit` ()  BEGIN

SELECT audit.user_id, audit.action, audit.action_date FROM audit;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_getAll_degree` ()  BEGIN

SELECT view_degree.id, view_degree.name, view_degree.description, view_degree.resolution FROM view_degree;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_getAll_degree_subjects` ()  BEGIN

SELECT view_degree_subjects.degree_id, view_degree_subjects.name, view_degree_subjects.description, view_degree_subjects.resolution, view_degree_subjects.subject_id, view_degree_subjects.`year` FROM view_degree_subjects;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_getAll_group` ()  SELECT view_group.id, view_group.name, view_group.description FROM view_group$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_getAll_group_permissions` ()  SELECT view_group_permissions.group_id, view_group_permissions.group_name,
view_group_permissions.group_description, view_group_permissions.action_id,
view_group_permissions.action_name, view_group_permissions.action_description  FROM view_group_permissions$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_getAll_group_user_members` ()  SELECT view_group_user_members.group_id, view_group_user_members.group_name,
view_group_user_members.group_description, view_group_user_members.username FROM view_group_user_members$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_getAll_subject` ()  BEGIN

SELECT view_subject.id, view_subject.name, view_subject.`year` FROM view_subject;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_getAll_user` ()  SELECT view_user.id, view_user.username FROM view_user$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_getAll_user_information` ()  SELECT view_user_information.user_id, view_user_information.name, 
view_user_information.surname, view_user_information.dni, view_user_information.email FROM view_user_information$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_action` (IN `id` INT)  SELECT view_action.id, view_action.name, view_action.description FROM view_action WHERE view_action.id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_audit` (IN `user_id` INT)  BEGIN

SELECT audit.user_id, audit.action, audit.action_date FROM audit
WHERE audit.user_id = user_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_degree` (IN `id` INT)  BEGIN

SELECT view_degree.name, view_degree.description, view_degree.resolution FROM view_degree
WHERE view_degree.id = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_degree_subjects` (IN `degree_id` INT, IN `subject_id` INT)  BEGIN

SELECT view_degree_subjects.degree_id, view_degree_subjects.name, view_degree_subjects.description, view_degree_subjects.resolution, view_degree_subjects.subject_id, view_degree_subjects.`year` FROM view_degree_subjects
WHERE view_degree_subjects.degree_id = degree_id AND view_degree_subjects.subject_id = subject_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_group` (IN `id` INT)  SELECT view_group.id, view_group.name, view_group.description FROM view_group WHERE view_group.id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_group_permissions` (IN `group_id` INT)  SELECT view_group_permissions.group_id, view_group_permissions.group_name,
view_group_permissions.group_description, view_group_permissions.action_id,
view_group_permissions.action_name, view_group_permissions.action_description  FROM view_group_permissions WHERE view_group_permissions.group_id = group_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_group_user_members` (IN `group_id` INT)  SELECT view_group_user_members.group_id, view_group_user_members.group_name,
view_group_user_members.group_description, view_group_user_members.username FROM view_group_user_members WHERE view_group_user_members.group_id = group_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_subject` (IN `id` INT)  BEGIN

SELECT view_subject.name, view_subject.`year` FROM view_subject
WHERE view_subject.id = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_user` (IN `id` INT)  SELECT view_user.id, view_user.username FROM view_user WHERE view_user.id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_user_information` (IN `user_id` INT)  SELECT view_user_information.user_id, view_user_information.name, 
view_user_information.surname, view_user_information.dni, view_user_information.email FROM view_user_information WHERE view_user_information.user_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_get_user_password_hash` (IN `username` VARCHAR(75))  SELECT user.id, user.password FROM user WHERE user.username = username$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_update_action` (IN `id` INT, IN `name` VARCHAR(75), IN `description` VARCHAR(128))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
         UPDATE action SET action.name = name, action.description = description WHERE action.id = id;
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_update_degree` (IN `id` INT, IN `name` VARCHAR(75), IN `description` VARCHAR(128), IN `resolution` VARCHAR(45))  BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_update_group` (IN `id` INT, IN `name` VARCHAR(75), IN `description` VARCHAR(128))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
         UPDATE `group` SET `group`.name = name, `group`.description = description WHERE `group`.id = id;
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_update_subject` (IN `id` INT, IN `name` VARCHAR(45), IN `year` VARCHAR(45))  BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_update_user` (IN `id` INT, IN `username` VARCHAR(75), IN `password` VARCHAR(256))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
    START TRANSACTION;
    UPDATE user SET user.username = username , user.password = password WHERE user.id = id;
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_update_user_information` (IN `user_id` INT, IN `name` VARCHAR(75), IN `surname` VARCHAR(75), IN `dni` VARCHAR(45), IN `email` VARCHAR(75))  BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
            ROLLBACK;
            RESIGNAL;
   END;
   START TRANSACTION;
        UPDATE user_information SET user_information.name = name, user_information.surname = surname,
   user_information.dni = dni, user_information.email = email WHERE user_information.user_id = user_id; 
   COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_validate_session_token` (IN `token` VARCHAR(256))  SELECT user_session.id FROM user_session WHERE expires > NOW() AND user_session.token = token$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `action`
--

CREATE TABLE `action` (
  `id` int(11) NOT NULL,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit`
--

CREATE TABLE `audit` (
  `user_id` int(11) NOT NULL,
  `action` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `degree`
--

CREATE TABLE `degree` (
  `id` int(11) NOT NULL,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resolution` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `degree_subjects`
--

CREATE TABLE `degree_subjects` (
  `degree_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `group`
--

INSERT INTO `group` (`id`, `name`, `description`, `is_deleted`) VALUES
(1, 'Administrador', 'administracion', 0),
(2, 'Guest', 'no permissions', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_permissions`
--

CREATE TABLE `group_permissions` (
  `group_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_user_members`
--

CREATE TABLE `group_user_members` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `group_user_members`
--

INSERT INTO `group_user_members` (`group_id`, `user_id`) VALUES
(2, 1),
(2, 2),
(2, 4),
(2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `is_deleted`) VALUES
(1, 'pipi', 'correcaminos', 1),
(2, 'Roberto', 'Carlos', 1),
(4, '123', 'bizcocho', 0),
(6, '22/10/2022', 'bizcocho', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_information`
--

CREATE TABLE `user_information` (
  `user_id` int(11) NOT NULL,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(75) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_session`
--

CREATE TABLE `user_session` (
  `user_id` int(11) NOT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_action`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_action` (
`id` int(11)
,`name` varchar(75)
,`description` varchar(128)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_degree`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_degree` (
`id` int(11)
,`name` varchar(75)
,`description` varchar(128)
,`resolution` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_degree_subjects`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_degree_subjects` (
`degree_id` int(11)
,`name` varchar(75)
,`description` varchar(128)
,`resolution` varchar(45)
,`subject_id` int(11)
,`year` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_group`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_group` (
`id` int(11)
,`name` varchar(75)
,`description` varchar(128)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_group_permissions`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_group_permissions` (
`group_id` int(11)
,`group_name` varchar(75)
,`group_description` varchar(128)
,`action_id` int(11)
,`action_name` varchar(75)
,`action_description` varchar(128)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_group_user_members`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_group_user_members` (
`group_id` int(11)
,`group_name` varchar(75)
,`group_description` varchar(128)
,`username` varchar(75)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_subject`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_subject` (
`id` int(11)
,`name` varchar(45)
,`year` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_user`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_user` (
`id` int(11)
,`username` varchar(75)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_user_information`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_user_information` (
`user_id` int(11)
,`name` varchar(75)
,`surname` varchar(75)
,`dni` varchar(45)
,`email` varchar(75)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_action`
--
DROP TABLE IF EXISTS `view_action`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_action`  AS SELECT `action`.`id` AS `id`, `action`.`name` AS `name`, `action`.`description` AS `description` FROM `action` WHERE (`action`.`is_deleted` = 0) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_degree`
--
DROP TABLE IF EXISTS `view_degree`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_degree`  AS SELECT `degree`.`id` AS `id`, `degree`.`name` AS `name`, `degree`.`description` AS `description`, `degree`.`resolution` AS `resolution` FROM `degree` WHERE (`degree`.`is_deleted` = '0') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_degree_subjects`
--
DROP TABLE IF EXISTS `view_degree_subjects`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_degree_subjects`  AS SELECT `degree`.`id` AS `degree_id`, `degree`.`name` AS `name`, `degree`.`description` AS `description`, `degree`.`resolution` AS `resolution`, `subject`.`id` AS `subject_id`, `subject`.`year` AS `year` FROM ((`degree` join `degree_subjects` on((`degree`.`id` = `degree_subjects`.`degree_id`))) join `subject` on((`subject`.`id` = `degree_subjects`.`subject_id`))) WHERE ((`degree`.`is_deleted` = 0) AND (`subject`.`is_deleted` = 0)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_group`
--
DROP TABLE IF EXISTS `view_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_group`  AS SELECT `group`.`id` AS `id`, `group`.`name` AS `name`, `group`.`description` AS `description` FROM `group` WHERE (`group`.`is_deleted` = 0) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_group_permissions`
--
DROP TABLE IF EXISTS `view_group_permissions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_group_permissions`  AS SELECT `group`.`id` AS `group_id`, `group`.`name` AS `group_name`, `group`.`description` AS `group_description`, `action`.`id` AS `action_id`, `action`.`name` AS `action_name`, `action`.`description` AS `action_description` FROM ((`group` join `group_permissions` on((`group_permissions`.`group_id` = `group`.`id`))) join `action` on((`group_permissions`.`action_id` = `action`.`id`))) WHERE ((`group`.`is_deleted` = 0) AND (`action`.`is_deleted` = 0)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_group_user_members`
--
DROP TABLE IF EXISTS `view_group_user_members`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_group_user_members`  AS SELECT `group`.`id` AS `group_id`, `group`.`name` AS `group_name`, `group`.`description` AS `group_description`, `user`.`username` AS `username` FROM ((`group` join `group_user_members` on((`group`.`id` = `group_user_members`.`group_id`))) join `user` on((`group_user_members`.`user_id` = `user`.`id`))) WHERE ((`group`.`is_deleted` = 0) AND (`user`.`is_deleted` = 0)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_subject`
--
DROP TABLE IF EXISTS `view_subject`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_subject`  AS SELECT `subject`.`id` AS `id`, `subject`.`name` AS `name`, `subject`.`year` AS `year` FROM `subject` WHERE (`subject`.`is_deleted` = '0') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_user`
--
DROP TABLE IF EXISTS `view_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_user`  AS SELECT `user`.`id` AS `id`, `user`.`username` AS `username` FROM `user` WHERE (`user`.`is_deleted` = 0) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_user_information`
--
DROP TABLE IF EXISTS `view_user_information`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_user_information`  AS SELECT `user_information`.`user_id` AS `user_id`, `user_information`.`name` AS `name`, `user_information`.`surname` AS `surname`, `user_information`.`dni` AS `dni`, `user_information`.`email` AS `email` FROM (`user_information` join `user` on((`user_information`.`user_id` = `user`.`id`))) WHERE (`user`.`is_deleted` = 0) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indices de la tabla `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indices de la tabla `degree_subjects`
--
ALTER TABLE `degree_subjects`
  ADD KEY `fk_degree_subjects_degree1_idx` (`degree_id`),
  ADD KEY `fk_degree_subjects_subject1_idx` (`subject_id`);

--
-- Indices de la tabla `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indices de la tabla `group_permissions`
--
ALTER TABLE `group_permissions`
  ADD KEY `fk_group_actions_group1_idx` (`group_id`),
  ADD KEY `fk_group_actions_action1_idx` (`action_id`);

--
-- Indices de la tabla `group_user_members`
--
ALTER TABLE `group_user_members`
  ADD KEY `fk_group_user_members_group1_idx` (`group_id`),
  ADD KEY `fk_group_user_members_user1_idx` (`user_id`);

--
-- Indices de la tabla `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Indices de la tabla `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD UNIQUE KEY `mail_UNIQUE` (`email`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD KEY `fk_user_information_user_idx` (`user_id`);

--
-- Indices de la tabla `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `token_UNIQUE` (`token`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD KEY `fk_user_session_user1_idx` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `action`
--
ALTER TABLE `action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `degree`
--
ALTER TABLE `degree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `degree_subjects`
--
ALTER TABLE `degree_subjects`
  ADD CONSTRAINT `fk_degree_subjects_degree1` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`id`),
  ADD CONSTRAINT `fk_degree_subjects_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Filtros para la tabla `group_permissions`
--
ALTER TABLE `group_permissions`
  ADD CONSTRAINT `fk_group_actions_action1` FOREIGN KEY (`action_id`) REFERENCES `action` (`id`),
  ADD CONSTRAINT `fk_group_actions_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`);

--
-- Filtros para la tabla `group_user_members`
--
ALTER TABLE `group_user_members`
  ADD CONSTRAINT `fk_group_user_members_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`),
  ADD CONSTRAINT `fk_group_user_members_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user_information`
--
ALTER TABLE `user_information`
  ADD CONSTRAINT `fk_user_information_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user_session`
--
ALTER TABLE `user_session`
  ADD CONSTRAINT `fk_user_session_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
