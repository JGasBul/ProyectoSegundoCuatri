-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla gti_equipo7.mediciones_sonda
DROP TABLE IF EXISTS `mediciones_sonda`;
CREATE TABLE IF NOT EXISTS `mediciones_sonda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sonda` int(11) NOT NULL,
  `sensor` enum('Temperatura','Humedad','Luz','Salinidad') COLLATE utf8_unicode_ci NOT NULL,
  `medicion` float NOT NULL DEFAULT 0,
  `hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `medicion_sonda` (`id_sonda`),
  CONSTRAINT `medicion_sonda` FOREIGN KEY (`id_sonda`) REFERENCES `sondas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla gti_equipo7.mediciones_sonda: ~255 rows (aproximadamente)
DELETE FROM `mediciones_sonda`;
/*!40000 ALTER TABLE `mediciones_sonda` DISABLE KEYS */;
INSERT INTO `mediciones_sonda` (`id`, `id_sonda`, `sensor`, `medicion`, `hora`) VALUES
	(1, 1, 'Temperatura', 35, '2022-05-18 12:00:00'),
	(2, 1, 'Humedad', 60, '2022-05-18 19:00:00'),
	(3, 1, 'Luz', 67, '2022-05-18 19:00:00'),
	(4, 1, 'Salinidad', 12, '2022-05-18 18:00:00'),
	(5, 1, 'Temperatura', 35, '2022-05-18 19:00:00'),
	(6, 1, 'Temperatura', 45, '2022-05-18 18:00:00'),
	(7, 1, 'Temperatura', 25, '2022-05-18 17:00:00'),
	(8, 1, 'Temperatura', 32, '2022-05-18 16:00:00'),
	(9, 1, 'Temperatura', 16, '2022-05-18 15:00:00'),
	(10, 1, 'Temperatura', 17, '2022-05-18 14:00:00'),
	(11, 1, 'Temperatura', 10, '2022-05-18 13:00:00'),
	(12, 1, 'Humedad', 10, '2022-05-18 18:00:00'),
	(13, 1, 'Humedad', 25, '2022-05-18 17:00:00'),
	(14, 1, 'Humedad', 30, '2022-05-18 16:00:00'),
	(15, 1, 'Humedad', 60, '2022-05-18 15:00:00'),
	(16, 1, 'Humedad', 20, '2022-05-18 12:00:00'),
	(17, 1, 'Humedad', 50, '2022-05-18 13:00:00'),
	(20, 1, 'Humedad', 35, '2022-05-18 14:00:00'),
	(21, 1, 'Luz', 45, '2022-05-18 18:00:00'),
	(22, 1, 'Luz', 23, '2022-05-18 17:00:00'),
	(23, 1, 'Luz', 46, '2022-05-18 16:00:00'),
	(24, 1, 'Luz', 75, '2022-05-18 15:00:00'),
	(25, 1, 'Luz', 0, '2022-05-18 14:00:00'),
	(26, 1, 'Luz', 10, '2022-05-18 13:00:00'),
	(27, 1, 'Luz', 25, '2022-05-18 12:00:00'),
	(28, 1, 'Salinidad', 23, '2022-05-18 17:00:00'),
	(29, 1, 'Salinidad', 45, '2022-05-18 16:00:00'),
	(30, 1, 'Salinidad', 98, '2022-05-18 15:00:00'),
	(31, 1, 'Salinidad', 87, '2022-05-18 14:00:00'),
	(32, 1, 'Salinidad', 67, '2022-05-18 13:00:00'),
	(33, 1, 'Salinidad', 25, '2022-05-18 12:00:00'),
	(34, 1, 'Salinidad', 7, '2022-05-18 19:00:00'),
	(35, 2, 'Temperatura', 35, '2022-05-18 12:00:00'),
	(36, 3, 'Temperatura', 35, '2022-05-18 12:00:00'),
	(37, 4, 'Temperatura', 35, '2022-05-18 12:00:00'),
	(38, 6, 'Temperatura', 35, '2022-05-18 12:00:00'),
	(39, 7, 'Temperatura', 35, '2022-05-18 12:00:00'),
	(40, 8, 'Temperatura', 35, '2022-05-18 12:00:00'),
	(41, 9, 'Temperatura', 35, '2022-05-18 12:00:00'),
	(42, 2, 'Temperatura', 10, '2022-05-18 13:00:00'),
	(43, 3, 'Temperatura', 10, '2022-05-18 13:00:00'),
	(44, 4, 'Temperatura', 10, '2022-05-18 13:00:00'),
	(45, 6, 'Temperatura', 10, '2022-05-18 13:00:00'),
	(46, 7, 'Temperatura', 10, '2022-05-18 13:00:00'),
	(47, 8, 'Temperatura', 10, '2022-05-18 13:00:00'),
	(48, 9, 'Temperatura', 10, '2022-05-18 13:00:00'),
	(49, 2, 'Temperatura', 17, '2022-05-18 14:00:00'),
	(50, 3, 'Temperatura', 17, '2022-05-18 14:00:00'),
	(51, 4, 'Temperatura', 17, '2022-05-18 14:00:00'),
	(52, 6, 'Temperatura', 17, '2022-05-18 14:00:00'),
	(53, 7, 'Temperatura', 17, '2022-05-18 14:00:00'),
	(54, 8, 'Temperatura', 17, '2022-05-18 14:00:00'),
	(55, 9, 'Temperatura', 17, '2022-05-18 14:00:00'),
	(56, 2, 'Temperatura', 16, '2022-05-18 15:00:00'),
	(57, 2, 'Temperatura', 32, '2022-05-18 16:00:00'),
	(58, 4, 'Temperatura', 16, '2022-05-18 15:00:00'),
	(59, 6, 'Temperatura', 16, '2022-05-18 15:00:00'),
	(60, 7, 'Temperatura', 16, '2022-05-18 15:00:00'),
	(61, 8, 'Temperatura', 16, '2022-05-18 15:00:00'),
	(62, 9, 'Temperatura', 16, '2022-05-18 15:00:00'),
	(63, 3, 'Temperatura', 16, '2022-05-18 15:00:00'),
	(64, 3, 'Temperatura', 32, '2022-05-18 16:00:00'),
	(65, 4, 'Temperatura', 32, '2022-05-18 16:00:00'),
	(66, 6, 'Temperatura', 32, '2022-05-18 16:00:00'),
	(67, 7, 'Temperatura', 32, '2022-05-18 16:00:00'),
	(68, 8, 'Temperatura', 32, '2022-05-18 16:00:00'),
	(69, 9, 'Temperatura', 32, '2022-05-18 16:00:00'),
	(70, 2, 'Temperatura', 25, '2022-05-18 17:00:00'),
	(71, 3, 'Temperatura', 25, '2022-05-18 17:00:00'),
	(72, 4, 'Temperatura', 25, '2022-05-18 17:00:00'),
	(73, 6, 'Temperatura', 25, '2022-05-18 17:00:00'),
	(74, 7, 'Temperatura', 25, '2022-05-18 17:00:00'),
	(75, 8, 'Temperatura', 25, '2022-05-18 17:00:00'),
	(76, 9, 'Temperatura', 25, '2022-05-18 17:00:00'),
	(77, 2, 'Temperatura', 45, '2022-05-18 18:00:00'),
	(78, 3, 'Temperatura', 45, '2022-05-18 18:00:00'),
	(79, 4, 'Temperatura', 45, '2022-05-18 18:00:00'),
	(80, 6, 'Temperatura', 45, '2022-05-18 18:00:00'),
	(81, 7, 'Temperatura', 45, '2022-05-18 18:00:00'),
	(82, 8, 'Temperatura', 45, '2022-05-18 18:00:00'),
	(83, 9, 'Temperatura', 45, '2022-05-18 18:00:00'),
	(84, 2, 'Temperatura', 35, '2022-05-18 19:00:00'),
	(85, 3, 'Temperatura', 35, '2022-05-18 19:00:00'),
	(86, 4, 'Temperatura', 35, '2022-05-18 19:00:00'),
	(87, 6, 'Temperatura', 35, '2022-05-18 19:00:00'),
	(88, 7, 'Temperatura', 35, '2022-05-18 19:00:00'),
	(89, 8, 'Temperatura', 35, '2022-05-18 19:00:00'),
	(90, 9, 'Temperatura', 35, '2022-05-18 19:00:00'),
	(91, 2, 'Humedad', 20, '2022-05-18 12:00:00'),
	(92, 2, 'Humedad', 50, '2022-05-18 13:00:00'),
	(93, 3, 'Humedad', 20, '2022-05-18 12:00:00'),
	(94, 4, 'Humedad', 20, '2022-05-18 12:00:00'),
	(95, 6, 'Humedad', 20, '2022-05-18 12:00:00'),
	(96, 7, 'Humedad', 20, '2022-05-18 12:00:00'),
	(97, 8, 'Humedad', 20, '2022-05-18 12:00:00'),
	(98, 8, 'Humedad', 20, '2022-05-18 12:00:00'),
	(99, 3, 'Humedad', 50, '2022-05-18 13:00:00'),
	(100, 4, 'Humedad', 50, '2022-05-18 13:00:00'),
	(101, 6, 'Humedad', 50, '2022-05-18 13:00:00'),
	(102, 7, 'Humedad', 50, '2022-05-18 13:00:00'),
	(103, 8, 'Humedad', 50, '2022-05-18 13:00:00'),
	(104, 9, 'Humedad', 50, '2022-05-18 13:00:00'),
	(105, 2, 'Humedad', 35, '2022-05-18 14:00:00'),
	(106, 3, 'Humedad', 35, '2022-05-18 14:00:00'),
	(107, 4, 'Humedad', 35, '2022-05-18 14:00:00'),
	(108, 6, 'Humedad', 35, '2022-05-18 14:00:00'),
	(109, 7, 'Humedad', 35, '2022-05-18 14:00:00'),
	(110, 8, 'Humedad', 35, '2022-05-18 14:00:00'),
	(111, 9, 'Humedad', 35, '2022-05-18 14:00:00'),
	(112, 2, 'Humedad', 60, '2022-05-18 15:00:00'),
	(113, 3, 'Humedad', 60, '2022-05-18 15:00:00'),
	(114, 4, 'Humedad', 60, '2022-05-18 15:00:00'),
	(115, 6, 'Humedad', 60, '2022-05-18 15:00:00'),
	(116, 7, 'Humedad', 60, '2022-05-18 15:00:00'),
	(117, 8, 'Humedad', 60, '2022-05-18 15:00:00'),
	(118, 9, 'Humedad', 60, '2022-05-18 15:00:00'),
	(119, 2, 'Humedad', 30, '2022-05-18 16:00:00'),
	(120, 3, 'Humedad', 30, '2022-05-18 16:00:00'),
	(121, 4, 'Humedad', 30, '2022-05-18 16:00:00'),
	(122, 6, 'Humedad', 30, '2022-05-18 16:00:00'),
	(123, 7, 'Humedad', 30, '2022-05-18 16:00:00'),
	(124, 8, 'Humedad', 30, '2022-05-18 16:00:00'),
	(125, 9, 'Humedad', 30, '2022-05-18 16:00:00'),
	(126, 2, 'Humedad', 25, '2022-05-18 17:00:00'),
	(127, 3, 'Humedad', 25, '2022-05-18 17:00:00'),
	(128, 4, 'Humedad', 25, '2022-05-18 17:00:00'),
	(129, 6, 'Humedad', 25, '2022-05-18 17:00:00'),
	(130, 7, 'Humedad', 25, '2022-05-18 17:00:00'),
	(131, 8, 'Humedad', 25, '2022-05-18 17:00:00'),
	(132, 9, 'Humedad', 25, '2022-05-18 17:00:00'),
	(133, 2, 'Humedad', 10, '2022-05-18 18:00:00'),
	(134, 3, 'Humedad', 10, '2022-05-18 18:00:00'),
	(135, 4, 'Humedad', 10, '2022-05-18 18:00:00'),
	(136, 6, 'Humedad', 10, '2022-05-18 18:00:00'),
	(137, 7, 'Humedad', 10, '2022-05-18 18:00:00'),
	(138, 8, 'Humedad', 10, '2022-05-18 18:00:00'),
	(139, 9, 'Humedad', 10, '2022-05-18 18:00:00'),
	(140, 2, 'Humedad', 60, '2022-05-18 19:00:00'),
	(141, 3, 'Humedad', 60, '2022-05-18 19:00:00'),
	(142, 4, 'Humedad', 60, '2022-05-18 19:00:00'),
	(143, 6, 'Humedad', 60, '2022-05-18 19:00:00'),
	(144, 7, 'Humedad', 60, '2022-05-18 19:00:00'),
	(145, 8, 'Humedad', 60, '2022-05-18 19:00:00'),
	(146, 9, 'Humedad', 60, '2022-05-18 19:00:00'),
	(147, 2, 'Luz', 25, '2022-05-18 12:00:00'),
	(148, 3, 'Luz', 25, '2022-05-18 12:00:00'),
	(149, 4, 'Luz', 25, '2022-05-18 12:00:00'),
	(150, 6, 'Luz', 25, '2022-05-18 12:00:00'),
	(151, 7, 'Luz', 25, '2022-05-18 12:00:00'),
	(152, 8, 'Luz', 25, '2022-05-18 12:00:00'),
	(153, 9, 'Luz', 25, '2022-05-18 12:00:00'),
	(154, 2, 'Luz', 10, '2022-05-18 13:00:00'),
	(155, 3, 'Luz', 10, '2022-05-18 13:00:00'),
	(156, 4, 'Luz', 10, '2022-05-18 13:00:00'),
	(157, 6, 'Luz', 10, '2022-05-18 13:00:00'),
	(158, 7, 'Luz', 10, '2022-05-18 13:00:00'),
	(159, 8, 'Luz', 10, '2022-05-18 13:00:00'),
	(160, 9, 'Luz', 10, '2022-05-18 13:00:00'),
	(161, 2, 'Luz', 0, '2022-05-18 14:00:00'),
	(162, 3, 'Luz', 0, '2022-05-18 14:00:00'),
	(163, 4, 'Luz', 0, '2022-05-18 14:00:00'),
	(164, 6, 'Luz', 0, '2022-05-18 14:00:00'),
	(165, 7, 'Luz', 0, '2022-05-18 14:00:00'),
	(166, 8, 'Luz', 0, '2022-05-18 14:00:00'),
	(167, 9, 'Luz', 0, '2022-05-18 14:00:00'),
	(168, 2, 'Luz', 75, '2022-05-18 15:00:00'),
	(169, 3, 'Luz', 75, '2022-05-18 15:00:00'),
	(170, 4, 'Luz', 75, '2022-05-18 15:00:00'),
	(171, 6, 'Luz', 75, '2022-05-18 15:00:00'),
	(172, 7, 'Luz', 75, '2022-05-18 15:00:00'),
	(173, 8, 'Luz', 75, '2022-05-18 15:00:00'),
	(174, 9, 'Luz', 75, '2022-05-18 15:00:00'),
	(175, 2, 'Luz', 46, '2022-05-18 16:00:00'),
	(176, 3, 'Luz', 46, '2022-05-18 16:00:00'),
	(177, 4, 'Luz', 46, '2022-05-18 16:00:00'),
	(178, 6, 'Luz', 46, '2022-05-18 16:00:00'),
	(179, 7, 'Luz', 46, '2022-05-18 16:00:00'),
	(180, 8, 'Luz', 46, '2022-05-18 16:00:00'),
	(181, 9, 'Luz', 46, '2022-05-18 16:00:00'),
	(182, 2, 'Luz', 23, '2022-05-18 17:00:00'),
	(183, 3, 'Luz', 23, '2022-05-18 17:00:00'),
	(184, 4, 'Luz', 23, '2022-05-18 17:00:00'),
	(185, 6, 'Luz', 23, '2022-05-18 17:00:00'),
	(186, 7, 'Luz', 23, '2022-05-18 17:00:00'),
	(187, 8, 'Luz', 23, '2022-05-18 17:00:00'),
	(188, 9, 'Luz', 23, '2022-05-18 17:00:00'),
	(189, 2, 'Luz', 45, '2022-05-18 18:00:00'),
	(190, 3, 'Luz', 45, '2022-05-18 18:00:00'),
	(191, 4, 'Luz', 45, '2022-05-18 18:00:00'),
	(192, 6, 'Luz', 45, '2022-05-18 18:00:00'),
	(193, 7, 'Luz', 45, '2022-05-18 18:00:00'),
	(194, 8, 'Luz', 45, '2022-05-18 18:00:00'),
	(195, 9, 'Luz', 45, '2022-05-18 18:00:00'),
	(196, 2, 'Luz', 67, '2022-05-18 19:00:00'),
	(197, 3, 'Luz', 67, '2022-05-18 19:00:00'),
	(198, 4, 'Luz', 67, '2022-05-18 19:00:00'),
	(199, 6, 'Luz', 67, '2022-05-18 19:00:00'),
	(200, 7, 'Luz', 67, '2022-05-18 19:00:00'),
	(201, 8, 'Luz', 67, '2022-05-18 19:00:00'),
	(202, 9, 'Luz', 67, '2022-05-18 19:00:00'),
	(203, 2, 'Salinidad', 25, '2022-05-18 12:00:00'),
	(204, 3, 'Salinidad', 25, '2022-05-18 12:00:00'),
	(205, 4, 'Salinidad', 25, '2022-05-18 12:00:00'),
	(206, 6, 'Salinidad', 25, '2022-05-18 12:00:00'),
	(207, 7, 'Salinidad', 25, '2022-05-18 12:00:00'),
	(208, 8, 'Salinidad', 25, '2022-05-18 12:00:00'),
	(209, 9, 'Salinidad', 25, '2022-05-18 12:00:00'),
	(210, 2, 'Salinidad', 67, '2022-05-18 13:00:00'),
	(211, 3, 'Salinidad', 67, '2022-05-18 13:00:00'),
	(212, 4, 'Salinidad', 67, '2022-05-18 13:00:00'),
	(213, 6, 'Salinidad', 67, '2022-05-18 13:00:00'),
	(214, 7, 'Salinidad', 67, '2022-05-18 13:00:00'),
	(215, 8, 'Salinidad', 67, '2022-05-18 13:00:00'),
	(216, 9, 'Salinidad', 67, '2022-05-18 13:00:00'),
	(217, 2, 'Salinidad', 87, '2022-05-18 14:00:00'),
	(218, 3, 'Salinidad', 87, '2022-05-18 14:00:00'),
	(219, 4, 'Salinidad', 87, '2022-05-18 14:00:00'),
	(220, 6, 'Salinidad', 87, '2022-05-18 14:00:00'),
	(221, 7, 'Salinidad', 87, '2022-05-18 14:00:00'),
	(222, 8, 'Salinidad', 87, '2022-05-18 14:00:00'),
	(223, 9, 'Salinidad', 87, '2022-05-18 14:00:00'),
	(224, 3, 'Salinidad', 98, '2022-05-18 22:45:48'),
	(225, 4, 'Salinidad', 98, '2022-05-18 22:45:48'),
	(226, 6, 'Salinidad', 98, '2022-05-18 22:45:48'),
	(227, 7, 'Salinidad', 98, '2022-05-18 22:45:48'),
	(228, 8, 'Salinidad', 98, '2022-05-18 22:45:48'),
	(229, 9, 'Salinidad', 98, '2022-05-18 22:45:48'),
	(230, 2, 'Salinidad', 45, '2022-05-18 16:00:00'),
	(231, 3, 'Salinidad', 45, '2022-05-18 16:00:00'),
	(232, 4, 'Salinidad', 45, '2022-05-18 16:00:00'),
	(233, 6, 'Salinidad', 45, '2022-05-18 16:00:00'),
	(234, 7, 'Salinidad', 45, '2022-05-18 16:00:00'),
	(235, 8, 'Salinidad', 45, '2022-05-18 16:00:00'),
	(236, 9, 'Salinidad', 45, '2022-05-18 16:00:00'),
	(237, 2, 'Salinidad', 23, '2022-05-18 17:00:00'),
	(238, 3, 'Salinidad', 23, '2022-05-18 17:00:00'),
	(239, 4, 'Salinidad', 23, '2022-05-18 17:00:00'),
	(240, 6, 'Salinidad', 23, '2022-05-18 17:00:00'),
	(242, 7, 'Salinidad', 23, '2022-05-18 17:00:00'),
	(243, 8, 'Salinidad', 23, '2022-05-18 17:00:00'),
	(244, 9, 'Salinidad', 23, '2022-05-18 17:00:00'),
	(245, 2, 'Salinidad', 12, '2022-05-18 18:00:00'),
	(246, 3, 'Salinidad', 12, '2022-05-18 18:00:00'),
	(247, 4, 'Salinidad', 12, '2022-05-18 18:00:00'),
	(248, 6, 'Salinidad', 12, '2022-05-18 18:00:00'),
	(249, 7, 'Salinidad', 12, '2022-05-18 18:00:00'),
	(250, 8, 'Salinidad', 12, '2022-05-18 18:00:00'),
	(251, 9, 'Salinidad', 12, '2022-05-18 18:00:00'),
	(252, 2, 'Salinidad', 7, '2022-05-18 19:00:00'),
	(253, 3, 'Salinidad', 7, '2022-05-18 19:00:00'),
	(254, 4, 'Salinidad', 7, '2022-05-18 19:00:00'),
	(255, 6, 'Salinidad', 7, '2022-05-18 19:00:00'),
	(256, 7, 'Salinidad', 7, '2022-05-18 19:00:00'),
	(257, 8, 'Salinidad', 7, '2022-05-18 19:00:00'),
	(258, 9, 'Salinidad', 7, '2022-05-18 19:00:00');
/*!40000 ALTER TABLE `mediciones_sonda` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.parcelas
DROP TABLE IF EXISTS `parcelas`;
CREATE TABLE IF NOT EXISTS `parcelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `color` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla gti_equipo7.parcelas: ~3 rows (aproximadamente)
DELETE FROM `parcelas`;
/*!40000 ALTER TABLE `parcelas` DISABLE KEYS */;
INSERT INTO `parcelas` (`id`, `nombre`, `color`) VALUES
	(1, 'Parcela nº1', 'FF8000'),
	(2, 'Parcela nº2', 'F44336'),
	(3, 'Parcela nº3', '2196F3');
/*!40000 ALTER TABLE `parcelas` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.posicion_sonda
DROP TABLE IF EXISTS `posicion_sonda`;
CREATE TABLE IF NOT EXISTS `posicion_sonda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `sonda` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_vertice_sonda` (`sonda`) USING BTREE,
  CONSTRAINT `fk_vertice_sonda` FOREIGN KEY (`sonda`) REFERENCES `sondas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla gti_equipo7.posicion_sonda: ~8 rows (aproximadamente)
DELETE FROM `posicion_sonda`;
/*!40000 ALTER TABLE `posicion_sonda` DISABLE KEYS */;
INSERT INTO `posicion_sonda` (`id`, `lat`, `lng`, `sonda`) VALUES
	(1, 38.9983908, -0.1785001, 1),
	(2, 38.9979107, -0.1774030, 2),
	(3, 38.9969825, -0.1779657, 3),
	(4, 38.9969494, -0.1783175, 4),
	(18, 38.9924270, -0.1713474, 6),
	(19, 38.9927512, -0.1694416, 7),
	(20, 38.9915003, -0.1684759, 8),
	(21, 38.9910870, -0.1709218, 9);
/*!40000 ALTER TABLE `posicion_sonda` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.sondas
DROP TABLE IF EXISTS `sondas`;
CREATE TABLE IF NOT EXISTS `sondas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `parcela` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_sonda_parcela` (`parcela`),
  KEY `FK2_sonda_usuario` (`usuario`),
  CONSTRAINT `FK1_sonda_parcela` FOREIGN KEY (`parcela`) REFERENCES `parcelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_sonda_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla gti_equipo7.sondas: ~8 rows (aproximadamente)
DELETE FROM `sondas`;
/*!40000 ALTER TABLE `sondas` DISABLE KEYS */;
INSERT INTO `sondas` (`id`, `usuario`, `parcela`) VALUES
	(1, 1, 2),
	(2, 1, 2),
	(3, 1, 2),
	(4, 1, 2),
	(6, 2, 3),
	(7, 2, 3),
	(8, 2, 3),
	(9, 2, 3);
/*!40000 ALTER TABLE `sondas` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `rol` enum('admin','normal') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla gti_equipo7.usuarios: ~4 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `email`, `nombre`, `password`, `rol`) VALUES
	(1, 'propietario1@gmail.com', 'propietario1', '1234', 'normal'),
	(2, 'propietario2@gmail.com', 'propietario2', '1234', 'normal'),
	(3, 'admin@gmail.com', 'admin', 'admin', 'admin'),
	(5, 'pepe@gmail.com', 'pepe', '$2y$10$y6nFZ73YVoi1aOXb/NebkuFVDXpY9HFw/gY2M4yTZ7G1J7zreQr7u', 'admin');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.usuarios_parcelas
DROP TABLE IF EXISTS `usuarios_parcelas`;
CREATE TABLE IF NOT EXISTS `usuarios_parcelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `parcela` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_parcela_usuario` (`usuario`),
  KEY `fk_usuario_parcela_parcela` (`parcela`),
  CONSTRAINT `fk_usuario_parcela_parcela` FOREIGN KEY (`parcela`) REFERENCES `parcelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_parcela_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla gti_equipo7.usuarios_parcelas: ~4 rows (aproximadamente)
DELETE FROM `usuarios_parcelas`;
/*!40000 ALTER TABLE `usuarios_parcelas` DISABLE KEYS */;
INSERT INTO `usuarios_parcelas` (`id`, `usuario`, `parcela`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 2, 1),
	(4, 2, 3);
/*!40000 ALTER TABLE `usuarios_parcelas` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.vertices
DROP TABLE IF EXISTS `vertices`;
CREATE TABLE IF NOT EXISTS `vertices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `parcela` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vertice_parcela` (`parcela`),
  CONSTRAINT `fk_vertice_parcela` FOREIGN KEY (`parcela`) REFERENCES `parcelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla gti_equipo7.vertices: ~13 rows (aproximadamente)
DELETE FROM `vertices`;
/*!40000 ALTER TABLE `vertices` DISABLE KEYS */;
INSERT INTO `vertices` (`id`, `lat`, `lng`, `parcela`) VALUES
	(1, 38.9981639, -0.1720151, 1),
	(2, 38.9979802, -0.1715208, 1),
	(3, 38.9965934, -0.1721850, 1),
	(4, 38.9969109, -0.1729598, 1),
	(5, 38.9983908, -0.1785001, 2),
	(6, 38.9979107, -0.1774030, 2),
	(7, 38.9969825, -0.1779657, 2),
	(8, 38.9969494, -0.1783175, 2),
	(9, 38.9975874, -0.1795887, 2),
	(10, 38.9924270, -0.1713474, 3),
	(11, 38.9927512, -0.1694416, 3),
	(12, 38.9915003, -0.1684759, 3),
	(13, 38.9910870, -0.1709218, 3);
/*!40000 ALTER TABLE `vertices` ENABLE KEYS */;

-- Volcando estructura para vista gti_equipo7.vista_parcelas_con_vertices
DROP VIEW IF EXISTS `vista_parcelas_con_vertices`;
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vista_parcelas_con_vertices` (
	`id` INT(11) NOT NULL,
	`nombre` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`color` VARCHAR(6) NOT NULL COLLATE 'utf8mb4_general_ci',
	`lat` DECIMAL(10,7) NOT NULL,
	`lng` DECIMAL(10,7) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista gti_equipo7.vista_propiedad_parcelas
DROP VIEW IF EXISTS `vista_propiedad_parcelas`;
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vista_propiedad_parcelas` (
	`usuario` INT(11) NOT NULL,
	`parcela` INT(11) NOT NULL,
	`nombre_parcela` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`color` VARCHAR(6) NOT NULL COLLATE 'utf8mb4_general_ci',
	`nombre_usuario` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista gti_equipo7.vista_propiedad_sondas
DROP VIEW IF EXISTS `vista_propiedad_sondas`;
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vista_propiedad_sondas` (
	`id_sonda` INT(11) NOT NULL,
	`usuario` INT(11) NOT NULL,
	`parcela` INT(11) NOT NULL,
	`latitud` DECIMAL(10,7) NOT NULL,
	`longitud` DECIMAL(10,7) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista gti_equipo7.vista_parcelas_con_vertices
DROP VIEW IF EXISTS `vista_parcelas_con_vertices`;
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vista_parcelas_con_vertices`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vista_parcelas_con_vertices` AS select `parcelas`.`id` AS `id`,`parcelas`.`nombre` AS `nombre`,`parcelas`.`color` AS `color`,`vertices`.`lat` AS `lat`,`vertices`.`lng` AS `lng` from (`parcelas` join `vertices` on((`parcelas`.`id` = `vertices`.`parcela`))) ;

-- Volcando estructura para vista gti_equipo7.vista_propiedad_parcelas
DROP VIEW IF EXISTS `vista_propiedad_parcelas`;
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vista_propiedad_parcelas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vista_propiedad_parcelas` AS select `usuarios_parcelas`.`usuario` AS `usuario`,`usuarios_parcelas`.`parcela` AS `parcela`,`parcelas`.`nombre` AS `nombre_parcela`,`parcelas`.`color` AS `color`,`usuarios`.`nombre` AS `nombre_usuario` from ((`usuarios_parcelas` join `parcelas` on((`parcelas`.`id` = `usuarios_parcelas`.`parcela`))) join `usuarios` on((`usuarios`.`id` = `usuarios_parcelas`.`usuario`))) ;

-- Volcando estructura para vista gti_equipo7.vista_propiedad_sondas
DROP VIEW IF EXISTS `vista_propiedad_sondas`;
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vista_propiedad_sondas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vista_propiedad_sondas` AS SELECT `sondas`.`id` AS `id_sonda`,`sondas`.`usuario` AS `usuario`,`sondas`.`parcela` AS `parcela`,`posicion_sonda`.`lat` AS `latitud`,`posicion_sonda`.`lng` AS `longitud` from (`sondas` join `posicion_sonda` on((`sondas`.`id` = `posicion_sonda`.`sonda`))) ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
